# Sistema de Gerenciamento de Tarefas

Este é um projeto de um sistema de gerenciamento de tarefas desenvolvido em PHP. O sistema permite que os usuários realizem o login, visualizem suas tarefas, filtrem por status e editem tarefas existentes. Além disso, os usuários também podem criar novas tarefas.

## Funcionalidades

- Autenticação de usuário: Os usuários podem fazer o login fornecendo seu e-mail e senha.
- Exibição de tarefas: Após o login bem-sucedido, os usuários são redirecionados para a página de dashboard, onde podem ver uma lista das suas tarefas.
- Filtragem por status: Os usuários podem selecionar um status específico na lista suspensa para filtrar as tarefas exibidas na página.
- Edição de tarefas: Os usuários podem editar uma tarefa existente clicando no link "Editar" ao lado da tarefa desejada.
- Criação de novas tarefas: Os usuários podem criar uma nova tarefa clicando no link "Criar nova tarefa" na página de dashboard.

## Tecnologias utilizadas

- PHP: Linguagem de programação principal do projeto.
- HTML/CSS: Utilizados para a criação das páginas e estilização.
- MySQL: Banco de dados utilizado para armazenar as informações dos usuários e tarefas.

## Estrutura do projeto

- `index.php`: Página inicial do projeto que redireciona para a página de login.
- `login.php`: Página de login onde os usuários podem fornecer suas credenciais.
- `dashboard.php`: Página principal do sistema, exibe as tarefas do usuário logado.
- `new_task.php`: Página para criar uma nova tarefa.
- `edit_task.php`: Página para editar uma tarefa existente.
- `filter_tasks.php`: Script para filtrar as tarefas por status usando AJAX.
- `generic/Autoload.php`: Arquivo responsável pelo carregamento automático das classes.
- `service/EmployeeService.php`: Classe responsável pela lógica de negócio relacionada aos funcionários (autenticação, obtenção de informações, etc.).
- `service/TaskService.php`: Classe responsável pela lógica de negócio relacionada às tarefas (obtenção, criação, edição, etc.).
- `css/Login.css`: Arquivo de estilo CSS para a página de login.
- `css/Dashboard.css`: Arquivo de estilo CSS para a página de dashboard.

## Configuração do ambiente

1. Clone este repositório em seu ambiente de desenvolvimento.
2. Certifique-se de ter um servidor web (como o Apache) configurado e o PHP instalado.
3. Importe o arquivo de banco de dados `database.sql` em um servidor MySQL para criar o esquema do banco de dados e as tabelas necessárias.
4. Atualize as informações de conexão com o banco de dados no arquivo `generic/Database.php`.
5. Inicie o servidor web e acesse o projeto pelo navegador.

## Considerações finais

Este projeto é um exemplo simples de um sistema de gerenciamento de tarefas em PHP. Fique à vontade para modificá-lo e aprimorá-lo de acordo com suas necessidades. Espero que seja útil como ponto de partida para o desenvolvimento de sistemas mais complexo.
