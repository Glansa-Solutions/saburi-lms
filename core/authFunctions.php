<?php
include("db_config.php");

if (isset($_SESSION['role_id']) && !empty($_SESSION['role_id'])&&isset($_SESSION['role'])) {

    if($_SESSION['role']=="students"){
        $r_id = mysqli_real_escape_string($con, $_SESSION['role_id']);
        // $s_id;
        
        $student_auth_query = mysqli_query($con, "SELECT st.*, s.name as s_name, c.name as c_name, s.id as s_id, c.id as c_id 
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
            $state = $student_auth['s_name'];

            $state_id = $student_auth['s_id'];
            $country_id = $student_auth['c_id'];
            
            $country = $student_auth['c_name'];
            $pincode = $student_auth['pincode'];
            $gender = $student_auth['gender'];
            $phoneNumber = $student_auth['phoneNumber'];
            $email = $student_auth['email'];
            $_SESSION['email']= $email;
            $idProof = $student_auth['idProof'];
            $idProofDetails = $student_auth['idProofDetails'];
        }
    }elseif($_SESSION['role']=="company"){
        $r_id = mysqli_real_escape_string($con, $_SESSION['role_id']);
        // $s_id;
        
        $student_auth_query = mysqli_query($con, "SELECT c.*,a.id as c_id,s.id as s_id, a.name as a_name, s.name as s_name FROM `company` as c,awt_countries as a,awt_states as s WHERE a.id = c.country_name AND c.state = s.id and c.id='$r_id'");
        $row_count = mysqli_num_rows($student_auth_query);
    
        if ($row_count > 0) {
            // Fetch student information
            $student_auth = mysqli_fetch_assoc($student_auth_query);
            $id = $student_auth['id'];

            $state_id = $student_auth['s_id'];
            $country_id = $student_auth['c_id'];
            $fullName = $student_auth['companyName'];
            $contactName = $student_auth['contactName'];
            $district = $student_auth['district'];
            $phoneNumber = $student_auth['companyPhone'];
            $address = $student_auth['address'];
            $state = $student_auth['s_name'];
            $pincode = $student_auth['pincode'];
            $country = $student_auth['a_name'];
            $phoneNumber = $student_auth['companyPhone'];
            $email = $student_auth['email'];
            $idProof = $student_auth['idProof'];
            $idProofDetails = $student_auth['idProofDetails'];
        }
    }elseif($_SESSION['role']=="companyusers"){
        $r_id = mysqli_real_escape_string($con, $_SESSION['role_id']);
        // $s_id;
        
        $company_user_auth_query = mysqli_query($con, "SELECT * FROM companyusers WHERE id='$r_id'");
        $row_count = mysqli_num_rows($company_user_auth_query);
    
        if ($row_count > 0) {
            // Fetch student information
            $company_user_auth = mysqli_fetch_assoc($company_user_auth_query);
            $id = $company_user_auth['id'];
            $fullName = $company_user_auth['email'];
            $email = "";
            $style="d-none";
        } 
    }
    // Using prepared statement to prevent SQL injection
    

} else {
    // header("location: $mainlink");
    // Set default values if 'id' is not set or empty
    $s_id = '';
    $s_email = '';
    $s_pass = '';
    $s_name = '';
}