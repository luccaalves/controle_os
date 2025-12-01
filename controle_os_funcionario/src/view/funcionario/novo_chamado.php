<?php
include_once dirname(__DIR__, 3) . '/vendor/autoload.php';
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
                            <h1>Novo Chamado</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Administrativo</a></li>
                                <li class="breadcrumb-item active">Novo Chamado</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Nessa tela, você pode abrir chamados</h3>
                    </div>
                    <div class="card-body">
                        <form action="novo_chamado.php" method="post">
                            <div class="form-group">
                                <label>Equipamento</label>
                                <select name="equipamento" id="equipamento" class="form-control obg">
                                    <option value="">Selecione</option>
                                    <option value="1">Teste 1</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Descrição do Problema:</label>
                                <textarea class="form-control obg" rows="4" placeholder="Digite aqui..." id="problema"></textarea>
                            </div>
                            <button type="button" class="btn btn-success" name="btnGravar" onclick="AbrirChamadoAJAX('formCAD')">Gravar</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
        <?php include_once PATH . 'template/includes/_footer.php'; ?>
    </div>
    <script src="../../resource/ajax/chamado_ajx.js"></script>
    <script>
        CarregarEquiamentosSetor();
    </script>
</body>

</html>