<?php

namespace Project\Infrastructure\Configuration;

use DI\Container as DIContainer;
use DI\ContainerBuilder;
use PDO;
use Project\Application\Controllers\SignUpController;
use Project\Application\Controllers\UserController;
use Project\Infrastructure\Connections\MySQLDatabaseConnection;
use Project\Infrastructure\Repositories\User\UserDatabaseRepository;
use Project\Infrastructure\Repositories\User\UserRepository;

use function DI\create;
use function DI\get;

class Container
{
    public static function container(): DIContainer
    {
        $containerBuilder = new ContainerBuilder();

        $pdoArgs = [
            'mysql:host=localhost;dbname=ride_branas_project',
            'root',
            'root',
        ];

        $containerBuilder->addDefinitions(
            [
                SignUpController::class        => create(SignUpController::class),
                UserController::class          => create(UserController::class),
                UserRepository::class          => get(UserDatabaseRepository::class),
                UserDatabaseRepository::class  => create(UserDatabaseRepository::class)->constructor(get(MySQLDatabaseConnection::class)),
                MySQLDatabaseConnection::class => create(MySQLDatabaseConnection::class)->constructor(get(PDO::class)),
                PDO::class                     => create(PDO::class)->constructor(...$pdoArgs),
            ]
        );

        $container = $containerBuilder->build();

        return $container;
    }
}