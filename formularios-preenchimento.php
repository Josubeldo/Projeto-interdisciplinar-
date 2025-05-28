<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Formulário de Consulta - TEA</title>
</head>
<body>
    <h1>Formulário de Consulta - Paciente com TEA</h1>
    <form method="post" action="">
        <label>Nome do Paciente:</label>
        <input type="text" name="nome_paciente" required><br><br>

        <label>Data de Nascimento:</label>
        <input type="date" name="data_nascimento" required><br><br>

        <label>Nome do Responsável:</label>
        <input type="text" name="responsavel" required><br><br>

        <label>Contato do Responsável:</label>
        <input type="text" name="contato_responsavel" required><br><br>

        <label>Queixa principal:</label>
        <textarea name="queixa_principal" rows="2" cols="40" required></textarea><br><br>

        <label>Histórico médico relevante:</label>
        <textarea name="historico_medico" rows="2" cols="40"></textarea><br><br>

        <label>Medicamentos em uso:</label>
        <input type="text" name="medicamentos"><br><br>

        <label>Diagnóstico de TEA confirmado?</label>
        <select name="diagnostico_tea" required>
            <option value="">Selecione</option>
            <option value="sim">Sim</option>
            <option value="nao">Não</option>
        </select><br><br>

        <label>Comorbidades:</label>
        <input type="text" name="comorbidades"><br><br>

        <label>Habilidades de comunicação:</label>
        <select name="comunicacao" required>
            <option value="">Selecione</option>
            <option value="verbal">Verbal</option>
            <option value="não verbal">Não verbal</option>
            <option value="limitada">Limitada</option>
        </select><br><br>

        <label>Comportamentos repetitivos?</label>
        <select name="comportamentos_repetitivos" required>
            <option value="">Selecione</option>
            <option value="sim">Sim</option>
            <option value="nao">Não</option>
        </select><br><br>

        <label>Sensibilidade sensorial?</label>
        <select name="sensibilidade_sensorial" required>
            <option value="">Selecione</option>
            <option value="sim">Sim</option>
            <option value="nao">Não</option>
        </select><br><br>

        <label>Tipos de alimento que já come:</label>
        <textarea name="tipos_alimento" rows="2" cols="40" required></textarea><br><br>

        <label>Alimentos já testados anteriormente:</label>
        <textarea name="alimentos_testados" rows="2" cols="40"></textarea><br><br>

        <label>Restrições alimentares:</label>
        <input type="text" name="restricoes_alimentares"><br><br>

        <label>Preferências alimentares:</label>
        <input type="text" name="preferencias_alimentares"><br><br>

        <label>Hábitos de sono:</label>
        <input type="text" name="habitos_sono"><br><br>

        <label>Hábitos intestinais:</label>
        <input type="text" name="habitos_intestinais"><br><br>

        <label>Observações adicionais:</label>
        <textarea name="observacoes" rows="2" cols="40"></textarea><br><br>

        <button type="submit" name="enviar">Salvar</button>
    </form>

    <?php
    if (isset($_POST['enviar'])) {
        echo "<p>Formulário enviado com sucesso!</p>";
        // Aqui você pode adicionar o código para salvar os dados no banco de dados
    }
    ?>
</body>
</html>