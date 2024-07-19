<?php

require_once '../config/auth.php';
require_once '../config/db.php';

if (session_status() ==PHP_SESSION_NONE) {
session_start();
}

redirectIfNotAuthenticated('login.php');

$user_id = $_session['user_id'];

$stmt = $conn->prepare("SELECT name, email FROM users WHERE id = ?");

$stmt ->bind_param("i", $user_id);

$stmt ->execute();

$stmt ->bind_result($name, $email);

$stmt ->fetch();

$stmt->close();

?>

<!DOCTYPE html>
<html>
    <head>
        <title>User Account Details</title>
        <link rel="stylesheet" type="text/cc" href="css/style.css">
</head>

<body class="centered">
    <div class="form-container">
        <h2>User Account Details</h2>
        <p>Name: <?php echo htmlspecialchars($name); ?></p>
        <p>Email: <?php echo htmlspecialchars($email); ?></p>
        <a class="button" href="index.php">Back to Home</a>
</div>
</body>
<html>
    