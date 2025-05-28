<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de paciente</title>
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
            background: rgba(255,255,255,0.95);
            position: relative;
            z-index: 2;
            border-radius: 18px;
            box-shadow: 0 8px 32px 0 rgba(31,38,135,0.15);
            padding: 40px 30px 30px 30px;
            width: 400px;
            text-align: center;
            animation: slideDown 1s ease;
        }
        @keyframes slideDown {
            from { transform: translateY(-60px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        .cadastro-container img {
            width: 80px;
            margin-bottom: 10px;
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { transform: scale(1);}
            50% { transform: scale(1.07);}
            100% { transform: scale(1);}
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
        .input-group input,
        .input-group select {
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
        .input-group input:focus,
        .input-group select:focus {
            background: #f9e79f;
        }
        .cadastro-btn {
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
        .cadastro-container:hover .cadastro-btn,
        .cadastro-container:focus-within .cadastro-btn {
            display: block;
            animation: fadeIn 0.5s;
        }
        @keyframes fadeIn {
            from { opacity: 0;}
            to { opacity: 1;}
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
        <h1>Cadastro de Paciente</h1>
        <form method="post" action="">
            <div class="input-group">
                <label>Nome Completo:</label>
                <input type="text" name="nome" required>
            </div>
            <div class="input-group">
                <label>CPF:</label>
                <input type="text" name="cpf" required>
            </div>
            <div class="input-group">
                <label>RG:</label>
                <input type="text" name="rg">
            </div>
            <div class="input-group">
                <label>Data de Nascimento:</label>
                <input type="date" name="data_nascimento" required>
            </div>
            <div class="input-group">
                <label>Sexo:</label>
                <select name="sexo" required>
                    <option value="">Selecione</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Feminino">Feminino</option>
                    <option value="Outro">Outro</option>
                </select>
            </div>
            <div class="input-group">
                <label>Celular:</label>
                <input type="text" name="celular">
            </div>
            <div class="input-group">
                <label>Email:</label>
                <input type="email" name="email">
            </div>
            <div class="input-group">
                <label>Endereço:</label>
                <input type="text" name="endereco">
            </div>
            <div class="input-group">
                <label>Número:</label>
                <input type="text" name="numero">
            </div>
            <div class="input-group">
                <label>Complemento:</label>
                <input type="text" name="complemento">
            </div>
            <div class="input-group">
                <label>Bairro:</label>
                <input type="text" name="bairro">
            </div>
            <div class="input-group">
                <label>Cidade:</label>
                <input type="text" name="cidade">
            </div>
            <div class="input-group">
                <label>Estado:</label>
                <input type="text" name="estado">
            </div>
            <div class="input-group">
                <label>CEP:</label>
                <input type="text" name="cep">
            </div>
            <div class="input-group">
                <label>Nacionalidade:</label>
                <input type="text" name="nacionalidade">
            </div>
            <button class="cadastro-btn" type="submit" name="cadastrar">Cadastrar</button>
        </form>
        <small>Bem-vindo! Cadastre pacientes para o Portal TEA.</small>
        <?php
        if (isset($_POST['cadastrar'])) {
            $servername = "localhost";
            $username = "root";
            $password = ""; // coloque sua senha aqui
            $dbname = "seu_banco"; // coloque o nome do seu banco

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                echo "<div class='erro'>Falha na conexão: " . $conn->connect_error . "</div>";
            } else {
                // Coleta e escapa os dados do formulário
                $nome = $conn->real_escape_string($_POST['nome']);
                $cpf = $conn->real_escape_string($_POST['cpf']);
                $rg = $conn->real_escape_string($_POST['rg']);
                $data_nascimento = $conn->real_escape_string($_POST['data_nascimento']);
                $sexo = $conn->real_escape_string($_POST['sexo']);
                $celular = $conn->real_escape_string($_POST['celular']);
                $email = $conn->real_escape_string($_POST['email']);
                $endereco = $conn->real_escape_string($_POST['endereco']);
                $numero = $conn->real_escape_string($_POST['numero']);
                $complemento = $conn->real_escape_string($_POST['complemento']);
                $bairro = $conn->real_escape_string($_POST['bairro']);
                $cidade = $conn->real_escape_string($_POST['cidade']);
                $estado = $conn->real_escape_string($_POST['estado']);
                $cep = $conn->real_escape_string($_POST['cep']);
                $nacionalidade = $conn->real_escape_string($_POST['nacionalidade']);

                $sql = "INSERT INTO pacientes (
                    nome, cpf, rg, data_nascimento, sexo, celular, email, endereco, numero, complemento, bairro, cidade, estado, cep, nacionalidade
                ) VALUES (
                    '$nome', '$cpf', '$rg', '$data_nascimento', '$sexo', '$celular', '$email', '$endereco', '$numero', '$complemento', '$bairro', '$cidade', '$estado', '$cep', '$nacionalidade'
                )";

                if ($conn->query($sql) === TRUE) {
                    echo "<div class='mensagem'>Paciente cadastrado com sucesso!</div>";
                } else {
                    echo "<div class='erro'>Erro: " . $conn->error . "</div>";
                }

                $conn->close();
            }
        }
        ?>
    </div>
</body>
</html>