<?php
session_start();
include("db_config.php");
// $mainlink=""
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['role'])) {
        $_SESSION['role'] = $_POST['role'];
        header("Location: ../account#login_con");
    }
}
// echo $_GET['id'];
if (isset($_GET['id'])) {
    $_SESSION['role_id'] = $_GET['id'];
    $role_id = $_SESSION['role_id'];
    header("Location: ../");
    exit();
    // echo $role_id;
}


<<<<<<< HEAD
if (isset($_GET['set_user_role_id']) && isset($_GET['set_user_role'])) {
    $_SESSION['set_user_role_id'] = $_GET['set_user_role_id'];
    $_SESSION['set_user_role'] = $_GET['set_user_role'];
    $role_id = $_SESSION['set_user_role_id'];
    header("Location: ../");
    exit();
    // echo $role_id;
}
=======
$encypid1 = encrypt($encypid);
$encypid2 = decrypt($encypid1);
echo "<pre>";
echo "original: $encypid</br>";
echo "encrypted: $encypid1</br>";
echo "decrypted: $encypid2";
echo "</pre>";

$num = strlen($encypid);
echo $num;
?>
>>>>>>> 437b8f40db2822fca2232eb334d4bda64a40779a

<!-- Your main content goes here -->

<<<<<<< HEAD
// login Sessions
if (isset($_GET['login_id'])) {
    $_SESSION['role_id'] = $_GET['login_id'];
    $role_id = $_SESSION['role_id'];
    // echo $role_id;
    // exit();
    header("Location: ../account#login_con");
    exit();
    // echo $role_id;
}

if (isset($_GET['logged_in_elsewhere'])) {
    $_SESSION['role_id'] = $_GET['logged_in_elsewhere'];
    $_SESSION['login_else_message'] = "You have logged in already, kindly logout or reset login.";
    // $role_id = $_SESSION['role_id'];
    $prev_login_id = $_SESSION['role_id'];
    $fetch_prev_login_id = mysqli_query($con, "SELECT email FROM students WHERE id= $prev_login_id");
    if ($fetch_prev_login_id) {
        $row = mysqli_fetch_assoc($fetch_prev_login_id);
        $email = $row['email'];
        $_SESSION['prev_email'] = $email;
        header("location: ../alertmessage#alert");
    } else {
        echo "email is wrong";
    }
    // header("Location: prev_login.php");
    // header("Location: ../alertmessage");
    exit();
}

if (isset($_GET['set_user_role_id_logged_in_elsewhere']) && isset($_GET['set_user_role'])) {
    $_SESSION['role_id'] = $_GET['set_user_role_id_logged_in_elsewhere'];
    $_SESSION['role'] = $_GET['set_user_role'];
    $role_set = $_GET['set_user_role'];
    $_SESSION['login_else_message'] = "You have logged in already, kindly logout or reset login.";
    // $role_id = $_SESSION['role_id'];
    $prev_login_id = $_SESSION['role_id'];
    if($role_set==="company"){
        $fetch_prev_login_id = mysqli_query($con, "SELECT email FROM company WHERE id= $prev_login_id");
        if ($fetch_prev_login_id) {
            $row = mysqli_fetch_assoc($fetch_prev_login_id);
            $email = $row['email'];
            $_SESSION['prev_email'] = $email;
            header("location: ../alertmessage#alert");
        } else {
            echo "email is wrong";
        }
    }else{
        $fetch_prev_login_id = mysqli_query($con, "SELECT UserId FROM companyusers WHERE id= $prev_login_id");
        if ($fetch_prev_login_id) {
            $row = mysqli_fetch_assoc($fetch_prev_login_id);
            $email = $row['email'];
            $_SESSION['prev_email'] = $email;
            header("location: ../alertmessage#alert");
        } else {
            echo "email is wrong";
        }
    }
    
    // header("Location: prev_login.php");
    // header("Location: ../alertmessage");
    exit();
}

if(isset($_GET['incorrect_pass'])){
    $_SESSION['incorrect_pass_id'] = $_GET['incorrect_pass'];
    $_SESSION['alert_message'] = "Your Password is incorrect";
    header("Location: ../account#login_con");
    exit();
}

if(isset($_GET['incorrect_pass_email'])){
    $_SESSION['incorrect_pass_email_id'] = $_GET['incorrect_pass_email'];
    $_SESSION['alert_message'] = "Your Email & Password is incorrect";
    header("Location: ../account#login_con");
    exit();
}

if (isset($_GET['current_login_id']) && isset($_GET['current_login_role'])) {
    $current_login_id = $_GET['current_login_id'];
    $current_login_role = $_GET['current_login_role'];
    $set_prev_login_to_zero = mysqli_query($con, "UPDATE $current_login_role SET session_id = 0 WHERE id = $current_login_id");
    if ($set_prev_login_to_zero) {
        header("location: ../account#login_con");
        exit();
    } else {
        echo "unable to reset login";
    }
}
// for forgot password - session storing the role
if (isset($_GET['f_role'])) {
    $_SESSION['f_role'] = $_GET['f_role'];
    // $forgot_login_user_role = $_SESSION['f_role'];
    // header("Location: prev_login.php");
    header("Location: ../forgot_password");
    exit();
}
if (isset($_GET['forgot_login_role'])) {
    $_SESSION['role'] = $_POST['forgot_login_role'];
        header("Location: ../account#login_con");
    exit();
}
=======
<button onclick="showAlert()">Show Alert</button>
>>>>>>> 437b8f40db2822fca2232eb334d4bda64a40779a

<div class="alert" id="myAlert">
    <span class="closebtn" onclick="closeAlert()">&times;</span>
    <p>This is a stylish alert!</p>
</div>

<<<<<<< HEAD
// for forgot password - session storing the role


if (isset($_GET['start_id']) && isset($_GET['chapterId']) && isset($_GET['orderId'])) {
    $_SESSION['course_id'] = $_GET['start_id'];
    $_SESSION['chapter_id'] = $_GET['chapterId'];
    $course_id_status_active = $_SESSION['course_id'];
    $courseId = $_GET['start_id'];
    $chapterId = $_GET['chapterId']; 
    $orderId = $_GET['orderId'];
    $userId = $_SESSION['mail'];
    $password = $_SESSION['pass'];

    $course_id_status_active_query = mysqli_query($con, "UPDATE orderdetails SET status = 1 WHERE courseId = $course_id_status_active");
    $fetch_course_login = mysqli_query($con, "SELECT * FROM courselogin WHERE username = '$userId' AND pwd = '$password' AND courseid = $courseId AND status = 1");
    $fetch_chapter_assessment_order = mysqli_query($con, "SELECT * FROM chaptersassessmentorders WHERE courseId = $courseId");
    $order_chapter_assement_data = mysqli_fetch_array($fetch_chapter_assessment_order);

    $chapter_assessment_order_id = $order_chapter_assement_data['id'];

    $count_course_login = mysqli_num_rows($fetch_course_login);
    if($count_course_login >0 ){
        header("Location: ../chapterSingle");
    }else{
        $insert_course_login = mysqli_query($con, "INSERT INTO courselogin (orderid, courseid, course_contentid, username, pwd, status) VALUES ($orderId, $courseId, $chapter_assessment_order_id, '$userId', '$password', 1)");
    if ($course_id_status_active_query) {
        $_SESSION['chapter_id'] = $_GET['chapterId'];
        header("Location: ../chapterSingle");
        
        exit();
    }
    }
    

}
if (isset($_GET['ch_id'])) {
    $_SESSION['role_id'] = $_GET['ch_id'];
    $_SESSION['role'];
    header("Location: ../changepassword");
    exit();
}
// Redirect to the account page
exit;
=======
<style>
	body {
    font-family: Arial, sans-serif;
}

.alert {
    position: fixed;
    top: 0;
    right: -300px; /* Adjust this value to control the initial position */
    width: 300px;
    background-color: green;
    color: #fff;
    padding: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: 0.3s;
}

.alert p {
    margin: 0;
}

.closebtn {
    cursor: pointer;
    float: right;
    font-size: 20px;
    font-weight: bold;
}

.closebtn:hover {
    color: #333;
}

</style>

<script>
	function openAlert() {
    document.getElementById("myAlert").style.right = "0";
}

function closeAlert() {
    document.getElementById("myAlert").style.right = "-300px";
}

function showAlert() {
    openAlert();
}

</script>

<?php
include("includes/footer.php");
>>>>>>> 437b8f40db2822fca2232eb334d4bda64a40779a
?>