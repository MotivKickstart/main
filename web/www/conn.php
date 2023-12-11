<?
session_start();
$dataArray = array();
$database = "mydb";
$user = "myuser";
$password = "password";
$host = "mysql";

$conn = new PDO("mysql:host={$host};dbname={$database};charset=utf8", $user, $password);

//delete contents and reset AI to 1
// $sql = "DELETE FROM user";
// $stmt = $conn->prepare($sql);
// $stmt->execute();

// $sql = "ALTER TABLE user AUTO_INCREMENT = 1";
// $stmt = $conn->prepare($sql);
// $stmt->execute();
//--------------------------------

$sql = "CREATE TABLE IF NOT EXISTS user (
    id INT NOT NULL AUTO_INCREMENT,
    role_id INT,
    username VARCHAR(45),
    pass VARCHAR(255),
    phone VARCHAR(45),
    email VARCHAR(45),
    PRIMARY KEY (id)
    )";

$stmt = $conn->prepare($sql);
$stmt->execute();
// echo "\nPDOStatement::errorInfo():\n";
// $arr = $stmt->errorInfo();
// print_r($arr);
// echo "<br>";

//test data ---------------------------------------------------
// $user = "admin";
// $pass = password_hash("pass", PASSWORD_DEFAULT);

// $sql = "INSERT INTO user (username, pass) VALUES (?, ?)";
// $stmt = $conn->prepare($sql);
// $stmt->execute([$user, $pass]);
// echo "\nPDOStatement::errorInfo():\n";
// $arr = $stmt->errorInfo();
// print_r($arr);
// echo "<br>";
//-------------------------------------------------------------

$Resultsstmt = $conn->prepare("SELECT * FROM user");
$Resultsstmt->execute();
// echo "\nPDOStatement::errorInfo():\n";
// $arr = $stmt->errorInfo();
// print_r($arr);
// echo "<br>";
// echo $Resultsstmt->fetch();

$Results = [];

while ($result = $Resultsstmt->fetch(PDO::FETCH_ASSOC)) {
    $Results[] = $result;
}

// try {
//     $result = $conn->query("insert into role (name) values (?)");
// } catch (Exception $e) {
//     // We got an exception (table not found)
//     echo "nope";
// }

// echo json_encode(['Results' => $Results], JSON_NUMERIC_CHECK);
