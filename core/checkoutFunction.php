<?php
session_start();
include("db_config.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['woocommerce_checkout_place_order'])) {
    $orderdate = date('Y-m-d H:i:s');
    $paymentstatus = 'notpaid';
    $paymentdetails = '';
    $total = $_POST['total'];
    $couponcode = $_POST['couponcode'];
    $discount = 0;
    $subscribedby = $_SESSION['role'];
    $subscriberid = $_SESSION['role_id'];

    $cart = $_POST['cart'];
    $cartArray = json_decode($cart, true);

    if (is_array($cartArray) && $subscribedby == 'company') {
        foreach ($cartArray as $item) {
            $user_id = $item['user_id'];
            $course_id = $item['id'];
            $quantity = $item['quantity'];

            for ($i = 0; $i < $quantity; $i++) {
                $usernamePrefix = 'SaburiLMS';
                $randomNumber = sprintf('%06d', mt_rand(0, 999999));
                $currentMonthYear = date('my');
                $username = $usernamePrefix . $randomNumber . $currentMonthYear;
                $password = bin2hex(random_bytes(8));

                $sql = "INSERT INTO companyusers (companyId, UserId, Password, CourseId, IsActive) VALUES ('$user_id', '$username', '$password', '$course_id', 1)";
                $insertQuery = mysqli_query($con, $sql);

                $courseNameQuery = "SELECT courseName FROM courses WHERE id = '$course_id'";
                $courseNameResult = mysqli_query($con, $courseNameQuery);
                $courseRow = mysqli_fetch_assoc($courseNameResult);
                $courseName = $courseRow['courseName'];

                $companyIdQuery = "SELECT email FROM company WHERE id = '$user_id'";
                $result = mysqli_query($con, $companyIdQuery);

                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $email = $row['email'];

                        require_once "../assets/vendors/PHPMailer/PHPMailer.php";
                        require_once "../assets/vendors/PHPMailer/SMTP.php";
                        require_once "../assets/vendors/PHPMailer/Exception.php";
                        
                        $mail = new PHPMailer(true);

                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = 'soumya05ranjan@gmail.com';
                        $mail->Password = 'omxnmogdokgduolo';
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                        $mail->Port = 587;
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

                        $mail->setFrom('soumya05ranjan@gmail.com', 'Soumya Ranjan');
                        $mail->addAddress($email);

                        $mail->isHTML(true);
                        $mail->Subject = 'Your SaburiLMS Login Information';

                        $mail->Body = "
                            <html>
                            <body>
                                <h2>SaburiLMS Login Information</h2>
                                <p>Dear User,</p>
                                <p>Your login credentials for SaburiLMS are as follows:</p>
                                <ul>
                                    <li><strong>Username:</strong> $username</li>
                                    <li><strong>Password:</strong> $password</li>
                                    <li><strong>Course Name:</strong> $courseName</li>
                                </ul>
                                <p>You can customize the email message as needed.</p>
                            </body>
                            </html>
                        ";

                        try {
                            $mail->send();
                            echo 'Message has been sent';
                        } catch (Exception $e) {
                            echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
                        }

                        echo $sql . "<br>";
                    }
                }
            }
        }
    } else {
        echo "Error decoding JSON string";
    }
    $grandtotal = $total - $discount;

    $insertOrderQuery = "INSERT INTO Orders (orderdate, subscribedby, subscriberid, paymentstatus, paymentdetails, total, couponcode, discount, grandtotal,createdOn)
            VALUES ('$orderdate', '$subscribedby', '$subscriberid', '$paymentstatus', '$paymentdetails', '$total', '$couponcode', '$discount', '$grandtotal',NOW())";

    if ($con->query($insertOrderQuery) === TRUE) {
        $orderId = $con->insert_id;

        $cartData = json_decode($_POST['cart'], true);

        foreach ($cartData as $item) {
            $courseId = $item['id'];
            $qty = $item['quantity'];
            $rate = $item['price'];

            $insertOrderDetailsQuery = mysqli_query($con, "INSERT INTO Orderdetails (OrderId, CourseId, quantity, price, createdOn) VALUES ($orderId, $courseId, $qty, $rate,NOW())");

            if ($insertOrderDetailsQuery) {
                header("Location: ../cart.php");
            } else {
                echo "failed";
            }
        }

        echo "Order placed successfully!";
    } else {
        echo "Error: " . $con->error;
    }

    $con->close();
}
?>