<?php
include("includes/header.php");

// Variable to store the total duration
$totalDurationInSeconds = 0;
$fetch_chaepter_list = null;
if (isset($_GET['course_id'])) {
    $course_id = $_GET['course_id'];
    $fetch_data = mysqli_query($con, "SELECT * FROM courses WHERE id = $course_id");
    $fetch_chaepter_list = mysqli_query($con, "SELECT 
        topics.Id AS topic_id,
        topics.topicName,
        subtopics.Id AS subtopic_id,
        subtopics.subtopicName,
        courses.id AS course_id,
        courses.courseName,
        chapters.id AS chapter_id,
        chapters.chapterName,
        chapters.uploadFile,
        chapters.video
        FROM
        topics
        JOIN
        subtopics ON topics.Id = subtopics.topicId
        JOIN
        courses ON subtopics.Id = courses.subTopicId
        JOIN
        chapters ON courses.id = chapters.courseId
        WHERE
        chapters.courseId = $course_id AND
        chapters.isActive = 1");
    if ($fetch_data && mysqli_num_rows($fetch_data) > 0) {
        $n = mysqli_fetch_array($fetch_data);
        $courseName = $n['courseName'];
        $courseCost = $n['courseCost'];
        $bannerImage = $n['bannerImage'];
        $courseDesc = $n['courseDesc'];
        $createdOn = $n['createdOn'];
        // $CourseSummary = $n['summary'];
        $Coursewyl = $n['learn'];
        $tag = $n['tag'];
        $requirement = $n['requirements'];
        $createdOn = $n['createdOn'];
        // echo $courseName;
    } else {
        echo "Course not found.";
    }
} else {
    $o_id = $_GET['order_id'];
    $payment_data = mysqli_query($con, "SELECT od.id, o.paymentstatus, o.orderdate, c.*, od.orderId, od.courseId
    FROM orderdetails AS od
    JOIN `orders` AS o ON od.orderId = o.id
    JOIN courses AS c ON od.courseId = c.id
    WHERE od.id = $o_id;
    ");
    if ($payment_data && mysqli_num_rows($payment_data) > 0) {
        $n = mysqli_fetch_array($payment_data);
        $courseName = $n['courseName'];
        $paymentstatus = $n['paymentstatus'];
        $courseCost = $n['courseCost'];
        $bannerImage = $n['bannerImage'];
        $courseDesc = $n['courseDesc'];
        $createdOn = $n['createdOn'];
        $Coursewyl = $n['learn'];
        // $CourseSummary = $n['summary'];
        $tag = $n['tag'];
        $requirement = $n['requirements'];
        $createdOn = $n['createdOn'];
        $course_id = $n['courseId'];

        // Fetch chapters for the course using course_id
        $fetch_chaepter_list = mysqli_query($con, "SELECT 
        chapters.id AS chapter_id,
        chapters.chapterName
        FROM
        chapters
        WHERE
        chapters.courseId = $course_id AND
        chapters.isActive = 1");
        // You can now use $fetch_chaepter_list to display chapter information in your HTML
        // echo $courseName;
    } else {
        echo "Order not found.";
    }
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


<section class="page-header">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="page-header-content">
                    <h1>
                        <?= $courseName; ?>
                    </h1>
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="list-inline-item">/</li>
                        <li class="list-inline-item">
                            Courses
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<div id="cart-success-message" class="alert alert-success" style="display: none;">
    Course added to cart successfully!
</div>
<section class="page-wrapper edutim-course-single">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="course-single-header">
                    <div class="rating">
                        <a href="#"><i class="fa fa-star"></i></a>
                        <a href="#"><i class="fa fa-star"></i></a>
                        <a href="#"><i class="fa fa-star"></i></a>
                        <a href="#"><i class="fa fa-star"></i></a>
                        <a href="#"><i class="fa fa-star"></i></a>
                        <span>(5.00)</span>
                    </div>

                    <h3 class="single-course-title">
                        <?= $courseName; ?>
                    </h3>
                    <!-- <?=
                        $CourseSummary
                        ?> -->

                    <div class="single-course-meta ">
                        <ul>
                            <li>
                                <span><i class="fa fa-calendar"></i>Last Update :</span>
                                <a href="#" class="d-inline-block">
                                    <?= $createdOn; ?>
                                </a>
                            </li>

                            <li>
                                <span><i class="fa fa-bookmark"></i>Tag :</span>
                                <a href="#" class="d-inline-block">
                                    <?= $tag ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="single-course-details ">
                    <h4 class="course-title">Description</h4>
                    <?=
                        $courseDesc;
                    ?>


                    <div class="course-widget course-info">
                        <h4 class="course-title">What You will Learn?</h4>
                        <?= $Coursewyl ?>
                    </div>
                </div>
                <!--  Course Topics -->
                <div class="edutim-single-course-segment  edutim-course-topics-wrap">
                    <div class="edutim-course-topics-header d-lg-flex justify-content-between">
                        <div class="edutim-course-topics-header-left">
                            <h4 class="course-title">Topics for this course</h4>
                        </div>
                    </div>
                    <div class="edutim-course-topics-contents">
                        <div class="accordion" id="accordionExample">
                            <?php if ((isset($_GET['order_id']) || isset($_GET['course_id'])) && $fetch_chaepter_list && $fetch_chaepter_list->num_rows > 0): ?>
                                <?php while ($row = $fetch_chaepter_list->fetch_assoc()): ?>
                                    <div class="card">
                                        <div class="card-header" id="heading<?= $row['chapter_id'] ?>">
                                            <h2 class="mb-0">
                                                <h4 class="curriculum-title">
                                                    <?= $row['chapterName'] ?>
                                                </h4>
                                            </h2>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <div class="card">
                                    <div class="card-header">
                                        <h2 class="mb-0">
                                            <h4 class="curriculum-title">No chapters available for this course.</h4>
                                        </h2>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!--  COurse Topics End -->

                <!-- <div class="course-widget course-info">
                    <h4 class="course-title">About the instructors</h4>
                    <div class="instructor-profile">
                        <div class="profile-img">
                            <img src="assets/images/blog/author.jpg" alt="" class="img-fluid">
                        </div>
                        <div class="profile-info">
                            <h5>Meraz Ahmed</h5>
                            <div class="rating">
                                <a href="#"><i class="fa fa-star"></i></a>
                                <a href="#"><i class="fa fa-star"></i></a>
                                <a href="#"><i class="fa fa-star"></i></a>
                                <a href="#"><i class="fa fa-star"></i></a>
                                <a href="#"><i class="fa fa-star-half"></i></a>
                                <span>3.79 ratings (29 )</span>
                            </div>
                            <p>I'm a developer with a passion for teaching. I'm the lead instructor at the London App
                                Brewery, London's leading Programming Bootcamp. I've helped hundreds of thousands of
                                students learn to code and change their lives by becoming a developer </p>
                            <div class="instructor-courses">
                                <span><i class="bi bi-folder"></i>4 Courses</span>
                                <span><i class="bi bi-group"></i>400 Students</span>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="course-widget course-info">
                    <?php
                    $row_count = 0;
                    if ($row_count >= 0) {
                        // Initialize an empty array to store comments
                        $c = array();

                        // Loop through each row and fetch 'blog_id'
                        while ($row = mysqli_fetch_assoc($query_fetch_course_review)) {
                            $courseId = $row['courseId'];
                            if ($courseId == $course_id) {
                                // echo "Blog ID: $blog_id<br>";
                                $review = $row['review'];
                                $reviewer = $row['name'];
                                $created_by = $row['created_by'];
                                $date = $row['created_on'];
                                $dateString = $date;
                                $formattedDate = date("jS M Y", strtotime($dateString));

                                // Add each comment to the $commentsArray
                                $reviewArray[] = array(
                                    'reviewdBy' => $created_by,
                                    'reviewdDate' => $formattedDate,
                                    'reviewdContent' => $review
                                );
                            }
                        }

                        // Display reviews
                        if (!empty($reviewArray)) {
                            echo '<div class="comments">
                <h3 class="comment-title">(' . count($reviewArray) . ') Reviews</h3>';

                            foreach ($reviewArray as $review) {
                                $reviewdBy = $review['reviewdBy'];
                                $reviewdDate = $review['reviewdDate'];
                                $reviewdContent = $review['reviewdContent'];


                                echo '<div class="course-review-wrapper">
                                <div class="course-review">
                                <div class="profile-img">
                                    <img src="assets/images/blog/author.jpg" alt="" class="img-fluid">
                                </div>
                                <div class="review-text">
                                    <h5>' . $reviewer . ' <span>' . $reviewdDate . '</span></h5>
                                    <p>' . $reviewdContent . '</p>
                                </div>
                            </div>
                            </div>';
                            }

                            echo '</div>'; // Close comments container
                        }
                    } else {
                        echo "No rows found with isactive = 1";
                    }
                    ?>

                    <div class="review-form p-5 mt-4">
                        <h3>Write Your Review </h3>
                        <p>Please share your thoughts about your experience with our course.</p>

                        <form action="core/course_reviewFunctions.php" method="POST" class="comment_form">
                            <div class="row form-row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <!-- <input type="text" name="comment" cols="30" rows="6" placeholder="Comment" class="form-control"> -->
                                        <textarea name="reviewdata" id="msgt" cols="30" rows="6" placeholder="Review"
                                            class="form-control" required></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control"
                                            value="<?= (!empty($fullName)) ? $fullName : "" ?>"
                                            placeholder="Enter your name">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control"
                                            value="<?= (!empty($email)) ? $email : "" ?>"
                                            placeholder="Enter your email">
                                    </div>
                                </div>
                                <input type="hidden" name="course_id" value="<?= $course_id; ?>"
                                    class="form-control">
                                <input type="hidden" name="role"
                                    value="<?= (!empty($_SESSION['role'])) ? $_SESSION['role'] : "default studen"; ?>"
                                    class="form-control">

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <button type="submit" name="review" class="btn btn-main text-white">
                                            Review
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

            <div class="col-lg-4">
                <div class="course-sidebar">
                    <div class="course-single-thumb">
                        <img src="uploads/images/<?= $bannerImage ?>" alt="" class="img-fluid w-100">
                        <div class="course-price-wrapper">
                            <?php
                            if (isset($_GET['order_id'])) {
                                $co_id = $_GET['order_id'];
                                $chapterData = mysqli_query($con, "SELECT * FROM orderdetails where id = $co_id");
                                $data = mysqli_fetch_array($chapterData);
                                $courseId = $data['courseId'];
                                $chapters = mysqli_query($con, "SELECT * FROM chapters WHERE courseId = $courseId ORDER BY id ASC LIMIT 1");
                                $d = mysqli_fetch_array($chapters);
                                // If an order ID is present, hide the course price and quantity input
                                ?>
                                <div <?php echo ($_SESSION['role'] == "company") ? 'style="display: none;"' : ''; ?>
                                    class="buy-btn">
                                    <a href="core/sessions.php?start_id=<?= $courseId ?>&chapterId=<?= $d['id'] ?>&orderId=<?= $co_id ?>"
                                        class="btn btn-main btn-block">
                                        Start Course
                                    </a>
                                </div>
                                <!-- <?= $_SESSION['role'] ?> -->
                                <?php
                            } else {
                                // If not, show the course price and quantity input
                                ?>
                                <h4>
                                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == "company") { ?>
                                        <h4>Quantity</h4>
                                        <div class="input-group mb-3 quantity">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text btn btn_incr" id="decrease">-</span>
                                            </div>
                                            <input type="number" class="form-control text-center" id="quantity" name="quantity"
                                                min="1" value="1">
                                            <div class="input-group-append">
                                                <span class="input-group-text btn btn_decr" id="increase">+</span>
                                            </div>
                                        </div>
                                        <!-- </div> -->
                                    <?php } ?>

                                </h4>
                                <h4>Price: <span>&#8377;
                                        <?= $courseCost ?>
                                    </span></h4>
                                <div class="buy-btn">
                                    <?php
                                    if (isset($_GET['course_id'])) {
                                        // If a course ID is present, display the "Start Course" button
                                        ?>
                                        <a href="" class="btn btn-main btn-block add_to_cart_button"
                                            data-product-id="<?= $co_id ?>" data-product-name="<?= $courseName ?>"
                                            data-product-price="<?= $courseCost ?>" data-product-image="<?= $bannerImage ?>">
                                            Add To Cart
                                        </a>
                                        <a href="" class="btn btn-dark btn-block add_to_wishlist_button"
                                            data-product-id="<?= $co_id ?>" data-product-name="<?= $courseName ?>"
                                            data-product-price="<?= $courseCost ?>" data-product-image="<?= $bannerImage ?>">
                                            Add To Wishlist
                                        </a>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <?php
                            }
                            ?>
                        </div>


                    </div>


                    <div class="course-widget single-info">
                        <i class="bi bi-group"></i>
                        Enrolled <span>101 Students</span>
                    </div>

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
                                    <span><i class="bi bi-user-ID"></i>Instructor :</span>
                                    <a href="#" class="d-inline-block">Jone Smit</a>
                                </div>
                            </li>

                            <li>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span><i class="bi bi-flag"></i>Duration :</span>
                                    2 weeks
                                </div>
                            </li>
                            <li>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span><i class="bi bi-paper"></i>Lessons :</span>
                                    42
                                </div>
                            <li>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span><i class="bi bi-forward"></i>Language :</span>
                                    English
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


                    <div class="course-widget course-share d-flex justify-content-between align-items-center">
                        <span>Share</span>
                        <ul class="social-share list-inline">
                            <li class="list-inline-item"><a href="#"><i class="fab fa-facebook"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fab fa-linkedin"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fab fa-pinterest"></i></a></li>
                        </ul>
                    </div>

                    <div class="course-widget course-metarials">
                        <h4 class="course-title">Requirements</h4>
                        <?= $requirement ?>
                    </div>

                    <div class="course-widget">
                        <h4 class="course-title">Tags</h4>
                        <div class="single-course-tags">
                            <?php
                            // Assuming $tags is an array of tags
                            $tags = ["Web Design", "Development", "Html", "Css"];

                            // Loop through the tags and generate HTML elements
                            foreach ($tags as $tag) {
                                echo '<a href="#">' . $tag . '</a>';
                            }
                            ?>
                        </div>
                    </div>




                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-padding related-course">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="section-heading">
                    <h4>Related Courses You may Like</h4>
                </div>
            </div>
        </div>

        <?php

        $fetch_course_list_data = mysqli_query($con, "SELECT 

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
        courses ON subtopics.Id = courses.subTopicId ORDER By courses.id DESC LIMIT 3");

        if ($fetch_course_list_data && mysqli_num_rows($fetch_course_list_data) > 0) {
            ?>
            <div class="row">
                <?php
                while ($related_course = mysqli_fetch_array($fetch_course_list_data)) {

                    $id = $related_course['course_id'];
                    $courseName = $related_course['courseName'];
                    $courseCost = $related_course['courseCost'];
                    // $courseDesc = $related_course['courseDesc'];
                    $courseDesc = substr($related_course['courseDesc'], 0, 100) . '...';
                    $bannerImage = $related_course['bannerImage'];
                    ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="course-block">
                            <div class="course-img">

                                <div class="img" style="
                            background-image: url('<?= $mainlink ?>uploads/images/<?= $bannerImage; ?>');
                            background-repeat: no-repeat;
                            background-size:cover;
                            width:100%;
                            height:100%;
                            ">

                                </div>
                                <span class="course-label">
                                    <?= $courseName; ?>
                                </span>
                            </div>

                            <div class="course-content">
                                <div class="course-price">
                                    <?= "&#8377;" . $courseCost; ?>
                                </div>

                                <h4><a href="course_single.php?course_id=<?= $id; ?>">
                                        <?= $courseName; ?>
                                    </a></h4>
                                <div class="rating">
                                    <!-- Your rating display logic here -->
                                </div>
                                <p>
                                    <?= $courseDesc; ?>
                                </p>

                                <div class="course-footer d-lg-flex align-items-center justify-content-between">
                                    <div class="course-meta">
                                        <!-- <span class="course-student"><i class="bi bi-group"></i><?= $related_course['students']; ?></span>
                                <span class="course-duration"><i class="bi bi-badge3"></i><?= $related_course['lessons']; ?> Lessons</span> -->
                                    </div>

                                    <!-- <div class="buy-btn"><a href="course_single.php?course_id=<?= $id; ?>"
                                    class="btn btn-main-2 btn-small">Details</a></div> -->
                                    <?php if ($courseDesc): ?>
                                        <a href="course_single.php?course_id=<?= $id; ?>"
                                            class="btn btn-main btn-small read-more-link">
                                            <i class="fa fa-plus-circle mr-2"></i>Read More
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
            <?php
        } else {
            echo "No related courses found.";
        }
        ?>
    </div>
</section>
<script>

    
    

    document.addEventListener('DOMContentLoaded', function () {
        // Add click event listener to the "Add to Cart" button
        var addToCartButton = document.querySelector('.add_to_cart_button');
        if (addToCartButton) {
            addToCartButton.addEventListener('click', function (event) {
                // Add your logic to handle adding the item to the cart

                // Display the success message using SweetAlert
                showSuccessMessage();
            });
        }

        // Function to display the success message using SweetAlert
        function showSuccessMessage() {
            Swal.fire({
                icon: 'success',
                title: 'Course Added To Cart Successfully!',
                showConfirmButton: false,
                timer: 2000
            });
        }
    });



</script>
<?php
include("includes/footer.php");
?>