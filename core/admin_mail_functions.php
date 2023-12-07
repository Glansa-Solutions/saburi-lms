<?php
include("db_config.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['admin_email'])) {
    $email = $_POST['admin_email'];

    $fetch_admin_mail_list = mysqli_query($con, "SELECT * FROM users WHERE Email = '$email'");
    $fetch_row_count = mysqli_num_rows($fetch_admin_mail_list);
    if ($fetch_row_count > 0) {
        $fetch_admin_mail_list_data = mysqli_fetch_assoc($fetch_admin_mail_list);
        $currect_Email = $fetch_admin_mail_list_data['Email'];
        $currect_Password = $fetch_admin_mail_list_data['Password'];
        $currect_Name = $fetch_admin_mail_list_data['Name'];
        $resetCode = bin2hex(random_bytes(32));



        require("../assets/vendors/PHPMailer/PHPMailer.php");
        require("../assets/vendors/PHPMailer/SMTP.php");
        require("../assets/vendors/PHPMailer/Exception.php");
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP(); //Send using SMTP
            $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
            $mail->SMTPAuth = true; //Enable SMTP authentication
            $mail->Username = 'soumya05ranjan@gmail.com'; //SMTP username
            $mail->Password = 'omxnmogdokgduolo'; //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
            $mail->Port = 587; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

            $mail->setFrom('soumya05ranjan@gmail.com', 'Company Registration'); // Change to your Gmail email and your name
            $mail->addAddress($currect_Email);

            $mail->isHTML(true);
            $mail->Subject = 'Your Request For Password';
            $mail->Body = "
            <!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta http-equiv='X-UA-Compatible' content='IE=edge'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Account Information</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        line-height: 1.6;
                        margin: 20px;
                    }

                    .container {
                        max-width: 600px;
                        margin: 0 auto;
                    }

                    .header {
                        background-color: #f4f4f4;
                        padding: 10px;
                        text-align: center;
                    }

                    .content {
                        padding: 20px;
                    }

                    .instructions {
                        margin-top: 20px;
                    }
                </style>
            </head>
            <body>
            <div class='content'>
            <p>Dear '$currect_Name',</p>

            <p>Thank you for registering with our platform. Below are your account details:</p>

            <ul>
                <li><strong>Username:</strong> $currect_Email</li>
                <li><strong>Temporary Password:</strong> $currect_Password</li>
            </ul>

            <p>Please note that this is a temporary password. For security reasons, we strongly recommend that you reset your password immediately by following the steps below:</p>

            <ol>
                <li>Click on the following link: <a href='$mainlink" . "admin/reset-password.php?role=$resetCode'>Reset Password</a></li>
                <li>Follow the instructions on the page to create a new password.</li>
            </ol>

            <p>If you didn't request this action, please contact our support team immediately.</p>
        </div>
        <div class='instructions'>
            <p>Thank you, <br> Saburi LMS</p>
        </div>
    </div>
            </body>
            </html>";

            $mail->send();
            $response = array('status' => 'success', 'message' => 'Mail-Id Sent Successfully');
            echo json_encode($response);
        } catch (Exception $e) {
            $response = array('status' => 'danger', 'message' => 'Mail-Id Not Sent');
            echo json_encode($response);
        }
        // $response = array('status' => 'success', 'message' => 'Currect Mail-Id');
        // echo json_encode($response);
    } else {
        $response = array('status' => 'danger', 'message' => 'Mail-Id is Not Registered');
        echo json_encode($response);
    }
} else {
    $response = array('status' => 'danger', 'message' => 'Mail-Id required');
    echo json_encode($response);
}