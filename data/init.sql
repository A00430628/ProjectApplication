CREATE DATABASE assignment2;

use assignment2;

CREATE TABLE users (
	id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(30) NOT NULL,
	email VARCHAR(50) NOT NULL,
	phone VARCHAR(10) NOT NULL,
	password VARCHAR(30) NOT NULL,
	date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
