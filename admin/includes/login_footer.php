<!-- container-scroller -->
  <!-- plugins:js -->
  <script src="assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="assets/js/off-canvas.js"></script>
  <script src="assets/js/hoverable-collapse.js"></script>
  <script src="assets/js/template.js"></script>
  <script src="assets/js/settings.js"></script>
  <script src="assets/js/todolist.js"></script>
  <!-- endinject -->
</body>
<script>
  // Add this script to show/hide the password error message
  <?php
  // Check if the login failed due to incorrect password
  if (isset($error_message) && strpos($error_message, "Incorrect email or password") !== false) {
    echo 'document.getElementById("passwordError").innerText = "Incorrect password. Please try again.";';
  }
  ?>
</script>

</html>