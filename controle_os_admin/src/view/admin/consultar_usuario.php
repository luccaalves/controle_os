<?php
include_once dirname(__DIR__, 2) . '/resource/dataview/usuario_dataview.php';
?>

<!DOCTYPE html>
<html>

<head>
  <?php include_once PATH . 'template/includes/_head.php'; ?>
  <title>Consultar Usuário</title>
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
              <h1  style="color: #dc3545;">Consultar Usuário</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Administrativo</a></li>
                <li class="breadcrumb-item active">Consultar Usuário</li>
              </ol>
            </div>
          </div>
        </div>
      </section>
      <section class="content">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Nessa tela, você consulta todos os usuários cadastrados. </h3>
          </div>
          <div class="card-body">
            <form action="consultar_usuario.php" method="post">
              <div class="form-group">
                <label for="exampleInputEmail1">Nome do Usuário:</label>
                <input type="text" class="form-control" placeholder="Digite Pelo Menos 3 Caracteres para Pesquisar..." name="nomeFiltro" id="nomeFiltro" onkeyup="FiltrarUsuarioAJAX();" value="<?= isset($_GET['filtro']) ? $_GET['filtro'] : '' ?>">
              </div>
            </form>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Usuários Cadastrados:</h3>
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
            <table class="table table-hover" id="tableResult">

            </table>
          </div>
        </div>
      </section>
    </div>
    <?php include_once PATH . 'template/includes/_footer.php'; ?>
  </div>

  <!-- Inserção de arquivos Javascript do Projeto -->
  <?php
  include_once PATH . 'template/includes/_scripts.php';
  include_once PATH . 'template/includes/_msg.php';
  ?>
  <script src="../../resource/ajax/usuario_ajax.js"></script>

  <?php if (isset($_GET['filtro'])) { ?>
    <script>
      FiltrarUsuarioAJAX();
    </script>

  <?php } ?>

</body>

</html>