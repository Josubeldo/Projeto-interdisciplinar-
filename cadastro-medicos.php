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
    <style>
        body {
            background: linear-gradient(120deg, #f7cac9 0%, #f9e79f 100%);
            font-family: Arial, sans-serif;
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .cadastro-container {
            background: rgba(255, 255, 255, 0.95);
            position: relative;
            z-index: 2;
            border-radius: 18px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
            padding: 40px 30px 30px 30px;
            width: 370px;
            text-align: center;
            animation: slideDown 1s ease;
        }

        @keyframes slideDown {
            from {
                transform: translateY(-60px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .cadastro-container img {
            width: 80px;
            margin-bottom: 10px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.07);
            }

            100% {
                transform: scale(1);
            }
        }

        .cadastro-container h1 {
            margin-bottom: 18px;
            color: #b76e79;
        }

        .input-group {
            margin-bottom: 18px;
            text-align: left;
        }

        .input-group label {
            color: #b76e79;
            font-weight: bold;
            margin-bottom: 3px;
            display: block;
        }

        .input-group input {
            width: 95%;
            padding: 10px;
            border: none;
            border-radius: 8px;
            background: #ffe5d9;
            color: #b76e79;
            font-size: 1em;
            outline: none;
            transition: background 0.3s;
        }

        .input-group input:focus {
            background: #f9e79f;
        }

        .cadastro-btn {
            display: none;
            width: 100%;
            padding: 12px;
            background: #cccccc;
            color: #888888;
            border: none;
            border-radius: 8px;
            font-size: 1.1em;
            cursor: not-allowed;
            margin-top: 10px;
            transition: background 0.3s, color 0.3s;
            opacity: 0.7;
        }

        .cadastro-btn:enabled {
            cursor: pointer;
            opacity: 1;
        }

        .cadastro-btn:enabled:hover,
        .cadastro-btn:enabled:focus {
            background: #c62828;
            color: #fff;
        }

        .cadastro-container:hover .cadastro-btn,
        .cadastro-container:focus-within .cadastro-btn {
            display: block;
            animation: fadeIn 0.5s;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .cadastro-container small {
            color: #b76e79;
            display: block;
            margin-top: 10px;
        }

        .mensagem {
            margin-bottom: 15px;
            color: #27ae60;
            font-weight: bold;
        }

        .erro {
            margin-bottom: 15px;
            color: #c0392b;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="cadastro-container">
        <img src="https://cdn-icons-png.flaticon.com/512/201/201818.png" alt="TEA Logo" />
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
        </form>
        <small>Bem-vindo! Cadastre médicos para o Portal TEA.</small>
    </div>
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