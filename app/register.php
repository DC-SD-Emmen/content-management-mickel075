<?php
require 'database.php';

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 1. Invoer sanitizen (Schoonmaken van de gebruikersnaam)
    $username = htmlspecialchars(trim($_POST['username']));
    $password = $_POST['password'];

    // 2. Wachtwoord hashen
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // 3. Gegevens opslaan met Prepared Statements
    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
    
    if ($stmt->execute(['username' => $username, 'password' => $hashedPassword])) {
        // 4. Succesvol? Redirect naar index.php met een melding in de URL
        header("Location: index.php?registration=success");
        exit();
    } else {
        echo "Registration failed.";
    }

} 

?>