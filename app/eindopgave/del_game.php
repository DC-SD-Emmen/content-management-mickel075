<?php

    require_once 'classes/Database.php';
    require_once 'classes/GameManager.php';


    // Get game ID from URL
    $game_id = $_GET['id'];

    // Create database connection
    $Database = new Database();
    $pdo = $Database->getConnection();

    // Fetch game details
    $stmt = $pdo->prepare("SELECT * FROM games WHERE id = ?");
    $stmt->execute([$game_id]);
    $game = $stmt->fetch();
    //hier heb je al een functie voor in gamemanager.php

    // If game not found, redirect to homepage
    if (!$game) {
        header("Location: index.php");
        exit();
    }

    // Redirect to homepage after deletion
    $gamemanager = new GameManager($pdo);
    $gamemanager->deleteGame($game_id);
    header("Location: index.php");
    exit();
    //gamemanager gebruiken om functie aan te roepen om de game te deleten


    // Include database connection
    require_once 'classes/Database.php';

?>