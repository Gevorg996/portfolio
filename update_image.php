<?php

ini_set('display_errors', 'off');
session_start();

$conn = new mysqli("localhost", "root", "", "register");
if ($conn->connect_error) {
  die("Ошибка подключения: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $productId = $_POST["product_id"];
  $newImage = $_POST["product_image"];


  $sql = "UPDATE products SET product_image = '$newImage' WHERE product_id = $productId";

  if ($conn->query($sql) === TRUE) {
    http_response_code(200);
    echo "image changed.";
  } else {
    http_response_code(500);
    echo "error: " . $conn->error;
  }
}

$conn->close();
?>