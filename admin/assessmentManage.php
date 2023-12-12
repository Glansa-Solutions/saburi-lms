<?php
include('includes/header.php');
include('includes/sidebar.php');
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Bind a change event to the topic select
        $('#topic').change(function () {
            var topicId = $(this).val();
            if (topicId) {
                // Make an AJAX request to fetch subtopics for the selected topic
                $.ajax({
                    url: '../core/chepterTopicFunctions.php', // Replace with the actual server-side script
                    data: {
                        topicId: topicId
                    },
                    method: 'GET',
                    success: function (data) {
                        // Populate the subtopic select with the retrieved data
                        $('#subtopic').html(data);
                    }
                });
            } else {
                // Clear the subtopic select if no topic is selected
                $('#subtopic').html('<option>select subtopic name</option>');
            }
        });

        $('#subtopic').change(function () {
            var subtopicId = $(this).val();
            if(subtopicId){
                $.ajax({
                url:'../core/cheptersubFunctions.php',
                data: {
                    subtopicId:subtopicId
                },
                method:'GET',
                success:function(data){
                    $('#courseName').html(data);
                }
            })
            }
        });
        $('#courseName').change(function () {
            var courseId = $(this).val();
            if(courseId){
                $.ajax({
                url:'../core/chepterFunctions.php',
                data: {
                    courseId:courseId
                },
                method:'GET',
                success:function(data){
                    $('#chapter').html(data);
                }
            })
            }
        });
    });
</script>
<style>
    /* Customize the modal size */
    .modal-dialog {
        max-width: 90%;
        /* Adjust this value to control the width */
        height: 80vh;
        /* Adjust this value to control the height */
    }

    .rte-modern.rte-desktop.rte-toolbar-default {
        min-width: 500px;
        height: 400px;
    }



    #suggestions {
        display: none;
        position: absolute;
        background-color: #f1f1f1;
        max-height: 100px;
        overflow-y: auto;
    }
</style>

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card ">

            <div class="card">
            <h4 class="card-title p-3">Manage Assessment</h4>
                <div class="card-body">
                    <form action="../core/admin_functions.php" class=" " method="POST" enctype="multipart/form-data">
                        
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="topic"> Topic Name</label>
                                        <!-- <input type="text" class="form-control" name="name" placeholder="Enter Name"> -->
                                        <select class="form-control topic" name="topic" id="topic" required>
                                            <option value="">Select Topic Name</option>
                                            <?php
                                            if ($fetch_list_topic_query) {
                                                // $i = 1;
                                                
                                                while ($row = mysqli_fetch_assoc($fetch_list_topic_query)) {

                                                    echo $topic_id;
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
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">                                    
                                        <label for="courseName">Subtopic Name</label>
                                        <select class="form-control" name="subtopic" id="subtopic" required>
                                            <option value=""> select subtopic name</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">                                    
                                        <label for="courseName">Course Name</label>
                                        <select class="form-control" name="courseName" id="courseName" required>
                                            <option> Select Course name</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="chapter">Assessment Name</label>
                                        <input type="text" class="form-control" name="assessmentName" id="assessmentName" required>
                                    </div>
                                </div>
                               <div class="col-md-6">                                
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary me-2 submit_validation" name="assessment_manage">Submit</button>
                                        <button class="btn btn-light">Cancel</button>
                                    </div>
                                </div>
                            </div>                        
                        <!-- <div>
                            
                        </div> -->

                    </form>

                </div>
            </div>
        </div>

        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Manage Courses Details</h4>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th hidden></th>
                                    <th>Course Name</th>
                                    <th>Assessment Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($fetch_assessment_query) {
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($fetch_assessment_query)) {
                                        $assessmentName = $row['assessmentName'];
                                        $course_name = $row['courseName'];
                                        $courseId = $row['courseId'];
                                        $assessmentId = $row['assessmentId'];
                                        
                                        ?>
                                        <tr>
                                            <td>
                                                <?= $i; ?>
                                            </td>
                                            <td class="edit_id" hidden>
                                                <?= $assessmentId; ?>
                                            </td>
                                            <td>
                                                <?= $course_name; ?>
                                            </td>
                                            <td>
                                                <?= $assessmentName; ?>
                                            </td>
                                            <td>
                                                <a href="questionsManage?aid=<?=$assessmentId ?>" class="btn btn-success p-2">
                                                    Add Qusetions
                                                </a>
                                                <button type="button" class="btn btn-primary p-2 edit-button"
                                                    data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?= $assessmentId ?>">
                                                    edit
                                                </button>

                                                <button class="btn btn-danger p-2 delete-button" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal" data-id="<?= $assessmentId ?>">Delete</button>
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




            <!-- Edit Modal -->
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editBlogModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editBlogModalLabel">Edit Courses</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" action="../core/admin_functions.php" enctype="multipart/form-data">
                            <div class="modal-body">
                                <!-- Form for editing the blog content -->

                                <input type="hidden" id="course_id" name="course_id">
                                <div class="row">
                                    <div class="col-md-12 grid-margin stretch-card ">
                                        <div class="card">
                                            <div class="card-body">
                                                <!-- <h4 class="card-title">Add Courses Details</h4> -->
                                                <!-- <form class="forms-sample row" action="functions/functions" method="POST" enctype="multipart/form-data"> -->
                                                <div class="row">
                                                    <div class="col-md-6">

                                                        <div class="form-group">
                                                            <label for="courseName">Course Name</label>
                                                            <input type="text" class="form-control" id="course"
                                                                name="courseName" placeholder="Enter Course Name" readonly>
                                                                <input type="hidden" class="form-control" name="assessmentId"
                                                                placeholder="Enter Name" id="assessmentId">
                                                        </div>

                                                        
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="assessment">Assessment Name</label>
                                                            <input type="text" class="form-control" id="assessment_name"
                                                                name="assessmentName" placeholder="Enter Assessment Name" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary update_assessment" name="update_assessment">Update
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
                    <button type="submit" class="btn btn-danger" name="deleteAssesment" id="delete_id">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.edit-button').on('click', function () {
            // console.log('hii');
            var assessmentId = $(this).closest('tr').find('.edit_id').text();
            console.log(assessmentId);
            $.ajax({
                type: 'POST',
                url: '../core/admin_functions.php', // Replace with the URL of your server-side script
                data: {
                    'checking_assessment_btn': true,
                    'assessmentId': assessmentId,
                },
                // dataType: 'json',
                success: function (response) {
                    console.log(response);
                    $.each(response, function (key, value) {
                        $('#course').val(value['courseName']);
                        $('#assessment_name').val(value['assessmentName']);
                        $('#assessmentId').val(value['assessment_id']);
                        $('#editModal').modal('show');
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
            var asses_id = $(this).closest('tr').find('.edit_id').text();

            console.log(asses_id);
            $('#delete_id').val(asses_id);
            $('#deleteModal').modal('show');

        });
    });
</script>
<!-- <script>
   $(document).ready(function () {
    $('.submit_validation').on('click', function (e) {
        // Validate Topic Name
        var topic = $('#topic').val();
        
        if (!topic) {
            e.preventDefault(); // Prevent the form from submitting
            $('#topic').siblings('.error-message').remove();
            $('#topic').after('<span class="error-message">Please select a Topic Name.</span>');
            return;
        }

        // Validate Subtopic Name
        var subtopic = $('#subtopic').val();

        console.log(subtopic, "subtopic")
        if (subtopic === "") {
            e.preventDefault(); // Prevent the form from submitting
            $('#subtopic').siblings('.error-message').remove();
            $('#subtopic').after('<span class="error-message">Please select a Subtopic Name.</span>');
            return;
        }

        // Validate Course Name
        var courseName = $('#courseName').val();
        if (!courseName) {
            e.preventDefault(); // Prevent the form from submitting
            $('#courseName').siblings('.error-message').remove();
            $('#courseName').after('<span class="error-message">Please select a Course Name.</span>');
            return;
        }

        // Validate Assessment Name
        var assessmentName = $('#assessmentName').val();
        if (!assessmentName) {
            e.preventDefault(); // Prevent the form from submitting
            $('#assessmentName').siblings('.error-message').remove();
            $('#assessmentName').after('<span class="error-message">Please enter an Assessment Name.</span>');
            return;
        }
    });
});

</script> -->




<?php

include('includes/footer.php');

?>