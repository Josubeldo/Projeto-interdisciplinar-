<?php
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
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Médicos</title>
</head>
<body>
    <h1>Cadastro de Médicos</h1>
    <form method="POST" action="">
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="crm">CRM:</label><br>
        <input type="text" id="crm" name="crm" required><br><br>

        <label for="especialidade">Especialidade:</label><br>
        <input type="text" id="especialidade" name="especialidade" required><br><br>

        <label for="telefone">Telefone:</label><br>
        <input type="text" id="telefone" name="telefone" required><br><br>

        <label for="email">E-mail:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="senha">Senha:</label><br>
        <input type="password" id="senha" name="senha" required><br><br>

        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>