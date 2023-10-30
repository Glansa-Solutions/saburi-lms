<?php
include('includes/header.php');
include('includes/sidebar.php');

?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card ">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Sub Topic Details</h4>
                    <form class="forms-sample row" action="functions/functions" method="POST">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name"> Topic Name</label>
                                <select class="form-control" name="topic">
                                <option value=""> Select Topic Name</option>
                                    <?php
                                    if($fetch_list_topic_query)
                                    {
                                        // $i = 1;
                                        while($row=mysqli_fetch_assoc($fetch_list_topic_query))
                                        {
                                            
                                            echo $topic_id;
                                            ?>
                                            
                                            <option value=<?= $row['Id']; ?>> <?= $row['topicName']; ?></option>
                                            <?php
                                        }
                                    }else{
                                        echo "Query failed!";
                                    }
                                   ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name"> Sub Topic Name</label>
                                <input type="text" class="form-control" name="subtopic"
                                    placeholder="Enter Sub Topic Name">
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary me-2" name="subtopic_manage">Submit</button>
                            <button class="btn btn-light">Cancel</button>
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
                            if($fetch_list_subtopic_query)
                            {
                                $i = 1;
                                while($row=mysqli_fetch_assoc($fetch_list_join_topics_subtopic_query))
                                {
                                  
                                    ?>
                            <tr>
                                <td><?= $i;?></td>
                                <td hidden><?= $row['id']; ?></td>
                                <td><?= $row['topicName']; ?></td>
                                <td><?= $row['subTopicName']; ?></td>
                                <td>
                                    <button type="submit" class="btn btn-primary me-2 p-2 edit-button"
                                        data-bs-toggle="modal" data-bs-target="#editmodal"
                                        data-id="<?= $row['Id']; ?>">Edit</button>
                                    <button class="btn btn-danger p-2">Delete</button>
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
                <div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <form class="forms-sample">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Sub Topics</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="col-md-12 grid-margin stretch-card">

                                        <div class="form col-md-12">
                                            <div class="form-group">
                                                <!-- <input type="text" > -->

                                                <label for="name">Topic Name</label>
                                                <input type="hidden" class="form-control" name="name"
                                                    placeholder="Enter Name" id="editrow">
                                                <select class="form-control" name="topic" id="topic_name">

                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="details">Sub Topic Name</label>
                                                <input type="text" class="form-control" name="subtopic"
                                                    id="subtopic_name">
                                            </div>

                                        </div>

                                        <!-- </div>
                                    </div> -->
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary update_sb_tpc"
                                        name="update_sb_tpc">Update
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
<script>
$(document).ready(function() {
    $('.edit-button').on('click', function() {
        var rowid = $(this).data('id');
        var editRow = $('#editrow').val(rowid);

        console.log(rowid);

        $.ajax({
            url: 'functions/edit_data.php', // Replace with the actual server-side script
            data: {
                sub_topic_id: rowid
            },
            method: 'GET',
            success: function(data) {
                // Populate the subtopic select with the retrieved data
                $('#topic_name').html(data);
                // $('#subtopic_name').html(data);
            }
        });
        $.ajax({
            url: 'functions/modals_data.php', // Replace with the actual server-side script
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
    $('.update_sb_tpc').on('click', function() {
        var sb_tp_id = $('#editrow').val();
        var tp_id = $('#topic_name').val();
        var sub_tp_name = $('#subtopic_name').val();

        console.log("Topic Name: " + tp_id + ", Sub Topic Name: " + sub_tp_name);
        $.ajax({
            url: 'functions/modals_data.php',
            data: {
                updated_subtopic_name: sub_tp_name,
                updated_topic_id: tp_id,
                sb_tp_id: sb_tp_id
            },
            method: 'POST',
            success: function(data) {
                console.log("Response from server:", data);

                // Reload the page after a successful update
                if (data.success) {
                    location.href = location.href + '?refresh=' + new Date().getTime();
                }
            }
        });
    });

});
</script>





<?php

include('includes/footer.php');

?>