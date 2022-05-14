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
echo "Connected successfully/ ";

//Handle SEARCH data DB
if (isset($_POST['key_search'])) {
      $key_search = $_POST['key_search'];
      //SQL query for searhdata;
      $sql_product = "SELECT * FROM product WHERE p_name LIKE '%$key_search%';";
      if (mysqli_query($conn, $sql_product)) {
        echo ('search successfull//');
      } else  echo ('search fail// ' . mysqli_error($conn));
      
    } else {
      $sql_product = "SELECT * FROM product";
    }
    // Thực thi câu truy vấn
    $product_oj = mysqli_query($conn, $sql_product);