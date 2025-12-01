<?php

include_once dirname(__DIR__, 3) . '/vendor/autoload.php';

//echo $_SERVER["PHP_SELF"] . PHP_EOL;
// Imprime o nome do arquivo do script atualmente em execução.

//echo $_SERVER['DOCUMENT_ROOT']. PHP_EOL;
// Imprime o diretorio raiz do servidor web.
// Esse caminho absoluto pode ser util para referenciar arquivos ou incluir outros scripts usando o caminho completo.

?>
<!DOCTYPE html>
<html>

<head>
    <?php
    include_once PATH . 'template/includes/_head.php';
    include_once PATH . 'template/includes/_scripts.php';
    ?>
    <script>
        Verify();
    </script>
</head>

<body class="dark-mode sidebar-mini sidebar-collapse">
    <!-- Site wrapper -->
    <div class="wrapper dark-mode">
        <?php
        include_once PATH . 'template/includes/_menu.php';
        include_once PATH . 'template/includes/_topo.php';
        ?>

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 style="color: #00BFFF;">Chamados</h1>
                            <p>Consulte todos os seus chamados e acompanhe os atendimentos.</p>
                        </div>
                    </div>
                    <hr>
                </div>
            </section>
            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Aqui, é possível verificar todos os chamados associados à sua conta.</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <form action="chamados.php" method="post">
                                <label>Selecione a situação</label>
                                <select name="situacao" id="situacao" class="form-control">
                                    <option value="<?= SITUACAO_CHAMADO_TODOS ?>">Todos</option>
                                    <option value="<?= SITUACAO_CHAMADO_AGUARDANDO_ATENDIMENTO ?>">Aguardando o atendimento</option>
                                    <option value="<?= SITUACAO_CHAMADO_EM_ATENDIMENTO ?>">Em atendimento</option>
                                    <option value="<?= SITUACAO_CHAMADO_FINALIZADO ?>">Encerrado</option>
                                </select>
                            </form>
                        </div>
                        <button type="button" class="btn btn-success" onclick="FiltrarChamadoAJAX()">Pesquisar</button>
                    </div>
                </div>
            </section>
            <section class="content d-none" id="resultado">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Consultar todos os chamados</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Resultado encontrado</h3>
                                        <div class="card-tools">
                                            <div class="input-group input-group-sm" style="width: 150px;">
                                                <input type="text" name="table_search" class="form-control float-right" placeholder="Pesquisar por ...">

                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover" id="table_result">
                                            <thead>
                                                <tr>
                                                    <th>Data da Abertura</th>
                                                    <th>Funcionário</th>
                                                    <th>Equipamento</th>
                                                    <th>Problema</th>
                                                    <th>Data do Atendimento</th>
                                                    <th>Técnico</th>
                                                    <th>Data do Encerramento</th>
                                                    <th>Laudo</th>
                                                    <th>Ação</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>[ Exemplo ]</td>
                                                    <td>[ Exemplo ]</td>
                                                    <td>[ Exemplo ]</td>
                                                    <td>[ Exemplo ]</td>
                                                    <td>[ Exemplo ]</td>
                                                    <td>[ Exemplo ]</td>
                                                    <td>[ Exemplo ]</td>
                                                    <td>[ Exemplo ]</td>
                                                    <td>
                                                        <a href="" class=" btn bg-gradient-primary" data-toggle="modal" data-target="#modal-detalhes">Ver Mais</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <?php
                                include_once 'modal/detalhes_chamado.php';
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php
        include_once PATH . 'template/includes/_footer.php';
        ?>
    </div>
</body>

</html>