<?php
include("db_config.php");


if (isset($_POST['comment'])) {
    $website = mysqli_real_escape_string($con, $_POST['website']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $comment = mysqli_real_escape_string($con, $_POST['commentdata']);
    $blog_id = mysqli_real_escape_string($con, $_POST['blog_id']);
    $role = mysqli_real_escape_string($con, $_POST['role']);
    // echo $comment;
    // exit();
    $query_inert_comments=mysqli_query($con,"INSERT INTO comments_blog(blog_id,comment,website,name,email,commented_by,isactive)VALUES($blog_id,'$comment','$website','$name','$email','$role',0)");

    if($query_inert_comments){
        header("location: $mainlink"."blog_single?b_id=$blog_id");
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
