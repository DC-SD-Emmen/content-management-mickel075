<?php
// db.php
$host = "mysql";
$user = "root";
$pass = "root";
$dbname = "database";
$dsn = "mysql:host=$host;port=3306;dbname=$dbname;charset=utf8";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (\PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}