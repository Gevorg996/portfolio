<?php

ini_set('display_errors', 'off');
session_start();

$id = $_GET['product_id'];
$conn = new mysqli("localhost", "root", "", "register");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT product_id, product_name, product_price, product_description, product_image FROM products WHERE product_id = '$id'";
$result = mysqli_query($conn, $sql);
$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result);
if ($result->num_rows > 0) {
  $_SESSION['product_id'] = $row['product_id'];
  $name = $row['product_name'];
  $price = $row['product_price'];
  $description = $row['product_description'];
  $image = $row['product_image'];
}

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
  <title>product</title>
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

  <div class="prpagecont">
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <div class="col">
          <div class="card shadow-sm">

            <?php echo "<img src='images/$image' alt='nkar'>" ?>
            <div class="card-body">
              <h1><?php echo $name ?></h1>
              <p class="card-text"><?php echo $description ?></p>
              <p><?php echo $price . " USD" ?></p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="index.php"><button type="button" class="btn btn-sm btn-outline-secondary">home</button></a>
                </div>
              </div>
            </div>
            <form action="cart.php" method="post">
              <input type="hidden" name="pr" value="<?php echo $_SESSION['product_id']; ?>">
              <button class="btn btn-primary w-100 py-2" type="submit">Add Cart</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include 'footer.php'; ?>


