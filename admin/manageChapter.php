<?php
include('includes/header.php');
include('includes/sidebar.php');
include('../core/listgrid.php');
include('../core/functions.php');

// include('functions/get_subtopics.php');
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
            if (subtopicId) {
                $.ajax({
                    url: '../core/cheptersubFunctions.php',
                    data: {
                        subtopicId: subtopicId
                    },
                    method: 'GET',
                    success: function (data) {
                        $('#courseName').html(data);
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

                <div class="card-body">
                <h4 class="card-title">Add Chapter</h4>
                    <form action="../core/functions.php" class="col-md-12 " method="POST" enctype="multipart/form-data">
                        <div class="col-md-12 d-flex">
                            <div class="col-md-6 p-3">
                                <div class="form-group">
                                    <label for="topic"> Topic Name</label>
                                    <!-- <input type="text" class="form-control" name="name" placeholder="Enter Name"> -->
                                    <select class="form-control" class="topic" name="topic" id="topic">
                                        <option value=""> Select Topic Name</option>
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

                                <div class="form-group">

                                    <label for="courseName">Course Name</label>
                                    <select class="form-control" name="courseName" id="courseName">
                                        <option> Select Course name</option>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="uploadfile">Upload File</label>
                                    <input type="file" class="form-control-file" name="uploadfile">
                                </div>
                                <div class="form-group">
                                    <label for="chapterContent">Chapter Content</label>
                                    <textarea class="form-control" name="chapterContent">

                                    </textarea>
                                </div>

                            </div>
                            <div class="col-md-6 p-3">
                                <div class="form-group">
                                    <label for="subtopic">Sub Topic Name</label>
                                    <!-- <input type="text" class="form-control" name="name" placeholder="Enter Name"> -->
                                    <select class="form-control" name="subtopic" id="subtopic">
                                        <option> select subtopic name</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="chapter">Chapter Name</label>
                                    <input type="text" class="form-control" name="chapter"
                                        placeholder="Enter Chapter Name" id="chapterName">
                                </div>
                                <div class="form-group">
                                    <label for="image">Upload Video</label>
                                    <input type="file" class="form-control-file" name="video" accept="video/*">
                                </div>
                            </div>

                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary me-2" name="chapter_manage">Submit</button>
                            <button class="btn btn-light">Cancel</button>
                        </div>

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
                                    <th>Topic Name</th>
                                    <th>Sub Topic Name</th>
                                    <th>Course Name</th>
                                    <th>Chapter Name</th>
                                    <th>Chapter Content</th>
                                    <th>Upload File</th>
                                    <th>Video</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($fetch_list_join_topics_subtopics_course_chapters_query) {
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($fetch_list_join_topics_subtopics_course_chapters_query)) {
                                        $id = $row['chapter_id'];
                                        $topic_name = $row['topicName'];
                                        $subtopic_name = $row['subtopicName'];
                                        $course_name = $row['courseName'];
                                        $chapterName = $row['chapterName'];
                                        $file = $row['uploadFile'];
                                        $video = $row['video'];
                                        $chapterContent = $row['chapterContent'];

                                        ?>
                                        <tr>
                                            <td>
                                                <?= $i; ?>
                                            </td>
                                            <td class="edit_id" hidden>
                                                <?= $id; ?>
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
                                                <?= $chapterName; ?>
                                            </td>
                                            <td>
                                                <?= implode(' ', array_slice(str_word_count($chapterContent, 2), 0, 10)); ?>
                                            </td>
                                            <td>
                                                <?= $file; ?>
                                            </td>
                                            <td>
                                                <?= $video; ?>
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
                        <form method="POST" action="../core/functions.php" enctype="multipart/form-data">
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
                                                            <label for="topic"> Topic Name</label>
                                                            <input type="hidden" class="form-control" name="chapterId"
                                                                placeholder="Enter Name" id="chapterId">
                                                            <!-- <select class="form-control" name="topic" id="topic">

                                                                </select> -->
                                                            <input type="text" class="form-control" name="topic"
                                                                id="topicName" readonly>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="courseName">Course Name</label>
                                                            <input type="text" class="form-control" id="course"
                                                                name="courseName" placeholder="Enter Course Name"
                                                                readonly>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="image">Upload Video</label>
                                                            <input type="file" class="form-control-file" id="video"
                                                                name="video" accept="video/*">
                                                            <input type="hidden" id="oldImage" name="oldImage"
                                                                width="100" height="100" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="subtopic">Sub Topic Name</label>
                                                            <!-- <input type="text" class="form-control" name="name" placeholder="Enter Name"> -->
                                                            <!-- <select class="form-control" name="subtopic" id="subtopic">
                                                                <option> select subtopic name</option>
                                                            </select> -->
                                                            <input type="text" class="form-control" name="subtopic"
                                                                id="subtopicName" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="chapter">Chapter Name</label>
                                                            <input type="text" class="form-control" id="chapter"
                                                                name="chapter" placeholder="Enter Chapter Name">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="uploadfile">Upload File</label>
                                                            <input type="file" class="form-control-file" id="uploadfile"
                                                                name="uploadfile">
                                                            <input type="hidden" id="oldImage" name="oldImage"
                                                                width="100" height="100" />
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
                                <button type="submit" class="btn btn-primary update_chapter"
                                    name="update_chapter">Update
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
            <form action="../core/functions.php" method="POST">

                <div class="modal-body">

                    <input type="hidden" id="delete_id" name="delete_id">
                    Are you sure you want to delete this record?
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger" name="deleteChapter" id="delete_course">Delete</button>
                </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.edit-button').on('click', function () {
            // console.log('hii');
            var chapterId = $(this).closest('tr').find('.edit_id').text();
            // console.log(courseId);
            // console.log(blogId);
            $.ajax({
                type: 'POST',
                url: '../core/functions.php', // Replace with the URL of your server-side script
                data: {
                    'checking_chapters_btn': true,
                    'chapterId': chapterId,
                },
                // dataType: 'json',
                success: function (response) {
                    console.log(response);
                    $.each(response, function (key, value) {
                        $('#topicName').val(value['topicName']);
                        $('#subtopicName').val(value['subtopicName']);
                        $('#course').val(value['courseName']);
                        $('#chapter').val(value['chapterName']);
                        $('#chapterId').val(value['chapter_id']);


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
            var course_id = $(this).closest('tr').find('.edit_id').text();

            console.log(course_id);
            $('#delete_id').val(course_id);
            $('#deleteModal').modal('show');

        });
    });
</script>




<?php

include('includes/footer.php');

?>