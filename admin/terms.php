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
                    <h4 class="card-title">Terms & Conditions Page</h4>
                    <form class="forms-sample" method="POST" action="../core/functions.php">
                    <div class="form-group">
                            <label for="heading">Heading</label>
                            <input type="text" class="form-control" name="heading"
                                placeholder="Enter Heading">
                        </div>

                        <div class="form-group">
                            <label for="desc">Description</label>
                            <textarea  name="Desc" id="edit">
                            </textarea>    
                        </div>
                        

                        <button type="submit" class="btn btn-primary me-2" name="insert_terms">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
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
                    <form method="POST" action="../core/functions.php" >
                        <div class="modal-body">
                            <!-- Form for editing the blog content -->

                            <input type="hidden" id="termsId" name="termsId">
                            <div class="form-group">
                                <label for="editTitle">Heading</label>
                                <input type="text" class="form-control" id="editheading" name="editheading">
                            </div>

                            <div class="form-group">
                                <label for="editDescription">Description</label>
                                <textarea  name="editDesc" id="edit">
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
                    <form action="../core/functions.php" method="POST">
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
                    url: '../core/functions.php', // Replace with the URL of your server-side script
                    data: {
                        'checking_edit_terms_btn': true,
                        'termsId': termsId,
                    },
                    // dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        $.each(response, function(key, value) {
                            $('#editheading').val(value['Heading']);
                            $('#edit').val(value['Description']);
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