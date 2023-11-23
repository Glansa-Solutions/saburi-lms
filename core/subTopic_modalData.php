<?php
include('db_config.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Handle the GET request to fetch subtopic data

    // Sanitize the input (e.g., using mysqli_real_escape_string)
    $sub_topic_name_id = mysqli_real_escape_string($con, $_GET['sub_topic_name']);

    $query = "SELECT subTopicName FROM `subtopics` WHERE id = $sub_topic_name_id";
    $result = mysqli_query($con, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $data = $row['subTopicName'];
        echo $data;
    } else {
        echo "Subtopic not found"; // Handle the case when no data is found
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle the POST request to update subtopics

    $topic_id = $_POST['updated_topic_id'];
    $subtopic_name_id = $_POST['sb_tp_id'];
    $subtopic_name = mysqli_real_escape_string($con, $_POST['updated_subtopic_name']);

    // Perform the update operation using prepared statements for security
    $update_query = mysqli_query($con,"UPDATE subtopics SET topicId = $topic_id, subTopicName = '$subtopic_name' WHERE id = $subtopic_name_id");

    if($update_query){
        echo "Subtopic updated successfully";
    }else{
        echo "Somthing went wrong";
    }
    echo $subtopic_name . " " . $topic_id." ".$subtopic_name_id;
} else {
    // Handle other request methods if needed
    echo "Unsupported request method";
}



mysqli_close($con);
?>
