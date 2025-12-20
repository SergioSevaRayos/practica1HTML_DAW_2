<?php
header("Content-Type: application/json");

require_once __DIR__ . "/User.php";

try {
    $user = new User();

    // Caso 1: se recibe id por GET
    if (isset($_GET["id"])) {

        $id = (int) $_GET["id"];
        $alumno = $user->getById($id);

        if (!$alumno) {
            echo json_encode([
                "success" => false,
                "message" => "No existe el alumno con id $id",
                "data" => null
            ]);
            exit;
        }

        echo json_encode([
            "success" => true,
            "message" => "Alumno encontrado",
            "data" => $alumno
        ]);
        exit;
    }

    // Caso 2: no se recibe id → todos los alumnos
    $alumnos = $user->getAll();

    echo json_encode([
        "success" => true,
        "message" => "Lista completa de alumnos",
        "data" => $alumnos
    ]);

} catch (Throwable $e) {
    echo json_encode([
        "success" => false,
        "message" => $e->getMessage(),
        "data" => null
    ]);
}
