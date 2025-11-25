<?php
require_once __DIR__ . '/../interfaces/IToJson.php';
class User implements IToJson
{
    // Atributos
    private $nombre;
    private $apellido;
    private $contrasena;
    private $telefono;
    private $email;
    private $sexo;

    // Constructor
    public function __construct($nombre, $apellido, $contrasena, $telefono, $email, $sexo)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->contrasena = $contrasena;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->sexo = $sexo;
    }

    // Getters
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getApellido()
    {
        return $this->apellido;
    }
    public function getContrasena()
    {
        return $this->contrasena;
    }
    public function getTelefono()
    {
        return $this->telefono;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getSexo()
    {
        return $this->sexo;
    }

    // Setters
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }
    public function setContrasena($contrasena)
    {
        $this->contrasena = $contrasena;
    }
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
    }

    // Interfaz
    public function toJson()
    {
        return json_encode(get_object_vars($this));
    }



}
