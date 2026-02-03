<?php
//Formulier voor het toevoegen van een game en gebruiker
ob_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $host = 'mysql';
    $db = 'database';
    $user = 'root';
    $pass = 'root';
    $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

    try {
        $pdo = new PDO($dsn, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Gegevens uit het formulier ophalen
        $username = $_POST['username'];
        $gamename = $_POST['gamename'];

        // User ID ophalen
        $userStmt = $pdo->prepare("SELECT id FROM users WHERE username = :username");
        $userStmt->execute([':username' => $username]);
        $user = $userStmt->fetch(PDO::FETCH_ASSOC);

        // Game ID ophalen
        $gameStmt = $pdo->prepare("SELECT id FROM games WHERE title = :gamename");
        $gameStmt->execute([':gamename' => $gamename]);
        $game = $gameStmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $game) {
            // Invoegen in de koppeltabel
            $insertStmt = $pdo->prepare("INSERT INTO user_games (user_id, game_id) VALUES (:user_id, :game_id)");
            $insertStmt->execute([
                ':user_id' => $user['id'],
                ':game_id' => $game['id']
            ]);
            echo "Koppeling succesvol toegevoegd!";
        } else {
            echo "Gebruiker of game niet gevonden.";
        }
    } catch (PDOException $e) {
        echo "Fout bij verbinden met database: " . $e->getMessage();
    }

    if ($user && $game) {
        // Redirect naar index.php na succesvolle toevoeging
        header("Location: index.php");
        exit;
    }

    // Sluit de databaseverbinding
    $pdo = null;
    exit;;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add game and user</title>
</head>
<body>

    <h2>Add Game and User</h2>
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="gamename">Game Name:</label>
        <input type="text" id="gamename" name="gamename" required><br><br>

        <input type="submit" value="Add" onclick ="alert('Game and User added successfully!')">
        <input type="button" value="Back" onclick="window.location.href='index.php'">
    </form>
    
</body>
</html>