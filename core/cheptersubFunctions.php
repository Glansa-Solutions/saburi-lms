<?php 

include("db_config.php");
$subTopicId = $_GET['subtopicId'];


$courseQuery = "SELECT id, courseName FROM courses WHERE subTopicId = $subTopicId";
$courseList = mysqli_query($con, $courseQuery);

if ($courseList) {
    $courseoptions = '<option>select subtopic name</option>';
    while ($row = mysqli_fetch_assoc($courseList)) {
        $courseoptions .= "<option value='{$row['id']}'>{$row['courseName']}</option>";
    }
    echo $courseoptions;
    
} else {
    echo '<option>Failed to fetch subtopics</option>';
}

// Close the database connection
mysqli_close($con);
?>