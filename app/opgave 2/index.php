<!-- Koppeltabel Creatie:

Maak een nieuwe tabel met de naam 'user_games'.
Voeg de volgende kolommen toe aan deze tabel:
'id' (int, auto-increment, primaire sleutel)
'user_id' (int, foreign key naar 'users.id')
'game_id' (int, foreign key naar 'games.id')
 
Koppeltabelvulling:

Vul de koppeltabel met gegevens om relaties tussen gebruikers en games vast te leggen.
Zorg ervoor dat elke gebruiker gekoppeld is aan meerdere games en elke game aan meerdere gebruikers.
 
Query's voor Koppeltabel:

Schrijf SQL-query's om gegevens op te halen die de relaties tussen gebruikers en games weergeven.
Voer query's uit om alle games op te halen die aan een specifieke gebruiker zijn gekoppeld en vice versa. -->

<?php

// Database verbinding maken
$host = 'mysql';
$db = 'database';
$user = 'root';
$pass = 'root';
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Koppeltabel creatie
    $createTableSQL = "
        CREATE TABLE IF NOT EXISTS user_games (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT,
            game_id INT,
            FOREIGN KEY (user_id) REFERENCES users(id),
            FOREIGN KEY (game_id) REFERENCES games(id)
        ) ENGINE=InnoDB;
    ";
    $pdo->exec($createTableSQL);

    // Toon resultaten (optioneel, om te testen)
    echo "Verbinding geslaagd en tabel bijgewerkt!";

    // Koppeltabel vulling
    $insertSQL = "INSERT INTO user_games (user_id, game_id) VALUES (:user_id, :game_id)";
    $stmt = $pdo->prepare($insertSQL);

    // Voorbeeld data invoegen
    $userGamePairs = [
        [1, 1],
        [1, 2],
        [2, 1],
        [2, 3],
        [3, 2],
        [3, 3],
    ];

    foreach ($userGamePairs as $pair) {
        $stmt->execute([':user_id' => $pair[0], ':game_id' => $pair[1]]);
    }

    // Query's voor koppeltabel
    // Alle games ophalen voor een specifieke gebruiker (bijv. user_id = 1)
    $userId = 1;
    $getGamesSQL = "
        SELECT g.*
        FROM games g
        JOIN user_games ug ON g.id = ug.game_id
        WHERE ug.user_id = :user_id
    ";
    $stmt = $pdo->prepare($getGamesSQL);
    $stmt->execute([':user_id' => $userId]);
    $gamesForUser = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Alle gebruikers ophalen voor een specifieke game (bijv. game_id = 2)
    $gameId = 2;
    $getUsersSQL = "
        SELECT u.*
        FROM users u
        JOIN user_games ug ON u.id = ug.user_id
        WHERE ug.game_id = :game_id
    ";
    $stmt = $pdo->prepare($getUsersSQL);
    $stmt->execute([':game_id' => $gameId]);
    $usersForGame = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Fout bij verbinden: " . $e->getMessage();
}

// Voorbeeld gebruiker ophalen voor weergave
$userStmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
$userStmt->execute([':id' => $userId]);
$user = $userStmt->fetch(PDO::FETCH_ASSOC);

// Sluit de databaseverbinding
$pdo = null;


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <!-- button voor het toevoegen van de gamename en username -->
    <button onclick="location.href='add_game_user.php'">Add Game and User</button>
    <h2>Games for User: <?= htmlspecialchars($user['name']) ?></h2>
    

    <table>
        <tr>
            <th>Game Name</th>
            <th>User Name</th>
        </tr>
        <?php foreach ($gamesForUser as $game): ?>
            <tr>
                <td><?= htmlspecialchars($game['name']) ?></td>
                <td><?= htmlspecialchars($user['name']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>