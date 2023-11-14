<?php include("includes/header.php");

?>

<section class="about-section section-padding about-2">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-lg-6 col-md-12">
                <div class="section-heading">
                    <span class="subheading">Thank you</span>
                    <h3>The Username and Password Sent To Your Registered Email</h3>
                </div>
                <?php
                if (isset($_GET['id'])) {
                    $student_id = $_GET['id'];
                ?>
                <a href="account?role=<?= $role ?>&id=<?= $student_id?>" class="btn btn-main"><i class="fa fa-check mr-2"></i>Login</a>
                <?php
                } else {
                    $role = '';
                ?>
                 <a href="log_reg" class="btn btn-main"><i class="fa fa-check mr-2"></i>Login</a>
                <?php
                    
                }
                ?>
                
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="about-img2">
                    <img src="assets/images/bg/choose.png" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</section>

<?php include("includes/footer.php"); ?>