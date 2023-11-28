<?php
include("db_config.php");

if (isset($_SESSION['role_id']) && !empty($_SESSION['role_id']) && isset($_SESSION['role'])) {

    if($_SESSION['role']=="student"){
        $r_id = mysqli_real_escape_string($con, $_SESSION['role_id']);
        // $s_id;
        
        $student_auth_query = mysqli_query($con, "SELECT st.*, s.name as s_name, c.name as c_name 
        FROM `students` as st, awt_states as s, awt_countries as c 
        WHERE st.country = c.id AND st.state = s.id AND st.id = '$r_id'");
        $row_count = mysqli_num_rows($student_auth_query);

        if ($row_count > 0) {
        // Fetch student information
        $student_auth = mysqli_fetch_assoc($student_auth_query);
        $id = $student_auth['id'];
        $fullName = $student_auth['name'];
        $DOB = $student_auth['DOB'];
        $address = $student_auth['address'];
        // Access state and country names
        $stateName = $student_auth['s_name'];
        $countryName = $student_auth['c_name'];

        $pincode = $student_auth['pincode'];
        $gender = $student_auth['gender'];
        $phoneNumber = $student_auth['phoneNumber'];
        $email = $student_auth['email'];
        $idProof = $student_auth['idProof'];
        $idProofDetails = $student_auth['idProofDetails'];
        } else {
                    // Student not found, handle accordingly (redirect, show error, etc.)
                    echo "Student not found";
                    // exit; // or redirect to an error page
                }
    }elseif($_SESSION['role']=="company"){
        $r_id = mysqli_real_escape_string($con, $_SESSION['role_id']);
        // $s_id;
        
        $student_auth_query = mysqli_query($con, "SELECT * FROM company WHERE id='$r_id'");
        $row_count = mysqli_num_rows($student_auth_query);
    
        if ($row_count > 0) {
            // Fetch student information
            $student_auth = mysqli_fetch_assoc($student_auth_query);
            $id = $student_auth['id'];
            $fullName = $student_auth['companyName'];
            // $DOB = $student_auth['DOB'];
            // $address = $student_auth['address'];
            // $state = $student_auth['state'];
            // $pincode = $student_auth['pincode'];
            // $gender = $student_auth['gender'];
            // $phoneNumber = $student_auth['phoneNumber'];
            // $email = $student_auth['email'];
            // $idProof = $student_auth['idProof'];
            // $idProofDetails = $student_auth['idProofDetails'];
        } else {
            // Student not found, handle accordingly (redirect, show error, etc.)
            echo "Student not found";
            exit; // or redirect to an error page
        }
    }
    // Using prepared statement to prevent SQL injection
    

} else {
    // Set default values if 'id' is not set or empty
    $s_id = '';
    $s_email = '';
    $s_pass = '';
    $s_name = '';
}