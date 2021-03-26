<?php
//DB connection
$host = "localhost";
$username = "root";
$password = "";
$database = "localhost";

$sql = mysqli_connect($host, $username, $password, $database) or die('Failed to connect database!');