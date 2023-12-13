<?php
include('includes/header.php');
include('includes/sidebar.php');
// include('../core/listgrid.php');
// include('../core/admin_functions.php');
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
                    url: '../core/chepterTopicFunctions.php',
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

    $(document).ready(function () {
        // Initialize an array to store selected values
        var selectedRows = [];

        function arrayAdd() {
            return selectedRows;
        }



        // Add a row to the table on "Add" button click
        $('#addTable').click(function () {
            // Get the selected values
            var topicId = $('#topic').val();
            var subtopicId = $('#subtopic').val();
            var courseId = $('#courseName').val();
            var srNo = $('#dataTable tbody tr').length + 1;
            var radioButtonValue = $('input[name="optradio"]:checked').val();
            var chapterId = $('#chapter option:selected').val();
            var chapterName = $('#chapter option:selected').text();

            // Check if the Name dropdown value is empty
            var selectedCourse = $('#chapter').val();
            if (!selectedCourse) {
                alert('Please select Creation Details.');
                return; // Stop execution if the validation fails
            }

            // Check if all required values are selected
            if (radioButtonValue && chapterName) {
                var alreadyExists = selectedRows.some(function (row) {
                    return (
                        row.courseId == courseId &&
                        row.chapterId == chapterId &&
                        row.chapterName == chapterName &&
                        row.radioButtonValue == radioButtonValue
                    );
                });

                if (alreadyExists) {
                    alert("Already exists");
                } else {
                    // Add the selected values to the array
                    selectedRows.push({
                        'topicId': topicId,
                        'subtopicId': subtopicId,
                        'courseId': courseId,
                        'Sr. No': selectedRows.length + 1,
                        'radioButtonValue': radioButtonValue,
                        'chapterId': chapterId,
                        'chapterName': chapterName
                    });

                    // Set hidden field values
                    $('#selected_topic').val($('#topic').val());
                    $('#selected_subtopic').val($('#subtopic').val());
                    $('#selected_course').val($('#courseName').val());

                    // Clear selected values
                    $('input[name="optradio"]').prop('checked', false);
                    $('#chapter').val('');

                    // Clear existing table rows
                    $('#dataTable tbody').empty();

                    // Add rows based on the array values
                    for (var i = 0; i < selectedRows.length; i++) {
                        var rowData = selectedRows[i];
                        $('#dataTable tbody').append('<tr><td>' + rowData['Sr. No'] + '</td><td>' + rowData['radioButtonValue'] + '</td><td>' + rowData['chapterName'] + '</td></tr>');
                    }
                }


            } else {
                // Display an alert or handle the case where not all values are selected
                alert('Please select radioButtonValue and chapterName.');
            }
        });

        $('#submitTable').click(function () {
            var data = arrayAdd();
            // console.log(arrayAdd());
            // Make an AJAX request to send the selected rows to the server
            $.ajax({
                url: '../core/admin_functions.php', // Replace with the actual server-side script
                method: 'POST',
                data: {
                    // selectedRows: selectedRows,
                    selectedRows: data,
                    assessment_creation: true,
                },
                success: function (response) {
                    // Handle the response from the server if needed
                    // console.log(response, "");
                }
            });
        })

        function getUrlParameter(name) {
            name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
            var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
            var results = regex.exec(window.location.search);
            return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
        }

        // Fetch the assessment ID from the URL
        var chapterAssessmentCreationId = getUrlParameter('id');


        console.log(chapterAssessmentCreationId, "chapterAssessmentCreationId");
        if (chapterAssessmentCreationId) {
            $.ajax({
                type: 'POST',
                url: '../core/admin_functions.php',
                data: {
                    'checking_assessment_creation_btn': true,
                    'chapterAssessmentCreationId': chapterAssessmentCreationId,
                },
                // dataType: 'json',
                success: function (response) {
                    // console.log(response, "hii");

                    var jsonResponse = JSON.parse(response);

                    for (var res of jsonResponse) {
                        selectedRows.push({
                            'topicId': res.tId,
                            'subtopicId': res.sId,
                            'courseId': res.cId,
                            'Sr. No': selectedRows.length + 1, // Increment Sr. No for each row
                            'radioButtonValue': res.type,
                            'chapterId': res.caId,
                            'chapterName': res.names
                        });

                        var desiredValue = res.tId;
                        var subtopicId = res.sId;
                        var courseId = res.cId

                        $('#topic').val(desiredValue);
                        $('#topic').change();
                        $.ajax({
                            url: '../core/chepterTopicFunctions.php',
                            data: {
                                topicId: desiredValue
                            },
                            method: 'GET',
                            success: function (data) {
                                $('#subtopic').html(data);
                                $('#subtopic').val(subtopicId);
                                $('#subtopic').change();
                                $.ajax({
                                    url: '../core/cheptersubFunctions.php',
                                    data: {
                                        subtopicId: subtopicId
                                    },
                                    method: 'GET',
                                    success: function (data) {
                                        $('#courseName').html(data);
                                        $('#courseName').val(courseId);
                                        $('#courseName').change();
                                    }
                                });
                            }
                        });



                        // $('#topic option').each(function () {

                        //     if ($(this).val() == desiredValue) {
                        //         $(this).prop('selected', true);
                        //         $('#topic').change();
                        //         return false;
                        //     }
                        // });


                        // $('#subtopic option').each(function() {
                        //     if ($(this).val() == subtopicId) {
                        //         $(this).prop('selected', true);
                        //         var sub = $('#subtopic').change();

                        //         console.log(sub, "sub")
                        //         // Exit the loop once the desired option is found
                        //         return false;
                        //     }
                        // });

                    }
                    console.log(selectedRows, "selectedRows");
                    for (var i = 0; i < selectedRows.length; i++) {
                        var rowData = selectedRows[i];
                        // console.log(rowData);
                        $('#dataTable tbody').append('<tr><td>' + rowData['Sr. No'] + '</td><td>' + rowData['radioButtonValue'] + '</td><td>' + rowData['chapterName'] + '</td></tr>');
                    }

                }
            });
        }
        // console.log(blogId);



        // Reset the table on "Reset" button click
        $('#resetTable').click(function () {
            selectedRows = []; // Clear the array
            $('#dataTable tbody').empty();
        });
    });

    $(document).ready(function () {
        // Bind a change event to the radio buttons
        $('input[name="optradio"]').change(function () {
            var selectedOption = $(this).val();
            var courseId = $('#courseName').val(); // Assuming you have a dropdown with id 'topic' for selecting the course

            if (selectedOption === 'chapters') {
                // Make an AJAX request to fetch chapters for the selected course
                $.ajax({
                    url: '../core/ordersFunction.php',
                    data: {
                        courseId: courseId,
                        action: 'getChapters'
                    },
                    method: 'GET',
                    success: function (data) {
                        console.log(data);
                        // Populate the chapter select with the retrieved data
                        $('#chapter').html(data);
                    }
                });
            } else if (selectedOption === 'assessments') {
                // Make an AJAX request to fetch assessments for the selected course
                $.ajax({
                    url: '../core/ordersFunction.php',
                    data: {
                        courseId: courseId,
                        action: 'getAssessments'
                    },
                    method: 'GET',
                    success: function (data) {
                        // Populate the assessment select with the retrieved data
                        $('#chapter').html(data);
                    }
                });
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
                    <!-- <form action="../core/admin_functions.php" class=" " method="POST" enctype="multipart/form-data"> -->
                    <div class="row">
                        <h4 class="card-title">Courses Creation Details</h4>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="topic"> Topic Name</label>
                                <!-- <input type="text" class="form-control" name="name" placeholder="Enter Name"> -->
                                <select class="form-control" class="topic" name="topic" id="topic">
                                    <option value="">Select Topic Name</option>
                                    <?php
                                    if($fetch_list_topic_query) {
                                        // $i = 1;
                                        while($row = mysqli_fetch_assoc($fetch_list_topic_query)) {
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
                            <div class="ms-4 mt-4">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="selectopt" name="optradio"
                                        value="chapters">
                                    <label class="form-check-label" for="chapters">Chapter</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="selectopt" name="optradio"
                                        value="assessments">
                                    <label class="form-check-label" for="assessments">Assessment</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="courseName">Subtopic Name</label>
                                <select class="form-control" name="subtopic" id="subtopic">
                                    <!-- <option> select subtopic name</option> -->
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="selected_topic" id="selected_topic" value="">
                        <input type="hidden" name="selected_subtopic" id="selected_subtopic" value="">
                        <input type="hidden" name="selected_course" id="selected_course" value="">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="chapter">Name</label>
                                <select class="form-control" name="chapter" id="chapter">
                                    <!-- <option value=""> Select chapterName</option> -->
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="courseName">Course Name</label>
                                <select class="form-control" name="courseName" id="courseName">
                                    <!-- <option> Select Course name</option> -->
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mt-4">
                            <div class="form-group">
                                <button type="button" class="btn btn-primary me-2" id="addTable"
                                    name="addTable">ADD</button>
                                <!-- <button type="button" class="btn btn-light" id="cancel_btn" onclick="resetForm()">Reset</button> -->
                            </div>
                        </div>
                        <!-- Add this table to display selected values -->
                        <table class="table" id="dataTable">
                            <thead>
                                <tr>
                                    <th>Sr. No</th>
                                    <th>Type Name</th>
                                    <th>Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Table content will be added dynamically -->
                            </tbody>
                        </table>
                        <!-- Add Reset and Submit buttons -->
                        <div class="col-md-6 mt-4">
                            <div class="form-group">
                                <button type="button" class="btn btn-warning" id="resetTable">Reset</button>
                                <!-- <button type="submit" style="color:white;text-decoration:none"  ></button> -->
                                <a class="btn btn-success" id="submitTable" name="assessment_creation"
                                    href="caoGrid">submit</a>
                            </div>
                        </div>
                    </div>
                    <!-- </form> -->

                </div>
            </div>
        </div>
        <div class="col-md-12 grid-margin stretch-card">
        </div>
    </div>
</div>
</div>
</div>

<?php

include('includes/footer.php');

?>