<?php

class Database
{
    private static ?PDO $connection = null;

    public static function getConnection(): PDO
    {
        if (self::$connection === null) {
            $host = "localhost";
            $dbname = "colegio";
            $user = "colegio_user";
            $password = "colegio123";

            $dsn = "mysql:host=127.0.0.1;port=3306;dbname=$dbname;charset=utf8mb4";


            self::$connection = new PDO(
                $dsn,
                $user,
                $password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        }

        return self::$connection;
    }
}
