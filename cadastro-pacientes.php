<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['cadastrar'])) {
    $servername = "localhost";
    $username = "dbusertea";
    $password = "ProjetoInterdisciplinar";
    $dbname = "projeto_tea";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        echo "<div class='erro'>Falha na conexão: " . $conn->connect_error . "</div>";
    } else {
        // Coleta e escapa os dados do formulário
        $nome = $conn->real_escape_string($_POST['nome']);
        $cpf = $conn->real_escape_string($_POST['cpf']);
        $data_nascimento = $conn->real_escape_string($_POST['data_nascimento']);
        $sexo = $conn->real_escape_string($_POST['sexo']);
        $endereco = $conn->real_escape_string($_POST['endereco']);
        $telefone = $conn->real_escape_string($_POST['telefone']);
        $email = $conn->real_escape_string($_POST['email']);

        $sql = "INSERT INTO pacientes (
                    nome, cpf, data_nascimento, sexo, endereco, telefone, email
                ) VALUES (
                    '$nome', '$cpf', '$data_nascimento', '$sexo', '$endereco', '$telefone', '$email'
                )";

        if ($conn->query($sql) === TRUE) {
            header("Location: lista-pacientes.php?sucesso=1");
            exit();
        } else {
            echo "<div class='erro'>Erro: " . $conn->error . "</div>";
        }

        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de paciente</title>
    <link rel="stylesheet" href="cadastro-pacientes-plus.css">
</head>

<body>
    <!--CABEÇALHO-->
    <!-- <header class="cabecalho">
        <h2 class="titulo">Nutri Kids</h2>
        <nav class="menu">
            <a href="lista-pacientes.php">Pacientes</a>
            <a href="logout.php">Logout</a>
            <a href="dashboard.php" class="voltar_menu"><i class="fas fa-home"></i></a>
        </nav>
    </header> -->
    <!--FIM CABEÇALHO-->
    <div class="cadastro-container">
        <img src="https://cdn-icons-png.flaticon.com/512/201/201818.png" alt="TEA Logo" />
        <h1>Cadastro de Paciente</h1>
        <form method="post" action="">
            <div class="input-group">
                <label>Nome Completo: <span style="color: #c62828;">*</span></label>
                <input type="text" name="nome" required>
            </div>
            <div class="input-group">
                <label>CPF: <span style="color: #c62828;">*</span></label>
                <input type="text" name="cpf" id="cpf" required maxlength="20" pattern="\d{11,20}"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,20); validarCamposPaciente();">
            </div>
            <div class="input-group">
                <label>Data de Nascimento: <span style="color: #c62828;">*</span></label>
                <input type="date" name="data_nascimento" required min="1900-01-01" max="2099-12-31">
            </div>
            <div class="input-group">
                <label>Sexo: <span style="color: #c62828;">*</span></label>
                <select name="sexo" id="sexo" required>
                    <option value="">Selecione</option>
                    <option value="M">Masculino</option>
                    <option value="F">Feminino</option>
                    <option value="O">Outro</option>
                </select>
            </div>
            <div class="input-group">
                <label>Endereço: <span style="color: #c62828;">*</span></label>
                <input type="text" name="endereco" required>
            </div>
            <div class="input-group">
                <label>Telefone: <span style="color: #c62828;">*</span></label>
                <input type="tel" name="telefone" id="telefone" required maxlength="20"
                    placeholder="DDD + número" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,20);">
            </div>
            <div class="input-group">
                <label>Email:</label>
                <input type="email" name="email">
            </div>
            <button class="cadastro-btn" type="submit" name="cadastrar">Cadastrar</button>
        </form>
        <small>Bem-vindo! Cadastre pacientes para o Portal TEA.</small>
    </div>
    <script>
        function validarCamposPaciente() {
            var nome = document.querySelector('input[name="nome"]').value.trim();
            var cpf = document.querySelector('input[name="cpf"]').value.trim();
            var data_nascimento = document.querySelector('input[name="data_nascimento"]').value.trim();
            var sexo = document.querySelector('select[name="sexo"]').value.trim();
            var endereco = document.querySelector('input[name="endereco"]').value.trim();
            var telefone = document.querySelector('input[name="telefone"]').value.trim();
            var btn = document.querySelector('.cadastro-btn');

            if (nome && cpf && data_nascimento && sexo && endereco && telefone) {
                btn.disabled = false;
            } else {
                btn.disabled = true;
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            document.querySelector('input[name="nome"]').addEventListener('input', validarCamposPaciente);
            document.querySelector('input[name="cpf"]').addEventListener('input', validarCamposPaciente);
            document.querySelector('input[name="data_nascimento"]').addEventListener('input', validarCamposPaciente);
            document.querySelector('select[name="sexo"]').addEventListener('change', validarCamposPaciente);
            document.querySelector('input[name="endereco"]').addEventListener('input', validarCamposPaciente);
            document.querySelector('input[name="telefone"]').addEventListener('input', validarCamposPaciente);
            validarCamposPaciente();
        });
    </script>
</body>

</html>