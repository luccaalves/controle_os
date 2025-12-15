<?php

namespace Src\Controller;

use Src\public\Util;
use Src\Model\UsuarioMODEL;
use Src\VO\UsuarioVO;

class UsuarioCTRL
{

    private $model;

    public function __construct()
    {
        $this->model = new UsuarioMODEL();
    }

    public function ValidarLoginAPICtrl(string $login, string $senha): string | int
    {
        if (empty($login) || empty($senha)) {
            return 0;
        }

        $usuario = $this->model->ValidarLoginModel($login, SITUACAO_ATIVO);
        if (empty($usuario)) {
            return -7;
        }

        if (!Util::VerificarSenha($senha, $usuario['senha_usuario'])) {
            return -7;
        }

        $this->model->RegistrarLogAcesso(Util::DataHoraAtual(), $usuario['id']);

        $dados_usuario = [
            'cod_user' => $usuario['id'],
            'nome' => $usuario['nome_usuario'],
            'cod_setor' => $usuario['setor_id']
        ];

        $token = Util::CreateTokenAuthentication($dados_usuario);
        return $token;
    }
    public function ValidarLoginCtrl(string $login, string $senha)
    {
        if (empty($login) || empty($senha)) {
            return 0;
        }

        $usuario = $this->model->ValidarLoginModel($login, SITUACAO_ATIVO);

        if (empty($usuario)) {
            return -7;
        }

        if (!Util::VerificarSenha($senha, $usuario['senha_usuario'])) {
            return -7;
        }

        $this->model->RegistrarLogAcesso(Util::DataHoraAtual(), $usuario['id']);
        Util::CriarSessao($usuario['id'], $usuario['nome_usuario']);
        Util::ChamarPagina('/controle_os_admin/src/view/admin/inicial.adm');
    }
    public function VerificarEmailDuplicadoCTRL(string $email): bool
    {
        return $this->model->VerificarEmailDuplicadoMODEL($email);
    }
    public function VerificarCpfDuplicadoCTRL(string $cpf): bool
    {
        return $this->model->VerificarCpfDuplicadoMODEL(Util::TirarCaracteresEspeciais($cpf));
    }
    public function CadastrarUsuarioCTRL($vo): int
    {
        // Validação das propriedades comum entre todos os tipos de Usuários!
        if (
            empty($vo->getNome()) || empty($vo->getTipo()) || empty($vo->getEmail()) ||
            empty($vo->getCPF()) || empty($vo->getTelefone())
        ) {
            return 0;
        } else {
            if ((int)$vo->getTipo() == USUARIO_TECNICO && empty($vo->getNomeEmpresa())) {
                return 0;
            }

            if ((int)$vo->getTipo() == USUARIO_FUNCIONARIO && empty($vo->getIdSetor())) {
                return 0;
            }

            // Setando as propriedades do Gravar Erro Log!
            $vo->setErroFuncao(CADASTRAR_USUARIO);
            $vo->setCodLogado(Util::UsuarioLogado());
            // Setando o Status do Usuário!
            $vo->setStatus(SITUACAO_ATIVO);
            // Setando a Senha Criptografada!
            $vo->setSenha(Util::CriptografarSenha($vo->getCPF()));

            return $this->model->CadastrarUsuarioMODEL($vo);
        }
    }
    public function FiltrarUsuarioCTRL($nome): array
    {
        return $this->model->FiltrarUsuarioMODEL($nome);
    }
    public function AlterarStatusUsuarioCTRL(UsuarioVO $vo): int
    {
        $vo->setErroFuncao(ALTERAR_STATUS_USUARIO);
        $vo->setStatus($vo->getStatus() == SITUACAO_ATIVO ? SITUACAO_INATIVO : SITUACAO_ATIVO);

        return $this->model->AlterarStatusUsuarioMODEL($vo);
    }
    public function DetalharUsuarioCTRL(int $id): array | int
    {
        if ($id == '' || $id <= 0) {
            return 0;
        } else {
            return $this->model->DetalharUsuarioMODEL($id);
            var_dump($dados_usuario);
            return $dados_usuario;
        }
    }
    public function AlterarUsuarioCTRL($vo, bool $tem_sessao = true): int
    {
        if (
            empty($vo->getNome()) || empty($vo->getEmail()) ||
            empty($vo->getCPF()) || empty($vo->getTelefone()) || empty($vo->getRua()) ||
            empty($vo->getBairro()) || empty($vo->getCEP()) || empty($vo->getCidade()) ||
            empty($vo->getEstado())
        ) {
            return 0;
        } else {
            if ((int)$vo->getTipo() == USUARIO_TECNICO && empty($vo->getNomeEmpresa())) {
                return 0;
            }

            $vo->setErroFuncao(ALTERAR_USUARIO);
            $vo->setCodLogado($tem_sessao ? Util::UsuarioLogado() : $vo->getId());
            $vo->setSenha(Util::CriptografarSenha($vo->getCPF()));

            return $this->model->AlterarUsuarioMODEL($vo);
        }
    }
    public function VerificarSenhaCTRL(int $id, string $senha_digitada): int
    {

        $dados = $this->model->BuscarSenhaMODEL($id);

        if (empty($dados)) {
            return -1;
        } else {
            $senha_hash = $dados['senha_usuario'];
            $ret = Util::VerificarSenha($senha_digitada, $senha_hash);
            return $ret ? 1 : -1;
        }
    }
    public function AlterarSenhaCTRL(UsuarioVO $vo, bool $tem_sessao = true): int
    {
        if (empty($vo->getId()) || empty($vo->getSenha())) {
            return 0;
        }

        $vo->setSenha(Util::CriptografarSenha($vo->getSenha()));
        $vo->setCodLogado($tem_sessao ? Util::UsuarioLogado() : $vo->getId());
        $vo->setErroFuncao(ALTERAR_SENHA_USUARIO);

        return $this->model->AlterarSenhaMODEL($vo);
    }
}
