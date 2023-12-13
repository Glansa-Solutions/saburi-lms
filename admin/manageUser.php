<?php
include('includes/header.php');
include('includes/sidebar.php');
include('../core/listgrid.php');
?>
<div class="content-wrapper">
    <div class="row">
        <!-- <div class="col-md-12 grid-margin stretch-card ">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">User Management</h4>
                    <form class="forms-sample row" id="entry_form" action="../core/admin_functions.php" method="POST">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Name" required>
                            </div>
                            <div class="form-group">
                                <label for="phoneNumber">Phone Number</label>
                                <input type="text" class="form-control" name="phoneNumber"
                                    placeholder="Enter Phone Number" required>
                            </div>

                            <div class="form-group">
                                <label for="userType">User Type</label>
                                <select class="form-control" name="userType" required>
                                    <option value="">--select one--</option>
                                    <option value="admin">Admin</option>
                                    <option value="student">Student</option>
                                    <option value="company">Company</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="userId">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Enter Email Address"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="userId">User ID</label>
                                <input type="text" class="form-control" name="user_id" placeholder="Enter user id"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="pwd">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="pwd" name="pwd"
                                        placeholder="Password" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-eye" id="showPassword"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea type="text" class="form-control" name="address" placeholder="Enter Address"
                                    required> </textarea>
                            </div>


                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary me-2" name="user_manage">Submit</button>
                            <button type="button" class="btn btn-light" id="cancel_btn"
                                onclick="resetForm()">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> -->
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Manage User</h4>

                    </style>
                    <div style="overflow-x: auto;">
                        <table id="example" class="table table-striped table-bordered" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th hidden></th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($fetch_list_query) {
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($fetch_list_query)) {
                                        $id = $row['id'];
                                        $user_name = $row['Name'];
                                        $user_email = $row['Email'];
                                        $user_phone = $row['Phone'];
                                        $user_address = $row['Address'];
                                        ?>
                                        <tr>
                                            <td>
                                                <?= $i; ?>
                                            </td>
                                            <td class="edit_id" hidden>
                                                <?= $id; ?>
                                            <td>
                                                <?= $user_name; ?>
                                            </td>
                                            <td>
                                                <?= $user_email; ?>
                                            </td>
                                            <td>
                                                <?= $user_phone; ?>
                                            </td>
                                            <td>
                                                <?= $user_address; ?>
                                            </td>
                                            <td>
                                                <button type="submit" class="btn btn-primary me-2 p-2 edit-button"
                                                    data-bs-toggle="modal" data-bs-target="#editmodal"
                                                    data-id="<?= $id; ?>">Edit</button>
                                                <button type="submit" class="btn btn-danger p-2 delete-button"
                                                    data-bs-toggle="modal" data-bs-target="#deleteModal"
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
    </div>
</div>

<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="editBlogModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBlogModalLabel">Edit User</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="../core/admin_functions.php" enctype="multipart/form-data">
                <div class="modal-body">
                    <!-- Form for editing the blog content -->

                    <input type="hidden" id="user_id" name="user_id">
                    <div class="form-group">
                        <label for="editTitle">Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>

                    <div class="form-group">
                        <label for="editTitle">Email</label>
                        <input type="text" class="form-control" id="email" name="email">
                    </div>

                    <div class="form-group">
                        <label for="editTitle">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone">
                    </div>

                    <div class="form-group">
                        <label for="editTitle">address</label>
                        <input type="text" class="form-control" id="address" name="address">
                    </div>




                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="saveChanges" name="update_user">Save
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
                    <button type="submit" class="btn btn-danger" name="delete_user" id="delete_user">Delete</button>
                </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        $('.edit-button').on('click', function () {
            var userId = $(this).closest('tr').find('.edit_id').text();
            // console.log(userId);
            $.ajax({
                type: 'POST',
                url: '../core/admin_functions.php', // Replace with the URL of your server-side script
                data: {
                    'checking_user_btn': true,
                    'userId': userId,
                },
                // dataType: 'json',
                success: function (response) {
                    console.log(response);
                    $.each(response, function (key, value) {

                        // Populate the input elements with data received from the server
                        $('#name').val(value['Name']);
                        $('#email').val(value['Email']);
                        $('#phone').val(value['Phone']);
                        $('#address').val(value['Address']);
                        $('#user_id').val(value['id']);
                        $('#editmodal').modal('show');
                    });

                }
            });
        });
    });

</script>
<script>
    $(document).ready(function () {
        $('.delete-button').on('click', function (e) {
            e.preventDefault();
            var userId = $(this).closest('tr').find('.edit_id').text();

            console.log(userId);
            $('#delete_id').val(userId);
            $('#deleteModal').modal('show');

        });
    });
</script>
<script>
    const passwordInput = document.getElementById('pwd');
    const showPasswordIcon = document.getElementById('showPassword');

    showPasswordIcon.addEventListener('click', () => {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            showPasswordIcon.classList.remove('fa-eye');
            showPasswordIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            showPasswordIcon.classList.remove('fa-eye-slash');
            showPasswordIcon.classList.add('fa-eye');
        }
    });
</script>

<?php

include('includes/footer.php');

?>