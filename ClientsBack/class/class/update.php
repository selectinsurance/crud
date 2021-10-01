<?php 
require_once 'conexion.php';
    class update  
    {
        private $id;
        private $campo;

        public function __construct($id, $campo) {
            $this->id = $id;
            $this->campo = $campo;
        }

        public function updateNombre(){
            $conexion = new conexion();
            $id = $this->id;
            $campo = $this->campo;
            $conexion->EstablecerConexion()->query("UPDATE cliente SET nombre = '$campo' WHERE id = '$id'");
            http_response_code(202);
        }

        public function updateApellido(){
            $conexion = new conexion();
            $id = $this->id;
            $campo = $this->campo;
            $conexion->EstablecerConexion()->query("UPDATE cliente SET apellido = '$campo' WHERE id = '$id'");
            http_response_code(202);
        }

        public function updateTelefono(){
            $conexion = new conexion();
            $id = $this->id;
            $campo = $this->campo;
            $conexion->EstablecerConexion()->query("UPDATE cliente SET telefono = '$campo' WHERE id = '$id'");
            http_response_code(202);
        }

    }
