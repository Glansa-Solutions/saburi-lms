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
if(isset($_GET['id'])&&($_GET['set'])){
    $_SESSION['role_id']=$_GET['id'];
    $_SESSION['role_set']=$_GET['set'];
    echo $$_SESSION['role_set'];
    if($_SESSION['role_set']===0){
        header("Location: ../");
        exit();
    }else{
    $role_id = $_SESSION['role_id'];
    echo "you have already loged in";
    $role_session_id = $_SESSION['role_set'];
    header("Location: ../account");
    exit();
    }

    $role_id = $_SESSION['role_id'];
    $role_session_id = $_SESSION['role_set'];
    header("Location: ../");
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