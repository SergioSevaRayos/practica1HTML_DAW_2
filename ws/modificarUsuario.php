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

    $alumnoActual = $user->getById($id);

    if (!$alumnoActual) {
        echo json_encode([
            "success" => false,
            "message" => "No existe el alumno con id $id",
            "data" => null
        ]);
        exit;
    }

    $mapeo = [
        "nombre" => "nombre",
        "apellido" => "apellidos",    // Recibe 'apellido' de POST, guarda en 'apellidos' de DB
        "contrasena" => "password",   // Recibe 'contrasena' de POST, guarda en 'password' de DB
        "telefono" => "telefono",
        "email" => "email",
        "sexo" => "sexo"
    ];

    $datosActualizar = [];

    foreach ($mapeo as $postKey => $dbColumn) {
        if (isset($_POST[$postKey]) && $_POST[$postKey] !== "") {
            $datosActualizar[$dbColumn] = $_POST[$postKey];
        }
    }

    if (empty($datosActualizar)) {
        echo json_encode([
            "success" => false,
            "message" => "No se envió ningún dato para actualizar",
            "data" => null
        ]);
        exit;
    }

    $user->update($id, $datosActualizar);

    $alumnoModificado = $user->getById($id);

    echo json_encode([
        "success" => true,
        "message" => "Alumno actualizado correctamente",
        "data" => $alumnoModificado
    ]);

} catch (Throwable $e) {
    echo json_encode([
        "success" => false,
        "message" => $e->getMessage(),
        "data" => null
    ]);
}
