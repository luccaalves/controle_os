<?php
include_once dirname(__DIR__, 2) . '/resource/dataview/inicial_dataview.php';
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
                        <div id="grafico_resultado" style="width: 900px; height: 300px;"></div>

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

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {
            packages: ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ["Element", "Density", {
                    role: "style"
                }],
                ["Aguradando", <?= $dados['qtd_aguradando'] ?>, "blue"],
                ["Em Atendimento", <?= $dados['qtd_em_atendimento'] ?>, "orange"],
                ["Finalizado", <?= $dados['qtd_encerrado'] ?>, "green"],
            ]);

            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                {
                    calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation"
                },
                2
            ]);

            var options = {
                title: "Números em Tempo Real",
                width: 600,
                height: 400,
                bar: {
                    groupWidth: "95%"
                },
                legend: {
                    position: "none"
                },
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("grafico_resultado"));
            chart.draw(view, options);
        }
    </script>

</body>

</html>