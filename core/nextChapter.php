<?php
include("db_config.php");

if(isset($_GET['start_id']) && isset($_GET['chapterId'])){
    $courseId = $_GET['start_id'];
    $nextChapterId = $_GET['chapterId'];

    // Your existing query with an additional condition for the next chapter
    $fetchChapter = mysqli_query($con, "SELECT
    cao.*,
    ch.chapterName,  
    ch.chapterContent, 
    ch.uploadFile,
    ch.video,
    GROUP_CONCAT(a.questions) AS allQuestions,
    GROUP_CONCAT(a.a) AS allAOptions,
    GROUP_CONCAT(a.b) AS allBOptions,
    GROUP_CONCAT(a.c) AS allCOptions,
    GROUP_CONCAT(a.d) AS allDOptions,
    GROUP_CONCAT(a.correctAnswer) AS allCorrectAnswers
FROM
    chaptersassessmentorders cao
LEFT JOIN
    chapters ch ON
    cao.chapterId = ch.id AND
    cao.courseId = ch.courseId AND
    cao.subTopicId = ch.subTopicId AND
    cao.topicId = ch.topicId AND
    cao.typeId = 1
LEFT JOIN
    assessment a ON
    cao.chapterId = a.assessmentName AND
    -- cao.courseId = a.courseId AND
    -- cao.subTopicId = a.subtopicId AND
    -- cao.topicId = a.topicId AND
    cao.typeId = 2
GROUP BY
    cao.id, ch.chapterName, ch.chapterContent, ch.uploadFile, ch.video");

    $data = mysqli_fetch_assoc($fetchChapter);

    // if($data){
    //     $r = $data['chapterName'];
    //     echo json_encode($r);
    // }
    
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