<?php
$host = "localhost";
$user = "id14583067_jewsauce";
$pass = "%q0a{(ynEGE9BQ~v";
$db = "id14583067_alotofniggers";

$c_con = mysqli_connect($host, $user, $pass, $db);
mysqli_query($c_con, "SET NAMES UTF8") or die(mysqli_error($c_con));
date_default_timezone_set('UTC');
error_reporting(E_ALL);

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}



/*any sugestions you may contact me on discord : FinGu#1337 or make an issue! */