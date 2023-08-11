<?php

ini_set('display_errors', 'off');
session_start();

if (isset($_POST['payprid'],$_POST['payemail'])) {
	$payprid = $_POST['payprid'];
	$payemail = $_POST['payemail'];
	$conn = new mysqli("localhost", "root", "", "register");
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$newemail = "SELECT * FROM cart_products WHERE cart_id = '$payprid'";
	if ($conn->query($newemail) === true) {
		echo $newemail;
	} 

	$result = mysqli_query($conn, $newemail);
	$row = mysqli_fetch_assoc($result);

	if ($result->num_rows > 0) {
		$payprname = $row['cart_name'];
		$qty = $row['qty'];
		$price = $row['cart_price'];
	}

	$send = $payemail;
	$text = 'Your orders was successfully registered';
	$to = $send;
	$subject = 'Aqua Store';
	$headers = 'From: ' . $send . "\r\n" . 'Replay-To: ' . $send . "\r\n" . 'X-Mailer: PHP/' . phpversion();
	if (mail($to, $subject, $text, $headers)) {
		$me = 'vardgev07@gmail.com';
		$mytext = 'you have a new order';
		$to = $me;
		$sub = 'Aqua Store';
		$header = 'From: ' . $me . "\r\n" . 'Replay-To: ' . $me . "\r\n" . 'X-Mailer: PHP/' . phpversion();
		if (mail($to, $sub, $mytext, $header)) {
			echo 'success';
		} 
	} 

}


?>