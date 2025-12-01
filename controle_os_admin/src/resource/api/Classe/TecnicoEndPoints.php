<?php

namespace Src\Resource\api\Classe;

use Src\public\Util;
use Src\Controller\ChamadoCtrl;
use Src\Controller\UsuarioCtrl;
use Src\Resource\api\Classe\ApiRequest;
use Src\VO\TecnicoVO;
use Src\VO\UsuarioVO;
use Src\VO\ChamadoVO;

class TecnicoEndPoints extends ApiRequest
{

    private $ctrl_user; // Controlador de usuário
    private $params; // Parâmetros da requisição

    public function __construct()
    {
        $this->ctrl_user = new UsuarioCtrl();
    }
    public function AddParameters($p)
    {
        $this->params = $p;
    }
    public function CheckEndPoint($endpoint)
    {
        return method_exists($this, $endpoint);
    }
    public function ValidarLoginApi()
    {
        return $this->ctrl_user->ValidarLoginApiCtrl(
            $this->params['login'],
            $this->params['senha']
        );
    }
    public function DetalharUsuarioApi()
    {
        if (Util::AuthenticationTokenAccess()) {
            $dados_usuario = $this->ctrl_user->DetalharUsuarioCtrl($this->params['id_user']);
            return $dados_usuario;
        } else {
            return NAO_AUTORIZADO;
        }
    }
    public function AlterarMeusDadosApi()
    {
        if (Util::AuthenticationTokenAccess()) {
            $vo = new TecnicoVO;

            $vo->setNomeEmpresa($this->params['empresa']);
            $vo->setId($this->params['id_usuario']);
            $vo->setNome($this->params['nome']);
            $vo->setTipo($this->params['tipo_usuario']);
            $vo->setEmail($this->params['email']);
            $vo->setCpf($this->params['cpf']);
            $vo->setTelefone($this->params['telefone']);
            $vo->setRua($this->params['rua']);
            $vo->setBairro($this->params['bairro']);
            $vo->setCep($this->params['cep']);
            $vo->setCidade($this->params['cidade']);
            $vo->setEstado($this->params['estado']);

            return $this->ctrl_user->AlterarUsuarioCtrl($vo, false);
        } else {
            return NAO_AUTORIZADO;
        }
    }
    public function AlterarSenhaUsuarioApi()
    {
        if (Util::AuthenticationTokenAccess()) {
            $vo = new UsuarioVO;

            $vo->setId($this->params['cod_usuario']);
            $vo->setSenha($this->params['nova_senha']);

            return $this->ctrl_user->AlterarSenhaCtrl($vo, false);
        } else {
            return NAO_AUTORIZADO;
        }
    }
    public function VerificarSenhaAPI()
    {
        if (Util::AuthenticationTokenAccess()) {
            return $this->ctrl_user->VerificarSenhaCtrl($this->params['id_user'], $this->params['senha_digitada']);
        } else {
            return NAO_AUTORIZADO;
        }
    }
    public function FiltrarChamadoApi()
    {
        if (Util::AuthenticationTokenAccess()) {
            return (new ChamadoCtrl)->FiltrarChamadoCtrl(
                $this->params['situacao']
            );
        } else {
            return NAO_AUTORIZADO;
        }
    }
    public function DetalharChamadoApi()
    {
        if (Util::AuthenticationTokenAccess()) {
            return (new ChamadoCtrl)->DetalharChamadoCtrl(
                $this->params['id']
            );
        } else {
            return NAO_AUTORIZADO;
        }
    }
    public function AtenderChamadoApi()
    {
        if (Util::AuthenticationTokenAccess()) {
            $vo = new Chamadovo;

            $vo->setTecnicoAtendimentoId($this->params['id_tec']);
            $vo->setId($this->params['id_chamado']);

            return (new ChamadoCtrl)->AtenderChamadoCtrl($vo);
        } else {
            return NAO_AUTORIZADO;
        }
    }
    public function FinalizarChamadoApi()
    {
        if (Util::AuthenticationTokenAccess()) {
            $vo = new Chamadovo;

            $vo->setTecnicoEncerramentoId($this->params['id_tec']);
            $vo->setId($this->params['id_chamado']);
            $vo->setAlocarId($this->params['id_alocar']);
            $vo->setLaudo($this->params['laudo']);

            return (new ChamadoCtrl)->FinalizarChamadoCtrl($vo);
        } else {
            return NAO_AUTORIZADO;
        }
    }
}
