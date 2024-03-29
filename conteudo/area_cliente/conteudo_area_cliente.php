<section class="gap-to-menu container">
    <div class="area-cliente">
        <!-- Cards Linha 1-->
        <div class="row" id="cards-barbearias">
            <?php
            include "config/functions.php";
            $conn = mysqli_connect("localhost", "root", "", "dbtcc");
            date_default_timezone_set('America/Sao_Paulo');
            $horarioAtual = date("H:i");


            $queryCidades = "SELECT DISTINCT cidade FROM barbearia ORDER BY cidade";
            $resultCidades = $conn->query($queryCidades);


            $queryBarbearias = "CALL PROC_SEL_CARD_BARBEARIAS()";
            $resultBarbearias = mysqli_query($conn, $queryBarbearias);


            while ($rowBarbearias = mysqli_fetch_array($resultBarbearias)) {
                $statusFuncionamento = getStatus($rowBarbearias[2], $rowBarbearias[3], $rowBarbearias[4], $rowBarbearias[5]);

                // Campos
                $idBarbearia = $rowBarbearias[0];
                $nomeBarbearia = $rowBarbearias[1];
                $horarioAbertura = $statusFuncionamento[2];
                $horarioFechamento = $statusFuncionamento[3];
                $telefone = $rowBarbearias[6];
                $cidade = $rowBarbearias[7];
                $imagem = $rowBarbearias[8];
                $imagemBarbearia = "";
                if (strlen($imagem) > 0) {
                    $imagemBarbearia = $imagem;
                } else {
                    $imagemBarbearia = "assets/images/cliente-sem-ft.png";
                }

                echo "
                        <div class='col-md-3 col-sm-12 mb-4'>
                            <div class='card area-cliente-card'>
                                <img 
                                    class='card-img-top' 
                                    src='{$imagemBarbearia}' 
                                    alt='Imagem de capa do card'
                                />
                                <div class='$statusFuncionamento[0] sb-txt-black sb-w-700'>
                                    $statusFuncionamento[1]
                                </div>
                                <div class='card-body sb-txt-white'>
                                    <h5 class='card-title sb-w-700 sb-txt-secondary'>
                                        $nomeBarbearia
                                    </h5>
                                    <div class='card-text'>
                                        <p>
                                            <i class='fa fa-clock-o'></i>
                                            <span class='ml-1'>
                                                $horarioAbertura
                                                $horarioFechamento
                                            </span>
                                        </p>    
                                        <p>
                                            <i class='fa fa-phone'></i>
                                            <span class='ml-1'>$telefone</span>
                                        </p>        
                                        <p>
                                            <i class='fa fa-map-marker'></i>
                                            <span class='ml-1'>$cidade</span>
                                        </p>            
                                    </div>
                                    <a href='barbearia.php?id=$idBarbearia' class='btn sb-btn-secondary sb-w-700 sb-full-width'>
                                        Agendar
                                    </a>
                                </div>
                            </div>
                        </div>
                    ";
            }
            ?>
        </div>

        <!-- Modal Pesquisa -->
        <div class="modal fade" id="modal-pesquisa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title sb-txt-secondary sb-w-700">
                            Pesquisar barbearias
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true" class="sb-txt-white">
                                &times;
                            </span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form-pesquisa">W
                            <!-- Nome -->
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label sb-txt-white">
                                    Nome
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control sb-form-input" id="inputNome" name="nome-barbearia" placeholder="Digite o nome da barbearia">
                                </div>
                            </div>

                            <!-- Cidade -->
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label sb-txt-white">
                                    Cidade
                                </label>
                                <div class="col-sm-10">
                                    <select class="form-control sb-form-input" name="cidade-barbearia">
                                        <option>Selecione a cidade</option>
                                        <?php
                                        if ($resultCidades) {
                                            while ($rowCidade = $resultCidades->fetch_assoc()) {
                                                echo "<option>" . $rowCidade['cidade'] . "</option>";
                                            }
                                        } else {
                                            echo "<option>Erro ao buscar cidades</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary sb-w-700" data-dismiss="modal">
                            Fechar
                        </button>
                        <button type="submit" class="btn sb-btn-secondary sb-w-700" form="form-pesquisa" name="pesquisar" data-toggle="modal" data-target="#modal-resultado-pesquisa">
                            Pesquisar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <button class="btn-pesquisa btn-position-fixed" data-toggle="modal" data-target="#modal-pesquisa">
        <i class="fa fa-search" aria-hidden="true"></i>
    </button>
</section>

<div class="container">
    <div class="row">
        <?php
        include "config/config.php";

        if (isset($_GET["pesquisar"])) {
            // $conn = mysqli_connect("localhost", "root", "", "dbtcc");


            $nome = !empty($_GET["nome-barbearia"]) ? mysqli_real_escape_string($mysqli, $_GET["nome-barbearia"]) : NULL;
            $cidade = !empty($_GET["cidade-barbearia"]) ? mysqli_real_escape_string($mysqli, $_GET["cidade-barbearia"]) : NULL;



            echo "
                    <script>
                        const conteudo = document.querySelector('#cards-barbearias');
                        conteudo.innerHTML = ``;
                    </script>
                ";

            $queryPesquisa = "CALL PROC_SEL_CARD_BARBEARIAS_BY_CRITERIA(" .
                ($nome ? "'{$nome}'" : "NULL") . ", " .
                ($cidade ? "'{$cidade}'" : "NULL") . ");";
            $resultPesquisa = $mysqli->query($queryPesquisa);
            $rowPesquisa = $resultPesquisa->num_rows;
            if (!$resultPesquisa) {
                die("Erro na query: " . $mysqli->error);
            }

            if ($rowPesquisa > 0) {
                while ($rowPesquisa = $resultPesquisa->fetch_assoc()) {
                    $idBarbearia = $rowPesquisa["barbearia_id"];
                    $nomeBarbearia = $rowPesquisa["nome_barbearia"];
                    $horarioAbertura = $rowPesquisa["horario_abertura"];
                    $horarioFechamento = $rowPesquisa["horario_fechamento"];
                    $horarioAberturaFinalSemana = $rowPesquisa["horario_abertura_final_semana"];
                    $horarioFechamentoFinalSemana = $rowPesquisa["horario_fechamento_final_semana"];
                    $telefone = $rowPesquisa["telefone"];
                    $cidade = $rowPesquisa["cidade"];
                    $imagem = $rowPesquisa["imagem_barbearia"];
                    $imagemBarbearia = "";
                    if (strlen($imagem) > 0) {
                        $imagemBarbearia = $imagem;
                    } else {
                        $imagemBarbearia = "assets/images/cliente-sem-ft.png";
                    }

                    $statusFuncionamento = getStatus($horarioAbertura, $horarioFechamento, $horarioAberturaFinalSemana, $horarioFechamentoFinalSemana);

                    echo "
                            <div class='col-md-3 col-sm-12 mb-4'>
                                <div class='card area-cliente-card'>
                                    <img 
                                        class='card-img-top' 
                                        src='{$imagemBarbearia}' 
                                        alt='Imagem de capa do card'
                                    />
                                    <div class='$statusFuncionamento[0] sb-txt-black sb-w-700'>
                                        $statusFuncionamento[1]
                                    </div>
                                    <div class='card-body sb-txt-white'>
                                        <h5 class='card-title sb-w-700 sb-txt-secondary'>
                                            $nomeBarbearia
                                        </h5>
                                        <div class='card-text'>
                                            <p>
                                                <i class='fa fa-clock-o'></i>
                                                <span class='ml-1'>
                                                    $statusFuncionamento[2]
                                                    $statusFuncionamento[3]
                                                </span>
                                            </p>    
                                            <p>
                                                <i class='fa fa-phone'></i>
                                                <span class='ml-1'>$telefone</span>
                                            </p>        
                                            <p>
                                                <i class='fa fa-map-marker'></i>
                                                <span class='ml-1'>$cidade</span>
                                            </p>            
                                        </div>
                                        <a href='barbearia.php?id=$idBarbearia' class='btn sb-btn-secondary sb-w-700 sb-full-width'>
                                            Agendar
                                        </a>
                                    </div>
                                </div>
                            </div>
                        ";
                }
            } else {
                echo "
                        <a href='area_cliente.php' class='sb-txt-white'>
                            <i class='fa fa-arrow-left'></i>
                            <span class='ml-1'>Nenhum resultado encontrado</span>
                        </a>
                    ";
            }
        }
        ?>
    </div>
</div>