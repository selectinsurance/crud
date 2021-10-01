<?php
require_once 'conexion.php';
class insert
{
    private $nombre;
    private $apellido;
    private $telefono;
    private $idEmpleado;

    public function __construct($nombre, $apellido, $telefono, $idEmpleado)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->telefono = $telefono;
        $this->idEmpleado = $idEmpleado;
    }

    public function insertar()
    {
        $nombre = $this->nombre;
        $apellido = $this->apellido;
        $telefono = $this->telefono;
        $idEmpleado = $this->idEmpleado;
        $conexion = new conexion();
        $conexion->EstablecerConexion()->query("INSERT INTO cliente(nombre, apellido, telefono, idEmpleado) VALUES('$nombre','$apellido','$telefono','$idEmpleado')");
        $Message['Message'] = 'Creado';
        echo json_encode($Message);
        http_response_code(201);
    }
}


