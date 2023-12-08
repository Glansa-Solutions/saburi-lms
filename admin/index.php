<?php
include('includes/login_header.php');
?>
<div class="container-scroller">
  <div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="content-wrapper d-flex align-items-center auth px-0">
      <div class="row w-100 mx-0">
        <div class="col-lg-4 mx-auto">
          <div class="auth-form-light text-left py-5 px-4 px-sm-5">
            <div class="brand-logo">
              <img src="assets/images/saburi.png" alt="logo">
            </div>
            <h4>Hello! let's get started</h4>
            <h6 class="fw-light">Sign in to continue.</h6>
            <!--  -->
            <form class="pt-3" action="../core/admin_functions.php" method="POST">
              <div class="form-group">
                <input type="text" class="form-control form-control-lg" name="admin_name" id="exampleInputEmail1"
                  placeholder="Enter u  sername">
              </div>
              <div class="form-group">
                <input type="password" class="form-control form-control-lg" name="admin_password"
                  id="exampleInputPassword1" placeholder="Password">
              </div>
              <div id="passwordError" class="text-danger">
                <?php
                // Display error message if set
                if (isset($_SESSION['errormessage'])) {
                  $message = $_SESSION['errormessage'];
                  echo '<div class="alert alert-danger mt-3" role="alert">' . $message . '</div>';
                  unset($_SESSION['errormessage']);
                }
                ?>
              </div>
              <div class="mt-3">
                <button type="submit" name="login_admin"
                  class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN
                </button>
              </div>
              <div class="text-center mt-4 fw-light">
                <a class="auth-link text-black" href="<?= $mainlink; ?>admin/forgotPassword">Forgot password?</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- content-wrapper ends -->
  </div>
  <!-- page-body-wrapper ends -->
</div>
<?php
include('includes/login_footer.php');
?>