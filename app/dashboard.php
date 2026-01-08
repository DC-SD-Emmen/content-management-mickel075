<?php

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php"); // Terugsturen als niet ingelogd
    exit();
}

?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Beveiligd</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Welkom op je Dashboard!</h1>
        <p>Hallo <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>, je bent succesvol ingelogd.</p>
        
        <hr>
        
        <p>Dit is een beveiligde pagina die alleen zichtbaar is voor ingelogde gebruikers.</p>
        
        <a href="logout.php" class="btn-logout">Uitloggen</a>
    </div>
</body>
</html>