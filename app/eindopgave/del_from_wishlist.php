<?php

    session_start();
    require_once 'classes/Database.php';
    require_once 'classes/UserManager.php';

    if (isset($_SESSION['user_id']) && isset($_GET['id'])) {
        $database = new Database();
        $userManager = new UserManager($database->getConnection());

        $user_id = (int)$_SESSION['user_id'];
        $game_id = (int)$_GET['id'];

        $userManager->removeFromWishlist($user_id, $game_id);
    }

    // Altijd terug naar de wishlist
    header("Location: wishlist.php");
    exit();

?>