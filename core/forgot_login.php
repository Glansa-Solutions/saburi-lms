<?php
session_start();
include("db_config.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['forgot_login_email']) && $_POST['f_role']) {
    $forgot_login_email = $_POST['forgot_login_email'];
    $f_role = $_POST['f_role'];

    if ($f_role === "students") {
        $match_f_role_query = mysqli_query($con, "SELECT * FROM students WHERE email = '$forgot_login_email'");
        $checking = mysqli_num_rows($match_f_role_query) > 0;

        if ($checking) {
            $row = mysqli_fetch_assoc($match_f_role_query);
            $forgotten_password = $row['password'];
            $forgotten_email = $row['email'];

            // Send an email
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


                //Recipients
                $mail->setFrom('soumya05ranjan@gmail.com', 'LMS Verification');
                $mail->addAddress($forgotten_email); //Add a recipient

                $mail->isHTML(true); //Set email format to HTML
                $mail->Subject = 'Email Verification from LMS';
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
                    <div class='container'>
                        <div class='header'>
                            <h2>Account Information</h2>
                        </div>
    
                        <div class='content'>
                            <p>Dear User,</p>
    
                            <p>Your request for password</p>
    
                            <p>Your current password is: $forgotten_password</p>
    
                            <ol>
                                <li><a href='$mainlink" . "core/sessions.php?forgot_login_role=$f_role'><p>Login to your account</p></a></li>    
                            </ol>
                        </div>
    
                        <div class='instructions'>
                            <p>Thank you, <br> Saburi LMS</p>
                        </div>
                    </div>
                </body>
                </html>";
                $mail->send();
                // header('location: ');
                // header("location: sessions.php?login_id=$insertedId");
                echo 'Message has been sent';
                // echo "<script>alert('Registration successful, please verify in the registered Email-Id');</script>";
            } catch (Exception $e) {
                echo "Inserted successfully, but email sending failed. Error: {$mail->ErrorInfo}";
            }
        }


    } elseif($f_role === "company") {
        $match_auth_query = mysqli_query($con, "SELECT * FROM students WHERE email = '$student_mail'");
        $checking = mysqli_num_rows($match_auth_query) > 0;

        if ($checking) {
            $row = mysqli_fetch_assoc($match_auth_query);
            $stored_password = $row['password'];

            // Check if the entered password matches the stored password
            if ($student_pass == $stored_password) {
                $student_id = $row['id'];
                $session_id = $row['session_id'];
            }
            // $fetch_prev_login_id_data=mysqli_query($con, "SELECT email FROM students WHERE id= $prev_login_id");
            // echo $prev_logon_email;

            // Send an email
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


                //Recipients
                $mail->setFrom('soumya05ranjan@gmail.com', 'LMS Verification');
                $mail->addAddress($prev_login_email); //Add a recipient

                $mail->isHTML(true); //Set email format to HTML
                $mail->Subject = 'Email Verification from LMS';
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
                    <div class='container'>
                        <div class='header'>
                            <h2>Account Information</h2>
                        </div>
    
                        <div class='content'>
                            <p>Dear User,</p>
    
                            <p>Some one is trying to login your account, Kindly let us know is that you or someone</p>
    
                            <p>For security reasons, we do not include passwords in emails. To reset your login, please follow the steps below:</p>
    
                            <ol>
                                <li><a href='$mainlink" . "core/sessions.php?current_login_id=$prev_login_id'>It's You</a></li>
                                <li><a href='$mainlink'>Not You</a></li>
    
                            </ol>
                        </div>
    
                        <div class='instructions'>
                            <p>Thank you, <br> Saburi LMS</p>
                        </div>
                    </div>
                </body>
                </html>";
                $mail->send();
                // header('location: ');
                // header("location: sessions.php?login_id=$insertedId");
                echo 'Message has been sent';
                // echo "<script>alert('Registration successful, please verify in the registered Email-Id');</script>";
            } catch (Exception $e) {
                echo "Inserted successfully, but email sending failed. Error: {$mail->ErrorInfo}";
            }
        }
    }else{
        header("location: ../log_reg");
    }

}



?>