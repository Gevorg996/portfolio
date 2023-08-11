<?php

ini_set('display_errors', 'off');
session_start();

if (isset($_POST['count'], $_POST['cart_id'])) {
    $count = $_POST['count'];
    $cartId = $_POST['cart_id'];

    $conn = new mysqli("localhost", "root", "", "register");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $newcount = "UPDATE cart_products SET qty = '$count' WHERE cart_product_id = '$cartId'";
    if ($conn->query($newcount) === true) {
        $pr = "SELECT cart_price FROM cart_products WHERE cart_product_id = '$cartId'";
        $res = mysqli_query($conn, $pr);
        $prrow = mysqli_fetch_assoc($res);
        $pr1 = $prrow['cart_price'];
        $updatedPrice = $pr1 * $count;
        echo json_encode(array('price' => $updatedPrice));
    } else {
        echo json_encode(array('error' => 'Error updating quantity'));
    }

    $conn->close();
}
?>
