<?php
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

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de paciente</title>
    <link rel="stylesheet" href="cadastro-pacientes-plus.css">
</head>

<body>
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
                <input type="text" name="cpf" id="cpf" required maxlength="11" pattern="\d{11}"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,11); validarCamposPaciente();">
            </div>
            <div class="input-group">
                <label>RG:</label>
                <input type="text" name="rg">
            </div>
            <div class="input-group">
                <label>Data de Nascimento: <span style="color: #c62828;">*</span></label>
                <input type="date" name="data_nascimento" required min="1900-01-01" max="2099-12-31">
            </div>
            <div class="input-group">
                <label>Sexo: <span style="color: #c62828;">*</span></label>
                <select name="sexo" id="sexo" required onchange="mostrarOutroSexo()">
                    <option value="">Selecione</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Feminino">Feminino</option>
                    <option value="Outro">Outro</option>
                </select>
                <input type="text" name="outro_sexo" id="outro_sexo" placeholder="Descreva o sexo"
                    style="display:none; margin-top:8px;" />
                <label id="label_outro_sexo" style="display:none; color: #c62828; font-size: 0.95em;">Descreva o sexo:
                    *</label>
            </div>
            <div class="input-group">
                <label>Celular:</label>
                <input type="tel" name="celular" id="celular" required maxlength="11" pattern="\d{11}"
                    placeholder="DDD + número" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,11);">
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

    </div>
    <script>
        function mostrarOutroSexo() {
            var select = document.getElementById('sexo');
            var outro = document.getElementById('outro_sexo');
            var label = document.getElementById('label_outro_sexo');
            if (select.value === 'Outro') {
                outro.style.display = 'block';
                outro.setAttribute('required', 'required');
                label.style.display = 'block';
            } else {
                outro.style.display = 'none';
                outro.removeAttribute('required');
                outro.value = '';
                label.style.display = 'none';
            }
        }
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('sexo').addEventListener('change', mostrarOutroSexo);
        });
    </script>
    <script>
        function validarCamposPaciente() {
            var nome = document.querySelector('input[name="nome"]').value.trim();
            var cpf = document.querySelector('input[name="cpf"]').value.trim();
            var data_nascimento = document.querySelector('input[name="data_nascimento"]').value.trim();
            var sexo = document.querySelector('select[name="sexo"]').value.trim();
            var outroSexo = document.getElementById('outro_sexo');
            var btn = document.querySelector('.cadastro-btn');

            // Se sexo for "Outro", o campo de descrição também é obrigatório
            var outroSexoValido = true;
            if (sexo === "Outro") {
                outroSexoValido = outroSexo.value.trim() !== "";
            }

            if (nome && cpf && data_nascimento && sexo && outroSexoValido) {
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
            document.getElementById('outro_sexo').addEventListener('input', validarCamposPaciente);
            validarCamposPaciente();
        });
    </script>
</body>

</html>