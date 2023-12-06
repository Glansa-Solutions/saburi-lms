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
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>S.no</th>
                                <th hidden></th>
                                <th hidden></th>
                                <!-- <th>Heading</th>
                                <th>Title</th> -->
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($fetch_terms_query) {
                                $i = 1;
                                while ($row = mysqli_fetch_assoc($fetch_terms_query)) {
                                    $id = $row['id'];
                                    $heading = $row['Heading'];
                                    $desc_content = $row['Description'];
                                    $desc_text = strip_tags($desc_content);
                                    $desc = wordwrap($desc_text, 100, "</br>\n");
                                    $small_desc = substr($desc, 0, 150);

                                    ?>
                                    <tr>
                                        <td>
                                            <?= $i; ?>
                                        </td>
                                        <td class="edit_id" hidden>
                                            <?= $id; ?>
                                        </td>
                                        <!-- <td>
                                            <?= $heading; ?>
                                        </td>
                                        <td>
                                            <?= $title; ?>
                                        </td> -->
                                        <td id="desc" hidden>
                                            <?= $desc_content; ?>...
                                        </td>
                                        <td>
                                            <?= $small_desc; ?>...
                                        </td>

                                        <td>
                                            <button type="button" class="btn btn-primary me-2 p-2 edit-button"
                                                data-bs-toggle="modal" data-id="<?= $id; ?>" data-admin_name="<?= $name; ?>"
                                                data-desc="<?= strip_tags($desc_content); ?>">Click here for update</button>
                                            <button type="submit" class="btn btn-danger p-2 delete-button"
                                                data-bs-toggle="modal" data-bs-target="#deleteHomeModal"
                                                data-id="<?= $id; ?>">Delete</button>

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
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Terms & Conditions Page</h4>
                    <?php if (isset($_SESSION['status']) && isset($_SESSION['message'])) {
                        $status = $_SESSION['status'];
                        $message = $_SESSION['message'];
                        ?>
                        <div class="alert alert-<?= ($status == "success") ? 'success' : 'danger'; ?> w-50 alert-dismissible fade show"
                            role="alert">
                            <strong>
                                <?= $message; ?>
                            </strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php unset($_SESSION['message']);
                    } ?>

                    <form class="forms-sample" id="entry_form" method="POST" action="../core/admin_functions.php"
                        enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="hidden" id="admin_name" name="admin_name" value=<?= $name; ?>>

                            <label for="desc">Your Description Here</label>
                            <div name="editAddress">
                                <textarea name="desc" id="editAddress" class="mySummernote"></textarea>
                            </div>
                        </div>

                        <button type="submit" id="insert_update" class="btn btn-primary me-2"
                            name="insert_terms">Submit</button>
                        <button type="button" class="btn btn-light" id="cancel_btn" onclick="resetForm()">Reset</button>
                    </form>
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
                <h5 class="modal-title" id="editBlogModalLabel">Edit Privacy & Policy</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="../core/admin_functions.php">
                <div class="modal-body">
                    <!-- Form for editing the blog content -->

                    <div class="form-group">
                        <label for="editTitle">Heading</label>
                        <input type="text" class="form-control" id="editHeading" name="editHeading">
                    </div>

                    <div class="form-group">
                        <label for="editTitle">Title</label>
                        <input type="text" class="form-control" id="editTitle" name="editTitle">
                    </div>


                    <div class="form-group">
                        <label for="editDescription">Description</label>
                        <textarea id="editAddress" class="mySummernote" name="editDesc">
                            </textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="saveChanges" name="update_privcy">Save
                        Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteHomeModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel"
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger" name="delete_terms" id="delete_home">Delete</button>
                </div>
        </div>
    </div>
</div>
<!-- Main Content ends -->
<script>
    $(document).ready(function () {
        $('.edit-button').on('click', function () {
            $('#insert_update').text('Update');
            // Retrieve data attributes
            var id = $(this).data('id');
            var title = $(this).data('title');
            var desc = $('#desc').text();
            var admin_name = $(this).data('admin_name');
            $('#editAddress').summernote('code', desc);

        });
        $('.delete-button').on('click', function (e) {
            e.preventDefault();
            var blogId = $(this).closest('tr').find('.edit_id').text();

            console.log(blogId);
            $('#delete_id').val(blogId);
            $('#deleteBlogModal').modal('show');

        });
    });
</script>

<?php

include('includes/footer.php');

?>