<?php

include("db_config.php");

// Example debugging in getWishlistCount.php
$userId = isset($_GET['userId']) ? mysqli_real_escape_string($con, $_GET['userId']) : '';
$role = isset($_GET['role']) ? mysqli_real_escape_string($con, $_GET['role']) : '';


// Check if userId and role are not empty
if (!empty($userId) && !empty($role)) {
    // Replace with your actual logic to retrieve wishlist count
    $query = mysqli_query($con, "SELECT COUNT(*) as count FROM wishlist WHERE userId = '$userId' AND role = '$role'");

    if ($query) {
        $result = mysqli_fetch_assoc($query);
        // Return the wishlist count as JSON
        echo json_encode(['count' => $result['count']]);
    } else {
        // Handle the case where the query fails
        echo json_encode(['error' => 'Query failed']);
    }
} else {
    // If userId or role is empty, return an error message
    echo json_encode(['error' => 'Invalid input']);
}

// Close the database connection
mysqli_close($con);

?>
