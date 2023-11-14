<?php
include("includes/header.php");


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
                    <h1><?= $title; ?></h1>
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
                    <img src="assets/images/blog/<?= $image;?>" alt="" class="img-fluid">
                    </div>

                    <div class="single-post-content">
                        <div class="post-meta mt-4">
                            <span class="post-date"><i class="fa fa-calendar-alt mr-2"></i><?= $createdOn ?></span>
                            <!-- <span class="post-comment"><i class="fa fa-comments mr-2"></i>1 Comment</span> -->
                            <span><a href="#" class="post-author"><i class="fa fa-user mr-2"></i><?= $writer; ?></a></span>
                        </div>

                        <p class="mt-4 "><?= $description ?></p>
                    </div>


                    <div class="row align-items-center justify-content-between blog-navigation">
                        <div class="col-lg-6 border-right">
                            <?php if ($previousPost) : ?>
                                <a href="blog_single.php?b_id=<?php echo $previousPost['id']; ?>" class="prev-post">
                                    <span>- Previous Post</span>
                                    <?php echo $previousPost['blogTitle']; ?>
                                </a>
                            <?php else : ?>
                                <span>No Previous Post</span>
                            <?php endif; ?>
                        </div>
                        <div class="col-lg-6">
                            <?php if ($nextPost) : ?>
                                <a href="blog_single.php?b_id=<?php echo $nextPost['id']; ?>" class="next-post">
                                    <span>- Next Post</span>
                                    <?php echo $nextPost['blogTitle']; ?>
                                </a>
                            <?php else : ?>
                                <span>No Next Post</span>
                            <?php endif; ?>
                        </div>
                    </div>

                    


                    <div class="comments">
                        <h3 class="commment-title">2 Comments(2)</h3>

                        <div class="media">
                            <img src="assets/images/blog/user.jpg" class="mr-3" alt="...">
                            <div class="media-body">
                                <h5 class="mt-0">Harish John <span>17 Feb 2020</span> <a class="reply-link" href="#"><i
                                            class="fas fa-reply-all"></i>Reply</a></h5>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante
                                sollicitudin. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue
                                felis in faucibus.

                                <div class="media">
                                    <a class="mr-3" href="#">
                                        <img src="assets/images/blog/user.jpg" class="mr-3" alt="...">
                                    </a>
                                    <div class="media-body">
                                        <h5 class="mt-0">Harish John <span>17 Feb 2020</span> <a class="reply-link"
                                                href="#"><i class="fas fa-reply-all"></i>Reply</a></h5>
                                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante
                                        sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra
                                        turpis.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="media">
                            <img src="assets/images/blog/user.jpg" class="mr-3" alt="...">
                            <div class="media-body">
                                <h5 class="mt-0">Harish John <span>17 Feb 2020</span> <a class="reply-link" href="#"><i
                                            class="fas fa-reply-all"></i>Reply</a></h5>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante
                                sollicitudin. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue
                                felis in faucibus.
                            </div>
                        </div>
                    </div>



                    <div class="comments-form p-5 mt-4">
                        <h3>Leave a comment </h3>
                        <p>Your email address will not be published. Required fields are marked *</p>
                        <form action="#" class="comment_form">
                            <div class="row form-row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <textarea name="msg" id="msgt" cols="30" rows="6" placeholder="Comment"
                                            class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Website">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Name">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <a href="#" class="btn btn-main">Comment</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
            <div class="col-md-4">
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
                        foreach ($latestBlogs as $post) :
                            if ($currentPostId && $currentPostId == $post['id']) {
                                continue;
                            }
                        ?>
                            <li>
                                <div class="widget-post-thumb">
                                    <a href="#"><img src="assets/images/blog/<?= $post['bannerImage'] ?>" alt="" class="img-fluid"></a>
                                </div>
                                <div class="widget-post-body">
                                    <span><?php echo date('M j, Y', strtotime($post['createdOn'])); ?></span>
                                    <h6> <a href="blog_single.php?id=<?php echo $post['id']; ?>"><?php echo $post['blogTitle']; ?></a></h6>
                                </div>
                            </li>
                            <?php
                            $counter++;
                            if ($counter >= 3) break;
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