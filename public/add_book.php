<?php
require_once '../config/db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$title = $_POST['title'];
$author = $_POST['author'];
$isbn = $_POST['isbn'];
$stmt = $conn->prepare("INSERT INTO books (title, author, isbn) VALUES
(?, ?, ?)");
$stmt->bind_param("sss", $title, $author, $isbn);
if ($stmt->execute()) {
echo "Book added successfully!";
} else {
echo "Error: " . $stmt->error;
}
$stmt->close();
$conn->close();
}
