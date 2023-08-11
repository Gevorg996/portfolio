<?php
ini_set('display_errors', 'off');
session_start();

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
		$_SESSION['user_id'] = $idrow['usersID'];
	}
}
$conn2->close();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	if (isset($_POST["pr"])) {
		$pr = $_POST["pr"];
		$qty = 1;
		if (isset($_SESSION['user_id'])) {
			$userid = $_SESSION['user_id'];
			$conn = new mysqli("localhost", "root", "", "register");
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}

			$mysql = "SELECT product_name, product_price, product_image, user_id FROM products WHERE product_id = '$pr'";
			$result = mysqli_query($conn, $mysql);
			$row = mysqli_fetch_assoc($result);

			if ($result->num_rows > 0) {
				$pr_name = $row['product_name'];
				$pr_price = $row['product_price'];
				$pr_image = $row['product_image'];

				$sql = "INSERT INTO cart_products (cart_user_id, cart_product_id, cart_name, cart_price, cart_image, qty)
				VALUES ('$userid', '$pr', '$pr_name', '$pr_price', '$pr_image', '$qty')";
				if ($conn->query($sql) === TRUE) {
					header("Location: cart.php");
					exit();
				} else {
					echo "Error: " . $sql . "<br>" . $conn->error;
				}

			}
		}
	}
}
?>


<?php include 'header.php'; ?>
<link rel="stylesheet" type="text/css" href="styles/cart.css">

<!-- Home -->

<div class="home">
	<div class="home_container">
		<div class="home_background" style="background-image:url(images/7.jpg)"></div>
	</div>
</div>

<?php

$connection = new mysqli("localhost", "root", "", "register");
if ($connection->connect_error) {
	die("Connection failed: " . $connection->connect_error);
}
if (isset($_SESSION['user_id'])) {
	$users_id = $_SESSION['user_id'];
	$cartsql = "SELECT * FROM cart_products WHERE cart_user_id = '$users_id'";
	$cartresult = mysqli_query($connection, $cartsql);
	while ($cartrow = mysqli_fetch_assoc($cartresult)) {

		?>

		<?php

		$conncount = new mysqli("localhost", "root", "", "register");
		if ($conncount->connect_error) {
			die("Ошибка подключения: " . $conncount->connect_error);
		}


		$countid = $cartrow['cart_product_id'];
		$sqlcount = "SELECT qty, cart_price FROM cart_products WHERE cart_product_id = '$countid'";
		$resultcount = $conncount->query($sqlcount);
		if ($resultcount->num_rows > 0) {
			while ($rowcount = $resultcount->fetch_assoc()) {
				$_SESSION['countcart'] = $rowcount['qty'];

			}
		}

		$conncount->close();
		?>

		<div class="cart_item d-flex flex-lg-row flex-column align-items-lg-center align-items-center justify-content-center my">
			<!-- Name -->
			<div class="cart_item_product d-flex flex-row align-items-center justify-content-center">
				<div class="cart_item_image">
					<div><img src="images/<?php echo $cartrow['cart_image']; ?>" class="nkar" alt="nkar"></div>
				</div>
				<div class="cart_item_name_container">
					<div class="cart_item_name"><a href="#"><?php echo $cartrow['cart_name']; ?></a></div>
					<div class="cart_item_edit"><a href="#">Edit Product</a></div>
				</div>
			</div>
			<!-- Price -->
			<div class="cart_item_price"><?php echo $cartrow['cart_price']; ?></div>

			<!-- Quantity -->
			<div class="cart_item_quantity">

				<div class="product_quantity_container">
					<form class="product_quantity clearfix">
						<input type="hidden" name="cart_id" value="<?php echo $cartrow['cart_product_id']; ?>">
						<input class="qtyform" type="number" pattern="[0-9]*" value="<?php echo $_SESSION['countcart']; ?>">
						<button class="mybtn save-btn" type="submit">save</button>
					</form>
				</div>
			</div>


			<?php

			$payconn = new mysqli("localhost", "root", "", "register");
			if ($payconn->connect_error) {
				die("Connection failed: " . $payconn->connect_error);
			}

			$payid = $cartrow['cart_product_id'];


			$paymysql = "SELECT cart_id FROM cart_products WHERE cart_product_id = '$payid'";
			$payresult = mysqli_query($payconn, $paymysql);
			$payrow = mysqli_fetch_assoc($payresult);

			if ($payresult->num_rows > 0) {
				$_SESSION['payprid'] = $payrow['cart_id'];

			}

			?>

			<div class="row row_cart_buttons">
				<div class="col">
					<div class="cart_buttons d-flex flex-lg-row flex-column align-items-start justify-content-start">

						<form action="deletecart.php" method="post" class="cart_buttons_right ml-lg-auto">
							<input type="hidden" name="delete_product_id" value="<?php echo $cartrow['cart_product_id']; ?>">
							<button type="submit" class="button clear_cart_button" name="delete_product_button">Delete</button>
						</form>
					</div>
				</div>
			</div>
		</div>

		<?php
	}
}
?>

<div class="pay">
	<form class="payment">
		<h4>Payment Method</h4>
		<input type="radio" name="paymentMethod" class="creditCard" required> Credit Card<br>
		<input type="radio" name="paymentMethod" class="cash" required> Cash<br>
		<input type="email" class="form-control payemail" name="payemail" placeholder="Enter Email" required>
		<input type="submit" value="To Order" class="submit_button btn btn-primary w-100 py-2">
		<h4 class="conf"></h4>
		<input type="hidden" name="payprid" value="<?php echo $_SESSION['payprid']; ?>">
	</form>
</div>

<?php include 'footer.php'; ?>