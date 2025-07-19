<?php

// Configuration de base
define('APP_ENV', 'development');
define('APP_DEBUG', true);

// Configuration de la base de données
define('DB_HOST', 'localhost');
define('DB_NAME', 'musee_virtuel');
define('DB_USER', 'root');
define('DB_PASS', 'root');

// Configuration des chemins
define('BASE_URL', 'http://localhost:8000');
define('ASSETS_URL', BASE_URL . '/public/assets');

// Configuration sécurité
define('CSRF_TOKEN_EXPIRY', 3600);

// Initialisation de la session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Fonctions utilitaires
function asset($path) {
    return ASSETS_URL . '/' . ltrim($path, '/');
}

function url($path = '') {
    return BASE_URL . '/' . ltrim($path, '/');
}

// Gestion des erreurs selon l'environnement
if (APP_DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
} else {
    error_reporting(E_ALL);
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
}