<?php

    // 1. Start de sessie (MOET op regel 1 of 2 staan)
    session_start();

    // 2. Start output buffering om 'Headers already sent' te voorkomen
    ob_start();

    require_once 'classes/Database.php';
    require_once 'classes/UserManager.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $database = new Database();
        $userManager = new UserManager($database->getConnection());

        $userName = $_POST['username'];
        $userEmail = $_POST['email'];
        $password = $_POST['password'];
        
        if ($userManager->addUser($userName, $userEmail, $password)) {
            header("Location: login.php"); 
            exit();
        } else {
            $error = "Registration failed. Please try again.";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful</title>
</head>
<body>

    <div class="register">

        <?= htmlspecialchars($userName ?? '') ?>


        <form method="POST" action="register.php">

            <h1>Register</h1>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>

            <button type="submit">Register</button>
            <button type="button" onclick="window.location.href='login.php'">Go to Login</button>
            <button type="button" onclick="window.location.href='index.php'">Go to Home</button>

        </form>
    
    </div>
</body>
</html>