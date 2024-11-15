<?php

namespace App;

use PDO;
use PDOStatement;

class Database {
    public static PDO|null $pdo;
    public static PDOStatement|null $statement;

    public static function connect()
    {
        self::$pdo = new PDO($_ENV['DB_DSN'], $_ENV['DB_USER'], $_ENV['DB_PWD']);
        // self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function disconnect()
    {
        self::$pdo = null;
        self::$statement = null;
    }
}