<?php
include('includes/header.php');
include('includes/sidebar.php');
include('../core/listgrid.php');


$sql = "SELECT id, name FROM careercategory";
$result = $con->query($sql);
?>


<!-- Main Content Panel -->

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Career Page</h4>
                    <form class="forms-sample" action="functions/functions" method="POST">
                        <div class="form-row d-flex">
                            <div class="form-group col-md-10">
                                <label for="title">Category</label>
                                <input type="text" class="form-control" name="category" placeholder="Enter Title" required>
                            </div>

                            <div class="form-group col-md-2">
                                <label>&nbsp;</label>
                                <button class="btn btn-primary " name="addCategory" type="submit">ADD</button>
                            </div>
                        </div>
                        <!-- Additional row for displaying added data -->
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <form class="forms-sample" action="../core/admin_functions.php" method="POST">
                    <h4 class="card-title">Career Page</h4>
                      <div class="form-group">
                        <label for="categorySelect">Category</label>   
                        <select class="form-control" id="categorySelect" name="category">
                            <option>Select Category</option>
                        <?php
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                                }
                                ?>
                        </select>
                    </div>


                    <input type="hidden" id="selectedCategoryId" name="selectedCategoryId" value="">

                        <div class="form-group">
                            <label for="title">Designation</label>
                            <input type="text" class="form-control" name="title" placeholder="Enter Title ">
                        </div>
                        <div class="form-group">
                            <label for="exp">Years of Experience</label>
                            <input type="number" class="form-control" name="exp"
                                placeholder="Enter Years of Experience">
                        </div>
                        <div class="form-group">
                            <label for="desc">Description</label>
                            <div id="editor">
                            <textarea class="mySummernote" name="desc">
                            </textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary me-2" name="career_manage">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Career List</h4>
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>S.no</th>
                                <th hidden></th>
                                <th>Title</th>
                                <th>Years Of Exp</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if($fetch_list_careers_query)
                            {
                                $i = 1;
                                while($row=mysqli_fetch_assoc($fetch_list_careers_query))
                                {
                                    $id=$row['Id'];
                                    $title=$row['Title'];
                                    $experience=$row['Experience'];
                                    $description=$row['Description'];
                                    ?>
                            <tr>
                                <td><?= $i;?></td>
                                <td class="edit_id" hidden><?= $id;?></td>
                                <td><?= $title; ?></td>
                                <td><?= $experience; ?></td>
                                <td><?= $description; ?></td>
                                <td>
                                    <button type="submit" class="btn btn-primary me-2 p-2 edit-button"
                                        data-bs-toggle="modal" data-bs-target="#editmodal"
                                        data-id="<?= $id; ?>">Edit</button>
                                    <button type="submit" class="btn btn-danger p-2 delete-button"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal"
                                        data-id="<?= $id; ?>">Delete</button>
                                        <a style="text-decoration:none;color:white;"href="viewApplication.php?id=<?php echo $row['Id']; ?>"><button type="submit" class="btn btn-success p-2"
                                        data-id="<?= $id; ?>">View Application</a></button>
                                </td>
                            </tr>
                            <?php
                            $i++;
                                }
                                } else {
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
<!-- Main Content ends -->
<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="editBlogModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBlogModalLabel">Edit Career</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="../core/admin_functions.php">
                <div class="modal-body">
                    <!-- Form for editing the blog content -->

                    <input type="hidden" id="careerId" name="careerId">
                    <div class="form-group">
                        <label for="editTitle">Designation</label>
                        <input type="text" class="form-control" id="title" name="title">
                    </div>

                    <div class="form-group">
                        <label for="editTitle">Years Of Experience</label>
                        <input type="text" class="form-control" id="yoe" name="yoe">
                    </div>

                    <div class="form-group">
                        <label for="editTitle">Description</label>
                        <div id="editor"> 
                            <!-- <div type="text" class="editdesc"></div> -->
                            <textarea class="form-control editdesc" id="edt" name="description"></textarea>
                            <!-- <input type="textarea" class="form-control editdesc" id="edt" name="description"> -->
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="saveChanges" name="update_career">Save
                        Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel"
    aria-hidden="true">
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
                    <button type="submit" class="btn btn-danger" name="delete_career" id="delete_career">Delete</button>
                </div>
        </div>
    </div>
</div>

<!-- Add this script to update the hidden input field with the selected category ID -->
<script>
$(document).ready(function() {
    $('#categorySelect').on('change', function() {
        var selectedCategoryId = $(this).val();
        $('#selectedCategoryId').val(selectedCategoryId);
    });
});
</script>

<script>
$(document).ready(function() {
    $('.edit-button').on('click', function() {
        var careerId = $(this).closest('tr').find('.edit_id').text();
        console.log(careerId);
        $.ajax({
            type: 'POST',
            url: '../core/admin_functions.php', // Replace with the URL of your server-side script
            data: {
                'checking_career_btn': true,
                'careerId': careerId,
            },
            // dataType: 'json',
            success: function(response) {
                console.log(response);
                $.each(response, function(key, value) {

                    // Populate the input elements with data received from the server
                    $('#title').val(value['Title']);
                    $('#yoe').val(value['Experience']);
                    // $('.editdesc').val(value['Description']);
                    console.log(value['Description']);
                    $('.editdesc').text(value['Description']);
                    
                    $('#careerId').val(value['Id']);
                    $('#editmodal').modal('show');
                });

            }
        });
    });
});
</script>

<script>
$(document).ready(function() {
    $('.delete-button').on('click', function(e) {
        e.preventDefault();
        var careerId = $(this).closest('tr').find('.edit_id').text();

        console.log(careerId);
        $('#delete_id').val(careerId);
        $('#deleteModal').modal('show');

    });
});
</script>

<?php

include('includes/footer.php');

?>