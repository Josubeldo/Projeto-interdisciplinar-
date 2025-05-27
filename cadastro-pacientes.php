<?php
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de paciente</title>
</head>
<body>
    <h1>Cadastro de paciente</h1>
    <form method="post" action="">
        <label>Nome:</label>
        <input type="text" name="nome" required><br><br>
        <label>CPF:</label>
        <input type="text" name="cpf" required><br><br>
        <label>Data de Nascimento:</label>
        <input type="date" name="data_nascimento" required><br><br>
        <button type="submit" name="cadastrar">Cadastrar</button>
    </form>

    <?php
    if (isset($_POST['cadastrar'])) {
        $servername = "localhost";
        $username = "root";
        $password = ""; // coloque sua senha aqui
        $dbname = "seu_banco"; // coloque o nome do seu banco

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Falha na conexão: " . $conn->connect_error);
        }

        $nome = $conn->real_escape_string($_POST['nome']);
        $cpf = $conn->real_escape_string($_POST['cpf']);
        $data_nascimento = $conn->real_escape_string($_POST['data_nascimento']);

        $sql = "INSERT INTO pacientes (nome, cpf, data_nascimento) VALUES ('$nome', '$cpf', '$data_nascimento')";

        if ($conn->query($sql) === TRUE) {
            echo "<p>Paciente cadastrado com sucesso!</p>";
        } else {
            echo "<p>Erro: " . $conn->error . "</p>";
        }

        $conn->close();
    }
    ?>

    
</body>
</html>