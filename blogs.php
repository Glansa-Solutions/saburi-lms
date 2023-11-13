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
                    <h1>Blogs</h1>
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="list-inline-item">/</li>
                        <li class="list-inline-item">
                            Blogs
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="blog section-padding">
    <div class="container">
        <div class="row">
            <?php
            if ($fetch_list_blog_query) {
                // Loop through your blog data to display multiple items
                while ($row = mysqli_fetch_assoc($fetch_list_blog_query)) {
                    $id = $row['id'];
                    $title = $row['blogTitle'];
                    $writer = $row['writer'];
                    $image = $row['bannerImage'];
                    $description = $row['description'];
                    $createdOn = $row['createdOn'];

                    $short_description = $description;
                    $is_long_description = false;
            
                    // Check if description length exceeds 30 words
                    $words = explode(" ", $short_description);
                    if (count($words) > 20) {
                        $short_description = implode(" ", array_slice($words, 0, 20));
                        $is_long_description = true;
                    
                }
            ?>
            <div class="col-lg-4 col-md-6">
                <div class="blog-item">
                    <img src="assets/images/blog/<?= $row['bannerImage'] ?>" style="width:100%;"alt="" class="img-fluid">
                    <div class="blog-content">
                        <div class="entry-meta">
                            <span><i class="fa fa-calendar-alt"></i><?php echo $createdOn; ?></span>
                            <span></i><?php echo $writer; ?></span>
                        </div>

                        <h2><?php echo $title; ?></h2>
                        <p><?= $short_description ?></p>
                        <?php if ($is_long_description) : ?>
                        <a href="blog_single.php?id=<?php echo $row['id']; ?>"
                            class="btn btn-main btn-small read-more-link">
                            <i class="fa fa-plus-circle mr-2"></i>Read More
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</section>

<?php
include("includes/footer.php");
?>