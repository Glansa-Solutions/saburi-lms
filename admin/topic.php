<?php
include('includes/header.php');
include('includes/sidebar.php');
include('functions/list_grid.php');
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card ">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Topic Details</h4>
                    <form class="forms-sample row" action="functions/functions" method="POST">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name"> Topic Name</label>
                                <input type="text" class="form-control" name="topic" placeholder="Enter Topic Name">
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary me-2" name="topic_manage">Submit</button>
                            <button class="btn btn-light">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Manage Topics</h4>
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>S.no</th>
                                <th>Topic Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if($fetch_list_topic_query)
                            {
                                $i = 1;
                                while($row=mysqli_fetch_assoc($fetch_list_topic_query))
                                {
                                    $topic_name=$row['topicName'];
                                    ?>
                            <tr>
                                <td><?= $i;?></td>
                                <td><?= $topic_name; ?></td>
                                <td>
                                    <button type="submit" class="btn btn-primary me-2 p-2 edit-button"
                                        data-bs-toggle="modal" data-bs-target="#editmodal"
                                        data-id="<?= $row['Id']; ?>">Edit</button>
                                    <button class="btn btn-danger p-2 delete_topic" data-id="<?= $row['Id']; ?>">Delete</button>
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
                                                <input type="text" class="form-control" name="subtopic" id="topic_name">
                                            </div>
                                        </div>

                                        <!-- </div>
                                    </div> -->
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary update_tpc" name="update_tpc" id="update_topic">Update
                                        Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('.edit-button').on('click', function() {
        var rowid = $(this).data('id');
        var editRow = $('#editrow').val(rowid);
        $.ajax({
            url: 'functions/dataget.php',
            method: 'GET',
            data: {
                topic_row_id: rowid
            },
            success: function(data) {

                var topic_data =JSON.parse(data);
                console.log(topic_data);

                // Populate the input elements with data received from the server
                $('#topic_name').val(topic_data.topic_name);
                // You can process the data returned from the server here.
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("AJAX Error: " + errorThrown);
                // Handle the error appropriately, e.g., display an error message.
            }
        });
    });

    $('#update_topic').on('click',function(){
        var topic_id = $('#editrow').val();
        var topic_name = $('#topic_name').val();
        // alert(topic_id);
        $.ajax({
            url:'functions/datapost.php',
            method: 'POST',
            data:{
                topic_name_update : topic_name,
                topic_row_id: topic_id
            },
            success:function(data){
                console.log(data);
                window.location.reload();
            }
        });

    });
    // $('.delete_topic').on('click',function(){
    //     var delete_topic_id = $(this).data('id');
    //     // alert(delete_topic_id);
    //     $.ajax({
    //         url:'functions/datapost.php',
    //         method: 'POST',
    //         data:{
    //             delete_topic_id : delete_topic_id
    //         },
    //         success:function(data){
    //             console.log(data);
    //             // window.location.reload();
    //         }
    //     });

    // });

    // $('.update_tpc').on('click', function() {
    //     var tp_id = $('#editrow').val();
    //     var tp_id_name = $('#topic_name').val();

    //     console.log("Topic Name: " + tp_id + ", Sub Topic Name: " + tp_id_name);
    //     $.ajax({
    //         url: 'functions/modals_data.php',
    //         data: {
    //             updated_topic_name: tp_id_name,
    //             updated_topic_id: tp_id,
    //         },
    //         method: 'POST',
    //         success: function(data) {
    //             console.log("Response from server:", data);

    //             // Reload the page after a successful update
    //             if (data.success) {
    //                 location.href = location.href + '?refresh=' + new Date().getTime();
    //             }
    //         }
    //     });
    // });

});
</script>
<?php

include('includes/footer.php');

?>