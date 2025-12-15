<?php

include_once dirname(__DIR__, 3) . '/vendor/autoload.php';

use Src\public\Util;
use Src\Controller\NovoSetorCTRL;
use Src\VO\UsuarioVO;
use Src\VO\FuncionarioVO;
use Src\VO\TecnicoVO;
use Src\Controller\UsuarioCTRL;

$ctrl = new UsuarioCTRL();

// Junto com o AJAX, vai monitorar o que é digitado no input com o que esta na Tabela do Banco de Dados!
if (isset($_POST['verificarEmailDuplicado'])) {
    echo $ctrl->VerificarEmailDuplicadoCTRL($_POST['email']);
} else if (isset($_POST['btnCadastrar'])) {
    switch ($_POST['tipo']) {
        case USUARIO_ADM:
            $vo = new UsuarioVO();
            break;

        case USUARIO_FUNCIONARIO:
            $vo = new FuncionarioVO();
            // Dados do Funcionário!
            $vo->setIdSetor($_POST['setor']);
            break;

        case USUARIO_TECNICO:
            $vo = new TecnicoVO();
            // Dados do Técnico!
            $vo->setNomeEmpresa($_POST['nomeEmp']);
            break;
    }

    // De acordo o tipo do Usuário selecionado, agora passa o cadastro dos demais dados!
    $vo->setTipo((int)$_POST['tipo']);
    $vo->setNome($_POST['nome']);
    $vo->setEmail($_POST['email']);
    $vo->setCPF($_POST['cpf']);
    $vo->setTelefone($_POST['telefone']);

    // Dados de Endereço!
    $vo->setRua($_POST['rua']);
    $vo->setBairro($_POST['bairro']);
    $vo->setCEP($_POST['cep']);
    $vo->setCidade($_POST['cidade']);
    $vo->setEstado($_POST['estado']);

    $ret = $ctrl->CadastrarUsuarioCTRL($vo);

} else if (isset($_POST['filtrarUsuario'])) {
    $usuariosEncontrados = $ctrl->FiltrarUsuarioCTRL($_POST['nomeFiltro']);

    if (count($usuariosEncontrados) == 0) {
        echo 0;
    } else {
?>
        <!-- Início do ambiente HTML! -->
        <thead>
            <tr>
                <th>Nome do Usuário</th>
                <th>Tipo do Usuário</th>
                <th>Situação</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuariosEncontrados as $item) {
                $situacao = $item['status_usuario'];
            ?>
                <tr>
                    <td><?= $item['nome_usuario'] ?></td>
                    <td><?= Util::MostrarTipoUsuario($item['tipo_usuario']) ?></td>
                    <td>
                        <?php $switchId = 'customSwitch_' . $item['id']; ?>

                        <div class="custom-control custom-switch custom-switch-<?= $situacao == SITUACAO_ATIVO ? 'off' : 'on' ?>-success custom-switch-<?= $situacao == SITUACAO_ATIVO ? 'on' : 'off' ?>-danger">
                            <input onclick="AlterarStatusUsuarioAJAX('<?= $item['id'] ?>', '<?= $situacao ?>')" type="checkbox" class="custom-control-input" id="<?= $switchId ?>">
                            <label class="custom-control-label" for="<?= $switchId ?>"><?= Util::MostrarSituacao($item['status_usuario']) ?></label>
                        </div>
                    </td>
                    <td>
                        <a href="alterar_usuario.php?cod=<?= $item['id'] ?>" class="btn btn-warning btn-sm">Alterar</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
        <!-- Final do ambiente HTML! -->
<?php }
} else if (isset($_POST['alterarStatusUsuario'])) {
    $vo = new UsuarioVO();

    $vo->setId($_POST['id_usuario']);
    $vo->setStatus($_POST['status_usuario']);

    echo $ctrl->AlterarStatusUsuarioCTRL($vo);
} else if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {
    $dados = $ctrl->DetalharUsuarioCTRL($_GET['cod']);

    if (!is_array($dados) || empty($dados)) {
        Util::ChamarPagina('consultar_usuario');
    }

    if ($dados['tipo_usuario'] == USUARIO_FUNCIONARIO) {
        $setores = (new NovoSetorCTRL())->ConsultarSetorCTRL();
    }
} else if (isset($_POST['btnAlterar'])) {
    switch ($_POST['tipo']) {
        case USUARIO_ADM:
            $vo = new UsuarioVO();
            break;

        case USUARIO_FUNCIONARIO:
            $vo = new FuncionarioVO();
            // Dados do Funcionário!
            $vo->setIdSetor($_POST['setor']);
            break;

        case USUARIO_TECNICO:
            $vo = new TecnicoVO();
            // Dados do Técnico!
            $vo->setNomeEmpresa($_POST['nomeEmp']);
            break;
    }

    // Dados do Usuário!
    $vo->setId($_POST['codUsuario']);
    $vo->setTipo((int)$_POST['tipo']);
    $vo->setNome($_POST['nome']);
    $vo->setEmail($_POST['email']);
    $vo->setCPF($_POST['cpf']);
    $vo->setTelefone($_POST['telefone']);

    // Dados de Endereço!
    $vo->setIdCidade($_POST['codEndereco']);
    $vo->setRua($_POST['rua']);
    $vo->setBairro($_POST['bairro']);
    $vo->setCEP($_POST['cep']);
    $vo->setCidade($_POST['cidade']);
    $vo->setEstado($_POST['estado']);

    $ret = $ctrl->AlterarUsuarioCTRL($vo);

    echo $ret;
} else if (isset($_POST['btnLogin'])) {
    $login = $_POST['login_usuario'];
    $senha = $_POST['senha_usuario'];
    $ret = $ctrl->ValidarLoginCTRL($login, $senha);
} else if(isset($_POST['verificar_cpf'])){
    echo $ctrl->VerificarCpfDuplicadoCTRL($_POST['cpf']);
}?>