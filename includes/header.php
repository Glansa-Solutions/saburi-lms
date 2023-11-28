<?php
session_start();
// include("./core/init.php");
include("./core/login_register.php");
include("./core/authFunctions.php");
include("./core/blogsFunction.php");
include("./core/homeFunction.php");
include("./core/functions.php");
include("./core/listgrid.php");
include("./core/allmailfun.php");
include("./core/testimonials.php");

// include("./core/login_register.php");
// include("./core/login_register.php");
if($fetch_user_contact_details_query)
{
    while($fetch_user_contact_details_result = mysqli_fetch_assoc($fetch_user_contact_details_query))
    {
        $contact_id = $fetch_user_contact_details_result["id"];
        $contact_email = $fetch_user_contact_details_result["email"];
        $contact_phone = $fetch_user_contact_details_result["phone_no"];
        $contact_address = $fetch_user_contact_details_result["address"];
    }
}

// Check if the session variables are set
if (isset($_SESSION['role_id']) && isset($_SESSION['role'])) {
    $role_id = $_SESSION['role_id'];
    $role = $_SESSION['role'];

    // Check if testimonials exist for the current user
    $existing_testimonial_query = mysqli_query($con, "SELECT * FROM testinomonials WHERE subscribedBy='$role' AND subscribedId='$role_id'");
    $existing_testimonial = mysqli_fetch_assoc($existing_testimonial_query);

    $hide_add_testimonial_link = $existing_testimonial ? true : false;
} else {
    // If session variables are not set, set default values or handle it accordingly
    $role_id = null;
    $role = null;
    $hide_add_testimonial_link = false;
}

// Now you can use $role_id and $role without causing undefined variable errors

?>


<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="description"
        content="edutim,coaching, distant learning, education html, health coaching, kids education, language school, learning online html, live training, online courses, online training, remote training, school html theme, training, university html, virtual training  ">

    <meta name="author" content="themeturn.com">

    <title>Saburi LMS</title>

    <!-- Mobile Specific Meta-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
    <!-- <script src="./js/jquery-3.6.0.min.js"></script> -->
    <!-- Swal -->
    
</head>
<style>
    /* Hide the default number input arrows in Chrome, Safari, and Edge */
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Hide the default number input arrows in Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }

    #quantity {
        border: 1px solid #E9770E;
    }

    .btn_incr:hover,
    .btn_decr:hover {
        padding: 0px 20px;
        background-color: #213975;
        color: #ffff;
    }

    .btn_incr,
    .btn_decr {
        padding: 0px 20px;
        background-color: #E9770E;
        color: #ffff;
    }

    .quantity {
        width: 50%;
    }

    .product-quantity {
        display: flex;
        align-items: center;
    }

    .quantity-input {
        width: 50px;
        /* Adjust the width as needed */
        text-align: center;
        border: 1px solid #ccc;
        /* Adjust the border color as needed */
        /* margin-right: -1px; Adjust the negative margin as needed */
    }

    .quantity-button {
        padding: 5px;
        width: 45px;
        height: 30px;
        cursor: pointer;
        border: 1px solid #ccc;
        background-color: #E9770E;
        margin: 0px;
        color: #fff;
        /* Add text color to make it visible */
    }

    .course-size {
        font-size: 20px;

    }

    .course_name {
        font-size: 30px;
    }

    .fas {
        color: #E9770E;
    }
</style>

<body id="top-header">
    <header>
        <div class="header-top">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6">
                        <ul class="header-contact">
                            <li>
                                <span>Call :</span>
                               <?= $contact_phone;?>
                            </li>
                            <li>
                                <span>Email :</span>
                                <?= $contact_email; ?>
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
                                <a href="<?= $mainlink ?>log_reg" class="btn btn-main btn-small"><i
                                        class="fa fa-user mr-2"></i>Login / Register</a>
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

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMenu"
                        aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="fa fa-bars"></span>
                    </button>

                    <!-- Collapse -->
                    <div class="collapse navbar-collapse" id="navbarMenu">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link js-scroll-trigger" href="<?= $mainlink ?>">
                                    Home
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link js-scroll-trigger" href="#">
                                    Company
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbar3">
                                    <a class="dropdown-item " href="<?= $mainlink ?>about">
                                        About
                                    </a>
                                    <a class="dropdown-item " href="<?= $mainlink ?>corporateGovernance">
                                        Governance
                                    </a>

                                    <a class="dropdown-item " href="<?= $mainlink ?>career">
                                        Careers
                                    </a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link js-scroll-trigger" href="<?= $mainlink ?>courselist">
                                    Courses
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link js-scroll-trigger" href="<?= $mainlink ?>blogs">
                                    Blogs
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#">
                                    Our Goals
                                </a>
                            </li>

                            <!-- <li class="nav-item ">
                                <a href="contact.html" class="nav-link">
                                    Affiliated
                                </a>
                            </li> -->
                            <li class="nav-item ">
                                <a href="<?= $mainlink ?>contact" class="nav-link">
                                    Contact Us
                                </a>
                            </li>

                        </ul>

                        <ul class="header-contact-right d-none d-lg-block">
                            <li>
                                <a href="<?= $mainlink ?>cart" id="cart-link" class="header-cart">
                                    <i class="fa fa-shopping-cart"></i>
                                    <!-- Inside your header.php -->
                                    <span id="cart-count-container">
                                        <span id="cart-count">0</span>
                                    </span>
                                </a>
                            </li>
                            <!-- <li><a href="#" class="header-search search_toggle"> <i class="fa fa fa-search"></i></a>
                            </li> -->
                        </ul>
                        <?php if (!empty($_SESSION['role_id'])) {
                            $visibility = "visible";
                        } else {
                            $visibility = "none";
                        } ?>
                        <ul style="display:<?= $visibility;?>">
                            <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                                <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <img class="img-xs rounded-circle" src="assets/images/profile_img/student.png"
                                        height="50px" width="50px" alt="Profile image"> </a>
                                <!-- <img src="assets/images/saburi.png" alt="Edutim" class="img-fluid w-50" > -->

                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                                    aria-labelledby="UserDropdown">
                                    <div class="dropdown-header text-center">
                                        <!-- <img src="assets/images/saburi.png" alt="Edutim" class="img-fluid w-50" height="50px" width="50px"> -->
                                        <img class="img-md rounded-circle" src="assets/images/profile_img/student.png"
                                            height="50px" width="50px" alt="Profile image">
                                        <p class="mb-1 mt-3 font-weight-semibold">Hi<span>&nbsp</span>
                                            <?= $fullName; ?>

                                        </p>
                                        <p class="fw-light text-muted mb-0">
                                            <?= $email; ?>
                                        </p>
                                    </div>
                                    <a class="dropdown-item" href="<?= $mainlink ?>profile"><i
                                            class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My
                                        Profile
                                        <!-- <span class="badge badge-pill badge-danger">1</span></a> -->
                                        <a href="<?= $mainlink ?>myOrders" class="dropdown-item"><i
                                                class="dropdown-item-icon mdi mdi-message-text-outline text-primary me-2"></i>
                                            My Orders</a>
                                        <a class="dropdown-item"><i
                                                class="dropdown-item-icon mdi mdi-calendar-check-outline text-primary me-2"></i>
                                            My Active Courses</a>
                                        <a href="<?= $mainlink ?>changepassword?role_id=<?= $_SESSION['role_id'];?>&role=<?= $_SESSION['role'];?>"class="dropdown-item"><i
                                                class="dropdown-item-icon mdi mdi-help-circle-outline text-primary me-2"></i>
                                            Change Password</a>
                                            <a href="<?= $mainlink ?>testimonials?role_id=<?= $_SESSION['role_id']; ?>&role=<?= $_SESSION['role']; ?>"
                                                class="dropdown-item<?= $hide_add_testimonial_link ? ' d-none' : ''; ?>">
                                                <i class="dropdown-item-icon mdi mdi-help-circle-outline text-primary me-2"></i> Add Testimonial
                                            </a>
                                        <a class="dropdown-item" href="<?= $mainlink ?>logout_session"><i
                                                class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign
                                            Out</a>
                                </div>
                            </li>
                        </ul>

                    </div> <!-- / .navbar-collapse -->
                </div> <!-- / .container -->
            </nav>
        </div>
    </header>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // <!-- This is your HTML for displaying the cart count -->


        document.addEventListener('DOMContentLoaded', function () {
            function updateCartCount() {
                const cartJSON = localStorage.getItem('cart');
                const cartItems = JSON.parse(cartJSON) || [];
                const cartCount = cartItems.length;
                const cartCountContainer = document.getElementById('cart-count');
                cartCountContainer.textContent = cartCount;
            }

            updateCartCount();
        });
    </script>