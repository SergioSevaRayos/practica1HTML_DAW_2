<?php

class UserModel
{
    private ?int $id;
    private string $nombre;
    private string $apellidos;
    private string $password;
    private ?string $telefono;
    private ?string $email;
    private ?string $sexo;
    private ?string $fecha_nacimiento;

    public function __construct(
        string $nombre,
        string $apellidos,
        string $password,
        ?string $telefono = null,
        ?string $email = null,
        ?string $sexo = null,
        ?string $fecha_nacimiento = null,
        ?int $id = null
    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->password = $password;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->sexo = $sexo;
        $this->fecha_nacimiento = $fecha_nacimiento;
    }

    // Getters
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getNombre(): string
    {
        return $this->nombre;
    }
    public function getApellidos(): string
    {
        return $this->apellidos;
    }
    public function getPassword(): string
    {
        return $this->password;
    }
    public function getTelefono(): ?string
    {
        return $this->telefono;
    }
    public function getEmail(): ?string
    {
        return $this->email;
    }
    public function getSexo(): ?string
    {
        return $this->sexo;
    }
    public function getFechaNacimiento(): ?string
    {
        return $this->fecha_nacimiento;
    }

    // Setters
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }
    public function setApellidos(string $apellidos): void
    {
        $this->apellidos = $apellidos;
    }
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
    public function setTelefono(?string $telefono): void
    {
        $this->telefono = $telefono;
    }
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }
    public function setSexo(?string $sexo): void
    {
        $this->sexo = $sexo;
    }
    public function setFechaNacimiento(?string $fecha_nacimiento): void
    {
        $this->fecha_nacimiento = $fecha_nacimiento;
    }

    // Convierte el objeto a array asociativo
    public function toArray(): array
    {
        return [
            "id" => $this->id,
            "nombre" => $this->nombre,
            "apellidos" => $this->apellidos,
            "password" => $this->password,
            "telefono" => $this->telefono,
            "email" => $this->email,
            "sexo" => $this->sexo,
            "fecha_nacimiento" => $this->fecha_nacimiento
        ];
    }

    // Convierte el objeto a JSON
    public function toJson(): string
    {
        return json_encode($this->toArray());
    }
}