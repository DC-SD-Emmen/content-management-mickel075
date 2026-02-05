<?php

    $session_start();

    $_SESSION['user_id'] = $userID;
    $_SESSION['username'] = $userName;
    $_SESSION['email'] = $userEmail;

    // Redirect to homepage or dashboard after registration
    header("Location: index.php");

    exit();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful</title>
</head>
<body>

    <h1>Registration Successful!</h1>
    <p>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>! Your registration was successful.</p>
    <a href="index.php">Go to Homepage</a>
    
</body>
</html>