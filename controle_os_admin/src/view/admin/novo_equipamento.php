<?php

include_once dirname(__DIR__, 2) . '/resource/dataview/novo_equipamento_dataview.php';

// Variável que armazenará o estado da Tela (CADASTRO OU ALTERAÇÃO).
$titulo = isset($equipamento) ? ESTADO_TELA_ALTERAR : ESTADO_TELA_CADASTRAR;

?>

<!DOCTYPE html>
<html>

<head>
    <?php include_once PATH . 'template/includes/_head.php'; ?>
    <title><?= $titulo ?> Equipamentos</title>
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
                        <h1><?= $titulo ?> Equipamentos</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Administrativo</a></li>
                                <li class="breadcrumb-item active"><?= $titulo ?> Equipamentos</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Nessa tela, você pode <?= $titulo ?> novos equipamentos. </h3>
                    </div>
                    <div class="card-body">
                        <form action="novo_equipamento.php" method="post" id="formCad">
                            <input type="hidden" id="id_tipo" value="<?= isset($equipamento) ? $equipamento['tipo_id'] : '' ?>">
                            <input type="hidden" id="id_modelo" value="<?= isset($equipamento) ? $equipamento['modelo_id'] : '' ?>">
                            <input type="hidden" id="id_equipamento" value="<?= isset($equipamento) ? $equipamento['id'] : '' ?>">
                            <div class="form-group">
                                <label>Tipo</label>
                                <select class="form-control obg" name="tipo" id="tipo">
                                    <!-- Carregados pelo Dataview -->
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Modelo</label>
                                <select class="form-control obg" name="modelo" id="modelo">
                                    <!-- Carregados pelo Dataview -->
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Identificação:</label>
                                <input type="text" class="form-control obg" placeholder="Digite aqui..." name="identificacao" id="identificacao" value="<?= $titulo == ESTADO_TELA_ALTERAR ? $equipamento['identificacao'] : '' ?>">
                            </div>
                            <div class="form-group">
                                <label>Descrição:</label>
                                <textarea class="form-control obg" rows="4" placeholder="Digite aqui..." name="descricao" id="descricao"><?= isset($equipamento) ? $equipamento['descricao'] : '' ?></textarea>
                            </div>
                            <button type="button" class="btn btn-success btn-sm" name="btnGravar" onclick="GravarEquipamentoAJAX('formCad');"><?= $titulo ?></button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
        <?php include_once PATH . 'template/includes/_footer.php'; ?>
    </div>
    <!-- Inserção de arquivos Javascript do Projeto -->
    <?php
    include_once PATH . 'template/includes/_msg.php';
    include_once PATH . 'template/includes/_scripts.php';
    ?>

    <script src="../../resource/ajax/novo_equipamento_ajax.js"></script>
    <script>
        CarregarTiposAJAX();
        CarregarModelosAJAX();
        FiltrarEquipamentoAJAX();
    </script>
</body>

</html>