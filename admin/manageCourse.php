<?php
include('includes/header.php');
include('includes/sidebar.php');
include('../core/listgrid.php');
// include('functions/get_subtopics.php');
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card ">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Add Courses Details</h4>
                    <!-- <h4 class="card-title">Default form</h4>
                        <p class="card-description">
                            Basic form layout
                        </p> -->
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
                    <form class="forms-sample row" id="entry_form" action="../core/admin_functions.php" method="POST" enctype="multipart/form-data">
                        <div class="col-md-6">
                            <div class="form-group">

                                <label for="topic"> Topic Name</label>
                                <!-- <input required type="text" class="form-control" name="name" placeholder="Enter Name"> -->
                                <select required class="form-control" name="topic" id="topic">
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
                                <input type="text" class="form-control" name="courseName" placeholder="Enter Course Name">
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" class="form-control" name="price" placeholder="Enter Price">
                            </div>
                            <div class="form-group">
                                <label for="courseName">Tags</label>
                                <input type="text" class="form-control" name="tags" placeholder="Enter tags for this course">
                            </div>
                            <div class="form-group">
                                <label for="banner_desc">What will you learn?</label>
                                <div id="editor">
                                    <textarea name="learn" id="editAddress" class="mySummernote" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" class="form-control" name="image" accept="image/*">
                            </div>
                            <div class="form-group">
                                <label for="uploadfile">Upload File</label>
                                <input type="file" class="form-control" name="uploadfile">
                            </div>
                            <div class="form-group">
                                <label for="image">Upload Video</label>
                                <input type="file" class="form-control" name="video" accept="video/*">
                            </div>
                            <div class="form-group">
                                <label for="courseName">Requirements</label>
                                <input type="text" class="form-control" name="requirements" placeholder="Enter what is required for learning this course">
                            </div>
                            <div class="form-group">
                                <label for="courseName">Course Duration</label>
                                <input type="text" class="form-control" name="durations" placeholder="Enter course duration in days">
                            </div>
                            <div class="form-group">
                                <label for="banner_desc">Description</label>
                                <div id="editor">
                                    <textarea name="description" id="editAddress" class="mySummernote" required></textarea>
                                </div>
                            </div>

                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary me-2" name="course_manage">Submit</button>
                            <button type="button" class="btn btn-light" id="cancel_btn" onclick="resetForm()">Reset</button>
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
                                    <th>Topic Name</th>
                                    <th>Sub Topic Name</th>
                                    <th>Course Name</th>
                                    <th>Price</th>
                                    <th>Description</th>
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
                                        $topic_name = $row['topicName'];
                                        $subtopic_name = $row['subTopicName'];
                                        $course_name = $row['courseName'];
                                        $price = $row['courseCost'];
                                        $desc = $row['courseDesc'];
                                        $img = $row['bannerImage'];
                                        $file = $row['uploadfile'];
                                        $video = $row['video'];
                                ?>
                                        <tr>
                                            <td>
                                                <?= $i; ?>
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
                                                <?= $desc; ?>
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
                                                <button type="submit" class="btn btn-primary me-2 p-2" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?= $id ?>">Edit</button>
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
                </div>
            </div>
            <!-- Edit Modal -->
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editBlogModalLabel" aria-hidden="true">
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

                                <input required type="hidden" id="course_id" name="course_id">
                                <div class="row">
                                    <div class="col-md-12 grid-margin stretch-card ">
                                        <div class="card">
                                            <div class="card-body">
                                                <!-- <h4 class="card-title">Add Courses Details</h4> -->
                                                <!-- <form class="forms-sample" id="entry_form" action="functions/functions" method="POST" enctype="multipart/form-data"> -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="topic"> Topic Name</label>
                                                            <input required type="hidden" class="form-control" name="name" placeholder="Enter Name" id="editrow">
                                                            <select required class="form-control" name="topic" id="topic">

                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="courseName">Course Name</label>
                                                            <input required type="text" class="form-control" id="courseName" name="courseName" placeholder="Enter Course Name">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="image">Image</label>
                                                            <input required type="file" class="form-control" id="image" name="image" accept="image/*">
                                                            <input required type="hidden" id="oldImage" name="oldImage" width="100" height="100" />
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="editTitle">Existing Image</label><br>
                                                            <!-- <input required type="file" class="form-control" onchange="loadFile(event)" id="banner_image" name="banner_image"> -->
                                                            <img src="" id="output" name="output" width="100" height="100" />
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="image">Upload Video</label>
                                                            <input required type="file" class="form-control" id="video" name="video" accept="video/*">
                                                            <input required type="hidden" id="oldImage" name="oldImage" width="100" height="100" />
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="editTitle">Existing Image</label><br>
                                                            <!-- <input required type="file" class="form-control" onchange="loadFile(event)" id="banner_image" name="banner_image"> -->
                                                            <img src="" id="output" name="output" width="100" height="100" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="subtopic">Sub Topic Name</label>
                                                            <!-- <input required type="text" class="form-control" name="name" placeholder="Enter Name"> -->
                                                            <select required class="form-control" name="subtopic" id="subtopic">
                                                                <option> select subtopic name</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="price">Price</label>
                                                            <input required type="number" class="form-control" id="price" name="price" placeholder="Enter Price">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="uploadfile">Upload File</label>
                                                            <input required type="file" class="form-control" id="uploadfile" name="uploadfile">
                                                            <input required type="hidden" id="oldImage" name="oldImage" width="100" height="100" />
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="editTitle">Existing Image</label><br>
                                                            <!-- <input required type="file" class="form-control" onchange="loadFile(event)" id="banner_image" name="banner_image"> -->
                                                            <img src="" id="output" name="output" width="100" height="100" />
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="banner_desc">Description</label>
                                                            <!-- <textarea class="richtext" name="desc"> -->
                                                            <textarea id="inputTextLearn" class="richtext" rows="4" cols="50" placeholder="Enter a value"></textarea>
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
<!-- Main Content ends -->



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Bind a change event to the topic select
        $('#topic').change(function() {
            var topicId = $(this).val();
            if (topicId) {
                // Make an AJAX request to fetch subtopics for the selected topic
                $.ajax({
                    url: '../core/chepterTopicFunctions.php', // Replace with the actual server-side script
                    data: {
                        topicId: topicId
                    },
                    method: 'GET',
                    success: function(data) {
                        // Populate the subtopic select with the retrieved data
                        console.log(data);
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

<?php

include('includes/footer.php');

?>