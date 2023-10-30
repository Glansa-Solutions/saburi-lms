<?php 
include("./core/init.php");
?>


<!DOCTYPE html>
<html lang="zxx">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="description" content="edutim,coaching, distant learning, education html, health coaching, kids education, language school, learning online html, live training, online courses, online training, remote training, school html theme, training, university html, virtual training  ">
  
  <meta name="author" content="themeturn.com">

  <title>Edutim- Education LMS template</title>

  <!-- Mobile Specific Meta-->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- bootstrap.min css -->
  <link rel="stylesheet" href="assets/vendors/bootstrap/bootstrap.css">
  <!-- Iconfont Css -->
  <link rel="stylesheet" href="assets/vendors/fontawesome/css/all.css">
  <link rel="stylesheet" href="assets/vendors/bicon/css/bicon.min.css">
  <link rel="stylesheet" href="assets/vendors/themify/themify-icons.css">
  <!-- animate.css -->
  <link rel="stylesheet" href="assets/vendors/animate-css/animate.css">
  <!-- WooCOmmerce CSS -->
  <link rel="stylesheet" href="assets/vendors/woocommerce/woocommerce-layouts.css">
  <link rel="stylesheet" href="assets/vendors/woocommerce/woocommerce-small-screen.css">
  <link rel="stylesheet" href="assets/vendors/woocommerce/woocommerce.css">
   <!-- Owl Carousel  CSS -->
  <link rel="stylesheet" href="assets/vendors/owl/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="assets/vendors/owl/assets/owl.theme.default.min.css">

  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/responsive.css">

</head>

<body id="top-header">

  

    
<header>
    <div class="header-top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <ul class="header-contact">
                        <li>
                            <span>Call :</span>
                           +7780290335
                        </li>
                        <li>
                            <span>Email :</span>
                            info@saburilms.com
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="header-right float-right">
                        <div class="header-socials">
                            <ul>
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fab fa-pinterest"></i></a></li>
                            </ul>
                        </div>
                        <div class="header-btn">
                            <a href="<?= $mainlink?>log_reg.php" class="btn btn-main btn-small"><i class="fa fa-user mr-2"></i>Login / Register</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>

    <!-- Main Menu Start -->
   
    <div class="site-navigation main_menu " id="mainmenu-area">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="index.html" style="width:20%;">
                    <img src="assets/images/saburi.png" alt="Edutim" class="img-fluid w-50">
                </a>

                <!-- Toggler -->

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="fa fa-bars"></span>
                </button>

                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="navbarMenu">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link js-scroll-trigger" href="<?=$mainlink?>web">
                                Home
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="<?=$mainlink?>about" class="nav-link js-scroll-trigger">
                                About us
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link js-scroll-trigger" href="<?=$mainlink?>courses">
                                Course List
                            </a>
                            <!-- <div class="dropdown-menu" aria-labelledby="navbar3">
                                <a class="dropdown-item " href="course-grid.html">
                                   Course Style 1
                               </a>
                               <a class="dropdown-item " href="course-grid-2.html">
                                   Course Style 2
                               </a> 

                               <a class="dropdown-item " href="course-grid-3.html">
                                   Course Style 3
                               </a> 
                               <a class="dropdown-item " href="course-grid-4.html">
                                   Course Style 4
                               </a> 
                               <a class="dropdown-item " href="course-grid-5.html">
                                   Course Filter
                               </a>
                               <a class="dropdown-item " href="course-grid-6.html">
                                   Course List
                               </a>
                                <a class="dropdown-item " href="course-single.html">
                                   Course Details Style 1
                               </a> 
                               <a class="dropdown-item " href="course-single2.html">
                                   Course Details Style Tab
                               </a> 
                               <a class="dropdown-item " href="course-single3.html">
                                   Course Details Style Tab2
                               </a> 
                               <a class="dropdown-item " href="course-single4.html">
                                   Course Details Classic
                               </a> 
                            </div> -->
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link js-scroll-trigger" href="<?=$mainlink?>blogs" >
                                Blogs
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#">
                                Our Goals
                            </a>
                        </li>
                        
                        <li class="nav-item ">
                            <a href="contact.html" class="nav-link">
                                Affiliated
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="<?= $mainlink?>contact" class="nav-link">
                                Contact Us
                            </a>
                        </li>
                        
                    </ul>

                    <ul class="header-contact-right d-none d-lg-block">
                        <li> <a href="#" class="header-cart"><i class="fa fa-shopping-cart"></i></a></li>
                        <li><a href="#" class="header-search search_toggle"> <i class="fa fa fa-search"></i></a></li>
                    </ul>
                   
                </div> <!-- / .navbar-collapse -->
            </div> <!-- / .container -->
        </nav>
    </div>
</header>