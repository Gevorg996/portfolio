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
  <title>newpass</title>
</head>
<body>
  <main class="form-signin w-100 m-auto">
    <form class="passform" id="newpassword">

      <div class="form-floating">
        <input type="password" class="form-control" id="newpass" name="newpass">
        <p>New Password</p>
      </div>

      <div class="form-floating">
        <input type="password" class="form-control" id="newpassrep" name="newpassrep">
        <p>Repeat Password</p>
      </div>

      <button class="btn btn-primary w-100 py-2">save password</button>
      <div class="err1"></div>
      <div class="err3"></div>
    </form>
    <div class="backbtn">
      <a href="index2.php"><button class="btn btn-sm btn-outline-secondary">Log In</button></a> 
    </div>

  </main>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="js/js.js"></script>
</html>