<?php
include("db_config.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Fetch CountryList

$fetchCountries = mysqli_query($con, "SELECT * FROM awt_countries");
// $countryId = [];
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
    // while(list($country) = mysqli_fetch_assoc($fetchCountries)) {
    //     $selectedCountryId = $country;
    // }
    // $fetchStates = mysqli_query($con, "SELECT * FROM awt_states WHERE country_id = '$selectedCountryId'");

    // $states = array();

    // while ($row = mysqli_fetch_assoc($fetchStates)) {
    //     $states[] = $row;
    // }

    // echo json_encode($states);
    // exit; // Terminate the script after sending JSON response


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
    $currentDate = date("Y-m-d H:i:s"); 
    $activationcode=md5($email.time());

    $insertQuery = mysqli_query($con, "INSERT INTO students(name, DOB, country, district, state, pincode, gender, phoneNumber, email, idProof, idProofDetails, createdOn, isActive, activationcode) 
    VALUES('$fullName', '$dob', '$country', '$city', '$state', '$pin', '$gender', '$phone', '$email', '$idProof', '$uniqueIdNo', '$currentDate', 0, '$activationcode')");

    if($insertQuery){
        require("../assets/vendors/PHPMailer/PHPMailer.php");
        require("../assets/vendors/PHPMailer/SMTP.php");
        require("../assets/vendors/PHPMailer/Exception.php");
        $mail =  new PHPMailer(true);
        try {
            //Server settings
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'soumya05ranjan@gmail.com';                     //SMTP username
            $mail->Password   = 'omxnmogdokgduolo';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;


            //Recipients
            $mail->setFrom('soumya05ranjan@gmail.com', 'LMS Verification');
            $mail->addAddress($email);     //Add a recipient
            
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Email Verification from LMS';
            $mail->Body    = "Thanks for Registration! Click on the link to verify your email
            <a href='$mainlink'core/verify.php?code='$activationcode'>Click Here</a>";
        
            $mail->send();
            // header('location: ');
            echo 'Message has been sent';
            echo "<script>alert('Registration successful, please verify in the registered Email-Id');</script>";
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        
        // echo "<script>window.location = 'login.php';</script>";;
        }
        else
        {
        echo "<script>alert('Data not inserted');</script>";
        }

       
        
    }
    