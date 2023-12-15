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

    // $topic_id = $_POST['updated_topic_id'];
    // $subtopic_name_id = $_POST['sb_tp_id'];
    // $subtopic_name = mysqli_real_escape_string($con, $_POST['updated_subtopic_name']);

    // // Fetch the existing subtopic name from the database
    // $fetch_existing_subtopic_query = mysqli_query($con, "SELECT subTopicName FROM subtopics WHERE id = $subtopic_name_id");
    // $existing_subtopic_row = mysqli_fetch_assoc($fetch_existing_subtopic_query);
    // $existing_subtopic_name = $existing_subtopic_row['subTopicName'];

    // if ($subtopic_name != $existing_subtopic_name){
    //     $update_query = mysqli_query($con,"UPDATE subtopics SET topicId = $topic_id, subTopicName = '$subtopic_name' WHERE id = $subtopic_name_id");
    //     if($update_query){
    //         echo "Updated Successfully";
    //     }else{
    //         $_SESSION['status'] = "danger";
    //         $_SESSION['message'] = "Not Updated";
    //     }
    //     // echo $subtopic_name . " " . $topic_id." ".$subtopic_name_id;
    // } else {
    //     // If the new subtopic name is the same as the existing one, return an error message
    //     echo "Subtopic name is the same. Update aborted.";
    // } 


    // Get the submitted values
    $updatedSubTopicName = $_POST['updated_subtopic_name'];
    $updatedTopicId = $_POST['updated_topic_id'];
    $sbTpId = $_POST['sb_tp_id'];

    // Query to get the existing Sub Topic Name
    $getExistingSubTopicQuery = "SELECT subTopicName FROM subtopics WHERE id = $sbTpId";
    $result = mysqli_query($con, $getExistingSubTopicQuery);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $existingSubTopicName = $row['subTopicName'];
    
        // Check if Sub Topic Name has changed
        if ($existingSubTopicName !== $updatedSubTopicName) {
            // Perform the update
            $updateQuery = "UPDATE subtopics SET subTopicName = '$updatedSubTopicName', topicId = $updatedTopicId WHERE id = $sbTpId";
            $updateResult = mysqli_query($con, $updateQuery);
    
            if ($updateResult) {
                // Send a success message back to JavaScript
                echo "success";
            } else {
                // Send an error message back to JavaScript
                echo "error";
            }
        } else {
            // Sub Topic Name has not changed
            echo "no_changes";
        }
    } else {
        // Query to get existing Sub Topic Name failed
        echo "error";
    }

} else {
    // Handle other request methods if needed
    echo "Unsupported request method";
}



mysqli_close($con);
?>
