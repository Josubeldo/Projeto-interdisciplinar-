<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Portal TEA</title>
    <link rel="stylesheet" href="login-atualizado.css">
</head>
<body>
    <div class="login-container">
        <img src="https://cdn-icons-png.flaticon.com/512/201/201818.png" alt="TEA Logo" />
        <h2>Portal TEA</h2>
        <?php
        if (isset($_GET['cadastro-medico'])) {
            echo "<div class='mensagem-sucesso'>Médico cadastrado com sucesso!<br>Faça login com seu usuário e senha.</div>";
        }
        if (isset($erro_login)) {
            echo "<div class='erro'>$erro_login</div>";
        }
        ?>
        <form method="post" action="">
            <div class="input-group">
                <label for="usuario">Usuário: <span style="color: #c62828;">*</span></label>
                <input type="text" id="usuario" name="usuario" placeholder="Usuário" required>
            </div>
            <div class="input-group">
                <label for="senha">Senha: <span style="color: #c62828;">*</span></label>
                <input type="password" id="senha" name="senha" placeholder="Senha" required>
            </div>
            <button class="login-btn" type="submit" name="entrar">Entrar</button>
        </form>
        <small>Bem-vindo! Portal dedicado ao cuidado de pessoas com TEA.</small>
    </div>
    <?php
    if (isset($_POST['entrar'])) {
        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];

        // Conexão com o banco de dados
        $servername = "localhost";
        $username = "dbusertea";
        $password = "ProjetoInterdisciplinar";
        $dbname = "projeto_tea";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            $erro_login = "Erro de conexão com o banco de dados.";
        } else {
            // Busca o médico pelo email
            $stmt = $conn->prepare("SELECT id, nome, email, senha FROM medicos WHERE email = ?");
            $stmt->bind_param("s", $usuario);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows === 1) {
                $medico = $result->fetch_assoc();
                if (password_verify($senha, $medico['senha'])) {
                    // Login bem-sucedido
                    $_SESSION['medico_id'] = $medico['id'];
                    $_SESSION['medico_nome'] = $medico['nome'];
                    header("Location: dashboard.php");
                    exit();
                } else {
                    $erro_login = "Usuário ou senha inválidos.";
                }
            } else {
                $erro_login = "Usuário ou senha inválidos.";
            }
            $stmt->close();
            $conn->close();
        }
    }
    ?>
    <script>
function validarCamposLogin() {
    var usuario = document.querySelector('input[name="usuario"]').value.trim();
    var senha = document.querySelector('input[name="senha"]').value.trim();
    var btn = document.querySelector('.login-btn');
    if (usuario && senha) {
        btn.disabled = false;
    } else {
        btn.disabled = true;
    }
}
document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('input[name="usuario"]').addEventListener('input', validarCamposLogin);
    document.querySelector('input[name="senha"]').addEventListener('input', validarCamposLogin);
    validarCamposLogin();
});
</script>
</body>
</html>