<?php

require __DIR__ . "/../../vendor/autoload.php";

use DI\Bridge\Slim\Bridge;
use Project\Application\Controllers\SignUpController;
use Project\Application\Controllers\User\UserController;

$container = require __DIR__ . '/../../config/container.php';
$app = Bridge::create($container);

$app->get('/users/{user_id}', [UserController::class, 'get']);
$app->delete('/users/{user_id}', [UserController::class, 'delete']);
$app->post('/signup', SignUpController::class);

$app->run();