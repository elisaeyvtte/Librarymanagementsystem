<?php

ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "Library_management_system"; 
 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
function create_tables($conn) {
  
$sql = "
CREATE TABLE IF NOT EXISTS users (
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(255) NOT NULL,
email VARCHAR(255) NOT NULL UNIQUE,
password VARCHAR(255) NOT NULL
);
CREATE TABLE IF NOT EXISTS books (
id INT AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(255) NOT NULL,
author VARCHAR(255) NOT NULL,
isbn VARCHAR(13) NOT NULL UNIQUE,
available BOOLEAN DEFAULT TRUE
);
CREATE TABLE IF NOT EXISTS borrowed_books (
id INT AUTO_INCREMENT PRIMARY KEY,
user_id INT NOT NULL,
book_id INT NOT NULL,
borrowed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
returned_at TIMESTAMP NULL,
FOREIGN KEY (user_id) REFERENCES users(id),
FOREIGN KEY (book_id) REFERENCES books(id)
);
";
try {

if ($conn->multi_query($sql) === TRUE) {

while ($conn->more_results() && $conn->next_result());
echo "Tables created successfully";
} else {
throw new Exception("Error creating tables: " . $conn->error);
}
} catch (Exception $e) {
echo $e->getMessage();
} finally {
    $conn->close();
    }
    }
