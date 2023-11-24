<?php
session_start();
// include("db_config");
// $mainlink=""
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['role'])) {
        $_SESSION['role'] = $_POST['role'];
        header("Location: ../account");
    }
}
// echo $_GET['id'];
if(isset($_GET['id'])){
    $_SESSION['role_id']=$_GET['id'];
    $role_id = $_SESSION['role_id'];
    header("Location: ./");
    exit();
    // echo $role_id;
}
// login Sessions
if(isset($_GET['login_id'])){
    $_SESSION['role_id']=$_GET['login_id'];
    $role_id = $_SESSION['role_id'];
    // echo $role_id;
    // exit();
    header("Location: ../account");
    exit();
    // echo $role_id;
}
if(isset($_GET['start_id'])&&isset($_GET['chapterId'])){
    $_SESSION['course_id']=$_GET['start_id'];
    $_SESSION['chapter_id']=$_GET['chapterId'];
    header("Location: ../chapterSingle");

}
// Redirect to the account page
exit;
?>