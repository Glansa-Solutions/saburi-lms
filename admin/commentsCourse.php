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
                    <h4 class="card-title">Blogs Comment List</h4>
                    <div class="table-container" style="overflow-x: auto;">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Course Name</th>
                                    <th>Review</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Commented On</th>
                                    <th>Comment By</th>
                                    <!-- <th>Email</th> -->
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($query_fetch_course_review_admin_grid) {
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($query_fetch_course_review_admin_grid)) {
                                        $id = $row['id'];
                                        $course_id = $row['courseId'];
                                        // $courseName = $row['courseName'];
                                        $reviewdata = $row['review'];
                                        $name = $row['name'];
                                        $email = $row['email'];
                                        $reviewed_on = $row['created_on'];
                                        $reviewed_by = $row['created_by'];
                                        $isactive = $row['isactive'];
                                        ?>
                                        <tr>
                                            <td>
                                                <?= $i; ?>
                                            </td>
                                            <td>
                                                <?= $course_id; ?>
                                            </td>
                                            <td style="white-space: nowrap;">
                                                <?= implode(' ', array_slice(str_word_count($reviewdata, 2), 0, 5)); ?>
                                            </td>
                                            <td>
                                                <?= $name; ?>
                                            </td>
                                            <td>
                                                <?= $email; ?>
                                            </td>
                                            <td>
                                                <?= $reviewed_on; ?>
                                            </td>
                                            <td>
                                                <?= $reviewed_by; ?>
                                            </td>
                                            <td>
                                                <p
                                                    style="color: <?= $isactive == 1 ? 'green' : 'orange' ?>; font-weight: bold;">
                                                    <?= $isactive == 1 ? 'Approved' : 'Not Approved' ?>
                                                </p>
                                                <button type="button" class="btn btn-primary p-2 view-review"
                                                    data-bs-toggle="modal" data-bs-target="#viewModal" data-id="<?= $id ?>">
                                                    View review
                                                </button>
                                                <button class="btn btn-danger p-2 delete-button" data-bs-toggle="modal"
                                                    data-bs-target="#delete_course_reviewModal"
                                                    data-blog-id="<?= $id ?>">Delete</button>
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

                    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog"
                        aria-labelledby="editCourseModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editCourseModalLabel">Comment Data</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="approveReviewForm">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="mb-3">
                                                        <style>
                                                            textarea.form-control,
                                                            textarea.asColorPicker-input,
                                                            .select2-container--default textarea.select2-selection--single,
                                                            .select2-container--default .select2-selection--single textarea.select2-search__field,
                                                            textarea.typeahead,
                                                            textarea.tt-query,
                                                            textarea.tt-hint {
                                                                min-height: 18rem;
                                                            }
                                                        </style>
                                                        <input type="hidden" id="review_id" name="course_review_id">
                                                        <textarea class="form-control" id="exampleTextarea" rows="50"
                                                            readonly></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary approve_review"
                                            id="approveBtn">Approve comment</button>
                                        <button type="button" class="btn btn-primary disapprove_review"
                                            id="disapproveBtn">Dispprove comment</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="delete_course_reviewModal" tabindex="-1" role="dialog"
                        aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form class="delete_form">
                                    <div class="modal-body">

                                        <input type="hidden" id="delete_id" name="course_review_id">
                                        Are you sure you want to delete this comment?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-danger" name="delete_course_review"
                                            id="delete_course_review">Delete</button>
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
            $('.view-review').on('click', function () {
                var view_review = $(this).data('id');
                $('#review_id').val(view_review);
                // alert(view_review);
                $.ajax({
                    type: 'POST',
                    url: '../core/admin_functions.php',
                    data: {
                        'Review_id': view_review,
                    },
                    success: function (response) {
                        // Parse the JSON response into an array
                        var responseData = JSON.parse(response);
                        // alert(responseData);
                        // Access array elements
                        var comment = responseData.review;
                        var isactive = responseData.isactive;
                        
                        // Set values in your HTML elements
                        $('#exampleTextarea').val(comment);
                        $('#is_active').val(isactive);
                        // Show/hide buttons based on isactive value
                        if (isactive == 1) {
                            // Hide the "Approve comment" button and show the "Disapprove comment" button
                            $('#approveBtn').hide();
                            $('#disapproveBtn').show();

                            // You can customize the appearance of the "Disapprove comment" button here if needed
                            $('#disapproveBtn').text('Disapprove Review');
                            $('#disapproveBtn').removeClass('btn-primary').addClass(
                                'btn-danger');
                        } else {
                            // Show the "Approve comment" button and hide the "Disapprove comment" button
                            $('#approveBtn').show();
                            $('#disapproveBtn').hide();

                            // You can customize the appearance of the "Approve comment" button here if needed
                            $('#approveBtn').text('Approve Review');
                            $('#approveBtn').removeClass('btn-danger').addClass('btn-primary');
                        }

                    },
                    error: function (xhr, status, error) {
                        console.error("AJAX Error:", status, error);
                    }
                });
            });
            $('.delete-button').on('click', function () {
                var view_review = $(this).data('blog-id');
                $('#delete_id').val(view_review);  // Use the correct ID "delete_id"
                // alert(view_comment);
            });
            $('#delete_course_review').on('click', function () {
                // Get the value of delete_id
                var delete_id_value = $('#delete_id').val();
                $.ajax({
                    type: 'POST',
                    url: '../core/admin_functions.php',
                    data:{
                      'delete_course_review_id' : delete_id_value,   
                    },
                    success:function(response){
                        window.location.reload();
                    },
                    error: function(xhr, status, error){
                        console.error('AJAX Error:', status, error);
                    }
                });
            });
            $('#approveBtn').on('click', function () {
                var reviewId = $('#review_id').val();
                var textareaContent = $('#exampleTextarea').val();
                // alert(textareaContent);
                $.ajax({
                    type: 'POST',
                    url: '../core/admin_functions.php',
                    data: {
                        'modal_review_id': reviewId,
                        'modal_review': textareaContent,
                    },
                    success: function (response) {
                        window.location.reload();
                    },
                    error: function (xhr, status, error) {
                        console.error("AJAX Error:", status, error);
                    }
                });

            });
            $('#disapproveBtn').on('click', function () {
                var r_Id = $('#review_id').val();
                // alert(c_Id);
                $.ajax({
                    type: 'POST',
                    url: '../core/admin_functions.php',
                    data: {
                        'disapprove': r_Id,
                    },
                    success: function (response) {
                        window.location.reload();
                    },
                    error: function (xhr, status, error) {
                        console.error("AJAX Error", status, error);
                    }
                });
            });

        });
    </script>


    <?php

    include('includes/footer.php');

    ?>