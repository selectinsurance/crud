<?php 
require_once 'conexion.php';
    class delete  
    {
        private $id;

        public function __construct($id) {
            $this->id = $id;
        }
        public function Eliminar(){
            $id = $this->id;
            $conexion = new conexion();
            $delete = mysqli_query($conexion->EstablecerConexion(), "SELECT * FROM cliente WHERE id = '$id'");
            $row = mysqli_fetch_assoc($delete);
            if (!empty($row['id'])) {
                $conexion->EstablecerConexion()->query("DELETE FROm cliente WHERE id = '$id'");
                http_response_code(200);
            }else {
                echo 'id no existe';
                http_response_code(404);
            }
            
        }
    }
