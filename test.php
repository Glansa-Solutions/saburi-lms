SELECT
    cao.*,
    ch.chapterName,  -- replace with actual column names
    ch.chapterContent,  -- replace with actual column names
    ch.uploadFile,
    ch.video,
    -- Add more columns as needed from the 'chapters' table
    a.questions,  -- replace with actual column names
    a.a,  -- replace with actual column names
    a.b,
    a.c,
    a.d,
    a.correctAnswer
    -- Add more columns as needed from the 'assessment' table
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
    cao.courseId = a.courseId AND
    cao.subTopicId = a.subtopicId AND
    cao.topicId = a.topicId AND
    cao.typeId = 2;