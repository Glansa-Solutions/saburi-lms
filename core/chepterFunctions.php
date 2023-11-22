<?php
// Include your database connection file here
// include('includes/db_connection.php');
include("db_config.php");

$courseId = $_GET['courseId'];


$chaptersQuery = "SELECT id, chapterName FROM chapters WHERE courseId = $courseId";
$chapterList = mysqli_query($con, $chaptersQuery);

if ($chapterList) {
    $chapterOptions = '<option>select subtopic name</option>';
    while ($row = mysqli_fetch_assoc($chapterList)) {
        $chapterOptions .= "<option value='{$row['id']}'>{$row['chapterName']}</option>";
    }
    echo $chapterOptions;
    
} else {
    echo '<option>Failed to fetch subtopics</option>';
}

// Close the database connection
mysqli_close($con);

?>