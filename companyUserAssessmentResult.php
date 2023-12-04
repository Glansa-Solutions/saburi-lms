<?php
include("includes/header.php");
$courseId = $_SESSION['course_id'];
$userRole = $_SESSION['role'];
$user_id = $_SESSION['role_id'];
$fetch_assessment_result = mysqli_query($con, "SELECT courses.courseName, assessment.assessmentName, assessmentresult.* FROM courses INNER JOIN assessment ON courses.id = assessment.courseId INNER JOIN assessmentresult ON assessment.id = assessmentresult.assessmentId WHERE assessmentresult.userRole = '$userRole' AND assessmentresult.userId = $user_id AND assessmentresult.courseId = $courseId");


?>


<div class="page-wrapper">
    <div class="container">
        <div class="row">
            <div>
                <div class="thank-you-message">Assessment Result for user-? shown on below table </div>
                <div class="table-container">
                    <table class="score-table">
                        <thead>
                            <tr>
                                <th>Sr No.</th>
                                <th>Course Name</th>
                                <th>Assessment Name</th>
                                <th>Acquired Score</th>
                                <th>Total Score</th>
                                <th>Percentage</th>
                                <th>Assessment Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $totalAcquiredScore = 0;
                            $totalTotalScore = 0;
                            $totalPercentage = 0;
                            if ($fetch_assessment_result) {
                                $i = 1;
                                while ($assessment_result_data = mysqli_fetch_assoc($fetch_assessment_result)) {
                                    $courseName = $assessment_result_data["courseName"];
                                    $acquiredScore = $assessment_result_data['acquiredScore'];
                                    $asssessmentName = $assessment_result_data['assessmentName'];
                                    $totalScore = $assessment_result_data['totalScore'];
                                    $percentage = ($acquiredScore / $totalScore) * 100;
                                    $assessmentDate = $assessment_result_data['createdOn'];
                                    $totalAcquiredScore += $acquiredScore;
                                    $totalTotalScore += $totalScore;
                                    $totalPercentage = ($totalAcquiredScore / $totalTotalScore) * 100;
                                    ?>
                                    <tr>
                                        <td>
                                            <?= $i++ ?>
                                        </td>
                                        <td>
                                            <?= $courseName ?>
                                        </td>
                                        <td>
                                            <?= $asssessmentName ?>
                                        </td>
                                        <td>
                                            <?= $acquiredScore ?>
                                        </td>
                                        <td>
                                            <?= $totalScore ?>
                                        </td>
                                        <td>
                                            <?= $percentage ?>%
                                        </td>
                                        <td>
                                            <?= $assessmentDate ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } ?>
                        </tbody>
                    </table>

                </div>
                <div class="overall-score-section">
                    <h3>Overall Score</h3>
                    <p>Total Acquired Score:
                        <?= $totalAcquiredScore ?>
                    </p>
                    <p>Total Total Score:
                        <?= $totalTotalScore ?>
                    </p>
                    <p>Average Percentage:
                        <?= ($totalPercentage) ?>%
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>




<style>
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
</style>



<?php
include("includes/footer.php");
?>