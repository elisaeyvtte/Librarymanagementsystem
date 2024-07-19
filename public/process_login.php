<?php

require_once '../config/db.php';
require_once '../config/auth.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();


    if ($stmt->num_rows > 0) {

        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {

            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            $_SESSION['user_id'] = $id;
            $_SESSION['message'] = "Login successful!";

            header("Location: add_book.php");
            exit();
        } else {

            $_SESSION['message'] = "Invalid password!";

            header("Location: login.php");
            exit();
        }
    } else {
        // Set error message for no user found
        $_SESSION['message'] = "No user found with that email address!";
        // Redirect to login.php page
        header("Location: login.php");
        exit();
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();
}
?>