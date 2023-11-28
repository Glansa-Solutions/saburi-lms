<?php
include('db_config.php');

session_start(); // Start the session

// Check if the user is logged in and has the necessary role and role_id
if (isset($_SESSION['role']) && isset($_SESSION['role_id'])  || ($_SESSION['role'])=== 'student') {
    // User has the required role and role_id, proceed with updating the profile

    if (isset($_POST['update_student_register'])) {
        // Form is submitted, handle the update

        // Retrieve form data
        $fullName = mysqli_real_escape_string($con, $_POST['fullName']);
        $DOB = mysqli_real_escape_string($con, $_POST['DOB']);
        $address = mysqli_real_escape_string($con, $_POST['address']);
        $country = mysqli_real_escape_string($con, $_POST['country']);
        $state = mysqli_real_escape_string($con, $_POST['state']);
        $pincode = mysqli_real_escape_string($con, $_POST['pincode']);
        $gender = mysqli_real_escape_string($con, $_POST['gender']);
        $phoneNumber = mysqli_real_escape_string($con, $_POST['phoneNumber']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $idProof = mysqli_real_escape_string($con, $_POST['idProof']);
        $idProofDetails = mysqli_real_escape_string($con, $_POST['idProofDetails']);
        $studentId = mysqli_real_escape_string($con, $_POST['id']);

        // Update the database
        $update_query = "UPDATE students SET name='$fullName', DOB='$DOB', address='$address', country='$country', state='$state', pincode='$pincode', gender='$gender', phoneNumber='$phoneNumber', email='$email', idProof='$idProof', idProofDetails='$idProofDetails' WHERE id='$studentId'";

        if (mysqli_query($con, $update_query)) {
            echo "Profile updated successfully";
            // header("location: authFunctions"); // Redirect to the desired location
        } else {
            echo "Error updating profile: " . mysqli_error($con);
        }
    }

} else {
    // User does not have the required role or role_id
    echo "Access denied. You do not have permission to update this profile.";
}
?>
