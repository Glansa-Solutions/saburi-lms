<?php
$host="localhost";
$db="saburi_lms_2023";
$password="";
$username="root";

$con = mysqli_connect($host,$username,$password,$db);

// include "database_functions.php";
// $courseList = fetchCoursesList();
// fetching list of Users to users module

$fetch_list_query=mysqli_query($con,"SELECT * FROM users");
$fetch_user_contact_query=mysqli_query($con,"SELECT * FROM contact");
$fetch_user_contact_details_query=mysqli_query($con,"SELECT * FROM contact_details");

$fetch_user_newsletter_query=mysqli_query($con,"SELECT * FROM newsletter");
$fetch_list_student_query=mysqli_query($con,"SELECT * FROM students");

$fetch_list_topic_query=mysqli_query($con,"SELECT * FROM topics");
$fetch_list_subtopic_query=mysqli_query($con,"SELECT * FROM subtopics");
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

$fetch_list_query_subscription=mysqli_query($con,"SELECT * FROM subscriptions_1");

$fetch_list_join_topics_subtopic_query=mysqli_query($con,"SELECT * FROM subtopics INNER JOIN topics ON topics.Id = subtopics.topicId;");

$fetch_list_blog_query=mysqli_query($con,"SELECT * FROM blogs");

$fetch_list_freeResources_query=mysqli_query($con,"SELECT * FROM freeresources");

$fetch_list_affiliate_query=mysqli_query($con,"SELECT * FROM affiliates");

$fetch_list_careers_query=mysqli_query($con,"SELECT * FROM careers");

$fetch_list_company_query=mysqli_query($con,"SELECT * FROM company");

$fetch_list_corporategovernance_query=mysqli_query($con,"SELECT * FROM corporategovernance");
// $fetch_list=mysqli_fetch_assoc($fetch_list_query);
// $users_name=$fetch_list['Name'];
// echo $users_name;
