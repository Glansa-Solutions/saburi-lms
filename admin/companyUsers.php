<?php
include('includes/header.php');
include('includes/sidebar.php');
?>


<!-- Main Content Panel -->
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Company Users</h4>
                    <div class="table-container" style="overflow-x: auto;">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Company Name</th>
                                    <th>User Name</th>
                                    <th>Password</th>
                                    <th>Course Name</th>
                                    <th>Validity</th>
                                    <!-- <th>Email</th> -->
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($query_fetch_company_users) {
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($query_fetch_company_users)) {
                                        $id = $row['id'];
                                        $companyName = $row['companyName'];
                                        $userName = $row['email'];
                                        $password = $row['password'];
                                        $courseName = $row['courseName'];
                                        $validity = $row['ValidTill'];
                                        $isActive = $row['IsActive'];
                                        $session_active = $row['session_id'];

                                        ?>
                                        <tr>
                                            <td>
                                                <?= $i; ?>
                                            </td>
                                            <td>
                                                <?= $companyName; ?>
                                            </td>
                                            <?php
                                            if ($session_active == 0) {
                                                $color = "red";
                                                $status = "offline";
                                            } else {
                                                $color = "green";
                                                $status = "Online";
                                            }
                                            ?>
                                            
                                            <td><sup class="status" style="color:
                                                        <?= $color; ?>
                                                    ;font-weight:800;">
                                                    <?= $status; ?>
                                                </sup>
                                                <?= $userName; ?>
                                            </td>
                                            <td>
                                                <?= $password; ?>
                                            </td>
                                            <td>
                                                <?= $courseName; ?>
                                            </td>
                                            <td>
                                                <?= $validity; ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($isActive == 1) {
                                                    ?>

                                                    <button class="btn btn-danger p-2 freeze-button" data-bs-toggle="modal"
                                                        data-bs-target="#freezeModal" data-company-id="<?= $id ?>">Freeze</button>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <button class="btn btn-success p-2 unfreeze-button" data-bs-toggle="modal"
                                                        data-bs-target="#unfreezeModal"
                                                        data-company-id="<?= $id ?>">Unfreeze</button>
                                                    <?php
                                                }
                                                ?>
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

                    <!-- Modals starts-->

                    <div class="modal fade" id="freezeModal" tabindex="-1" role="dialog"
                        aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Freeze</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form class="delete_form">
                                    <div class="modal-body">

                                        <input type="hidden" id="freeze_id" name="freeze_id">
                                        <span>Are you sure you want to freeze this account?</span>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-danger" name="freeze_user"
                                            id="freeze_user">Yes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="unfreezeModal" tabindex="-1" role="dialog"
                        aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Unfreeze</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form class="delete_form">
                                    <div class="modal-body">

                                        <input type="hidden" id="unfreeze_id" name="unfreeze_id">
                                        <span>Are you sure you want to unfreeze this account?</span>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-danger" name="unfreeze_user"
                                            id="unfreeze_user">Yes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Modals end-->
                </div>
            </div>

        </div>
    </div>
    <!-- Main Content ends -->
    <script>
        $(document).ready(function () {

            $('.freeze-button').on('click', function () {
                var id = $(this).data('company-id');
                $('#freeze_id').val(id); // Use the correct ID "delete_id"
                // alert(view_comment);
            });

            $('.unfreeze-button').on('click', function () {
                var id = $(this).data('company-id');
                $('#unfreeze_id').val(id); // Use the correct ID "delete_id"
                // alert(view_comment);
            });
            $('#freeze_user').on('click', function () {
                // Get the value of delete_id
                var freeze_id = $('#freeze_id').val();
                $.ajax({
                    type: 'POST',
                    url: '../core/admin_functions.php',
                    data: {
                        'freeze_id': freeze_id,
                    },
                    success: function (response) {
                        window.location.reload();
                    },
                    error: function (xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                    }
                });
            });

            $('#unfreeze_user').on('click', function () {
                // Get the value of delete_id
                var unfreeze_id = $('#unfreeze_id').val();
                $.ajax({
                    type: 'POST',
                    url: '../core/admin_functions.php',
                    data: {
                        'unfreeze_id': unfreeze_id,
                    },
                    success: function (response) {
                        window.location.reload();
                    },
                    error: function (xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                    }
                });
            });


        });
    </script>


    <?php

    include('includes/footer.php');

    ?>