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
                            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                <input type="password" name="current_password" placeholder="Current Password"
                                    class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                    id="old_password" required>
                            </p>
                        </div>
                        <div class="mb-4">
                            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                <input type="password" name="new_password" placeholder="New Password"
                                    class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                    id="new_password" required>
                            </p>
                        </div>
                        <?php

                        ?>
                        <div class="mb-4">
                            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                <input type="password" name="conf_password" class="form-control"
                                    placeholder="Confirm Password" id="conf_password" required>
                            </p>
                            <!-- <?= $_SESSION['role']; ?> -->
                            <input type="hidden" name="role" value="<?= $role; ?>" class="form-control">
                            <!-- <input type="hidden" name="iv" value="<?= $iv; ?>" class="form-control"> -->
                            <input type="hidden" name="roleid" value="<?= $role_id ?>" class="form-control">
                        </div>
                        <div class="mb-4">
                            <h5>
                                <?= $message;
                                unset($_SESSION['message']);
                                ?>
                            </h5>
                        </div>
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