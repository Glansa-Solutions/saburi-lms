<?php
include("db_config.php");
if (isset($_SESSION['role_id']) && !empty($_SESSION['role_id'])) {
    $role = $_SESSION['role_id'];
}else{
    $role = "";
}


// regarding Blog - Comment Data ( site & admin) start**
$query_fetch_blog_comment = mysqli_query($con,"SELECT * FROM comments_blog where isactive=1");
$query_fetch_blog_comment_admin_grid = mysqli_query($con,"SELECT * FROM comments_blog");
// regarding Blog - Comment Data ( site & admin) end**

$fetch_testimonials_query = mysqli_query($con,"SELECT students.name,company.companyName,testinomonials.*
FROM testinomonials
LEFT JOIN students ON testinomonials.subscribedId = students.id AND testinomonials.subscribedBy = 'student'
LEFT JOIN company ON testinomonials.subscribedId = company.id AND testinomonials.subscribedBy = 'company'");
$fetch_list_students_query = mysqli_query($con, "SELECT * FROM students");
$categoryQuery = mysqli_query($con, "SELECT * FROM careercategory");
$careerQuery = mysqli_query($con, "SELECT * FROM careers ");
$fetch_list_query = mysqli_query($con, "SELECT * FROM users where IsActive = 1");
$fetch_user_contact_query = mysqli_query($con, "SELECT * FROM contact");
$fetch_user_contact_details_query = mysqli_query($con, "SELECT * FROM contact_details");
$fetch_user_newsletter_query = mysqli_query($con, "SELECT * FROM newsletter");
$fetch_list_order_query = mysqli_query($con, "SELECT od.id,
o.paymentstatus,
o.orderdate,
c.courseDesc,
c.courseName,
s.name
FROM orderdetails AS od
JOIN `orders` AS o ON od.orderId = o.id
JOIN courses AS c ON od.courseId = c.id
JOIN students AS s ON o.subscriberid = s.id where s.id = '$role' and o.paymentstatus = 'paid'");
$fetch_list_student_query = mysqli_query($con, "SELECT * FROM students where isActive = 1");
$fetch_list_topic_query = mysqli_query($con, "SELECT * FROM topics where isActive=1");
$fetch_list_subtopic_query = mysqli_query($con, "SELECT * FROM subtopics where isActive=1");
$fetch_list_join_topics_subtopic_query = mysqli_query($con, "SELECT topics.topicName,subtopics.id,subtopics.subTopicName FROM subtopics INNER JOIN topics ON topics.Id = subtopics.topicId WHERE subtopics.isActive = 1");
$fetch_list_join_topics_subtopic_course_query = mysqli_query($con, "SELECT 
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
// fetch chepter data
$fetch_list_join_topics_subtopics_course_chapters_query = mysqli_query($con, "SELECT 
topics.Id AS topic_id,
topics.topicName,
subtopics.Id AS subtopic_id,
subtopics.subtopicName,
courses.id AS course_id,
courses.courseName,
chapters.id AS chapter_id,
chapters.chapterName,
chapters.uploadFile,
chapters.video,
chapters.chapterContent
FROM
topics
JOIN
subtopics ON topics.Id = subtopics.topicId
JOIN
courses ON subtopics.Id = courses.subTopicId
JOIN
chapters ON courses.id = chapters.courseId
WHERE
chapters.isActive = 1
ORDER BY
chapters.id DESC");

$fetch_list_join_topics_subtopics_course_chapters_assessments_query = mysqli_query($con, "SELECT 
topics.Id AS topic_id,
topics.topicName,
subtopics.Id AS subtopic_id,
subtopics.subtopicName,
courses.id AS course_id,
courses.courseName,
chapters.id AS chapter_id,
chapters.chapterName,
assessment.id AS assessment_id,
assessment.questions,
assessment.a,
assessment.b,
assessment.c,
assessment.d,
assessment.isActive,
CASE assessment.correctAnswer
    WHEN 'a' THEN assessment.a
    WHEN 'b' THEN assessment.b
    WHEN 'c' THEN assessment.c
    WHEN 'd' THEN assessment.d
    ELSE NULL
END AS correctAnswer
FROM
topics
JOIN
subtopics ON topics.Id = subtopics.topicId
JOIN
courses ON subtopics.Id = courses.subTopicId
JOIN
chapters ON courses.id = chapters.courseId
JOIN 
assessment ON chapters.id = assessment.chapterId
WHERE
assessment.isActive = 1
ORDER BY
chapters.id DESC");

$fetch_list_query_subscription = mysqli_query($con, "SELECT * FROM subscriptions_1");

// $fetch_list_join_topics_subtopic_query=mysqli_query($con,"SELECT * FROM subtopics INNER JOIN topics ON topics.Id = subtopics.topicId;");

$fetch_list_blog_query = mysqli_query($con, "SELECT * FROM blogs where isActive = 1");

$fetch_list_freeResources_query = mysqli_query($con, "SELECT * FROM freeresources where isActive = 1");

$fetch_list_affiliate_query = mysqli_query($con, "SELECT * FROM affiliates where isActive = 1");

$fetch_list_careers_query = mysqli_query($con, "SELECT * FROM careers where IsActive = 1");

$fetch_list_company_query = mysqli_query($con, "SELECT * FROM company Where isActive = 1");

$fetch_list_corporategovernance_query = mysqli_query($con, "SELECT * FROM corporategovernance where isActive = 1");

$fetch_testimonial_sql = mysqli_query($con, "SELECT students.name,company.companyName,students.profile_img,company.profile,testinomonials.*
FROM testinomonials
LEFT JOIN students ON testinomonials.subscribedId = students.id AND testinomonials.subscribedBy = 'student'
LEFT JOIN company ON testinomonials.subscribedId = company.id AND testinomonials.subscribedBy = 'company'");


// $fetch_list=mysqli_fetch_assoc($fetch_list_query);
// $users_name=$fetch_list['Name'];
// echo $users_name;
