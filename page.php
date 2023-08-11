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
  <title>myPage</title>
</head>
<body>  
  <div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
      <div class="col-md-3 mb-2 mb-md-0">
        <h1 class="aqua">My Page</h1>
      </div>

      <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="index.php" class="nav-link px-2 link-secondary">Home</a></li>
        <form action="out.php" method="post">
          <button class="btn btn-sm btn-outline-secondary">Log Out</button>
        </form>
      </ul>
    </header>
  </div>

  <div class="album py-5 bg-body-tertiary">
    <div class="container">

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <div class="col">
          <div class="card shadow-sm">

            <?php 

            if (isset($_SESSION['imagePath'])) {
              echo '<img class="userimage" src="' . $_SESSION['imagePath'] . '" class="userimage" alt="Загруженное изображение">';
            } else {
              echo '<h2>add photo</h2>';
            }
            ?>

            <h1 class="username"><?=$_SESSION['name']?></h1>
            <div class="card-body">

              <form class="card-text" id="phoneform">
                <label for="name">phone:</label>
                <input type="tel" name="phone" id="phone" placeholder="number" pattern="[0-9]{11}" required maxlength="11" class="form-control">
                <h3> phone: <?php echo $_SESSION['phone']; ?></h3>
                <button type="submit" class="btn btn-primary w-100 py-2">phone number</button>
              </form>

              <form class="card-text" id="admine">      
                <label for="name">change your name:</label>
                <input type="text" name="adminenewname" id="adminenewname" placeholder="new name" class="form-control">
                <button type="submit" class="btn btn-primary w-100 py-2">change name</button>
                <div class="changename"></div>
              </form>

              <form class="card-text" id="uploadform" enctype="multipart/form-data">
                <input type="file" name="image" id="imageinput" class="form-control" accept="image/*">
                <button id="uploadbutton" class="btn btn-primary w-100 py-2" type="submit">upload image</button>
              </form>

              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="products.php"><button class="btn btn-sm btn-outline-secondary">products</button></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
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




