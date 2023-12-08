<?php
include("db_config.php");

$courseId = $_GET['courseId'];
$action = $_GET['action'];


$assessmentQuery = "SELECT id, assessmentName FROM assessment WHERE courseId = $courseId";
$assessmentList = mysqli_query($con, $assessmentQuery );

$chaptersQuery = "SELECT id, chapterName FROM chapters WHERE courseId = $courseId";
$chapterList = mysqli_query($con, $chaptersQuery);





if ($action == "getAssessments") {
    
    $assessmentOptions = '<option value="" >select Assessment name</option>';
    while ($row = mysqli_fetch_assoc($assessmentList)) {
        $assessmentOptions .= "<option value='{$row['id']}'>{$row['assessmentName']}</option>";
    }
    echo $assessmentOptions;
    
} else  {
    $chapterOptions = '<option value="">select chapter name</option>';
    while ($row = mysqli_fetch_assoc($chapterList)) {
        $chapterOptions .= "<option value='{$row['id']}'>{$row['chapterName']}</option>";
    }
    echo $chapterOptions; 
} 
// Close the database connection
mysqli_close($con);

?>