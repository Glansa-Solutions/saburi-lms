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
                    <h1>Careers</h1>
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="list-inline-item">/</li>
                        <li class="list-inline-item">
                            Careers
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section-padding course-grid">
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
                <li><a href="#" data-filter=".cat1">Classroom Management</a></li>
                <li><a href="#" data-filter=".cat2">Inclusive Education</a></li>
                <li><a href="#" data-filter=".cat3">Problem-Solving</a></li>
                <li><a href="#" data-filter=".cat4">Teamwork</a></li>
                <li><a href="#" data-filter=".cat5">Teching new tech</a></li>
            </ul>
        </div>

        <div class="row course-gallery ">
            <div class="course-item cat1 cat3 col-lg-4 col-md-6">
                <div class="course-block">
                    <div class="course-img">
                        <img src="assets/images/course/course3.jpg" alt="" class="img-fluid">
                    </div>

                    <div class="course-content">

                        <h4><a href="#">Creating a Positive Learning Environment</a></h4>

                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quis, alias.</p>

                        <div class="course-footer d-lg-flex align-items-center ">


                            <div class="buy-btn"><a href="<?= $mainlink ?>careerName"
                                    class="btn btn-main-2 btn-small">Apply</a></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="course-item cat2 cat4 col-lg-4 col-md-6">
                <div class="course-block">
                    <div class="course-img">
                        <img src="assets/images/course/course2.jpg" alt="" class="img-fluid">
                    </div>

                    <div class="course-content">

                        <h4><a href="#">Creating a Positive Learning Environment</a></h4>

                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quis, alias.</p>

                        <div class="course-footer d-lg-flex align-items-center ">

                            <div class="buy-btn"><a href="<?= $mainlink ?>careerName"
                                    class="btn btn-main-2 btn-small">Apply</a></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="course-item cat5 cat2 col-lg-4 col-md-6">
                <div class="course-block">
                    <div class="course-img">
                        <img src="assets/images/course/course1.jpg" alt="" class="img-fluid">
                    </div>

                    <div class="course-content">

                        <h4><a href="#">Creating a Positive Learning Environment</a></h4>

                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quis, alias.</p>

                        <div class="course-footer d-lg-flex align-items-center ">


                            <div class="buy-btn"><a href="<?= $mainlink ?>careerName"
                                    class="btn btn-main-2 btn-small">Apply</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--course-->
</section>
<?php
include("includes/footer.php");
?>