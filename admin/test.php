<?php
include('includes/header.php');
include('includes/sidebar.php');
include('functions/list_grid.php');
include('functions/phpfunctions.php');
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
                    url: 'functions/get_subtopics.php', // Replace with the actual server-side script
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
                    <form action="functions/functions" class="col-md-12 " method="POST" enctype="multipart/form-data">
                        <div class="col-md-6 d-flex">
                            <div class="col-md-12 p-3">
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
                                    <label for="subtopic">Sub Topic Name</label>
                                    <!-- <input type="text" class="form-control" name="name" placeholder="Enter Name"> -->
                                    <select class="form-control" name="subtopic" id="subtopic">
                                        <option> select subtopic name</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="courseName">Course Name</label>
                                    <input type="text" class="form-control" name="courseName"
                                        placeholder="Enter Course Name">
                                </div>

                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control" name="price" placeholder="Enter Price">
                                </div>



                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" class="form-control-file" name="image" accept="image/*">
                                </div>
                                <div class="form-group">
                                    <label for="uploadfile">Upload File</label>
                                    <input type="file" class="form-control-file" name="uploadfile">
                                </div>
                                <div class="form-group">
                                    <label for="image">Upload Video</label>
                                    <input type="file" class="form-control-file" name="video" accept="video/*">
                                </div>
                            </div>
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label>Summary</label>

                                    <div class="textarea">
                                        <textarea class="form-control summary" name="Summary"
                                            placeholder="Enter summary" rows="4" cols="50"> </textarea>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="col-md-12 p-3">
                            <div class="form-group">
                                <label>Description</label>

                                <div class="textarea">
                                    <textarea class="desc" name="description" placeholder="Enter summary" rows="4"
                                        cols="50"> </textarea>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-12 d-flex">
                            <div class="col-md-6 p-3">
                                <div class="form-group">
                                    <label>What You Learn</label>

                                    <div class="textarea">
                                        <textarea class="wyl" name="wyl" placeholder="Enter summary" rows="4"
                                            cols="50"></textarea>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6 p-3">
                                <div class="form-group">
                                    <label>Requirements</label>

                                    <div class="textarea">
                                        <textarea class="req" name="req" placeholder="Enter summary" rows="4"
                                            cols="50"> </textarea>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary me-2" name="course_manage">Submit</button>
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
                                    <th>Price</th>
                                    <th>Description</th>
                                    <th>learn</th>
                                    <th>requirements</th>
                                    <th>tag</th>
                                    <th>Image</th>
                                    <th>Upload File</th>
                                    <th>Video</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($fetch_list_join_topics_subtopic_course_query) {
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($fetch_list_join_topics_subtopic_course_query)) {
                                        $id = $row['course_id'];
                                        $topic_name = $row['topicName'];
                                        $subtopic_name = $row['subTopicName'];
                                        $course_name = $row['courseName'];
                                        $price = $row['courseCost'];
                                        $desc = $row['courseDesc'];
                                        $learn = $row['learn'];
                                        $requirements = $row['requirements'];
                                        $tag = $row['tag'];
                                        $img = $row['bannerImage'];
                                        $file = $row['uploadfile'];
                                        $video = $row['video'];
                                        // $id = $row['id'];
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
                                                <?= $price; ?>
                                            </td>
                                            <td>
                                                <?=word_limiter( $desc ) ; ?>
                                            </td>
                                            <td>
                                                <?= $learn; ?>
                                            </td>
                                            <td>
                                                <?= $requirements; ?>
                                            </td>
                                            <td>
                                                <?= $tag; ?>
                                            </td>
                                            <td>
                                                <?= $img; ?>
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
                        <form method="POST" action="./functions/functions.php" enctype="multipart/form-data">
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
                                                            <input type="hidden" class="form-control" name="name"
                                                                placeholder="Enter Name" id="editrow">
                                                            <select class="form-control" name="topic" id="topic">

                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="courseName">Course Name</label>
                                                            <input type="text" class="form-control" id="courseName"
                                                                name="courseName" placeholder="Enter Course Name">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="image">Image</label>
                                                            <input type="file" class="form-control-file" id="image"
                                                                name="image" accept="image/*">
                                                            <input type="hidden" id="oldImage" name="oldImage"
                                                                width="100" height="100" />
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="editTitle">Existing Image</label><br>
                                                            <!-- <input type="file" class="form-control" onchange="loadFile(event)" id="banner_image" name="banner_image"> -->
                                                            <img src="" id="output" name="output" width="100"
                                                                height="100" />
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="image">Upload Video</label>
                                                            <input type="file" class="form-control-file" id="video"
                                                                name="video" accept="video/*">
                                                            <input type="hidden" id="oldImage" name="oldImage"
                                                                width="100" height="100" />
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="editTitle">Existing Image</label><br>
                                                            <!-- <input type="file" class="form-control" onchange="loadFile(event)" id="banner_image" name="banner_image"> -->
                                                            <img src="" id="output" name="output" width="100"
                                                                height="100" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="subtopic">Sub Topic Name</label>
                                                            <!-- <input type="text" class="form-control" name="name" placeholder="Enter Name"> -->
                                                            <select class="form-control" name="subtopic" id="subtopic">
                                                                <option> select subtopic name</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="price">Price</label>
                                                            <input type="number" class="form-control" id="price"
                                                                name="price" placeholder="Enter Price">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="uploadfile">Upload File</label>
                                                            <input type="file" class="form-control-file" id="uploadfile"
                                                                name="uploadfile">
                                                            <input type="hidden" id="oldImage" name="oldImage"
                                                                width="100" height="100" />
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="editTitle">Existing Image</label><br>
                                                            <!-- <input type="file" class="form-control" onchange="loadFile(event)" id="banner_image" name="banner_image"> -->
                                                            <img src="" id="output" name="output" width="100"
                                                                height="100" />
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="banner_desc">Description</label>
                                                            <!-- <textarea class="richtext" name="desc"> -->
                                                            <textarea id="inputTextLearn" class="richtext" rows="4"
                                                                cols="50" placeholder="Enter a value"></textarea>
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
                                <button type="submit" class="btn btn-primary update_sb_tpc" name="update_sb_tpc">Update
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="delete_blog.php" method="POST">

                <div class="modal-body">

                    <input type="text" id="delete_id" name="delete_id">
                    Are you sure you want to delete this record?
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger" name="delete_blog" id="delete_course">Delete</button>
                </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.edit-button').on('click', function () {
            // console.log('hii');
            var courseId = $(this).closest('tr').find('.edit_id').text();
            // console.log(blogId);
            $.ajax({
                type: 'POST',
                url: './functions/functions.php', // Replace with the URL of your server-side script
                data: {
                    'checking_course_btn': true,
                    'course_id': courseId,
                },
                // dataType: 'json',
                success: function (response) {
                    console.log(response);
                    $.each(response, function (key, value) {
                        $('#topic').val(value['topicID']);
                        $('#subtopic').val(value['subTopicId']);
                        $('#courseName').val(value['courseName']);
                        $('#price').val(value['courseCost']);
                        $('#editDescription').val(value['description']);
                        $('#course_id').val(value['id']);


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