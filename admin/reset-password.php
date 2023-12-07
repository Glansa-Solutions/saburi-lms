<?php
include('includes/login_header.php');
if (isset($_GET['role']) && !empty($_GET['role'])) {
    $secret_id = $_GET['role'];
} else {
    header("location: $mainlink" . "admin/");
}

?>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0">
            <div class="row w-100 mx-0">
                <div class="col-lg-4 mx-auto">
                    <div id="alertContainer"></div>

                    <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                        <div class="brand-logo">
                            <img src="assets/images/saburi.png" alt="logo">
                        </div>
                        <h2>Password Reset</h2>
                        <form class="pt-3" id="passwordResetForm">
                            <div class="form-group">
                                <label for="currentPassword">Current Password</label>
                                <div class="d-flex">
                                    <input type="password" class="form-control form-control-lg" id="currentPassword"
                                        placeholder="Enter your current password" required>
                                    <span class="input-group-text" id="show_password">
                                        <i class="fa fa-eye-slash" id="eye-icon"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="newPassword">New Password</label>
                                <input type="password" class="form-control form-control-lg" id="new_password"
                                    placeholder="Enter your new password" required
                                    onchange="validatePasswordOnChange()">
                            </div>
                            <div class="form-group">

                                <label for="confirmPassword">Confirm Password</label>
                                <div class="d-flex">
                                    <input type="password" class="form-control form-control-lg" id="confirm-password"
                                        placeholder="Confirm your new password" required>
                                    <span class="input-group-text" id="show_password1">
                                        <i class="fa fa-eye-slash" id="eye-icon"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="mt-3">
                                <button type="button"
                                    class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                    id="resetPassword">Reset Password</button>
                            </div>
                            <div class="text-center mt-4 fw-light">
                                <span class="fa fa-arrow-left"></span> <a href="<?= $mainlink; ?>admin/"
                                    class="text-primary" style="text-decoration: none">Back to Login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#resetPassword').on('click', function () {
            var currentPassword = $('#currentPassword').val();
            var show_password = $('#show_password').val();
            var new_password = $('#new_password').val();
            $('#alertContainer').html('<div class="alert alert-info alert-dismissible fade show" role="alert">' +
                '<strong>Updating password, please wait...</strong>' +
                '</div>');

            $.ajax({
                method: 'POST',
                url: '../core/test_checking.php',
                data: {
                    admin_current_p: currentPassword,
                    admin_new_p: show_password,
                    admin_conf_p: new_password,
                },
                success: function (response) {
                    // alert(response);

                    var result = JSON.parse(response);

                    // Display the message
                    var status = result.status;
                    var message = result.message;

                    // Show the alert based on the response
                    var alertClass = (status === 'success') ? 'alert-success' : 'alert-danger';
                    var alertHTML = '<div class="alert ' + alertClass + ' alert-dismissible fade show" role="alert">' +
                        '<strong>' + message + '</strong>' +
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                        '</div>';

                    // Append the alert to a container in your HTML
                    $('#alertContainer').html(alertHTML);

                    // setTimeout(function () {
                    //     window.location.href = '<?= $mainlink; ?>admin/';
                    // }, 2000);
                },
                error: function (xhr, status, error) {
                    // Handle errors if the AJAX request fails
                    console.error("AJAX request failed: " + error);
                }
            });
        });
        
    })
    function validatePasswordOnChange() {
        var newPassword = document.getElementsByName("new_password")[0].value;
        var regex = /^(?=.*[A-Z])(?=.*\d).{8,}$/;

        if (!regex.test(newPassword)) {
            alert("Password must contain at least 1 uppercase letter, 1 number, and be at least 8 characters long.");
        }
    }
    var passwordInput = document.getElementById('currentPassword');
    var eyeIcon = document.getElementById('eye-icon');
    var showPassword = document.getElementById('show_password');


    showPassword.addEventListener('click', function () {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        }
    });
    var confirmPasswordInput = document.getElementById('confirm-password');
    var eyeIcon1 = document.getElementById('eye-icon1');
    var showPassword1 = document.getElementById('show_password1');

    showPassword1.addEventListener('click', function () {
        if (confirmPasswordInput.type === 'password') {
            confirmPasswordInput.type = 'text';
            eyeIcon1.classList.remove('fa-eye-slash');
            eyeIcon1.classList.add('fa-eye');
        } else {
            confirmPasswordInput.type = 'password';
            eyeIcon1.classList.remove('fa-eye');
            eyeIcon1.classList.add('fa-eye-slash');
        }
    });

</script>
<?php
include('includes/login_footer.php');
?>