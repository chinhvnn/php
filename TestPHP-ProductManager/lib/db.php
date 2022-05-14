<?php

$servername = "localhost";
$dbuser = "root";
$dbpw = "";
$dbname = "testphp";

// Tạo connection
$conn = new mysqli($servername, $dbuser, $dbpw, $dbname);
mysqli_set_charset($conn, 'UTF8');

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error .'/ ');
}

  $sql_product_all = "SELECT * FROM product";
  $product_oj = mysqli_query($conn, $sql_product_all);

// mysqli_close($conn);
?>