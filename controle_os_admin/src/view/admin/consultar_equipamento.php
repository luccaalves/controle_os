<?php
include_once dirname(__DIR__, 2) . '/resource/dataview/novo_equipamento_dataview.php';
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
              <h1  style="color: #dc3545;">Consultar Equipamento.</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Administrativo</a></li>
                <li class="breadcrumb-item active">Consultar Equipamento.</li>
              </ol>
            </div>
          </div>
        </div>
      </section>
      <section class="content">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Nessa tela, você faz a consulta de todos os equipamentos cadastrados. </h3>
          </div>
          <div class="card-body">
            <form action="pdf_equipamento.php" method="post">
              <input type="hidden" value="telaExcluir" id="itemTela">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Pequisa por Tipo:</label>
                    <select class="form-control" name="tipo" id="tipo" onchange="FiltrarEquipamentoAJAX()">
                      <!-- Carregados pelo Dataview -->
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Pequisa por Modelo:</label>
                    <select class="form-control" name="modelo" id="modelo" onchange="FiltrarEquipamentoAJAX()">
                      <!-- Carregados pelo Dataview -->
                    </select>
                  </div>
                </div>
              </div>
              <center>
              <button class="btn bg-gradient-primary" name="btnPdf">Gerar PDF</button>
              </center>
            </form>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Equipamentos Cadastrados:</h3>
          </div>
          <div class="card-body table-responsive p-0">
            <table class="table table-hover" id="tableResult">
              <!-- Carregados pelo Dataview -->
            </table>

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

  <form action="consultar_equipamento.php" method="POST" id="formAlt">
    <?php
    include_once './modal/modal_excluir.php';
    ?>
  </form>
  <form action="consultar_equipamento.php" method="POST" id="formDesc">
    <?php
    include_once './modal/descarte_modal.php';
    ?>
  </form>


  <?php
  include_once './modal/descarte_dados_eqp.php';
  ?>


  <script src="../../resource/ajax/novo_equipamento_ajax.js"></script>
  <script>
    CarregarTiposAJAX();
    CarregarModelosAJAX();
    FiltrarEquipamentoAJAX();
  </script>

</html>