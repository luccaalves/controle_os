<?php
include_once dirname(__DIR__, 2) . '/resource/dataview/novo_equipamento_dataview.php';
?>

<!DOCTYPE html>
<html>

<head>
    <?php include_once PATH . 'template/includes/_head.php'; ?>
    <title>Remover Equipamento</title>
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
                            <h1>Remover Equipamento</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Administrativo</a></li>
                                <li class="breadcrumb-item active">Remover Equipamento</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Nessa tela, você pode remover Equipamentos cadastrados</h3>
                    </div>
                    <div class="card-body">
                        <form action="remover_equipamento.php" method="post">
                            <input type="hidden" value="telaRemover" id="itemTela">
                            <div class="form-group">
                                <label>Setor</label>
                                <select class="form-control" name="setor" id="setor" onchange="ConsultarEquipamentoAlocadoAJAX(this.value)">
                                <!-- Vai ser Carregado pelo AJAX -->
                                </select>
                            </div>
                            <!-- <button class="btn btn-success" name="btnPesquisar">Pesquisar</button> -->
                        </form>
                    </div>
                </div>
                    <div class="card" id="div-resultado" style="display: none;">
                        <div class="card-header">
                            <h3 class="card-title">Veja nessa consulta, todos os Equipamentos cadastrados nesse setor:</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-bordered" id="tableResult">
                                <!-- Vai ser Carregado pela DataView -->
                            </table>
                        </div>
                    </div>
            </section>
        </div>
        <?php include_once PATH . 'template/includes/_footer.php'; ?>
    </div>
    <form action="remover_equipamento.php" method="post" id="formAlt">
        <?php include_once './modal/modal_excluir.php'; ?>
    </form>
    <?php
      include_once PATH . 'template/includes/_scripts.php';
      include_once PATH . 'template/includes/_msg.php';
    ?>

    <script src="../../resource/ajax/setor_usuario_ajax.js"></script>
    <script src="../../resource/ajax/novo_equipamento_ajax.js"></script>
    <script>
        SelecionarSetorAJAX();
        ExcluirAJAX();
    </script>

</body>

</html>