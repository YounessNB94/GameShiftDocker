<?php

// On récupère d'abord ce qui vient des variables d'environnement (Docker)
// et on garde des valeurs par défaut pour un lancement "sans Docker".
$host     = getenv('DB_HOST') ?: 'localhost';
$dbname   = getenv('DB_NAME') ?: 'GameShift';
$username = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASSWORD') ?: '';

// Connexion PDO
try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
