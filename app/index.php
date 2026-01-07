<!-- Registratiepagina:

Maak een HTML-formulier voor registratie met invoervelden voor gebruikersnaam en wachtwoord.
Verstuur de ingevulde gegevens naar een PHP-script voor verwerking. -->

<?php

$host = "mysql"; // de hostnaam van de database server
$user = "root"; // de gebruikersnaam voor de database
$pass = "rootpassword"; // het wachtwoord voor de database
$dbname = "users_login"; // de naam van de database
$charset = "utf8"; // de tekencodering
$port = "3306"; // de poortnummer

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrationpage</title>
    <link rel="stylesheet" href="styles.css">

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