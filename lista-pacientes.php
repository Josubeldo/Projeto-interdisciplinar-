<?php
// Protege a página (opcional, caso use login)
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
    $sql = "SELECT nome, cpf, data_nascimento, sexo, celular, email FROM pacientes ORDER BY nome";
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
</head>
<body>
    <div class="lista-container">
        <img src="https://cdn-icons-png.flaticon.com/512/201/201818.png" alt="TEA Logo" />
        <h1>Pacientes Cadastrados</h1>
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
                    <p><strong>Celular:</strong> <?= htmlspecialchars($p['celular']) ?></p>
                    <p><strong>Email:</strong> <?= htmlspecialchars($p['email']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        <a href="dashboard.php" class="voltar-btn">Voltar ao Dashboard</a>
    </div>
</body>
</html>