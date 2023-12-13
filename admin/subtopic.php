<?php
include('includes/header.php');
include('includes/sidebar.php');
include('../core/listgrid.php');

?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card ">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Sub Topic Details</h4>
                    <form class="forms-sample" id="entry_form" action="../core/admin_functions.php" method="POST">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name"> Topic Name</label>
                                <select class="form-control" name="topic" required>
                                    <option value=""> Select Topic Name</option>
                                    <?php
                                    
                                    if ($fetch_list_topic_query) {
                                        // $i = 1;
                                        while ($row = mysqli_fetch_assoc($fetch_list_topic_query)) {

                                            // echo $topic_id;
                                    ?>

                                            <option value=<?= $row['Id']; ?>> <?= $row['topicName']; ?></option>
                                    <?php
                                        }
                                    } else {
                                        echo "Query failed!";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name"> Sub Topic Name</label>
                                <input type="text" class="form-control" name="subtopic" placeholder="Enter Sub Topic Name" required>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary me-2" name="subtopic_manage">Submit</button>
                            <button type="button" class="btn btn-light" id="cancel_btn" onclick="resetForm()">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Manage Sub Topics</h4>
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>S.no</th>
                                <th hidden>ID</th>
                                <th>Topic Name</th>
                                <th>Sub Topic Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($fetch_list_join_topics_subtopic_query) {
                                $i = 1;
                                while ($row = mysqli_fetch_assoc($fetch_list_join_topics_subtopic_query)) {
                                // var_dump($row);
                            ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td class="edit_id" hidden><?= $row['id']; ?></td>
                                        <td><?= $row['topicName']; ?></td>
                                        <td><?= $row['subTopicName']; ?></td>
                                        <td>
                                            <button type="submit" class="btn btn-primary me-2 p-2 edit-button" data-bs-toggle="modal" data-bs-target="#editmodal" data-id="<?= $row['id']; ?>">Edit</button>
                                            <button type="submit" class="btn btn-danger p-2 delete-button" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $row['id']; ?>">Delete</button>
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

                <!-- Edit Modal -->
                <div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form class="forms-sample">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Sub Topics</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="col-md-12 grid-margin stretch-card">

                                        <div class="form col-md-12">
                                            <div class="form-group">
                                                <!-- <input type="text" > -->

                                                <label for="name">Topic Name</label>
                                                <input type="hidden" class="form-control" name="name" placeholder="Enter Name" id="editrow">
                                                <select class="form-control" name="topic" id="topic" required>
                                                <option value=""> Select Topic Name</option>

                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="details">Sub Topic Name</label>
                                                <input type="text" class="form-control" name="subtopic" id="subtopic_name" required>
                                            </div>

                                        </div>

                                        <!-- </div>
                                    </div> -->
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary update_sb_tpc" name="update_sb_tpc">Update
                                        Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Edit Modal end -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
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
                <button type="submit" class="btn btn-danger" name="delete_subtopic" id="delete_subtopic">Delete</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.edit-button').on('click', function() {
            var rowid = $(this).data('id');
            $('#editrow').val(rowid);
            var editRow = $('#editrow').val(rowid);

            console.log(rowid);

            $.ajax({
                url: '../core/edit_subTopic.php', 
                data: {
                    sub_topic_id: rowid
                },
                method: 'GET',
                success: function(data) {
                    // Populate the subtopic select with the retrieved data
                    $('#topic').html(data);
                    // $('#subtopic_name').html(data);
                }
            });
            $.ajax({
                url: '../core/subTopic_modalData.php', 
                data: {
                    sub_topic_name: rowid
                },
                method: 'GET',
                success: function(data) {
                    // Populate the subtopic select with the retrieved data
                    var editRow = $('#subtopic_name').val(data);
                    // $('#subtopic_name').val(data);
                    // $('#subtopic_name').html(data);
                }
            });
 

        });
        // $('.update_sb_tpc').on('click', function() {
        //     var sb_tp_id = $('#editrow').val();
        //     var tp_id = $('#topic').val();
        //     var sub_tp_name = $('#subtopic_name').val();
            
        //     console.log("Topic Name: " + tp_id + ", Sub Topic Name: " + sub_tp_name);
        //     $.ajax({
        //         url: '../core/subTopic_modalData.php',
        //         data: {
        //             updated_subtopic_name: sub_tp_name,
        //             updated_topic_id: tp_id,
        //             sb_tp_id: sb_tp_id
        //         },
        //         method: 'POST',
        //         success: function(data) {
        //             console.log("Response from server:", data);

        //             // header('location:subtopic')

        //             // Reload the page after a successful update

        //             // location.href = location.href + '?refresh=' + new Date().getTime();
        //             window.location.reload();

        //         }
        //     });
        // });

        $('.update_sb_tpc').on('click', function() {
        // Get values from the inputs
        var sb_tp_id = $('#editrow').val();
        var tp_id = $('#topic').val();
        var sub_tp_name = $('#subtopic_name').val();

        // Clear existing validation messages
        $('.validation-message').remove();

        // Check if the Topic Name is empty
        if (tp_id === "") {
            // Display validation message below the Topic Name input
            $('#topic').after('<span class="validation-message text-danger">Topic Name is required.</span>');
        }

        // Check if the Sub Topic Name is empty
        if (sub_tp_name === "") {
            // Display validation message below the Sub Topic Name input
            $('#subtopic_name').after('<span class="validation-message text-danger">Sub Topic Name is required.</span>');
        }

        // Check if both Topic Name and Sub Topic Name are not empty
        if (tp_id !== "" && sub_tp_name !== "") {
            // Proceed with the AJAX request for updating changes
            $.ajax({
                url: '../core/subTopic_modalData.php',
                data: {
                    updated_subtopic_name: sub_tp_name,
                    updated_topic_id: tp_id,
                    sb_tp_id: sb_tp_id
                },
                method: 'POST',
                success: function(data) {
                    console.log("Response from server:", data);
                    // Reload the page after a successful update
                    window.location.reload();
                }
            });
        }
    });

    });
</script>


<script>

$(document).ready(function() {
    $('.delete-button').on('click', function(e) {
        e.preventDefault();
        var deleteId = $(this).data('id');

        console.log(deleteId);
        $('#delete_id').val(deleteId);
        $('#deleteModal').modal('show'); 
    
    });
});
</script>


<?php

include('includes/footer.php');

?>