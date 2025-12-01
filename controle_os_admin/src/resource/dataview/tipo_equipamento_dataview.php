<?php
include_once dirname(__DIR__, 3) . '/vendor/autoload.php';

use Src\VO\TipoVO;
use Src\Controller\TipoEquipamentoCTRL;

$ctrl = new TipoEquipamentoCTRL();

if (isset($_POST['btnCadastrar'])){
    $vo = new TipoVO();

    $vo->setNomeTipo($_POST['nomeTipo']);
    $ret = $ctrl->CadastrarTipoEquipamentoCtrl($vo);

    if($_POST['btnCadastrar'] == 'ajx'){
        echo $ret;
    }

}else if(isset($_POST['btnAlterar'])){
    $vo = new TipoVO();

    $vo->setNomeTipo($_POST['alterar_tipo']);
    $vo->setId((int)$_POST['id_alterar']);

    $ret = $ctrl->AlterarTipoEquipamentoCTRL($vo);

    if($_POST['btnAlterar'] == 'ajx'){
        echo $ret;
    }
}else if(isset($_POST['btnExcluir'])) {
    $vo = new TipoVo();

    $vo->setId($_POST['id_excluir']);

    $ret = $ctrl->ExcluirTipoEquipamentoCTRL($vo);

    if($_POST['btnExcluir'] == 'ajx'){
        echo $ret;
    }
}else if(isset($_POST['consultarTipo'])){
    $tipos_equipamentos = $ctrl->ConsultarTipoEquipamentoCTRL();

?>

    <!-- Espaço para HTMl no DATAVIEW em PHP -->

    <thead>
        <tr>
            <th>QTD.</th>
            <th>Nome do Equipamento</th>
            <th>Ação</th>
        </tr>
    </thead>
    <tbody>
        <?php for ($i = 0; $i < count($tipos_equipamentos); $i++) { ?>
            <tr>
                <td><?= $i+1 ?></td>
                <td><?= $tipos_equipamentos[$i]['nome_tipo'] ?></td>
                <td>
                    <a href="#" class=" btn btn-warning btn-sm" data-toggle="modal" data-target="#alterar-tipo" onclick="return CarregarModalTipoEquipamento('<?= $tipos_equipamentos[$i]['id'] ?>', '<?= $tipos_equipamentos[$i]['nome_tipo'] ?>')">Alterar</a>
                    <a href="#" class=" btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-excluir" onclick="return CarregarModalExcluir('<?= $tipos_equipamentos[$i]['id'] ?>' , '<?= $tipos_equipamentos[$i]['nome_tipo'] ?>')">Excluir</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>

<?php } ?>