<?php
include_once dirname(__DIR__, 3) . '/vendor/autoload.php';
?>

<!DOCTYPE html>
<html>

<head>
    <?php include_once PATH . 'template/includes/_head.php'; ?>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php
        include_once PATH . 'template/includes/_topo.php';
        include_once PATH . 'template/includes/_menu.php';
        ?>

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Consultar Chamados</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Administrativo</a></li>
                                <li class="breadcrumb-item active">Consultar Chamados</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Nessa tela, você pode verificar todos os chamados abertos</h3>
                    </div>
                    <div class="card-body">
                        <form action="consultar_chamado.php" method="post">
                            <div class="form-group">
                                <label>Situação</label>
                                <select class="form-control">
                                    <option value="">Selecione</option>
                                    <option value="1">Teste 1</option>
                                </select>
                            </div>
                            <button class="btn bg-gradient-primary" name="btnPesquisar">Pesquisar</button>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Veja nessa consulta, todos os chamados abertos:</h3>
                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right" placeholder="Pesquisar">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
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
                                        <a href="" class=" btn btn-primary btn-sm">Ver Mais</a>
                                        <a href="atender_chamado.php" class=" btn btn-success btn-sm">Atender</a>
                                        <a href="" class=" btn btn-danger btn-sm">Finalizar</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
        </section>
    </div>
    <?php include_once PATH . 'template/includes/_footer.php'; ?>
    </div>
    <?php include_once PATH . 'template/includes/_scripts.php'; ?>

</body>

</html>