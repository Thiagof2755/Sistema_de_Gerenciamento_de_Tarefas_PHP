<?php
namespace dao;
use generic\ConnectionFactory;
use bean\EmployeeBean;
include_once "../generic/Autoload.php";
class EmployeeDAO extends ConnectionFactory {
    protected function verifyEmployees(String $email, String $senha) {
        $this->conectar();
        $sql = "SELECT id, name, email FROM employees WHERE email = :email AND password = :senha";
        $param = array(
            ":email" => $email,
            ":senha" => $senha 
        );
        $resultado = $this->conn->executar($sql, $param);
        
        if (sizeof($resultado) > 0) {
            $employee = new EmployeeBean();
            $employee->name = $resultado[0]['name'];
            $employee->id = $resultado[0]['id'];
            $employee->email = $resultado[0]['email'];
            
            return $employee;
        }
        
        return null;
    }
}

    





?>
