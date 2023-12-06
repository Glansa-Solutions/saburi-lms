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
                    <h4 class="card-title">Contact Details Page</h4>
                    <!-- <p class="card-description">
                        You can Write the content for about page.
                    </p> -->
                   
                    <form class="forms-sample" method="POST" action="../core/admin_functions.php">
                        <div class="form-group">
                            <label for="title">Email</label>
                            <input type="email" class="form-control" name="email"
                                placeholder="Enter Email">
                        </div>
                        <div class="form-group">
                            <label for="image">phone Number</label>
                            <input type="text" class="form-control" name="phone_no" >
                        </div>
                       
                        <div class="form-group">
                            <label for="desc">Address</label>
                            <div name="editAddress">
                                <textarea  name="address" class="mySummernote"></textarea>
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <label for="banner_image">Banner Image</label>
                            <input type="file" class="form-control-file" id="banner_image" accept="image/*">
                        </div> -->

                        <button type="submit" class="btn btn-primary me-2" name="contact_details">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <h4 class="card-title">Contact Details  list</h4>
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>S.no</th>
                                <th hidden></th>
                                <th>Email</th>
                                <th>Phone No</th>
                                <th>Address</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            if($fetch_user_contact_details_query)
                            {
                                $i = 1;
                                while($row=mysqli_fetch_assoc($fetch_user_contact_details_query))
                                {
                                    $id = $row['id'];
                                    $email=$row['email'];
                                    $phone_no = $row['phone_no'];
                                    $address = $row['address'];
                                    
                                    ?>
                                <tr>
                                    <td><?= $i;?></td>
                                    <td class="edit_id" hidden><?= $id; ?>
                                    <td><?= $email; ?></td>
                                    <td><?= $phone_no; ?></td>
                                    <td><?= $address; ?></td>
                                    <td>
                                        <button type="submit" class="btn btn-primary me-2 p-2 edit-button"  data-bs-toggle="modal" data-bs-target="#editmodal"
                                        data-id="<?= $id; ?>">Edit</button>
                                        <button type="submit" class="btn btn-danger p-2 delete-button" data-bs-toggle="modal" data-bs-target="#deletecontactModal"  data-id="<?= $id; ?>">Delete</button>

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

    </div>
</div>

 <!-- Modal for editing blog content -->
 <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="editBlogModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editBlogModalLabel">Edit Contact</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="../core/admin_functions.php">
                        <div class="modal-body">
                            <!-- Form for editing the blog content -->

                            <input type="hidden" id="contatId" name="contatId">
                            <div class="form-group">
                                <label for="editTitle">Email</label>
                                <input type="text" class="form-control" id="editEmail" name="editEmail">
                            </div>

                            <div class="form-group">
                                <label for="editTitle">Phone No</label>
                                <input type="text" class="form-control" id="editPhone" name="editPhone">
                            </div>

                            <div class="form-group">
                                <label for="editDescription">Address</label>
                                <textarea  name="editAddress" id="editAddress" class="mySummernote">
                            </textarea>    
                            </div>
                       </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="update_contactDetaills">Save
                                Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="deletecontactModal" tabindex="-1" role="dialog"
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
                            <button type="submit" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger" name="delete_contact"
                               >Delete</button>
                        </div>
                </div>
            </div>
        </div>
<!-- Main Content ends -->
<script>
        $(document).ready(function() {
            $('.edit-button').on('click', function() {
                var contactId = $(this).closest('tr').find('.edit_id').text();
                console.log(contactId);
                $.ajax({
                    type: 'POST',
                    url: '../core/admin_functions.php', // Replace with the URL of your server-side script
                    data: {
                        'checking_edit_contacts_btn': true,
                        'contactId': contactId,
                    },
                    // dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        $.each(response, function(key, value) {
                            $('#editEmail').val(value['email']);
                            $('#editPhone').val(value['phone_no']);
                            
                            // You can handle image display or updating as needed
                            // $('#edit').val(value['address']);
                            $('#editAddress').summernote('code', value['address']);
                            // console.log(a);
                            $('#contatId').val(value['id']);
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
                $('#deletecontactModal').modal('show');

            });
        });
        </script>

<?php

include('includes/footer.php');

?>