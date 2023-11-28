<?php
include("includes/header.php");

?>

<body id="top-header">
    <main class="site-main woocommerce single single-product page-wrapper">
        <!--shop category start-->
        <section class="space-3">
            <div class="container">
                <div class="row">
                    <section id="primary" class="content-area col-lg-12">
                        <main id="main" class="site-main" role="main">

                            <?php if ($_SESSION['role'] === "student") 
                            { ?>
                            <article id="post-8" class="post-8 page type-page status-publish hentry">
                                <div class="entry-content">

                                    <div class="woocommerce-notices-wrapper"></div>
                                    <form name="checkout" method="POST" action="core/profile_update.php"
                                        class="checkout woocommerce-checkout row" enctype="multipart/form-data"
                                        novalidate="novalidate">

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
                                                                        value="<?= $fullName; ?>"
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
                                                                        value="<?= $DOB; ?>" autocomplete="family-name">
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
                                                                        value="<?= $address; ?>"
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
                                                                        value="<?= $state; ?>"
                                                                        autocomplete="family-name">
                                                                    <!-- hidden -->
                                                                    <input type="hidden"
                                                                        class="input-text form-control input-lg"
                                                                        name="state_id" id="state_id" placeholder=""
                                                                        value="<?= $state_id; ?>"
                                                                        autocomplete="family-name">
                                                                </span>
                                                            </p>

                                                            <p class="form-row form-row-last form-group validate-required"
                                                                data-priority="20">
                                                                <label>Select Country&nbsp;<span
                                                                        class="required">*</span></label>
                                                                <span class="woocommerce-input-wrapper">
                                                                    <select class="form-control" name="country"
                                                                        class='countryList' id="countryList">
                                                                        <option>Choose Country..</option>
                                                                        <?php
                                                                    $fetchCountries = mysqli_query($con, "SELECT * FROM awt_countries");
                                                                    if ($fetchCountries) {
                                                                        while ($row = mysqli_fetch_assoc($fetchCountries)) {
                                                                            $selected = ($row['id'] == $country_id) ? 'selected' : '';
                                                                            ?>
                                                                        <option value="<?= $row['id'] ?>"
                                                                            <?= $selected ?>>
                                                                            <?= $row['name'] ?>
                                                                        </option>
                                                                        <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                    </select>
                                                                </span>
                                                                <!-- hidden -->
                                                                <input type="hidden"
                                                                    class="input-text form-control input-lg"
                                                                    name="country_id" id="country_id" placeholder=""
                                                                    value="<?= $country_id; ?>"
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
                                                                        value="<?= $pincode; ?>"
                                                                        autocomplete="given-name">
                                                                </span>
                                                            </p>
                                                            <p class="form-row form-row-last form-group validate-required"
                                                                data-priority="20">
                                                                <label for="gender" class="control-label">Select
                                                                    Gender&nbsp;<span class="required">*</span></label>
                                                                <span class="woocommerce-input-wrapper .form-control">
                                                                    <select class="form-control" name="gender">
                                                                        <option value="-1">Choose..</option>
                                                                        <option value="male"
                                                                            <?= ($gender == 'male') ? 'selected' : '' ?>>
                                                                            Male</option>
                                                                        <option value="female"
                                                                            <?= ($gender == 'female') ? 'selected' : '' ?>>
                                                                            Female</option>
                                                                        <option value="others"
                                                                            <?= ($gender == 'others') ? 'selected' : '' ?>>
                                                                            Others</option>
                                                                    </select>
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
                                                                        placeholder="" value="<?= $phoneNumber; ?>"
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
                                                                        value="<?= $email; ?>"
                                                                        autocomplete="family-name">
                                                                </span>
                                                            </p>

                                                            <p class="form-row form-row-first form-group validate-required"
                                                                data-priority="10">
                                                                <label>Select Your ID Proof&nbsp;<span
                                                                        class="required">*</span></label>
                                                                <span class="woocommerce-input-wrapper">
                                                                    <select class="form-control" name="idProof">
                                                                        <option
                                                                            <?= ($idProof == 'Aadhar Card') ? 'selected' : '' ?>>
                                                                            Aadhar Card</option>
                                                                        <option
                                                                            <?= ($idProof == 'Passport') ? 'selected' : '' ?>>
                                                                            Passport</option>
                                                                    </select>
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
                                                                        placeholder="" value="<?= $idProofDetails; ?>"
                                                                        autocomplete="family-name">
                                                                </span>
                                                            </p>

                                                            <!-- Add a hidden input to store the student ID -->
                                                            <input type="hidden" id="id" name="id" value="<?= $id; ?>">
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
                            </article>
                            <?php }else{?>
                            <article id="post-8" class="post-8 page type-page status-publish hentry">
                                <div class="entry-content">
                                    <form name="checkout" method="POST" action="core/profile_update.php"
                                        class="checkout woocommerce-checkout row" enctype="multipart/form-data"
                                        novalidate="novalidate">

                                        <div class="col-md-12">
                                            <div class="col2-set" id="customer_details">
                                                <div class="col-12">
                                                    <div class="woocommerce-billing-fields">
                                                        <h3>Company Profile</h3>

                                                        <div class="woocommerce-billing-fields__field-wrapper">
                                                            <p class="form-row form-row-first form-group validate-required"
                                                                id="" data-priority="10">
                                                                <label for="fullName" class="control-label">COMPANY
                                                                    NAME&nbsp;<abbr class="required"
                                                                        title="required">*</abbr></label>
                                                                <span class="woocommerce-input-wrapper">
                                                                    <input type="text"
                                                                        class="input-text form-control input-lg"
                                                                        name="fullName" id="fullNmae" placeholder=""
                                                                        value="<?= $fullName; ?>"
                                                                        autocomplete="given-name">
                                                                </span>
                                                            </p>
                                                            <p class="form-row form-row-last form-group validate-required"
                                                                data-priority="20">
                                                                <label for="email" class="control-label">
                                                                    DISTRICT&nbsp;<abbr class="required"
                                                                        title="required">*</abbr>
                                                                </label>
                                                                <span class="woocommerce-input-wrapper">
                                                                    <input type="text"
                                                                        class="input-text form-control input-lg"
                                                                        name="district" id="district" placeholder=""
                                                                        value="<?= $district; ?>"
                                                                        autocomplete="family-name">
                                                                </span>
                                                            </p>
                                                            <p class="form-row form-row-first form-group validate-required"
                                                                id="" data-priority="10">
                                                                <label for="fullName" class="control-label">COMPANY
                                                                    EMAIL&nbsp;<abbr class="required"
                                                                        title="required">*</abbr></label>
                                                                <span class="woocommerce-input-wrapper">
                                                                    <input type="text"
                                                                        class="input-text form-control input-lg"
                                                                        name="email" id="email" placeholder=""
                                                                        value="<?= $email; ?>"
                                                                        autocomplete="given-name">
                                                                </span>
                                                            </p>
                                                            <p class="form-row form-row-last form-group validate-required"
                                                                data-priority="20">
                                                                <label for="email" class="control-label">
                                                                    ADDRESS&nbsp;<abbr class="required"
                                                                        title="required">*</abbr>
                                                                </label>
                                                                <span class="woocommerce-input-wrapper">
                                                                    <input type="text"
                                                                        class="input-text form-control input-lg"
                                                                        name="address" id="address" placeholder=""
                                                                        value="<?= $address; ?>"
                                                                        autocomplete="family-name">
                                                                </span>
                                                            </p>
                                                            <p class="form-row form-row-first form-group validate-required"
                                                                id="" data-priority="10">
                                                                <label for="fullName" class="control-label">CONTACT
                                                                    NAME&nbsp;<abbr class="required"
                                                                        title="required">*</abbr></label>
                                                                <span class="woocommerce-input-wrapper">
                                                                    <input type="text"
                                                                        class="input-text form-control input-lg"
                                                                        name="contactName" id="contactName" placeholder=""
                                                                        value="<?= $contactName ; ?>"
                                                                        autocomplete="given-name">
                                                                </span>
                                                            </p>
                                                            <p class="form-row form-row-last form-group validate-required"
                                                                data-priority="20">
                                                                <label for="email" class="control-label">
                                                                    PINCODE&nbsp;<abbr class="required"
                                                                        title="required">*</abbr>
                                                                </label>
                                                                <span class="woocommerce-input-wrapper">
                                                                    <input type="text"
                                                                        class="input-text form-control input-lg"
                                                                        name="pincode" id="pincode" placeholder=""
                                                                        value="<?= $pincode; ?>"
                                                                        autocomplete="family-name">
                                                                </span>
                                                            </p>
                                                            <p class="form-row form-row-first form-group validate-required"
                                                                id="" data-priority="10">
                                                                <label for="fullName" class="control-label">MOBILE
                                                                    NO&nbsp;<abbr class="required"
                                                                        title="required">*</abbr></label>
                                                                <span class="woocommerce-input-wrapper">
                                                                    <input type="text"
                                                                        class="input-text form-control input-lg"
                                                                        name="phoneNumber" id="phoneNumber" placeholder=""
                                                                        value="<?= $phoneNumber; ?>"
                                                                        autocomplete="given-name">
                                                                </span>
                                                            </p>
                                                            <p class="form-row form-row-first form-group validate-required"
                                                                data-priority="10">
                                                                <label>Select Your ID Proof&nbsp;<span
                                                                        class="required">*</span></label>
                                                                <span class="woocommerce-input-wrapper">
                                                                    <select class="form-control" name="idProof">
                                                                        <option
                                                                            <?= ($idProof == 'Aadhar Card') ? 'selected' : '' ?>>
                                                                            Aadhar Card</option>
                                                                        <option
                                                                            <?= ($idProof == 'Passport') ? 'selected' : '' ?>>
                                                                            Passport</option>
                                                                    </select>
                                                                </span>
                                                            </p>
                                                            <p class="form-row form-row-last form-group validate-required"
                                                                data-priority="20">
                                                                <label>Select Country&nbsp;<span
                                                                        class="required">*</span></label>
                                                                <span class="woocommerce-input-wrapper">
                                                                    <select class="form-control" name="country"
                                                                        class='countryList' id="countryList">
                                                                        <option>Choose Country..</option>
                                                                        <?php
                                                                    $fetchCountries = mysqli_query($con, "SELECT * FROM awt_countries");
                                                                    if ($fetchCountries) {
                                                                        while ($row = mysqli_fetch_assoc($fetchCountries)) {
                                                                            $selected = ($row['id'] == $country_id) ? 'selected' : '';
                                                                            ?>
                                                                        <option value="<?= $row['id'] ?>"
                                                                            <?= $selected ?>>
                                                                            <?= $row['name'] ?>
                                                                        </option>
                                                                        <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                    </select>
                                                                </span>
                                                            </p>
                                                            <p class="form-row form-row-last form-group validate-required"
                                                                data-priority="20">
                                                                <label for="email" class="control-label">
                                                                    ID DETAILS&nbsp;<abbr class="required"
                                                                        title="required">*</abbr>
                                                                </label>
                                                                <span class="woocommerce-input-wrapper">
                                                                    <input type="text"
                                                                        class="input-text form-control input-lg"
                                                                        name="idDetails" id="idDetails" placeholder=""
                                                                        value="<?= $idProofDetails; ?>"
                                                                        autocomplete="family-name">
                                                                </span>
                                                            </p>
                                                            <p class="form-row form-row-last form-group validate-required"
                                                                data-priority="20">
                                                                <label for="email" class="control-label">
                                                                    SELECT STATE&nbsp;<abbr class="required"
                                                                        title="required">*</abbr>
                                                                </label>
                                                                <span class="woocommerce-input-wrapper">
                                                                    <input type="text"
                                                                        class="input-text form-control input-lg"
                                                                        name="state" id="state" placeholder=""
                                                                        value="<?= $state; ?>"
                                                                        autocomplete="family-name">
                                                                </span>
                                                            </p>

                                                            <!-- Add a hidden input to store the student ID -->
                                                            <input type="hidden" id="id" name="id" value="<?= $id; ?>">
                                                            <button name="update_company_register"> Update
                                                            </button>

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
                            </article>
                            <?php } ?>

                        </main>
                    </section>
                </div>
            </div>
        </section>
    </main>
    <?php
    include("includes/footer.php");
    ?>