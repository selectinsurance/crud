<?php 
require_once 'conexion.php';
class InsertEmpleado  
{
    private $nombre;
    private $apellido;
    private $telefono;
    
    public function __construct($nombre, $apellido, $telefono) {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->telefono = $telefono;
    }

    public function InsertarEmpleado(){
        $nombre = $this->nombre;
        $apellido = $this->apellido;
        $telefono = $this->telefono;
        echo $nombre.$apellido.$telefono;
        $conexion = new conexion();
        $conexion->EstablecerConexion()->query("INSERT INTO empleado(nombre, apellido, telefono) VALUES('$nombre','$apellido','$telefono')");
        print 'Creado';
        http_response_code(201);
    }
}
