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
  <title>register</title>
</head>
<body>
  <a href="index2.php"><button class="btn btn-primary rounded-pill px-3">Log In</button></a>	
  <form id="regform">
    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

    <div class="form-floating">
      <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name" required>
      <label for="name">Name</label>
    </div>

    <div class="form-floating">
      <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
      <label for="email">Email address</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" name="pass" id="pass" placeholder="Enter Password" required>
      <label for="pass">Password</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" name="passRepeat" id="passRepeat" placeholder="Repeat Password" required>
      <label for="pass">Password</label>
    </div>

    
    <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-body-secondary">© aqua store 2023</p>
  </form>
  <div class="err"></div>		
  
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="js/js.js"></script>
</html>