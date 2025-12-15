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
    public function ValidarLoginAPI()
    {
        return $this->ctrl_user->ValidarLoginApiCtrl(
            $this->params['login'],
            $this->params['senha']
        );
    }
    public function DetalharUsuarioAPI()
    {
        if (Util::AuthenticationTokenAccess()) {
            $dados_usuario = $this->ctrl_user->DetalharUsuarioCtrl($this->params['id_user']);
            return $dados_usuario;
        } else {
            return NAO_AUTORIZADO;
        }
    }
    public function AlterarMeusDadosAPI()
    {
        if (Util::AuthenticationTokenAccess()) {
            $vo = new TecnicoVO;

            $vo->setNomeEmpresa($this->params['empresa'] ?? null);
            $vo->setId($this->params['id_usuario'] ?? null);
            $vo->setNome($this->params['nome'] ?? null);
            $vo->setTipo((int)$this->params['tipo_usuario']);
            $vo->setEmail($this->params['email'] ?? null);
            $vo->setCpf($this->params['cpf'] ?? null);
            $vo->setTelefone($this->params['telefone'] ?? null);

            $vo->setIdCidade($this->params['id_endereco'] ?? 0);
            $vo->setRua($this->params['rua'] ?? null);
            $vo->setBairro($this->params['bairro'] ?? null);
            $vo->setCep($this->params['cep'] ?? null);
            $vo->setCidade($this->params['cidade'] ?? null);
            $vo->setEstado($this->params['estado'] ?? null);

            return $this->ctrl_user->AlterarUsuarioCtrl($vo, false);
        } else {
            return NAO_AUTORIZADO;
        }
    }
    public function AlterarSenhaAPI()
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
    public function FiltrarChamadoAPI()
    {
        if (Util::AuthenticationTokenAccess()) {
            return (new ChamadoCtrl)->FiltrarChamadoCtrl(
                $this->params['situacao']
            );
        } else {
            return NAO_AUTORIZADO;
        }
    }
    public function DetalharChamadoAPI()
    {
        if (Util::AuthenticationTokenAccess()) {
            return (new ChamadoCtrl)->DetalharChamadoCtrl(
                $this->params['id']
            );
        } else {
            return NAO_AUTORIZADO;
        }
    }
    public function AtenderChamadoAPI()
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
    public function FinalizarChamadoAPI()
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
