<?php
require_once __DIR__ . "/Database.php";

class User
{
    private PDO $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
    }

    public function getById(int $id): ?array
    {
        $sql = "SELECT * FROM alumno WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(["id" => $id]);

        $alumno = $stmt->fetch();
        return $alumno ?: null;
    }
    public function getAll(): array
    {
        $sql = "SELECT * FROM alumno";
        $stmt = $this->db->query($sql);

        return $stmt->fetchAll();
    }

    public function create(array $data): int
    {
        $sql = "INSERT INTO alumno 
            (nombre, apellidos, password, telefono, email, sexo, fecha_nacimiento)
            VALUES 
            (:nombre, :apellidos, :password, :telefono, :email, :sexo, :fecha_nacimiento)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($data);

        return (int) $this->db->lastInsertId();
    }
    public function update(int $id, array $data): bool
    {
        $campos = [];
        $params = ["id" => $id];

        foreach ($data as $campo => $valor) {
            $campos[] = "$campo = :$campo";
            $params[$campo] = $valor;
        }

        $sql = "UPDATE alumno SET " . implode(", ", $campos) . " WHERE id = :id";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute($params);
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM alumno WHERE id = :id";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute(["id" => $id]);
    }




}