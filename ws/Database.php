<?php

class Database
{
    // Datos de conexión
    private string $host = "127.0.0.1";
    private string $dbname = "colegio";
    private string $user = "root";
    private string $password = "";

    // Objeto PDO
    private ?PDO $connection = null;

    // Constructor: crea la conexión PDO
    public function __construct()
    {
        $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4";

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ];

        try {
            $this->connection = new PDO(
                $dsn,
                $this->user,
                $this->password,
                $options
            );
        } catch (PDOException $e) {
            throw new RuntimeException(
                "Error al conectar con la base de datos: " . $e->getMessage()
            );
        }
    }

    // Devuelve la conexión PDO
    public function getConnection(): PDO
    {
        return $this->connection;
    }
}
