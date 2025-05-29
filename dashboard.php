<?php
session_start();
if (!isset($_SESSION['medico_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="stylesheet" type="text/css" href="index-plus.css">
    <link rel="stylesheet" type="text/css" href="/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/font-awesome/css/all.min.css">
    <title>Nutri Kids</title>
</head>

<body>
    <!--CABEÇALHO-->
    <header class="cabecalho">
        <h2 class="titulo">Nutri Kids</h2>
        <nav class="menu">
            <a href="lista-pacientes.php">Pacientes</a>
            <a href="logout.php">Logout</a>
            <a href="dashboard.php" class="voltar_menu"><i class="fas fa-home"></i></a>
        </nav>
    </header>
    <!--FIM CABEÇALHO-->
    <!--CORPO DA PÁGINA-->
</body>
</html>