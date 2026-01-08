<?php
session_start();    // Start de sessie om deze te kunnen stoppen
session_unset();    // Maak alle sessie-variabelen leeg
session_destroy();  // Vernietig de sessie volledig

// Stuur de gebruiker terug naar de inlogpagina
header("Location: index.php");
exit();
?>