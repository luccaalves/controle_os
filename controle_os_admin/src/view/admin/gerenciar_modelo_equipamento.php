<?php
  include_once dirname(__DIR__, 2) . '/resource/dataview/modelo_equipamento_dataview.php';
?>
<!DOCTYPE html>
<html>

  <head>
    <?php include_once PATH . 'template/includes/_head.php'; ?>
    <title>Gerenciar Modelo do Equipamento</title>
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
                <h1>Gerenciar Modelo do Equipamento</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Administrativo</a></li>
                  <li class="breadcrumb-item active">Gerenciar Modelo do Equipamento</li>
                </ol>
              </div>
            </div>
          </div>
        </section>
        <section class="content">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Nessa tela, você gerencia todos os Modelos cadastrados para os Equipamentos </h3>
            </div>
            <div class="card-body">
              <form action="gerenciar_modelo_equipamento.php" method="post" id="formCad">
                <div class="form-group">
                  <label for="exampleInputEmail1">Modelo do Equipamento:</label>
                  <input type="text" class="form-control obg" placeholder="Digite aqui..." name="nomeModelo" id="nomeModelo">
                </div>
                <button type="button" class="btn btn-success btn-sm" name="btnCadastrar" onclick=" return CadastrarModeloEquipamentoAJAX();">Cadastrar</button>
              </form>
            </div>
          </div>

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Modelos cadastrados para os Equipamentos:</h3>
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
              <table class="table table-hover" id="tableResultado">
                <!-- Carregados pelo Dataview -->
              </table>
            </div>
          </div>
        </section>
      </div>
      <?php include_once PATH . 'template/includes/_footer.php'; ?>
    </div>


    <form action="gerenciar_modelo_equipamento.php" method="post" id="formAlt">
        <?php include_once './modal/alterar_modelo.php'; ?>
        <?php include_once './modal/modal_excluir.php'; ?>
    </form>

    <?php
      include_once PATH . 'template/includes/_scripts.php';
      include_once PATH . 'template/includes/_msg.php';
    ?>

    <script src="../../resource/ajax/modelo_equipamento_ajax.js"></script>
      <script>
        ConsultarModeloEquipamentoAJAX();
      </script>

</body>

</html>