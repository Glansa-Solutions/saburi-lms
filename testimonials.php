<?php
include("includes/header.php");

// Clear the session message to avoid displaying it multiple times
?>
<section class="change_password p-5">
    <div class="container-fluid">
        <div class="container bg-light rounded">
            <div class="form-column1 col-lg-12 d-flex py-5">
                <div class="container col-md-8 py-3">
                    <h3>Give Your Valuable Feedback Here</h3>
                    <style>
                        .form-control {
                            width: 80%;
                        }
                    </style>
                    <form method="post" action="core/testimonials.php" class="py-3">
                        <div class="mb-4">
                            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                <input type="text" name="title" placeholder="Enter Title Here"
                                    class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                    id="title" required>
                                    <input type="hidden" name="role_id" value="<?=$_SESSION['role_id']; ?>">
                                    <input type="hidden" name="role" value="<?=$_SESSION['role']; ?>">

                                    
                            </p>
                        </div>
                        <div class="mb-4">
                            <textarea class="form-control woocommerce-Input woocommerce-Input--text input-text" name="description" style="background:#eee;border-radius:46px;"></textarea>
                        </div>
                        <?php

                        ?>
                        <div class="mb-4">
                            <h5>
                                <?
                                // $message;
                                // unset($_SESSION['message']);
                                ?>
                            </h5>
                        </div>
                        <button type="submit" name="proceed" class="btn btn-primary login_button">Proceed</button>
                    </form>
                </div>
                <div class="container col-md-4 py-3">
                    <!-- <h3>Password must containe</h3>
                    <ul>
                        <li>At leat 1 Uppercase letter (A-Z)</li>
                        <li>At leat 1 Number (0-9)</li>
                        <li>At leat 8 Characters</li>
                    </ul> -->
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