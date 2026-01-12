<!-- Koppeltabel Creatie:

Maak een nieuwe tabel met de naam 'user_games'.
Voeg de volgende kolommen toe aan deze tabel:
'id' (int, auto-increment, primaire sleutel)
'user_id' (int, foreign key naar 'users.id')
'game_id' (int, foreign key naar 'games.id')
 
Koppeltabelvulling:

Vul de koppeltabel met gegevens om relaties tussen gebruikers en games vast te leggen.
Zorg ervoor dat elke gebruiker gekoppeld is aan meerdere games en elke game aan meerdere gebruikers.
 
Query's voor Koppeltabel:

Schrijf SQL-query's om gegevens op te halen die de relaties tussen gebruikers en games weergeven.
Voer query's uit om alle games op te halen die aan een specifieke gebruiker zijn gekoppeld en vice versa. -->

<?php

// Database verbinding maken
$host = 'localhost';
$db = 'jouw_database_naam';
$user = 'username';
$pass = 'password';
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";



?>