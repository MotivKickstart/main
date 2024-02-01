<?
session_start();
$dataArray = array();
$database = "mydb";
$user = "myuser";
$password = "password";
$host = "mysql";

$conn = new PDO("mysql:host={$host};dbname={$database};charset=utf8", $user, $password);

$Resultsstmt = $conn->prepare("
CREATE TABLE IF NOT EXISTS role (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(45) NULL,
    PRIMARY KEY (id),
    UNIQUE INDEX id_UNIQUE (id ASC));
  
  CREATE TABLE IF NOT EXISTS user (
    id INT NOT NULL AUTO_INCREMENT,
    role_id INT NULL,
    username VARCHAR(45) NULL,
    pass VARCHAR(255) NULL,
    phone VARCHAR(45) NULL,
    email VARCHAR(45) NULL,
    weight INT NULL,
    sport_frequency INT NULL,
    sport_duration INT NULL,
    PRIMARY KEY (id),
    UNIQUE INDEX id_UNIQUE (id ASC),
    CONSTRAINT role_id
      FOREIGN KEY (role_id)
      REFERENCES role (id)
  );
  
  CREATE TABLE IF NOT EXISTS meal (
    id INT NOT NULL AUTO_INCREMENT,
    user_id INT NULL,
    name VARCHAR(45) NULL,
    calories INT NULL,
    fat INT NULL,
    protein INT NULL,
    weight INT NULL,
    date DATE NULL,
    time VARCHAR(45) NULL,
    PRIMARY KEY (id),
    UNIQUE INDEX id_UNIQUE (id ASC),
    CONSTRAINT user_id_meal
      FOREIGN KEY (user_id)
      REFERENCES user (id)
  );
  
  CREATE TABLE IF NOT EXISTS product (
    id INT NOT NULL AUTO_INCREMENT,
    user_id INT NULL,
    name VARCHAR(45) NULL,
    PRIMARY KEY (id),
    UNIQUE INDEX id_UNIQUE (id ASC),
    INDEX user_id_idx (user_id ASC),
    CONSTRAINT user_id_product
      FOREIGN KEY (user_id)
      REFERENCES user (id)
  );
  
  CREATE TABLE IF NOT EXISTS schedule (
    id INT NOT NULL AUTO_INCREMENT,
    product_id INT NULL,
    name VARCHAR(45) NULL,
    date DATE NULL,
    time VARCHAR(45) NULL,
    PRIMARY KEY (id),
    UNIQUE INDEX id_UNIQUE (id ASC),
    CONSTRAINT product_id
      FOREIGN KEY (product_id)
      REFERENCES product (id)
  );
      
  CREATE TABLE IF NOT EXISTS ingredient (
    id INT NOT NULL AUTO_INCREMENT,
    meal_id INT NULL,
    name VARCHAR(255) NOT NULL,
    PRIMARY KEY (id),
    INDEX meal_id_ingredient_idx (meal_id ASC),
    CONSTRAINT meal_id_ingredient
      FOREIGN KEY (meal_id)
      REFERENCES meal (id)
  );
  
  CREATE TABLE IF NOT EXISTS powder (
    id INT NOT NULL AUTO_INCREMENT,
    schedule_id INT NULL,
    name VARCHAR(45) NULL,
    weight INT NULL,
    PRIMARY KEY (id),
    INDEX schedule_id_powder_idx (schedule_id ASC),
    CONSTRAINT schedule_id_powder
      FOREIGN KEY (schedule_id)
      REFERENCES schedule (id)
  );
");

$Resultsstmt->execute();

// ---------Uncomment to add roles---------------
// $name = "user";

// $sql = "INSERT INTO role (name) VALUES (?)";
// $Resultsstmt = $conn->prepare($sql);
// $Resultsstmt->execute([$name]);
// ----------------------------------------------


$Resultsstmt = $conn->prepare("SELECT * FROM user");
$Resultsstmt->execute();

$Results = [];

while ($result = $Resultsstmt->fetch(PDO::FETCH_ASSOC)) {
    $Results[] = $result;
}

// echo json_encode(['Results' => $Results], JSON_NUMERIC_CHECK);
