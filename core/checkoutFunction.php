<?php
session_start();
include("db_config.php");
if (isset($_POST['woocommerce_checkout_place_order'])) {
    // Data to be inserted into the 'Orders' table
    $orderdate = date('Y-m-d H:i:s'); // Get the current date and time
    // $subscribedby = $_POST['subscribedby']; // Replace with how you determine this
    // $subscriberid = $_POST['subscriberid']; // Replace with how you determine this
    $paymentstatus = 'notpaid';
    $paymentdetails = ''; // You can populate this with payment details
    $total = $_POST['total']; // Replace with how you calculate the total
    $couponcode = $_POST['couponcode']; // Get the coupon code from the form
    $discount = 0;
    $subscribedby = $_SESSION['role'];
    $subscriberid = $_SESSION['role_id'];

    // Multiple User Creation on Place order


$cart = $_POST['cart'];

// Decode the JSON string into an array
$cartArray = json_decode($cart, true);

// Check if decoding was successful
if (is_array($cartArray)) {
    foreach ($cartArray as $item) {
        $user_id = $item['user_id'];
        $course_id = $item['id'];
        $quantity = $item['quantity'];

        for ($i = 0; $i < $quantity; $i++) {
            // Generate a random username and password (you may want to use a more secure method)
            $usernamePrefix = 'SaburiLMS';
            $randomNumber = sprintf('%06d', mt_rand(0, 999999));
            $currentMonthYear = date('my');
            $username = $usernamePrefix . $randomNumber . $currentMonthYear;

            // Generate a 16-bit random password
            $password = bin2hex(random_bytes(8));

            // Insert data into the company users table
            $sql = "INSERT INTO companyusers (companyId, UserId, Password, CourseId, IsActive) VALUES ('$user_id', '$username', '$password', '$course_id',1)";
            // Execute the SQL query, you should use prepared statements for security
           $insertQuery = mysqli_query($con, $sql);

            // For testing purposes, you can print the SQL query instead of executing it
            echo $sql . "<br>";
        }
    }
} else {
    // Handle the case where decoding failed
    echo "Error decoding JSON string";
}


    // exit();
    // if($cart){
    //     $companyId
    // }

    $grandtotal = $total - $discount;

    $insertOrderQuery = "INSERT INTO Orders (orderdate, subscribedby, subscriberid, paymentstatus, paymentdetails, total, couponcode, discount, grandtotal,createdOn)
            VALUES ('$orderdate', '$subscribedby', '$subscriberid', '$paymentstatus', '$paymentdetails', '$total', '$couponcode', '$discount', '$grandtotal',NOW())";

    if ($con->query($insertOrderQuery) === TRUE) {
        $orderId = $con->insert_id; // Get the ID of the newly inserted order
        $cartData = json_decode($_POST['cart'], true);

        foreach ($cartData as $item) {
            $courseId = $item['id']; // Assuming your cart data has an 'id' field for course ID
            $qty = $item['quantity'];
            $rate = $item['price'];

            // Insert data into the 'Orderdetails' table for each item
            $insertOrderDetailsQuery = mysqli_query($con, "INSERT INTO Orderdetails (OrderId, CourseId, quantity, price, createdOn) VALUES ($orderId, $courseId, $qty, $rate,NOW())");
        
            if ($insertOrderDetailsQuery) {
                header("Location: ../cart.php");
            } else {
                echo "failed";
            }
        }

        // Redirect to a thank you page or show a success message
        echo "Order placed successfully!";
    } else {
        // Handle the error
        echo "Error: " . $con->error;
    }

    // Close the database connection
    $con->close();
}
?>