<?php

session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register - Library Management System</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body class="centered">
    <div class="form-container">
        <h2>Register</h2>
 
        <form method="POST" action="register.php">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>
            <button type="submit">Register</button>
        </form>
        <div>

            <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            }
            ?>
        </div>
    </div>
</body>
</html>

<?php

require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $password);


    if ($stmt->execute()) {

        $_SESSION['user_id'] = $stmt->insert_id;
        $_SESSION['message'] = "Registration successful!";

        header("Location: add_book.php");
        exit();
    } else {

        $_SESSION['message'] = "Error: " . $stmt->error;

        header("Location: register.php");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
