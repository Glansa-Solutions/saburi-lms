<?php
include("db_config.php");

// Home Blogs Fetch
$sql = "SELECT * FROM blogs ORDER BY createdOn DESC LIMIT 3";
$blogs = $con->query($sql);

// Home New Online Course Fetch
$sql = "SELECT DISTINCT subtopics.id, subtopics.subTopicName
FROM subtopics
INNER JOIN courses ON subtopics.id = courses.subTopicId
ORDER BY subtopics.createdOn DESC
LIMIT 5";
$allCourseListQuery = "SELECT * FROM courses ORDER BY id DESC";

$result = $con->query($sql);
$allCourses = $con->query($allCourseListQuery);

// Banner functions
$fetch_banner_content_query = mysqli_query($con,"select * from home");
$fetch_banner_content = mysqli_fetch_assoc($fetch_banner_content_query);
$banner_name = $fetch_banner_content['bannerImage'];
$banner_title = $fetch_banner_content['Title'];
$banner_Description = $fetch_banner_content['Description'];

// About functions
$fetch_about_content_query = mysqli_query($con,"select * from about");
$fetch_about_content = mysqli_fetch_assoc($fetch_about_content_query);
$about_banner_name = $fetch_about_content['bannerImage'];
$about_title = $fetch_about_content['Title'];
$about_Description = $fetch_about_content['Description'];


?>