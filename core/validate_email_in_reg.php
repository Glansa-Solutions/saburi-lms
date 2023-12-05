<?php
include("db_config.php");
// echo "yes";

if (isset($_GET['entered_mail'])) {
    $exist_email = mysqli_real_escape_string($con, $_GET['entered_mail']);

    // Using prepared statement to prevent SQL injection
    $finding_existed_account_query = mysqli_prepare($con, "SELECT email FROM students WHERE email=?");
    mysqli_stmt_bind_param($finding_existed_account_query, "s", $exist_email);
    mysqli_stmt_execute($finding_existed_account_query);
    mysqli_stmt_store_result($finding_existed_account_query);

    if (mysqli_stmt_num_rows($finding_existed_account_query) > 0) {
        echo "Email already exists";
    } else {
        echo "";
    }

    mysqli_stmt_close($finding_existed_account_query);
} else {
    echo "Invalid request";
}

// $row_finding_existed_account_query = mysqli_fetch_assoc($finding_existed_account_query);
// if ($row_finding_existed_account_query) {
//     $exist_email = $row_finding_existed_account_query['email'];
//     echo $email;
//     if ($exist_email == $email) {
//         echo json_encode("Email allready registered");
//         header("location: ../$page_name");
//     }