<?php

class Database {
    protected static PDO|null $pdo;
    protected static PDOStatement|null $statement;

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

    public static function truncate()
    {
        $calledClass = get_called_class();
        if($calledClass == 'Database') return;
        if(!str_ends_with($calledClass, 'Table')) return;

        $calledClass = explode('\\', $calledClass);
        $calledClass = end($calledClass);

        $targetTable = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', (str_replace('Table','',$calledClass))));
        self::$pdo->query('TRUNCATE TABLE ' . $targetTable);
    }
}