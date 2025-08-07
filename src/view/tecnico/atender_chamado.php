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
                            <h1>Atender Chamados</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Administrativo</a></li>
                                <li class="breadcrumb-item active">Atender Chamados</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Nessa tela, você pode atender os chamados em aberto</h3>
                    </div>
                    <div class="card-body">
                        <form action="atender_chamado.php" method="post" class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Data:</label>
                                    <input type="date" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Setor:</label>
                                    <input type="text" class="form-control" placeholder="Digite aqui..." disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Funcionário:</label>
                                    <input type="text" class="form-control" placeholder="Digite aqui..." disabled>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Equipamento:</label>
                                    <input type="text" class="form-control" placeholder="Digite aqui..." disabled>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Descrição do Problema:</label>
                                    <textarea class="form-control" rows="4" placeholder="Digite aqui..." disabled></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Laudo:</label>
                                    <textarea class="form-control" rows="4" placeholder="Digite aqui..."></textarea>
                                </div>
                                <button class="btn btn-success" name="btnCadastrar">Cadastrar</button>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
        </section>
    <?php include_once PATH . 'template/includes/_footer.php'; ?>
    </div>
    <?php include_once PATH . 'template/includes/_scripts.php'; ?>

</body>

</html>