<?php
require_once "Database.php";

header("Content-Type: application/json");

try {
    // Leer datos enviados por POST
    $id = $_POST["id"] ?? null;
    $nombre = $_POST["nombre"] ?? null;
    $apellidos = $_POST["apellidos"] ?? null;
    $telefono = $_POST["telefono"] ?? null;
    $email = $_POST["email"] ?? null;
    $sexo = $_POST["sexo"] ?? null;
    $fecha = $_POST["fecha_nacimiento"] ?? null;

    // Validación mínima
    if (!$nombre || !$apellidos) {
        echo json_encode([
            "success" => false,
            "message" => "Datos incompletos"
        ]);
        exit;
    }

    // Conexión a la base de datos
    $db = Database::getConnection();

    // Consulta SQL (solo los campos que editas)
    $sql = "
        UPDATE alumno
        SET nombre = :nombre,
            apellidos = :apellidos,
            telefono = :telefono,
            email = :email,
            sexo = :sexo,
            fecha_nacimiento = :fecha
        WHERE id = :id
    ";

    $stmt = $db->prepare($sql);

    // Bind de parámetros
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
    $stmt->bindParam(":apellidos", $apellidos, PDO::PARAM_STR);
    $stmt->bindParam(":telefono", $telefono, PDO::PARAM_STR);
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    $stmt->bindParam(":sexo", $sexo, PDO::PARAM_STR);
    $stmt->bindParam(":fecha", $fecha, PDO::PARAM_STR);

    // Ejecutar
    $stmt->execute();

    // Respuesta OK
    echo json_encode([
        "success" => true,
        "message" => "Alumno modificado correctamente"
    ]);

} catch (PDOException $e) {
    echo json_encode([
        "success" => false,
        "message" => "Error en BD: " . $e->getMessage()
    ]);
}
