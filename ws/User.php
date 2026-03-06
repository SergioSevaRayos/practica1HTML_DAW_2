<?php
require_once __DIR__ . "/Database.php";
require_once __DIR__ . "/models/UserModel.php";

class User
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    // Convierte una fila de la BD en un objeto UserModel
    private function rowToModel(array $row): UserModel
    {
        return new UserModel(
            $row["nombre"],
            $row["apellidos"],
            $row["password"],
            $row["telefono"] ?? null,
            $row["email"] ?? null,
            $row["sexo"] ?? null,
            $row["fecha_nacimiento"] ?? null,
            (int) $row["id"]
        );
    }

    // Obtener un alumno por id
    public function getById(int $id): ?UserModel
    {
        $sql = "SELECT * FROM alumno WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(["id" => $id]);

        $row = $stmt->fetch();
        return $row ? $this->rowToModel($row) : null;
    }

    // Obtener todos los alumnos
    public function getAll(): array
    {
        $sql = "SELECT * FROM alumno";
        $stmt = $this->db->query($sql);

        return array_map(
            fn($row) => $this->rowToModel($row),
            $stmt->fetchAll()
        );
    }

    // Crear un alumno
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

    // Modificar un alumno
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

    // Eliminar alumno
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM alumno WHERE id = :id";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute(["id" => $id]);
    }
}