<?php
// session_start();
include("db_config.php");

if (isset($_POST['proceed'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $role_id = $_POST['role_id'] ;
    $role = $_POST['role']; 
    
    
    $insert_query = mysqli_query($con, "INSERT INTO testinomonials (subscribedBy,subscribedId,title,description,createdOn) VALUES('$role','$role_id','$title','$description',NOW())");

    if ($insert_query) {
        header("location: $mainlink" . "testimonials");
        // echo "hii";
    } else {
        echo "not done";
        
    }

}
// update_status.php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Assuming you have a database connection already established

    $id = mysqli_real_escape_string($con, $_POST["id"]);
    $status = mysqli_real_escape_string($con, $_POST["status"]);

    // Update the status in the database
    $updateQuery = "UPDATE testinomonials SET isActive = $status WHERE id = '$id'";
    $result = mysqli_query($con, $updateQuery);

    if ($result) {
        echo "Status updated successfully";
    } else {
        echo "Error updating status";
    }

    // Close the database connection
    mysqli_close($con);
} else {
    // echo "Invalid request";
    echo " ";
}

?>