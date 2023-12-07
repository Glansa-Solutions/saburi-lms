<?php
include("includes/header.php");
$courseId = $_GET['co_id'];
$userRole = $_SESSION['role'];
$user_id = $_SESSION['role_id'];
$fetch_single_course_report = mysqli_query($con, "SELECT
companyusers.email,
COUNT(assessmentresult.id) as counter,
GROUP_CONCAT(CONCAT(assessmentresult.acquiredScore, '/', assessmentresult.totalScore) ORDER BY assessmentresult.id) AS scores
FROM
companyusers
INNER JOIN
assessmentresult ON companyusers.id = assessmentresult.userId
WHERE
assessmentresult.CourseId = $courseId
AND companyusers.companyId = $user_id
AND assessmentresult.userRole = 'companyusers'
GROUP BY
companyusers.id, companyusers.email
ORDER BY
assessmentresult.id");

$fetch_chapter_assessment_order = mysqli_query($con, "SELECT COUNT(*) as count FROM chaptersassessmentorders  WHERE courseId = $courseId AND type = 'assessments'");
$chapter_assessment_data = mysqli_fetch_array($fetch_chapter_assessment_order);
$assessmentCount = $chapter_assessment_data['count'];

$courseData = mysqli_query($con, "SELECT courseName FROM courses WHERE id = $courseId");
$course = mysqli_fetch_assoc($courseData);
$courseName = $course['courseName'];

?>

<!--search overlay start-->
<div class="search-wrap">
    <div class="overlay">
        <form action="" class="search-form">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-9">
                        <h3>Search Your keyword</h3>
                        <input type="text" class="form-control" placeholder="Search...">
                    </div>
                    <div class="col-md-2 col-3 text-right">
                        <div class="search_toggle toggle-wrap d-inline-block">
                            <img class="search-close" src="assets/images/close.png"
                                srcset="assets/images/close%402x.png 2x" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!--search overlay end-->


<section class="page-header">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="page-header-content">
                    <h1>Individual Course Report</h1>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="page-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="table-container px-3">
                    <table class="score-table">
                        <thead>
                            <tr>
                                <th>Sr No.</th>
                                <th>User Name</th>
                                <th>Assessment Status</th>
                                <th>Course Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($fetch_single_course_report) {
                                $i = 1;
                                while ($singleCourseData = mysqli_fetch_assoc($fetch_single_course_report)) {
                                    $userName = $singleCourseData["email"];
                                    $count = $singleCourseData["counter"];
                                    $assessmentStatus = $singleCourseData["scores"];
                                    $courseCompletionStatus = ($assessmentCount == $count) ? "Complete" : "Incomplete";
                                    ?>
                                    <tr>
                                        <td>
                                            <?= $i++ ?>
                                        </td>
                                        <td>
                                            <?= $userName ?>
                                        </td>
                                        <td>
                                            <?= $assessmentStatus ?>
                                        </td>
                                        <td>
                                            <?= $courseCompletionStatus ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>




<!-- <style>
    .page-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }

    .container {
        text-align: center;
    }

    .thank-you-message {
        font-size: 24px;
        color: #333;
        margin-bottom: 20px;
    }

    .score-table {
        width: 100%;
        max-width: 400px;
        margin: 20px auto;
        border-collapse: collapse;
        background-color: #fff;
        box-shadow: 0 10px 10px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
    }

    .score-table th,
    .score-table td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .score-table th {
        background-color: #e9770e;
        color: #fff;
    }

    .row {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .table-container {
        max-height: 400px;
        overflow-y: auto;
    }

    .button {
        display: inline-block;
        padding: 10px 20px;
        background-color: #e9770e;
        color: #fff;
        text-decoration: none;
        font-size: 18px;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .button:hover {
        background-color: #e9770e;
    }
</style> -->



<?php
include("includes/footer.php");
?>