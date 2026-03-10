<?php

    //require wishlist_game.php
    require_once 'wishlist_game.php';

    //autoloader classes
    spl_autoload_register(function ($class_name) {
        include 'classes/' . $class_name . '.php';
    });

    //create database object
    $database = new Database();

    $gm = new GameManager($database->getConnection());

    // $games = $gm->getAllGames();

    $games = $gm->GetWishlistGames($_SESSION['user_id']);

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
                        <a href="del_game.php?id=<?= htmlspecialchars($game->getId()) ?>" class="btn delete"
                        onclick="return confirm('Are you sure you want to delete this game?');">delete</a>
                    </div>

                </div>

            <?php endforeach; ?>

        </div>
    
</body>
</html>