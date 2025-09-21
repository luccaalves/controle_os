<?php

    include_once dirname(__DIR__, 2) . '/resource/dataview/novo_setor_dataview.php';

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Seja Bem Vindo(a)!</title>
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
                            <h1>Tela Inícial - Controle de Ordens de Serviço.</h1>
                        </div>
                    </div>
            </section>

            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Controle de Ordens de Serviço.</h3>
                    </div>
                    <div class="card-body">

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

    <!-- Chamada do Javascript de Busca de CEP! -->
    <script src="../../resource/ajax/usuario_ajax.js"></script>
</body>

</html>