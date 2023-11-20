<?php

if (isset($_GET["role"])) {
    if ($_GET["role"] == 'student' || $_GET["role"] == 'company') {
        $_SESSION['user_role'] = $_GET["role"];
        $userRole = $_SESSION['user_role'];
    } else {
        // Handle invalid role value (optional)
        // You may want to redirect or show an error message
        echo "Invalid role value!";
    }
}
require "db_config.php";
require "functions.php";
require "homeFunction.php";
require "blogsFunction.php";
require "data_list_grid.php";
require "login_register.php";
require "careerFunction.php";



if (isset($_GET['b_id'])) {
    $blogId = $_GET['b_id'];
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
if (isset($_GET['c_id'])) {
    $careerId = $_GET['c_id'];
    $fetch_list_career_query = mysqli_query($con, "SELECT * FROM careers WHERE Id = $careerId");

    if ($fetch_list_career_query) {
        $careerData = mysqli_fetch_assoc($fetch_list_career_query);
        $id = $careerData['Id'];
        $title = $careerData['Title'];
        $exp = $careerData['Experience'];
        $desc = $careerData['Description'];
        $createdOn = $careerData['CreatedOn'];
    } else {
        // Handle the case where the query fails
        echo "Error fetching career data: " . mysqli_error($con);
        // exit();
    }
} else {
    // echo "No career ID specified.";
}