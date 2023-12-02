<?php
include("includes/header.php");

$courseId = $_SESSION['course_id'];
// $chid = $_SESSION['chapter_id'];
$userRole = $_SESSION['role'];
$user_id = $_SESSION['role_id'];
$userId = $_SESSION['mail'];
$password = $_SESSION['pass'];

$fetch_course_list = mysqli_query($con, "SELECT * FROM courses WHERE id = '$courseId'");
$course_list_data = mysqli_fetch_array($fetch_course_list);
$fetch_course_login = mysqli_query($con, "SELECT * FROM courselogin WHERE courseid = $courseId AND username = '$userId' AND pwd = '$password' AND status =1");
$courseLogin = mysqli_fetch_array($fetch_course_login);
$coursecontentId = $courseLogin['course_contentid'];

// print_r($coursecontentId);
$fetch_order_wise_data = mysqli_query($con, "SELECT * FROM `chaptersassessmentorders` WHERE courseId =$courseId AND id >= $coursecontentId  LIMIT 2");
while ($data = mysqli_fetch_array($fetch_order_wise_data)) {
    $rows[] = $data;
}

$type = $rows[0]['type'];
$typeId = $rows[0]['typeId'];
$serialNumber = $rows[0]['serialNumber'];
$nextId = $rows[1]['id'];
// ob_start();
$fetch_assessment_data = mysqli_query($con,"SELECT * FROM assessment where id = $typeId");
$fetch_assessment_number = mysqli_query($con, "SELECT count(*) AS count FROM assessment WHERE courseId = $courseId");
$assessment_count = mysqli_fetch_array($fetch_assessment_number);
// print_r($assessment_count);
$assessment_data = mysqli_fetch_array($fetch_assessment_data);
if ($type === 'assessments') {
    $fetch_assessments_data = mysqli_query($con, "SELECT assessment.*, questions.* FROM assessment INNER JOIN questions ON assessment.id = questions.assessmentId WHERE questions.assessmentId = $typeId AND assessment.courseId = $courseId");

    if (!$fetch_assessments_data) {
        die("Error in SQL query: " . mysqli_error($con));
    }

    // $assessmentData = mysqli_fetch_array($fetch_assessments_data);

} elseif ($type === 'chapters') {
    // print_r($rows);
    echo '<script type="text/javascript">window.location.href="' . $mainlink . 'chapterSingle";</script>';
}

// End output buffering and flush the output
// ob_end_flush();
?>
<style>
    .question-container {
        margin-bottom: 20px;
    }

    .question {
        font-size: 20px;
        margin-bottom: 10px;
    }

    .custom-control-label {
        cursor: pointer;
    }

    .option {
        margin-bottom: 10px;
    }
</style>

<!-- <div class="search-wrap">
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
</div> -->
<!--search overlay end-->

<!-- <section class="page-header">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="page-header-content">
                    <h1>Assessment</h1>
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="list-inline-item">/</li>
                        <li class="list-inline-item">
                            Assessment
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section> -->

<section class="page-wrapper edutim-course-single">
    <div class="row p-4">
        <div class="container col-lg-8">
            <div class="course-single-header">
                <span class="single-course-title">Course Name:
                    <?= $course_list_data['courseName'] ?> 
                </span>
                <span class="single-course-title"
                        id="courseName"></span><br /><br />
                <span class="course-title">Assessment Name:
                    <?= $assessment_data['assessmentName'] ?>
                </span>
            </div>
            <form id="assessmentForm">
                <?php
                if ($fetch_assessments_data) {
                    $questionNumber = 1;
                    $questionsAndAnswers = []; // Initialize an array to store questions and correct answers
                
                    while ($row = mysqli_fetch_assoc($fetch_assessments_data)) {
                        $assessmentId = $row['assessmentId'];
                        $questionsAndAnswers[$questionNumber] = [
                            'question' => $row['questionsName'],
                            'options' => [
                                'A' => $row['a'],
                                'B' => $row['b'],
                                'C' => $row['c'],
                                'D' => $row['d'],
                            ],
                            'correctAnswer' => $row['correctAnswer'],
                        ];
                        ?>

                        <div class="question-container">
                            <p class="question">Q)
                                <?= $questionsAndAnswers[$questionNumber]['question']; ?>
                            </p>
                            <div class="option">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="optionA<?= $questionNumber ?>" name="option<?= $questionNumber ?>"
                                        class="custom-control-input" value="a">
                                    <label class="custom-control-label" for="optionA<?= $questionNumber ?>">
                                        <?= $questionsAndAnswers[$questionNumber]['options']['A']; ?>
                                    </label>
                                </div>
                            </div>
                            <div class="option">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="optionB<?= $questionNumber ?>" name="option<?= $questionNumber ?>"
                                        class="custom-control-input" value="b">
                                    <label class="custom-control-label" for="optionB<?= $questionNumber ?>">
                                        <?= $questionsAndAnswers[$questionNumber]['options']['B']; ?>
                                    </label>
                                </div>
                            </div>
                            <div class="option">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="optionC<?= $questionNumber ?>" name="option<?= $questionNumber ?>"
                                        class="custom-control-input" value="c">
                                    <label class="custom-control-label" for="optionC<?= $questionNumber ?>">
                                        <?= $questionsAndAnswers[$questionNumber]['options']['C']; ?>
                                    </label>
                                </div>
                            </div>
                            <div class="option">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="optionD<?= $questionNumber ?>" name="option<?= $questionNumber ?>"
                                        class="custom-control-input" value="d">
                                    <label class="custom-control-label" for="optionD<?= $questionNumber ?>">
                                        <?= $questionsAndAnswers[$questionNumber]['options']['D']; ?>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <?php
                        $questionNumber++;
                    }
                }
                ?>
                <button type="submit" class="btn btn-warning" data-assessmentid="<?= $assessmentId ?>"
                    data-courseid="<?= $courseId ?>" data-userrole="<?= $userRole ?>" data-userid="<?= $user_id ?>"
                    data-next-id="<?= $nextId ?>" id="assessmentSubmit">Submit</button>
                <button class="btn btn-danger">Cancel</button>
            </form>
            <div id="correctAnswersContainer" style="display: none;">
                <h3>Correct Answers:</h3>
                <ul id="correctAnswersList"></ul>
                <button class="btn btn-saburi rounded-0" id="nextButton" data-coursecontentid="<?= $coursecontentId ?>"
                    data-courseid="<?= $courseId ?>" data-username="<?= $userId ?>" data-password="<?= $password ?>"
                    data-next-id="<?= $nextId ?>">Next</button>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="course-sidebar">

                <div class="course-widget course-details-info">
                    <h4 class="course-title">This Course Includes</h4>
                    <ul>
                        <li>
                            <div class="d-flex justify-content-between align-items-center">
                                <span><i class="bi bi-calendar"></i>Last Update :</span>
                                <a href="#" class="d-inline-block date"><?= isset($course_list_data['modifiedOn']) ? $course_list_data['modifiedOn'] : $course_list_data['createdOn'] ?></a>

                            </div>
                        </li>
                        <li>
                            <div class="d-flex justify-content-between align-items-center">
                                <span><i class="bi bi-flag"></i>Duration :</span>
                                30 days
                            </div>
                        </li>
                        <li>
                            <div class="d-flex justify-content-between align-items-center">
                                <span><i class="bi bi-paper"></i>Assessment :</span>
                                <span>
                                    <span id="currentNoOfChapter"></span>/
                                    <span id="noOfChapters"><?= $assessment_count['count']?></span>
                                </span>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex justify-content-between align-items-center">
                                <span><i class="bi bi-bookmark"></i>Tag :</span>
                                <a href="#" class="d-inline-block tag"></a>
                            </div>
                        </li>

                        <li>
                            <div class="d-flex justify-content-between align-items-center">
                                <span><i class="bi bi-madel"></i>Certificate :</span>
                                yes
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function () {
        // Declare questionsAndAnswers in a global scope
        var questionsAndAnswers = <?php echo json_encode($questionsAndAnswers); ?>;

        $('#assessmentSubmit').on('click', function (event) {
            event.preventDefault();
            var userRole = $(this).data('userrole');
            var userid = $(this).data('userid');
            var courseid = $(this).data('courseid');
            var assessmentid = $(this).data('assessmentid');
            // Collect selected answers
            var selectedAnswers = {};

            $('input[type="radio"]:checked').each(function () {
                var questionNumber = $(this).attr('name').replace('option', '');
                var answer = $(this).val();
                console.log(answer);

                selectedAnswers[questionNumber] = answer;
            });

            var score = 0;
            var totalQuestions = Object.keys(questionsAndAnswers).length;

            if (Object.keys(selectedAnswers).length < totalQuestions) {
                Swal.fire({
                        icon: 'error',
                        title: 'Please answer all questions before submitting.',
                        showConfirmButton: false,
                        timer: 5000
                    });
                return; 
            }

            $.each(selectedAnswers, function (questionNumber, selectedAnswer) {
                var correctAnswer = questionsAndAnswers[questionNumber].correctAnswer;

                if (correctAnswer === selectedAnswer) {
                    score++;
                }
            });


            console.log('Score: ' + score + ' out of ' + totalQuestions);
            $.ajax({
                url: "./core/assessmentResult.php",
                type: 'POST',
                data: {
                    userRole: userRole,
                    userid: userid,
                    courseid: courseid,
                    assessmentid: assessmentid,
                    totalScore: totalQuestions,
                    acquiredScore: score
                },
                success: function (data) {
                    Swal.fire({
                        icon: 'success',
                        title: data,
                        showConfirmButton: false,
                        timer: 5000
                    });
                }

            });

            displayCorrectAnswers();
        });

        function displayCorrectAnswers() {
            var correctAnswersList = $('#correctAnswersList');

            // Clear previous correct answers
            correctAnswersList.empty();

            $.each(questionsAndAnswers, function (questionNumber, questionData) {
                var correctAnswer = questionData.correctAnswer;

                // Create list item and append to the correct answers list
                var listItem = $('<li>').text('Q' + questionNumber + ': ' + correctAnswer);
                correctAnswersList.append(listItem);
            });

            // Show the correct answers container
            $('#correctAnswersContainer').show();
        }

        $('#nextButton').on('click', function (event) {
            event.preventDefault();
            var nextId = $(this).data('next-id');
            var userName = $(this).data('username');
            var pwd = $(this).data('password');
            var courseId = $(this).data('courseid');
            var courseContentId = $(this).data('coursecontentid');
            // console.log(nextId,userName,pwd,courseId,courseContentId);
            $.ajax({
                url: './core/nextChapter.php',
                type: 'GET',
                data: {
                    nextId: nextId,
                    userName: userName,
                    pwd: pwd,
                    courseId: courseId,
                    courseContentId: courseContentId
                },
                success: function (data) {
                    window.location.reload();
                }
            });
        })
    });
</script>

<?php
include("includes/footer.php");
?>