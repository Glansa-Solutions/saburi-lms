<?php

include("db_config.php");
$fetch_list_query=mysqli_query($con,"SELECT * FROM users");
$fetch_user_contact_query=mysqli_query($con,"SELECT * FROM contact");
$fetch_user_contact_details_query=mysqli_query($con,"SELECT * FROM contact_details");
$fetch_user_newsletter_query=mysqli_query($con,"SELECT * FROM newsletter");
$fetch_list_topic_query=mysqli_query($con,"SELECT * FROM topics");
$categoryQuery = mysqli_query($con, "SELECT * FROM careercategory");
$careerQuery = mysqli_query($con, "SELECT * FROM careers ");
$fetch_list_query_subscription=mysqli_query($con,"SELECT * FROM subscriptions_1");
$fetch_list_join_topics_subtopic_query=mysqli_query($con,"SELECT topics.topicName,subtopics.subTopicName FROM subtopics INNER JOIN topics ON topics.Id = subtopics.topicId;");
$fetch_list_join_topics_subtopic_course_query=mysqli_query($con,"SELECT 
topics.Id AS topic_id,
topics.topicName,
subtopics.Id AS subtopic_id,
subtopics.subTopicName,
courses.id AS course_id,
courses.courseName,
courses.courseCost,
courses.courseDesc,
courses.bannerImage,
courses.uploadfile,
courses.learn,
courses.requirements,
courses.tag,
courses.video
FROM 
topics
JOIN 
subtopics ON topics.Id = subtopics.topicId
JOIN 
courses ON subtopics.Id = courses.subTopicId ORDER By courses.id DESC");
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