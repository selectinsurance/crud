<?php 
    class conexion  
    {
        private $host;
        private $user;
        private $pass;
        private $db;

        public function __construct(){

            $this->host = 'localhost';
            $this->user = 'root';
            $this->pass = '';
            $this->db = 'testapi';
        }

        public function EstablecerConexion(){
            $conexion = new mysqli($this->host, $this->user, $this->pass, $this->db);

            if ($conexion->connect_errno) {
                echo "Error de conexion";
            }
            return $conexion;
        }
    }

    

?>