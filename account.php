<?php
include("includes/header.php");

if (isset($_SESSION['role']) && isset($_SESSION['role_id']) && !empty($_SESSION['role_id'])) {
    $session_role = $_SESSION['role'];
    $session_role_id = $_SESSION['role_id'];
    $message = isset($_SESSION['message']) ? $_SESSION['message'] : "";
} else {
    $session_role = "";
    $session_role_id = "";
    $message = "";
}
$alert = $_SESSION['alert_message'] ?? "";

if (isset($_SESSION['alert_message']) && (isset($_SESSION['incorrect_pass_id']) || isset($_SESSION['incorrect_pass_email_id']))) {
    unset($_SESSION['alert_message']);
}

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

<section class="page-header">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="page-header-content">
                    <h1>
                        <?= ($_SESSION['role']) ? $_SESSION['role'] : ""; ?> Account

                    </h1>
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="list-inline-item">/</li>
                        <li class="list-inline-item">
                            <?= $filename; ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <!-- conmpany section starts -->
    <?php if ($_SESSION['role'] == "company") { ?>
        <section class="section-padding" id="login_con">
            <div class="container-fluid">
                <div class="container mt-3">
                    <ul class="nav nav-pills" id="myTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="login-tab" data-bs-toggle="tab" href="#login" role="tab"
                                aria-controls="login" aria-selected="true">Login</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="register-tab" data-bs-toggle="tab" href="#register" role="tab"
                                aria-controls="register" aria-selected="false">Register</a>
                        </li>
                    </ul>
                    <div class="tab-content mt-3 " id="myTabContent">
                        <div class="tab-pane fade show active w-100" id="login" role="tabpanel" aria-labelledby="login-tab">
                            <!-- Login Form -->
                            <form method="post" action="core/login_register.php">
                                <div class="mb-4" id="message-container">
                                    <p id="status-message" class="text-danger">
                                        <?= $alert; ?>
                                    </p>
                                </div>
                                <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide mb-3">
                                    <label for="login-email" class="form-label">User Id / Email address</label>
                                    <input type="text" name="email" class="form-control" id="login-email"
                                        aria-describedby="emailHelp" required>
                                </div>
                                <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide mb-3">
                                    <label for="login-password" class="form-label">Password</label>
                                    <div class="input-group">
                                        <input type="password" name="password" class="form-control" id="login-password"
                                            required>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="show-password">
                                                <i class="fa fa-eye-slash" id="eye-icon"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <input type="hidden" name="role"
                                        value="<?= ($_SESSION['role']) ? $_SESSION['role'] : ""; ?>" class="form-control">
                                    <!-- <input type="hidden" name="iv" value="<?= $iv; ?>" class="form-control"> -->
                                    <input type="hidden" name="company_id" value="<?= $session_role_id ?>"
                                        class="form-control">
                                </div>
                                <p>
                                    <a href="<?= $mainlink ?>core/sessions.php?f_role=<?= $_SESSION['role']; ?>">Forgot
                                        Password?</a>
                                </p>
                                <!-- <div class="g-recaptcha" data-sitekey="6LcKvB8pAAAAAADMPbyTwHwOtDgcHzyze7n_QPg2"></div> -->

                                <button type="submit" name="company_login"
                                    class="btn btn-primary login_button">Login</button>

                            </form>
                        </div>

                        <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                            <!-- Register Form -->
                            <form method="post" class="woocommerce-form woocommerce-form-register register"
                                action="core/login_register.php">
                                <h2 class="font-weight-bold mb-4">Company Register</h2>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label>Company Name&nbsp;<span class="required">*</span></label>
                                            <input type="text"
                                                class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                                name="company_name" id="company_name" onkeypress="return isText(event)"
                                                autocomplete="user-name" value="" required>
                                        </p>
                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label>Company Email&nbsp;<span class="required">*</span></label>
                                            <input type="email"
                                                class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                                name="email" id="emailInput" autocomplete="password" value="" required>
                                            <span id="errorEmail" style="color: red;"></span>
                                        </p>
                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label>Contact Name&nbsp;<span class="required">*</span></label>
                                            <input type="text"
                                                class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                                name="contact_name" id="contact_name" onkeypress="return isText(event)"
                                                autocomplete="password" value="" required>
                                        </p>

                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label>Mobile No&nbsp;<span class="required">*</span></label>
                                            <input type="number"
                                                class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                                name="phoneNumber" id="phoneNumber" autocomplete="password"
                                                onkeypress="return isNumber(event)" oninput="validatePhoneNumber()" value=""
                                                required>
                                            <span id="errorPhn" style="color: red;"></span>
                                        </p>
                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label>Select Country&nbsp;<span class="required">*</span></label>
                                            <select class="form-control" name="country" class='countryList' id="countryList"
                                                required>
                                                <option>Choose Country..</option>
                                                <!-- <option> -->
                                                <?php
                                                $fetchCountries = mysqli_query($con, "SELECT * FROM awt_countries");
                                                if ($fetchCountries) {
                                                    while ($row = mysqli_fetch_assoc($fetchCountries)) {
                                                        ?>
                                                        <option value="<?= $row['id'] ?>">
                                                            <?= $row['name'] ?>
                                                        </option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </p>


                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label>Select State&nbsp;<span class="required">*</span></label>
                                            <select class="form-control" name="state" class='stateList' id="stateList"
                                                required>
                                                <option value="">Choose States...</option>

                                            </select>
                                        </p>



                                    </div>
                                    <div class="col-md-6">

                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label>District&nbsp;<span class="required">*</span></label>
                                            <input type="text"
                                                class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                                name="dist" id="dist" onkeypress="return isText(event)" autocomplete="email"
                                                value="" required>
                                        </p>
                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label>Address&nbsp;<span class="required">*</span></label>
                                            <input type="text"
                                                class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                                name="address" id="address" autocomplete="password" value="" required>
                                        </p>
                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label>PinCode&nbsp;<span class="required">*</span></label>
                                            <input type="text"
                                                class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                                name="pinCode" id="" autocomplete="password"
                                                onkeypress="return isNumber(event)" value="" maxlength="6" required>
                                        </p>
                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label>Select Your ID Proof&nbsp;<span class="required">*</span></label>
                                            <select class="form-control" name="idProof">
                                                <option>Aadhar Card</option>
                                                <option>Passport</option>
                                            </select>
                                        </p>
                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label>Id Details&nbsp;<span class="required">*</span></label>
                                            <input type="text"
                                                class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                                name="id_details" id="id_details" autocomplete="password" value=""
                                                maxlength="12" required>
                                        </p>

                                        <p class="woocommerce-FormRow form-row">
                                            <input type="hidden" name="role" value="<?= $_SESSION['role']; ?>" id="role">
                                            <button type="submit" class="woocommerce-Button button" name="registerCompany"
                                                id="registerButton" value="Register">Register</button>
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- student section start -->
    <?php } else { ?>
        <section class="section-padding">
            <div class="container-fluid">
                <div class="container mt-3">
                    <ul class="nav nav-pills" id="myTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="login-tab" data-bs-toggle="tab" href="#login" role="tab"
                                aria-controls="login" aria-selected="true">Login</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="register-tab" data-bs-toggle="tab" href="#register" role="tab"
                                aria-controls="register" aria-selected="false">Register</a>
                        </li>
                    </ul>
                    <div class="tab-content mt-3 " id="myTabContent">
                        <div class="tab-pane fade show active w-100" id="login" role="tabpanel" aria-labelledby="login-tab">
                            <form method="post" action="core/login_register.php">
                                <div class="mb-4" id="message-container">
                                    <p id="status-message" class="text-danger">
                                        <?= $alert; ?>
                                    </p>
                                </div>
                                <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide mb-3">
                                    <label for="login-email" class="form-label">Email address</label>
                                    <input type="email" name="email" class="form-control" id="login-email"
                                        aria-describedby="emailHelp" required>
                                </div>
                                <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide mb-3">
                                    <label for="login-password" class="form-label">Password</label>
                                    <div class="input-group">
                                        <input type="password" name="password" class="form-control" id="login-password"
                                            required>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="show-password">
                                                <i class="fa fa-eye-slash" id="eye-icon"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <input type="hidden" name="role"
                                        value="<?= ($_SESSION['role']) ? $_SESSION['role'] : ""; ?>" class="form-control">
                                    <input type="hidden" name="student_id" value="<?= $session_role_id ?>"
                                        class="form-control">
                                </div>
                                <p>
                                    <a
                                        href="<?= $mainlink ?>core/sessions.php?f_role=<?= ($_SESSION['role']) ? $_SESSION['role'] : ""; ?>">Forgot
                                        Password?</a>
                                </p>
                                <button type="submit" name="student_login"
                                    class="btn btn-primary login_button">Login</button>
                                <!-- <div class="g-recaptcha" data-sitekey="6LcKvB8pAAAAAADMPbyTwHwOtDgcHzyze7n_QPg2"></div> -->
                            </form>

                        </div>

                        <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                            <!-- Register Form -->
                            <form method="post" class="woocommerce-form woocommerce-form-register register"
                                action="core/login_register.php">
                                <h2 class="font-weight-bold mb-4">Register</h2>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label>Full Name&nbsp;<span class="required">*</span></label>
                                            <input type="text"
                                                class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                                name="fullName" id="" autocomplete="user-name"
                                                onkeypress="return isText(event)" value="" required>
                                        </p>
                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label>Date Of Birth&nbsp;<span class="required">*</span></label>
                                            <input type="date"
                                                class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                                name="dateOfBirth" id="dateOfBirth" autocomplete="email" value="" required
                                                oninput="validateDate()">
                                            <span id="errorDob" style="color: red;"></span>
                                        </p>

                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label>Phone Number&nbsp;<span class="required">*</span></label>
                                            <input type="text"
                                                class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                                name="phoneNumber" id="phoneNumber" autocomplete="password"
                                                onkeypress="return isNumber(event)" oninput="validatePhoneNumber()"
                                                maxlength="12" value="" required>
                                            <span id="errorPhn" style="color: red;"></span>
                                        </p>
                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label>Email&nbsp;<span class="required">*</span></label>
                                            <input type="email"
                                                class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                                name="email" id="email" autocomplete="password" value="" required>
                                            <span id="errorEmail" style="color: red;"></span>
                                        </p>
                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label>Select Gender&nbsp;<span class="required">*</span></label>
                                            <select class="form-control" name="gender" required>
                                                <option value="">Choose..</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                                <option value="others">Others</option>
                                            </select>
                                        </p>
                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label>Select Country&nbsp;<span class="required">*</span></label>
                                            <select class="form-control" name="country" class='countryList form-control'
                                                id="countryList" required>
                                                <option value="Choose Country..">Choose Country..</option>
                                                <!-- <option> -->
                                                <?php
                                                // $fetchCountries = mysqli_query($con, "SELECT * FROM awt_countries");
                                                if ($fetchCountries) {
                                                    while ($row = mysqli_fetch_assoc($fetchCountries)) {
                                                        ?>
                                                        <option value="<?= $row['id'] ?>">
                                                            <?= $row['name'] ?>
                                                        </option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                <!-- </option> -->


                                            </select>
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label for="stateList">Select State<span class="required">*</span></label>
                                            <select class="form-control" name="state" id="stateList" required>
                                                <option value="">Choose States...</option>
                                                <!-- Add other options here -->
                                            </select>
                                        </p>
                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label>City Name&nbsp;<span class="required">*</span></label>
                                            <input type="text"
                                                class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                                name="city" id="" autocomplete="email" onkeypress="return isText(event)"
                                                value="" required>
                                        </p>
                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label>Area PinCode&nbsp;<span class="required">*</span></label>
                                            <input type="text"
                                                class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                                name="pinCode" id="" autocomplete="password"
                                                onkeypress="return isNumber(event)" value="" maxlength="6" required>
                                        </p>
                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label>Address&nbsp;<span class="required">*</span></label>
                                            <input type="textarea"
                                                class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                                name="address" id="" value="" required>
                                        </p>
                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label>Select Your ID Proof&nbsp;<span class="required">*</span></label>
                                            <select class="form-control" name="idProof" required>
                                                <option value="">Choose..</option>
                                                <option>Aadhar Card</option>
                                                <option>Passport</option>
                                            </select>
                                        </p>
                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label>Id Proof Unique Id&nbsp;<span class="required">*</span></label>
                                            <input type="text"
                                                class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                                name="uniqueIdNo" id="" onkeypress="return isNumber(event)" maxlength="12"
                                                autocomplete="password" value="" required>
                                        </p>
                                        <p class="woocommerce-FormRow form-row">
                                            <input type="hidden" name="role"
                                                value="<?= ($_SESSION['role']) ? $_SESSION['role'] : ""; ?>" id="role">
                                            <button type="submit" class="woocommerce-Button button" name="registerStudent"
                                                id="registerButton" value="Register">Register</button>
                                        </p>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    <?php } ?>
</section>
<script>
    var emailInput = document.getElementById('emailInput');
    var roleHere = document.getElementById('role');
    var registerButton = document.getElementById('registerButton');
    var errorText = document.getElementById('errorEmail');
    $(document).ready(function () {
        $('#countryList').on('change', function () {
            var countryId = $(this).val();
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
                success: function (response) {
                    // Handle the response from the server if needed
                    var states = JSON.parse(response);
                    $('#stateList').empty();
                    $('#stateList').append($('<option>', {
                        value: '',  // Provide an empty value for the initial option
                        text: 'Select State'
                    }));

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
                error: function (xhr, status, error) {
                    // Handle errors if the AJAX request fails
                    console.error("AJAX request failed: " + error);
                }
            });
        });

        emailInput.addEventListener('blur', function () {
            validateEmail();
        });

        function validateEmail() {
            var emailValue = emailInput.value.trim();
            var commonDomainPattern = /^(.+)@((?!.*\.{2})[a-zA-Z0-9-]+\.[a-zA-Z]{2,})(gmail\.com|yahoo\.com|yahoo\.co\.in|glansa\.com|glansa\.in|outlook\.com|iCloud\.com|live\.com|mail\.com)$/i;


            if (emailValue === '') {
                errorEmail.textContent = 'Email is required.';
            } else if (!commonDomainPattern.test(emailValue) || emailValue.includes(',')) {
                errorEmail.textContent = 'Enter a valid email address.';
            } else {
                errorEmail.textContent = ''; // Clear error message if validation passed
                var enteredEmail = emailInput.value;
                var roleHerePop = roleHere.value;
                // AJAX request to validate email on the server
                $.ajax({
                    method: 'GET',
                    url: 'core/validate_email_in_reg.php',
                    data: {
                        entered_mail: emailValue,
                        role: roleHerePop, // Assuming roleHerePop is defined somewhere in your code
                    },
                    success: function (response) {
                        errorEmail.textContent = response;
                        registerButton.disabled = (response === 'Email already exists');
                    },
                    error: function (xhr, status, error) {
                        console.error("AJAX request failed: " + error);
                    }
                });
            }
        }
    });
</script>

<!-- Add Bootstrap JS and Popper.js scripts -->
<?php include("includes/footer.php"); ?>