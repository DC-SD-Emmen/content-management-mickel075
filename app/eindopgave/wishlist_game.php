<?php

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    require_once 'classes/Database.php';
    require_once 'classes/UserManager.php';

    // Controleer of de gebruiker is ingelogd en of er een ID is meegegeven
    if (isset($_SESSION['user_id']) && isset($_GET['id'])) {
        $Database = new Database();
        $pdo = $Database->getConnection();
        $userManager = new UserManager($pdo);

        $game_id = (int)$_GET['id'];
        $user_id = (int)$_SESSION['user_id'];

        // Voeg toe aan de database
        $userManager->addToWishlist($user_id, $game_id);

        // Stuur de gebruiker door naar de wishlist pagina om het resultaat te zien
        header("Location: wishlist.php");
        exit();
    } else {
        // Als er iets mist, terug naar index
        header("Location: index.php");
        exit();
    }

?>