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
                    <h4 class="card-title">Home Grid View</h4>
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>S.no</th>
                                <th hidden></th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Banner</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($fetch_home_query) {
                                $i = 1;
                                while ($row = mysqli_fetch_assoc($fetch_home_query)) {
                                    $id = $row['id'];
                                    $title = $row['Title'];
                                    $desc = $row['Description'];
                                    $bannerImage = $row['bannerImage'];

                                    ?>
                                    <tr>
                                        <td>
                                            <?= $i; ?>
                                        </td>
                                        <td class="edit_id" hidden>
                                            <?= $id; ?>
                                        <td>
                                            <?= $title; ?>
                                        </td>
                                        <td>
                                            <?= strip_tags($desc); ?>
                                        </td>
                                        <td><img src="../assets/images/home/<?= $bannerImage; ?>" width="80" height="80"></td>

                                        <td>
                                            <button type="button" class="btn btn-primary me-2 p-2 edit-button"
                                                data-bs-toggle="modal" data-id="<?= $id; ?>" data-title="<?= $title; ?>"
                                                data-admin_name="<?= $name; ?>" data-desc="<?= strip_tags($desc); ?>"
                                                data-banner="<?= $bannerImage; ?>">Click here for update</button>

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
                    <h4 class="card-title">Home Page</h4>
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
                    <form class="forms-sample" method="POST" action="../core/admin_functions.php"
                        enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="banner_title">Title</label>
                            <input type="text" class="form-control" onkeypress="return isText(event)" name="title"
                                id="banner_title" placeholder="Enter Banner Title" required>
                            <input type="hidden" id="admin_name" name="admin_name" value=<?= $name; ?>>
                        </div>
                        <div class="form-group">
                            <label for="banner_desc">Description</label>
                            <div name="editAddress">
                                <textarea name="desc" id="editAddress" class="mySummernote"></textarea>
                            </div>
                        </div>
                        <div class="images d-flex justify-content-between">
                            <div class="form-group">
                                <label for="banner_image">Banner Image</label>
                                <input type="file" name="bannerImage" class="form-control-file" id="banner_image"
                                    accept="image/*">
                            </div>
                            <div class="form-group">
                                <label for="banner_image">Current Image</label>
                                <div class="col-md-12">
                                    <div class="container">
                                        <img id="dynamicImage" class="img-fluid w-50" alt="Dynamic Image">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" id="insert_update" name="insert_home" class="btn btn-primary me-2">Submit</button>
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
                <h5 class="modal-title" id="editBlogModalLabel">Edit Home</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="../core/admin_functions.php" enctype="multipart/form-data">
                <div class="modal-body">
                    <!-- Form for editing the blog content -->

                    <input type="hidden" id="homeId" name="homeId">
                    <div class="form-group">
                        <label for="editTitle">Title</label>
                        <input type="text" class="form-control" onkeypress="return isNumber(event)" id="editTitle"
                            name="editTitle">
                    </div>

                    <div class="form-group">
                        <label for="editDescription">Description</label>
                        <textarea name="editDesc" id="editAddress" class="mySummernote">
                            </textarea>
                    </div>

                    <div class="form-group">
                        <label for="editImage">Image</label>
                        <input type="file" class="form-control" onchange="loadFile(event)" id="editImage"
                            name="editImage">

                        <input type="hidden" id="oldImage" name="oldImage" width="80" height="80" />
                    </div>

                    <div class="form-group">
                        <label for="editTitle">Existing Image</label><br>

                        <img src="" id="output" name="output" width="80" height="80" />
                    </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="saveChanges" name="update_home">Save
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger" name="delete_home" id="delete_home">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Main Content ends -->
<script>
    $(document).ready(function () {
        // $('.edit-button').on('click', function () {
        //     var homeId = $(this).closest('tr').find('.edit_id').text();
        //     console.log(homeId);
        //     $.ajax({
        //         type: 'POST',
        //         url: '../core/admin_functions.php', // Replace with the URL of your server-side script
        //         data: {
        //             'checking_edit_home_btn': true,
        //             'homeId': homeId,
        //         },
        //         // dataType: 'json',
        //         success: function (response) {
        //             console.log(response);
        //             $.each(response, function (key, value) {
        //                 $('#editTitle').val(value['Title']);
        //                 $('#output').attr('src', '../assets/images/home/' +
        //                     value['bannerImage']);
        //                 // You can handle image display or updating as needed
        //                 $('#editAddress').summernote('code', value['Description']);
        //                 // console.log(a);
        //                 $('#homeId').val(value['id']);
        //             });
        //         }
        //     });
        // });
        $('.edit-button').on('click', function () {
            $('#insert_update').text('Update');
            // Retrieve data attributes
            var id = $(this).data('id');
            var title = $(this).data('title');
            var desc = $(this).data('desc');
            var bannerImage = $(this).data('banner');
            var admin_name = $(this).data('admin_name');

            $('#banner_title').val(title);
            $('#editAddress').summernote('code', desc);
            // $('#banner_image').val(bannerImage);
            $('#dynamicImage').attr('src', '../assets/images/home/' + bannerImage);

        });
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
    var loadFile = function (event) {

        var output = document.getElementById('output');

        output.src = URL.createObjectURL(event.target.files[0]);

        output.onload = function () {

            URL.revokeObjectURL(output.src) // free memory

        }

    };
</script>
<script>
    $(document).ready(function () {
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