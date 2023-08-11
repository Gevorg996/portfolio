<?php
if (isset($_POST['delete_product_button'])) {
    $product_id_to_delete = $_POST['delete_product_id'];

    $connection = new mysqli("localhost", "root", "", "register");
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    $delete_sql = "DELETE FROM cart_products WHERE cart_product_id = '$product_id_to_delete'";
    $result = mysqli_query($connection, $delete_sql);

    if ($result) {
        
        header("Location: cart.php");
        exit;
    } else {
     
        die(mysqli_error($connection));
    }
}
?>
