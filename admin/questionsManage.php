<?php
include('includes/header.php');
include('includes/sidebar.php');

$assessmentId = $_GET['aid'];

$assessmentQuery = mysqli_query($con,"SELECT courses.courseName, courses.id AS course_id, assessment.id AS assessment_id, assessment.assessmentName
FROM courses
JOIN assessment ON courses.id = assessment.courseId
WHERE assessment.id = $assessmentId");
$assessmentData = mysqli_fetch_array($assessmentQuery);

?>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
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

                <div class="card-body">
                    <form action="../core/admin_functions.php" class=" " method="POST" enctype="multipart/form-data">
                        
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">                                    
                                        <label for="courseName">Course Name</label>
                                        <input type="text" class="form-control" name="courseName" 
                                        value="<?= $assessmentData['courseName'] ?>" readonly/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="chapter">Assessment Name</label>
                                        <input type="text" class="form-control" name="assessmentName" id="assessmentName" value="<?= $assessmentData['assessmentName'] ?>" readonly>
                                        
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="questions">Write your question here</label>
                                        <input type="text" class="form-control" name="question" id="question">
                                        <input type="hidden" name="assessment_id" 
                                        value="<?= $assessmentId; ?>" id="">
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="questions">Write Option A</label>
                                        <input type="text" class="form-control" name="optionA" id="optionA">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="questions">Write Option B</label>
                                        <input type="text" class="form-control" name="optionB" id="optionB">
                                    </div>
                                </div>    
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="questions">Write Option C</label>
                                        <input type="text" class="form-control" name="optionC" id="optionC">
                                    </div>  
                                </div>    
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="questions">Write Option D</label>
                                        <input type="text" class="form-control" name="optionD" id="optionD">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="questions">Select Correct Answer</label>
                                        <select class="form-control" name="correctAns">
                                            <option>Choose the correct Answer</option>
                                            <option value="a">Option A</option>
                                            <option value="b">Option B</option>
                                            <option value="c">Option C</option>
                                            <option value="d">Option D</option>
                                        </select>
                                    </div>
                                </div>
                               <div class="col-md-6">                                
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary me-2" name="questions_manage">Submit</button>
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
                                    <th>Questions</th>
                                    <th>Option A</th>
                                    <th>Option B</th>
                                    <th>Option C</th>
                                    <th>Option D</th>
                                    <th>Correct Answer</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($fetch_list_join_topics_subtopics_course_chapters_assessments_query) {
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($fetch_list_join_topics_subtopics_course_chapters_assessments_query)) {
                                        $id = $row['question_id'];
                                        $assessmentName = $row['assessmentName'];
                                        $course_name = $row['courseName'];
                                        $questions = $row['questionsName'];
                                        $optionA = $row['a'];
                                        $optionB = $row['b'];
                                        $optionC = $row['c'];
                                        $optionD = $row['d'];
                                        $correctAns = $row['correctAnswer'];
                                        
                                        ?>
                                        <tr>
                                            <td>
                                                <?= $i; ?>
                                            </td>
                                            <td class="edit_id" hidden>
                                                <?= $id; ?>
                                            </td>
                                            <td>
                                                <?= $course_name; ?>
                                            </td>
                                            <td>
                                                <?= $assessmentName; ?>
                                            </td>
                                            <td>
                                                <?= $questions; ?>
                                            </td>
                                            <td>
                                                <?= $optionA; ?>
                                            </td>
                                            <td>
                                                <?= $optionB; ?>
                                            </td>
                                            <td>
                                                <?= $optionC; ?>
                                            </td>
                                            <td>
                                                <?= $optionD; ?>
                                            </td>
                                            <td>
                                                <?= $correctAns; ?>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary p-2 edit-button"
                                                    data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?= $id ?>">
                                                    edit
                                                </button>

                                                <button class="btn btn-danger p-2 delete-button" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal" data-id="<?= $id ?>">Delete</button>
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
                                                                <input type="hidden" class="form-control" name="questionsId"
                                                                placeholder="Enter Name" id="questionsId">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="questions">Questions</label>
                                                            <input type="text" class="form-control" id="questions"
                                                                name="questions" >
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="optionB">Option B</label>
                                                            <input type="text" class="form-control" id="OptionB"
                                                                name="optionB" >
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="optionB">Option D</label>
                                                            <input type="text" class="form-control" id="OptionD"
                                                                name="optionD" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="assessment">Assessment Name</label>
                                                            <input type="text" class="form-control" id="assessment_name"
                                                                name="assessmentName" placeholder="Enter Assessment Name" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="uploadfile">Option A</label>
                                                            <input type="text" class="form-control" id="OptionA"
                                                                name="optionA">
                                                           
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="uploadfile">Option C</label>
                                                            <input type="text" class="form-control" id="OptionC"
                                                                name="optionC">
                                                            
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="uploadfile">Correct Answer</label>
                                                            <!-- <input type="text" class="form-control" id="correctAns"
                                                                name="correctAnswer"> -->
                                                                <select class="form-control" name="correctAnswer" id="correctAns" >
                                                                    <option>Choose the correct Answer</option>
                                                                    <option data-option="" value="a">Option A</option>
                                                                    <option value="b">Option B</option>
                                                                    <option value="c">Option C</option>
                                                                    <option value="d">Option D</option>
                                                                </select>
                                                            
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
                                <button type="submit" class="btn btn-primary update_questions" name="update_questions">Update
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
                    <button type="submit" class="btn btn-danger" name="deleteQuestions" id="delete_id">Delete</button>
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
                    'checking_questions': true,
                    'assessmentId': assessmentId,
                },
                // dataType: 'json',
                success: function (response) {
                    console.log(response);
                    $.each(response, function (key, value) {
                        $('#course').val(value['courseName']);
                        $('#assessment_name').val(value['assessmentName']);
                        $('#questionsId').val(value['questions_id']);
                        $('#questions').val(value['questionsName']);
                        $('#OptionA').val(value['a']);
                        $('#OptionB').val(value['b']);
                        $('#OptionC').val(value['c']);
                        $('#OptionD').val(value['d']);
                        $('#correctAns').val(value['correctAnswer']);
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




<?php

include('includes/footer.php');

?>