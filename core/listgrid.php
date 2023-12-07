<?php
include("db_config.php");
if (isset($_SESSION['role_id']) && !empty($_SESSION['role_id'])) {
    $roleId = $_SESSION['role_id'];
    $role = $_SESSION['role'];
    // print_r($role);
    $query_fetch_wishlist = mysqli_query($con, "SELECT
w.id,
w.userId,
w.role,
w.courseId,
w.courseName,
w.price,
w.image,
CASE
    WHEN w.role = 'company' THEN c.companyName  
    WHEN w.role = 'students' THEN s.name  
    ELSE NULL  
END AS name
FROM
wishlist w
LEFT JOIN
company c ON w.userId = c.id AND w.role = 'company'
LEFT JOIN
students s ON w.userId = s.id AND w.role = 'students' WHERE w.userId = $roleId");


} else {
    $roleId = "";
}

$fetch_home_query = mysqli_query($con, "SELECT * FROM home where isActive =1");
$fetch_about_query = mysqli_query($con, "SELECT * FROM about where isActive =1");
$fetch_privacy_query = mysqli_query($con, "SELECT * FROM privacy where isActive =1");
$fetch_terms_query = mysqli_query($con, "SELECT * FROM terms where isActive =1");
// regarding Blog - Comment Data ( site & admin) start**
$query_fetch_blog_comment = mysqli_query($con, "SELECT * FROM comments_blog where isactive=1");
$query_fetch_blog_comment_admin_grid = mysqli_query($con, "SELECT * FROM comments_blog");

$query_fetch_company_users = mysqli_query($con, "SELECT companyusers.id, company.companyName, companyusers.email, companyusers.password, courses.courseName,companyusers.ValidTill, companyusers.IsActive FROM company INNER JOIN companyusers on company.id = companyusers.companyId INNER JOIN courses ON courses.id = companyusers.CourseId");


// regarding Blog - Comment Data ( site & admin) end**
// regarding Blog - Comment Data ( site & admin) end****
// regarding course - review Data ( site & admin) start****
$query_fetch_course_review = mysqli_query($con, "SELECT * FROM comment_course_review where isactive=1");
$query_fetch_course_review_admin_grid = mysqli_query($con, "SELECT * FROM comment_course_review");
// regarding course - review Data ( site & admin) end****

$fetch_testimonials_query = mysqli_query($con, "SELECT students.name,company.companyName,testinomonials.*
FROM testinomonials
LEFT JOIN students ON testinomonials.subscribedId = students.id AND testinomonials.subscribedBy = 'students'
LEFT JOIN company ON testinomonials.subscribedId = company.id AND testinomonials.subscribedBy = 'company'");
$fetch_list_students_query = mysqli_query($con, "SELECT * FROM students where isActive=1");
$categoryQuery = mysqli_query($con, "SELECT * FROM careercategory");
$careerQuery = mysqli_query($con, "SELECT * FROM careers where isActive=1");
$fetch_list_query = mysqli_query($con, "SELECT * FROM users where IsActive = 1");
$fetch_user_contact_query = mysqli_query($con, "SELECT * FROM contact where status=1");
$fetch_user_contact_details_query = mysqli_query($con, "SELECT * FROM contact_details where isActive=1");
$fetch_user_newsletter_query = mysqli_query($con, "SELECT * FROM newsletter");

if (isset($_SESSION['role_id']) && !empty($_SESSION['role_id']) && isset($_SESSION['role']) && !empty($_SESSION['role'])) {
    $role = $_SESSION['role'];
    $roleId = $_SESSION['role_id'];

    if ($role === 'students' && $roleId) {
        // print_r($role);
        $fetch_list_order_query = mysqli_query($con, "SELECT od.id,
        o.paymentstatus,
        o.orderdate,
        c.courseDesc,
        c.courseName,
        s.name
        FROM orderdetails AS od
        JOIN `orders` AS o ON od.orderId = o.id
        JOIN courses AS c ON od.courseId = c.id
        JOIN students AS s ON o.subscriberid = s.id where s.id = '$roleId' and o.paymentstatus = 'paid' and o.subscribedBy = '$role'");
    }elseif($role === "company" && $roleId) {
        // print_r($role);
        $fetch_list_order_query = mysqli_query($con, "SELECT od.id,
        o.paymentstatus,
        o.orderdate,
        c.courseDesc,
        c.courseName,
        co.companyName
        FROM orderdetails AS od
        JOIN `orders` AS o ON od.orderId = o.id
        JOIN courses AS c ON od.courseId = c.id
        JOIN company AS co ON o.subscriberid = co.id where co.id = '$roleId' and o.paymentstatus = 'paid' and o.subscribedBy = '$role'");
    }elseif($role === "companyusers" && $roleId) {
        // print_r($role);
        // print_r($roleId);
        $fetch_list_order_query = mysqli_query($con, "SELECT od.id,
        o.paymentstatus,
        o.orderdate,
        c.courseDesc,
        c.courseName,
        cu.email
        FROM orderdetails AS od
        JOIN `orders` AS o ON od.orderId = o.id
        JOIN courses AS c ON od.courseId = c.id
        JOIN companyusers AS cu ON o.subscriberid = cu.companyId where cu.id = '$roleId' and o.paymentstatus = 'paid' and o.subscribedBy = 'company' and od.courseId =  cu.courseId");
    }
}

// Pradip Chapters Assessment Order Query

$fetch_list_join_topics_subtopics_course_type_typeName_assessments_query = mysqli_query($con, "SELECT 
topics.topicName, 
subtopics.subTopicName, 
courses.courseName,
chaptersassessmentorders.courseId
FROM 
topics 
INNER JOIN 
subtopics ON topics.id = subtopics.topicId 
INNER JOIN 
courses ON subtopics.id = courses.subTopicId 
INNER JOIN 
chaptersassessmentorders ON courses.id = chaptersassessmentorders.courseId
WHERE 
chaptersassessmentorders.isActive = 1
GROUP BY 
chaptersassessmentorders.courseId;
");


$fetch_list_order_details_query = mysqli_query($con, "SELECT od.id,od.createdOn,
o.paymentstatus,
o.orderdate,
c.courseDesc,
c.courseName,
s.name
FROM orderdetails AS od
JOIN `orders` AS o ON od.orderId = o.id
JOIN courses AS c ON od.courseId = c.id
JOIN students AS s ON o.subscriberid = s.id where s.id = '$roleId' and o.paymentstatus = 'paid' AND od.status=1");

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
courses.id AS course_id,
courses.courseName,
assessment.id AS assessment_id,
assessment.assessmentName,
questions.id AS question_id,
questions.questionsName,
questions.a,
questions.b,
questions.c,
questions.d,
questions.isActive,
CASE questions.correctAnswer
    WHEN 'a' THEN questions.a
    WHEN 'b' THEN questions.b
    WHEN 'c' THEN questions.c
    WHEN 'd' THEN questions.d
    ELSE NULL
END AS correctAnswer
FROM
courses JOIN assessment ON assessment.courseId = courses.id
JOIN questions ON assessment.id = questions.assessmentId
WHERE
questions.isActive = 1");

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
LEFT JOIN students ON testinomonials.subscribedId = students.id AND testinomonials.subscribedBy = 'students'
LEFT JOIN company ON testinomonials.subscribedId = company.id AND testinomonials.subscribedBy = 'company'");


// $fetch_list=mysqli_fetch_assoc($fetch_list_query);
// $users_name=$fetch_list['Name'];
// echo $users_name;
