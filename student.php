<?php
if (isset($_GET['id'])) {
    $s_id = $_GET['id'];
<<<<<<< HEAD
    
    $student_auth_query = mysqli_query($con,"SELECT id,email,password FROM students where id='$s_id'");
=======

    $student_auth_query = mysqli_query($con, "SELECT id,email,password FROM students where id='$s_id'");
>>>>>>> 25801a4976c079f57edfd21cf3b548ecaa82368e

    $student_auth = mysqli_fetch_assoc($student_auth_query);
    $st_id = $student_auth['id'];
    $s_email = $student_auth['email'];
    $s_pass = $student_auth['password'];

} else {
    $s_id = '';
}
?>
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
                                value="<?= isset($_GET['id']) ? $s_email : '' ?>" aria-describedby="emailHelp"
                                <?= isset($_GET['id']) ? 'disabled' : '' ?>>
                        </div>
                        <div class="mb-3">
                            <label for="login-password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="login-password">
                            <p>
                                <?php 
                                echo $_SESSION['message'];
                                ?>
                            </p>
                            <input type="hidden" name="role" value="<?= $userRole ?>" class="form-control"
                                id="login-password">
                        </div>
                        <button type="submit" name="student_login" class="btn btn-primary login_button">Login</button>
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
                                        value="<?= $userRole ?>">
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