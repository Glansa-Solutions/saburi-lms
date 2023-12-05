<?php
include("includes/header.php");
// $courseId = $_SESSION['course_id'];
$userRole = $_SESSION['role'];
$user_id = $_SESSION['role_id'];
$fetch_comapany_course = mysqli_query($con,"SELECT COUNT(companyusers.id) AS count, courses.courseName, companyusers.CourseId FROM companyusers INNER JOIN courses ON companyusers.CourseId = courses.id
WHERE companyusers.companyId = $user_id GROUP BY companyusers.CourseId, courses.courseName");

$fetch_total_course = mysqli_query($con,"SELECT orders.subscriberid, orders.subscribedby, SUM(orderdetails.quantity) as orderedQuantity, orderdetails.orderId FROM orders INNER JOIN orderdetails ON orders.id = orderdetails.orderId WHERE orders.subscribedby = 'company' AND orders.paymentstatus = 'paid'");

$orderData = mysqli_fetch_array($fetch_total_course);

$subscriberId = $orderData["subscriberid"];
$subscribedBy = $orderData["subscribedby"];
$orderedQuantity = $orderData["orderedQuantity"];
$orderId = $orderData["orderId"];

$fetch_course_login_data = mysqli_query($con,"SELECT COUNT(courselogin.id) as count ,orderdetails.orderId FROM `courselogin`INNER JOIN orderdetails ON courselogin.courseid = orderdetails.courseId AND orderdetails.orderId = courselogin.orderid WHERE courselogin.orderid = $orderId");
$courseLoginData = mysqli_fetch_array($fetch_course_login_data);
$courseLoginCount = $courseLoginData['count'];

?>


<div class="page-wrapper">
    <div class="container">
        <div class="row">
            <div>
                <div class="thank-you-message">Company Course Report</div>
                <div class="table-container">
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
                                            <a href="companySingleCourseReport?co_id=<?= $courseId ?>&company_id=<?= $user_id ?>" class="button">View</a>
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