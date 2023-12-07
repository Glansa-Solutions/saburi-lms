<?php
include('includes/login_header.php');
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
            <h2>Forgot Password</h2>
            <h6 class="fw-light">Enter your email and we'll send you a reset your password</h6>
            <form class="pt-3">
              <div class="form-group">
                <input type="email" class="form-control form-control-lg" id="admin_email"
                  placeholder="Enter your email address">
              </div>
              <div class="mt-3">
                <a class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                  id="send_mail_f_p">Submit</a>
              </div>
              <div class="text-center mt-4 fw-light">
                <span class="fa-solid fa-angle-left "></span> <a href="<?= $mainlink; ?>admin/" class="text-primary"
                  style="text-decoration: none">Back to Login</a>
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
<script>
  $(document).ready(function () {
    $('#send_mail_f_p').on('click', function () {
      var send_mail_f_p = $('#admin_email').val();

      $('#alertContainer').html('<div class="alert alert-info alert-dismissible fade show" role="alert">' +
        '<strong>Sending, please wait...</strong>' +
        '</div>');

      $.ajax({
        method: 'POST',
        url: '../core/admin_mail_functions.php',
        data: {
          admin_email: send_mail_f_p,
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

          setTimeout(function () {
            window.location.href = '<?= $mainlink;?>admin/';
          }, 2000);
        },
        error: function (xhr, status, error) {
          // Handle errors if the AJAX request fails
          console.error("AJAX request failed: " + error);
        }
      });
    });
  })

</script>
<?php
include('includes/login_footer.php');
?>