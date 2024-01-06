<?php
session_start();
include("db_config.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
if (isset($_POST['woocommerce_checkout_place_order'])) {
    $orderdate = date('Y-m-d H:i:s');
    $paymentstatus = 'paid';
    $paymentdetails = '';
    $total = $_POST['ctotal'];
    // $couponcode = $_POST['couponcode'];
    $discount = 0;
    $subscribedby = $_SESSION['role'];
    $subscriberid = $_SESSION['role_id'];
    // echo $total;
    // exit();

    $cart = $_POST['cart'];
    $cartArray = json_decode($cart, true);

    if (is_array($cartArray)) {
        foreach ($cartArray as $item) {
            $user_id = $item['user_id'];
            $course_id = $item['id'];
            $quantity = ($subscribedby == 'students') ? 1 : $item['quantity'];

            for ($i = 0; $i < $quantity; $i++) {
                $usernamePrefix = 'SaburiLMS';
                $randomNumber = sprintf('%06d', mt_rand(0, 999999));
                $currentMonthYear = date('my');
                $username = $usernamePrefix . $randomNumber . $currentMonthYear;
                $password = bin2hex(random_bytes(8));

                $sql = "INSERT INTO companyusers (companyId, email, password, CourseId, IsActive) VALUES ('$user_id', '$username', '$password', '$course_id', 1)";
                $insertQuery = mysqli_query($con, $sql);

                if (!$insertQuery) {
                    die("Error creating user: " . mysqli_error($con));
                }

                $courseNameQuery = "SELECT courseName FROM courses WHERE id = '$course_id'";
                $courseNameResult = mysqli_query($con, $courseNameQuery);

                if ($courseRow = mysqli_fetch_assoc($courseNameResult)) {
                    $courseName = $courseRow['courseName'];

                    $companyIdQuery = "SELECT email FROM company WHERE id = '$user_id'";
                    $result = mysqli_query($con, $companyIdQuery);

                    if ($result && $emailRow = mysqli_fetch_assoc($result)) {
                        $email = $emailRow['email'];

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
                            echo '<script>
                                Swal.fire({
                                    title: "Message Sent",
                                    icon: "success",
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                            </script>';
                        } catch (Exception $e) {
                            echo '<script>
                                Swal.fire({
                                    title: "Error",
                                    text: "Message could not be sent. Mailer Error: ' . $mail->ErrorInfo . '",
                                    icon: "error",
                                    confirmButtonText: "OK"
                                });
                            </script>';
                        }
                    }
                }
            }
        }

        $grandtotal = $total - $discount;

        $insertOrderQuery = "INSERT INTO Orders (orderdate, subscribedby, subscriberid, paymentstatus, paymentdetails, total, discount, grandtotal,createdOn)
            VALUES ('$orderdate', '$subscribedby', '$subscriberid', '$paymentstatus', '$paymentdetails', '$total', '$discount', '$grandtotal', NOW())";

        if ($con->query($insertOrderQuery) === TRUE) {
            $orderId = $con->insert_id;

            foreach ($cartArray as $item) {
                $courseId = $item['id'];
                $qty = $item['quantity'];
                $rate = $item['price'];
                $total_price = $qty * $rate;

                $insertOrderDetailsQuery = mysqli_query($con, "INSERT INTO orderdetails (orderId, courseId, quantity, price,totalPrice, createdOn) VALUES ($orderId, $courseId, $qty, $rate,$total_price,NOW())");

                if (!$insertOrderDetailsQuery) {
                    die("Error inserting order details: " . mysqli_error($con));
                }
            }

            $_SESSION['order_success'] = true;
            header("location: $mainlink" . "courselist.php");
            exit();
        } else {
            echo '<script>
                Swal.fire({
                    title: "Error",
                    text: "Error placing order: ' . $con->error . '",
                    icon: "error",
                    confirmButtonText: "OK"
                });
            </script>';
        }
    } else {
        echo '<script>
            Swal.fire({
                title: "Error",
                text: "Invalid cart data",
                icon: "error",
                confirmButtonText: "OK"
            });
        </script>';
    }

    $con->close();
}
?>