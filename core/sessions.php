<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['role']) && isset($_POST['role'])) {
        $_SESSION['role'] = $_POST['role'];
    }
}

// Redirect to the account page
header("Location: http://localhost/saburi-lms/account");
exit;
?>
