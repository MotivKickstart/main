<?php

session_start();
require_once('conn.php');

if (!isset($_POST['username'], $_POST['password'], $_POST['phone'], $_POST['email'])) {
    exit('Please fill both the username and password fields!');
}


$errors = "";
global $conn;

if (strlen($_POST['password']) < 8) {
    $errors .= "Password too short. ";
}
if (!preg_match("#[0-9]+#", $_POST['password'])) {
    $errors .= "Password must include at least one number. ";
}
if (!preg_match("#[a-zA-Z]+#", $_POST['password'])) {
    $errors .= "Password must include at least one letter. ";
}

$stmt = $conn->prepare('SELECT * FROM user WHERE username = ?');
$stmt->execute([$_POST['username']]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row) {
    $errors .= "Username already exists. ";
}

if (!empty($errors)) {
    $_SESSION['error'] = $errors;
}

if (isset($_SESSION['error'])) {
    header('Location: ../phpregisterForm.php');
    exit;
} else{
    header('Location: ../index.php');
    exit;
}

$id = 2;
$user = $_POST['username'];
$pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
$phone = $_POST['phone'];
$email = $_POST['email'];

$sql = "INSERT INTO user (role_id, username, pass, phone, email) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->execute([$id, $user, $pass, $phone, $email]);

header('Location: registerForm.php');
exit;