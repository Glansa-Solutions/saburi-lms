<?php
include("includes/header.php");
// include('../functions/list_grid.php');

?>

<body id="top-header">
    <main class="site-main woocommerce single single-product page-wrapper">
        <!--shop category start-->
        <section class="space-3">
            <div class="container">
                <div class="row">
                    <section id="primary" class="content-area col-lg-12">
                        <main id="main" class="site-main" role="main">
                            <article id="post-8" class="post-8 page type-page status-publish hentry">
                                <div class="entry-content">

                                    <div class="woocommerce-notices-wrapper"></div>
                                    <form name="checkout" method="POST" action="../functions/functions.php"
                                        class="checkout woocommerce-checkout row" enctype="multipart/form-data"
                                        novalidate="novalidate">
                                        <?php if ($fetch_list_students_query) {
                                            // Fetch student details, assuming it fetches a single row for the currently logged-in student
                                            $student_data = mysqli_fetch_assoc($fetch_list_students_query);

                                            // Set retrieved values into variables
                                            $id = $student_data['id'];
                                            $fullName = $student_data['name'];
                                            $DOB = $student_data['DOB'];
                                            $address = $student_data['address'];
                                            $state = $student_data['state'];
                                            $pincode = $student_data['pincode'];
                                            $gender = $student_data['gender'];
                                            $phoneNumber = $student_data['phoneNumber'];
                                            $email = $student_data['email'];
                                            $idProof = $student_data['idProof'];
                                            $idProofDetails = $student_data['idProofDetails'];
                                        }
                                        ?>
                                        <div class="col-md-12">
                                            <div class="col2-set" id="customer_details">
                                                <div class="col-12">
                                                    <div class="woocommerce-billing-fields">
                                                        <h3>My Profile</h3>

                                                        <div class="woocommerce-billing-fields__field-wrapper">
                                                            <p class="form-row form-row-first form-group validate-required"
                                                                id="" data-priority="10">
                                                                <label for="fullName" class="control-label">Full
                                                                    Name&nbsp;<abbr class="required"
                                                                        title="required">*</abbr></label>
                                                                <span class="woocommerce-input-wrapper">
                                                                    <input type="text"
                                                                        class="input-text form-control input-lg"
                                                                        name="fullName" id="fullNmae" placeholder=""
                                                                        value="<?php echo $fullName; ?>"
                                                                        autocomplete="given-name">
                                                                </span>
                                                            </p>
                                                            <p class="form-row form-row-last form-group validate-required"
                                                                id="" data-priority="20">
                                                                <label for="billing_last_name" class="control-label">
                                                                    DOB&nbsp;<abbr class="required"
                                                                        title="required">*</abbr>
                                                                </label>
                                                                <span class="woocommerce-input-wrapper">
                                                                    <input type="date"
                                                                        class="input-text form-control input-lg"
                                                                        name="DOB" id="DOB" placeholder=""
                                                                        value="<?php echo $DOB; ?>"
                                                                        autocomplete="family-name">
                                                                </span>
                                                            </p>
                                                            <p class="form-row form-row-first form-group validate-required"
                                                                id="address" data-priority="10">
                                                                <label for="address" class="control-label">Address
                                                                    &nbsp;<abbr class="required"
                                                                        title="required">*</abbr></label>
                                                                <span class="woocommerce-input-wrapper">
                                                                    <input type="text"
                                                                        class="input-text form-control input-lg"
                                                                        name="address" id="address" placeholder=""
                                                                        value="<?php echo $address; ?>"
                                                                        autocomplete="given-name">
                                                                </span>
                                                            </p>
                                                            <p class="form-row form-row-last form-group validate-required"
                                                                data-priority="20">
                                                                <label for="state" class="control-label">
                                                                    State &nbsp;<abbr class="required"
                                                                        title="required">*</abbr>
                                                                </label>
                                                                <span class="woocommerce-input-wrapper">
                                                                    <input type="text"
                                                                        class="input-text form-control input-lg"
                                                                        name="state" id="state" placeholder=""
                                                                        value="<?php echo $state; ?>"
                                                                        autocomplete="family-name">
                                                                </span>
                                                            </p>
                                                            <p class="form-row form-row-first form-group validate-required"
                                                                data-priority="10">
                                                                <label for="pincode"
                                                                    class="control-label">Pincode&nbsp;<abbr
                                                                        class="required"
                                                                        title="required">*</abbr></label>
                                                                <span class="woocommerce-input-wrapper">
                                                                    <input type="text"
                                                                        class="input-text form-control input-lg"
                                                                        name="pincode" id="state" placeholder=""
                                                                        value="<?php echo $pincode; ?>"
                                                                        autocomplete="given-name">
                                                                </span>
                                                            </p>
                                                            <p class="form-row form-row-last form-group validate-required"
                                                                data-priority="20">
                                                                <label for="gender" class="control-label">
                                                                    Gender&nbsp;<abbr class="required"
                                                                        title="required">*</abbr>
                                                                </label>
                                                                <span class="woocommerce-input-wrapper">
                                                                    <input type="text"
                                                                        class="input-text form-control input-lg"
                                                                        name="gender" id="gender" placeholder=""
                                                                        value="<?php echo $gender; ?>"
                                                                        autocomplete="family-name">
                                                                </span>
                                                            </p>
                                                            <p class="form-row form-row-first form-group validate-required"
                                                                data-priority="10">
                                                                <label for="phoneNumber" class="control-label">Phone
                                                                    Number &nbsp;<abbr class="required"
                                                                        title="required">*</abbr></label>
                                                                <span class="woocommerce-input-wrapper">
                                                                    <input type="text"
                                                                        class="input-text form-control input-lg"
                                                                        name="phoneNumber" id="phoneNumber"
                                                                        placeholder=""
                                                                        value="<?php echo $phoneNumber; ?>"
                                                                        autocomplete="given-name">
                                                                </span>
                                                            </p>
                                                            <p class="form-row form-row-last form-group validate-required"
                                                                data-priority="20">
                                                                <label for="email" class="control-label">
                                                                    Email&nbsp;<abbr class="required"
                                                                        title="required">*</abbr>
                                                                </label>
                                                                <span class="woocommerce-input-wrapper">
                                                                    <input type="text"
                                                                        class="input-text form-control input-lg"
                                                                        name="email" id="email" placeholder=""
                                                                        value="<?php echo $email; ?>"
                                                                        autocomplete="family-name">
                                                                </span>
                                                            </p>
                                                            <p class="form-row form-row-first form-group validate-required"
                                                                data-priority="10">
                                                                <label for="idProof" class="control-label">Id
                                                                    Proof&nbsp;<abbr class="required"
                                                                        title="required">*</abbr></label>
                                                                <span class="woocommerce-input-wrapper">
                                                                    <input type="text"
                                                                        class="input-text form-control input-lg"
                                                                        name="idProof" id="idProof" placeholder=""
                                                                        value="<?php echo $idProof; ?>"
                                                                        autocomplete="given-name">
                                                                </span>
                                                            </p>
                                                            <p class="form-row form-row-last form-group validate-required"
                                                                data-priority="20">
                                                                <label for="idProofDetails" class="control-label">
                                                                    Id Proof Details&nbsp;<abbr class="required"
                                                                        title="required">*</abbr>
                                                                </label>
                                                                <span class="woocommerce-input-wrapper">
                                                                    <input type="text"
                                                                        class="input-text form-control input-lg"
                                                                        name="idProofDetails" id="idProofDetails"
                                                                        placeholder=""
                                                                        value="<?php echo $idProofDetails; ?>"
                                                                        autocomplete="family-name">
                                                                </span>
                                                            </p>
                                                            <!-- Add a hidden input to store the student ID -->
                                                            <input type="hidden" id="id" name="id"
                                                                value="<?php echo $id; ?>">
                                                            <button name="update_student_register"> Update </button>

                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="col-12">
                                                    <div class="woocommerce-shipping-fields">
                                                    </div>
                                                    <div class="woocommerce-additional-fields">
                                                        <h3>Additional information</h3>
                                                        <div class="woocommerce-additional-fields__field-wrapper">
                                                            <p class="form-row notes" id="order_comments_field"
                                                                data-priority=""><label for="order_comments"
                                                                    class="control-label">Order notes&nbsp;<span
                                                                        class="optional">(optional)</span></label><span
                                                                    class="woocommerce-input-wrapper"><textarea
                                                                        name="order_comments"
                                                                        class="input-text form-control input-lg"
                                                                        id="order_comments"
                                                                        placeholder="Notes about your order, e.g. special notes for delivery."
                                                                        rows="2" cols="5"></textarea></span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                </div>
                </article>

    </main>
    </section>
    </div>
    </div>
    </section>

    </main>

    <section class="cta-2">
        <div class="container">
            <div class="row align-items-center subscribe-section ">
                <div class="col-lg-6">
                    <div class="section-heading white-text">
                        <span class="subheading">Newsletter</span>
                        <h3>Join our community of students</h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="subscribe-form">
                        <form action="#">
                            <input type="text" class="form-control" placeholder="Email Address">
                            <a href="#" class="btn btn-main">Subscribe<i class="fa fa-angle-right ml-2"></i> </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="footer pt-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mr-auto col-sm-6 col-md-6">
                    <div class="widget footer-widget mb-5 mb-lg-0">
                        <h5 class="widget-title">About Us</h5>
                        <p class="mt-3">Veniam Sequi molestias aut necessitatibus optio magni at natus accusamus.Lorem
                            ipsum dolor sit amet, consectetur adipisicin gelit, sed do eiusmod tempor incididunt .</p>
                        <ul class="list-inline footer-socials">
                            <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li class="list-inline-item"> <a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fab fa-linkedin"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fab fa-pinterest"></i></a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-2 col-sm-6 col-md-6">
                    <div class="footer-widget mb-5 mb-lg-0">
                        <h5 class="widget-title">Company</h5>
                        <ul class="list-unstyled footer-links">
                            <li><a href="#">About us</a></li>
                            <li><a href="#">Contact us</a></li>
                            <li><a href="#">Projects</a></li>
                            <li><a href="#">Terms & Condition</a></li>
                            <li><a href="#">Privacy policy</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-6 col-md-6">
                    <div class="footer-widget mb-5 mb-lg-0">
                        <h5 class="widget-title">Courses</h5>
                        <ul class="list-unstyled footer-links">
                            <li><a href="#">SEO Business</a></li>
                            <li><a href="#">Digital Marketing</a></li>
                            <li><a href="#">Graphic Design</a></li>
                            <li><a href="#">Site Development</a></li>
                            <li><a href="#">Social Marketing</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6">
                    <div class="footer-widget footer-contact mb-5 mb-lg-0">
                        <h5 class="widget-title">Contact </h5>

                        <ul class="list-unstyled">
                            <li><i class="bi bi-headphone"></i>
                                <div>
                                    <strong>Phone number</strong>
                                    (68) 345 5902
                                </div>

                            </li>
                            <li> <i class="bi bi-envelop"></i>
                                <div>
                                    <strong>Email Address</strong>
                                    info@yourdomain.com
                                </div>
                            </li>
                            <li><i class="bi bi-location-pointer"></i>
                                <div>
                                    <strong>Office Address</strong>
                                    Moon Street Light Avenue
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-btm">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-6">
                        <div class="footer-logo">
                            <img src="assets/images/logo-white.png" alt="Edutim" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="copyright text-lg-center">
                            <p>@ Copyright reserved to Edutim.Proudly Crafted by <a
                                    href="https://themeturn.com">Dreambuzz</a> </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="fixed-btm-top">
        <a href="#top-header" class="js-scroll-trigger scroll-to-top"><i class="fa fa-angle-up"></i></a>
    </div>



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
</body>

    <?php
    include("includes/footer.php");
    ?>