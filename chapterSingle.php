<?php
include("./core/listgrid.php");
include("includes/header.php");
// include('../vendors/getid3/getid3/getid3.php'); 

    
// ?>
<?php
    if(isset($_GET['start_id']) && isset($_GET['chapterId'])){
        $courseId = $_GET['start_id'];
        $chid = $_GET['chapterId'];
    }

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

                    <span class="single-course-title">Course Name:</span> <span class="single-course-title" id="courseName"></span><br/><br/>
                    <span class="course-title">Chapter Name:</span> <span style="font-size:20px;" class="chapterName"></span>
                </div>

                <div class="single-course-details ">
                    <h4 class="course-title">Description</h4>
                    <p id="chapterDesc"></p>
                    <h5>Chapter Content</h5>
                        <div><a href="" target="_blank" id="chpterContent"></a></div>
                    <h5>Video</h5>
                        <video id="myVideo" width="320" height="240" controls controlsList="nodownload">
                            <source src="" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                </div>
                <button class="btn btn-primary" id="nextButton">Next</button>
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
    var currentChapterNumber = 1;
    function fetchChapterData(startId, chapterId,currentChapterNumber) {
        $.ajax({
            url: 'core/nextChapter.php', 
            type: 'GET',
            data: { start_id: startId, chapterId: chapterId },
            success: function(data) {
                if (data) {
                    console.log(data);
                    var newData = JSON.parse(data);
                    $(".chapterName").text(newData.chapterName);
                    var dateToDisplay = newData.modifiedOn !== "0000-00-00 00:00:00" ? newData.modifiedOn : newData.createdOn;
                    $(".date").text(dateToDisplay);
                    $(".tag").text(newData.tag);
                    $("#chpterContent").attr("href", "../functions/upload/file/" + newData.uploadFile).text(newData.uploadFile);
                    $("#myVideo source").attr("src", "../functions/upload/video/" + newData.video);
                    $("#myVideo")[0].load(); 
                    $('#chapterDesc').text(newData.chapterContent);
                    $("#noOfChapters").text(newData.noOfChapters.count);
                    $('#currentNoOfChapter').text(currentChapterNumber);
                    $('#courseName').text(newData.courseName);

                    // Check if there are more chapters, if not, change the button text
                    if (!newData.hasMoreChapters) {
                        $("#nextButton").text("Finish");

                        alert("Your course is finished!");
                        $("#nextButton").prop("disabled", true);
                    }
                } else {
                    console.error("Error fetching chapter data");
                }
            },
            error: function(xhr, status, error) {
                console.error("Error fetching chapter data: " + error);
            }
        });
    }

    var startId = <?php echo isset($_GET['start_id']) ? $_GET['start_id'] : 0; ?>;
    var chapterId = <?php echo isset($_GET['chapterId']) ? $_GET['chapterId'] : 0; ?>;
    fetchChapterData(startId, chapterId,currentChapterNumber);

    $("#nextButton").on("click", function() {
        chapterId++;
        currentChapterNumber++;

        history.pushState({}, "", "?start_id=" + startId + "&chapterId=" + chapterId);

        fetchChapterData(startId, chapterId,currentChapterNumber);
    });
});

</script>






<?php
include("includes/footer.php");
?>