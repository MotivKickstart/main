<?php
if (isset($_POST['payLoad'])) {
    $pl = $_POST['payLoad'];

    echo "test ";
    echo $pl;

    $jsonArray = json_decode($pl, true);
    $test = $jsonArray["ingredients"][1];
    echo "....";
    echo "$test";

    $database = "mydb";
    $user = "myuser";
    $password = "password";
    $host = "mysql";

    $conn = new PDO("mysql:host={$host};dbname={$database};charset=utf8", $user, $password);

    
} else {
    echo "AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA";
}


?>