<?php
session_start();
// Include your database connection code here

// Function to update the session_id for a student
function updateSession($role_Id,$role) {
    include("core/db_config.php");
    $id_update = mysqli_query($con,"UPDATE $role SET session_id = 0 WHERE id = $role_Id");
}

// Check if the user is logged in
if (isset($_SESSION['role_id'])) {
    $role= $_SESSION['role'];
    $role_Id = $_SESSION['role_id'];
    // if($role == "company" || $role=="students"){
        updateSession($role_Id,$role);
    // }else{
    //     echo "User Role Is Undefined";
    //     exit();
    // }
}

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page or any other page after logout
header("Location: ./logout.php");
exit();
?>
