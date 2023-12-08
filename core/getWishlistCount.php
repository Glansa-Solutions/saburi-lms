<?php

include("db_config.php");

$userId = $_GET['userId'];
$role = $_GET['role'];
// Replace with your actual logic to retrieve wishlist count
$query = mysqli_query($con, "SELECT COUNT(*) as count FROM wishlist WHERE userId = '$userId' AND role = $role");
$result = mysqli_fetch_assoc($query);

// Return the wishlist count as JSON
echo json_encode($result['count']);

// Close the database connection
mysqli_close($con);

?>
