<?php
include("db_config.php");

if (isset($_GET['id'])) {
    $careerId = $_GET['id'];
    $fetch_list_career_query = mysqli_query($con, "SELECT * FROM careers WHERE Id = $careerId");

    if ($fetch_list_career_query) {
        $careerData = mysqli_fetch_assoc($fetch_list_career_query);
        $id = $careerData['Id'];
        $title = $careerData['Title'];
        $exp = $careerData['Experience'];
        $desc = $careerData['Description'];
        $createdOn = $careerData['CreatedOn'];
    } else {
        // Handle the case where the query fails
        echo "Error fetching career data: " . mysqli_error($con);
        // exit();
    }
} else {
    // echo "No career ID specified.";
}

?>