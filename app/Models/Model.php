<?php

namespace Models;

use PDO;

class Model
{
    /**
     * @var PDO|null
     */
    protected static ?PDO $pdo = null;

    public static function getPdo() : PDO
    {
        if (!self::$pdo) {
            $host = getenv('DB_HOST', 'db');
            $db = getenv('DB_DATABASE', 'db');
            $user = getenv('DB_USER', 'user');
            $password = getenv('DB_PASSWORD', 'user');

            self::$pdo = new PDO("pgsql:host=$host; port=5432; dbname=$db", $user, $password);
        }

        return self::$pdo;
    }
}