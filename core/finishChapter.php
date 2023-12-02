<?php
include("db_config.php");

if (isset($_POST["finishClick"])) {
    $userId = $_POST['userName'];
    $password = $_POST['pwd'];
    $courseId = $_POST['courseId'];
    $courseContentId = $_POST['courseContentId'];

    // Assuming $con is a valid database connection
    $update_course_status = mysqli_query($con, "UPDATE courselogin SET status = 0 WHERE username = '$userId' AND pwd = '$password' AND courseid = $courseId AND course_contentid = $courseContentId");

    if ($update_course_status) {
        echo 'thankyou';
        exit();
    } else {
        // Query failed, log the error or handle it accordingly
        echo "Error updating course status: " . mysqli_error($con);
    }
}




?>