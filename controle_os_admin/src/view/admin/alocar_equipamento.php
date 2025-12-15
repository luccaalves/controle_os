<?php
include_once dirname(__DIR__, 2) . '/resource/dataview/novo_equipamento_dataview.php';

use Src\public\Util;

?>
<!DOCTYPE html>
<html>

<head>
    <?php include_once PATH . 'template/includes/_head.php'; ?>
    <title>Alocar Equipamento</title>
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
                            <h1>Alocar Equipamento</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Administrativo</a></li>
                                <li class="breadcrumb-item active">Alocar Equipamento.</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Nessa tela, você aloca um Equipamento ao setor especifíco. </h3>
                    </div>
                    <div class="card-body">
                        <form action="alocar_equipamento.php" method="post" id="formCad">
                            <div class="form-group">
                                <label>Selecione um Equipamento</label>
                                <select class="form-control obg" name="equipamento" id="equipamento">
                                    <!-- Carregados pelo Dataview -->
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Selecione um Setor</label>
                                <select class="form-control obg" name="setor" id="setor">
                                    <!-- Carregados pelo Dataview -->
                                </select>
                            </div>
                            <button type="button" class="btn btn-success btn-sm" name="btnSalvar" onclick=" AlocarEquipamentoAJAX('formCad');">Salvar</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
        <?php include_once PATH . 'template/includes/_footer.php'; ?>
    </div>
    <?php
    include_once PATH . 'template/includes/_scripts.php';
    include_once PATH . 'template/includes/_msg.php';
    ?>

    <script src="../../resource/ajax/setor_usuario_ajax.js"></script>
    <script src="../../resource/ajax/novo_equipamento_ajax.js"></script>
    <script>
        SelecionarSetorAJAX();
        SelecionarEquipamentoDisponivelAJAX();
    </script>
</body>

</html>