<?php
include("includes/header.php");

if (isset($_GET['role']) && isset($_GET['role_id']) && !empty($_GET['role_id'])) {
    $role = $_GET['role'];
    $role_id = $_GET['role_id'];
    $message = isset($_SESSION['message']) ? $_SESSION['message'] : "";
} else {
    $role = "";
    $role_id = "";
    $message = "";
}

// Clear the session message to avoid displaying it multiple times
?>
<section class="change_password p-5">
    <div class="container-fluid">
        <div class="container bg-light rounded">
            <div class="form-column1 col-lg-12 d-flex py-5">
                <div class="container col-md-8 py-3">
                    <h3>Change Password</h3>
                    <style>
                    .form-control {
                        width: 80%;
                    }
                    </style>
                    <form method="post" action="core/confirm_password.php" class="py-3">
                        <div class="mb-4">
                            <div
                                class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide position-relative">
                                <input type="password" name="current_password" class="form-control" id="login-password"
                                    placeholder="Current Password" required>
                                <div class="input-group-append">
                                    <span class="input-group-text eye" id="show-password">
                                        <i class="fa fa-eye-slash" id="eye-icon"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div
                                class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide position-relative">
                                <input type="text" name="new_password" class="form-control" id="login-password"
                                    placeholder="New Password" required>
                                <!-- <div class="input-group-append">
                                    <span class="input-group-text eye" id="show-password">
                                        <i class="fa fa-eye-slash" id="eye-icon"></i>
                                    </span>
                                </div> -->
                            </div>
                        </div>
                        <div class="mb-4">
                            <div
                                class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide position-relative">
                                <input type="password" name="conf_password" class="form-control" id="confirm-password"
                                    placeholder="Confirm Password" required>
                                <div class="input-group-append">
                                    <span class="input-group-text eye" id="show-password1">
                                        <i class="fa fa-eye-slash" id="eye-icon1"></i>
                                    </span>
                                </div>
                            </div>
                            <!-- <?= $_SESSION['role']; ?> -->
                            <input type="hidden" name="role" value="<?= $role; ?>" class="form-control">
                            <!-- <input type="hidden" name="iv" value="<?= $iv; ?>" class="form-control"> -->
                            <input type="hidden" name="roleid" value="<?= $role_id ?>" class="form-control">
                        </div>
                        <div class="mb-4" id="message-container">
                            <p id="status-message">
                                <?php 
                                echo $message;
                                unset($_SESSION['message']); ?>
                            </p>
                        </div>
                        <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            var messageContainer = document.getElementById('message-container');
                            var statusMessage = document.getElementById('status-message');

                            if (statusMessage.innerHTML.trim() === "Your password was updated") {
                                statusMessage.style.color = 'green';
                            } else {
                                statusMessage.style.color = 'red';
                            }

                            // Fade out the message after 3 seconds
                            setTimeout(function() {
                                messageContainer.style.opacity = '0';
                                messageContainer.style.transition = 'opacity 1s';
                            }, 3000);
                        });
                        </script>
                        <button type="submit" name="confrm_pass" class="btn btn-primary login_button">Proceed</button>
                    </form>
                </div>
                <div class="container col-md-4 py-3">
                    <h3>Password must containe</h3>
                    <ul>
                        <li>At leat 1 Uppercase letter (A-Z)</li>
                        <li>At leat 1 Number (0-9)</li>
                        <li>At leat 8 Characters</li>
                    </ul>
                </div>
            </div>
            <?php
            // if(isset($_GET['result'])&& $_GET['result']=='yes')
            // {
            //     echo '
            //     <div class="form-column1 col-lg-12 py-5 text-center">
            //     <div class="text mb-3">
            //         <h3>Your Password Has been updated</h3>
            //     </div>
            //     <div class="click">
            //         <a href="'.$mainlink.'account" class="btn btn-main btn-large rounded">Login Now</a>
            //     </div>
            
            // </div>
            //     ';
            // }else{
            //     echo"";
            // }
            
            ?>

        </div>
    </div>
</section>

<?php
include("includes/footer.php");
?>
<style>
.cta-2 {
    display: none;
}
</style>