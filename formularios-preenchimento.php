<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Formulário de Consulta - TEA</title>
    <style>
        :root {
            --primary:rgb(26, 126, 26);         /* Azul escuro */
            --primary-light: #3949ab;   /* Azul médio */
            --secondary:rgb(46, 46, 46);       /* Vermelho escuro */
            --secondary-light: #e57373; /* Vermelho claro */
            --background: #f5f5f5;      /* Cinza claro */
            --input-bg: #e3eafc;        /* Azul bem claro */
            --input-focus:rgb(214, 214, 214);     /* Amarelo claro */
            --text: #222;
        }
        body {
            background-image: url(imagens/maca.jpeg);
            font-family:'Times New Roman', Times, serif;
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .form-container {
            background: rgba(255,255,255,0.98);
            position: relative;
            z-index: 2;
            border-radius: 18px;
            box-shadow: 0 8px 32px 0 rgba(31,38,135,0.18);
            padding: 40px 30px 30px 30px;
            width: 420px;
            animation: slideDown 1s ease;
        }
        @keyframes slideDown {
            from { transform: translateY(-60px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        .form-container img {
            width: 80px;
            margin-bottom: 10px;
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { transform: scale(1);}
            50% { transform: scale(1.07);}
            100% { transform: scale(1);}
        }
        .form-container h1 {
            margin-bottom: 18px;
            color: var(--primary);
            text-align: center;
        }
        .form-group {
            margin-bottom: 16px;
        }
        .form-group label {
            display: block;
            color: var(--secondary);
            margin-bottom: 4px;
            font-weight: bold;
        }
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 96%;
            padding: 8px;
            border: none;
            border-radius: 8px;
            background: var(--input-bg);
            color: var(--primary);
            font-size: 1em;
            outline: none;
            transition: background 0.3s;
            margin-bottom: 4px;
        }
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            background: var(--input-focus);
        }
        .submit-btn {
            display: none;
            width: 100%;
            padding: 12px;
            background: #cccccc; /* cinza sem cor */
            color: #888888;
            border: none;
            border-radius: 8px;
            font-size: 1.1em;
            cursor: not-allowed;
            margin-top: 10px;
            transition: background 0.3s, color 0.3s;
            opacity: 0.7;
        }
        .submit-btn:enabled {
            cursor: pointer;
            opacity: 1;
        }
        .submit-btn:enabled:hover,
        .submit-btn:enabled:focus {
            background: var(--secondary);
            color: #fff;
        }
        .form-container:hover .submit-btn,
        .form-container:focus-within .submit-btn {
            display: block;
            animation: fadeIn 0.5s;
        }
        @keyframes fadeIn {
            from { opacity: 0;}
            to { opacity: 1;}
        }
        .form-container small {
            color: var(--primary);
            display: block;
            margin-top: 10px;
            text-align: center;
        }
        .success-message {
            color: var(--secondary);
            text-align: center;
            margin-top: 10px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <img src="https://cdn-icons-png.flaticon.com/512/201/201818.png" alt="TEA Logo" />
        <h1>Formulário de Consulta - Paciente com TEA</h1>
        <form method="post" action="" id="formularioConsulta">
            <div class="form-group">
                <label>Nome do Paciente: <span style="color: var(--secondary);">*</span></label>
                <input type="text" name="nome_paciente" id="nome_paciente" required>
            </div>
            <!-- Substitua o campo de data de nascimento por um campo de data completo, limitando o ano -->
            <div class="form-group">
                <label>Data de Nascimento: <span style="color: var(--secondary);">*</span></label>
                <input 
                    type="date" 
                    name="data_nascimento" 
                    id="data_nascimento" 
                    required 
                    min="1900-01-01" 
                    max="2099-12-31"
                    onchange="validarCamposObrigatorios();"
                >
            </div>
            <div class="form-group">
                <label>Nome do Responsável: <span style="color: var(--secondary);">*</span></label>
                <input type="text" name="responsavel" id="responsavel" required>
            </div>
            <div class="form-group">
                <label>Contato do Responsável: <span style="color: var(--secondary);">*</span></label>
                <input type="text" name="contato_responsavel" id="contato_responsavel" required>
            </div>
            <div class="form-group">
                <label>Diagnóstico de TEA confirmado? <span style="color: var(--secondary);">*</span></label>
                <select name="diagnostico_tea" id="diagnostico_tea" required onchange="mostrarCampoDiagnostico(); validarCamposObrigatorios();">
                    <option value="">Selecione</option>
                    <option value="sim">Sim</option>
                    <option value="nao">Não</option>
                </select>
                <label id="label_qual_diagnostico" style="display:none; margin-top:8px;">
                    Descreva o diagnóstico: <span style="color: var(--secondary);">*</span>
                </label>
                <input type="text" name="qual_diagnostico" id="qual_diagnostico" placeholder="Descreva o diagnóstico" style="display:none; margin-top:4px;"/>
            </div>
            <div class="form-group">
                <label>Queixa principal:</label>
                <textarea name="queixa_principal" rows="2" cols="40" required></textarea>
            </div>
            <div class="form-group">
                <label>Histórico médico relevante:</label>
                <textarea name="historico_medico" rows="2" cols="40"></textarea>
            </div>
            <div class="form-group">
                <label>Medicamentos em uso:</label>
                <input type="text" name="medicamentos">
            </div>
            <div class="form-group">
                <label>Comorbidades:</label>
                <input type="text" name="comorbidades">
            </div>
            <div class="form-group">
                <label>Habilidades de comunicação:</label>
                <select name="comunicacao" required>
                    <option value="">Selecione</option>
                    <option value="verbal">Verbal</option>
                    <option value="não verbal">Não verbal</option>
                    <option value="limitada">Limitada</option>
                </select>
            </div>
            <div class="form-group">
                <label>Comportamentos repetitivos?</label>
                <select name="comportamentos_repetitivos" id="comportamentos_repetitivos" required onchange="mostrarOpcoesComportamento()">
                    <option value="">Selecione</option>
                    <option value="sim">Sim</option>
                    <option value="nao">Não</option>
                    <option value="as vezes">Às vezes</option>
                    <option value="não observado">Não observado</option>
                </select>
            </div>
            <div class="form-group" id="opcoes_comportamento" style="display:none;">
                <label>Quais comportamentos?</label>
                <select name="tipo_comportamento" id="tipo_comportamento" onchange="mostrarCampoOutroComportamento()">
                    <option value="">Selecione</option>
                    <option value="movimentos repetitivos">Movimentos repetitivos (mãos, balançar, etc)</option>
                    <option value="ecolalia">Ecolalia (repetição de palavras/frases)</option>
                    <option value="alinhamento de objetos">Alinhamento de objetos</option>
                    <option value="rotinas rígidas">Rotinas rígidas</option>
                    <option value="outros">Outros</option>
                </select>
                <div id="grau_comportamento_container" style="display:none; margin-top:8px;">
                    <label for="grau_comportamento">Grau:</label>
                    <select name="grau_comportamento" id="grau_comportamento">
                        <option value="">Selecione o grau</option>
                        <option value="muito leve">Muito leve</option>
                        <option value="leve">Leve</option>
                        <option value="moderado">Moderado</option>
                        <option value="grave">Grave</option>
                        <option value="muito grave">Muito grave</option>
                    </select>
                </div>
                <input type="text" name="outro_comportamento" id="outro_comportamento" placeholder="Descreva o comportamento" style="display:none; margin-top:8px;"/>
            </div>
            <div class="form-group">
                <label>Sensibilidade sensorial?</label>
                <select name="sensibilidade_sensorial" id="sensibilidade_sensorial" required onchange="mostrarOpcoesSensorial()">
                    <option value="">Selecione</option>
                    <option value="sim">Sim</option>
                    <option value="nao">Não</option>
                </select>
            </div>
            <div class="form-group" id="opcoes_sensorial" style="display:none;">
                <label>Tipo de sensibilidade:</label>
                <select name="tipo_sensibilidade" id="tipo_sensibilidade" onchange="mostrarGrauSensibilidade()">
                    <option value="">Selecione</option>
                    <option value="auditiva">Auditiva</option>
                    <option value="visual">Visual</option>
                    <option value="tátil">Tátil</option>
                    <option value="olfativa">Olfativa</option>
                    <option value="gustativa">Gustativa</option>
                    <option value="outra">Outra</option>
                </select>
                <div id="grau_sensibilidade_container" style="display:none; margin-top:8px;">
                    <label for="grau_sensibilidade">Grau:</label>
                    <select name="grau_sensibilidade" id="grau_sensibilidade">
                        <option value="">Selecione o grau</option>
                        <option value="muito leve">Muito leve</option>
                        <option value="leve">Leve</option>
                        <option value="moderada">Moderada</option>
                        <option value="grave">Grave</option>
                        <option value="muito grave">Muito grave</option>
                    </select>
                </div>
                <input type="text" name="outra_sensibilidade" id="outra_sensibilidade" placeholder="Descreva a sensibilidade" style="display:none; margin-top:8px;"/>
            </div>
            <div class="form-group">
                <label>Tipos de alimento que já come:</label>
                <textarea name="tipos_alimento" rows="2" cols="40" required></textarea>
            </div>
            <div class="form-group">
                <label>Alimentos já testados anteriormente:</label>
                <textarea name="alimentos_testados" rows="2" cols="40"></textarea>
            </div>
            <div class="form-group">
                <label>Restrições alimentares:</label>
                <input type="text" name="restricoes_alimentares">
            </div>
            <div class="form-group">
                <label>Preferências alimentares:</label>
                <input type="text" name="preferencias_alimentares">
            </div>
            <div class="form-group">
                <label>Hábitos de sono:</label>
                <input type="text" name="habitos_sono">
            </div>
            <div class="form-group">
                <label>Hábitos intestinais:</label>
                <input type="text" name="habitos_intestinais">
            </div>
            <div class="form-group">
                <label>Observações adicionais:</label>
                <textarea name="observacoes" rows="2" cols="40"></textarea>
            </div>
            <button class="submit-btn" type="submit" name="enviar" id="btnSalvar" disabled>Salvar</button>
        </form>
        <small>Preencha todos os campos necessários para melhor acompanhamento do paciente.</small>
        <?php
        if (isset($_POST['enviar'])) {
            echo '<div class="success-message">Formulário enviado com sucesso!</div>';
            // Aqui você pode adicionar o código para salvar os dados no banco de dados
        }
        ?>
    </div>
    <script>
        function mostrarOpcoesComportamento() {
            var select = document.getElementById('comportamentos_repetitivos');
            var opcoes = document.getElementById('opcoes_comportamento');
            if (select.value === 'sim' || select.value === 'as vezes') {
                opcoes.style.display = 'block';
            } else {
                opcoes.style.display = 'none';
                document.getElementById('outro_comportamento').style.display = 'none';
                document.getElementById('tipo_comportamento').value = '';
                document.getElementById('grau_comportamento_container').style.display = 'none';
                document.getElementById('grau_comportamento').value = '';
            }
        }
        function mostrarCampoOutroComportamento() {
            var tipo = document.getElementById('tipo_comportamento');
            var campoOutro = document.getElementById('outro_comportamento');
            var grauContainer = document.getElementById('grau_comportamento_container');
            if (tipo.value && tipo.value !== '') {
                grauContainer.style.display = 'block';
            } else {
                grauContainer.style.display = 'none';
                document.getElementById('grau_comportamento').value = '';
            }
            if (tipo.value === 'outros') {
                campoOutro.style.display = 'block';
            } else {
                campoOutro.style.display = 'none';
                campoOutro.value = '';
            }
        }
        function mostrarOpcoesSensorial() {
            var select = document.getElementById('sensibilidade_sensorial');
            var opcoes = document.getElementById('opcoes_sensorial');
            if (select.value === 'sim') {
                opcoes.style.display = 'block';
            } else {
                opcoes.style.display = 'none';
                document.getElementById('tipo_sensibilidade').value = '';
                document.getElementById('outra_sensibilidade').style.display = 'none';
                document.getElementById('outra_sensibilidade').value = '';
            }
        }
        function mostrarCampoDiagnostico() {
            var select = document.getElementById('diagnostico_tea');
            var campo = document.getElementById('qual_diagnostico');
            var label = document.getElementById('label_qual_diagnostico');
            if (select.value === 'sim') {
                campo.style.display = 'block';
                campo.setAttribute('required', 'required');
                label.style.display = 'block';
            } else {
                campo.style.display = 'none';
                campo.value = '';
                campo.removeAttribute('required');
                label.style.display = 'none';
            }
        }
        function mostrarGrauSensibilidade() {
            var tipo = document.getElementById('tipo_sensibilidade');
            var grauContainer = document.getElementById('grau_sensibilidade_container');
            var campoOutro = document.getElementById('outra_sensibilidade');
            if (tipo.value && tipo.value !== '') {
                grauContainer.style.display = 'block';
            } else {
                grauContainer.style.display = 'none';
                document.getElementById('grau_sensibilidade').value = '';
            }
            if (tipo.value === 'outra') {
                campoOutro.style.display = 'block';
            } else {
                campoOutro.style.display = 'none';
                campoOutro.value = '';
            }
        }
        function validarCamposObrigatorios() {
            var nomePaciente = document.getElementById('nome_paciente').value.trim();
            var dataNascimento = document.getElementById('data_nascimento').value.trim();
            var responsavel = document.getElementById('responsavel').value.trim();
            var contato = document.getElementById('contato_responsavel').value.trim();
            var diagnostico = document.getElementById('diagnostico_tea').value.trim();
            var qualDiagnostico = document.getElementById('qual_diagnostico').value.trim();
            var btnSalvar = document.getElementById('btnSalvar');

            // Se diagnóstico for "sim", o campo de descrição também é obrigatório
            if (
                nomePaciente &&
                dataNascimento &&
                responsavel &&
                contato &&
                diagnostico &&
                (diagnostico !== 'sim' || (diagnostico === 'sim' && qualDiagnostico))
            ) {
                btnSalvar.disabled = false;
            } else {
                btnSalvar.disabled = true;
            }
        }

        // Adiciona listeners para os campos obrigatórios
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('nome_paciente').addEventListener('input', validarCamposObrigatorios);
            document.getElementById('data_nascimento').addEventListener('input', validarCamposObrigatorios);
            document.getElementById('responsavel').addEventListener('input', validarCamposObrigatorios);
            document.getElementById('contato_responsavel').addEventListener('input', validarCamposObrigatorios);
            document.getElementById('diagnostico_tea').addEventListener('change', validarCamposObrigatorios);
            document.getElementById('qual_diagnostico').addEventListener('input', validarCamposObrigatorios);

            // Chama a validação ao carregar a página
            validarCamposObrigatorios();
        });

        window.onload = function() {
            mostrarOpcoesComportamento();
            mostrarCampoOutroComportamento();
            mostrarOpcoesSensorial();
            mostrarCampoDiagnostico();
            mostrarGrauSensibilidade();
        }
    </script>
</body>
</html>