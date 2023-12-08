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

<section class="banner">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-8">
                <div class="banner-content center-heading">
                    <span class="subheading">
                        <?= $banner_title ?>
                    </span>
                    <h1>
                        <?= $banner_Description ?>
                    </h1>
                    <a href="<?=$mainlink ?>courselist" class="btn btn-main"><i class="fa fa-list-ul mr-2"></i>our Courses </a>
                    <a href="<?=$mainlink ?>courselist" class="btn btn-tp ">get Started <i class="fa fa-angle-right ml-2"></i></a>
                </div>
            </div>
        </div> <!-- / .row -->
    </div> <!-- / .container -->
</section>


<section class="feature">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-lg-4 col-md-6">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="bi bi-badge2"></i>
                    </div>
                    <div class="feature-text">
                        <h4>Learn from Industry Experts</h4>
                        <p>Behind the word mountains, far from the countries Vokalia </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="bi bi-article"></i>
                    </div>
                    <div class="feature-text">
                        <h4>Learn the Latest Top Skills</h4>
                        <p>Behind the word mountains, far from the countries Vokalia </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="bi bi-headset"></i>
                    </div>
                    <div class="feature-text">
                        <h4>Lifetime Access & Support</h4>
                        <p>Behind the word mountains, far from the countries Vokalia </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--course section start-->
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
                <?php
                $counter = 0;
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<li><a href="#" data-filter=".' . $row['id'] . '">' . $row['subTopicName'] . '</a></li>';
                        $counter++;  // Increment the counter
                        if ($counter >= 6)
                            break;
                    }
                } else {
                    echo '<p>No Subtopics found.</p>';
                }
                ?>
            </ul>
        </div>



        <div class="row course-gallery ">
            <?php
            $counter = 0;

            if ($allCourses->num_rows > 0):
                while ($row = $allCourses->fetch_assoc()):
                    ?>
                    <div class="course-item <?php echo $row['subTopicId']; ?> col-lg-4 col-md-6">
                        <div class="course-block">
                            <div class="course-img" style="width: auto;" height="300px;">
                                <img src="./uploads/images/<?php echo $row['bannerImage']; ?>" alt="" class="img-fluid">
                                <!-- <span class="course-label">Expert</span> -->
                            </div>
                            <div class="course-content">
                                <div class="course-price ">₹
                                    <?php echo $row['courseCost']; ?>
                                </div>
                                <h4><a href="course_single?course_id=<?php echo $row['id']; ?>">
                                        <?php echo $row['courseName']; ?>
                                    </a></h4>
                                <!-- <div class="rating">
                                    <?php for ($i = 0; $i < 5; $i++): ?>
                                        <a href="#"><i class="fa fa-star"></i></a>
                                    <?php endfor; ?>
                                    <span>(5.00)</span>
                                </div> -->
                                <p>
                                    <?php echo substr($row['courseDesc'], 0, 100); ?>...
                                </p>
                                <div class="course-footer d-lg-flex align-items-center justify-content-between">
                                    <!-- <div class="course-meta">
                                        <span class="course-student"><i class="bi bi-group"></i>340</span>
                                        <span class="course-duration"><i class="bi bi-badge3"></i>82 Lessons</span>
                                    </div> -->
                                    <div class="buy-btn"><a href="course_single?course_id=<?php echo $row['id']; ?>"
                                            class="btn btn-main-2 btn-small">Details</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $counter++;
                    if ($counter >= 6)
                        break;
                endwhile;
            else:
                echo '<p>No Courses found.</p>';
            endif;
            ?>

        </div>
    </div>
    <!--course-->
</section>
<!--course section end-->
<section class="feature-2">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-lg-3 col-md-6">
                <div class="feature-item feature-style-2">
                    <div class="feature-icon">
                        <i class="bi bi-badge2"></i>
                    </div>
                    <div class="feature-text">
                        <h4>Expert Teacher</h4>
                        <p>Behind the word mountains, far from the countries</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="feature-item feature-style-2">
                    <div class="feature-icon">
                        <i class="bi bi-article"></i>
                    </div>
                    <div class="feature-text">
                        <h4>Quality Education</h4>
                        <p>Behind the word mountains, far from the countries </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="feature-item feature-style-2">
                    <div class="feature-icon">
                        <i class="bi bi-headset"></i>
                    </div>
                    <div class="feature-text">
                        <h4>Life Time Support</h4>
                        <p>Behind the word mountains, far from the countries</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="feature-item feature-style-2">
                    <div class="feature-icon">
                        <i class="bi bi-rocket2"></i>
                    </div>
                    <div class="feature-text">
                        <h4>HD Video</h4>
                        <p>Behind the word mountains, far from the countries</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section-padding category-section">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-6">
                <div class="section-heading center-heading">
                    <span class="subheading">Top Categories</span>
                    <h3>Our Top Categories</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicin gelit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua.</p>
                </div>
            </div>
        </div>

        <div class="row no-gutters">
            <div class="col-lg-3 col-md-6">
                <div class="course-category style-1">
                    <div class="category-icon">
                        <i class="bi bi-laptop"></i>
                    </div>
                    <h4><a href="#">Digital Training</a></h4>
                    <p>4 Courses</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="course-category style-2">
                    <div class="category-icon">
                        <i class="bi bi-layer"></i>
                    </div>
                    <h4><a href="#">Classroom Management</a></h4>
                    <p>12 Courses</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="course-category style-3">
                    <div class="category-icon">
                        <i class="bi bi-target-arrow"></i>
                    </div>
                    <h4><a href="#">Differentiated Instruction</a></h4>
                    <p>6 Courses</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="course-category style-4">
                    <div class="category-icon">
                        <i class="bi bi-rocket2"></i>
                    </div>
                    <h4><a href="#">Educational Technology</a></h4>
                    <p>6 Courses</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="course-category style-2">
                    <div class="category-icon">
                        <i class="bi bi-shield"></i>
                    </div>
                    <h4><a href="#">Teamwork</a></h4>
                    <p>12 Courses</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="course-category style-1">
                    <div class="category-icon">
                        <i class="bi bi-slider-range"></i>
                    </div>
                    <h4><a href="#">Time Management</a></h4>
                    <p>4 Courses</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="course-category style-4">
                    <div class="category-icon">
                        <i class="bi bi-bulb"></i>
                    </div>
                    <h4><a href="#">Teamwork</a></h4>
                    <p>6 Courses</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="course-category style-3">
                    <div class="category-icon">
                        <i class="bi bi-android"></i>
                    </div>
                    <h4><a href="#">Time Management</a></h4>
                    <p>6 Courses</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="text-center mt-5">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. </p>
                    <div class="course-btn mt-4"><a href="#" class="btn btn-main"><i
                                class="fa fa-grip-horizontal mr-2"></i>All Categories</a></div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="about-section section-padding about-2">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-12">
                <div class="about-img2">
                    <img src="assets/images/about/<?= $about_banner_name ?>" alt="" class="img-fluid">
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="section-heading">
                    <span class="subheading">About Us</span>
                    <h3><?= $about_title;?></h3>
                </div>

                <p><?= $about_Description?></p>

                <a href="<?= $mainlink?>about" class="btn btn-main"><i class="fa fa-check mr-2"></i>Learn More</a>

            </div>
        </div>
    </div>
</section>

<!--course section start-->
<section class="section-padding video-section">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-6">
                <div class="section-heading text-center center-heading">
                    <span class="subheading">Working Process</span>
                    <h3>Watch video to know more about us</h3>
                </div>
            </div>
        </div>

        <div class="row align-items-center justify-content-center">
            <div class="col-lg-10">
                <div class="video-block">
                    <img src="assets/images/bg/office01.jpg" alt="" class="img-fluid">
                    <a href="#" class="video-icon"><i class="fa fa-play"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!--course-->
</section>
<!--course section end-->
<section class="about-section section-padding">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-12">
                <div class="about-img">
                    <img src="assets/images/bg/2-2.png" alt="" class="img-fluid">
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="section-heading">
                    <span class="subheading">Top Categories</span>
                    <h3>Learn new skills to go ahead for your career</h3>
                </div>

                <div class="about-content">
                    <div class="about-text-block">
                        <i class="bi bi-film"></i>
                        <h4>Details Video tutorial</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicin gelit</p>
                    </div>

                    <div class="about-text-block">
                        <i class="bi bi-support"></i>
                        <h4>World Class Support</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicin gelit</p>
                    </div>

                    <a href="#" class="btn btn-main-2"><i class="fa fa-check mr-2"></i>more About Support</a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section-padding popular-course bg-grey">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="section-heading">
                    <span class="subheading">Top Trending Courses</span>
                    <h3>Our Popular Online Courses</h3>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="course-btn text-lg-right"><a href="#" class="btn btn-main"><i
                            class="fa fa-store mr-2"></i>All Courses</a></div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="course-block">
                    <div class="course-img">
                        <img src="assets/images/course/course1.jpg" alt="" class="img-fluid">
                        <span class="course-label">Beginner</span>
                    </div>

                    <div class="course-content">
                        <div class="course-price ">₹500</div>

                        <h4><a href="#">Creating a Positive Learning Environment</a></h4>
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
            <div class="col-lg-4 col-md-6">
                <div class="course-block">
                    <div class="course-img">
                        <img src="assets/images/course/course2.jpg" alt="" class="img-fluid">
                        <span class="course-label">Advanced</span>
                    </div>

                    <div class="course-content">
                        <div class="course-price ">₹800 <span class="del">₹1200</span></div>

                        <h4><a href="#">Creating a Positive Learning Environment</a></h4>
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
            <div class="col-lg-4 col-md-6">
                <div class="course-block">
                    <div class="course-img">
                        <img src="assets/images/course/course3.jpg" alt="" class="img-fluid">
                        <span class="course-label">Expert</span>
                    </div>

                    <div class="course-content">
                        <div class="course-price ">₹1000 <span class="del">₹1800</span></div>

                        <h4><a href="#">Creating a Positive Learning Environment</a></h4>
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
</section>
<section class="counter-wrap mt--105">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 counter-inner">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="counter-item">
                            <i class="ti-desktop"></i>
                            <div class="count">
                                <span class="counter h2">90</span>
                            </div>
                            <p>Expert Instructors</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="counter-item">
                            <i class="ti-agenda"></i>
                            <div class="count">
                                <span class="counter h2">1450</span>
                            </div>
                            <p>Total Courses</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="counter-item">
                            <i class="ti-heart"></i>
                            <div class="count">
                                <span class="counter h2">5697</span>
                            </div>
                            <p>Happy Students</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="counter-item">
                            <i class="ti-microphone-alt"></i>
                            <div class="count">
                                <span class="counter h2">24</span>
                            </div>
                            <p>Creative Events</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="testimonial section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-heading center-heading text-center">
                    <span class="subheading">Testimonials</span>
                    <h3>Learn New Skills to Go Ahead for Your Career</h3>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="testimonials-slides owl-carousel owl-theme">
                    <?php
                    if ($fetch_testimonial_sql) {
                        // Loop through the fetched testimonials
                        while ($row = $fetch_testimonial_sql->fetch_assoc()) {
                            ?>
                            <div class="review-item">

                                <div class="client-info">
                                    <div class="title">
                                        <b><span class="title">
                                                <?php echo $row['title']; ?>
                                            </span></b>
                                    </div>
                                    <i class="bi bi-quote"></i>
                                    <p>
                                        <?php echo $row['description']; ?>
                                    </p>

                                </div>
                                <div class="client-desc">
                                    <div class="client-img">
                                        <img src="assets/images/profile_img/<?php echo ($row['subscribedBy'] == 'students') ? $row['profile_img'] : $row['profile']; ?>"
                                            alt="" class="img-fluid">
                                    </div>
                                    <div class="client-text">
                                        <h4>
                                            <?php echo ($row['subscribedBy'] == 'students') ? $row['name'] : $row['companyName']; ?>
                                        </h4>
                                        <!-- <span class="designation"><?php echo $row['designation']; ?></span> -->
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section-padding offer-course">
    <div class="container">
        <div class="row ">
            <div class="col-lg-4">
                <div class="section-heading">
                    <span class="subheading">50% Discount offer</span>
                    <h3>Hurry Up to get <span>50% off</span> courses</h3>
                    <p>Eum eligendi nihil labore nemo alias eos sapiente perferendis iste molestias explicabo.tempor
                        incididunt ut labore et dolore magna aliqua tempor incididunt. </p>
                    <a href="#" class="btn btn-main"><i class="fa fa-store mr-2"></i>All Courses</a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="course-block">
                    <div class="course-img">
                        <img src="assets/images/course/course1.jpg" alt="" class="img-fluid">
                        <span class="course-label">Beginner</span>
                    </div>

                    <div class="course-content">
                        <div class="rating">
                            <a href="#"><i class="fa fa-star"></i></a>
                            <a href="#"><i class="fa fa-star"></i></a>
                            <a href="#"><i class="fa fa-star"></i></a>
                            <a href="#"><i class="fa fa-star"></i></a>
                            <a href="#"><i class="fa fa-star"></i></a>
                            <span>(5.00)</span>
                        </div>
                        <h4><a href="#">Creating a Positive Learning Environment</a></h4>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quis, alias.</p>
                        <div class="course-price ">₹50</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="course-block">
                    <div class="course-img">
                        <img src="assets/images/course/course2.jpg" alt="" class="img-fluid">
                        <span class="course-label">Advanced</span>
                    </div>

                    <div class="course-content">
                        <div class="rating">
                            <a href="#"><i class="fa fa-star"></i></a>
                            <a href="#"><i class="fa fa-star"></i></a>
                            <a href="#"><i class="fa fa-star"></i></a>
                            <a href="#"><i class="fa fa-star"></i></a>
                            <a href="#"><i class="fa fa-star"></i></a>
                            <span>(5.00)</span>
                        </div>
                        <h4><a href="#">Creating a Positive Learning Environment</a></h4>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quis, alias.</p>
                        <div class="course-price ">₹80 <span class="del">₹120</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="blog section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-heading center-heading">
                    <span class="subheading">Blog News</span>
                    <h3>Latest Blog & News</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicin gelit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua.</p>
                </div>
            </div>
        </div>

        <div class="row">
            <?php
            if ($blogs->num_rows > 0) {
                while ($row = $blogs->fetch_assoc()): ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="blog-item">
                            <img src="assets/images/blog/<?php echo $row['bannerImage']; ?>" alt="loading.." class="img-fluid">
                            <div class="blog-content">
                                <div class="entry-meta">
                                    <span><i class="fa fa-calendar-alt"></i>
                                        <?php echo date('M j, Y', strtotime($row['createdOn'])); ?>
                                    </span>
                                    <span><i class="fa fa-pen"></i>
                                        <?php echo $row['writer']; ?>
                                    </span>
                                </div>
                                <h2><a href="#">
                                        <?php echo $row['blogTitle']; ?>
                                    </a></h2>
                                <p>
                                    <?php echo substr($row['description'], 0, 100) . '...'; ?>
                                </p>
                                <a href="<?php echo $mainlink . 'blog_single/' . $row['writer']; ?>"
                                    class="btn btn-main btn-small">
                                    <i class="fa fa-plus-circle mr-2"></i>Read More
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endwhile;
            } else {
                echo '<p>No blog posts found.</p>';
            }
            ?>
        </div>


    </div>
    </div>
</section>

<?php
include("includes/footer.php");
?>