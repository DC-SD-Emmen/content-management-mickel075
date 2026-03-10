<?php
    
    // Start session
    session_start();

    // Check if user is already logged in
    if (isset($_SESSION['user_id'])) {
        header("Location: index.php");
        exit();
    }

    // Include database connection
    require_once 'classes/Database.php';

    // Initialize error variable
    $error = null;

    // Check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['Email'];
        $password = $_POST['Password'];

        // Create database connection
        $database = new Database(); 
        $db = $database->getConnection();

        // Prepare and execute query to check user credentials
        $stmt = $db->prepare("SELECT id, userName, userPassword FROM users WHERE userEmail = ?");
        if ($stmt === false) {
            $error = "Database error. Please try again later.";
        } else if ($stmt->execute([$email])) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $user = null;
        }

        if (!$error && $user && password_verify($password, $user['userPassword'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['userName'];
            $_SESSION['email'] = $email;

            // Redirect to homepage or dashboard after login
            header("Location: index.php");
            exit();
        } else {    
            $error = "Invalid email or password.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Login</h1>

    <?php if (isset($error)): ?>

        <p class="error"><?= htmlspecialchars($error) ?></p>

    <?php endif; ?>

    <form method="POST" action="login.php">

        <label for="Email">Email:</label><br>
        <input type="email" id="Email" name="Email" required><br><br>

        <label for="Password">Password:</label><br>
        <input type="password" id="Password" name="Password" required><br><br>

        <button type="submit">Login</button>
        <button type="button" onclick="window.location.href='register.php'">Register</button>
        <button type="button" onclick="window.location.href='index.php'">Back to Homepage</button>

    </form>
    
</body>
</html>