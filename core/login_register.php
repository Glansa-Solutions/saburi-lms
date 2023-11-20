<?php
session_start();
include("db_config.php");


// function for generating randome password
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
    $idProof = $_POST['idProof'];
    $uniqueIdNo = $_POST['uniqueIdNo'];
    $userRole = $_POST['role'];
    // echo $userRole;
    // exit() ;
    $currentDate = date("Y-m-d H:i:s");
    $password = getRandom(16);


    $insertQuery = mysqli_query($con, "INSERT INTO students(name, DOB, country, district, state, pincode, gender, phoneNumber, email, idProof, idProofDetails, createdOn, isActive, password) 
        VALUES('$fullName', '$dob', '$country', '$city', '$state', '$pin', '$gender', '$phone', '$email', '$idProof', '$uniqueIdNo', '$currentDate', 0, '$password')");
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
                            <li>Click on the following link: <a href='$mainlink" . "account?role=$userRole&id=$insertedId'>Login Here</a></li>
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
            header("location: ../message?role=$userRole&id=$insertedId");
            echo 'Message has been sent';
            echo "<script>alert('Registration successful, please verify in the registered Email-Id');</script>";
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

    $insertCompany = mysqli_query($con, "INSERT INTO company(companyName, contactName, companyPhone, email, address, district, country_name, state, pincode, idProof, idProofDetails, createdOn, isActive) 
    VALUES('$companyName', '$contactName', '$phoneNumber', '$email', '$address', '$dist', '$country', '$state', '$pin', '$idProof', '$idDetails', '$currentDate', 0)");

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
                        <p>Dear '$fullName',</p>

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
            echo 'Message has been sent';
            echo "<script>alert('Registration successful, please verify in the registered Email-Id');</script>";
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "<script>alert('Data not inserted');</script>";
    }
}
// mail functionality of Company registration end

// Login Authentication starts
$userRole = isset($_POST["role"]) ? $_POST["role"] : '';
if (isset($_POST["student_login"])) {
    $student_mail = $_POST["email"];
    $student_pass = $_POST["password"];
    $student_id = $_POST['stud_id'];
    
    $match_auth_query = mysqli_query($con, "SELECT * FROM students WHERE email = '$student_mail'");
    $checking = mysqli_num_rows($match_auth_query) > 0;

    if ($checking) {
        $row = mysqli_fetch_assoc($match_auth_query);
        $stored_password = $row['password'];

        // Check if the entered password matches the stored password
        if ($student_pass==$stored_password) {
            $student_id = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            header("location: ../?role=$userRole&id=$student_id");
            exit();
        } else {
            // Password is incorrect
            $_SESSION['message'] = "Password is incorrect";
            header("location: ../account?role=$userRole&id=$student_id");
            exit();
        }
    } else {
        // Email is incorrect
        $_SESSION['message'] = "Username or Password are incorrect";

        // Debugging output
        echo "Role value received: " . htmlspecialchars($userRole);

        // Redirect after setting the session message
        header("location: ../account?role=$userRole");
        exit();
    }
}


// Login Authentication end
