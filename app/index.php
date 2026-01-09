<!-- Wachtwoordhashing:

Implementeer PHP-code om het ingevoerde wachtwoord te hashen voordat het wordt opgeslagen in de database.
Gebruik de password_hash() functie voor het hashen van wachtwoorden.
https://www.php.net/manual/en/function.password-hash.php
 
SQL-injectiepreventie:

Gebruik voorbereide SQL-statements om de ingevoerde gegevens veilig in de database in te voegen.
https://www.w3schools.com/php/php_mysql_prepared_statements.asp
Zorg ervoor dat de invoer wordt gesanitized voordat deze in de query wordt gebruikt.
https://www.w3schools.com/php/filter_sanitize_string.asp
 
Inlogpagina:

Maak een HTML-formulier voor inloggen met invoervelden voor gebruikersnaam en wachtwoord.
Verstuur de ingevulde gegevens naar een PHP-script voor verwerking.
 
Inlogverificatie:

Implementeer PHP-code om ingevoerde gebruikersnaam en wachtwoord te controleren tegen de gegevens in de database.
Gebruik de password_verify() functie om het ingevoerde wachtwoord te controleren tegen het gehashte wachtwoord in de database.
https://www.php.net/manual/en/function.password-verify.php
 
Sessiebeheer:

Start een sessie nadat een gebruiker succesvol is ingelogd.
Sla relevante gebruikersgegevens op in de sessievariabelen voor toekomstig gebruik, zoals de gebruikersnaam of ID.
https://www.w3schools.com/php/php_sessions.asp
 
Beveiligde pagina:

Maak een beveiligde pagina waar alleen ingelogde gebruikers toegang toe hebben.
Controleer bij het openen van deze pagina of de gebruiker is ingelogd door sessievariabelen te controleren.
 
Uitlogfunctionaliteit:

Voeg een knop of link toe aan de beveiligde pagina om gebruikers uit te loggen.
Implementeer PHP-code om de sessie te beëindigen en de gebruiker terug te sturen naar de inlogpagina. -->

<?php
require 'database.php'; // Alleen de database, NIET login.php
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <title>Registrationpage</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>

    <div class="container"> 
        <h2>Register</h2>
        <form action="register.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Register</button>
        </form>
        <p>Al een account? <a href="inlog_pagina.php">Log hier in</a></p>
    </div>

</body>
</html>