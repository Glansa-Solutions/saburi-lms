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
                    <h4 class="card-title">Topic Details</h4>
                    <form class="forms-sample row" action="./core/functions" method="POST">
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
                                <th hidden></th>
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
                                    $id = $row['Id'];
                                    $topic_name = $row['topicName'];
                                    ?>
                            <tr>
                                <td><?= $i;?></td>
                                <td class="edit_id" hidden><?= $id;?></td>
                                <td><?= $topic_name; ?></td>
                                <td>
                                    <button type="submit" class="btn btn-primary me-2 p-2 edit-button"
                                        data-bs-toggle="modal" data-bs-target="#editmodal"
                                        data-id="<?= $id; ?>">Edit</button>
                                        <button type="submit" class="btn btn-danger p-2 delete-button" data-bs-toggle="modal" data-bs-target="#deleteModal"  data-id="<?= $id; ?>">Delete</button>
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
                            

<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="editBlogModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBlogModalLabel">Edit Blog</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="../core/functions.php">
              <div class="modal-body">
                <!-- Form for editing the blog content -->
                
                    <input type ="tect" id="topicId" name="topicId">
                      <div class="form-group">
                        <label for="editTitle">Topic Name</label>
                        <input type="text" class="form-control" id="topic_name" name="topic_name">
                    </div>
                    
                
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="saveChanges" name="update_topic">Save Changes</button>
            </div>
            </form>
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
            <form action="delete_blog.php" method="POST">

            <div class="modal-body">

                <input type="text" id="delete_id" name="delete_id">
                Are you sure you want to delete this record?
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger" name="delete_topic" id="delete_topic">Delete</button>
            </div>
        </div>
    </div>
</div>
          
<script>
$(document).ready(function() {
    $('.edit-button').on('click', function() {
        var topicId = $(this).closest('tr').find('.edit_id').text();
        console.log(topicId);
        $.ajax({
        type: 'POST',
        url: './core/functions.php', // Replace with the URL of your server-side script
        data: { 
            'checking_topic_btn' : true,
             'topicId': topicId, },
        // dataType: 'json',
        success: function(response) {
            console.log(response);
            $.each(response, function (key, value)
            {

                // Populate the input elements with data received from the server
                $('#topic_name').val(value['topicName']);
                $('#topicId').val(value['Id']); 
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
        var topicId = $(this).closest('tr').find('.edit_id').text();

        console.log(topicId);
        $('#delete_id').val(topicId);
        $('#deleteModal').modal('show'); 
    
    });
});
</script>
<?php

include('includes/footer.php');

?>