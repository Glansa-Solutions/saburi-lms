<?php
include("includes/header.php");
    $courseId = $_SESSION['course_id'];
    $userId = $_SESSION['mail'];
    $password = $_SESSION['pass'];

    $fetch_course_login = mysqli_query($con, "SELECT * FROM courselogin WHERE courseid = $courseId AND username = '$userId' AND pwd = '$password' AND status =1");
    $courseLogin = mysqli_fetch_array($fetch_course_login);
    $coursecontentId = $courseLogin['course_contentid'];
    $fetch_order_wise_data = mysqli_query($con,"SELECT * FROM `chaptersassessmentorders` WHERE courseId =$courseId AND id >= $coursecontentId  LIMIT 2");
    while($data = mysqli_fetch_array($fetch_order_wise_data)){
        $rows[] = $data;
    }

    $type = $rows[0]['type'];
    $typeId = $rows[0]['typeId'];
    $serialNumber = $rows[0]['serialNumber'];
    $nextId = isset($rows[1]['id']) ? $rows[1]['id'] : '';
if ($type === 'chapters') {
    $fetch_chapter_data = mysqli_query($con, "SELECT chapters.*, courses.courseName FROM chapters INNER JOIN courses ON chapters.courseId = courses.id WHERE chapters.courseId = $courseId AND chapters.id = $typeId");

    if (!$fetch_chapter_data) {
        die("Error in SQL query: " . mysqli_error($con));
    }

    $chapterData = mysqli_fetch_array($fetch_chapter_data);

} elseif($type === 'assessments') {
    echo '<script type="text/javascript">window.location.href="'.$mainlink.'assessment";</script>';
}

// print_r($type);
  
?>

<!-- The rest of your HTML code for displaying the course details -->

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




<section class="page-wrapper edutim-course-single">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="course-single-header">
                    
                    <span class="single-course-title">Course Name: <?= $chapterData['courseName']; ?></span> <span class="single-course-title"
                        id="courseName"></span><br /><br />
                    <span class="course-title">Chapter Name: <?= $chapterData['chapterName'] ?></span> <span style="font-size:20px;"
                        class="chapterName"></span>
                </div>

                <div class="single-course-details ">
                    <h4 class="course-title">Description</h4>
                    <p id="chapterDesc"><?= $chapterData['chapterContent']?></p>
                    <h5>Chapter Content</h5>
                    <div><a href="" target="_blank" id="chpterContent"><?= $chapterData['uploadFile'] ?></a></div>
                    <h5>Video</h5>
                    <video id="myVideo" width="320" height="240" controls controlsList="nodownload">
                        <source src="<?= $chapterData['video'] ?>" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
                <div class="proceed text-right">
                <?php
                    if($nextId){
                        
                    ?>
                    <button class="btn btn-saburi rounded-0" id="nextButton" data-coursecontentid="<?= $coursecontentId ?>" data-courseid="<?= $courseId ?>" data-username="<?= $userId ?>" data-password="<?= $password?>" data-next-id="<?= $nextId ?>">Next</button>
                    <?php
                    }else{?>
                    <button class="btn btn-saburi rounded-0">Finish</button>
                    <?php
                    }?>
                </div>

            </div>

            <div class="col-lg-4">
                <div class="course-sidebar">

                    <div class="course-widget course-details-info">
                        <h4 class="course-title">This Course Includes</h4>
                        <ul>
                            <li>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span><i class="bi bi-graph-bar"></i>Skill level : </span>
                                    Beginner
                                </div>
                            </li>
                            <li>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span><i class="bi bi-calendar"></i>Last Update :</span>
                                    <a href="#" class="d-inline-block date"></a>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span><i class="bi bi-user-ID"></i>Ratings :</span>
                                    <span>4.5</span>
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
                                    <span><i class="bi bi-paper"></i>Chapters :</span>
                                    <span>
                                        <span id="currentNoOfChapter"></span>/
                                        <span id="noOfChapters"></span>
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
    </div>
</section>

<script>
$(document).ready(function() {
    var type = <?php echo json_encode($type); ?>;
    console.log(type);


$('#nextButton').on('click', function(event){
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
            success : function(data){
                window.location.reload();
            }
        });
})
    
});
</script>






<?php
include("includes/footer.php");
?>