<?

$dataArray = array();
$database = "motivData";
$user = "root";
$password = "";
$host = "mysql";

$conn = new PDO("mysql:host={$host};dbname={$database};charset=utf8", $user, $password);
$Resultsstmt = $conn->prepare("SELECT * FROM users");

$Resultsstmt->execute();

$Results = [];

while ($result = $Resultsstmt->fetch(PDO::FETCH_ASSOC)) {
    $Results[] = $result;
}

echo json_encode(['Results' => $Results], JSON_NUMERIC_CHECK);
