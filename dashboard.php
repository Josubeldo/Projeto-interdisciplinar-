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
    <link rel="stylesheet" type="text/css" href="dashboard.css">
    <!--<link rel="stylesheet" type="text/css" href="index-plus.css">-->
    <link rel="stylesheet" type="text/css" href="/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/font-awesome/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>NutriVibe</title>
</head>

<body>
    <!--CABEÇALHO-->
    <header class="cabecalho">
        <h2 class="titulo">NutriVibe</h2>
        <nav class="menu">
            <a href="lista-pacientes.php">Pacientes</a>
            <a href="logout.php">Logout</a>
            <a href="dashboard.php" class="voltar_menu">
                <img src="imagens/casa-natural.jpeg">
            </a>
        </nav>
    </header>
    <!--FIM CABEÇALHO-->
    <!--CORPO DA PÁGINA-->
    <main>
        <div class="container mt-5">
            <h2 class="text-center mb-5">Distribuição de Pacientes por Tipo de Alimento</h2>

            <div class="row">
            <div class="col-md-6">
                <h3>Alimentos in natura ou minimamente processados:</h3>
                <p>São alimentos que vêm da natureza ou que sofreram apenas um tratamento mínimo para facilitar o consumo, como lavar, secar ou congelar. Exemplos: frutas, legumes, verduras, ovos, leite, carnes e feijão.</p>

                <h3>Ingredientes culinários:</h3>
                <p>São alimentos usados para dar sabor ou modificar o sabor dos alimentos in natura, como sal, açúcar, óleos e gorduras.</p>

                <h3>Alimentos processados:</h3>
                <p>São alimentos que passaram por transformações mais complexas, com adição de ingredientes ou processos de industrialização, como conservas, queijos, pães, massas e doces.</p>

                <h3>Alimentos ultraprocessados:</h3>
                <p>São alimentos que passaram por várias etapas de industrialização e adição de ingredientes, com adição de conservantes, corantes e aromatizantes. Exemplos: refrigerantes, bolos, biscoitos e salgadinhos.</p>
            </div>

            <div class="col-md-6 d-flex align-items-center justify-content-center">
                <canvas id="pizzaChart" style="max-width: 100%; height: auto;"></canvas>
            </div>
            </div>
        </div>

        <div class="container mt-5">
            <h2 class="text-center mb-4">Escalada do Comer</h2>
            <div class="row justify-content-center">
            <div class="col-md-12">
                <canvas id="toleranciaChart"></canvas>
            </div>
            </div>
            <p class="text-center mt-4">
            Análise estatística sobre sua progressão alimentar referente a tolerância de novos alimentos e refeições.
            </p>
        </div>

        <script>
            const pizzaLabels = ['Alimentos in natura', 'Ingredientes culinários', 'Alimentos processados', 'Alimentos ultraprocessados'];
            const pizzaData = [13, 8, 5, 2];

            new Chart(document.getElementById('pizzaChart').getContext('2d'), {
            type: 'pie',
            data: {
                labels: pizzaLabels,
                datasets: [{
                data: pizzaData,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(153, 102, 255, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                legend: {
                    position: 'top'
                },
                tooltip: {
                    enabled: true
                }
                }
            }
            });

            const months = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];
            const evolutionLevels = {
            0: 'Visual',
            1: 'Tato',
            2: 'Sabor',
            3: 'Comer'
            };
            const progressionData = [0, 0.5, 1, 0.75, 1.5, 2, 2.5, 2, 2.75, 3, 3, 3];

            new Chart(document.getElementById('toleranciaChart').getContext('2d'), {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                label: 'Nível de Tolerância',
                data: progressionData,
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                fill: true,
                tension: 0.3,
                pointRadius: 5,
                pointBackgroundColor: 'rgba(75, 192, 192, 1)'
                }]
            },
            options: {
                responsive: true,
                scales: {
                y: {
                    beginAtZero: true,
                    min: 0,
                    max: 3,
                    ticks: {
                    stepSize: 0.25,
                    callback: function(value) {
                        return evolutionLevels[value] || '';
                    }
                    },
                    title: {
                    display: true,
                    text: 'Escalada do Comer'
                    }
                },
                x: {
                    title: {
                    display: true,
                    text: 'Evolução referente ao ano de 2025'
                    }
                }
                },
                plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                    label: function(context) {
                        let level = context.parsed.y;
                        let label = evolutionLevels[Math.round(level)] || `Progresso: ${level.toFixed(2)}`;
                        return `Evolução: ${label}`;
                    }
                    }
                }
                }
            }
            });
        </script>
    </main>

</body>
</html>