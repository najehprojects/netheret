<?php
// Settings come from the environment, with local XAMPP settings as a fallback
$host = getenv('DB_HOST') ?: 'localhost';
$name = getenv('DB_NAME') ?: 'netheret';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: ''; // XAMPP default: no password (local use only!)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$name;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
} catch (PDOException $e) {
    error_log($e->getMessage());
    exit('Database connection failed.');
}
