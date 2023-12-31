<?php
include('includes/header.php');
include('includes/sidebar.php');
include('../core/listgrid.php');
?>

<style>
.tag-container {
    display: flex;
    flex-wrap: wrap;
}

.tag {
    background-color: #0073e6;
    color: #fff;
    padding: 5px 10px;
    margin: 5px;
    border-radius: 5px;
    display: flex;
    align-items: center;
}

.tag-text {
    margin-right: 5px;
}

.tag-remove {
    cursor: pointer;
}

ul {
    background-color: #eee;
    cursor: pointer;
}

li {
    padding: 12px;
}

.truncate-text {
    max-width: 100px;
    /* Adjust the max width as needed */
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
</style>
<!-- Main Content Panel -->
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Blog Page</h4>
                    <!-- <p class="card-description">
                        You can Write the content for about page.
                    </p> -->

                    <form class="forms-sample" id="entry_form"action="../core/admin_functions.php" method="POST"
                        enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Enter Blog Title" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                        </div>
                        <div class="form-group">
                            <label for="writer">Writer</label>
                            <input type="text" class="form-control" name="writer" placeholder="Enter Writer Name" required>
                        </div>

                        <div class="form-group">
                            <label for="desc">Description</label>
                            <div id="editor">
                                <textarea id="editAddress" class="mySummernote" name="desc" required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="container">
                                <label for="desc">Tags</label>
                                <input type="text" id="tags" name="tags" class="form-control" placeholder="Add a tag" required>
                                <div id="taglist"></div>
                                <div class="tag-container" id="selectedTagsContainer"></div>
                                <input type="hidden" id="selectedTags" name="selectedTags" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary me-2" name="blog_manage">Submit</button>
                        <button type="button" class="btn btn-light" id="cancel_btn" onclick="resetForm()">Reset</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Blog list</h4>
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>S.no</th>
                                <th hidden>ID</th>
                                <th>Title</th>
                                <th> Writer </th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($fetch_list_blog_query) {
                                $i = 1;
                                while ($row = mysqli_fetch_assoc($fetch_list_blog_query)) {
                                    $id = $row['id'];
                                    $title = $row['blogTitle'];
                                    $writer = $row['writer'];
                                    $image = $row['bannerImage'];
                                    $description = $row['description'];
                                    $created_on = $row['createdOn'];

                                    ?>
                            <tr>
                                <td>
                                    <?= $i; ?>
                                </td>
                                <td class="blogId" hidden>
                                    <?= $id; ?>
                                <td>
                                    <?= $title; ?>
                                </td>
                                <td>
                                    <?= $writer; ?>
                                </td>
                                <td><img src="../assets/images/blog/<?= $image; ?>" width="80" height="80"></td>
                                <td class="truncate-text">
                                    <?= $description; ?>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary p-2 edit-button" data-bs-toggle="modal"
                                        data-bs-target="#editBlogModal" data-blog-id="<?= $id ?>">
                                        edit
                                    </button>

                                    <button class="btn btn-danger p-2 delete-button" data-bs-toggle="modal"
                                        data-bs-target="#deleteBlogModal" data-blog-id="<?= $id ?>">Delete</button>
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

        <!-- </div>
</div> -->


        <!-- Modal for editing blog content -->
        <div class="modal fade" id="editBlogModal" tabindex="-1" role="dialog" aria-labelledby="editBlogModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editBlogModalLabel">Edit Blog</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="../core/admin_functions.php" enctype="multipart/form-data">
                        <div class="modal-body">
                            <!-- Form for editing the blog content -->

                            <input type="hidden" id="blog_id" name="blog_id">
                            <div class="form-group">
                                <label for="editTitle">Title</label>
                                <input type="text" class="form-control" id="editTitle" name="editTitle" required>
                            </div>
                            <div class="form-group">
                                <label for="editWriter">Writer</label>
                                <input type="text" class="form-control" id="editWriter" name="editWriter" required>
                            </div>
                            <div class="form-group">
                                <label for="editImage">Image</label>
                                <input type="file" class="form-control" onchange="loadFile(event)" id="editImage"
                                    name="editImage" required>

                                <input type="hidden" id="oldImage" name="oldImage" width="80" height="80" />
                            </div>

                            <div class="form-group">
                                <label for="editTitle">Existing Image</label><br>

                                <img src="" id="output" name="output" width="80" height="80" required/>
                            </div>

                            <div class="form-group">
                                <label for="editDescription">Description</label>
                                <textarea  id="edit" required>

                            </textarea>
                                <!-- <div id="editor">
                                    <textarea class="form-control" id="edit" name="editDescription"></textarea>
                                </div> -->
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="saveChanges" name="update">Save
                                Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="deleteBlogModal" tabindex="-1" role="dialog"
            aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="../core/admin_functions.php" method="POST" >
                        <div class="modal-body">

                            <input type="hidden" id="delete_id" name="delete_id">
                            Are you sure you want to delete this record?
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger" name="delete_blog"
                                id="delete_blog">Delete</button>
                        </div>
                </div>
            </div>
        </div>

        <script>
        $(document).ready(function() {
            // Initialize an array to store selected tags
            var selectedTags = [];

            // Function to add a selected tag to the container
            function addTagToContainer(tagText) {
                var tagElement = '<div class="tag">' +
                    '<span class="tag-text">' + tagText + '</span>' +
                    '<span class="tag-remove" data-tag="' + tagText + '">&times;</span>' +
                    '</div>';
                $('#selectedTagsContainer').append(tagElement);
            }

            // Function to update the hidden input field with selected tags
            function updateSelectedTagsInput() {
                $('#selectedTags').val(selectedTags.join(','));
            }

            $('#tags').keyup(function() {
                var tag = $(this).val();

                if (tag != '') {
                    $.ajax({
                        url: "./search.php",
                        method: "POST",
                        data: {
                            tag: tag
                        },
                        success: function(data) {
                            $('#taglist').fadeIn();
                            $('#taglist').html(data);
                        }
                    });
                } else {
                    $('#taglist').fadeOut();
                    $('#taglist').html("");
                }
            });

            $(document).on('click', 'li', function() {
                var tagText = $(this).text();
                // Check if the tag is not already in the selected tags array
                if (!selectedTags.includes(tagText)) {
                    selectedTags.push(tagText);
                    addTagToContainer(tagText);
                    updateSelectedTagsInput();
                }
                $('#tags').val('');
                $('#taglist').fadeOut();
                $('#taglist').html("");
            });

            $(document).on('click', '.tag-remove', function() {
                var tagText = $(this).data('tag');
                // Remove the tag from the selected tags array
                selectedTags = selectedTags.filter(tag => tag !== tagText);
                $(this).parent().remove();
                updateSelectedTagsInput();
            });
        });
        </script>

        <script>
        $(document).ready(function() {
            $('.edit-button').on('click', function() {
                var blogId = $(this).closest('tr').find('.blogId').text();
                console.log(blogId);
                $.ajax({
                    type: 'POST',
                    url: '../core/admin_functions.php', // Replace with the URL of your server-side script
                    data: {
                        'checking_edit_btn': true,
                        'blog_id': blogId,
                    },
                    // dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        $.each(response, function(key, value) {
                            $('#editTitle').val(value['blogTitle']);
                            $('#editWriter').val(value['writer']);
                            $('#output').attr('src', '../assets/images/blog/' +
                                value['bannerImage']);
                            // You can handle image display or updating as needed
                            $('#edit').val(value['description']);
                            // console.log(a);
                            $('#blog_id').val(value['id']);
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
                var blogId = $(this).closest('tr').find('.blogId').text();

                console.log(blogId);
                $('#delete_id').val(blogId);
                $('#deleteBlogModal').modal('show');

            });
        });
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <script>
        var loadFile = function(event) {

            var output = document.getElementById('output');

            output.src = URL.createObjectURL(event.target.files[0]);

            output.onload = function() {

                URL.revokeObjectURL(output.src) // free memory

            }

        };
        </script>
        <!-- Main Content ends -->

        <!-- Main Content ends -->

        <?php

        include('includes/footer.php');

        ?>