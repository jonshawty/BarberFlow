<?php 
@session_start();
include "../config/config.php";
date_default_timezone_set('America/Sao_Paulo');
$idBarbearia = $_SESSION["barbearia_id"];
$diaSemana = date("Y-m-d");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Controle</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Adicione o link para o Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Adicione seus estilos CSS personalizados aqui -->
    <style>
        /* Adicione estilos personalizados aqui */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
        }

        .container-fluid {
            padding: 20px;
        }

        .card {
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .headerIcon {
            font-size: 18px;
        }

        .card-category {
            font-size: 14px;
            color: #fff;
        }

        .card-data {
            font-size: 24px;
            font-weight: bold;
        }

        .hr-card {
            margin-top: 20px;
        }
        
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Total de Serviços Agendados -->
            <div class="col-md-4">
                <div class="card">
                    <div class="headerIcon">
                        <i class="fas fa-clock"></i> Serviços agendados para o dia
                    </div>
                    <div class="text-right mt-2">
                        <p class="card-category">Total de agendamentos</p>
                        <p class="card-data">
                            <?php  
                            $resultTotServicos = $mysqli->query("CALL PROC_TOTAL_SERVICOS_DIA('{$diaSemana}', '{$idBarbearia}')");
                            $rowTotServicos = $resultTotServicos->fetch_assoc();
                            echo $rowTotServicos["quantidade"];
                            $mysqli->next_result();
                            ?>
                        </p>
                    </div>
                    <hr class="hr-card">
                    <div class="cd-footer mb-3 pb-2">
                        <a href="servicos-agendados" class="text-dark">
                            <i class="fas fa-eye"></i> Visualizar os serviços agendados
                        </a>
                    </div>
                </div>
            </div>

            <!-- Lucro Diário -->
            <div class="col-md-4">
                <div class="card">
                    <div class="headerIcon">
                        <i class="fas fa-money-bill-wave"></i> Lucro diário
                    </div>
                    <div class="text-right mt-2">
                        <p class="card-category">Lucro total</p>
                        <p class="card-data">
                            <?php     
                            $resultLucroDiario = $mysqli->query("CALL PROC_LUCRO_TOTAL_DIA('{$diaSemana}', '{$idBarbearia}')");
                            if($mysqli->affected_rows > 0){
                                $rowLucroDiario = $resultLucroDiario->fetch_assoc();
                                echo "R$ {$rowLucroDiario["lucro_total"]}";
                            }
                            else{
                                echo "R$ 0,00";
                            }
                            $mysqli->next_result();
                            ?>
                        </p>
                    </div>
                    <hr class="hr-card">
                    <div class="cd-footer mb-3 pb-2">
                        <a href="servicos-agendados" class="text-dark">
                            <i class="fas fa-eye"></i> Visualizar os serviços agendados
                        </a>
                    </div>
                </div>
            </div>

            <!-- Serviço mais Requisitado -->
            <div class="col-md-4">
                <div class="card">
                    <div class="headerIcon">
                        <i class="fas fa-clock"></i> Serviço mais requisitado do dia
                    </div>
                    <div class="text-right mt-2">
                        <p class="card-category">Serviço</p>
                        <p class="card-data">
                            <?php     
                            $resultLucroDiario = $mysqli->query("CALL PROC_SERVICO_MAIS_REQUISITADO('{$diaSemana}', '{$idBarbearia}')");
                            if($mysqli->affected_rows > 0){
                                $rowLucroDiario = $resultLucroDiario->fetch_assoc();
                                echo $rowLucroDiario["nome"];
                            }
                            else{
                                echo "Sem dados";
                            }
                            $mysqli->next_result();
                            ?>
                        </p>
                    </div>
                    <hr class="hr-card">
                    <div class="cd-footer mb-3 pb-2">
                        <a href="cadastrar-servicos" class="text-dark">
                            <i class="fas fa-eye"></i> Visualizar os serviços cadastrados
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gráfico de Serviços Diários -->
        <div class="row">
            <div class="col-md-12">
                <div class="graph">
                <canvas id="barChart" ></canvas>
                </div>
                <div class="graph-body col-12">
                    <p class="pt-2 pb-2">
                        <span><i class="fas fa-money-bill-wave"></i> Serviços diários</span>
                    </p>
                </div>
            </div>
        </div>

<!-- Gráfico de Lucros Mensais -->
<div class="row">
    <div class="col-md-12 mx-auto"> <!-- Centralizar o gráfico na página -->
        <div class="graph">
            <canvas id="chartLucros" width="400" height="200"></canvas>
        </div>
        <div class="graph-body col-12">
            <p class="pt-2 pb-2">
                <span><i class="fas fa-money-bill-wave"></i> Lucro mensal</span>
            </p>
        </div>
    </div>
</div>

</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<!-- JavaScript para criar o gráfico de lucros mensais -->
<script>
// Seu código PHP para obter dados do banco de dados
<?php
// Dados fictícios para exibição do gráfico
$meses = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho"];
$lucros = [1000, 1500, 2000, 1800, 2500, 2200];
?>

// Configuração do gráfico de lucros mensais
var ctxLucros = document.getElementById('chartLucros').getContext('2d');
var chartLucros = new Chart(ctxLucros, {
    type: 'line',
    data: {
        labels: <?php echo json_encode($meses); ?>,
        datasets: [{
            label: 'Lucro Mensal',
            data: <?php echo json_encode($lucros); ?>,
            borderColor: 'rgba(255, 0, 0, 1)', // Vermelho
            borderWidth: 2,
            fill: false,
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    color: 'rgba(0, 0, 0, 0.0)' // Preto para as linhas de grade no eixo Y
                }
            },
            x: {
                grid: {
                    color: 'rgba(0, 0, 0, 0.0)' // Preto para as linhas de grade no eixo X
                }
            }
        },
        plugins: {
            legend: {
                display: true,
                position: 'top',
                labels: {
                    color: 'rgba(0, 0, 0, 1)' // Preto para os textos da legenda
                }
            },
            title: {
                display: true,
                text: 'Gráfico de Lucro Mensal',
                fontSize: 16,
                color: 'rgba(0, 0, 0, 1)' // Preto para o texto do título
            }
        },
        responsive: true,
        maintainAspectRatio: false,
        elements: {
            point: {
                radius: 5,
                backgroundColor: 'rgba(255, 0, 0, 1)', // Vermelho
                borderWidth: 1,
                borderColor: 'rgba(0, 0, 0, 1)' // Preto para a borda dos pontos
            },
            line: {
                tension: 0.5,
                backgroundColor: 'rgba(255, 0, 0, 1)', // Vermelho claro para a área sob a linha
                borderColor: 'rgba(255, 0, 0, 1)', // Vermelho
                borderWidth: 2
            }
        }
    }
});



</script>

