<?php

use service\EmployeeService;
use service\TaskService;
include_once "../generic/Autoload.php";


// Verifique se a requisição é um POST e se o parâmetro "status" está definido
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['status'])) {
    // Obtém o status selecionado no filtro
    $selectedStatus = $_POST['status'];

    // Cria uma instância do serviço de tarefas
    $taskService = new TaskService();

    // Obtém as tarefas filtradas pelo status
    $filteredTasks = $taskService->getTasksByStatus($selectedStatus);

    // Exiba as tarefas filtradas
    foreach ($filteredTasks as $task) {
        echo '<li>' . $task->title . ' - ' . $task->status . '<a href="edit_task.php?id=' . $task->id . '">Editar</a></li>';
    }
}
?>
