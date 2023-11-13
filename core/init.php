
<?php
session_start();
if(isset($_GET["role"]) && $_GET["role"] == 'student') {
    $_SESSION['role'] = 'student';
    $role = $_SESSION['role'];
}
if(isset($_GET["role"]) && $_GET["role"] == 'company') {
    $_SESSION['role'] = 'company';
    $role = $_SESSION['role'];
}

require "db_config.php";
require "functions.php";
require "data_list_grid.php";
require "login_register.php";

