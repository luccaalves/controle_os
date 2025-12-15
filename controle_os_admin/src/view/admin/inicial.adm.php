<?php
include_once dirname(__DIR__, 2) . '/resource/dataview/inicial_dataview.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Seja Bem-Vindo(a)!</title>
    <?php include_once PATH . 'template/includes/_head.php'; ?>
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <?php
    include_once PATH . 'template/includes/_topo.php';
    include_once PATH . 'template/includes/_menu.php';
    ?>

    <div class="content-wrapper">

        <!-- Cabeçalho -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="color: #dc3545;">Tela Inicial - Controle OS</h1>
                    </div>
                </div>
            </div>
        </section>

        <!-- Conteúdo -->
        <section class="content">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-bar mr-1"></i>
                        Status das Ordens de Serviço
                    </h3>
                </div>

                <div class="card-body">
                    <div id="grafico_resultado" style="width: 100%; height: 350px;"></div>
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

<!-- Google Charts -->
<script src="https://www.gstatic.com/charts/loader.js"></script>
<script src="../../resource/ajax/usuario_ajax.js"></script>

<script>
    google.charts.load("current", { packages: ['corechart'] });
    google.charts.setOnLoadCallback(drawChart);

    // Responsivo
    window.addEventListener('resize', drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ["Status", "Quantidade", { role: "style" }],
            ["Aguardando", <?= (int)$dados['qtd_aguardando'] ?>, "#0E2954"],
            ["Em Atendimento", <?= (int)$dados['qtd_em_atendimento'] ?>, "#1F6E8C"],
            ["Finalizado", <?= (int)$dados['qtd_encerrado'] ?>, "#4477CE"]
        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([
            0,
            1,
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
            height: 350,
            bar: { groupWidth: "60%" },
            legend: { position: "none" },
            backgroundColor: "transparent"
        };

        var chart = new google.visualization.ColumnChart(
            document.getElementById("grafico_resultado")
        );
        chart.draw(view, options);
    }
</script>

</body>
</html>
