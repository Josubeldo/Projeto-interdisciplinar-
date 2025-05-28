<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Portal TEA</title>
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
        .login-container {
            background: rgba(255,255,255,0.95);
            position: relative;
            z-index: 2;
            border-radius: 18px;
            box-shadow: 0 8px 32px 0 rgba(31,38,135,0.15);
            padding: 40px 30px 30px 30px;
            width: 350px;
            position: relative;
            text-align: center;
            animation: slideDown 1s ease;
        }
        @keyframes slideDown {
            from { transform: translateY(-60px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        .login-container img {
            width: 80px;
            margin-bottom: 10px;
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { transform: scale(1);}
            50% { transform: scale(1.07);}
            100% { transform: scale(1);}
        }
        .login-container h2 {
            margin-bottom: 18px;
            color: #b76e79;
        }
        .input-group {
            margin-bottom: 18px;
        }
        .input-group input {
            width: 90%;
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
        .login-btn {
            display: none;
            width: 100%;
            padding: 12px;
            background: #f7cac9;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 1.1em;
            cursor: pointer;
            margin-top: 10px;
            transition: background 0.3s;
        }
        .login-container:hover .login-btn,
        .login-container:focus-within .login-btn {
            display: block;
            animation: fadeIn 0.5s;
        }
        @keyframes fadeIn {
            from { opacity: 0;}
            to { opacity: 1;}
        }
        .login-container small {
            color: #b76e79;
            display: block;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <img src="https://cdn-icons-png.flaticon.com/512/201/201818.png" alt="TEA Logo" />
        <h2>Portal TEA</h2>
        <form method="post" action="">
            <div class="input-group">
                <input type="text" name="usuario" placeholder="Usuário" required>
            </div>
            <div class="input-group">
                <input type="password" name="senha" placeholder="Senha" required>
            </div>
            <button class="login-btn" type="submit" name="entrar">Entrar</button>
        </form>
        <small>Bem-vindo! Portal dedicado ao cuidado de pessoas com TEA.</small>
    </div>
    <?php
    if (isset($_POST['entrar'])) {
        // Aqui você pode adicionar a lógica de autenticação
        echo "<script>alert('Login realizado!');</script>";
    }
    ?>
</body>
</html>