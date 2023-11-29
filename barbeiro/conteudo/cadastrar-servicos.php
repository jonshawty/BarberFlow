<?php

require_once "../conteudo/header.php";
?>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Serviços</title>
    <!-- Se você quiser usar ícones regulares, adicione o seguinte link também: -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/cadastrar-servicos.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <!-- Adicione qualquer outra folha de estilo que você desejar aqui -->
</head>
<body>
    <div class="container pt-5">
        <div class="row">
            <!-- Serviços cadastrados -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4>
                            <i class="fas fa-cut"></i> Serviços Cadastrados
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>Preço (R$)</th>
                                        <th>Excluir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include "../config/config.php";
                                    $servicos = $mysqli->query("CALL PROC_SEL_SERVICOS('{$_SESSION["barbearia_id"]}')");
                                    if ($servicos->num_rows > 0) {
                                        while ($rowServico = $servicos->fetch_assoc()) {
                                            echo "
                                                <tr>
                                                    <td>{$rowServico["id_servico"]}</td>
                                                    <td>{$rowServico["nome"]}</td>
                                                    <td>{$rowServico["preco"]}</td>
                                                    <td>
                                                        <a href='./servico/deletar-servico.php?id={$rowServico["id_servico"]}' class='btn btn-danger'>
                                                            <i class='fa fa-trash'></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            ";
                                        }
                                    } else {
                                        echo "<tr><td colspan='4'>Não há serviços cadastrados</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cadastrar Serviço -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h4>
                            <i class="fas fa-plus"></i> Cadastrar Serviço
                        </h4>
                    </div>
                    <div class="card-body">
                        <form class="example-form" method="POST" action="./servico/inserir-servico.php">
                            <div class="form-group">
                                <label for="nome_servico">Nome do Serviço:</label>
                                <input type="text" class="form-control" id="nome_servico" name="nome_servico">
                            </div>
                            <div class="form-group">
                                <label for="valor_servico">Valor:</label>
                                <input type="number" class="form-control" id="valor_servico" name="valor_servico">
                            </div>
                            <button class="btn btn-primary" name="adicionar_servico">
                                <i class="fas fa-plus"></i> Adicionar Serviço
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php

require_once "../../barbeiro/conteudo/footer.php";
require_once "../../barbeiro/conteudo/scripts.php";

?>
<script src="../barbeiro/js/charts/meus_charts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="../js/servico/servico.js"></script>