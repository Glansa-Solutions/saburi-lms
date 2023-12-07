
<?php
include('includes/header.php');
include('includes/sidebar.php');
include('../core/listgrid.php');

?>


<!-- Main Content Panel -->
<div class="content-wrapper">
    <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <h4 class="card-title">Terms & Conditions List</h4>
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>S.no</th>
                                <th hidden></th>
                                <th>Heading</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            if($fetch_terms_query)
                            {
                                $i = 1;
                                while($row=mysqli_fetch_assoc($fetch_terms_query))
                                {
                                    $id = $row['id'];
                                    $heading=$row['Heading'];
                                    $desc = $row['Description'];
                                    
                                    
                                    ?>
                                <tr>
                                    <td><?= $i;?></td>
                                    <td class="edit_id" hidden><?= $id; ?>
                                    <td><?= $heading; ?></td>
                                    <td><?= $desc; ?></td>
                                    
                                    <td>
                                        <button type="submit" class="btn btn-primary me-2 p-2 edit-button"  data-bs-toggle="modal" data-bs-target="#edittermsmodal"
                                        data-id="<?= $id; ?>">Edit</button>
                                        <button type="submit" class="btn btn-danger p-2 delete-button" data-bs-toggle="modal" data-bs-target="#deleteHomeModal"  data-id="<?= $id; ?>">Delete</button>

                                    </td>
                                </tr>


                                <?php
                            $i++;
                                }
                                
                            }else {
                                echo "Query failed!";
                            }
                            ?>
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Terms & Conditions Page</h4>
                    <form class="forms-sample" method="POST" action="../core/admin_functions.php">
                    <div class="form-group">
                            <label for="heading">Heading</label>
                            <input type="text" class="form-control" name="heading"
                                placeholder="Enter Heading">
                        </div>

                        <div class="form-group">
                            <label for="desc">Description</label>
                            <textarea  name="Desc" class="mySummernote">
                            </textarea>    
                        </div>
                        

                        <button type="submit" class="btn btn-primary me-2" name="insert_terms">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
        

    </div>
</div>

 <!-- Modal for editing blog content -->
 <div class="modal fade" id="edittermsmodal" tabindex="-1" role="dialog" aria-labelledby="editBlogModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editBlogModalLabel">Edit Terms & Conditions</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="../core/admin_functions.php" >
                        <div class="modal-body">
                            <!-- Form for editing the blog content -->

                            <input type="hidden" id="termsId" name="termsId">
                            <div class="form-group">
                                <label for="editTitle">Heading</label>
                                <input type="text" class="form-control" id="editheading" name="editheading">
                            </div>

                            <div class="form-group">
                                <label for="editDescription">Description</label>
                                <textarea  name="editDesc" id="editAddress" class="mySummernote">
                            </textarea>    
                        </div>                           

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="saveChanges" name="update_terms">Save
                                Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="deleteHomeModal" tabindex="-1" role="dialog"
            aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="../core/admin_functions.php" method="POST">
                        <div class="modal-body">

                            <input type="hidden" id="delete_id" name="delete_id">
                            Are you sure you want to delete this record?
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger" name="delete_terms"
                                id="delete_home">Delete</button>
                        </div>
                </div>
            </div>
        </div>
<!-- Main Content ends -->
<script>
        $(document).ready(function() {
            $('.edit-button').on('click', function() {
                var termsId = $(this).closest('tr').find('.edit_id').text();
                console.log(termsId);
                $.ajax({
                    type: 'POST',
                    url: '../core/admin_functions.php', // Replace with the URL of your server-side script
                    data: {
                        'checking_edit_terms_btn': true,
                        'termsId': termsId,
                    },
                    // dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        $.each(response, function(key, value) {
                            $('#editheading').val(value['Heading']);
                            $('#editAddress').summernote('code', value['Description']);
                            $('#termsId').val(value['id']);
                        });
                    }
                });
            });
        });
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        
        <script>
        $(document).ready(function() {
            $('.delete-button').on('click', function(e) {
                e.preventDefault();
                var blogId = $(this).closest('tr').find('.edit_id').text();

                console.log(blogId);
                $('#delete_id').val(blogId);
                $('#deleteBlogModal').modal('show');

            });
        });
        </script>
<!-- Main Content ends -->

<?php

include('includes/footer.php');

?>


<!-- asdasasdasdsad -->

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
