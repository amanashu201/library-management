<?php
$servername = "localhost";
$username = "aman123"; 
$password = "aman"; 
$dbname = "lms"; 


// 


// Create MySQLi connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>