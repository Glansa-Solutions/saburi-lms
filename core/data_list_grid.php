<?php

include("db_config.php");

$fetch_list_topic_query=mysqli_query($con,"SELECT * FROM topics");
$fetch_list_subtopic_query=mysqli_query($con,"SELECT * FROM subtopics");

if ($fetch_list_topic_query) {
    $i = 1;
    while ($row = mysqli_fetch_assoc($fetch_list_topic_query)) {
        $id = $row['Id'];
        $topic_name = $row['topicName'];
        
    }
}

$query = mysqli_query($con, "select * from courses ");

if($query)
{
    while($row1 = mysqli_fetch_assoc($query))
    {
        $courseName=$row1['courseName'];
        $courseCost=$row1['courseCost'];
        $courseImage=$row1['bannerImage'];
    }
}


$totalCoursesQuery = mysqli_query($con, "SELECT COUNT(*) AS total FROM courses");
$totalCourses = mysqli_fetch_assoc($totalCoursesQuery)['total'];

// Number of products to display per page
$productsPerPage = 6;

// Calculate the total number of pages
$totalPages = ceil($totalCourses / $productsPerPage);

// Determine the current page
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Ensure the current page is within valid bounds
if ($currentPage < 1) {
$currentPage = 1;
} elseif ($currentPage > $totalPages) {
$currentPage = $totalPages;
}

// Calculate the SQL query's LIMIT based on the current page
$offset = ($currentPage - 1) * $productsPerPage;

// Modify the SQL query to include the LIMIT and OFFSET
$query = mysqli_query($con, "SELECT * FROM courses LIMIT $productsPerPage OFFSET $offset");

?>