<?php
session_start();
include("db_config.php");
// $mainlink=""
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['role'])) {
        $_SESSION['role'] = $_POST['role'];
        header("Location: ../account");
    }
}
// echo $_GET['id'];
if (isset($_GET['id'])) {
    $_SESSION['role_id'] = $_GET['id'];
    $role_id = $_SESSION['role_id'];
    header("Location: ../");
    exit();
    // echo $role_id;
}
// login Sessions
if (isset($_GET['login_id'])) {
    $_SESSION['role_id'] = $_GET['login_id'];
    $role_id = $_SESSION['role_id'];
    // echo $role_id;
    // exit();
    header("Location: ../account");
    exit();
    // echo $role_id;
}

if (isset($_GET['logged_in_elsewhere'])) {
    $_SESSION['role_id'] = $_GET['logged_in_elsewhere'];
    $_SESSION['login_else_message'] = "You have logged in already, kindly logout or reset login.";
    // $role_id = $_SESSION['role_id'];
    $prev_login_id = $_SESSION['role_id'];
    $fetch_prev_login_id = mysqli_query($con, "SELECT email FROM students WHERE id= $prev_login_id");
    if ($fetch_prev_login_id) {
        $row = mysqli_fetch_assoc($fetch_prev_login_id);
        $email = $row['email'];
        $_SESSION['prev_email'] = $email;
        header("location: ../alertmessage");
    } else {
        echo "email is wrong";
    }
    // header("Location: prev_login.php");
    // header("Location: ../alertmessage");
    exit();
}

if (isset($_GET['current_login_id'])) {
    $current_login_id = $_GET['current_login_id'];
    $set_prev_login_to_zero = mysqli_query($con, "UPDATE students SET session_id = 0 WHERE id = $current_login_id");
    if ($set_prev_login_to_zero) {
        header("location: ../account");
        exit();
    }else{
        echo "unable to reset login";
    }
}


if (isset($_GET['start_id']) && isset($_GET['chapterId'])) {
    $_SESSION['course_id'] = $_GET['start_id'];
    $_SESSION['chapter_id'] = $_GET['chapterId'];
    header("Location: ../chapterSingle");

}
if (isset($_GET['ch_id'])) {
    $_SESSION['role_id'] = $_GET['ch_id'];
    $_SESSION['role'];
    header("Location: ../changepassword");
    exit();
}
// Redirect to the account page
exit;
?>