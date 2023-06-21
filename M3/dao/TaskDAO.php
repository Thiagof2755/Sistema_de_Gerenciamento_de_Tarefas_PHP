<?php
namespace dao;
use generic\ConnectionFactory;
use bean\TaskBean;
use bean\EmployeeBean;
use dao\EmployeeDAO;
include_once "../generic/Autoload.php";
class TaskDAO extends ConnectionFactory {
    protected function getTasksByEmployeeId($employeeId) {
        $this->conectar();
        $sql = "SELECT * FROM tasks WHERE employee_id = :employeeId";
        $param = array(":employeeId" => $employeeId);
        $resultado = $this->conn->executar($sql, $param);

        $tasks = array();
        foreach ($resultado as $row) {
            $task = new TaskBean();
            $task->id = $row['id'];
            $task->employeeId = $row['employee_id'];
            $task->title = $row['title'];
            $task->description = $row['description'];
            $task->dueDate = $row['due_date'];
            $task->status = $row['status'];
            $tasks[] = $task;
        }

        return $tasks;
    }

    protected function createTask(TaskBean $task) {
        $this->conectar();
        $sql = "INSERT INTO tasks (employee_id, title, description, due_date, status)
                VALUES (:employeeId, :title, :description, :dueDate, :status)";
        $params = array(
            ":employeeId" => $task->employeeId,
            ":title" => $task->title,
            ":description" => $task->description,
            ":dueDate" => $task->dueDate,
            ":status" => $task->status
        );
        $this->conn->executar($sql, $params);
    }

    protected function updateTaskStatus($taskId, $status) {
        $this->conectar();
        $sql = "UPDATE tasks SET status = :status WHERE id = :taskId";
        $params = array(
            ":status" => $status,
            ":taskId" => $taskId
        );
        $this->conn->executar($sql, $params);
    }
    protected function verifyTasks(int $employeeId) {
        $this->conectar();
        $sql = "SELECT id, employee_id, title, description, due_date, status FROM tasks WHERE employee_id = :employeeId";
        $param = array(":employeeId" => $employeeId);
        $resultado = $this->conn->executar($sql, $param);
    
        $taskList = array();
        foreach ($resultado as $row) {
            $task = new TaskBean();
            $task->id = $row['id'];
            $task->employeeId = $row['employee_id'];
            $task->title = $row['title'];
            $task->description = $row['description'];
            $task->dueDate = $row['due_date'];
            $task->status = $row['status']; // Adiciona o valor do status
    
            $taskList[] = $task;
        }
    
        return $taskList;
    }

    public function getTask($taskId) {
        $this->conectar();
        $sql = "SELECT * FROM tasks WHERE id = :taskId";
        $param = array(
            ":taskId" => $taskId
        );
        $resultado = $this->conn->executar($sql, $param);
        
        if (sizeof($resultado) > 0) {
            $task = new TaskBean();
            $task->id = $resultado[0]['id'];         
            $task->title = $resultado[0]['title'];
            $task->description = $resultado[0]['description'];    
            $task->status = $resultado[0]['status'];
            
            return $task;
        }
        
        return null;
    }
}



    





?>
