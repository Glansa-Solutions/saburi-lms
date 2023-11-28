<?php
include("db_config.php");


if (isset($_POST['review'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $reviewdata = mysqli_real_escape_string($con, $_POST['reviewdata']);
    $course_id = mysqli_real_escape_string($con, $_POST['course_id']);
    $role = mysqli_real_escape_string($con, $_POST['role']);
    // echo $comment;
    // exit();
    $query_inert_comments_review=mysqli_query($con,"INSERT INTO comment_course_review(courseId,review,name,email,reviewed_by,created_by,isactive)VALUES($course_id,'$reviewdata','$name','$email','$role','$role',0)");

    if($query_inert_comments_review){
        header("location: $mainlink"."course_single?course_id=$course_id");
        exit();
    }else{
        echo "not inserted";
        exit();
    }

}else{
    echo "something went wrong";
    exit();
}

?>
