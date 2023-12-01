<?php

include("db_config.php");

if (isset($_POST['add_to_wishlist_button'])) {

    $userId = mysqli_real_escape_string($con, $_POST['user_id']);
    $courseId = mysqli_real_escape_string($con, $_POST['id']);
    $courseName = mysqli_real_escape_string($con, $_POST['name']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $image = mysqli_real_escape_string($con, $_POST['image']);
    $role = mysqli_real_escape_string($con, $_POST['role']);
    $isActive = 1;

    // Prepare and execute SELECT query
    $stmt = $con->prepare("SELECT * FROM wishlist WHERE role = ? AND courseId = ? AND userId = ?");
    $stmt->bind_param("iii", $role, $courseId, $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the record already exists
    if ($result->num_rows > 0) {
        // Record already exists, provide a response message
        echo json_encode('Record already exists in the wishlist.');
    } else {
        // Record does not exist, proceed with the insertion
        $insert_query = mysqli_query($con, "INSERT INTO wishlist (userId, role, courseId, courseName, price, image, createdBy, isActive) VALUES ('$userId', '$role', '$courseId', '$courseName', '$price', '$image', '$userId', '$isActive')");

        if ($insert_query) {
            // Insertion successful, provide a success response
            echo json_encode('Added to wishlist');
        } else {
            // Insertion failed, provide an error response
            echo "Error: " . mysqli_error($con);
        }
    }

}


if (isset($_POST['move_to_cart'])) {
    $id = $_POST['id'];
    $delete_query = mysqli_query($con, "DELETE FROM wishlist WHERE id = $id");
    if ($delete_query) {
        echo json_encode('Moved to cart');
    } else {
        echo json_encode("Brother Some error");
    }
}

if (isset($_POST['remove'])) {
    // Check if $_POST['id'] is an array
    if (is_array($_POST['id'])) {
        $sanitizedIds = array_map(function ($id) use ($con) {
            // Sanitize each element of the array
            return mysqli_real_escape_string($con, $id);
        }, $_POST['id']);

        // Convert the sanitized array back to a comma-separated string
        $idList = implode(',', $sanitizedIds);

        // Perform the deletion
        $delete_query = mysqli_query($con, "DELETE FROM wishlist WHERE id IN ($idList)");

        if ($delete_query) {
            echo json_encode('Items removed from cart');
        } else {
            echo json_encode("Error: " . mysqli_error($con));
        }
    } else {
        echo json_encode('Invalid input');
    }
}


// Close the database connection
mysqli_close($con);

?>