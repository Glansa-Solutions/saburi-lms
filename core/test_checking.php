<?php
require_once 'db_config.php'; // Assuming you have a file for database connection

if (isset($_POST['admin_current_p']) && isset($_POST['admin_new_p']) && isset($_POST['admin_conf_p'])) {

    $admin_current_p = mysqli_real_escape_string($con, $_POST['admin_current_p']);
    $admin_new_p = mysqli_real_escape_string($con, $_POST['admin_new_p']);
    $admin_conf_p = mysqli_real_escape_string($con, $_POST['admin_conf_p']);

    // Validate current password
    $quer_check_current_pass = mysqli_query($con, "SELECT Password FROM users WHERE password='$admin_current_p'");

    $check_query = mysqli_num_rows($quer_check_current_pass) > 0;

    if ($check_query) {
        $fetch_quer_check_current_pass = mysqli_fetch_assoc($quer_check_current_pass);
        $id = $fetch_quer_check_current_pass['id'];
        if ($admin_new_p === $admin_conf_p) {
            $surepassword = $admin_conf_p;
            $quer_update_pass = mysqli_query($con, "UPDATE users SET password = '$surepassword' WHERE id = $id");

            if ($quer_update_pass) {
                $response = array('status' => 'success', 'message' => 'Your password was updated');
                echo json_encode($response);
                // $_SESSION['message'] = "Your password was updated";
                // header("location: ../changepassword?role=$role&role_id=$roleid");
                exit();
            } else {
                $response = array('status' => 'danger', 'message' => 'Your password was not updated');
                echo json_encode($response);
                exit();
            }
        } else {
            $response = array('status' => 'danger', 'message' => 'New & Confirm Password do not match');
            echo json_encode($response);
            exit();
        }
    } else {
        $response = array('status' => 'danger', 'message' => 'Current Password is incorrect');
        echo json_encode($response);
        exit();
    }

} else {
    $response = array('status' => 'danger', 'message' => 'Current Password is incorrect');
    echo json_encode($response);
    exit();
}
?>