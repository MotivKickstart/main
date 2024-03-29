<?php

session_start();
require_once('conn.php');

if (!isset($_POST['username'], $_POST['password'], $_POST['email'], $_POST['sportFrequency'], $_POST['sportDuration'])) {
    exit('Please fill all fields!');
}


$errors = "";

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
    header('Location: ../registerForm.php');
    exit;
}
$user = $_POST['username'];
$pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
$phone = $_POST['phone'];
$email = $_POST['email'];
$freq = $_POST['sportFrequency'];
$dur = $_POST['sportDuration'];

$sql = "INSERT INTO user (role_id, username, pass, email, sport_frequency, sport_duration) VALUES ((SELECT id FROM role WHERE name='user'), ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->execute([$user, $pass, $email, $freq, $dur]);
$_SESSION['status1'] = $stmt->errorInfo();
$_SESSION['status2'] = $stmt->fetch();

header('Location: ../registerForm.php');
exit;