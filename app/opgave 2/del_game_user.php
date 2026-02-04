<?php

    //Formulier voor het verwijderen van een game en gebruiker
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
                // Verwijderen uit de koppeltabel
                $deleteStmt = $pdo->prepare("DELETE FROM user_games WHERE user_id = :user_id AND game_id = :game_id");
                $deleteStmt->execute([
                    ':user_id' => $user['id'],
                    ':game_id' => $game['id']
                ]);
                echo "Koppeling succesvol verwijderd!";
            } else {
                echo "Gebruiker of game niet gevonden.";
            }
        } catch (PDOException $e) {
            echo "Fout bij verbinden met database: " . $e->getMessage();
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>delete game and user</title>
</head>
<body>

    <form method="POST" action="">
        <label for="username">Gebruikersnaam:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="gamename">Gamenaam:</label>
        <input type="text" id="gamename" name="gamename" required>
        <br>
        <input type="submit" value="Verwijder koppeling">
    
</body>
</html>