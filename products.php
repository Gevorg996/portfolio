<?php

ini_set('display_errors', 'off');
session_start(); 
?>

<?php 

$conn2 = new mysqli("localhost", "root", "", "register");
if ($conn2->connect_error) {
    die("Connection failed: " . $conn2->connect_error);
}
if (isset( $_SESSION['email'])) {
    $session = $_SESSION['email'];
    $id = "SELECT usersID FROM users WHERE email = '$session'";
    $res = $conn2->query($id);
    if ($res && $res->num_rows > 0) {
        $idrow = $res->fetch_assoc();
        $userid = $idrow['usersID'];
    }

    $_SESSION['user_id'] = $userid;   
}
$conn2->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="O">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/css.css">
    <title>products</title>
</head>
<body> 

    <div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
          <div class="col-md-3 mb-2 mb-md-0">
            <h1 class="aqua">My Products</h1>
        </div>

        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li><a href="index.php" class="nav-link px-2 link-secondary">Home</a></li>
            <li><a href="page.php" class="nav-link px-2 link-secondary">my page</a></li>
        </ul>
    </header>
</div>


<div class="tit">
    <h1>Welcome to our Online Store</h1>
    <h2>Product List</h2>
</div>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Description</th>
        <th>image</th>
        <th>change image</th>
        <th>delete</th>
    </tr>
    <?php


    $conn = new mysqli("localhost", "root", "", "register");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if (isset($_SESSION['user_id'])) {
        $user = $_SESSION['user_id'];
        $sql = "SELECT product_id, product_name, product_price, product_description, product_image FROM products WHERE user_id = '$user'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $_SESSION['img_products'] = 'images/'.$row['product_image'];    
                $_SESSION['id_products'] = $row["product_id"];
                $_SESSION['name_products'] = $row["product_name"]; 
                $_SESSION['price_products'] = $row["product_price"];
                $_SESSION['description_products'] = $row["product_description"];
                echo "<tr>";
                echo "<td>" . $_SESSION['id_products'] . "</td>";
                echo "<td>" . $_SESSION['name_products'] . "</td>";
                echo "<td>" . $_SESSION['price_products'] . "</td>";
                echo "<td><div class='description-view'>" . $_SESSION['description_products'] . "</div>";
                echo "<div class='description-edit'>";
                echo "<textarea class='edit-textarea'>" . $_SESSION['description_products'] . "</textarea>";
                echo "<button class='save-description-btn btn btn-primary rounded-pill px-3' data-id='" . $_SESSION['id_products'] . "'>Save</button>";
                echo "</div></td>";
                echo "<td><img class='nkar2' src= '"  . $_SESSION['img_products'] . " '></td>";
                echo "<td>
                <button class='edit-image-btn btn btn-sm btn-outline-secondary' data-id='" . $_SESSION['id_products'] . "'>Change Image</button>
                </td>";
                echo "<td><a href='confirm_delete_product.php?id=" . $_SESSION['id_products'] . "'><button id='bt' class='btn btn-sm btn-outline-secondary'>delete</button>
                </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No products found.</td></tr>";
        }
        $conn->close();
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
           $conn = new mysqli("localhost", "root", "", "register");
           if ($conn->connect_error) {
               die("Connection failed: " . $conn->connect_error);
           }
           $productId = $_POST["product_id"];
           $newDescription = $_POST["product_description"];
           $newDescription = htmlspecialchars($newDescription);
           $sql = "UPDATE products SET product_description = '$newDescription' WHERE product_id = $productId";

           if ($conn->query($sql) === TRUE) {
            http_response_code(200);
            echo "Description updated successfully.";
        } else {

            http_response_code(500);
            echo "Error updating description: " . $conn->error;
        }

        $conn->close();
    }

}
?>
</table>

<div class="add_prod">  
    <a href="add.php"><button class="btn btn-primary w-100 py-2">add products</button></a>
</div>

<div class="container">
  <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    <div class="col-md-4 d-flex align-items-center">
      <span class="mb-3 mb-md-0 text-body-secondary">© 2023 online shop</span>
  </div>
</footer>
</div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="js/js.js"></script>
</html>



