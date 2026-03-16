<?php

    // // // 1. ALTIJD als eerste de sessie starten!
    // // session_start();

    // // require wishlist_game.php
    // require 'wishlist_game.php';

    // // autoloader classes
    // spl_autoload_register(function ($class_name) {
    //     include 'classes/' . $class_name . '.php';
    // });

    // // 2. Controleer of de sessie wel gevuld is
    // if (!isset($_SESSION['user_id'])) {
    //     // Gebruiker is niet ingelogd, stuur ze naar de loginpagina
    //     header("Location: login.php");
    //     exit();
    // }

    // // create database object
    // $database = new Database();
    // $gm = new GameManager($database->getConnection());

    // // Nu is het veilig om de ID te gebruiken
    // $games = $gm->GetWishlistGames((int)$_SESSION['user_id']);

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Haal de require 'wishlist_game.php' hier weg!

    spl_autoload_register(function ($class_name) {
        include 'classes/' . $class_name . '.php';
    });

    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    $database = new Database();
    $gm = new GameManager($database->getConnection());
    $games = $gm->GetWishlistGames((int)$_SESSION['user_id']);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

        <!-- Nieuwe wrapper voor je grid -->
        <div class="library">

            <!-- Hier komen je cards -->
            <?php foreach ($games as $game): ?>

                <div class="card">
                    <img src="./images/<?= htmlspecialchars($game->getImageName()) ?>" alt="Cover of <?= htmlspecialchars($game->getTitle()) ?>" class="cover-image">

                    <div class="actions">
                        <a href="game_details.php?id=<?= htmlspecialchars($game->getId()) ?>" class="btn">See details</a>
                        <a href="update_game.php?id=<?= htmlspecialchars($game->getId()) ?>" class="btn">Update game</a>
                        <a href="del_from_wishlist.php?id=<?= htmlspecialchars($game->getId()) ?>" class="btn delete"
                            onclick="return confirm('Weet je zeker dat je deze game uit JE WISHLIST wilt verwijderen?');">
                            remove from wishlist
                        </a>
                    </div>

                </div>

            <?php endforeach; ?>

        </div>
    
</body>
</html>