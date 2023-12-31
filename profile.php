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

                            <?php if ($_SESSION['role'] === "students") 
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
                                                                            <?= $row['name']; ?>
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


                                                            <p class="form-row form-row-last form-group validate-required"
                                                                data-priority="20">
                                                                <label for="state" class="control-label">
                                                                    State &nbsp;<abbr class="required"
                                                                        title="required">*</abbr>
                                                                </label>
                                                                <span class="woocommerce-input-wrapper">
                                                                    <select class="form-control" name="country"
                                                                        id="stateList">
                                                                        <option>Choose State..</option>
                                                                        <?php
                                                                    $fetchCountries = mysqli_query($con, "SELECT * FROM awt_states");
                                                                    if ($fetchCountries) {
                                                                        while ($row = mysqli_fetch_assoc($fetchCountries)) {
                                                                            $selected = ($row['id'] == $state_id) ? 'selected' : '';
                                                                            ?>
                                                                        <option value="<?= $row['id'] ?>"
                                                                            <?= $selected ?>>
                                                                            <?= $row['name']; ?>
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
                                                                    name="state_id" id="state_id" placeholder=""
                                                                    value="<?= $state_id; ?>"
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

                                                <!-- <div class="col-12">
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
                                                </div> -->
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
                                                                        name="contactName" id="contactName"
                                                                        placeholder="" value="<?= $contactName ; ?>"
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
                                                                        name="phoneNumber" id="phoneNumber"
                                                                        placeholder="" value="<?= $phoneNumber; ?>"
                                                                        autocomplete="given-name">
                                                                </span>
                                                            </p>
                                                            <p class="form-row form-row-last form-group validate-required"
                                                                data-priority="20">
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
                                                            <p class="form-row form-row-first form-group validate-required"
                                                                data-priority="10">
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
                                                                            <?= $row['name']; ?>
                                                                        </option>
                                                                        <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                    </select>
                                                                    <input type="hidden"
                                                                        class="input-text form-control input-lg"
                                                                        name="country_id" id="country_id" placeholder=""
                                                                        value="<?= $country_id; ?>"
                                                                        autocomplete="family-name">
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
                                                                        name="idProofDetails" id="idDetails"
                                                                        placeholder="" value="<?= $idProofDetails; ?>"
                                                                        autocomplete="family-name">
                                                                </span>
                                                            </p>
                                                            <p class="form-row form-row-first form-group validate-required"
                                                                data-priority="10">
                                                                <label for="email" class="control-label">
                                                                    SELECT STATE&nbsp;<abbr class="required"
                                                                        title="required">*</abbr>
                                                                </label>
                                                                <span class="woocommerce-input-wrapper">
                                                                    <select class="form-control" name="country"
                                                                        class='stateList' id="stateList">
                                                                        <option>Choose State..</option>
                                                                        <?php
                                                                    $fetchCountries = mysqli_query($con, "SELECT * FROM awt_states");
                                                                    if ($fetchCountries) {
                                                                        while ($row = mysqli_fetch_assoc($fetchCountries)) {
                                                                            $selected = ($row['id'] == $state_id) ? 'selected' : '';
                                                                            ?>
                                                                        <option value="<?= $row['id'] ?>"
                                                                            <?= $selected ?>>
                                                                            <?= $row['name']; ?>
                                                                        </option>
                                                                        <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                    </select>
                                                                    <input type="hidden"
                                                                        class="input-text form-control input-lg"
                                                                        name="state_id" id="state_id" placeholder=""
                                                                        value="<?= $state_id; ?>"
                                                                        autocomplete="family-name">
                                                                </span>
                                                            </p>
                                                            <p class="form-row form-row-last form-group validate-required"
                                                                data-priority="10">
                                                                <input type="hidden" id="id" name="id"
                                                                    value="<?= $id; ?>">
                                                                <button name="update_company_register"> Update
                                                                </button>
                                                            </p>
                                                            <!-- Add a hidden input to store the student ID -->


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

    <script>
    $(document).ready(function() {
        $('#countryList').on('change', function() {
            var countryId = $(this).val();
            // console.log(countryId);
            if (countryId === "Choose Country..") { // Correct the condition
                $('#stateList').empty();
                $('#stateList').append($('<option>', {
                    value: "choose_state",
                    text: "Choose State"
                }));
            }
            $.ajax({
                method: 'GET', // Use the GET method for the request
                url: 'core/login_register.php',
                data: {
                    selectedCountryId: countryId // Pass the selected countryId as a parameter
                },
                success: function(response) {
                    // Handle the response from the server if needed
                    var states = JSON.parse(response);
                    $('#stateList').empty();
                    // console.log(states);
                    // var c_id =response;
                    for (var i = 0; i < states.length; i++) {
                        $('#stateList').append($('<option>', {
                            value: states[i]
                                .id, // Assuming there is an 'id' field in your states
                            text: states[i]
                                .name // Assuming there is a 'state_name' field in your states
                        }));
                    }

                },
                error: function(xhr, status, error) {
                    // Handle errors if the AJAX request fails
                    console.error("AJAX request failed: " + error);
                }
            });
        });
    });
    </script>
    <script>
    $(document).ready(function() {
        // Add change event listener to the country dropdown
        $('#countryList').change(function() {
            // Set the value of the country_id input to the selected country's ID
            $('#country_id').val($(this).val());
        });
    });
    </script>
    <script>
    $(document).ready(function() {
        // Add change event listener to the country dropdown
        $('#stateList').change(function() {
            // Set the value of the country_id input to the selected country's ID
            $('#state_id').val($(this).val());
        });
    });
    </script>


<style>
    .error-message {
        color: red;
        font-size: 14px;
        margin-top: 4px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var form = document.querySelector('form');
        var submitButton = document.querySelector('button[name="update_student_register"]');

        function displayError(inputElement, errorMessage) {
            // Remove existing error message, if any
            var existingError = inputElement.nextElementSibling;
            if (existingError && existingError.classList.contains('error-message')) {
                existingError.remove();
            }

            // Create a new error message element
            var errorElement = document.createElement('div');
            errorElement.classList.add('error-message');
            errorElement.textContent = errorMessage;

            // Insert the error message below the input element
            inputElement.parentNode.insertBefore(errorElement, inputElement.nextSibling);
        }

        function removeError(inputElement) {
            // Remove existing error message, if any
            var existingError = inputElement.nextElementSibling;
            if (existingError && existingError.classList.contains('error-message')) {
                existingError.remove();
            }
        }

        function validateFullName() {
            var fullName = document.getElementById('fullNmae').value.trim();
            if (fullName === '') {
                displayError(document.getElementById('fullNmae'), 'Please enter your full name.');
                return false;
            }
            removeError(document.getElementById('fullNmae'));
            return true;
        }

        function validateDOB() {
            var dob = document.getElementById('DOB').value.trim();
            if (dob === '') {
                displayError(document.getElementById('DOB'), 'Please enter your date of birth.');
                return false;
            }
            removeError(document.getElementById('DOB'));
            return true;
        }

        function validateAddress() {
            var address = document.getElementById('address').value.trim();
            if (address === '') {
                displayError(document.getElementById('address'), 'Please enter your address.');
                return false;
            }
            removeError(document.getElementById('address'));
            return true;
        }

        function validatePincode() {
            var pincode = document.getElementById('state').value.trim();
            if (pincode === '') {
                displayError(document.getElementById('state'), 'Please enter your pincode.');
                return false;
            }
            removeError(document.getElementById('state'));
            return true;
        }

        function validatePhoneNumber() {
            var phoneNumber = document.getElementById('phoneNumber').value.trim();
            if (phoneNumber === '') {
                displayError(document.getElementById('phoneNumber'), 'Please enter your phone number.');
                return false;
            }
            removeError(document.getElementById('phoneNumber'));
            return true;
        }

        function validateEmail() {
            var email = document.getElementById('email').value.trim();
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email === '' || !emailRegex.test(email)) {
                displayError(document.getElementById('email'), 'Please enter a valid email address.');
                return false;
            }
            removeError(document.getElementById('email'));
            return true;
        }

        function validateIdProofDetails() {
            var idProofDetails = document.getElementById('idProofDetails').value.trim();
            if (idProofDetails === '') {
                displayError(document.getElementById('idProofDetails'), 'Please enter your ID proof details.');
                return false;
            }
            removeError(document.getElementById('idProofDetails'));
            return true;
        }

        function validateForm() {
            var isFullNameValid = validateFullName();
            var isDOBValid = validateDOB();
            var isAddressValid = validateAddress();
            var isPincodeValid = validatePincode();
            var isPhoneNumberValid = validatePhoneNumber();
            var isEmailValid = validateEmail();
            var isIdProofDetailsValid = validateIdProofDetails();

            return (
                isFullNameValid &&
                isDOBValid &&
                isAddressValid &&
                isPincodeValid &&
                isPhoneNumberValid &&
                isEmailValid &&
                isIdProofDetailsValid
            );
        }

        submitButton.addEventListener('click', function (event) {
            // Validate the form before submitting
            if (!validateForm()) {
                event.preventDefault();
            }
        });

        document.getElementById('fullNmae').addEventListener('blur', validateFullName);
        document.getElementById('DOB').addEventListener('blur', validateDOB);
        document.getElementById('address').addEventListener('blur', validateAddress);
        document.getElementById('state').addEventListener('blur', validatePincode);
        document.getElementById('phoneNumber').addEventListener('blur', validatePhoneNumber);
        document.getElementById('email').addEventListener('blur', validateEmail);
        document.getElementById('idProofDetails').addEventListener('blur', validateIdProofDetails);
    });
</script>

    <?php
    include("includes/footer.php");
    ?>