<?php
ini_set('display_errors', 'off');
session_start(); 
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
</head>

<body>
    <main class="form-signin w-100 m-auto">
        <form method="post" class="addform" action="add.php">
            <h1 class="h3 mb-3 fw-normal">Add Product</h1>
            <div class="form-floating">
                <input type="text" name="name" required class="form-control" id="floatingInput">
                <label for="floatingInput">Product Name</label>
            </div>
            <div class="form-floating">
                <input type="number" name="price" step="0.01" required class="form-control" id="floatingInput">
                <label for="floatingInput">Product Price</label>
            </div>
            <div class="form-floating">
                <p>Product Description:</p>
                <textarea name="description" id="floatingInput" required></textarea>
            </div>
            <div class="form-floating">
                <p>Add Image:</p>
                <input type="file" name="image" id="image" class="form-control" enctype="multipart/form-data" accept="image/*">
            </div>
            <div class="form-floating">
                <input class="form-control" type="submit" value="Add Product">
            </div>
        </form>
        <div class="backbtn">
            <a href="products.php"><button class="btn btn-sm btn-outline-secondary">Back to Product list</button></a>  
        </div>
    </main>

    <?php 
    $conn = new mysqli("localhost", "root", "", "register");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset( $_SESSION['email'])) {
        $session = $_SESSION['email'];
        $id = "SELECT usersID FROM users WHERE email = '$session'";
        $res = $conn->query($id);

        if ($res && $res->num_rows > 0) {
            $idrow = $res->fetch_assoc();
            $userid = $idrow['usersID'];
        }

        $_SESSION['user_id'] = $userid;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST["name"];
            $price = $_POST["price"];
            $description = $_POST["description"];
            $image = $_POST["image"];
            $regex = '/^[a-zA-Z0-9\s]+$/';
            if(preg_match($regex, $description)){
                $sql = "INSERT INTO products (product_name, product_price, product_description, product_image, user_id) VALUES ('$name', '$price', '$description', '$image', '$userid')";

                if ($conn->query($sql) === TRUE) {
                    header("Location: products.php");
                    exit();
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "<h2 class='warning'>you can use only english letters for name and description</h2>";
            }
        }
    }

    $conn->close();
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <?php include 'footer.php'; ?>
</body>
</html>
