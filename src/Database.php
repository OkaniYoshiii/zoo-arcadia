<?php

class Database {
    public static PDO|null $pdo;
    public static PDOStatement|null $statement;

    public static function connect()
    {
        try {
            self::$pdo = new PDO(DB_DSN, DB_USER, DB_PWD);
        } catch(PDOException $error) {
            // logger l'erreur sur un fichier par exemple
        }
    }

    public static function disconnect()
    {
        self::$pdo = null;
        self::$statement = null;
    }
}