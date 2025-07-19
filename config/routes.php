<?php

$router->map('GET', '/', 'HomeController#index');
$router->map('GET', '/expositions', 'ExpositionController#index');
$router->map('GET', '/exposition/[:slug]', 'ExpositionController#show');
$router->map('GET', '/galerie', 'GalerieController#index');
$router->map('GET', '/a-propos', 'AboutController#index');
$router->map('GET|POST', '/contact', 'ContactController#index');
$router->map('POST', '/contact/submit', 'ContactController#submit');