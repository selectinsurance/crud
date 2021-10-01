<?php 
require_once 'conexion.php';
    class select  
    {
        private $id;

        public function __construct($id) {
            $this->id = $id;
        }

        public function query(){
            $id = $this->id;
            $query = "SELECT * FROM cliente WHERE id = '$id'";
            return $query;
        }
        public function sinid(){
            $id = $this->id;
            $query = "SELECT * FROM cliente";
            return $query;
        }

    }
    
?>