<?php
include("includes/header.php");
$_SESSION['role']="default student";
if (isset($_GET['b_id'])) {
    $blogId = $_GET['b_id'];
    $fetch_list_blog_query = mysqli_query($con, "SELECT * FROM blogs WHERE id = $blogId");
    $latestBlogs = mysqli_query($con, "SELECT * FROM blogs ORDER BY createdOn DESC");
    $previousPostQuery = mysqli_query($con, "SELECT * FROM blogs WHERE id < $blogId AND isActive = 1 ORDER BY id DESC LIMIT 1");
    $nextPostQuery = mysqli_query($con, "SELECT * FROM blogs WHERE id > $blogId AND isActive = 1 ORDER BY id ASC LIMIT 1");

    $previousPost = mysqli_fetch_assoc($previousPostQuery);
    $nextPost = mysqli_fetch_assoc($nextPostQuery);

    $n = mysqli_fetch_array($fetch_list_blog_query);
    $id = $n['id'];
    $title = $n['blogTitle'];
    $writer = $n['writer'];
    $image = $n['bannerImage'];
    $description = $n['description'];
    // $tag=$n['name'];
    $createdOn = date('M j, Y', strtotime($n['createdOn']));

}
?>



<div class="search-wrap">
    <div class="overlay">
        <form action="" class="search-form">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-9">
                        <h3>Search Your keyword</h3>
                        <input type="text" class="form-control" placeholder="Search...">
                    </div>
                    <div class="col-md-2 col-3 text-right">
                        <div class="search_toggle toggle-wrap d-inline-block">
                            <img class="search-close" src="assets/images/close.png"
                                srcset="assets/images/close%402x.png 2x" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!--search overlay end-->


<section class="page-header">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="page-header-content">
                    <h1>
                        <?= $title; ?>
                    </h1>
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="list-inline-item">/</li>
                        <li class="list-inline-item">
                            Blog Single
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>


<div class="page-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="post-single">
                    <div class="post-thumb">
                        <img src="assets/images/blog/<?= $image; ?>" alt="" class="img-fluid">
                    </div>

                    <div class="single-post-content">
                        <div class="post-meta mt-4">
                            <span class="post-date"><i class="fa fa-calendar-alt mr-2"></i>
                                <?= $createdOn ?>
                            </span>
                            <!-- <span class="post-comment"><i class="fa fa-comments mr-2"></i>1 Comment</span> -->
                            <span><a href="#" class="post-author"><i class="fa fa-user mr-2"></i>
                                    <?= $writer; ?>
                                </a></span>
                        </div>

                        <p class="mt-4 ">
                            <?= $description ?>
                        </p>
                    </div>


                    <div class="row align-items-center justify-content-between blog-navigation">
                        <div class="col-lg-6 border-right">
                            <?php if ($previousPost): ?>
                                <a href="blog_single?b_id=<?php echo $previousPost['id']; ?>" class="prev-post">
                                    <span>- Previous Post</span>
                                    <?php echo $previousPost['blogTitle']; ?>
                                </a>
                            <?php else: ?>
                                <span>No Previous Post</span>
                            <?php endif; ?>
                        </div>
                        <div class="col-lg-6">
                            <?php if ($nextPost): ?>
                                <a href="blog_single?b_id=<?php echo $nextPost['id']; ?>" class="next-post">
                                    <span>- Next Post</span>
                                    <?php echo $nextPost['blogTitle']; ?>
                                </a>
                            <?php else: ?>
                                <span>No Next Post</span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php
                    $row_count=0;
                    if ($row_count >= 0) {
                        // Initialize an empty array to store comments
                        $commentsArray = array();

                        // Loop through each row and fetch 'blog_id'
                        while ($row = mysqli_fetch_assoc($query_fetch_blog_comment)) {
                            $blog_id = $row['blog_id'];
                            if ($blog_id == $_GET['b_id']) {
                                // echo "Blog ID: $blog_id<br>";
                                $comment = $row['comment'];
                                $date = $row['commented_on'];
                                $commentedBy = $row['commented_by'];
                                $dateString = $date;
                                $formattedDate = date("jS M Y", strtotime($dateString));

                                // Add each comment to the $commentsArray
                                $commentsArray[] = array(
                                    'commentedBy' => $commentedBy,
                                    'commentDate' => $formattedDate,
                                    'commentContent' => $comment
                                );
                            }
                        }

                        // Display comments
                        if (!empty($commentsArray)) {
                            echo '<div class="comments">
                <h3 class="comment-title">(' . count($commentsArray) . ') Comments</h3>';

                            foreach ($commentsArray as $comment) {
                                $commentedBy = $comment['commentedBy'];
                                $commentDate = $comment['commentDate'];
                                $commentContent = $comment['commentContent'];

                                echo '<div class="media mb-5">
                    <img src="assets/images/blog/user.jpg" class="mr-3" alt="...">
                    <div class="media-body justify-content">
                        <h5 class="mt-0">' . $commentedBy . '<span>' . $commentDate . '</span></h5>
                        ' . $commentContent . '
                    </div>
                </div>';
                            }

                            echo '</div>'; // Close comments container
                        } 
                    } else {
                        echo "No rows found with isactive = 1";
                    }
                    ?>





                    <div class="comments-form p-5 mt-4">
                        <h3>Leave a comment </h3>
                        <p>Your email address will not be published. Required fields are marked *</p>
                        <form action="core/commentsFunctions.php" method="POST" class="comment_form">
                            <div class="row form-row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <!-- <input type="text" name="comment" cols="30" rows="6" placeholder="Comment" class="form-control"> -->
                                        <textarea name="commentdata" id="msgt" cols="30" rows="6" placeholder="Comment"
                                            class="form-control" required></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="text" name="website" class="form-control" placeholder="Website"
                                            required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control" placeholder="Name" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control" placeholder="Email">
                                    </div>
                                </div>
                                <input type="hidden" name="blog_id" value="<?= $_GET['b_id'] ?>" class="form-control"
                                    placeholder="Email">
                                <input type="hidden" name="role" value="<?= $_SESSION['role']; ?>" class="form-control"
                                    placeholder="Email">

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <button type="submit" name="comment" class="btn btn-main text-white">
                                            Comment
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
            <style>
                /* .blog-sidebar{
                    position: fixed;
                    top:0;
                } */
            </style>
            <div class="col-md-4 sidebar">
                <div class="blog-sidebar mt-5 mt-lg-0 mt-md-0">
                    <div class="widget widget_search">
                        <h4 class="widget-title">Search</h4>
                        <form role="search" class="search-form">
                            <input type="text" class="form-control" placeholder="Search">
                            <button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>

                    <div class="widget widget_news">
                        <h4 class="widget-title">Latest Posts</h4>
                        <ul class="recent-posts">
                            <?php
                            $counter = 0;
                            $currentPostId = isset($_GET['id']) ? $_GET['id'] : null;
                            foreach ($latestBlogs as $post):
                                if ($currentPostId && $currentPostId == $post['id']) {
                                    continue;
                                }
                                ?>
                                <li>
                                    <div class="widget-post-thumb">
                                        <a href="#"><img src="assets/images/blog/<?= $post['bannerImage'] ?>" alt=""
                                                class="img-fluid"></a>
                                    </div>
                                    <div class="widget-post-body">
                                        <span>
                                            <?php echo date('M j, Y', strtotime($post['createdOn'])); ?>
                                        </span>
                                        <h6> <a href="blog_single?id=<?php echo $post['id']; ?>">
                                                <?php echo $post['blogTitle']; ?>
                                            </a></h6>
                                    </div>
                                </li>
                                <?php
                                $counter++;
                                if ($counter >= 3)
                                    break;
                                ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <div class="widget widget_tag_cloud">
                        <h4 class="widget-title">Tags</h4>
                        <?php
                        $tagQuery = mysqli_query($con, "SELECT name FROM blogtag WHERE id = $blogId");

                        while ($tagData = mysqli_fetch_array($tagQuery)) {
                            echo '<a href="#">' . $tagData['name'] . '</a>';
                        }
                        ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<?php
include("includes/footer.php");
?>