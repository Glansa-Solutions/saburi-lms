<?php
include("includes/header.php");
// $courseId = $_SESSION['course_id'];
$userRole = $_SESSION['role'];
$user_id = $_SESSION['role_id'];
$fetch_comapany_course = mysqli_query($con, "SELECT COUNT(companyusers.id) AS count, courses.courseName, companyusers.CourseId FROM companyusers INNER JOIN courses ON companyusers.CourseId = courses.id
WHERE companyusers.companyId = $user_id GROUP BY companyusers.CourseId, courses.courseName");

$fetch_total_course = mysqli_query($con, "SELECT orders.subscriberid, orders.subscribedby, SUM(orderdetails.quantity) as orderedQuantity, orderdetails.orderId FROM orders INNER JOIN orderdetails ON orders.id = orderdetails.orderId WHERE orders.subscribedby = 'company' AND orders.paymentstatus = 'paid'");

$orderData = mysqli_fetch_array($fetch_total_course);

$subscriberId = $orderData["subscriberid"];
$subscribedBy = $orderData["subscribedby"];
$orderedQuantity = $orderData["orderedQuantity"];
$orderId = $orderData["orderId"];

$fetch_course_login_data = mysqli_query($con, "SELECT COUNT(courselogin.id) as count ,orderdetails.orderId FROM `courselogin`INNER JOIN orderdetails ON courselogin.courseid = orderdetails.courseId AND orderdetails.orderId = courselogin.orderid WHERE courselogin.orderid = $orderId");
$courseLoginData = mysqli_fetch_array($fetch_course_login_data);
$courseLoginCount = $courseLoginData['count'];

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
                    <h1>Company Course Report</h1>
                    <!-- <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="list-inline-item">/</li>
                        <li class="list-inline-item">
                            <?= $filename; ?>
                        </li>
                    </ul> -->
                </div>
            </div>
        </div>
    </div>
</section>
<div class="page-wrapper">
    <div class="container ccr">
        <div class="row">
            <div class="col-md-12">
                <div class="table-container px-3">
                    <table class="score-table">
                        <thead>
                            <tr>
                                <th>Sr No.</th>
                                <th>Course Name</th>
                                <th>Course Users</th>
                                <th>Course Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($fetch_comapany_course) {
                                $i = 1;
                                while ($course_data = mysqli_fetch_assoc($fetch_comapany_course)) {
                                    $courseName = $course_data["courseName"];
                                    $courseUsers = $course_data['count'];
                                    $courseStatus = ($orderedQuantity == $courseLoginCount) ? "Complete" : "Incomplete";
                                    $courseId = $course_data['CourseId'];
                                    ?>
                                    <tr>
                                        <td>
                                            <?= $i++ ?>
                                        </td>
                                        <td>
                                            <?= $courseName ?>
                                        </td>
                                        <td>
                                            <?= $courseUsers ?>
                                        </td>
                                        <td>
                                            <?= $courseStatus ?>
                                        </td>
                                        <td>
                                            <a href="companySingleCourseReport?co_id=<?= $courseId ?>&company_id=<?= $user_id ?>"
                                                class="button_ccr">View</a>
                                        </td>
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

<?php
include("includes/footer.php");
?>