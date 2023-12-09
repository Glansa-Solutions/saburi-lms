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
                    <h4 class="card-title">Contact Details list</h4>
                    <div class="table-container" style="overflow-x: auto;">
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
                                if ($fetch_user_contact_details_query) {
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($fetch_user_contact_details_query)) {
                                        $id = $row['id'];
                                        $email = $row['email'];
                                        $phone_no = $row['phone_no'];
                                        $address_content = $row['address'];
                                        $address_text = strip_tags($address_content);
                                        $address = wordwrap($address_text, 8, "</br>\n");
                                        ?>
                                        <tr>
                                            <td>
                                                <?= $i; ?>
                                            </td>
                                            <td class="edit_id" hidden>
                                                <?= $id; ?>
                                            <td>
                                                <?= $email; ?>
                                            </td>
                                            <td>
                                                <?= $phone_no; ?>
                                            </td>
                                            <td>
                                                <?= $address; ?>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary me-2 p-2 edit-button"
                                                    data-bs-toggle="modal" data-id="<?= $id; ?>" data-email="<?= $email; ?>"
                                                    data-phone_no="<?= $phone_no; ?>" data-admin_name="<?= $name; ?>"
                                                    data-desc="<?= $address; ?>">Click here for
                                                    update</button>
                                                <button type="submit" class="btn btn-danger p-2 delete-button"
                                                    data-bs-toggle="modal" data-bs-target="#deletecontactModal"
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
        </div>
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Contact Details Page</h4>
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
                    <form class="forms-sample" id="entry_form" method="POST" action="../core/admin_functions.php">
                        <div class="form-group">
                            <label for="title">Email</label>
                            <input required type="email" id="emailInput" class="form-control" name="email"
                                placeholder="Enter Email">
                            <span id="errorEmail" style="color: red;"></span>
                            <input required type="hidden" id="admin_name" name="admin_name" value=<?= $name; ?>>
                        </div>
                        <div class="form-group">
                            <label for="image">phone Number</label>
                            <input required type="text" class="form-control" onkeypress="return isNumber(event)"
                                oninput="validatePhoneNumber()" value="" id="phoneNumber" name="phone_no">
                            <span id="errorPhn" style="color: red;"></span>
                        </div>
Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates dolorum facilis amet libero veritatis, modi ipsam corporis illo sunt, ad nobis vitae quis cumque eum magni id quam quo in?
                        <div class="form-group">
                            <label for="desc">Address</label>
                            <div name="editAddress">
                                <textarea required name="address" id="editAddress" class="mySummernote"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary me-2" id="insert_update"
                            name="contact_details">Submit</button>
                        <button type="button" class="btn btn-light" id="cancel_btn" onclick="resetForm()">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for editing blog content -->
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

                    <input required type="hidden" id="delete_id" name="delete_id">
                    Are you sure you want to delete this record?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger" name="delete_contact">Delete</button>
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
            var email = $(this).data('email');
            var desc = $(this).data('desc');
            var phone_no = $(this).data('phone_no');
            var admin_name = $(this).data('admin_name');

            $('#emailInput').val(email);
            $('#phoneNumber').val(phone_no);
            $('#editAddress').summernote('code', desc);
        });
        $('.delete-button').on('click', function (e) {
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