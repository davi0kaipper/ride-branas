<?php

use DI\ContainerBuilder;
use Project\Application\Controllers\SignUpController;
use Project\Application\Controllers\User\UserController;
use Project\Infrastructure\Connections\MySQLDatabaseConnection;
use Project\Infrastructure\Repositories\User\UserDatabaseRepository;
use Project\Infrastructure\Repositories\User\UserRepository;
use Psr\Container\ContainerInterface;
use Slim\Factory\AppFactory;
use function DI\create;
use function DI\get;

$containerBuilder = new ContainerBuilder();

$containerBuilder->addDefinitions([
    // PDO::class => create(PDO::class)->constructor('mysql:host=localhost;dbname=ride_branas_project', 'root', 'root'),
    SignUpController::class => create(SignUpController::class),
    UserController::class => create(UserController::class),
    UserRepository::class => get(UserDatabaseRepository::class),
]);

$container = $containerBuilder->build();

return $container;
