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

$host = "mysql"; // de hostnaam van de database server
$user = "root"; // de gebruikersnaam voor de database
$pass = "root"; // het wachtwoord voor de database
$dbname = "database"; // de naam van de database
$charset = "utf8"; // de tekencodering
$port = "3306"; // de poortnummer

$dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// password_hash(#[\SensitiveParameter] string $password, string|int|null $algo, array $options = []): string

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrationpage</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>

    <!-- div container -->
    <div class="container"> 

        <h2>Register</h2>

        <!-- formulier voor het registreren van de user -->
        <form action="register.php" method="POST">

            <label for="username">username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Register</button>

        </form>

    </div>

</body>
</html>