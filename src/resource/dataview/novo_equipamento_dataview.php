<?php

include_once dirname(__DIR__, 3) . '/vendor/autoload.php';

use Src\Controller\AlocarEquipamentoCTRL;
use Src\Controller\ModeloEquipamentoCTRL;
use Src\Controller\NovoEquipamentoCTRL;
use Src\Controller\TipoEquipamentoCTRL;
use Src\public\Util;
use Src\VO\AlocarVo;
use Src\VO\EquipamentoVO;

$ctrl = new NovoEquipamentoCTRL;

if (isset($_POST['btnGravar']) && $_POST['btnGravar'] == 'Cadastrar') {
    $vo = new EquipamentoVO();

    $vo->setTipoEquipamento((int)$_POST['tipo']);
    $vo->setModeloEquipamento((int)$_POST['modelo']);
    $vo->setIdentificacaoEquipamento($_POST['identificacao']);
    $vo->setDescricaoEquipamento($_POST['descricao']);

    $ret = $ctrl->CadastrarEquipamentoCTRL($vo);

    if ($_POST['btnGravar'] == 'Cadastrar') {
        echo $ret;
    }
} else if (isset($_POST['consultarTipo'])) {
    $tipos = (new TipoEquipamentoCTRL)->ConsultarTipoEquipamentoCTRL();
    $id_tipo = isset($_POST['id_tipo']) ? ($_POST['id_tipo']) : '';
?>
    <select class="form-control obg" name="tipo" id="tipo">
        <option value="">Selecione</option>
        <?php foreach ($tipos as $item) { ?>
            <option value="<?= $item['id'] ?>" <?= $id_tipo == $item['id'] ? 'selected' :  '' ?>> <?= $item['nome_tipo'] ?></option>
        <?php } ?>
    </select>

<?php } else if (isset($_POST['consultarModelo'])) {
    $modelos = (new ModeloEquipamentoCTRL)->ConsultarModeloEquipamentoCTRL();
    $id_modelo = isset($_POST['id_modelo']) ? ($_POST['id_modelo']) : '';
?>
    <select class="form-control obg" name="modelo" id="modelo">
        <option value="">Selecione</option>
        <?php foreach ($modelos as $item) { ?>
            <option value="<?= $item['id'] ?>" <?= $id_modelo == $item['id'] ? 'selected' :  '' ?>><?= $item['nome_modelo'] ?></option>
        <?php } ?>
    </select>

<?php } else if (isset($_POST['filtrarEquipamentos'])) {
    $tipo_id = $_POST['tipo'];
    $modelo_id = $_POST['modelo'];

    $equipamentos = $ctrl->FiltrarNovoEquipamentoCTRL($tipo_id, $modelo_id);

?>
    <thead>
        <tr>
            <th>Tipo</th>
            <th>Modelo</th>
            <th>Identificação</th>
            <th>Descrição</th>
            <th>Situação</th>
            <th>Ação</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($equipamentos as $eqp) { ?>
            <tr>
                <td><?= $eqp['nome_tipo'] ?></td>
                <td><?= $eqp['nome_modelo'] ?></td>
                <td><?= $eqp['identificacao'] ?></td>
                <td><?= $eqp['descricao'] ?></td>
                <td><?= Util::MostrarSituacao($eqp['situacao']) ?></td>
                <td>
                    <a href="novo_equipamento.php?id=<?= $eqp['id_equipamento'] ?>" class="btn btn-warning btn-sm">Alterar</a>
                    <?php if ($eqp['estado_alocado'] == 0 && $eqp['situacao'] != SITUACAO_DESCARTADO) { ?>
                        <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-descarte" onclick="CarregarModalDescarte('<?= $eqp['id_equipamento'] ?>', '<?= $eqp['nome_tipo'] . ' | ' . $eqp['nome_modelo'] . ' | ' . $eqp['identificacao'] ?>')">Descartar</a>
                    <?php } else if ($eqp['situacao'] == SITUACAO_DESCARTADO) { ?>
                        <a href="#" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modal-dados-descarte" onclick="CarregarDadosDescarte('<?= $eqp['data_descarte'] ?>', '<?= $eqp['nome_tipo'] . ' | ' . $eqp['nome_modelo'] . ' | ' . $eqp['identificacao'] ?>', '<?= $eqp['motivo_descarte'] ?>')">Descartado</a>
                    <?php } ?>
                    <!-- <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-excluir" onclick="CarregarModalExcluir('<?= $eqp['id_equipamento'] ?>', '<?= $eqp['nome_tipo'] . ' | ' . $eqp['nome_modelo'] . ' | ' . $eqp['identificacao'] ?>')">Excluir</a> -->
                </td>
            </tr>
        <?php } ?>
    </tbody>

<?php } else if (isset($_GET['id'])) {
    $equipamento = $ctrl->DetalharEquipamentoCTRL($_GET['id']);

    if (empty($equipamento)) {
        Util::ChamarPagina('consultar_equipamento');
    }
} else if (isset($_POST['btnGravar']) && $_POST['btnGravar'] == 'Alterar') {
    $vo = new EquipamentoVO;

    $vo->setId($_POST['id_equipamento']);
    $vo->setTipoEquipamento($_POST['tipo']);
    $vo->setModeloEquipamento($_POST['modelo']);
    $vo->setIdentificacaoEquipamento($_POST['identificacao']);
    $vo->setDescricaoEquipamento($_POST['descricao']);

    $ret = $ctrl->AlterarEquipamentoCTRL($vo);

    if ($_POST['btnGravar'] == 'Alterar') {
        echo $ret;
    }
} else if (isset($_POST['btnExcluir']) && $_POST['btnExcluir'] == 'Excluir') {
    $vo = new EquipamentoVO();

    $vo->setId($_POST['id_equipamento']);

    $ret = $ctrl->ExcluirEquipamentoCTRL($vo);

    echo $ret;
} else if (isset($_POST['btnExcluir']) && $_POST['btnExcluir'] == 'RemoverEquipamento') {
    $vo = new AlocarVo();

    $vo->setId($_POST['id_equipamento']);

    $ret = $ctrl->RemoverEquipamentoCTRL($vo);

    echo $ret;
} else if (isset($_POST['btnDescarte'])) {
    $vo = new EquipamentoVO();

    $vo->setId($_POST['id_equipamento']);
    $vo->setMotivoDescarte($_POST['motivo_descarte']);
    $vo->setDataDescarte($_POST['data_descarte']);

    $ret = $ctrl->DescartarEquipamentoCTRL($vo);

    echo $ret;
} elseif (isset($_POST['selecionarEquipamentoDisponivel'])) {
    $equipamentos = $ctrl->SelecionarEquipamentoDisponivelCTRL();
?>
    <option value="">Selecione</option>
    <?php foreach ($equipamentos as $item) { ?>
        <option value="<?= $item['equipamento_id'] ?>"><?= $item['identificacao'] . ' | ' . $item['nome_tipo'] . ' | ' . $item['nome_modelo'] ?> </option>
    <?php } ?>


<?php } else if (isset($_POST['alocarEquipamento'])) {
    $vo = new AlocarVo();

    $vo->setIdEquipamento(($_POST['id_equipamento']));
    $vo->setIdSetor(($_POST['id']));

    $ret = $ctrl->AlocarEquipamentoCTRL($vo);

    echo $ret;
} else if (isset($_POST['consultarEquipamentoAlocado'])) {
    // var_dump($_POST['id_setor']);
    $equipamentos = $ctrl->EquipamentoAlocadoSetorCTRL(($_POST['id'])); ?>
    <thead>
        <tr>
            <th>Nome do Equipamento</th>
            <th>Data da Locação</th>
            <th>Ação</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($equipamentos as $item) { ?>
            <tr>
                <td><?= 'Identificação: ' . $item['identificacao'] . ' - ' . $item['nome_tipo'] . ' - ' . $item['nome_modelo'] ?></td>
                <td><?= $item['data_alocar'] ?></td>
                <td>
                    <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-excluir" onclick="CarregarModalExcluir('<?= $item['equipamento_id'] ?>' , '<?= 'Identificação: ' . $item['identificacao'] . ' - ' . $item['nome_tipo'] . ' - ' . $item['nome_modelo'] ?>')">Remover do Setor</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>

<?php } else if (isset($_POST['removerEquipamentoSetor'])) {
    $vo = new AlocarVo();

    $vo->setId(($_POST['id']));

    $ret = $ctrl->RemoverEquipamentoCTRL(($vo));

    echo $ret;
} ?>