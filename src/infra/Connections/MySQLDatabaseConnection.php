<?php

namespace Project\Infrastructure\Connections;

use PDO;

class MySQLDatabaseConnection
{
    public function connection()
    {
        try {
            return new PDO('mysql:host=localhost;dbname=ride_branas_project', 'root', 'root');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}