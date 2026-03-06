<?php
header("Content-Type: application/json");

require_once __DIR__ . "/User.php";

try {
    // Leer datos enviados por POST
    $id = (int) ($_POST["id"] ?? 0);
    $nombre = $_POST["nombre"] ?? null;
    $apellidos = $_POST["apellidos"] ?? null;
    $telefono = $_POST["telefono"] ?? null;
    $email = $_POST["email"] ?? null;
    $sexo = $_POST["sexo"] ?? null;
    $fecha = $_POST["fecha_nacimiento"] ?? null;

    // Validación mínima incluyendo el id
    if (!$id || !$nombre || !$apellidos) {
        echo json_encode([
            "success" => false,
            "message" => "Datos incompletos"
        ]);
        exit;
    }

    // Usamos la clase User y su método update()
    $user = new User();
    $result = $user->update($id, [
        "nombre" => $nombre,
        "apellidos" => $apellidos,
        "telefono" => $telefono,
        "email" => $email,
        "sexo" => $sexo,
        "fecha_nacimiento" => $fecha
    ]);

    if ($result) {
        echo json_encode([
            "success" => true,
            "message" => "Alumno modificado correctamente"
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "No se pudo modificar el alumno"
        ]);
    }

} catch (Throwable $e) {
    echo json_encode([
        "success" => false,
        "message" => "Error: " . $e->getMessage()
    ]);
}