<?php
include('includes/header.php');
include('includes/sidebar.php');
// include('../core/listgrid.php');
// include('../core/functions.php');
// include('functions/phpfunctions.php');
// include('functions/get_subtopics.php');
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body ">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Manage Courses Creation Details</h4>
                        <?php if (isset($_SESSION['status']) && isset($_SESSION['message'])) {
                            $status = $_SESSION['status'];
                            $message = $_SESSION['message'];
                        ?>
                            <div class="alert alert-<?= ($status == "success") ? 'success' : 'danger'; ?> w-50 alert-dismissible fade show" role="alert">
                                <strong>
                                    <?= $message; ?>
                                </strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php unset($_SESSION['message']);
                        } ?>
                        <div class="form-group">
                            <!-- <button type="button" class="btn btn-primary me-2" id="addCreation" name="addCreation"> </button> -->
                            <a href="chapterAssessmentOrder" class="btn btn-primary me-2" id="addCreation" name="addCreation" style="color:white;text-decoration:none"> ADD </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th hidden></th>
                                    <th>Topic Name</th>
                                    <th>Sub Topic Name</th>
                                    <th>Course Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($fetch_list_join_topics_subtopics_course_type_typeName_assessments_query) {
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($fetch_list_join_topics_subtopics_course_type_typeName_assessments_query)) {
                                        $courseId = $row['courseId'];
                                        $topic_name = $row['topicName'];
                                        $subtopic_name = $row['subTopicName'];
                                        $course_name = $row['courseName'];
                                ?>
                                        <tr>
                                            <td>
                                                <?= $i; ?>
                                            </td>
                                            <td class="edit_id" hidden>
                                                <?= $courseId; ?>
                                            </td>
                                            <td>
                                                <?= $topic_name; ?>
                                            </td>
                                            <td>
                                                <?= $subtopic_name; ?>
                                            </td>
                                            <td>
                                                <?= $course_name; ?>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary p-2 edit-button" data-bs-toggle="modal"  data-id="<?= $courseId ?>">
                                                    edit
                                                </button>

                                                <button class="btn btn-danger p-2 delete-button" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $courseId ?>">Delete</button>
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


            <!-- Add this script at the end of your HTML body or in the head section -->
            <script>
                // Wait for the DOM to be ready
                document.addEventListener("DOMContentLoaded", function() {
                    // Get all elements with the class 'edit-button'
                    var editButtons = document.querySelectorAll('.edit-button');

                    // Attach a click event listener to each edit button
                    editButtons.forEach(function(button) {
                        button.addEventListener('click', function() {
                            // Get the value of the 'data-id' attribute from the clicked button
                            var editId = button.getAttribute('data-id');

                            // Redirect to assessmentManageAdd.php with the current details' ID
                            window.location.href = 'chapterAssessmentOrder.php?id=' + editId;
                        });
                    });
                });
            </script>
        </div>
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
                    <button type="submit" class="btn btn-danger" name="deleteAssesmentCreation" id="delete_id">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.delete-button').on('click', function(e) {
            e.preventDefault();
            var asses_id = $(this).closest('tr').find('.edit_id').text();

            console.log(asses_id,"");
            $('#delete_id').val(asses_id);
            $('#deleteModal').modal('show');

        });
    });
</script>
<?php

include('includes/footer.php');

?>