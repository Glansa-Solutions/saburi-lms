<?php
// Initialize your database connection. Replace with your actual database credentials.
include("../core/db_config.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Create a connection to the database


// Check the connection
// if ($con->conect_error) {
//     die("connection failed: " . $con->conect_error);
// }

if (isset($_GET['email'])) {
    // Get the email from the URL
    $email = $_GET['email'];
    
    // Display the confirmation message
    echo "If you would like to stop receiving promotional emails permanently from Saburi LMS, please click on the below unsubscribe button.<br>";
    echo "$email will be removed from our mailing list.<br><br>";
    
    // Display "Yes" and "No" options
    echo "Do you want to unsubscribe?<br>";
    echo "<a href='unsubscribe.php?email=$email&confirm=yes'>Yes</a> ";
    echo "<a href='unsubscribe.php?email=$email&confirm=no'>No</a>";
    
    // Check for confirmation
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] === 'yes') {
            // SQL query to mark the user as unsubscribed
            $sql = "UPDATE newsletter SET status = 0 WHERE email = '$email'";
    
            if ($con->query($sql) === TRUE) {
                // Display a confirmation message
                echo "You have been unsubscribed successfully.";
            } else {
                echo "Error: " . $sql . "<br>" . $con->error;
            }
        } elseif ($_GET['confirm'] === 'no') {
            // User chose not to unsubscribe
            echo "You are still subscribed to our mailing list.";
        }
    }
} else {
    echo "Invalid request. Please provide a valid email address.";
}

// Close the database conection
// $con->close();
?>
