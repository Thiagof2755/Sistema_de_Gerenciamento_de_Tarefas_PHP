<?php
include_once "../generic/Autoload.php";
use service\TaskService;

include_once '../service/TaskService.php';

// Verifica se foi fornecido o ID da tarefa na URL
if (isset($_GET['id'])) {
    $taskId = $_GET['id'];

    // Cria uma instância do serviço de tarefas
    $taskService = new TaskService();

    // Obtém os detalhes da tarefa pelo ID
    $task = $taskService->getTaskById($taskId);

    // Verifica se a tarefa foi encontrada
    if ($task != null) {
        // Verifica se o formulário de atualização foi enviado
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $status = $_POST['status'];

            // Atualiza o status da tarefa
            $taskService->updateTaskStatus($taskId, $status);

            // Redireciona de volta para a dashboard
            header('Location: dashboard.php');
            exit();
        }
    } else {
        // Tarefa não encontrada, redireciona para a dashboard
        header('Location: dashboard.php');
        exit();
    }
} else {
    // ID da tarefa não fornecido, redireciona para a dashboard
    header('Location: dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Edit.css">
    <title>Editar Tarefa</title>
</head>
<body>
    <h1>Editar Tarefa</h1>

    <p><strong>ID:</strong> <?php echo $task->id; ?></p>
    <p><strong>Título:</strong> <?php echo $task->title; ?></p>
    <p><strong>Descrição:</strong> <?php echo $task->description; ?></p>

    <form method="POST" action="">
        <label for="status">Status:</label>
        <select name="status" id="status">
            <option value="Pendente" <?php if ($task->status === 'Pendente') echo 'selected'; ?>>Pendente</option>
            <option value="em_andamento" <?php if ($task->status === 'em_andamento') echo 'selected'; ?>>em_andamento</option>
            <option value="concluida" <?php if ($task->status === 'concluida') echo 'selected'; ?>>concluida</option>
        </select>
        <br>
        <input type="submit" value="Atualizar">
    </form>
</body>
</html>
