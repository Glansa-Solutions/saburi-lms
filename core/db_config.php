<?php

session_start();

$host="localhost";
$db="saburi_lms_2023";
$password="";
$username="root";

$con = mysqli_connect($host,$username,$password,$db);

// if(!$con){
//     echo "not connected";

// }else{
//     echo "connected";
// }


$mainlink="http://localhost/saburi-lms/";

?>