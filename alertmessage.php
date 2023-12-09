<?php
session_start();

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
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <!-- <script src="./js/jquery-3.6.0.min.js"></script> -->
    <!-- Swal -->

</head>

<section class="about-section section-padding about-2" id="alert">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-lg-6 col-md-12">
                <div class="section-heading">
                    <span class="subheading">Thank you</span>
                    <h3>
                        <?= $_SESSION['login_else_message']; ?>
                    </h3>
                </div>

                <button class="btn btn-main" data-bs-toggle="modal" data-bs-target="#resetLoginModal">
                    <i class="fa fa-check mr-2"></i>Reset Login
                </button>
                <div class="modal fade" id="resetLoginModal" tabindex="-1" aria-labelledby="resetLoginModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Enter Your Mail Id</h4>
                                    <form>
                                        <div class="mb-3">
                                            <input type="email" class="form-control" id="email"
                                                value="<?= $_SESSION['prev_email']; ?>">
                                            <input type="hidden" class="form-control" id="prev_user_role_id"
                                                value="<?= $_SESSION['role_id']; ?>">
                                            <input type="hidden" class="form-control" id="prev_user_role"
                                                value="<?= $_SESSION['role']; ?>">
                                        </div>
                                        <div class="mb-3">
                                            <button type="button" class="btn btn-saburi btn-sm p-2"
                                                id="submit_only_email">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="col-lg-6 col-md-12">
                <div class="about-img2">
                    <img src="assets/images/bg/choose.png" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $('#submit_only_email').on('click', function () {
        var email = $('#email').val();
        // alert(email);
        var roleid = $('#prev_user_role_id').val();
        var role = $('#prev_user_role').val();
        $.ajax({
            method: 'POST',
            url: 'core/prev_login.php',
            data: {
                'prev_login_email': email,
                'prev_user_role_id': roleid,
                'prev_user_role': role,
            },
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: response,
                    showConfirmButton: false,
                    timer: 2000
                });
                window.location.href = "log_reg";
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", status, error);
            }
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src="./core/action.js"></script>
<!-- 
    Essential Scripts
    =====================================-->

<!-- Main jQuery -->
<script src="assets/vendors/jquery/jquery.js"></script>
<!-- Bootstrap 4.5 -->
<script src="assets/vendors/bootstrap/bootstrap.js"></script>
<!-- Counterup -->
<script src="assets/vendors/counterup/waypoint.js"></script>
<script src="assets/vendors/counterup/jquery.counterup.min.js"></script>
<script src="assets/vendors/jquery.isotope.js"></script>
<script src="assets/vendors/imagesloaded.js"></script>
<!--  Owlk Carousel-->
<script src="assets/vendors/owl/owl.carousel.min.js"></script>
<script src="assets/js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>