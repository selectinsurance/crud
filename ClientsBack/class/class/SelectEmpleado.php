<?php 
    class SelectEmpleado  
    {
        private $id;

        public function __construct($id) {
            $this->id = $id;
        }

        public function Query(){
            $id = $this->id;
            $consulta = "SELECT * FROM empleado WHERE idEmpleado = '$id'";
            return $consulta;
        }

        public function sinid(){
            $consulta = "SELECT * FROM empleado";
            return $consulta;
        }
    }
    
?>