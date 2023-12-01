<?php
include("db_config.php");

$nextId = $_GET['nextId'];
$userId = $_GET['userName'];
$password = $_GET['pwd'];
$courseId = $_GET['courseId'];
$courseContentId = $_GET['courseContentId'];
// echo json_encode($nextId.$userId.$password.$courseId.$courseContentId);
$fetch_course_login = mysqli_query($con, "SELECT * FROM courselogin WHERE username = '$userId' AND pwd = '$password' AND courseid = $courseId AND status = 1");
$count_course_login = mysqli_num_rows($fetch_course_login);
// echo json_encode($count_course_login);
if($count_course_login > 0){
    $update_course_login = mysqli_query($con, "UPDATE courselogin SET course_contentid = $nextId WHERE username = '$userId' AND pwd = '$password' AND courseid = $courseId AND status = 1");
}


?>