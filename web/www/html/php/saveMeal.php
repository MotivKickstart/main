<?php
require_once('conn.php');
if (isset($_POST['payLoad'])) {
    $pl = $_POST['payLoad'];

    $jsonArray = json_decode($pl, true);
    
    $uName = $_SESSION['name'];
    $uId = $_SESSION['id'];

    $name = $jsonArray['name'];
    $calories = $jsonArray['calories'];
    $fat = $jsonArray['fat'];
    $protein = $jsonArray['protein'];
    $weight = $jsonArray['weight'];

    $sql = "INSERT INTO meal (user_id, name, calories, fat, protein, weight) VALUES
    ((SELECT id FROM user WHERE username='$uName'), ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$name, $calories, $fat, $protein, $weight]);
    $arr = $stmt->errorInfo();
    print_r($arr);

    foreach($jsonArray['ingredients'] as $ingredient){
        $sql = "INSERT INTO ingredient (meal_id, name) VALUES ((SELECT id FROM meal WHERE user_id=(SELECT id FROM user WHERE username='$uName')), ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute(["$ingredient"]);
        $arr = $stmt->errorInfo();
        print_r($arr);
    }
}
