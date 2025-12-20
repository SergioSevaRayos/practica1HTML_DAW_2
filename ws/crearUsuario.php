<?php

require_once './models/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') { 

    $nombre     = $_POST['nombre']     ?? null; 
    $apellido   = $_POST['apellido']   ?? null;   
    $contrasena = $_POST['contrasena'] ?? null;
    $telefono   = $_POST['telefono']   ?? null;
    $email      = $_POST['email']      ?? null;
    $sexo       = $_POST['sexo']       ?? null;


    $user = new User(
        $nombre,
        $apellido,
        $contrasena,
        $telefono,
        $email,
        $sexo
    );

    $json = $user->toJson(); 


    file_put_contents('usuarios.txt', $json . PHP_EOL, FILE_APPEND); 

    header('Content-Type: application/json');
    print $json;
}
