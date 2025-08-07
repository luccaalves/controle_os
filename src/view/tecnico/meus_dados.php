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
              <h1>Meus Dados</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Administrativo</a></li>
                <li class="breadcrumb-item active">Meus Dados</li>
              </ol>
            </div>
          </div>
        </div>
      </section>
      <section class="content">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Nessa tela, você pode alterar seus dados de cadastro</h3>
          </div>
          <div class="card-body">
            <form action="meus_dados.php" method="post">
              <div class="form-group">
                <label for="exampleInputEmail1">Nome:</label>
                <input type="text" class="form-control" placeholder="Digite aqui...">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">E-mail:</label>
                <input type="email" class="form-control" placeholder="Digite aqui...">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Telefone(WhatsApp):</label>
                <input type="text" class="form-control" placeholder="Digite aqui...">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Endereço:</label>
                <input type="text" class="form-control" placeholder="Digite aqui...">
              </div>
              <button class="btn btn-success" name="btnCadastrar">Cadastrar</button>
            </form>
          </div>
        </div>
      </section>
    </div>
    <?php include_once PATH . 'template/includes/_footer.php'; ?>
  </div>
  <?php include_once PATH . 'template/includes/_scripts.php'; ?>

</body>

</html>