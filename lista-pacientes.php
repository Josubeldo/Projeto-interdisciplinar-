<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if (!isset($_SESSION['medico_id'])) {
    header("Location: login.php");
    exit();
}

// Conexão com o banco de dados
$servername = "localhost";
$username = "dbusertea";
$password = "ProjetoInterdisciplinar";
$dbname = "projeto_tea";

$conn = new mysqli($servername, $username, $password, $dbname);

$pacientes = [];
if (!$conn->connect_error) {
    $sql = "SELECT id, nome, cpf, data_nascimento, sexo, endereco, telefone, email FROM pacientes ORDER BY nome";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $pacientes[] = $row;
        }
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Pacientes</title>
    <link rel="stylesheet" href="lista-pacientes.css">
    <link rel="stylesheet" href="lista-pacientes-atualizado.css">
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
    <div class="lista-container">
        <img src="https://cdn-icons-png.flaticon.com/512/201/201818.png" alt="TEA Logo" />
        <h1>Pacientes Cadastrados</h1>
        <?php if (isset($_GET['sucesso']) && $_GET['sucesso'] == 1): ?>
            <div class="mensagem">Paciente cadastrado com sucesso!</div>
        <?php endif; ?>
        <a href="cadastro-pacientes.php" class="novo-btn">+ Novo Paciente</a>
        <?php if (empty($pacientes)): ?>
            <div class="mensagem">Nenhum paciente cadastrado.</div>
        <?php else: ?>
        <div class="pacientes-grid">
            <?php foreach ($pacientes as $p): ?>
                <div class="paciente-card">
                    <h2><?= htmlspecialchars($p['nome']) ?></h2>
                    <p><strong>CPF:</strong> <?= htmlspecialchars($p['cpf']) ?></p>
                    <p><strong>Data Nasc.:</strong> <?= date('d/m/Y', strtotime($p['data_nascimento'])) ?></p>
                    <p><strong>Sexo:</strong> <?= htmlspecialchars($p['sexo']) ?></p>
                    <p><strong>Endereço:</strong> <?= htmlspecialchars($p['endereco']) ?></p>
                    <p><strong>Telefone:</strong> <?= htmlspecialchars($p['telefone']) ?></p>
                    <p><strong>Email:</strong> <?= htmlspecialchars($p['email']) ?></p>
                    <a href="cadastro-pacientes.php?id=<?= urlencode($p['id']) ?>" class="editar-btn">Editar</a>
                </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        <a href="dashboard.php" class="voltar-btn">Voltar ao Dashboard</a>
    </div>
</body>
</html>