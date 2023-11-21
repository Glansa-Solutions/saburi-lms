<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['role'])) {
        $_SESSION['role'] = $_POST['role'];
        header("Location: http://localhost/saburi-lms/account");
    }
}
// echo $_GET['id'];
if(isset($_GET['id'])){
    $_SESSION['role_id']=$_GET['id'];
    $role_id = $_SESSION['role_id'];
    header("Location: http://localhost/saburi-lms/");
    exit();
    // echo $role_id;
}
// login Sessions
if(isset($_GET['login_id'])){
    $_SESSION['role_id']=$_GET['login_id'];
    $role_id = $_SESSION['role_id'];
    // echo $role_id;
    // exit();
    header("Location: http://localhost/saburi-lms/account");
    exit();
    // echo $role_id;
}
// Redirect to the account page
exit;
?>