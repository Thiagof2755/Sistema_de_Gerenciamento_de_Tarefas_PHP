<?php
namespace view;

include_once "../generic/Autoload.php";
use service\EmployeeService;
use service\TaskService;

include_once '../service/EmployeeService.php';
include_once '../service/TaskService.php';

// Verifica se o usuário está autenticado
session_start();
if (!isset($_SESSION['employee'])) {
    // Redireciona para a página de login se o usuário não estiver autenticado
    header('Location: login.php');
    exit();
}

// Obtém o ID do funcionário logado da sessão
$employeeId = $_SESSION['employee']->id;

// Cria uma instância do serviço de tarefas
$taskService = new TaskService();

// Obtém todas as tarefas do funcionário logado
$tasks = $taskService->getTasksByEmployeeId($employeeId);

// Obtém os status distintos das tarefas
$statusList = $taskService->getDistinctTaskStatus();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Dashboard.css">
    <title>Página de Boas-vindas</title>
    <style>
        ul {
            list-style-type: none;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Função para filtrar as tarefas por status usando AJAX
            $("#statusFilter").on("change", function() {
                var status = $(this).val();
                if (status === "") {
                    // Exibe todas as tarefas
                    $("#taskList li").show();
                } else {
                    // Filtra as tarefas pelo status selecionado
                    $.ajax({
                        type: "POST",
                        url: "filter_tasks.php",
                        data: {status: status},
                        success: function(response) {
                            $("#taskList").html(response);
                        }
                    });
                }
            });

            // Exibe todas as tarefas ao carregar a página
            $("#statusFilter").val("");
            $("#statusFilter").trigger("change");
        });
    </script>
</head>
<body>
    <div class="welcome-container">
        <h1>Bem-vindo, <?php echo $_SESSION['employee']->name; ?></h1>
        <h2>Suas tarefas:</h2>

        <select id="statusFilter">
            <option value="">Todos</option>
            <?php foreach ($statusList as $status) : ?>
                <option value="<?php echo $status; ?>"><?php echo $status; ?></option>
            <?php endforeach; ?>
        </select>

        <ul id="taskList">
            <?php foreach ($tasks as $task) : ?>
                <li>
                    <?php echo $task->title; ?> - <?php echo $task->status; ?>
                    <a href="edit_task.php?id=<?php echo $task->id; ?>">Editar</a>
                </li>
            <?php endforeach; ?>
        </ul>

        <a href="new_task.php">Criar nova tarefa</a>
    </div>
</body>
</html>
