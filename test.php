<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Email Validation</title>
  <!-- Bootstrap CSS (for styling, you can adjust it based on your needs) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    /* Add your own styling here */
    .form-container {
      max-width: 400px;
      margin: auto;
      padding: 20px;
      margin-top: 50px;
    }
  </style>
</head>
<body>

  <div class="form-container">
    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
      <label>Company Email&nbsp;<span class="required">*</span></label>
      <input type="email"
             class="woocommerce-Input woocommerce-Input--text input-text form-control"
             name="email" id="emailInput" autocomplete="password" value="" required>
      <span id="errorEmail" style="color: red;"></span>
    </p>
    <button class="btn btn-primary">Submit</button>
  </div>

  <script>
    var emailInput = document.getElementById('emailInput');
    var errorEmail = document.getElementById('errorEmail');

    emailInput.addEventListener('blur', function () {
      validateEmail();
    });

    function validateEmail() {
      var emailValue = emailInput.value.trim();
      var commonDomainPattern = /^(.+)@(gmail\.com|yahoo\.com|yahoo\.co.in|glansa\.com|glansa\.in|outlook\.com|iCloud\.com|live\.com|mail\.com)$/i;

      if (emailValue === '') {
        errorEmail.textContent = 'Email is required.';
      } else if (!commonDomainPattern.test(emailValue) || emailValue.includes(',')) {
        errorEmail.textContent = 'Enter a valid email address.';
      } else {
        errorEmail.textContent = ''; // Clear error message if validation passed
        // Additional logic to submit the form or take further actions
      }
    }
  </script>

  <!-- Bootstrap JS (Popper.js and Bootstrap JS) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
