<?php
namespace service;

use dao\EmployeeDAO;

class EmployeeService extends EmployeeDAO {
    public function verifyLogin(String $email, String $password) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $employee = parent::verifyEmployees($email, $password);
            if ($employee != null) {
                return $employee;
            }
        }
        
        return null;
    }
}



?>