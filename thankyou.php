<?php
include("includes/header.php");
$courseId = $_SESSION['course_id'];
$userRole = $_SESSION['role'];
$user_id = $_SESSION['role_id'];
$orderId = $_GET['oid'];
$fetch_assessment_result = mysqli_query($con, "SELECT courses.courseName, assessment.assessmentName, assessmentresult.* FROM courses INNER JOIN assessment ON courses.id = assessment.courseId INNER JOIN assessmentresult ON assessment.id = assessmentresult.assessmentId WHERE assessmentresult.userRole = '$userRole' AND assessmentresult.userId = $user_id AND assessmentresult.courseId = $courseId AND assessmentresult.orderId = $orderId");

// print_r($orderId);

?>


<div class="page-wrapper">
    <div class="container">
        <div class="row">
            <div>
                <div class="thank-you-message">Thank you for completing this course! </div>
                <div class="thank-you-message">Your total assessment score shown on below table</div>
                <table class="score-table">
                    <thead>
                        <tr>
                            <th>Assessment Name</th>
                            <th>Acquired Score</th>
                            <th>Total Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if($fetch_assessment_result) {
                                while($assessment_result_data = mysqli_fetch_assoc($fetch_assessment_result)) {
                        ?>
                        <tr>
                            <td><?= $assessment_result_data['assessmentName'] ?></td>
                            <td><?= $assessment_result_data['acquiredScore'] ?></td>
                            <td><?= $assessment_result_data['totalScore'] ?></td>
                        </tr>
                        <?php
                                }
                            }?>
                    </tbody>
                </table>

                <a href="<?= $mainlink ?>" class="button">Go Back to Home</a>
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
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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

<script>
    history.replaceState(null, null, document.URL);

// Disable the back button functionality
window.addEventListener('popstate', function (event) {
    history.replaceState(null, null, document.URL);
    event.preventDefault();
});
</script>

<?php
include("includes/footer.php");
?>