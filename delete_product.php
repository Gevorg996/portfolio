<?php

ini_set('display_errors', 'off');
$conn = new mysqli("localhost", "root", "", "register");
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT product_id, product_name, product_price, product_description, product_image FROM products";

if (isset($_GET['id'])) {

	$id = $_GET['id'];
	$sql = "DELETE FROM products WHERE product_id = $id";

	if ($conn->query($sql) === true) {
		echo "product deleted";
	} else {
		echo "cant delete";
	}
}
header("Location: products.php");
$conn->close();
?>

