<?php
include("db_config.php");

$fetch_list_blog_query=mysqli_query($con,"SELECT * FROM blogs where isActive = 1");

if (isset($_GET['id'])) {
    $blogId = $_GET['id'];
    $fetch_list_blog_query = mysqli_query($con, "SELECT * FROM blogs WHERE id = $blogId");
    $latestBlogs = mysqli_query($con, "SELECT * FROM blogs ORDER BY createdOn DESC");
    $previousPostQuery = mysqli_query($con, "SELECT * FROM blogs WHERE id < $blogId AND isActive = 1 ORDER BY id DESC LIMIT 1");
    $nextPostQuery = mysqli_query($con, "SELECT * FROM blogs WHERE id > $blogId AND isActive = 1 ORDER BY id ASC LIMIT 1");

    $previousPost = mysqli_fetch_assoc($previousPostQuery);
    $nextPost = mysqli_fetch_assoc($nextPostQuery);

    $n=mysqli_fetch_array($fetch_list_blog_query);
    $id = $n['id'];
    $title=$n['blogTitle'];
    $writer=$n['writer'];
    $image=$n['bannerImage'];
    $description=$n['description'];
    // $tag=$n['name'];
    $createdOn=date('M j, Y', strtotime($n['createdOn']));  

}

?>