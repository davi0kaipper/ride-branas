<?php

namespace Project\Infrastructure\Connections;

use PDO;

class MySQLDatabaseConnection
{
    public function __construct(private PDO $pdo)
    {
        //
    }

    public function connection()
    {
        try {
            return $this->pdo;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}