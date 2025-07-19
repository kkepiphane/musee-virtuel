<?php
require_once __DIR__ . '/config.php';

try {
    $db = new PDO(
        "mysql:host=" . DB_HOST,
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
        ]
    );

    // Création de la base si elle n'existe pas
    $db->exec("CREATE DATABASE IF NOT EXISTS " . DB_NAME);
    $db->exec("USE " . DB_NAME);

    // Exécution du schéma SQL
    $schema = file_get_contents(__DIR__ . '/../databases/schema.sql');
    $db->exec($schema);

    echo "Base de données installée avec succès !";
} catch (PDOException $e) {
    die("Erreur d'installation : " . $e->getMessage());
}

