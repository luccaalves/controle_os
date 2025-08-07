<?php

    include_once dirname(__DIR__, 3) . '/vendor/autoload.php';

    use Src\VO\SetorVo;
    use Src\Controller\NovoSetorCTRL;

    $ctrl = new NovoSetorCTRL();

    if(isset($_POST['btnCadastrar'])){
        $vo = new SetorVO();

        $vo->setNomeSetor($_POST['nomeSetor']);
        $ret = $ctrl->CadastrarSetorCTRL($vo);

        if($_POST['btnCadastrar'] == 'ajx'){
            echo $ret;
        }
    }else if(isset($_POST ['btnAlterar'])){
        $vo = new SetorVo();

        $vo->setNomeSetor($_POST['alterar_setor']);
        $vo->setId($_POST['id_alterar']);

        $ret = $ctrl->AlterarSetorCTRL($vo);

        if($_POST['btnAlterar'] == 'ajx'){
            echo $ret;
        }
    }else if(isset($_POST ['btnExcluir'])){
        $vo = new SetorVo();

        $vo->setId($_POST['id_excluir']);

        $ret = $ctrl->ExcluirSetorCTRL($vo);

        if($_POST['btnExcluir'] == 'ajx'){
            echo $ret;
        }
    }elseif(isset($_POST['consultarSetor'])){
        $setores = $ctrl->ConsultarSetorCTRL();
    ?>

<thead>
        <tr>
            <th>Setor</th>
            <th>Ação</th>
        </tr>
    </thead>
    <tbody>
        <tr><?php for ($i = 0; $i < count($setores); $i++) { ?>
                <td><?=  $setores[$i]['nome_setor'] ?></td>
                <td>
                    <a href="#" class=" btn btn-warning btn-sm" data-toggle="modal" data-target="#alterar-setor" onclick="return CarregarModalSetor('<?= $setores[$i]['id'] ?>', '<?= $setores[$i]['nome_setor'] ?>')">Alterar</a>
                    <a href="#" class=" btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-excluir" onclick="return CarregarModalExcluir('<?=  $setores[$i]['id'] ?>' , '<?=  $setores[$i]['nome_setor'] ?>')">Excluir</a>
                </td>
        </tr>
    <?php } ?>
    </tbody>

    <?php } else if(isset($_POST['selecionarSetor'])){
        $setores = $ctrl->ConsultarSetorCTRL();
        ?>
        <option value="">Selecione</option>
        <?php foreach($setores as $item){?>
            <option value="<?= $item['id']?>"><?= $item['nome_setor']?></option>
        <?php } ?>

    <?php } ?>
    