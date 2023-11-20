<?php
include("includes/header.php");
?>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
                        <?= $_SESSION['role'] ?> Account

                    </h1>
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="list-inline-item">/</li>
                        <li class="list-inline-item">
                            My Account
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
                            <!-- Login Form -->
                            <form>
                                <div class="mb-3">
                                    <label for="login-email" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="login-email" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="login-password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="login-password">
                                </div>
                                <button type="submit" class="btn btn-primary login_button">Login</button>
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
                                                name="company_name" id="company_name" autocomplete="user-name" value="">
                                        </p>



                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label>Mobile No&nbsp;<span class="required">*</span></label>
                                            <input type="text"
                                                class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                                name="phoneNumber" id="phoneNumber" autocomplete="password" value="">
                                        </p>



                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label>Address&nbsp;<span class="required">*</span></label>
                                            <input type="text"
                                                class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                                name="address" id="address" autocomplete="password" value="">
                                        </p>



                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label>Select State&nbsp;<span class="required">*</span></label>
                                            <select class="form-control" name="state" class='stateList' id="stateList">
                                                <option value="-1">Choose States...</option>

                                            </select>
                                        </p>


                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label>District&nbsp;<span class="required">*</span></label>
                                            <input type="text"
                                                class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                                name="dist" id="dist" autocomplete="email" value="">
                                        </p>

                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label>Id Details&nbsp;<span class="required">*</span></label>
                                            <input type="text"
                                                class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                                name="id_details" id="id_details" autocomplete="password" value="">
                                        </p>

                                    </div>
                                    <div class="col-md-6">
                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label>Contact Name&nbsp;<span class="required">*</span></label>
                                            <input type="text"
                                                class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                                name="contact_name" id="contact_name" autocomplete="password" value="">
                                        </p>

                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label>Company Email&nbsp;<span class="required">*</span></label>
                                            <input type="email"
                                                class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                                name="email" id="" autocomplete="password" value="">
                                        </p>

                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label>Select Country&nbsp;<span class="required">*</span></label>
                                            <select class="form-control" name="country" class='countryList'
                                                id="countryList">
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
                                                <!-- </option> -->


                                            </select>
                                        </p>



                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label>PinCode&nbsp;<span class="required">*</span></label>
                                            <input type="text"
                                                class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                                name="pinCode" id="" autocomplete="password" value="">
                                        </p>



                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label>Select Your ID Proof&nbsp;<span class="required">*</span></label>
                                            <select class="form-control" name="idProof">
                                                <option>Aadhar Card</option>
                                                <option>Passport</option>
                                            </select>
                                        </p>


                                        <p class="woocommerce-FormRow form-row">
                                            <input type="hidden" id="woocommerce-register-nonce"
                                                name="woocommerce-register-nonce" value="<?= $_SESSION['role'] ?>"><input
                                                type="hidden" name="_wp_http_referer" value="/my-account/">
                                            <button type="submit" class="woocommerce-Button button" name="registerCompany"
                                                value="Register">Register</button>
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
                            <!-- Login Form -->
                            <form method="post" action="core/login_register.php">
                                <div class="mb-3">
                                    <label for="login-email" class="form-label">Email address</label>
                                    <input type="email" name="email" class="form-control" id="login-email"
                                        value="<?= isset($_GET['id']) ? $s_email : '' ?>" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="login-password" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="login-password">
                                    <p>
                                        <?php
                                        if (isset($_SESSION['message'])) {
                                            echo '<div style="color: red; font-weight: bold;">' . $_SESSION['message'] . '</div>';
                                            unset($_SESSION['message']); // Clear the message after displaying it
                                        }
                                        ?>
                                    </p>
                                    <input type="hidden" name="role"
                                        value="<?= isset($_SESSION['role']) ? $_SESSION['role'] : '' ?>"
                                        class="form-control">
                                    <input type="hidden" name="stud_id" value="<?= isset($st_id) ? $st_id : '' ?>"
                                        class="form-control">

                                </div>
                                <button type="submit" name="student_login"
                                    class="btn btn-primary login_button">Login</button>
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
                                                name="fullName" id="" autocomplete="user-name" value="" required>
                                        </p>
                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label>Date Of Birth&nbsp;<span class="required">*</span></label>
                                            <input type="date"
                                                class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                                name="dateOfBirth" id="" autocomplete="email" value="" required>
                                        </p>
                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label>Phone Number&nbsp;<span class="required">*</span></label>
                                            <input type="text"
                                                class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                                name="phoneNumber" id="" autocomplete="password" value="" required>
                                        </p>
                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label>Email&nbsp;<span class="required">*</span></label>
                                            <input type="email"
                                                class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                                name="email" id="" autocomplete="password" value="" required>
                                        </p>
                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label>Select Gender&nbsp;<span class="required">*</span></label>
                                            <select class="form-control" name="gender">
                                                <option value="-1">Choose..</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                                <option value="others">Others</option>
                                            </select>
                                        </p>
                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label>Select Country&nbsp;<span class="required">*</span></label>
                                            <select class="form-control" name="country" class='countryList form-control'
                                                id="countryList">
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
                                            <select class="form-control" name="state" id="stateList">
                                                <option value="-1">Choose States...</option>
                                                <!-- Add other options here -->
                                            </select>
                                        </p>
                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label>City Name&nbsp;<span class="required">*</span></label>
                                            <input type="text"
                                                class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                                name="city" id="" autocomplete="email" value="" required>
                                        </p>
                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label>Area PinCode&nbsp;<span class="required">*</span></label>
                                            <input type="text"
                                                class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                                name="pinCode" id="" autocomplete="password" value="" required>
                                        </p>
                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label>Select Your ID Proof&nbsp;<span class="required">*</span></label>
                                            <select class="form-control" name="idProof">
                                                <option>Aadhar Card</option>
                                                <option>Passport</option>
                                            </select>
                                        </p>
                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label>Id Proof Unique Id&nbsp;<span class="required">*</span></label>
                                            <input type="text"
                                                class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                                name="uniqueIdNo" id="" autocomplete="password" value="" required>
                                        </p>
                                        <p class="woocommerce-FormRow form-row">
                                            <input type="hidden" id="woocommerce-register-nonce" name="role"
                                                value="<?= $_SESSION['role'] ?>">
                                            <button type="submit" class="woocommerce-Button button" name="registerStudent"
                                                value="Register">Register</button>
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
    $(document).ready(function () {
        $('#countryList').on('change', function () {
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
                success: function (response) {
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
                error: function (xhr, status, error) {
                    // Handle errors if the AJAX request fails
                    console.error("AJAX request failed: " + error);
                }
            });
        });
    });
</script>

<!-- Add Bootstrap JS and Popper.js scripts -->
<?php include("includes/footer.php"); ?>