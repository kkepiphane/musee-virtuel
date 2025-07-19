<?php

use League\Plates\Engine;

$templates = new League\Plates\Engine(__DIR__ . '/../views');

$templates->addData(['site_name' => 'Musée Virtuel']);

// Enregistrer des fonctions utilitaires
$templates->registerFunction('asset', function ($path) {
    return '/assets/' . ltrim($path, '/');
});

return $templates;

