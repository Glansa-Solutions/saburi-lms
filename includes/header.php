<?php
session_start();
$filename = pathinfo(basename($_SERVER['SCRIPT_NAME']), PATHINFO_FILENAME);
include("./core/login_register.php");
include("./core/authFunctions.php");
include("./core/blogsFunction.php");
include("./core/homeFunction.php");
include("./core/functions.php");
include("./core/listgrid.php");
include("./core/allmailfun.php");
include("./core/testimonials.php");

if ($fetch_user_contact_details_query) {
    while ($fetch_user_contact_details_result = mysqli_fetch_assoc($fetch_user_contact_details_query)) {
        $contact_id = $fetch_user_contact_details_result["id"];
        $contact_email = $fetch_user_contact_details_result["email"];
        $contact_phone = $fetch_user_contact_details_result["phone_no"];
        $contact_address = $fetch_user_contact_details_result["address"];
    }
}
// if (!isset($_SESSION['role'])) {
//     // Set default role to "students"
//     $_SESSION['role'] = 'students';

//     // Redirect to the login page if not logged in
//     header("Location: $mainlink" . "log_reg");
//     exit();
// }
// Check if the session variables are set
if (isset($_SESSION['role_id']) && isset($_SESSION['role'])) {
    $role_id = $_SESSION['role_id'];
    $role = $_SESSION['role'];
    // Check if testimonials exist for the current user
    $existing_testimonial_query = mysqli_query($con, "SELECT * FROM testinomonials WHERE subscribedBy='$role' AND subscribedId='$role_id'");
    $existing_testimonial = mysqli_fetch_assoc($existing_testimonial_query);

    $hide_add_testimonial_link = $existing_testimonial ? true : false;

    $fetch_mail_pass = mysqli_query($con, "SELECT email, password FROM `$role` WHERE id = $role_id");
    $row = mysqli_fetch_assoc($fetch_mail_pass);
    if ($fetch_mail_pass) {
        $_SESSION['mail'] = $row['email'];
        $_SESSION['pass'] = $row['password'];
        $roel_mail = $_SESSION['mail'];
        $role_pass = $_SESSION['pass'];

    } else {
        $roel_mail = "";
        $role_pass = "";
    }

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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Saburi LMS</title>

    <!-- Mobile Specific Meta-->
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- bootstrap.min css -->
    <link rel="stylesheet" href="assets/vendors/bootstrap/bootstrap.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
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
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <!-- <script src="./js/jquery-3.6.0.min.js"></script> -->
    <!-- Swal -->

</head>
<style>
    /* style for banner update */
    .banner {
        padding: 130px 0px;
        padding-bottom: 180px;
        background: url("./assets/images/home/<?= $banner_name; ?>");
        background-size: cover;
        position: relative;
    }

    /* style for banner update End */

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

    #pro {
        display: block;
        /* Set the initial display property according to your needs */
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Check if the URL contains "#login_con"
        if (window.location.href.includes("#login_con") || window.location.href.includes("#alert")) {
            // Hide the element with the id "pro"
            var proElement = document.getElementById("pro");
            if (proElement) {
                proElement.style.display = "none";
            }
        }
    });
</script>

<body id="top-header">
    <header>
        <div class="header-top">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6">
                        <ul class="header-contact">
                            <li>
                                <span>Call :</span>
                                <a href="tel: <?= $contact_phone; ?>">
                                    <?= $contact_phone; ?>
                                </a>
                            </li>
                            <li>
                                <span>Email :</span>
                                <a href="mailto: <?= $contact_email; ?>">
                                    <?= $contact_email; ?>
                                </a>
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
                            <?php $class = ($role == "" && $role_id == "") ? "" : "d-none"; ?>

                            <div class="header-btn <?= $class ?>">
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
                    <a class="navbar-brand" href="<?= $mainlink; ?>" style="width:20%;">
                        <img src="assets/images/saburi.png" alt="Edutim" class="img-fluid" style="width:50%">
                    </a>

                    <!-- Toggler -->

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMenu"
                        aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="fa fa-bars"></span>
                    </button>

                    <!-- Collapse -->
                    <div class="collapse navbar-collapse" id="navbarMenu">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link js-scroll-trigger" href="<?= $mainlink ?>">
                                    Home
                                </a>
                            </li>
                            <!-- <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Company
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">About Company</a>
                                    <a class="dropdown-item" href="#">Gallery</a>
                                </div>
                            </li> -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Company <i class="fa fa-caret-down"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
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
                            <li class="nav-item">
                                <?php if ($role == "companyusers") { ?>
                                    <a class="nav-link js-scroll-trigger" href="<?= $mainlink ?>myOrders">
                                        Courses
                                    </a>
                                <?php } else { ?>
                                    <a class="nav-link js-scroll-trigger" href="<?= $mainlink ?>courselist">
                                        Courses
                                    </a>
                                <?php } ?>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link js-scroll-trigger" href="<?= $mainlink ?>blogs">
                                    Blogs
                                </a>
                            </li>
                            <li class="nav-item">
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

                            <li>
                                <a href="<?= $mainlink ?>wishlist" id="cart-link" class="header-cart">
                                    <i class="fa fa-heart"></i>
                                    <!-- Inside your header.php -->
                                    <span id="wishlist-count-container">
                                        <?php
                                        if (isset($_SESSION['role']) && isset($_SESSION['role_id'])) {
                                            $role = $_SESSION['role'];
                                            $role_id = $_SESSION['role_id'];

                                            // Make sure to sanitize user inputs to prevent SQL injection
                                            $role = mysqli_real_escape_string($con, $role);
                                            $role_id = mysqli_real_escape_string($con, $role_id);

                                            $wishlist = mysqli_query($con, "SELECT count(*) as count FROM wishlist WHERE role = '$role' AND userId = $role_id");
                                            $wishlistcount = mysqli_fetch_array($wishlist);
                                            ?>
                                            <span id="wishlist-count">

                                            </span>
                                        <?php } ?>
                                    </span>


                                </a>
                            </li>
                            <!-- <li><a href="#" class="header-search search_toggle"> <i class="fa fa fa-search"></i></a>
                            </li> -->
                        </ul>
                        <?php if (!empty($_SESSION['role_id']) && !empty($_SESSION['role'])) {
                            $visibility = "visible";
                        } else {
                            $visibility = "none";
                        } ?>
                        <ul style="display:<?= $visibility; ?>" id="pro">
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
                                    <a class="dropdown-item <?= $style; ?>" href="<?= $mainlink ?>profile"><i
                                            class="dropdown-item-icon mdi mdi-account-outline text-primary me-2 "></i>My
                                        Profile
                                        <!-- <span class="badge badge-pill badge-danger">1</span></a> -->
                                        <a href="<?= $mainlink ?>myOrders" class="dropdown-item"><i
                                                class="dropdown-item-icon mdi mdi-message-text-outline text-primary me-2"></i>
                                            My Courses</a>
                                        <a href="<?= $mainlink ?>activeCourses?role_id=<?= $_SESSION['role_id']; ?>&role=<?= $_SESSION['role']; ?>"
                                            class="dropdown-item"><i
                                                class="dropdown-item-icon mdi mdi-calendar-check-outline text-primary me-2"></i>
                                            My Active Courses</a>
                                        <a href="<?= $mainlink ?>changepassword?role_id=<?= $_SESSION['role_id']; ?>&role=<?= $_SESSION['role']; ?>"
                                            class="dropdown-item <?= $style; ?>"><i
                                                class="dropdown-item-icon mdi mdi-help-circle-outline text-primary me-2"></i>
                                            Change Password</a>
                                        <a href="<?= $mainlink ?>testimonials?role_id=<?= $_SESSION['role_id']; ?>&role=<?= $_SESSION['role']; ?>"
                                            class="dropdown-item<?= $hide_add_testimonial_link ? ' d-none' : ''; ?> <?= $style; ?>">
                                            <i
                                                class="dropdown-item-icon mdi mdi-help-circle-outline text-primary me-2"></i>
                                            Add Testimonial
                                        </a>
                                        <a href="<?= $mainlink ?>companyCourseReport"
                                            style="display:<?= ($role == "company") ? '' : 'none'; ?>"
                                            class="dropdown-item">
                                            <i
                                                class="dropdown-item-icon mdi mdi-help-circle-outline text-primary me-2"></i>
                                            Company Course Report
                                        </a>
                                        <!-- <a class="dropdown-item" href="<?= $mainlink ?>logout_session"> -->
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
        // Initialize Bootstrap's dropdown
        $(document).ready(function () {
            $('.dropdown-toggle').dropdown();
        });
    </script>
    <script>
        // <!-- This is your HTML for displaying the cart count -->

        $(document).ready(function () {



            var tableBody = $('.tableBody');
            var cart = JSON.parse(localStorage.getItem('cart')) || [];
            var role = <?php echo json_encode($role); ?>

            // Function to update the cart, totals, and grand total
            function updateCartAndTotals(cartData) {
                updateCart(cartData);
                updateTotals(cartData);
                updateGrandTotal(cartData);
                updateCartCount();
            }

            // Function to update the row and remove item from the cart
            function removeCartItem(row, course) {
                var index = cart.findIndex(function (cartItem) {
                    return cartItem.id === course.id;
                });

                if (index !== -1) {
                    cart.splice(index, 1);
                    updateCartAndTotals(cart);

                    // Remove the row from the table
                    row.remove();
                }
            }

            function updateCartCount() {
                const cartJSON = localStorage.getItem('cart');
                const cartItems = JSON.parse(cartJSON) || [];
                const cartCount = cartItems.length;
                const cartCountContainer = document.getElementById('cart-count');
                cartCountContainer.textContent = cartCount;
            }

            function updateCart(cartData) {
                localStorage.setItem('cart', JSON.stringify(cartData));
            }

            function updateTotals(cartData) {
                // Calculate the total quantity and price
                var totalQuantity = cartData.reduce(function (total, course) {
                    return total + course.quantity;
                }, 0);

            }

            function updateGrandTotal(cartData) {
                var grandTotal = calculateTotal(cartData).toFixed(2);
                document.getElementById('grand-total').textContent = grandTotal ? grandTotal : 0;
            }

            function calculateTotal(cartData) {
                return cartData.reduce(function (total, course) {
                    return total + course.price * course.quantity;
                }, 0);
                console.log(cartData);
            }

            // Event handler for remove button
            tableBody.on('click', '.removeBtn', function () {
                var row = $(this).closest('tr');
                var courseId = $(this).data('id'); // Assuming productName contains the course ID

                // Find the corresponding course in the cart
                var course = cart.find(function (cartItem) {
                    return cartItem.id === courseId;
                });

                if (course) {
                    removeCartItem(row, course);
                }
            });

            // Event handler for quantity buttons
            tableBody.on('click', '.quantity-button', function () {
                var row = $(this).closest('tr');
                var courseId = $(this).data('id'); // Assuming productName contains the course ID

                // Find the corresponding course in the cart
                var course = cart.find(function (cartItem) {
                    return cartItem.id === courseId;
                });

                if (course) {
                    var quantityInput = row.find('.quantity-input');
                    var currentQuantity = parseInt(quantityInput.val());

                    if ($(this).hasClass('increment')) {
                        currentQuantity++;
                    } else if ($(this).hasClass('decrement') && currentQuantity > 1) {
                        currentQuantity--;
                    }

                    // Update the quantity in the cart and UI
                    course.quantity = currentQuantity;
                    quantityInput.val(currentQuantity);

                    // Update the total and grand total
                    updateCartAndTotals(cart);
                }
            });

            // Iterate over the cart items and populate the table
            $.each(cart, function (index, row) {
                var newRow = $('<tr>');
                newRow.append('<td class="productName" >' + row.name + '</td>');
                newRow.append('<td class="price">' + '&#8377;' + (row.price) + '</td>');

                if (role == 'students') {
                    newRow.append(
                        '<td class="product-quantity justify-content-center align-items-center" style="display: none;"></td>'
                    );
                    $('.product-quantity').hide();
                } else {
                    newRow.append(
                        '<td class="product-quantity justify-content-center align-items-center"><button class="quantity-button decrement" data-id="' +
                        row.id +
                        '">-</button><input type="number" class="quantity-input course-size" /><button class="quantity-button increment" data-id="' +
                        row.id + '">+</button></td>');
                }

                newRow.append('<td id="woocommerce-Price-amount" class="amount course-size"></td>');
                newRow.append('<td><button class="fas fa-trash-alt bg-light removeBtn" data-id="' + row.id +
                    '"></button></td>');

                // Set the value of the quantity input field for the current row
                newRow.find('.quantity-input').val(parseInt(row.quantity));

                var total = parseInt(row.price) * parseInt(row.quantity);
                newRow.find('#woocommerce-Price-amount').text('₹' + total);

                // Append the new row to the cart
                tableBody.append(newRow);
            });

            // Update the cart and totals when the page loads
            updateCartAndTotals(cart);


        });

        // Iterate over the cart items and populate the table
        $.each(cart, function (index, row) {
            var newRow = $('<tr>');
            newRow.append('<td class="productName" >' + row.name + '</td>');
            newRow.append('<td class="price">' + '&#8377;' + (row.price) + '</td>');

            if (role == 'students') {
                newRow.append('<td class="product-quantity justify-content-center align-items-center" style="display: none;"></td>');
                $('.product-quantity').hide();
            } else {
                newRow.append('<td class="product-quantity justify-content-center align-items-center"><button class="quantity-button decrement" data-id="' + row.id + '">-</button><input type="number" class="quantity-input course-size" /><button class="quantity-button increment" data-id="' + row.id + '">+</button></td>');
            }

            newRow.append('<td id="woocommerce-Price-amount" class="amount course-size"></td>');
            newRow.append('<td><button class="fas fa-trash-alt bg-light removeBtn" data-id="' + row.id + '"></button></td>');

            // Set the value of the quantity input field for the current row
            newRow.find('.quantity-input').val(parseInt(row.quantity));

            var total = parseInt(row.price) * parseInt(row.quantity);
            newRow.find('#woocommerce-Price-amount').text('₹' + total);

            // Append the new row to the cart
            tableBody.append(newRow);
        });

        // Update the cart and totals when the page loads
        updateCartAndTotals(cart);


    </script>

    <script>
        $(document).ready(function () {
            function updateWishlistCount() {
                const wishlistJSON = localStorage.getItem('wishlist');
                const wishlistItem = JSON.parse(wishlistJSON) || [];
                const wishlistCount = wishlistItem.length;
                const wishlistContainer = document.getElementById('wishlist-container');
                wishlistContainer.textContent = wishlistCount;
            }

            updateWishlistCount();
        })
    </script>