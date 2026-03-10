<?php
    
    require_once 'classes/Database.php';
    require_once 'classes/Game.php';
    require_once 'classes/GameManager.php';


    // Database object aanmaken
    $database = new Database();
    $db = $database->getConnection();

    // GameManager object aanmaken
    $gameManager = new GameManager($db);

    // Haal game ID op uit de querystring
    $game_id = $_GET['id'] ?? null;

    if (!$game_id) {
        echo "No game selected!";
        exit;
    }

    // Gebruik GameManager om een Game object te krijgen
    $game = $gameManager->getGameById($game_id); // verwacht dat deze methode een Game object teruggeeft
    
    if (isset($_POST['update'])) {
    $gameId = $_POST['id'];
    $game = new Game(
        $_POST['title'],
        $_POST['genre'],
        $_POST['platform'],
        $_POST['release_year'],
        $_POST['rating'],
        $_POST['description']
    );
    $game->setId($gameId);

    $gameManager->updateGame($game);

    header('Location: game_details.php?id=' . $gameId);
    exit;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Update Game</title>
</head>
<body>
<form method="post" action="update_game.php?id=<?php echo $game_id; ?>">

    <!-- Update form -->
    <h2>Update Game</h2>
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($game->getId()); ?>">
    <label for="title">title</Title>:</label><br>
    <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($game->getTitle()); ?>" required><br><br>
    <label for="genre">Genre:</label><br>
    <input type="text" name="genre" id="genre" value="<?php echo htmlspecialchars($game->getGenre()); ?>" required><br><br>
    <label for="platform">Platform:</label><br>
    <input type="text" name="platform" id="platform" value="<?php echo htmlspecialchars($game->getPlatform()); ?>" required><br><br>
    <label for="release_year">Release Year:</label><br>
    <input type="date" name="release_year" id="release_year" value="<?php echo htmlspecialchars($game->getReleaseYear()); ?>" required><br><br>
    <label for="rating">Rating:</label><br>
    <input type="number" name="rating" id="rating" min="1" max="10" value="<?php echo htmlspecialchars($game->getRating()); ?>" required><br><br>
    <label for="description">Description:</label><br>
    <textarea name="description" id="description" required><?php echo htmlspecialchars($game && method_exists($game, 'getDescription') ? $game->getDescription() : ''); ?></textarea><br><br>
    <button type="submit" name="update">Update Game</button>

    <div class="anuleer">
        <a href="index.php" class="btn">cancel</a>
    </div>

</form>
</body>
</html>