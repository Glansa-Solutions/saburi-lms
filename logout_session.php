<?php
session_start();
// Include your database connection code here

// Function to update the session_id for a student
function updateStudentSession($studentId) {
    include("core/db_config.php");
    $id_update = mysqli_query($con,"UPDATE students SET session_id = 0 WHERE id = $studentId");
}

// Check if the user is logged in
if (isset($_SESSION['role_id'])) {
    $studentId = $_SESSION['role_id'];

    // Update the session_id for the student
    updateStudentSession($studentId);
}

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page or any other page after logout
header("Location: ./logout.php");
exit();
?>
