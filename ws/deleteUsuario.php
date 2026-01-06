<?php
require_once "Database.php";

header("Content-Type: application/json");

try {
    // Validar id
    if (!isset($_POST["id"])) {
        echo json_encode([
            "success" => false,
            "message" => "Falta el parámetro id"
        ]);
        exit;
    }

    $id = (int) $_POST["id"];

    // Conexión a la BD
    $db = Database::getConnection();

    // Comprobar si existe el alumno
    $check = $db->prepare("SELECT id FROM alumno WHERE id = :id");
    $check->bindParam(":id", $id, PDO::PARAM_INT);
    $check->execute();

    if ($check->rowCount() === 0) {
        echo json_encode([
            "success" => false,
            "message" => "No existe el alumno"
        ]);
        exit;
    }

    // Eliminar alumno
    $stmt = $db->prepare("DELETE FROM alumno WHERE id = :id");
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();

    echo json_encode([
        "success" => true,
        "message" => "Alumno eliminado correctamente"
    ]);

} catch (PDOException $e) {
    echo json_encode([
        "success" => false,
        "message" => "Error en BD: " . $e->getMessage()
    ]);
}
