<?php 

namespace App\Entity;

class Persona{

    protected $nombre;
    protected $apellidos;
    protected $email;
    protected $telefono;

    public function __constructu($nombre, $apellidos, $email, $telefono){
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->email = $email;
        $this->telefono = $telefono;
    }


    public function getNombre(): string{
        return $this->nombre;
    }

    public function getApellidos(): string{
        return $this->apellidos;
    }

    public function getEmail(): string {
        return $this->email;
    }
    public function getTelefono(): string{
        return $this->telefono;
    }

    public function setNombre($nombre): void{
        $this->nombre = $nombre;
    }

    public function setApellidos($apellidos): void{
        $this->apellidos = $apellidos;
    }

    public function setEmail($email): void {
        $this->email = $email;
    }
    public function setTelefono($telefono): void{
        $this->telefono = $telefono;
    }

    




}