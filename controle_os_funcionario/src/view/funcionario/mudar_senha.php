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
  <title>Mudar Senha</title>
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
              <h1 style="color: #198754;">Mudar Senha</h1>
            </div>
          </div>
        </div>
      </section>
      <section class="content">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Altere sua Senha</h3>
          </div>
          <div class="card-body">
            <form id="formSenhaAtual" method="post">
              <div class="form-group">
                <label>Senha Atual:</label>
                <input type="password" class="form-control obg" placeholder="Digite aqui..." name="senha" id="senha">
              </div>
              <button type="button" class="btn btn-success" name="btnSalvar" onclick="VerificarSenhaAtual('formSenhaAtual', 'formNovaSenha')">Verificar</button>
            </form>

            <form id="formNovaSenha" class="d-none">
              <div class="form-group">
                <label>Nova Senha:</label>
                <input type="password" class="form-control obg" placeholder="Digite aqui..." name="nova_senha" id="nova_senha">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Repetir Senha:</label>
                <input type="password" class="form-control obg" placeholder="Digite aqui..." name="rep_senha" id="rep_senha">
              </div>
              <button type="button" class="btn btn-success" name="btnSalvar" onclick="MudarSenha('formNovaSenha', 'formSenhaAtual')">Salvar</button>
            </form>

          </div>
        </div>
      </section>
    </div>
    <?php include_once PATH . 'template/includes/_footer.php'; ?>
  </div>
  <script src="../../resource/ajax/usuario_ajx.js"></script>

</body>

</html>