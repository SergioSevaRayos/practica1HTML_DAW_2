<?php
header("Content-Type: application/json");

require_once __DIR__ . "/User.php";

try {
    if (!isset($_GET["id"])) {
        echo json_encode([
            "success" => false,
            "message" => "Falta el parámetro id",
            "data" => null
        ]);
        exit;
    }

    $id = (int) $_GET["id"];
    $user = new User();
    $alumno = $user->getById($id);

    if (!$alumno) {
        echo json_encode([
            "success" => false,
            "message" => "No existe el alumno con id $id",
            "data" => null
        ]);
        exit;
    }

    $user->delete($id);

    echo json_encode([
        "success" => true,
        "message" => "Alumno eliminado correctamente",
        "data" => $alumno
    ]);

} catch (Throwable $e) {
    echo json_encode([
        "success" => false,
        "message" => $e->getMessage(),
        "data" => null
    ]);
}
