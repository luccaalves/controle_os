<?php
// Para que essa linha de comando funcione corretamente, precisamos concatenar a leitura de trafego 
// das paginas com autoload com composer para executar a chamada!
// O comando DIR (__DIR__) ele representa o caminho no qual onde ele foi inserido
include_once dirname(__DIR__, 2) . '/resource/dataview/tipo_equipamento_dataview.php';
?>

<!DOCTYPE html>
<html>

<head>
  <?php include_once PATH . 'template/includes/_head.php'; ?>
  <title>Gerenciar Tipo de Equipamento</title>
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
              <h1>Gerenciar Tipo do Equipamento</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Administrativo</a></li>
                <li class="breadcrumb-item active">Gerenciar Tipo do Equipamento</li>
              </ol>
            </div>
          </div>
        </div>
      </section>
      <section class="content">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Nessa tela, você gerencia todos os Tipos de Equipamentos cadastrados. </h3>
          </div>
          <div class="card-body">
            <form action="gerenciar_tipo_equipamento.php" method="post" id="formCad">
              <div class="form-group">
                <label for="exampleInputEmail1">Nome do Tipo do Equipamento:</label>
                <input type="text" class="form-control obg" placeholder="Digite aqui..." name="nomeTipo" id="nomeTipo">
              </div>
              <button type="button" class="btn btn-success btn-sm" name="btnCadastrar" onclick= "return CadastrarTipoEquipamentoAJAX();">Cadastrar</button>
            </form>
          </div>
        </div>

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Tipos de Equipamentos Cadastrados:</h3>
            <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="table_search" class="form-control float-right" placeholder="Pesquisar">
                <div class="input-group-append">
                  <button type="submit" class="btn btn-default btn-sm"><i class="fas fa-search"></i></button>
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

  <!-- Inclusão da MODAL para alterar o tipo equipamento -->
  <form action="gerenciar_tipo_equipamento.php" method="POST" id="formAlt">
    <?php include_once './modal/alterar_tipo.php'; ?>
    <?php include_once './modal/modal_excluir.php'; ?>
  </form>                

  <!-- Inserção de arquivos Javascript do Projeto -->
  <?php 
  include_once PATH . 'template/includes/_scripts.php'; 
  include_once PATH . 'template/includes/_msg.php'; 
  ?>
  
  <!-- Chamada do AJAX na página --> 
  <script src="../../resource/ajax/tipo_equipamento_ajax.js"></script>
  <script>
    ConsultarTipoEquipamentoAJAX();
  </script>
</body>

</html>