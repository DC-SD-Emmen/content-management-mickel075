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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
    // $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
    $stmt->execute(['username' => $username, 'password' => $hashedPassword]);

    if ($stmt) {
        echo "Registration successful!";
    } else {
        echo "Registration failed.";
    }
    
} 

?>