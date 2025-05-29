<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if (isset($_POST['cadastrar'])) {
        // Conexão com o banco de dados
        $servername = "localhost";
        $username = "dbusertea";
        $password = "ProjetoInterdisciplinar";
        $dbname = "projeto_tea";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Falha na conexão: " . $conn->connect_error);
        }

        // Verifica se o formulário foi enviado
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nome = $_POST['nome'];
            $crm = $_POST['crm'];
            $especialidade = $_POST['especialidade'];
            $telefone = $_POST['telefone'];
            $email = $_POST['email'];
            $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

            $sql = "INSERT INTO medicos (nome, crm, especialidade, telefone, email, senha) VALUES ('$nome', '$crm', '$especialidade', '$telefone', '$email', '$senha')";

            if ($conn->query($sql) === TRUE) {
                header("Location: login.php?cadastro-medico=true");
                exit();
            } else {
                $erro = "Erro: " . $sql . "<br>" . $conn->error;
            }
        }

        $conn->close();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Médicos</title>
    <link rel="stylesheet" href="cadastro-medicos-atualizado.css">
    <!--<link rel="stylesheet" href="cadastro-medicos-plus.css">-->
</head>

<body>
    <header class="cabecalho">
        <h2 class="titulo">NutriVibe</h2>
        <nav class="menu">
            <a href="cadastro-medicos.php">Médicos</a>
            <a href="login.php">Login</a>
            <a href="formularios-preenchimento.php">Formulários</a>
            <a href="index.php" class="voltar_menu">
                <img src="imagens/casa-natural.jpeg">
            </a>
        </nav>
    </header>
    <section class="posicao">
    <div class="cadastro-container">
        <img src="imagens/medica.png" alt="TEA Logo" />
        <h1>Cadastro de Médicos</h1>
        <?php
        // Exibe mensagens de sucesso ou erro
        if (isset($mensagem)) {
            echo "<div class='mensagem'>$mensagem</div>";
        }
        if (isset($erro)) {
            echo "<div class='erro'>$erro</div>";
        }
        ?>
        <form method="POST" action="">
            <div class="input-group">
                <label for="nome">Nome: <span style="color: #c62828;">*</span></label>
                <input type="text" id="nome" name="nome" required>
            </div>
            <div class="input-group">
                <label for="crm">CRM: <span style="color: #c62828;">*</span></label>
                <input type="text" id="crm" name="crm" required>
            </div>
            <div class="input-group">
                <label for="especialidade">Especialidade: <span style="color: #c62828;">*</span></label>
                <input type="text" id="especialidade" name="especialidade" required>
            </div>
            <div class="input-group">
                <label for="telefone">Telefone: <span style="color: #c62828;">*</span></label>
                <input type="text" id="telefone" name="telefone" required>
            </div>
            <div class="input-group">
                <label for="email">E-mail: <span style="color: #c62828;">*</span></label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="senha">Senha: <span style="color: #c62828;">*</span></label>
                <input type="password" id="senha" name="senha" required>
            </div>
            <button class="cadastro-btn" type="submit" name="cadastrar">Cadastrar</button>
            <button class="cadastro-btn" type="submit" name="cancelar">Cancelar</button>
        </form>
        <small>Bem-vindo! Cadastre médicos para o Portal TEA.</small>
    </div>
    </section>
    <script>
        function validarCamposMedico() {
            var nome = document.getElementById('nome').value.trim();
            var crm = document.getElementById('crm').value.trim();
            var especialidade = document.getElementById('especialidade').value.trim();
            var telefone = document.getElementById('telefone').value.trim();
            var email = document.getElementById('email').value.trim();
            var senha = document.getElementById('senha').value.trim();
            var btn = document.querySelector('.cadastro-btn');
            if (nome && crm && especialidade && telefone && email && senha) {
                btn.disabled = false;
            } else {
                btn.disabled = true;
            }
        }
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('nome').addEventListener('input', validarCamposMedico);
            document.getElementById('crm').addEventListener('input', validarCamposMedico);
            document.getElementById('especialidade').addEventListener('input', validarCamposMedico);
            document.getElementById('telefone').addEventListener('input', validarCamposMedico);
            document.getElementById('email').addEventListener('input', validarCamposMedico);
            document.getElementById('senha').addEventListener('input', validarCamposMedico);
            validarCamposMedico();
        });

    </script>
</body>

</html>