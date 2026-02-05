<?php
    ob_start(); // Start output buffering

    // Include database connection
    require_once 'classes/Database.php';

    // Get game ID from URL
    $game_id = $_GET['id'];

    // Create database connection
    $db = new Database();
    $pdo = $db->getConnection();

    // Fetch game details
    $stmt = $pdo->prepare("SELECT * FROM games WHERE id = ?");
    $stmt->execute([$game_id]);
    $game = $stmt->fetch();

    // If game not found, redirect to homepage
    if (!$game) {
    header("Location: index.php");
    exit();
    }

    // Update game button (only if POST and all fields are set and action is update)
    if (
        $_SERVER['REQUEST_METHOD'] === 'POST' &&
        isset($_POST['action']) && $_POST['action'] === 'update' &&
        isset($_POST['title'], $_POST['genre'], $_POST['platform'], $_POST['release_year'], $_POST['rating'], $_POST['beschrijving'], $_POST['id']) &&
        $_POST['id'] == $game_id
    ) {
        $stmt = $pdo->prepare("UPDATE games SET title = ?, genre = ?, platform = ?, release_year = ?, rating = ?, beschrijving = ? WHERE id = ?");
        $stmt->execute([
            $_POST['title'],
            $_POST['genre'],
            $_POST['platform'],
            $_POST['release_year'],
            $_POST['rating'],
            $_POST['beschrijving'],
            $game_id,
        ]);

        // Redirect to homepage after update
        header("Location: index.php");
        exit();
    }

    // Delete game button
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete' && isset($_POST['id']) && $_POST['id'] == $game_id) {
        $stmt = $pdo->prepare("DELETE FROM games WHERE id = ?");
        $stmt->execute([$game_id]);
        header("Location: index.php");
        exit();
    }
    ob_end_flush(); // Flush output buffer
    // HTML output starts here

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $game['title']; ?></title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
    <meta name="beschrijving" content="<?php echo isset($game['beschrijving']) ? htmlspecialchars($game['beschrijving']) : ''; ?>">
    <link rel="icon" type="image/x-icon" href="favicon.ico">

</head>
<body>
<form method="post" action="game_details.php?id=<?php echo $game_id; ?>">

    <!-- Display game details -->
    <h1><?php echo htmlspecialchars($game['title']); ?></h1>
    <p><strong>Genre:</strong> <?php echo htmlspecialchars($game['genre']); ?></p>
    <p><strong>Platform:</strong> <?php echo htmlspecialchars($game['platform']); ?></p>
    <p><strong>Release Jaar:</strong> <?php echo htmlspecialchars($game['release_year'] ?? 'Onbekend'); ?></p>
    <p><strong>Rating:</strong> <?php echo htmlspecialchars($game['rating'] ?? 'Onbekend'); ?></p>
    <p><strong>Beschrijving:</strong> <?php echo htmlspecialchars($game['beschrijving'] ?? 'Geen beschrijving beschikbaar.'); ?></p>
    <?php if (!empty($game['cover_image'])): ?>
        <img src="<?php echo htmlspecialchars($game['cover_image']); ?>" alt="Cover Image" style="max-width:200px;">
    <?php endif; ?>

    <!-- Hidden fields to identify the game and action -->
    <input type="hidden" name="id" value="<?php echo $game_id; ?>">
    <input type="hidden" name="action" value="update">
    
    <br>

    <div class="returntoindex">
    <!-- return to overview link -->
    <a href="index.php?id=<?= htmlspecialchars($game['id']) ?>" class="btn">return to index</a>
    </div>

</form>
</body>
</html>