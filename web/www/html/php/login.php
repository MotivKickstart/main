<?php
//wut?a
session_start();
require_once('conn.php');

if (!isset($_POST['username'], $_POST['password'])) {
    exit('Please fill both the username and password fields!');
}

if ($stmt = $conn->prepare('SELECT id, pass FROM user WHERE username = ?')) {
    $stmt->execute([$_POST['username']]);

    if ($stmt->rowCount() > 0) {
        $result = $stmt->fetch();

        if (password_verify($_POST['password'], $result['pass'])) {
            session_regenerate_id();
            $_SESSION['loggedin'] = true;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;
            if (isset($_SESSION['error'])) {
                unset($_SESSION['error']);
            }
        } else {
            // Incorrect password
            $_SESSION['error'] = "Incorrect username and/or password";
        }
    } else {
        // Incorrect username
        $_SESSION['error'] = "Incorrect username and/or password";
    }
}

if (isset($_SESSION['loggedin']) || isset($_SESSION['error'])) {
	header('Location: index.php');
	exit;
}
