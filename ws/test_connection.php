<?php

require_once __DIR__ . "/Database.php";

try {
    $db = new Database();
    $pdo = $db->getConnection();

    echo "Conexión correcta con la base de datos";
} catch (Throwable $e) {
    echo "Error de conexión: " . $e->getMessage();
}
