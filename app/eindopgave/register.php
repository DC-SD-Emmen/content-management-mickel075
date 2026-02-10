<?php

    require_once 'classes/Database.php';
    require_once 'classes/User.php';
    require_once 'classes/UserManager.php';

    // 1. Start de sessie (MOET op regel 1 of 2 staan)
    session_start();

    // 2. Start output buffering om 'Headers already sent' te voorkomen
    ob_start();

    // Database verbinding (of gebruik je db.php)
    $host = 'mysql';
    $db   = 'database';
    $user = 'root';
    $pass = 'root';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $userName  = $_POST['username'] ?? '';
            $userEmail = $_POST['email'] ?? '';
            $password  = password_hash($_POST['password'], PASSWORD_DEFAULT); // Veilig opslaan!

            // 3. Gegevens opslaan in de database
            $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['username' => $userName, 'password' => $password]);

            // 4. SESSIE GEBRUIKEN: Sla de naam op voor later gebruik (bijv. op de profielpagina)
            $_SESSION['user_id'] = $pdo->lastInsertId();
            $_SESSION['username'] = $userName;
            $_SESSION['is_logged_in'] = true;

            // 5. Redirect naar de login of dashboard
            header("Location: login.php");
            exit();
        }
    } catch (PDOException $e) {
        echo "Fout: " . $e->getMessage();
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

    <h1>Registration Successful!</h1>
    <p>Welcome, <?= htmlspecialchars($userName ?? '') ?>! Your registration was successful.</p>
    <a href="index.php">Go to Homepage</a>
    
</body>
</html>