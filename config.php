<?php
$host = 'localhost';
$username = 'root'; // Change if you're not using XAMPP or local MySQL
$password = '';     // Change if your MySQL has a password
$database = 'myshop_db'; // Use your chosen DB name (NOT 'ecommerce')

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>
