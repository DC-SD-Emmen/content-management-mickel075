<?php

    // add_game.php
    require_once 'classes/database.php';    
    require_once 'classes/game.php';
    require_once 'classes/gamemanager.php';

    // Maak database connectie
    $db = new Database();
    $conn = $db->getConnection();
    $manager = new GameManager($conn);

    // Initialiseer variabelen
    $errors = [];
    $success = "";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Validatie
        $title = trim($_POST['title'] ?? '');
        $genre = trim($_POST['genre'] ?? '');
        $platform = trim($_POST['platform'] ?? '');
        $release_year = $_POST['release_year'];
        $rating = trim($_POST['rating'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $cover_image = $_FILES['cover_image'] ?? null;

        if(!$manager->file_upload($cover_image)) {
            $errors[] = "Error with cover image upload.";
        } else {
            $image_name = $_FILES['cover_image']['name'];
        }

        if ($title === "") {
            $errors[] = "Title is required.";
        }
        if ($genre === "") {
            $errors[] = "Genre is required.";
        }
        if ($platform === "") {
            $errors[] = "Platform is required.";
        }
        if (!is_numeric($rating) || $rating < 1 || $rating > 10) {
            $errors[] = "Please enter a valid rating (1-10).";
        }
        if ($description === "") {
            $errors[] = "Description is required.";
        }
        if ($image_name === "") {
            $errors[] = "Cover image is required.";
        }

        // Als er geen fouten zijn, voeg toe aan database
        if (empty($errors)) {
            try {
                $game = new Game($title, $genre, $platform, $release_year, $rating, $description, $image_name);

                $manager->addGame($game);

                $success = "Game added successfully!:";
            } catch (Exception $e) {
                $errors[] = "Error with adding: " . $e->getMessage();
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>

    <?php if (!empty($errors)): ?>
        <div style="color: red;">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div style="color: green;"><?= htmlspecialchars($success) ?></div>
    <script>
        // Redirect to index.php after successful addition
        setTimeout(function() {
        window.location.replace("index.php");
        }, 500); // 1.5 seconds delay to show success message
    </script>
    <?php endif; ?>

    <!-- Form to add a new game -->
    <h2>Add New Game</h2>
    <form method="post" action="add_game.php" enctype="multipart/form-data">
        <label for="title">Title:</label><br>
        <input type="text" name="title" id="title" required><br><br>
        <label for="genre">Genre:</label><br>
        <input type="text" name="genre" id="genre" required><br><br>
        <label for="platform">Platform:</label><br>
        <input type="text" name="platform" id="platform" required><br><br>
        <label for="release_year">Release Year:</label><br>
        <input type="date" name="release_year" id="release_year" required><br><br>
        <label for="rating">Rating:</label><br>
        <input type="number" name="rating" id="rating" min="1" max="10" required><br><br>
        <label for="description">Description:</label><br>
        <textarea name="description" id="description" required></textarea><br><br>
        <label for="cover_image">Cover Image URL:</label><br>
        <input type="file" name="cover_image" id="cover_image" required><br><br>
        <button type="submit">Add game</button>
        <label for="return"></label>
        <button onclick="location.href='index.php'">Return</button>
    </form>    

</body>
</html>