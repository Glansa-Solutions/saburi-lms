<?php
$host = "localhost";
$db = "saburi_lms_2023";
$username = "root";
$password = "";

$con = mysqli_connect($host, $username, $password, $db);

if(isset($_GET['start_id']) && isset($_GET['chapterId'])){
    $courseId = $_GET['start_id'];
    $nextChapterId = $_GET['chapterId'];

    // Your existing query with an additional condition for the next chapter
    $fetchChapter = mysqli_query($con, "SELECT 
    topics.Id AS topic_id,
    topics.topicName,
    subtopics.Id AS subtopic_id,
    subtopics.subtopicName,
    courses.id AS course_id,
    courses.courseName,
    courses.tag,
    chapters.id AS chapter_id,
    chapters.chapterName,
    chapters.chapterContent,
    chapters.uploadFile,
    chapters.video,
    chapters.createdOn, 
    chapters.modifiedOn
    FROM
    topics
    JOIN
    subtopics ON topics.Id = subtopics.topicId
    JOIN
    courses ON subtopics.Id = courses.subTopicId
    JOIN
    chapters ON courses.id = chapters.courseId WHERE chapters.courseId = $courseId AND chapters.id = $nextChapterId AND chapters.isActive = 1 ORDER BY chapters.id ASC");

    $data = mysqli_fetch_assoc($fetchChapter);

    if ($data) {
        $fetchNextChapter = mysqli_query($con, "SELECT id FROM chapters WHERE courseId = $courseId AND id > $nextChapterId AND isActive = 1 ORDER BY id ASC LIMIT 1");
        $noOfChaptersFetch = mysqli_query($con, "SELECT COUNT(*) as count FROM chapters WHERE courseId = $courseId");
        $noOfChapters = mysqli_fetch_assoc($noOfChaptersFetch);
        $hasMoreChapters = mysqli_num_rows($fetchNextChapter) > 0;
    
        // Add the indicator to the data array
        $data['hasMoreChapters'] = $hasMoreChapters;
        $data['noOfChapters'] = $noOfChapters;
    
        // Output the data as JSON
        echo json_encode($data);
    } else {
        // No more chapters
        echo json_encode(array('hasMoreChapters' => false));
    }
    
}
?>
