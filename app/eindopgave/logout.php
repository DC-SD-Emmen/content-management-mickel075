<?php

    // Start session
    session_start();

    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to homepage or login page after logout
    header("Location: index.php");
    exit();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Out Page</title>
</head>
<body>
    
    <h1>You have been logged out.</h1>
    <a href="index.php">Go to Homepage</a>

</body>
</html>