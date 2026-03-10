<?php

    // Start session
    session_start();

    // Include database connection
    require_once 'classes/Database.php';
    require_once 'classes/UserManager.php';

    // Create database connection
    $Database = new Database();
    $pdo = $Database->getConnection();

    $userManager = new UserManager($pdo);

    // if server method request is post
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get game ID from URL
        $game_id = $_GET['id'];

       //voeg de game met $game_id toe aan de wishlist van de gebruiker met $_SESSION['user_id']
        $userManager->addToWishlist($_SESSION['user_id'], $game_id);

        // Redirect to homepage after adding to wishlist
        header("Location: index.php");
        exit();
    }   

?>