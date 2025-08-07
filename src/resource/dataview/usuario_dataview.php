<?php

include_once dirname(__DIR__, 3) . '/vendor/autoload.php';

use Src\public\Util;
use Src\VO\UsuarioVO;
use Src\VO\FuncionarioVO;
use Src\VO\TecnicoVO;
use Src\Controller\UsuarioCTRL;
use Src\Controller\NovoSetorCTRL;

$ctrl = new UsuarioCTRL();

if (isset($_POST['verificarEmailDuplicado']) && isset($_POST['email'])) {
    echo $ctrl->verificarEmailDuplicadoCTRL($_POST['email']);
} else if (isset($_POST['btnCadastrar'])) {
    switch ($_POST['tipo']) {
        case USUARIO_ADM:
            $vo = new UsuarioVO();
            break;

        case USUARIO_FUNCIONARIO:
            $vo = new FuncionarioVO();
            $vo->setIdSetor(($_POST['setor']));

            break;

        case USUARIO_TECNICO:
            $vo = new TecnicoVO();
            $vo->setNomeEmpresa(($_POST['nome']));
            break;
    }

    $vo->setTipo((int)$_POST['tipo']);
    $vo->setNome($_POST['nome']);
    $vo->setEmail($_POST['email']);
    $vo->setCPF($_POST['senha']);
    $vo->setTelefone($_POST['telefone']);

    $vo->setRua($_POST['rua']);
    $vo->setBairro($_POST['bairro']);
    $vo->setCep($_POST['cep']);
    $vo->setCidade($_POST['cidade']);
    $vo->setEstado($_POST['estado']);

    $ret = $ctrl->CadastrarUsuarioCTRL($vo);

    echo $ret;
} else if (isset($_POST['filtrarUsuario'])) {
    $usuarioEncontrados = $ctrl->FiltrarUsuarioCTRL($_POST['nomeFiltro']);

    if (count($usuarioEncontrados) == 0) {
        echo 0;
    } else {
?>
        <!-- Inicio do Ambiente Html  -->
        <thead>
            <tr>
                <th>Nome do Usuario</th>
                <th>Tipo do Usuario</th>
                <th>Situação</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarioEncontrados as $item) {
                $situacao = $item['status_usuario']
            ?>
                <tr>
                    <td><?= $item['nome_usuario'] ?></td>
                    <td><?= Util::MostrarTipoUsuario($item['tipo_usuario']) ?></td>
                    <td>
                        <?php $switchId = 'customSwitch_' . $item['id']; ?>

                        <div class="custom-control custom-switch custom-switch-<?= $situacao == SITUACAO_ATIVO ? 'off' : 'on' ?>-success  custom-switch-<?= $situacao == SITUACAO_ATIVO ? 'on' : 'off' ?>-danger">
                            <input onclick="AlterarStatusUsuarioAJAX('<?= $item['id'] ?>', '<?= $situacao ?>')" type="checkbox" class="custom-control-input" id="<?= $switchId ?>">
                            <label class="custom-control-label" for="<?= $switchId ?>"><?= Util::MostrarSituacao($item['status_usuario']) ?></label>
                        </div>
                    </td>
                    <td>
                        <a href="alterar_usuario.php?cod=<?= $item['id'] ?>" class="btn btn-warning btn-sm">ALTERAR</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
        <!-- Final do ambiente HTml -->
<?php }
} else if (isset($_POST['alterarStatusUsuario'])) {
    $vo = new UsuarioVO;

    $vo->setId(($_POST['id_usuario']));
    $vo->setStatus($_POST['status_usuario']);

    echo $ctrl->alterarStatusUsuarioCTRL($vo);
} else if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {
    $dados = $ctrl->DetalharUsuarioCTRL($_GET['cod']);

    if (!is_array($dados) || empty($dados)) {
        Util::ChamarPagina('consultar_usuario');
    }

    if ($dados['tipo_usuario'] == USUARIO_FUNCIONARIO) {
        $setores = (new NovoSetorCTRL())->ConsultarSetorCTRL();
    }
} else if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {
    $dados = $ctrl->DetalharUsuarioCTRL($_GET['cod']);

    if (!is_array($dados) || empty($dados)) {
        Util::ChamarPagina('consultar_usuario');
    }

    if ($dados['tipo_usuario'] == USUARIO_FUNCIONARIO) {
        $setores = (new NovoSetorCTRL())->ConsultarSetorCTRL();
    }
} else if (isset($_POST['btnAlterar'])) {
    echo"<pre>";
    var_dump($_POST);
    echo"</pre>";

    exit;

    switch ($_POST['tipo']) {
        case USUARIO_ADM:
            $vo = new UsuarioVO();
            break;

        case USUARIO_FUNCIONARIO:
            $vo = new FuncionarioVO();
            $vo->setIdSetor($_POST['setor']);
            break;

        case USUARIO_TECNICO:
            $vo = new TecnicoVO();
            $vo->setNomeEmpresa($_POST['nomeEmp']); // <- Corrigido
            break;
    }

    // Atribuições
  $vo->setId($_POST['codUsuario']);            // ID do usuário
    $vo->setIdCidade($_POST['codEndereco']);   // ID do endereço
    // Se tiver codCidade no POST, use assim, senão remova a linha:
    // $vo->setIdCidade($_POST['codCidade']);    // ID da cidade (opcional)

    $vo->setTipo((int)$_POST['tipo']);
    $vo->setNome($_POST['nome']);
    $vo->setEmail($_POST['email']);
    $vo->setCPF($_POST['cpf']);
    $vo->setTelefone($_POST['telefone']);

    $vo->setRua($_POST['rua']);
    $vo->setBairro($_POST['bairro']);
    $vo->setCep($_POST['cep']);
    $vo->setCidade($_POST['cidade']);
    $vo->setEstado($_POST['estado']);

    $ret = $ctrl->AlterarUsuarioCTRL($vo);
    echo $ret;
}
?>