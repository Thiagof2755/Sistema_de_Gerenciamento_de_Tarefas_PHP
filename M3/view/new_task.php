<?php
namespace view;

include_once "../generic/Autoload.php";
use service\TaskService;
use bean\TaskBean;

include_once '../service/TaskService.php';

// Obtém o ID do funcionário logado da sessão
session_start();
if (isset($_SESSION['employee'])) {
    $employeeId = $_SESSION['employee']->id;
} else {
    // Redireciona para a página de login se o funcionário não estiver logado
    header('Location: login.php');
    exit();
}

// Verifica se o formulário de criação de tarefa foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['createTask'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $dueDate = $_POST['dueDate'];

    // Cria uma instância da classe TaskBean e define os atributos
    $newTask = new TaskBean();
    $newTask->employeeId = $employeeId;
    $newTask->title = $title;
    $newTask->description = $description;
    $newTask->dueDate = $dueDate;
    $newTask->status = "Pendente";

    // Cria uma instância do serviço de tarefas
    $taskService = new TaskService();

    // Chama o método para criar uma nova tarefa
    $taskService->createTask($newTask);

    // Redireciona para a página de boas-vindas e lista de tarefas
    header('Location: dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/New_Task.css">
    <title>Criar Nova Tarefa</title>
</head>
<body>
    <div class="create-task-container">
        <h1>Criar Nova Tarefa</h1>
        <form method="POST" action="new_task.php">
            <input type="text" name="title" placeholder="Título" required>
            <textarea name="description" placeholder="Descrição" required></textarea>
            <input type="date" name="dueDate" required>
            <button type="submit" name="createTask">Criar Tarefa</button>
        </form>
    </div>
</body>
</html>
