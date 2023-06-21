<?php 
namespace generic;

require_once 'DBSingleton.php';

class ConnectionFactory{
    public DBSingleton $conn;
    public function conectar(){
        $this->conn = DBSingleton::getInstance();
    }
}
?>