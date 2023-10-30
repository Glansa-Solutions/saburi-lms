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
            <div class="col-lg-4 col-md-6">
                <div class="blog-item">
                    <img src="assets/images/blog/news-1.jpg" alt="" class="img-fluid">
                    <div class="blog-content">
                        <div class="entry-meta">
                            <span><i class="fa fa-calendar-alt"></i>May 19, 2020</span>
                            <span><i class="fa fa-comments"></i>1 comment</span>
                        </div>

                        <h2><a href="#">Powerful tips to grow business manner</a></h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicin gelit, sed do eiusmod tempor incididunt ut
                            labore et dolore.</p>
                        <a href="<?= $mainlink?>blog_single" class="btn btn-main btn-small"><i class="fa fa-plus-circle mr-2"></i>Read More</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="blog-item">
                    <img src="assets/images/blog/news-2.jpg" alt="" class="img-fluid">
                    <div class="blog-content">
                        <div class="entry-meta">
                            <span><i class="fa fa-calendar-alt"></i>May 19, 2020</span>
                            <span><i class="fa fa-comments"></i>1 comment</span>
                        </div>

                        <h2><a href="#">Powerful tips to grow effective manner</a></h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicin gelit, sed do eiusmod tempor incididunt ut
                            labore et dolore.</p>
                            <a href="<?= $mainlink?>blog_single" class="btn btn-main btn-small"><i class="fa fa-plus-circle mr-2"></i>Read More</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="blog-item">
                    <img src="assets/images/blog/news-3.jpg" alt="" class="img-fluid">
                    <div class="blog-content">
                        <div class="entry-meta">
                            <span><i class="fa fa-calendar-alt"></i>May 19, 2020</span>
                            <span><i class="fa fa-comments"></i>1 comment</span>
                        </div>

                        <h2><a href="#">Python may be you completed online </a></h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicin gelit, sed do eiusmod tempor incididunt ut
                            labore et dolore.</p>
                            <a href="<?= $mainlink?>blog_single" class="btn btn-main btn-small"><i class="fa fa-plus-circle mr-2"></i>Read More</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-lg-4 col-md-6">
                <div class="blog-item">
                    <img src="assets/images/blog/news-1.jpg" alt="" class="img-fluid">
                    <div class="blog-content">
                        <div class="entry-meta">
                            <span><i class="fa fa-calendar-alt"></i>May 19, 2020</span>
                            <span><i class="fa fa-comments"></i>1 comment</span>
                        </div>

                        <h2><a href="#">Powerful tips to grow business manner</a></h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicin gelit, sed do eiusmod tempor incididunt ut
                            labore et dolore.</p>
                        <a href="<?= $mainlink?>blog_single" class="btn btn-main btn-small"><i class="fa fa-plus-circle mr-2"></i>Read More</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="blog-item">
                    <img src="assets/images/blog/news-2.jpg" alt="" class="img-fluid">
                    <div class="blog-content">
                        <div class="entry-meta">
                            <span><i class="fa fa-calendar-alt"></i>May 19, 2020</span>
                            <span><i class="fa fa-comments"></i>1 comment</span>
                        </div>

                        <h2><a href="#">Powerful tips to grow effective manner</a></h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicin gelit, sed do eiusmod tempor incididunt ut
                            labore et dolore.</p>
                            <a href="<?= $mainlink?>blog_single" class="btn btn-main btn-small"><i class="fa fa-plus-circle mr-2"></i>Read More</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="blog-item">
                    <img src="assets/images/blog/news-3.jpg" alt="" class="img-fluid">
                    <div class="blog-content">
                        <div class="entry-meta">
                            <span><i class="fa fa-calendar-alt"></i>May 19, 2020</span>
                            <span><i class="fa fa-comments"></i>1 comment</span>
                        </div>

                        <h2><a href="#">Python may be you completed online </a></h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicin gelit, sed do eiusmod tempor incididunt ut
                            labore et dolore.</p>
                            <a href="<?= $mainlink?>blog_single" class="btn btn-main btn-small"><i class="fa fa-plus-circle mr-2"></i>Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include("includes/footer.php");
?>