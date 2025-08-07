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

    public function VerificarEmailDuplicadoCTRL(string $email): bool
    {
        return $this->model->VerificarEmailDuplicadoMODEL($email);
    }

    public function FiltrarUsuarioCTRL($nome) : array{
        return $this->model->FiltrarUsuarioMODEL($nome);
    }

    public function CadastrarUsuarioCTRL($vo)
    {
        if (empty($vo->getNome()) || empty($vo->getTipo()) || empty($vo->getEmail()) || empty($vo->getCPF()) || empty($vo->getTelefone()) || empty($vo->getRua()) || empty($vo->getBairro()) || empty($vo->getCEP()) || empty($vo->getCidade()) || empty($vo->getEstado())) {
            return 0;
        } else {
            if ($vo->getTipo() == USUARIO_TECNICO && empty($vo->getNomeEmpresa())) {
                return 0;
            }

            if ($vo->getTipo() == USUARIO_FUNCIONARIO && empty($vo->getIdSetor())) {
                return 0;
            }

            //Setando o Status do Usuário!
            $vo->setStatus(SITUACAO_ATIVO);

            //Setando a Senha Criptografada!
            $vo->setCPF(Util::CriptografarSenha($vo->getCPF()));

            //Setando as propiredades do Gravar Erro Log!

            $vo->setErroFuncao(CADASTRAR_USUARIO);
            $vo->setCodLogado(Util::UsuarioLogado());

            return $this->model->CadastrarUsuarioMODEL($vo);
        }
    }

    public function AlterarStatusUsuarioCTRL(UsuarioVO $vo): int
    {
        $vo->setErroFuncao(ALTERAR_STATUS_USUARIO);
        $vo->setStatus($vo->getStatus() == SITUACAO_ATIVO ? SITUACAO_INATIVO : SITUACAO_ATIVO);

        return $this->model->AlterarStatusUsuarioMODEL($vo);

        // echo"<pre>";
        // var_dump($vo);
        // echo"</pre>";
    }

    public function DetalharUsuarioCTRL(int $id): array | int
    {
        if ($id == '' || $id <= 0) {
            return 0;
        } else {
            return $this->model->DetalharUsuarioMODEL($id);
        }
    }

    public function AlterarUsuarioCTRL($vo)
    {
        if (
            empty($vo->getNome()) || empty($vo->getEmail()) ||
            empty($vo->getCPF()) || empty($vo->getTelefone()) || empty($vo->getRua()) ||
            empty($vo->getBairro()) || empty($vo->getCEP()) || empty($vo->getCidade()) ||
            empty($vo->getEstado())
        ) {
            return 0;
        }

        if ((int)$vo->getTipo() == USUARIO_TECNICO && empty($vo->getNomeEmpresa())) {
            return 0;
        }

        $vo->setSenha(Util::CriptografarSenha($vo->getCPF()));
        $vo->setFuncaoErro(ALTERAR_USUARIO);
        $vo->setCodLogado(Util::UsuarioLogado());

        return $this->model->AlterarUsuarioMODEL($vo);
    }
}
