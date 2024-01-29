<?php

// session_start();
require_once("conn.php");

$alarm = $_POST['alarm'];
$protein = $_POST['protein'];
$creatine = $_POST['creatine'];
$uName = $_SESSION['name'];

$weight = $_SESSION['weight'];

$sql = "INSERT INTO schedule (product_id, time) VALUES ((SELECT user_id FROM product WHERE id=(SELECT id FROM user WHERE username='$uName')), ?)";
$stmt = $conn->prepare($sql);
$stmt->execute([$alarm]);
$arr = $stmt->errorInfo();
print_r($arr);

if (isset($protein)) {
    $sql = "INSERT INTO powder (schedule_id, name, weight) VALUES ((SELECT id FROM schedule WHERE product_id=1), ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$protein, 100]);
    $arr = $stmt->errorInfo();
    print_r($arr);
}

if (isset($creatine)) {
    $sql = "INSERT INTO powder (schedule_id, name, weight) VALUES ((SELECT id FROM schedule WHERE product_id=1), ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$creatine, 100]);
    $arr = $stmt->errorInfo();
    print_r($arr);
}
