<?php  
$servername = "localhost";
$username = "root";
$password = "";
$dbase = "pluk";

$conn = new mysqli ($servername,$username,$password,$dbase);
date_default_timezone_set('Asia/Manila');

$sql = "SET time_zone = '+8:00'";

$time = $conn->query($sql);

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  } else {
    echo "Connection successful!";
  }

?>