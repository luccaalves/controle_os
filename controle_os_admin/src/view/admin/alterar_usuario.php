<?php

use Src\public\Util;

include_once dirname(__DIR__, 2) . '/resource/dataview/usuario_dataview.php';

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Alterar Usuário Cadastrado.</title>
    <?php include_once PATH . './template/includes/_head.php'; ?>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php
        include_once PATH . './template/includes/_topo.php';
        include_once PATH . './template/includes/_menu.php';
        ?>
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1  style="color: #dc3545;">Alterar Usuário Cadastrado..</h1>
                        </div>
                    </div>
            </section>

            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Aqui você pode alterar os dados de cadastro do Usuário.</h3>
                    </div>
                    <div class="card-body">
                        <form action="novo_usuario.php" method="POST" id="formCAD">
                            <input type="hidden" id="codUsuario" value="<?= $dados['id_usuario'] ?>">
                            <input type="hidden" id="codEndereco" value="<?= $dados['cod_endereco'] ?>">
                            <input type="hidden" id="tipoUsuario" value="<?= $dados['tipo_usuario'] ?>">

                            <div class="form-group">
                                <label>Tipo Usuário: <?= Util::MostrarTipoUsuario($dados['tipo_usuario']) ?>.</label>
                            </div>

                            <!-- Dados do Usuário! -->
                            <div class="card" style="padding: 12px;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Digite o Nome:</label>
                                            <input type="text" class="form-control obg" placeholder="Clique e Digite aqui..." name="nome" id="nome" value="<?= $dados['nome_usuario'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Digite o E-mail:</label>
                                            <input type="email" class="form-control obg" placeholder="Clique e Digite aqui..." name="email" id="email" onchange="VerificarEmailDuplicadoAJAX(this.value)" value="<?= $dados['email_usuario'] ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Digite o Telefone:</label>
                                            <input type="text" class="form-control obg" placeholder="Clique e Digite aqui..." name="telefone" id="telefone" value="<?= $dados['tel_usuario'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Digite o CPF:</label>
                                            <input type="text" class="form-control obg cpf num" placeholder="Clique e Digite aqui..." name="cpf" id="cpf" onchange="ValidarCPF(this.value)" value="<?= $dados['cpf_usuario'] ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Dados do Funcionário! -->
                            <?php if ($dados['tipo_usuario'] != USUARIO_FUNCIONARIO) { ?>
                                <div class="card" style="display: none;"></div>
                            <?php } else { ?>
                                <div class="card" style="padding: 12px;">
                                    <div class="form-group">
                                        <label for="setor">Setor:</label>
                                        <select class="form-control obg" name="setor" id="setor">
                                            <?php foreach ($setores as $item) { ?>
                                                <option value="<?= $item['id'] ?>" 
                                                <?= $item['id'] == $dados['setor_id'] ? 'selected' : '' ?>>
                                                <?= $item['nome_setor'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            <?php } ?>

                            <!-- Dados do Técnico! -->
                            <?php if ($dados['tipo_usuario'] != USUARIO_TECNICO) { ?>
                                <div class="card" style="display: none;"></div>
                            <?php } else { ?>
                                <div class="card" style="padding: 12px;">
                                    <?php if ($dados['tipo_usuario'] == USUARIO_TECNICO) { ?>
                                        <div class="form-group">
                                            <label>Nome da Empresa:</label>
                                            <input type="text" class="form-control obg" placeholder="Clique e Digite aqui..." name="nomeEmp" id="nomeEmp" value="<?= $dados['nome_empresa'] ?>">
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php } ?>

                            <!-- Dados de Localização! -->
                            <div class="card" style="padding: 12px;">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Digite o CEP:</label>
                                            <input type="text" class="form-control obg" placeholder="Clique e Digite aqui..." name="cep" id="cep" onchange="PesquisarCEP(this.value)" value="<?= $dados['cep'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Digite o Nome da Rua:</label>
                                            <input type="text" class="form-control obg" placeholder="Clique e Digite aqui..." name="rua" id="rua" value="<?= $dados['rua'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Digite o Nome do Bairro:</label>
                                            <input type="text" class="form-control obg" placeholder="Clique e Digite aqui..." name="bairro" id="bairro" value="<?= $dados['bairro'] ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nome da Cidade:</label>
                                            <input type="text" class="form-control" placeholder="Clique e Digite aqui..." name="cidade" id="cidade" value="<?= $dados['nome_cidade'] ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nome do Estado:</label>
                                            <input type="text" class="form-control" placeholder="Clique e Digite aqui..." name="estado" id="estado" value="<?= $dados['sigla_estado'] ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-success" name="btnAlterar" id="btnAlterar" onclick="AlterarUsuarioAJAX('formCAD');">Alterar</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>

        <?php include_once PATH . './template/includes/_footer.php'; ?>
    </div>

    <?php
    include_once PATH . './template/includes/_scripts.php';
    include_once PATH . './template/includes/_msg.php';
    ?>

    <!-- Chamada do Javascript de Busca de CEP! -->
    <script src="../../resource/ajax/usuario_ajax.js"></script>
    <script src="../../resource/ajax/setor_usuario_ajax.js"></script>
    <script src="../../resource/js/buscar_cep.js"></script>
    <script src="../../template/mask/jquery.mask.min.js"></script>
    <script src="../../template/mask/mask.js"></script>
</body>

</html>