<?php
include("db_config.php");
function getUserRole() {
    return isset($_GET['role']) ? $_GET['role'] : '';
}

$userRole = getUserRole();

// Set the user's role in the session
$_SESSION['user_role'] = $userRole;


if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Using prepared statement to prevent SQL injection
    $s_id = mysqli_real_escape_string($con, $_GET['id']);
    
    $student_auth_query = mysqli_query($con, "SELECT id, email, name, password FROM students WHERE id='$s_id'");

    // Fetch student information
    $student_auth = mysqli_fetch_assoc($student_auth_query);
    if ($student_auth) {
        // Student information found
        $st_id = $student_auth['id'];
        $s_email = $student_auth['email'];
        $s_pass = $student_auth['password'];
        $s_name = $student_auth['name'];
    } else {
        // Student not found, handle accordingly (redirect, show error, etc.)
        echo "Student not found";
        exit; // or redirect to an error page
    }
} else {
    // Set default values if 'id' is not set or empty
    $s_id = '';
    $s_email = '';
    $s_pass = '';
    $s_name = '';
}
