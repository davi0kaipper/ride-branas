<?php

require __DIR__ . '/../../vendor/autoload.php';

use Project\Infrastructure\Configuration\Container;
use DI\Bridge\Slim\Bridge;
use Project\Application\Controllers\SignUpController;
use Project\Application\Controllers\UserController;

$container = Container::container();

$app = Bridge::create($container);

$app->get('/users', [UserController::class, 'getAll']);
$app->get('/users/{user_id}', [UserController::class, 'get']);
$app->delete('/users/{user_id}', [UserController::class, 'delete']);
$app->post('/signup', SignUpController::class);

$app->run();
