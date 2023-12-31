<?php

// session_start();
include("db_config.php");


// function for generating randome password
function generateRandomPassword()
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $password = '';

    for ($i = 0; $i < 16; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $password .= $characters[$index];
    }
    return $password;
}

$generated_password = generateRandomPassword();
// echo $randomPassword;

$userRole = isset($_POST["role"]) ? $_POST["role"] : '';
// Fetch CountryList
$fetchCountries = mysqli_query($con, "SELECT * FROM awt_countries");
if (isset($_GET['selectedCountryId'])) {
    $selectedCountryId = $_GET['selectedCountryId'];
    // $fetchCountryQuery = ;
    $fetchStates = mysqli_query($con, "SELECT * FROM awt_states WHERE country_id = $selectedCountryId");

    $states = array();

    while ($row = mysqli_fetch_assoc($fetchStates)) {
        $states[] = $row;
    }

    echo json_encode($states);
}
// Mail functionality of Student Registration start
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



if (isset($_POST['registerStudent'])) {
    $role = $_POST['role'];
    $verificationToken = md5(uniqid(rand(), true));
    // Store $verificationToken in your database along with the user's ID and expiration time
    $fullName = $_POST['fullName'];
    $dob = $_POST['dateOfBirth'];
    $phone = $_POST['phoneNumber'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $pin = $_POST['pinCode'];
    $address = $_POST['address'];
    $idProof = $_POST['idProof'];
    $uniqueIdNo = $_POST['uniqueIdNo'];
    $userRole = $_POST['role'];
    // echo $userRole;
    // exit() ;

    $currentDate = date("Y-m-d H:i:s");
    function getRandom($length)
    {

        $str = 'abcdefghijklmnopqrstuvwzyz';
        $str1 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $str2 = '0123456789';
        $shuffled = str_shuffle($str);
        $shuffled1 = str_shuffle($str1);
        $shuffled2 = str_shuffle($str2);
        $total = $shuffled . $shuffled1 . $shuffled2;
        $shuffled3 = str_shuffle($total);
        $result = substr($shuffled3, 0, $length);

        return $result;

    }
    $password = getRandom(16);

    $insertQuery = mysqli_query($con, "INSERT INTO students(name, DOB, country,address, district, state, pincode, gender, phoneNumber, email, idProof, idProofDetails,password, createdOn, isActive) 
        VALUES('$fullName', '$dob', '$country','$address', '$city', '$state', '$pin', '$gender', '$phone', '$email', '$idProof', '$uniqueIdNo','$password', '$currentDate', 0)");
    $insertedId = mysqli_insert_id($con);
    // print_r($insertedId);
    // exit();

    if ($insertQuery) {
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
            $mail->addAddress($email); //Add a recipient

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
                            <p>Dear '$fullName',</p>

                            <p>Thank you for registering with our platform. Below are your account details:</p>

                            <ul>
                                <li><strong>Username:</strong> $email</li>
                                <li><strong>Password:</strong> $password</li>
                            </ul>

                            <p>For security reasons, we do not include passwords in emails. To set up your password or reset it, please follow the steps below:</p>

                            <ol>
                            <li>Click on the following link: <a href='$mainlink" . "changepassword?role_id=$insertedId&role=$userRole'>Change Your Password Here</a></li>
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
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>';
            echo '<script>
            setTimeout(function() {
                Swal.fire({
                    icon: "success",
                    title: "Success!",
                    text: "You have successfully registered, Kindly check you registered mail for further details",
                }).then(function(){
                    window.location.href = "../logout_session";
                });
            }, 100);
          </script>';

            // echo "<script>alert('');</script>";
            // header("location: ../logout_session");
            // echo 'Message has been sent';

        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }


        // echo "<script>window.location = 'login.php';</script>";;
    } else {
        echo "<script>alert('Data not inserted');</script>";
    }
    // mail functionality of student Registration ends


}
// mail functionality of Company registration start
elseif (isset($_POST['registerCompany'])) {
    $role = $_POST['role'];
    // echo $generated_password;
    // exit();
    $companyName = $_POST['company_name'];
    $contactName = $_POST['contact_name'];
    $phoneNumber = $_POST['phoneNumber'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $dist = $_POST['dist'];
    $pin = $_POST['pinCode'];
    $idProof = $_POST['idProof'];
    $idDetails = $_POST['id_details'];
    $currentDate = date("Y-m-d H:i:s");


    $insertCompany = mysqli_query($con, "INSERT INTO company(companyName, contactName, companyPhone, email,password, address, district, country_name, state, pincode, idProof, idProofDetails, createdOn, isActive) 
    VALUES('$companyName', '$contactName', '$phoneNumber', '$email','$generated_password','$address', '$dist', '$country', '$state', '$pin', '$idProof', '$idDetails', '$currentDate', 0)");
    $insertedId = mysqli_insert_id($con);
    // echo $insertedId;
    // exit();
    if ($insertCompany) {
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
            $mail->addAddress($email); //Add a recipient

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
                        <p>Dear '$companyName',</p>

                        <p>Thank you for registering with our platform. Below are your account details:</p>

                        <ul>
                            <li><strong>Username:</strong> $email</li>
                            <li><strong>Password:</strong> $password</li>
                        </ul>

                        <p>For security reasons, we do not include passwords in emails. To set up your password or reset it, please follow the steps below:</p>

                        <ol>
                            <li>Click on the following link: <a href='$mainlink" . "reset-password.php?role=[ResetCode]'>Reset Password</a></li>
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
            // header('location: ');
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>';
            echo '<script>
                    setTimeout(function() {
                        Swal.fire({
                            icon: "success",
                            title: "Success!",
                            text: "You have successfully registered. Kindly check your registered email for further details",
                        }).then(function(){
                            window.location.href = "sessions.php?login_id=' . $insertedId . '";
                        });
                    }, 100);
                </script>';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "<script>alert('Data not inserted');</script>";
    }
}
// mail functionality of Company registration end

// Login Authentication starts

if (isset($_POST["student_login"])) {

    $student_mail = $_POST["email"];
    $student_pass = $_POST["password"];
    $student_id = $_POST['student_id'];
    $role = $_POST['role'];
    // $_SESSION['studentmail'] = $student_mail;
    // $_SESSION['password'] = $student_pass;
    // $_SESSION['student_id'] = $student_id;

    $match_auth_query = mysqli_query($con, "SELECT * FROM students WHERE email = '$student_mail'");
    $checking = mysqli_num_rows($match_auth_query) > 0;

    if ($checking) {
        $row = mysqli_fetch_assoc($match_auth_query);
        $stored_password = $row['password'];

        // Check if the entered password matches the stored password
        if ($student_pass == $stored_password) {
            $student_id = $row['id'];
            $session_id = $row['session_id'];

            if ($session_id == 0) {
                mysqli_query($con, "UPDATE students SET session_id = 1 WHERE id = $student_id");
                $_SESSION['user_name'] = $row['name'];
                $_SESSION['email'] = $student_mail;
                $_SESSION['pass'] = $student_pass;

                header("location: sessions.php?id=$student_id");
                exit();
            } else {
                // Redirect to the message page
                header("location: sessions.php?logged_in_elsewhere=$student_id");
                exit();
            }
        } else {
            header("location: sessions.php?incorrect_pass=$student_id");
            exit();
        }
    } else {
        header("location: sessions.php?incorrect_pass_email=$student_id");
        exit();
    }
}
if (isset($_POST["company_login"])) {
    $company_mail = $_POST["email"];
    $company_pass = $_POST["password"];
    $company_id = $_POST['company_id'];
    $role = $_POST['role'];


    $match_company_users_auth_query = mysqli_query($con, "SELECT * FROM companyusers WHERE email = '$company_mail'");
    $checking_company_users = mysqli_num_rows($match_company_users_auth_query) > 0;
    if ($checking_company_users) {
        $row = mysqli_fetch_assoc($match_company_users_auth_query);
        $stored_password = $row['password'];
        // Check if the entered password matches the stored password
        if ($company_pass == $stored_password) {
            $company_user_id = $row['id'];
            $company_user_session_id = $row['session_id'];
            $role = "companyusers";
            if ($company_user_session_id == 0) {
                mysqli_query($con, "UPDATE companyusers SET session_id = 1 WHERE id = $company_user_id");

                header("location: sessions.php?set_user_role_id=$company_user_id&set_user_role=$role");
                exit();
            } else {
                // Redirect to the message page
                header("location: sessions.php?set_user_role_id_logged_in_elsewhere=$company_user_id&set_user_role=$role");
                exit();
            }
        } else {
            header("location: sessions.php?incorrect_pass=$company_id");
            exit();
        }
    } else {
        $match_auth_query = mysqli_query($con, "SELECT * FROM company WHERE email = '$company_mail'");
        $checking = mysqli_num_rows($match_auth_query) > 0;
        if ($checking) {
            $row = mysqli_fetch_assoc($match_auth_query);
            $stored_password = $row['password'];

            // Check if the entered password matches the stored password
            if ($company_pass == $stored_password) {
                $company_id = $row['id'];
                $session_id = $row['session_id'];
                if ($session_id == 0) {
                    mysqli_query($con, "UPDATE company SET session_id = 1 WHERE id = $company_id");
                    $_SESSION['user_name'] = $row['name'];
                    $_SESSION['email'] = $company_mail;
                    $_SESSION['pass'] = $company_pass;

                    header("location: sessions.php?set_user_role_id=$company_id&set_user_role=$role");
                    exit();
                } else {
                    // Redirect to the message page
                    header("location: sessions.php?set_user_role_id_logged_in_elsewhere=$company_id&set_user_role=$role");
                    exit();
                }
            } else {
                header("location: sessions.php?incorrect_pass=$company_id");
                exit();
            }
        } else {
            header("location: sessions.php?incorrect_pass_email=$company_id");
            exit();
        }

    }
}
// Login Authentication end