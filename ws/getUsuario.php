<?php
header("Content-Type: application/json");

require_once __DIR__ . "/User.php";

try {
    $user = new User();

    // Caso 1: se recibe id por GET
    if (isset($_GET["id"])) {

        $id = (int) $_GET["id"];
        $alumno = $user->getById($id); // devuelve un objeto UserModel o null

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
            "data" => $alumno->toArray() // convertimos el objeto UserModel a array para json_encode
        ]);
        exit;
    }

    // Caso 2: no se recibe id → todos los alumnos
    $alumnos = $user->getAll(); // devuelve un array de objetos UserModel

    echo json_encode([
        "success" => true,
        "message" => "Lista completa de alumnos",
        "data" => array_map(fn($u) => $u->toArray(), $alumnos) // convertimos cada UserModel a array
    ]);

} catch (Throwable $e) {
    echo json_encode([
        "success" => false,
        "message" => $e->getMessage(),
        "data" => null
    ]);
}