<?php

    //autoloader classes
    spl_autoload_register(function ($class_name) {
        include 'classes/' . $class_name . '.php';
    });

    //create database object
    $database = new Database();

    $gm = new GameManager($database->getConnection());

    $games = $gm->getAllGames();

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Game Library</title>

</head>
<body>

    <div class="container">

        <div class="top-right">

            <div class="button-register">

                <!-- Register and Login buttons -->
                <button type="button" onclick="location.href='register.php'">Register</button>

            </div>

            <br>
                
            <div class="button-login">

                <button type="button" onclick="location.href='login.php'">Login</button>

            </div>

        </div>
        
        <div class="header">

            <h1>Game Library</h1>
            <button type="button" onclick="location.href='add_game.php'">Add new game</button>

        </div>

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

    </div>
    
</body>
</html>