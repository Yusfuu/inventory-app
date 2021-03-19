CREATE DATABASE inventory;
USE inventory;

CREATE TABLE employee(
  id int AUTO_INCREMENT PRIMARY KEY,
  name varchar(50) NOT NULL,
  email varchar(50) NOT NULL,
  password varchar(255) NOT NULL,
  img_url varchar(255) DEFAULT 'default.svg'
) ENGINE = InnoDB;

CREATE TABLE product(
  id int AUTO_INCREMENT PRIMARY KEY,
  employee_id int,
  name varchar(50) NOT NULL,
  description TEXT DEFAULT NULL,
  price decimal(10, 2),
  quantity int,
  product_img_url varchar(50),
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY(employee_id) REFERENCES employee(id) ON DELETE CASCADE
) ENGINE = InnoDB;