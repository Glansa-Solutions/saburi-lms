<?php
include("db_config.php");

if (isset($_POST['confrm_pass'])) {
    $role = $_POST['role'];
    $roleid = $_POST['roleid'];

    if ($role === "student") {
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $conf_password = $_POST['conf_password'];

        $quer_check_current_pass = mysqli_query($con, "SELECT password FROM students WHERE password='$current_password' AND id= $roleid");
        $check_query = mysqli_num_rows($quer_check_current_pass) > 0;

        if ($check_query) {
            if ($new_password === $conf_password) {
                $surepassword = $conf_password;
                $quer_update_pass = mysqli_query($con, "UPDATE students SET password = '$surepassword' WHERE id = $roleid");

                if ($quer_update_pass) {
                    $_SESSION['message'] = "Your password was updated";
                    header("location: ../account");
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