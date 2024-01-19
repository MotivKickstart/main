<?
session_start();
$dataArray = array();
$database = "mydb";
$user = "myuser";
$password = "password";
$host = "mysql";

// mysql_connect('myserver', 'user', 'password')
// $table = mysql-list-tables("database");


$conn = new PDO("mysql:host={$host};dbname={$database};charset=utf8", $user, $password);

//delete contents and reset AI to 1
// $sql = "DELETE FROM user";
// $stmt = $conn->prepare($sql);
// $stmt->execute();

// $sql = "ALTER TABLE user AUTO_INCREMENT = 1";
// $stmt = $conn->prepare($sql);
// $stmt->execute();
//--------------------------------

// $sql = "CREATE TABLE IF NOT EXISTS user (
//     id INT NOT NULL AUTO_INCREMENT,
//     role_id INT,
//     username VARCHAR(45),
//     pass VARCHAR(255),
//     phone VARCHAR(45),
//     email VARCHAR(45),
//     PRIMARY KEY (id)
//     )";

// $sql = "DROP TABLE user";

// $stmt = $conn->prepare($sql);
// $stmt->execute();
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

// $script_path = "C:\Users\ossem1\OneDrive - Hogeschool Rotterdam\SmartThings\kickstarterProject\main\database\motiv.sql";

// $command = "mysql --user={$vals['db_user']} --password='{$vals['db_pass']}' "
//  . "-h {$vals['db_host']} -D {$vals['db_name']} < {$script_path}";

// $output = shell_exec($command . '/shellexec.sql');

// function debug_to_console($data) {
//     $output = $data;
//     if (is_array($output))
//         $output = implode(',', $output);

//     echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
// }

// debug_to_console($output);

// $Resultsstmt = $conn->prepare("
// CREATE TABLE role (
//     id INT NOT NULL AUTO_INCREMENT,
//     name VARCHAR(45) NULL,
//     PRIMARY KEY (id),
//     UNIQUE INDEX id_UNIQUE (id ASC));
  
//   CREATE TABLE user (
//     id INT NOT NULL AUTO_INCREMENT,
//     role_id INT NULL,
//     username VARCHAR(45) NULL,
//     password VARCHAR(45) NULL,
//     phone VARCHAR(45) NULL,
//     email VARCHAR(45) NULL,
//     weight INT NULL,
//     PRIMARY KEY (id),
//     UNIQUE INDEX id_UNIQUE (id ASC),
//     UNIQUE INDEX role_id_UNIQUE (role_id ASC),
//     CONSTRAINT role_id
//       FOREIGN KEY (role_id)
//       REFERENCES role (id)
//   );
  
//   CREATE TABLE meal (
//     id INT NOT NULL AUTO_INCREMENT,
//     user_id INT NULL,
//     name VARCHAR(45) NULL,
//     calories INT NULL,
//     fat INT NULL,
//     protein INT NULL,
//     weight INT NULL,
//     date DATE NULL,
//     time VARCHAR(45) NULL,
//     PRIMARY KEY (id),
//     UNIQUE INDEX id_UNIQUE (id ASC),
//     UNIQUE INDEX user_id_UNIQUE (user_id ASC),
//     CONSTRAINT user_id_meal
//       FOREIGN KEY (user_id)
//       REFERENCES user (id)
//   );
  
//   CREATE TABLE product (
//     id INT NOT NULL AUTO_INCREMENT,
//     user_id INT NULL,
//     name VARCHAR(45) NULL,
//     PRIMARY KEY (id),
//     UNIQUE INDEX id_UNIQUE (id ASC),
//     INDEX user_id_idx (user_id ASC),
//     CONSTRAINT user_id_product
//       FOREIGN KEY (user_id)
//       REFERENCES user (id)
//   );
  
//   CREATE TABLE schedule (
//     id INT NOT NULL AUTO_INCREMENT,
//     product_id INT NULL,
//     name VARCHAR(45) NULL,
//     date DATE NULL,
//     time VARCHAR(45) NULL,
//     PRIMARY KEY (id),
//     UNIQUE INDEX id_UNIQUE (id ASC),
//     UNIQUE INDEX product_id_UNIQUE (product_id ASC),
//     CONSTRAINT product_id
//       FOREIGN KEY (product_id)
//       REFERENCES product (id)
//   );
      
//   CREATE TABLE ingredient (
//     id INT NOT NULL AUTO_INCREMENT,
//     meal_id INT NULL,
//     name VARCHAR(45) NOT NULL,
//     PRIMARY KEY (id),
//     INDEX meal_id_ingredient_idx (meal_id ASC),
//     CONSTRAINT meal_id_ingredient
//       FOREIGN KEY (meal_id)
//       REFERENCES meal (id)
//   );
  
//   CREATE TABLE powder (
//     id INT NOT NULL AUTO_INCREMENT,
//     schedule_id INT NULL,
//     name VARCHAR(45) NULL,
//     weight INT NULL,
//     PRIMARY KEY (id),
//     INDEX schedule_id_powder_idx (schedule_id ASC),
//     CONSTRAINT schedule_id_powder
//       FOREIGN KEY (schedule_id)
//       REFERENCES schedule (id)
//   );
// ");


// $Resultsstmt->execute();
// echo "\nPDOStatement::errorInfo():\n";
// $arr = $Resultsstmt->errorInfo();
// print_r($arr);
// echo "<br>";
// echo $Resultsstmt->fetch();

$Resultsstmt = $conn->prepare("SELECT * FROM user");
$Resultsstmt->execute();
// echo "\nPDOStatement::errorInfo():\n";
// $arr = $Resultsstmt->errorInfo();
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
