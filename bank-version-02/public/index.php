<?php
require_once __DIR__ .'/../vendor/autoload.php';

use App\Router;

$router = new \App\Router();

$router->get('', function () {
    require __DIR__ . '/home.php';
});
$router->get('home', function () {
    require __DIR__ . '/home.php';
});
$router->get('login', function () {
    require __DIR__ . '/login.php';
});
$router->get('signup', function () {
    require __DIR__ . '/signup.php';
});
$router->get('about', function () {
    echo 'About page lmao';
});







$router->addNotFoundHandler(function () {
    echo '<h1>' . '404, Page Not Found' . '</h1>';
});

$router->run();

