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
     // Get the user role from the session
// echo $subscribedby; // For debugging purposes
// exit();
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