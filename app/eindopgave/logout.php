<?php

    // Start session
    session_start();

    // Check if logout form was submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Unset all session variables
        $_SESSION = array();

        // Destroy the session
        session_destroy();

        // Redirect to homepage or login page after logout
        header("Location: index.php");
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Out Page</title>
</head>
<body>
    
    <form action="logout.php" method="post">
        <button type="submit">Log Out</button>
        <button type="button" onclick="window.location.href='index.php'">Cancel</button>
    </form>

</body>
</html>