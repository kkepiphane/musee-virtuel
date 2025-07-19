<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../vendor/autoload.php';


// Initialisation du routeur
$router = new AltoRouter();
$router->setBasePath('');

// Chargement des routes
require __DIR__ . '/../config/routes.php';

// Correspondance de la route
$match = $router->match();


if ($match) {
  if (!str_contains($match['target'], '#')) {
    http_response_code(500);
    require_once __DIR__ . '/../views/errors/500.php';
  }

  list($controllerName, $action) = explode('#', $match['target'], 2);

  //var_dump($controllerName);

  $fullClassName = "MuseeVirtuel\\Controllers\\" . $controllerName;

  if (class_exists($fullClassName) && method_exists($fullClassName, $action)) {
    $controller = new $fullClassName();
    call_user_func_array([$controller, $action], $match['params']);
  } else {
    http_response_code(500);
    require_once __DIR__ . '/../views/errors/500.php';
  }
} else {
  http_response_code(404);
  require_once __DIR__ . '/../views/errors/404.php';
}
