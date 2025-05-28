<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de paciente</title>
</head>
<body>
    <h1>Cadastro de Paciente</h1>
    <form method="post" action="">
        <label>Nome Completo:</label>
        <input type="text" name="nome" required><br><br>

        <label>CPF:</label>
        <input type="text" name="cpf" required><br><br>

        <label>RG:</label>
        <input type="text" name="rg"><br><br>

        <label>Data de Nascimento:</label>
        <input type="date" name="data_nascimento" required><br><br>

        <label>Sexo:</label>
        <select name="sexo" required>
            <option value="">Selecione</option>
            <option value="Masculino">Masculino</option>
            <option value="Feminino">Feminino</option>
            <option value="Outro">Outro</option>
        </select><br><br>


        <label>Celular:</label>
        <input type="text" name="celular"><br><br>

        <label>Email:</label>
        <input type="email" name="email"><br><br>

        <label>Endereço:</label>
        <input type="text" name="endereco"><br><br>

        <label>Número:</label>
        <input type="text" name="numero"><br><br>

        <label>Complemento:</label>
        <input type="text" name="complemento"><br><br>

        <label>Bairro:</label>
        <input type="text" name="bairro"><br><br>

        <label>Cidade:</label>
        <input type="text" name="cidade"><br><br>

        <label>Estado:</label>
        <input type="text" name="estado"><br><br>

        <label>CEP:</label>
        <input type="text" name="cep"><br><br>

        <label>Nacionalidade:</label>
        <input type="text" name="nacionalidade"><br><br>


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

        // Coleta e escapa os dados do formulário
        $nome = $conn->real_escape_string($_POST['nome']);
        $cpf = $conn->real_escape_string($_POST['cpf']);
        $rg = $conn->real_escape_string($_POST['rg']);
        $data_nascimento = $conn->real_escape_string($_POST['data_nascimento']);
        $sexo = $conn->real_escape_string($_POST['sexo']);
        $estado_civil = $conn->real_escape_string($_POST['estado_civil']);
        $telefone = $conn->real_escape_string($_POST['telefone']);
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
        $profissao = $conn->real_escape_string($_POST['profissao']);
        $empresa = $conn->real_escape_string($_POST['empresa']);
        $convenio = $conn->real_escape_string($_POST['convenio']);
        $num_convenio = $conn->real_escape_string($_POST['num_convenio']);

        $sql = "INSERT INTO pacientes (
            nome, cpf, rg, data_nascimento, sexo, estado_civil, telefone, celular, email, endereco, numero, complemento, bairro, cidade, estado, cep, nacionalidade, profissao, empresa, convenio, num_convenio
        ) VALUES (
            '$nome', '$cpf', '$rg', '$data_nascimento', '$sexo', '$estado_civil', '$telefone', '$celular', '$email', '$endereco', '$numero', '$complemento', '$bairro', '$cidade', '$estado', '$cep', '$nacionalidade', '$profissao', '$empresa', '$convenio', '$num_convenio'
        )";

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