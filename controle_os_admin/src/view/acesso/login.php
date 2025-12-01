<?php
include_once dirname(__DIR__, 2) . '/resource/dataview/usuario_dataview.php';
?>

<!DOCTYPE html>
<html>
<head>
      <?php include_once PATH . 'template/includes/_head.php'; ?>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Controle de Chamados</b>LTE</a>
  </div>
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Faça seu Login</p>

      <form id="formLOG" method="post">
        <div class="input-group mb-3">
          <input id="login" name="login_usuario" class="form-control obg" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" id="senha" name="senha_usuario" class="form-control obg" placeholder="Senha">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            <button type="submit" name="btnLogin" onclick="NotificarCampos('formLOG')" class="btn btn-primary btn-block">Acessar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

    <?php 
    include_once PATH . 'template/includes/_scripts.php'; 
    include_once PATH . 'template/includes/_msg.php'; 
    ?>

  <script src="../../resource/ajax/usuario_ajax.js"></script>
</body>
</html>
