<?php

ini_set('display_errors', 'off');
session_start();

$conn = new mysqli('localhost', 'root', '', 'register');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $sql = "SELECT image FROM users WHERE email = '$email'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['imagePath'] = $row['image'];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'get_image_path') {
        if (isset($_SESSION['imagePath'])) {
            echo '<img class="nkar" src="' . $_SESSION['imagePath'] . '" alt="Загруженное изображение">';
        } else {
            echo '';
        }
    } elseif (isset($_FILES['image'])) {
        $image = $_FILES['image'];
        $imagePath = 'uploads/' . $_SESSION['email'] . '_' . $image['name'];

        if (move_uploaded_file($image['tmp_name'], $imagePath)) {
            $newEmail = $_SESSION['email'];
            $sql = "UPDATE users SET image = '$imagePath' WHERE email = '$newEmail'";
            if ($conn->query($sql) === true) {
                $_SESSION['imagePath'] = $imagePath;
                echo '<img class="nkar" src="' . $_SESSION['imagePath'] . '" alt="Загруженное изображение">';
            } else {
                echo 'Error: ' . $sql . '<br>' . $conn->error;
            }
        } else {
            echo 'Error uploading the image.';
        }
    }
}

$conn->close();

?>