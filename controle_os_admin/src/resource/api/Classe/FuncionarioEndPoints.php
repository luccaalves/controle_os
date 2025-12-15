<?php

namespace Src\resource\api\Classe;

use Src\Controller\ChamadoCTRL;
use Src\Controller\UsuarioCTRL;

use Src\Controller\NovoEquipamentoCTRL;
use Src\resource\api\Classe\ApiRequest;
use Src\VO\FuncionarioVO;
use Src\VO\UsuarioVO;
use Src\VO\ChamadoVO;
use Src\public\Util;

class FuncionarioEndPoints extends ApiRequest
{
    private $ctrl_user;
    private $params;

    public function __construct()
    {
        $this->ctrl_user = new UsuarioCTRL();
    }
    public function AddParameters($p)
    {
        $this->params = $p;
    }
    public function CheckEndPoint($endpoint)
    {
        return method_exists($this, $endpoint);
    }
    public function ValidarLoginAPI(): int | string
    {
        return $this->ctrl_user->ValidarLoginAPICtrl(
            $this->params['login'],
            $this->params['senha']
        );
    }
    public function DetalharUsuarioAPI(): array | int
    {
        if (Util::AuthenticationTokenAccess()) {
            $dados_usuario = $this->ctrl_user->DetalharUsuarioCTRL($this->params['id_user']);
            return $dados_usuario;
        } else {
            return NAO_AUTORIZADO;
        }
    }
    public function AlterarMeusDadosAPI(): int
    {
        if (Util::AuthenticationTokenAccess()) {
            $vo = new FuncionarioVO;
            $vo->setIdsetor($this->params['setor'] ?? null);
            $vo->setId($this->params['id_usuario'] ?? null);
            $vo->setNome($this->params['nome'] ?? null);
            $vo->setTipo((int)$this->params['tipo_usuario']);
            $vo->setEmail($this->params['email'] ?? null);
            $vo->setCpf($this->params['cpf'] ?? null);
            $vo->setTelefone($this->params['telefone'] ?? null);

            $vo->setIdCidade((int)($this->params['id_endereco'] ?? 0));
            $vo->setRua($this->params['rua'] ?? null);
            $vo->setBairro($this->params['bairro'] ?? null);
            $vo->setCep($this->params['cep'] ?? null);
            $vo->setCidade($this->params['cidade'] ?? null);
            $vo->setEstado($this->params['estado'] ?? null);

            $ret =  $this->ctrl_user->AlterarUsuarioCTRL($vo, false);
            return $ret;
        } else {
            return NAO_AUTORIZADO;
        }
    }
    public function AlterarSenhaAPI()
    {
        if (Util::AuthenticationTokenAccess()) {
            $vo = new UsuarioVO();

            $vo->setId($this->params['cod_usuario']);
            $vo->setSenha($this->params['nova_senha']);

            return $this->ctrl_user->AlterarSenhaCTRL($vo, false);
        } else {
            return NAO_AUTORIZADO;
        }
    }
    public function VerificarSenhaAPI()
    {
        if (Util::AuthenticationTokenAccess()) {
            return $this->ctrl_user->VerificarSenhaCTRL($this->params['id_user'], $this->params['senha_digitada']);
        } else {
            return NAO_AUTORIZADO;
        }
    }
    public function ListarEquipamentosAlocadosSetorAPI()
    {
        if (Util::AuthenticationTokenAccess()) {
            return (new NovoEquipamentoCTRL)->EquipamentoAlocadoSetorCTRL($this->params['setor_id']);
        } else {
            return NAO_AUTORIZADO;
        }
    }
    public function AbrirChamadoAPI(): int
    {
        if (Util::AuthenticationTokenAccess()) {
            $vo = new ChamadoVO();
            $vo->setAlocarId($this->params['alocar_id']);
            $vo->setFuncionarioId($this->params['func_id']);
            $vo->setProblema($this->params['problema']);

            return (new ChamadoCTRL)->AbrirChamadoCTRL($vo);
        } else {
            return NAO_AUTORIZADO;
        }
    }
    public function DetalharChamadoAPI(): array | bool
    {
        if (Util::AuthenticationTokenAccess()) {
            return (new ChamadoCTRL)->DetalharChamadoCTRL(
                $this->params['id']
            );
        } else {
            return NAO_AUTORIZADO;
        }
    }
    public function FiltrarChamadoAPI()
    {
        if (Util::AuthenticationTokenAccess()) {
            return (new ChamadoCTRL)->FiltrarChamadoCTRL(
                $this->params['situacao'],
                $this->params['setor_id']
            );
        } else {
            return NAO_AUTORIZADO;
        }
    }
}
