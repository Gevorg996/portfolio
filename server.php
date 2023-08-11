<?php

ini_set('display_errors', 'off');
session_start();

class Model {
	private $db;
	public function __construct(){
		$this->db = new mysqli("localhost", "root", "", "register");
		if (isset($_POST['action'])) {
			call_user_func([$this, $_POST['action']]);
		}
	}

	public function ajax(){
		$name = $_POST['name'];
		$_SESSION['name'] = $name;
		$email = $_POST['email'];
		$pass = md5($_POST['pass']);
		foreach (($this->db->query("SELECT email FROM users")->fetch_all(true)) as $value) {
			if ($email === $value['email']) {
				echo "oldemail";
				die();
			}
		}
		$this->db->query("INSERT INTO users(name, email, password) VALUES ('$name', '$email', '$pass')");
	}
	
	public function ajax1(){
		$logemail = $_POST['logemail'];
		$_SESSION['email'] = $logemail;
		$logpass = md5($_POST['logpass']);
		$query = "SELECT * FROM users WHERE email = '$logemail' AND password = '$logpass'";
		$result = $this->db->query($query);


		if ($result->num_rows > 0) {
			echo "welcome";
		} else {
			echo "uncorect email or pass";
			
		}

		$sql = "SELECT name , image FROM users WHERE email = '$logemail'";
		$res = $this->db->query($sql);

		if ($res->num_rows > 0) {
			$row = $res->fetch_assoc();
			$name = $row['name'];
			$image = $row['image'];
			$_SESSION['name'] = $name;
			$_SESSION['imagePath'] = $image;
		} else {
			echo "no name";
		}

	}
	public function ajax2(){
		$send = $_POST['send'];
		$text = $_POST['text'];
		$_SESSION['code'] = $text;
		$_SESSION['email'] = $send;

		$to = $send;
		$subject = 'text';
		$headers = 'From: ' . $send . "\r\n" . 'Replay-To: ' . $send . "\r\n" . 'X-Mailer: PHP/' . phpversion();
		if (mail($to, $subject, $text, $headers)) {
			echo "successss";
		} else {
			echo "noooooooo";
		}

	}


	public function ajax3(){
		$userscode = $_POST['forget'];
		if ($userscode == $_SESSION['code']) {
			echo "chisht kod";
		}else {
			echo "sxal kod";
		}
	}


	public function ajax4(){
		$newpass = $_POST['newpass'];
		$newpass = md5($newpass);
		$newEmail = $_SESSION['email'];
		
		$this->db->query("UPDATE users SET password ='$newpass' WHERE email = '$newEmail'");
		echo 'true';
	}



	public function ajax6(){
		$newname = $_POST['newname'];
		$sesemail = $_SESSION['email'];

		$this->db->query("UPDATE users SET name ='$newname' WHERE email = '$sesemail'");
		echo 'good';
		$_SESSION['name'] = $newname;
		
	}

	public function ajax11()
	{
		$phone = $_POST['phone'];
		$ses = $_SESSION['email'];
		$this->db->query("UPDATE users SET phone ='$phone' WHERE email = '$ses'");


		$phone = $this->getPhone();
		$_SESSION['phone'] = $phone;
	}

	public function getPhone()
	{
		$ses = $_SESSION['email'];
		$result = $this->db->query("SELECT phone FROM users WHERE email = '$ses'");
		if ($result && $result->num_rows > 0) {
			$row = $result->fetch_assoc();
			return $row['phone'];
		} else {
			return "write your phone number";
		}
	}

}

$obj = new Model;



?>
