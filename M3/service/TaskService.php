<?php
namespace service;

require_once "../dao/TaskDAO.php";

use dao\TaskDAO;
use bean\TaskBean;

class TaskService extends TaskDAO {
    public function getTasksByEmployeeId($employeeId) {
        return parent::getTasksByEmployeeId($employeeId);
    }

    public function createTask(TaskBean $task) {
        parent::createTask($task);
    }

    public function updateTaskStatus($taskId, $status) {
        $this->conectar();
        $sql = "UPDATE tasks SET status = :status WHERE id = :taskId";
        $param = array(
            ":status" => $status,
            ":taskId" => $taskId
        );
        $this->conn->executar($sql, $param);
    }

    public function getDistinctTaskStatus() {
        $this->conectar();
        $sql = "SELECT DISTINCT status FROM tasks";
        $resultado = $this->conn->executar($sql);
        
        $statusList = array();
        foreach ($resultado as $row) {
            $statusList[] = $row['status'];
        }
        
        return $statusList;
    }

    public function getTaskById($taskId) {
        return $this->getTask($taskId);
    }

    public function getTasksByStatus($status) {
        // Conecte-se ao banco de dados e execute a consulta SQL para buscar as tarefas pelo status
        $this->conectar();
        $sql = "SELECT id, employee_id, title, description, due_date, status FROM tasks WHERE status = :status";
        $param = array(":status" => $status);
        $resultado = $this->conn->executar($sql, $param);
    
        // Crie um array para armazenar as tarefas encontradas
        $tasks = array();
    
        // Para cada resultado retornado da consulta, crie uma instância de TaskBean e adicione ao array de tarefas
        foreach ($resultado as $row) {
            $task = new TaskBean();
            $task->id = $row['id'];
            $task->title = $row['title'];
            $task->description = $row['description'];
            $task->status = $row['status'];
            $tasks[] = $task;
        }
    
        // Retorne o array de tarefas
        return $tasks;
    }
    public function getAll() {
        $this->conectar();
        $sql = "SELECT * FROM tasks";
        $resultado = $this->conn->executar($sql);

        $tasks = [];

        foreach ($resultado as $row) {
            $task = new TaskBean();
            $task->id = $row['id'];
            $task->title = $row['title'];
            $task->description = $row['description'];
            $task->status = $row['status'];

            $tasks[] = $task;
        }

        return $tasks;
    }

        


}




?>