<?php
include("includes/header.php");
// include("functions/config.php.php");

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
                    <h1>Course Style Filter</h1>
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="list-inline-item">/</li>
                        <li class="list-inline-item">
                            Courses
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-padding course">
    <div class="course-top-wrap">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <p>Showing 1-6 of 8 results</p>
                </div>

                <div class="col-lg-4">
                    <div class="topbar-search">
                        <form method="get" action="#">
                            <input type="text" placeholder="Search our courses" class="form-control">
                            <label><i class="fa fa-search"></i></label>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="course-grid-2">
        <div class="container">
            <ul class="course-filter">
                <li class="active"><a href="#" data-filter="*"> All</a></li>
                <li><a href="#" data-filter=".cat1">printing</a></li>
                <li><a href="#" data-filter=".cat2">Web</a></li>
                <li><a href="#" data-filter=".cat3">illustration</a></li>
                <li><a href="#" data-filter=".cat4">media</a></li>
                <li><a href="#" data-filter=".cat5">crafts</a></li>
            </ul>

            <div class="row course-gallery ">
                <div class="course-item cat1 cat3 col-lg-4 col-md-6">
                    <div class="course-block style-5">
                        <div class="course-img">
                            <img src="assets/images/course/course1.jpg" alt="" class="img-fluid">
                        </div>

                        <div class="course-content">
                            <div class="course-price ">$50</div>

                            <div class="rating">
                                <a href="#"><i class="fa fa-star"></i></a>
                                <a href="#"><i class="fa fa-star"></i></a>
                                <a href="#"><i class="fa fa-star"></i></a>
                                <a href="#"><i class="fa fa-star"></i></a>
                                <a href="#"><i class="fa fa-star"></i></a>
                                <span>(5.00)</span>
                            </div>
                            <h4><a href="<?=$mainlink?>course_single">Information About UI/UX Design Degree</a></h4>

                            <div class="course-meta">
                                <span class="course-student"><i class="bi bi-group"></i>57 Students</span>
                                <span class="course-duration"><i class="bi bi-badge3"></i>16 Lessons</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="course-item cat2 cat4 col-lg-4 col-md-6">
                    <div class="course-block style-5">
                        <div class="course-img">
                            <img src="assets/images/course/course2.jpg" alt="" class="img-fluid">
                        </div>

                        <div class="course-content">
                            <div class="course-price ">$150</div>

                            <div class="rating">
                                <a href="#"><i class="fa fa-star"></i></a>
                                <a href="#"><i class="fa fa-star"></i></a>
                                <a href="#"><i class="fa fa-star"></i></a>
                                <a href="#"><i class="fa fa-star"></i></a>
                                <a href="#"><i class="fa fa-star"></i></a>
                                <span>(5.00)</span>
                            </div>
                            <h4><a href="<?=$mainlink?>course_single">Photography Crash Course for Photographer</a></h4>

                            <div class="course-meta">
                                <span class="course-student"><i class="bi bi-group"></i>57 Students</span>
                                <span class="course-duration"><i class="bi bi-badge3"></i>16 Lessons</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="course-item cat5 cat2 col-lg-4 col-md-6">
                    <div class="course-block style-5">
                        <div class="course-img">
                            <img src="assets/images/course/course3.jpg" alt="" class="img-fluid">
                        </div>

                        <div class="course-content">
                            <div class="course-price ">$150</div>

                            <div class="rating">
                                <a href="#"><i class="fa fa-star"></i></a>
                                <a href="#"><i class="fa fa-star"></i></a>
                                <a href="#"><i class="fa fa-star"></i></a>
                                <a href="#"><i class="fa fa-star"></i></a>
                                <a href="#"><i class="fa fa-star"></i></a>
                                <span>(5.00)</span>
                            </div>
                            <h4><a href="<?=$mainlink?>course_single">Information About UI/UX Design Degree</a></h4>

                            <div class="course-meta">
                                <span class="course-student"><i class="bi bi-group"></i>57 Students</span>
                                <span class="course-duration"><i class="bi bi-badge3"></i>16 Lessons</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>

<section class="pb-100 course-grid">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-7">
                <div class="section-heading center-heading">
                    <span class="subheading">Top Trending Courses</span>
                    <h3>Over 200+ New Online Courses</h3>
                </div>
            </div>
        </div>

        <div class="text-center">
            <ul class="course-filter">
                <li class="active"><a href="#" data-filter="*"> All</a></li>
                <li class=""><a href="#" data-filter=".cat1">printing</a></li>
                <li class=""><a href="#" data-filter=".cat2">Web</a></li>
                <li><a href="#" data-filter=".cat3">illustration</a></li>
                <li><a href="#" data-filter=".cat4">media</a></li>
                <li class=""><a href="#" data-filter=".cat5">crafts</a></li>
            </ul>
        </div>

        <div class="row course-gallery " style="position: relative; height: 634px;">
            <div class="course-item cat1 cat3 col-lg-4 col-md-6" style="position: absolute; left: 0px; top: 0px;">
                <div class="course-block">
                    <div class="course-img">
                        <img src="assets/images/course/course3.jpg" alt="" class="img-fluid">
                        <span class="course-label">Expert</span>
                    </div>

                    <div class="course-content">
                        <div class="course-price ">$100 <span class="del">$180</span></div>

                        <h4><a href="<?=$mainlink?>course_single">React – The Complete Guide (React Router)</a></h4>
                        <div class="rating">
                            <a href="#"><i class="fa fa-star"></i></a>
                            <a href="#"><i class="fa fa-star"></i></a>
                            <a href="#"><i class="fa fa-star"></i></a>
                            <a href="#"><i class="fa fa-star"></i></a>
                            <a href="#"><i class="fa fa-star"></i></a>
                            <span>(5.00)</span>
                        </div>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quis, alias.</p>

                        <div class="course-footer d-lg-flex align-items-center justify-content-between">
                            <div class="course-meta">
                                <span class="course-student"><i class="bi bi-group"></i>340</span>
                                <span class="course-duration"><i class="bi bi-badge3"></i>82 Lessons</span>
                            </div>

                            <div class="buy-btn"><a href="#" class="btn btn-main-2 btn-small">Details</a></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="course-item cat2 cat4 col-lg-4 col-md-6" style="position: absolute; left: 380px; top: 0px;">
                <div class="course-block">
                    <div class="course-img">
                        <img src="assets/images/course/course2.jpg" alt="" class="img-fluid">
                        <span class="course-label">Advanced</span>
                    </div>

                    <div class="course-content">
                        <div class="course-price ">$80 <span class="del">$120</span></div>

                        <h4><a href="<?=$mainlink?>course_single">Photography Crash Course for Photographer</a></h4>
                        <div class="rating">
                            <a href="#"><i class="fa fa-star"></i></a>
                            <a href="#"><i class="fa fa-star"></i></a>
                            <a href="#"><i class="fa fa-star"></i></a>
                            <a href="#"><i class="fa fa-star"></i></a>
                            <a href="#"><i class="fa fa-star"></i></a>
                            <span>(5.00)</span>
                        </div>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quis, alias.</p>

                        <div class="course-footer d-lg-flex align-items-center justify-content-between">
                            <div class="course-meta">
                                <span class="course-student"><i class="bi bi-group"></i>340</span>
                                <span class="course-duration"><i class="bi bi-badge3"></i>82 Lessons</span>
                            </div>

                            <div class="buy-btn"><a href="#" class="btn btn-main-2 btn-small">Details</a></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="course-item cat5 cat2 col-lg-4 col-md-6" style="position: absolute; left: 760px; top: 0px;">
                <div class="course-block">
                    <div class="course-img">
                        <img src="assets/images/course/course1.jpg" alt="" class="img-fluid">
                        <span class="course-label">Beginner</span>
                    </div>

                    <div class="course-content">
                        <div class="course-price ">$50</div>

                        <h4><a href="<?=$mainlink?>course_single">Information About UI/UX Design Degree</a></h4>
                        <div class="rating">
                            <a href="#"><i class="fa fa-star"></i></a>
                            <a href="#"><i class="fa fa-star"></i></a>
                            <a href="#"><i class="fa fa-star"></i></a>
                            <a href="#"><i class="fa fa-star"></i></a>
                            <a href="#"><i class="fa fa-star"></i></a>
                            <span>(5.00)</span>
                        </div>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quis, alias.</p>

                        <div class="course-footer d-lg-flex align-items-center justify-content-between">
                            <div class="course-meta">
                                <span class="course-student"><i class="bi bi-group"></i>340</span>
                                <span class="course-duration"><i class="bi bi-badge3"></i>82 Lessons</span>
                            </div>

                            <div class="buy-btn"><a href="#" class="btn btn-main-2 btn-small">Details</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--course-->


    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav class="blog-pagination text-center">
                    <ul>
                        <li class="page-num active"><a href="#">1</a></li>
                        <li class="page-num"><a href="#">2</a></li>
                        <li class="page-num"><a href="#">3</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</section>

<?php
include("includes/footer.php");
?>