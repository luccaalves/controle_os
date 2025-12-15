<?php
include_once dirname(__DIR__, 2) . '/resource/dataview/usuario_dataview.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Cadastrar Novo Usuário</title>
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
              <h1  style="color: #dc3545;">Cadastrar Novo Usuário</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Administrativo</a></li>
                <li class="breadcrumb-item active">Cadastrar Novo Usuário</li>
              </ol>
            </div>
          </div>
        </div>
      </section>
      <section class="content">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Nessa tela, você pode cadastrar Novos Usuários</h3>
          </div>
          <div class="card-body">
            <form action="novo_usuario.php" method="POST" id="formCad">
                <div class="form-group">
                  <label>Tipo de Usuário</label>
                  <select class="form-control" name="tipo" id="tipo" onchange="CarregarCamposUsuario(this.value)">
                    <option value="0">Selecione</option>
                    <option value="<?= USUARIO_ADM ?>">Administrador</option>
                    <option value="<?= USUARIO_FUNCIONARIO ?>">Funcionário</option>
                    <option value="<?= USUARIO_TECNICO ?>">Técnico</option>
                  </select>
                </div>

              <!-- Dados do Usuário -->
              <div id="div-dados-usuario" style="display: none;">
                <div class="card" style="padding: 12px;">
                  <div class="row">
                    <div class="form-group obg col-md-6">
                      <label for="exampleInputEmail1">Nome:</label>
                      <input type="text" class="form-control obg" placeholder="Digite aqui..." name="nome" id="nome">
                    </div>
                    <div class="form-group obg col-md-6">
                      <label for="exampleInputEmail1">E-mail:</label>
                      <input type="email" class="form-control obg" placeholder="Digite aqui..." name="email" id="email" onchange="VerificarEmailDuplicadoAJAX(this.value)">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group obg col-md-6">
                      <label for="exampleInputEmail1">Telefone(WhatsApp):</label>
                      <input type="text" class="form-control obg" placeholder="Digite aqui..." name="telefone" id="telefone">
                    </div>
                    <div class="form-group obg col-md-6">
                      <label for="exampleInputEmail1">CPF:</label>
                      <input type="text" class="form-control obg" placeholder="Digite aqui..." name="cpf" id="cpf" onchange="VerificarCPFDuplicadoAJAX(this.value)">
                    </div>
                  </div>
                </div>
              </div>
              <!-- Dados do Funcionario -->
              <div id="div-dados-funcionario" style="display: none;">
                <div class="card" style="padding: 12px;">
                  <div class="form-group obg">
                    <label>Selecione um Setor</label>
                    <select class="form-control obg " name="setor" id="setor">
                      <option value="">Selecione</option>
                    </select>
                  </div>
                </div>
              </div>
              <!-- Dados do Técnico -->
              <div id="div-dados-tecnico" style="display: none;">
                <div class="card" style="padding: 12px;">
                  <div class="form-group obg">
                    <label for="exampleInputEmail1">Empresa:</label>
                    <input type="text" class="form-control obg" placeholder="Digite aqui..." name="nomeEmp" id="Emp">
                  </div>
                </div>
              </div>

              <!-- Dados do Localização -->
              <div id="div-dados-local" style="display: none;">
                <div class="card" style="padding: 12px;">
                  <div class="row">
                    <div class="form-group obg col-md-4">
                      <label for="exampleInputEmail1">CEP:</label>
                      <input type="text" class="form-control obg" placeholder="Digite aqui..." name="cep" id="cep" onblur="PesquisarCep(this.value)">
                    </div>
                    <div class="form-group obg col-md-4">
                      <label for="exampleInputEmail1">Rua:</label>
                      <input type="text" class="form-control obg" placeholder="Digite aqui..." name="rua" id="rua">
                    </div>
                    <div class="form-group obg col-md-4">
                      <label for="exampleInputEmail1">Bairro:</label>
                      <input type="text" class="form-control obg" placeholder="Digite aqui..." name="bairro" id="bairro">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group obg col-md-6">
                      <label for="exampleInputEmail1">Cidade:</label>
                      <input type="text" class="form-control obg" placeholder="Digite aqui..." name="cidade" id="cidade" readonly>
                    </div>
                    <div class="form-group obg col-md-6">
                      <label for="exampleInputEmail1">Estado:</label>
                      <input type="text" class="form-control obg" placeholder="Digite aqui..." name="estado" id="estado" readonly>
                    </div>
                  </div>
                </div>
              </div>
              <button class="btn btn-success btn-sm" name="btnCadastrar" id="btn-cadastrar" onclick="return CadastrarUsuarioAJAX('formCad');">Cadastrar</button>
            </form>
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

  <script src="../../resource/ajax/usuario_ajax.js"></script>
  <script src="../../resource/ajax/setor_usuario_ajax.js"></script>
  <script src="../../resource/js/buscar_cep.js"></script>
  <script src="../../template/mask/jquery.mask.min.js"></script>
  <script src="../../template/mask/mask.js"></script>


</bod>

</html>