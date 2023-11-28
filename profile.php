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
                                                                    Country &nbsp;<abbr class="required"
                                                                        title="required">*</abbr>
                                                                </label>
                                                                <span class="woocommerce-input-wrapper">
                                                                    <input type="text"
                                                                        class="input-text form-control input-lg"
                                                                        name="country" id="state" placeholder=""
                                                                        value="<?php echo $countryName; ?>"
                                                                        autocomplete="family-name">
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
                                                                        value="<?php echo $stateName; ?>"
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
                                                                <button type="submit" name="update_student_register">Update</button>

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

    

    <?php
    include("includes/footer.php");
    ?>