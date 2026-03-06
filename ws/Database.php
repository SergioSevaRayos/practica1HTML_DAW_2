<?php

// Clase que gestiona la conexión a una BD
class Database
{
    private static ?PDO $connection = null;
    /*
    $connection es una propiedad estática que almacena la conexión. 
    es "static" porque pertenece a la clase y no a una instancia concreta, 
    y es ?PDO porque puede ser "null" si todavía no se ha conectado.
    */

    public static function getConnection(): PDO
    {
        if (self::$connection === null) {
            $host = "localhost";
            $dbname = "colegio";
            $user = "root";
            $password = "";

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
