<?php
session_start();
require_once 'db_config.php'; // Assuming you have a file for database connection

if (isset($_POST['confrm_pass'])) {
    $role = isset($_POST['role']) ? mysqli_real_escape_string($con, $_POST['role']) : '';
    $roleid = isset($_POST['roleid']) ? (int)$_POST['roleid'] : 0;

    if ($role === "students" && $roleid > 0) {
        $current_password = isset($_POST['current_password']) ? mysqli_real_escape_string($con, $_POST['current_password']) : '';
        $new_password = isset($_POST['new_password']) ? mysqli_real_escape_string($con, $_POST['new_password']) : '';
        $conf_password = isset($_POST['conf_password']) ? mysqli_real_escape_string($con, $_POST['conf_password']) : '';

        // Validate current password
        $quer_check_current_pass = mysqli_query($con, "SELECT password FROM students WHERE password='$current_password' AND id=$roleid");
        $check_query = mysqli_num_rows($quer_check_current_pass) > 0;

        if ($check_query) {
            // Validate new and confirm password
            if ($new_password === $conf_password) {
                $surepassword = $conf_password;
                $quer_update_pass = mysqli_query($con, "UPDATE students SET password = '$surepassword' WHERE id = $roleid");

                if ($quer_update_pass) {
                    $_SESSION['message'] = "Your password was updated";
                    header("location: ../logout_session");
                    exit();
                } else {
                    $_SESSION['message'] = "Your password was not updated";
                    header("location: ../changepassword?role=$role&role_id=$roleid");
                    exit();
                }
            } else {
                $_SESSION['message'] = "New & Confirm Password do not match";
                header("location: ../changepassword?role=$role&role_id=$roleid");
                exit();
            }
        } else {
            $_SESSION['message'] = "Current Password is incorrect";
            header("location: ../changepassword?role=$role&role_id=$roleid");
            exit();
        }
    } elseif ($role === "company") {
        echo "company";
        exit();
    } else {
        echo "something went wrong";
        exit();
    }
} else {
    $_SESSION['message'] = "Current Password is incorrect";
    header("location: ../confirmpassword");
    exit();
}
?>
