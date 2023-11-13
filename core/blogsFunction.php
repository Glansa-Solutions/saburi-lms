<?php
include("db_config.php");

$fetch_list_blog_query=mysqli_query($con,"SELECT * FROM blogs where isActive = 1");


?>