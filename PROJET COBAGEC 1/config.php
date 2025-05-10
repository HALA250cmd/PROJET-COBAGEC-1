<?php
$host = 'localhost';
$db   = 'mg_bd';
$user = 'root';
$pass = ''; // à remplacer par ton mot de passe MySQL
$charset = 'utf8mb4';
$port = '3306';

$dsn = "mysql:host=$host;dbname=$db; port=$port;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    exit('Erreur de connexion à la base de données : ' . $e->getMessage());
}
