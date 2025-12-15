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
    <title>Meus Dados</title>
</head>

<body class="dark-mode sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper dark-mode">
        <?php
        include_once PATH . 'template/includes/_menu.php';
        include_once PATH . 'template/includes/_topo.php';
        ?>
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 style="color: #198754;">Informações Pessoais</h1>
                        </div>
                    </div>
                    <hr>
                </div>
            </section>
            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Atualize as informações nos campos designados.</h2>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <form action="meus_dados.php" id="formALT" method="post">
                                <input type="hidden" name="id_usuario" id="id_usuario" value="">
                                <input type="hidden" name="cod_endereco" id="cod_endereco" value="">
                                <input type="hidden" id="tipo_usuario" name="tipo_usuario" value="">

                                <div class="row">
                                    <div class="form-group col-md-9">
                                        <label>Nome</label>
                                        <input disabled type="text" class="form-control" name="nome" id="nome" placeholder="Digite aqui o nome...">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Telefone</label>
                                        <input type="text" class="form-control obg cel num" name="telefone" id="telefone" placeholder="Digite aqui...">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>CPF</label>
                                        <input disabled type="text" class="form-control" name="cpf" id="cpf" onblur="ValidarCpf(this.value)" placeholder="Digite aqui o CPF...">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>E-mail</label>
                                        <input disabled type="email" class="form-control" onchange="VerificarEmailCadastrado(this.value)" name="email" id="email" placeholder="Digite aqui O email...">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Setor</label>
                                    <input disabled class="form-control" name="setor" id="setor" onchange="VerificarEmailCadastrado(this.value)">
                                </div>

                                <div class="form-group">
                                    <label>CEP</label>
                                    <input type="text" autocomplete="off" class="form-control obg cep num" onblur="PesquisarCep(this.value)" name="cep" id="cep" placeholder="Digite aqui...">
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Rua</label>
                                        <input type="text" class="form-control obg" name="rua" id="rua" placeholder="Digite aqui...">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Bairro</label>
                                        <input type="text" class="form-control obg" name="bairro" id="bairro" placeholder="Digite aqui...">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Estado</label>
                                        <input disabled type="text" class="form-control obg" name="estado" id="estado" placeholder="Digite aqui o CEP(preenchimento automático)...">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Cidade</label>
                                        <input disabled type="text" class="form-control obg" name="cidade" id="cidade" placeholder="Digite aqui o CEP(preenchimento automático)...">
                                    </div>
                                </div>

                                <button type="button" id="btn_alterar" class="btn btn-success" name="btn_cadastrar" onclick="GravarMeusDadosApi('formALT')">Alterar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <?php
        include_once PATH . 'template/includes/_footer.php';
        ?>
    </div>

    <script src="../../resource/js/buscar_cep.js"></script>
    <script src="../../template/mask/jquery.mask.min.js"></script>
    <script src="../../template/mask/mask.js"></script>
    <script src="../../resource/ajax/usuario_ajx.js"></script>
    <script>
        DetalharMeusDados();
    </script>
</body>

</html>