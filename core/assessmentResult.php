<?php
include("db_config.php");

$userRole = $_POST['userRole'];
$userid = $_POST['userid'];
$courseid = $_POST['courseid'];
$assessmentid = $_POST['assessmentid'];
$totalScore = $_POST['totalScore'];
$acquiredScore = $_POST['acquiredScore'];

// echo json_encode($userRole.$userid.$courseid.$assessmentid.$totalScore.$acquiredScore);
// exit();
$fetch_assessment_result = mysqli_query($con, "SELECT * FROM assessmentresult WHERE userRole = '$userRole' AND userId = '$userid' AND courseId = $courseid AND assessmentId = $assessmentid AND isAttend = 1");
$count_assessment_result = mysqli_num_rows($fetch_assessment_result);
// echo json_encode($count_course_login);
if($count_assessment_result > 0){
    echo json_encode("You are already submit the test, Please click on next button");
}else{
    $insert_assessment_result = mysqli_query($con, "INSERT INTO assessmentresult (userRole, userId, courseId, assessmentId, acquiredScore,totalScore, isAttend) VALUES ('$userRole', $userid, $courseid, '$assessmentid', '$acquiredScore','$totalScore', 1)");
    echo json_encode("Test submitted sucessfully, Your score is ".$acquiredScore. "out of ".$totalScore);
}


?>