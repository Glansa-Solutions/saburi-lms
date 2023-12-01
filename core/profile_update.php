<?php
include('db_config.php');
    if (isset($_POST['update_student_register'])) {
        // Form is submitted, handle the update

        // Retrieve form data
        
        $fullName = mysqli_real_escape_string($con, $_POST['fullName']);
        $DOB = mysqli_real_escape_string($con, $_POST['DOB']);
        $address = mysqli_real_escape_string($con, $_POST['address']);
        $country_id = mysqli_real_escape_string($con, $_POST['country_id']);
        $state_id = mysqli_real_escape_string($con, $_POST['state_id']);
        $pincode = mysqli_real_escape_string($con, $_POST['pincode']);
        $gender = mysqli_real_escape_string($con, $_POST['gender']);
        $phoneNumber = mysqli_real_escape_string($con, $_POST['phoneNumber']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $idProof = mysqli_real_escape_string($con, $_POST['idProof']);
        $idProofDetails = mysqli_real_escape_string($con, $_POST['idProofDetails']);
        $studentId = mysqli_real_escape_string($con, $_POST['id']);

        // Update the database
        $update_query = "UPDATE students SET name='$fullName', DOB='$DOB', address='$address', country='$country_id', state='$state_id', pincode='$pincode', gender='$gender', phoneNumber='$phoneNumber', email='$email', idProof='$idProof', idProofDetails='$idProofDetails' WHERE id='$studentId'";
        

        if (mysqli_query($con, $update_query)) {
            // echo "yes updating";
            // exit();
            // echo "Profile updated successfully";
            header("location: ../profile"); // Redirect to the desired location
        } else {
            echo "Error updating profile: " . mysqli_error($con);
        }
    }

    if (isset($_POST['update_company_register'])) {
        // Form is submitted, handle the update

        // Retrieve form data
        
        $fullName = mysqli_real_escape_string($con, $_POST['fullName']);
        $district = mysqli_real_escape_string($con, $_POST['district']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $address = mysqli_real_escape_string($con, $_POST['address']);
        $contactName = mysqli_real_escape_string($con, $_POST['contactName']);
        $pincode = mysqli_real_escape_string($con, $_POST['pincode']);
        $phoneNumber = mysqli_real_escape_string($con, $_POST['phoneNumber']);
        $country = mysqli_real_escape_string($con, $_POST['country']);
        $country_id = mysqli_real_escape_string($con, $_POST['country_id']);
        $state = mysqli_real_escape_string($con, $_POST['state']);
        $state_id = mysqli_real_escape_string($con, $_POST['state_id']);
        $idProof = mysqli_real_escape_string($con, $_POST['idProof']);
        $idProofDetails = mysqli_real_escape_string($con, $_POST['idProofDetails']);
        $company_id = mysqli_real_escape_string($con, $_POST['id']);

        // Update the database
        $update_query = "UPDATE company SET companyName='$fullName',contactName='$contactName',companyPhone='$phoneNumber',email='$email', address='$address', country_name='$country_id',district='$district', state='$state_id', pincode='$pincode', idProof='$idProof', idProofDetails='$idProofDetails' WHERE id='$company_id'";

        if (mysqli_query($con, $update_query)) {
            // echo "Profile updated successfully";
            header("location: ../profile"); // Redirect to the desired location
        } else {
            echo "Error updating profile: " . mysqli_error($con);
        }
    }

?>