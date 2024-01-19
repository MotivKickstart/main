CREATE TABLE role (
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(45) NULL,
  PRIMARY KEY (id),
  UNIQUE INDEX id_UNIQUE (id ASC) VISIBLE)

CREATE TABLE user (
  id INT NOT NULL AUTO_INCREMENT,
  role_id INT NULL,
  username VARCHAR(45) NULL,
  password VARCHAR(45) NULL,
  phone VARCHAR(45) NULL,
  email VARCHAR(45) NULL,
  weight INT NULL,
  PRIMARY KEY (id),
  UNIQUE INDEX id_UNIQUE (id ASC) VISIBLE,
  UNIQUE INDEX role_id_UNIQUE (role_id ASC) VISIBLE,
  CONSTRAINT role_id
    FOREIGN KEY (role_id)
    REFERENCES role (id)
)

CREATE TABLE meal (
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
  UNIQUE INDEX id_UNIQUE (id ASC) VISIBLE,
  UNIQUE INDEX user_id_UNIQUE (user_id ASC) VISIBLE,
  CONSTRAINT user_id_meal
    FOREIGN KEY (user_id)
    REFERENCES user (id)
)

CREATE TABLE product (
  id INT NOT NULL AUTO_INCREMENT,
  user_id INT NULL,
  name VARCHAR(45) NULL,
  PRIMARY KEY (id),
  UNIQUE INDEX id_UNIQUE (id ASC) VISIBLE,
  INDEX user_id_idx (user_id ASC) VISIBLE,
  CONSTRAINT user_id_product
    FOREIGN KEY (user_id)
    REFERENCES user (id)
)

CREATE TABLE schedule (
  id INT NOT NULL AUTO_INCREMENT,
  product_id INT NULL,
  name VARCHAR(45) NULL,
  date DATE NULL,
  time VARCHAR(45) NULL,
  PRIMARY KEY (id),
  UNIQUE INDEX id_UNIQUE (id ASC) VISIBLE,
  UNIQUE INDEX product_id_UNIQUE (product_id ASC) VISIBLE,
  CONSTRAINT product_id
    FOREIGN KEY (product_id)
    REFERENCES product (id)
)
	
CREATE TABLE ingredient (
  id INT NOT NULL AUTO_INCREMENT,
  meal_id INT NULL,
  name VARCHAR(45) NOT NULL,
  PRIMARY KEY (id),
  INDEX meal_id_ingredient_idx (meal_id ASC) VISIBLE,
  CONSTRAINT meal_id_ingredient
    FOREIGN KEY (meal_id)
    REFERENCES meal (id)
)

CREATE TABLE powder (
  id INT NOT NULL AUTO_INCREMENT,
  schedule_id INT NULL,
  name VARCHAR(45) NULL,
  weight INT NULL,
  PRIMARY KEY (id),
  INDEX schedule_id_powder_idx (schedule_id ASC) VISIBLE,
  CONSTRAINT schedule_id_powder
    FOREIGN KEY (schedule_id)
    REFERENCES schedule (id)
)



