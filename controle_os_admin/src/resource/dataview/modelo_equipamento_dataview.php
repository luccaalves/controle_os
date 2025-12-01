<?php

    include_once dirname(__DIR__, 3) . '/vendor/autoload.php';

    use Src\VO\ModeloVo;
    use Src\Controller\ModeloEquipamentoCtrl;

    $ctrl = new ModeloEquipamentoCtrl();

    if(isset($_POST['btnCadastrar'])){
        $vo = new ModeloVo();

        $vo->setNomeModelo($_POST['nomeModelo']);

        $ret = $ctrl->CadastrarModeloCTRL($vo);

        if($_POST['btnCadastrar'] == 'ajx'){
            echo $ret;
        }
    }else if(isset($_POST['btnAlterar'])){
        $vo = new ModeloVo();

        $vo->setNomeModelo($_POST['alterar_modelo']);
        $vo->setid($_POST['id_alterar']);

        $ret = $ctrl->AlterarModeloEquipamentoCTRL($vo);

        if($_POST['btnAlterar'] == 'ajx'){
            echo $ret;
        }
    }else if(isset($_POST['btnExcluir'])){
        $vo = new ModeloVo();

        $vo->setId($_POST['id_excluir']);

        $ret = $ctrl->ExcluirModeloCTRL($vo);

        if($_POST['btnExcluir'] == 'ajx'){
            echo $ret;
        }
    }else if(isset($_POST['consultarModelo'])){
        $modelos_equipamentos = $ctrl->ConsultarModeloEquipamentoCTRL();

?>

    <thead>
        <tr>
            <th>Nome do Modelo</th>
            <th>Ação</th>
        </tr>
    </thead>
    <tbody>
        <tr><?php for ($i = 0; $i < count($modelos_equipamentos); $i++){ ?>
                <td><?= $modelos_equipamentos[$i]['nome_modelo'] ?></td>
                <td>
                    <a href="#" class=" btn btn-warning btn-sm" data-toggle="modal" data-target="#alterar-modelo" onclick="return CarregarModalModeloEquipamento('<?= $modelos_equipamentos[$i]['id'] ?>', '<?= $modelos_equipamentos[$i]['nome_modelo'] ?>')">Alterar</a>
                    <a href="#" class=" btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-excluir" onclick="return CarregarModalExcluir('<?= $modelos_equipamentos[$i]['id'] ?>' , '<?= $modelos_equipamentos[$i]['nome_modelo'] ?>')">Excluir</a>
                </td>
        </tr>
    <?php } ?>
    </tbody>

<?php } ?>