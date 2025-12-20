<?php
header("Content-Type: application/json");

require_once __DIR__ . "/User.php";

try {
    $data = [
        "nombre" => $_POST["nombre"] ?? null,
        "apellidos" => $_POST["apellido"] ?? null,
        "password" => $_POST["contrasena"] ?? null,
        "telefono" => $_POST["telefono"] ?? null,
        "email" => $_POST["email"] ?? null,
        "sexo" => $_POST["sexo"] ?? null,
        "fecha_nacimiento" => date("Y-m-d") 
    ];


    // Validación mínima
    if (!$data["nombre"] || !$data["apellidos"] || !$data["password"]) {
        echo json_encode([
            "success" => false,
            "message" => "Faltan datos obligatorios",
            "data" => null
        ]);
        exit;
    }


    $user = new User();
    $id = $user->create($data);
    $alumno = $user->getById($id);

    echo json_encode([
        "success" => true,
        "message" => "Alumno creado correctamente",
        "data" => $alumno
    ]);

} catch (Throwable $e) {
    echo json_encode([
        "success" => false,
        "message" => $e->getMessage(),
        "data" => null
    ]);
}
