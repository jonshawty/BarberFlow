<?php
@session_start();
$conn = mysqli_connect("localhost", "root", "", "dbtcc");
$select = ("CALL PROC_AGENDAMENTOS_BARBEARIA('{$_SESSION['barbearia_id']}')");
$query = $conn->query($select);
require_once "../conteudo/navbar.php";
?>

    <link rel="stylesheet" href="../css/servicos-agendados.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .container-fluid {
            padding-top: 10px;
        }

        .profile-header {
            background-color: #ffc107;
            color: #fff;
            padding: 10px;
            text-align: center;
            border-radius: 5px;
        }

        table {
            width: 100%;
            background-color: #fff;
            border-collapse: collapse;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 5px;
        }

        th {
            background-color: #ffc107;
            color: #fff;
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e0e0e0;
        }

        .modal-title {
            font-weight: bold;
        }

        .modal-footer button {
            margin-right: 10px;
        }
    </style>
</head>
<body>

<div class="container-fluid pt-3 pb-3">
    <div class="profile-header">
        <h2>
            <fa-icon [icon]="faClock"></fa-icon> Serviços Agendados
        </h2>
    </div>
    <div class="profile-a" style="display: block; overflow: auto;">
        <table style="text-align: center;" id="tabela_servicos_agendados" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Data do Agendamento</th>
                    <th>Horário do Agendamento</th>
                    <th>Serviços Solicitados</th>
                    <th>Nome do Cliente</th>
                    <th>Valor</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="agend">
                <?php
                while ($dados = mysqli_fetch_assoc($query)) {
                ?>
                    <tr>
                        <td><?php echo $dados['id_agendamento'] ?></td>
                        <td><?php echo date('Y/m/d', strtotime($dados['data_agendamento'])) ?></td>
                        <td><?php echo $dados['horario_agendamento'] ?></td>
                        <td><?php echo $dados['nome_servico'] ?></td>
                        <td><?php echo $dados['nome_usuario'] ?></td>
                        <td><?php echo $dados['valor_total'] ?>R$</td>
                        <?php if (strtolower($dados['status']) == 'p') {
                        ?>
                            <td>Pendente</td>
                            <td>
                                <button data-toggle="modal" data-target="#modal<?php echo $dados['id_agendamento'] ?>" class="btn btn-success">
                                    Finalizar
                                </button>
                            </td>
                        <?php
                        } elseif (strtolower($dados['status']) == 'f') {
                        ?>
                            <td>Finalizado</td>
                            <td>#</td>
                        <?php
                        } else {
                            echo ('<td>Cancelado</td>');
                        } ?>
                    </tr>

                <?php

                }
                $conn->next_result();
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
$select = ("SELECT id_agendamento from agendamento WHERE barbearia='$_SESSION[barbearia_id]'");
$query = $conn->query($select);
while ($dados = mysqli_fetch_assoc($query)) {
?>
    <div class="modal fade" id="modal<?php echo $dados['id_agendamento'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Deseja finalizar o serviço?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <form method="post" action="../sistema/servicos-agendados.php">
                        <button type="submit" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button name="gg" value="<?php echo $dados['id_agendamento'] ?>" type="submit" class="btn btn-success">Finalizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php

}

if (isset($_POST['gg'])) {
    $id = $_POST['gg'];
    $update = "UPDATE agendamento SET `status`= 'F' WHERE id_agendamento = '$id'";
    $query = $conn->query($update);
    if ($query) {
        header('Location: ../index/php');
        exit;
    } else {
        echo 'Deu ruim';
    }
}

require_once "../conteudo/footer.php";
require_once "../conteudo/scripts.php";
?>