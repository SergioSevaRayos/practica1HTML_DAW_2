<?php
header("Content-Type: application/json");

require_once __DIR__ . "/User.php";

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

    // Usamos la clase User para verificar si existe el alumno
    $user = new User();
    $alumno = $user->getById($id);

    if (!$alumno) {
        echo json_encode([
            "success" => false,
            "message" => "No existe el alumno con id $id"
        ]);
        exit;
    }

    // Usamos el método delete() de la clase User
    $result = $user->delete($id);

    if ($result) {
        echo json_encode([
            "success" => true,
            "message" => "Alumno eliminado correctamente"
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "No se pudo eliminar el alumno"
        ]);
    }

} catch (Throwable $e) {
    echo json_encode([
        "success" => false,
        "message" => "Error: " . $e->getMessage()
    ]);
}