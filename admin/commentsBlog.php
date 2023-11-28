<?php
include('includes/header.php');
include('includes/sidebar.php');
// include('functions/list_grid.php');
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
                                    <th>Blog Name</th>
                                    <th>Comment</th>
                                    <th>Website</th>
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
                                if ($query_fetch_blog_comment_admin_grid) {
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($query_fetch_blog_comment_admin_grid)) {
                                        $id = $row['id'];
                                        $blog_id = $row['blog_id'];
                                        $comment = $row['comment'];
                                        $website = $row['website'];
                                        $name = $row['name'];
                                        $email = $row['email'];
                                        $commented_on = $row['commented_on'];
                                        $commented_by = $row['commented_by'];
                                        $isactive = $row['isactive'];
                                        ?>
                                        <tr>
                                            <td>
                                                <?= $i; ?>
                                            </td>
                                            <td>
                                                <?= $blog_id; ?>
                                            </td>
                                            <td style="white-space: nowrap;">
                                                <?= implode(' ', array_slice(str_word_count($comment, 2), 0, 5)); ?>
                                            </td>
                                            <td>
                                                <?= $website; ?>
                                            </td>
                                            <td>
                                                <?= $name; ?>
                                            </td>
                                            <td>
                                                <?= $email; ?>
                                            </td>
                                            <td>
                                                <?= $commented_on; ?>
                                            </td>
                                            <td>
                                                <?= $commented_by; ?>
                                            </td>
                                            <td>
                                                <p
                                                    style="color: <?= $isactive == 1 ? 'green' : 'orange' ?>; font-weight: bold;">
                                                    <?= $isactive == 1 ? 'Approved' : 'Not Approved' ?>
                                                </p>
                                                <button type="button" class="btn btn-primary p-2 view-comment"
                                                    data-bs-toggle="modal" data-bs-target="#viewModal" data-id="<?= $id ?>">
                                                    View Comment
                                                </button>
                                                <button class="btn btn-danger p-2 delete-button" data-bs-toggle="modal"
                                                    data-bs-target="#deleteBlogCommentModal"
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
                        aria-labelledby="editBlogModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editBlogModalLabel">Comment Data</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="approveCommentForm">
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
                                                        <input type="hidden" id="comment_id" name="blog_comment_id">
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
                                        <button type="button" class="btn btn-primary approve_comment"
                                            id="approveBtn">Approve comment</button>
                                        <button type="button" class="btn btn-primary disapprove_comment"
                                            id="disapproveBtn">Dispprove comment</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="deleteBlogCommentModal" tabindex="-1" role="dialog"
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

                                        <input type="hidden" id="delete_id" name="blog_comment_id">
                                        Are you sure you want to delete this comment?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-danger" name="delete_blog_comment"
                                            id="delete_blog_comment">Delete</button>
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
            $('.view-comment').on('click', function () {
                var view_comment = $(this).data('id');
                $('#comment_id').val(view_comment);
                $.ajax({
                    type: 'POST',
                    url: '../core/functions.php',
                    data: {
                        'Comment_id': view_comment,
                    },
                    success: function (response) {
                        // Parse the JSON response into an array
                        var responseData = JSON.parse(response);

                        // Access array elements
                        var comment = responseData.comment;
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
                            $('#disapproveBtn').text('Disapprove comment');
                            $('#disapproveBtn').removeClass('btn-primary').addClass(
                                'btn-danger');
                        } else {
                            // Show the "Approve comment" button and hide the "Disapprove comment" button
                            $('#approveBtn').show();
                            $('#disapproveBtn').hide();

                            // You can customize the appearance of the "Approve comment" button here if needed
                            $('#approveBtn').text('Approve comment');
                            $('#approveBtn').removeClass('btn-danger').addClass('btn-primary');
                        }

                    },
                    error: function (xhr, status, error) {
                        console.error("AJAX Error:", status, error);
                    }
                });
            });
            $('.delete-button').on('click', function () {
                var view_comment = $(this).data('blog-id');
                $('#delete_id').val(view_comment);  // Use the correct ID "delete_id"
                // alert(view_comment);
            });
            $('#delete_blog_comment').on('click', function () {
                // Get the value of delete_id
                var delete_id_value = $('#delete_id').val();
                $.ajax({
                    type: 'POST',
                    url: '../core/functions.php',
                    data:{
                      'delete_blog_comment_id' : delete_id_value,   
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
                var commentId = $('#comment_id').val();
                var textareaContent = $('#exampleTextarea').val();
                // alert(textareaContent);
                $.ajax({
                    type: 'POST',
                    url: '../core/functions.php',
                    data: {
                        'modal_comment_id': commentId,
                        'modal_comment': textareaContent,
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
                var c_Id = $('#comment_id').val();
                // alert(c_Id);
                $.ajax({
                    type: 'POST',
                    url: '../core/functions.php',
                    data: {
                        'disapprove': c_Id,
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