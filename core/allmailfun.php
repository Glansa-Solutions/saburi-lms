<?php
include("db_config.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$con = mysqli_connect($host, $username, $password, $db);
// Fetch CountryList

$fetchCountries = mysqli_query($con, "SELECT * FROM awt_countries");
// $countryId = [];
if (isset($_GET['selectedCountryId'])) {
    $selectedCountryId = $_GET['selectedCountryId'];

    $fetchStates = mysqli_query($con, "SELECT * FROM awt_states WHERE country_id = '$selectedCountryId'");

    $states = array();

    while ($row = mysqli_fetch_assoc($fetchStates)) {
        $states[] = $row;
    }

    echo json_encode($states);
    // exit; // Terminate the script after sending JSON response
}

if (isset($_POST['registerCompany'])) {
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

            $mail->setFrom('soumya05ranjan@gmail.com', 'Company Registration'); // Change to your Gmail email and your name
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Registration Successful';
            $mail->Body = 'Thank you for registering with us.';

            $mail->send();

            echo "Inserted successfully, and an email has been sent.";
        } catch (Exception $e) {
            echo "Inserted successfully, but email sending failed. Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Failed to insert data.";
    }
} elseif (isset($_POST['add'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $msg = $_POST['message'];
    $admin_email = $_POST['admin_email'];
    $currentDate = date("Y-m-d H:i:s");

    $insert_query1 = mysqli_query($con, "INSERT INTO contact(name, email, subject, message, created_on) VALUES('$name', '$email','$subject','$msg','$currentDate')");

    if ($insert_query1) {
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
            // $admin_mail="anita.glansa@gmail.com";
            $mail->setFrom('soumya05ranjan@gmail.com', 'Soumya Ranjan'); // Change to your Gmail email and your name
            $mail->addAddress($admin_email);

            $mail->isHTML(true);
            $mail->Subject = 'Contacted You';
            $mail->Body = 'Name: ' . $name . '<br>Email: ' . $email;

            $mail->send();
            header("location: ../contact");

            echo "Inserted successfully, and an email has been sent.";
        } catch (Exception $e) {
            echo "Inserted successfully, but email sending failed. Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Failed to insert data.";
    }
} elseif (isset($_POST['send_email'])) {
    $email = $_POST['email'];
    $currentDate = date("Y-m-d H:i:s");

    $insert_query = mysqli_query($con, "INSERT INTO newsletter(email,created_on) VALUES('$email','$currentDate')");

    if ($insert_query) {
        header("location: ../contact");
    } else {
        echo "Failed to insert data.";
    }

}


// Include your database connection code here

?>