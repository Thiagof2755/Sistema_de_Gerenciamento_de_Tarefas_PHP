<?php
namespace view;

include_once "../generic/Autoload.php";
use service\EmployeeService;

include_once '../service/EmployeeService.php';

// Verifica se o formulário de login foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Cria uma instância do serviço de funcionários
    $employeeService = new EmployeeService();

    // Verifica o login
    $employee = $employeeService->verifyLogin($email, $password);
    if ($employee != null) {
        // Armazena o objeto do funcionário na sessão
        session_start();
        $_SESSION['employee'] = $employee;

        // Redireciona para a página de boas-vindas
        header('Location: dashboard.php');
        exit();
    } else {
        // Login inválido, exibe uma mensagem de erro
        echo '<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>';
        echo '<script>$(document).ready(function() {
                $("#errorModal").modal("show");
            });</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/Login.css">
    <title>Login</title>
</head>
<body>
<div class="wrapper fadeInDown">
    <div id="formContent">
        <form method="POST" action="">
            <input type="text" id="email" class="fadeIn second" name="email" placeholder="Email">
            <input type="password" id="password" class="fadeIn third" name="password" placeholder="Senha">
            <input type="submit" class="fadeIn fourth" value="Log In">
        </form>
    </div>
</div>

<!-- Modal de erro -->
<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="errorModalLabel">Erro de Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Credenciais inválidas. Por favor, tente novamente.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

</body>
</html>
