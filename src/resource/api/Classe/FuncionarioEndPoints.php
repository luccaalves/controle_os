<?php

namespace Src\resource\api\Classe;

use Src\Controller\UsuarioCTRL;
use Src\resource\api\Classe\ApiRequest;
use Src\VO\FuncionarioVO;

class FuncionarioEndPoints extends ApiRequest
{
    private $ctrl_user;

    public function __construct()
    {
        $this->ctrl_user = new UsuarioCTRL();
    }

    private $params;

    public function AddParametes($p)
    {
        $this->params = $p;
    }

    public function CheckEndPoint($endpoint)
    {
        return method_exists($this, $endpoint);
    }

    public function DetalharUsuarioAPI()
    {
        $dados_usuario = $this->ctrl_user->DetalharUsuarioCTRL($this->params['id_user']);
        return $dados_usuario;
    }

    public function AlterarMeusDadosAPI(): int
    {
        $vo = new FuncionarioVO;
        $vo->setIdsetor($this->params['setor']);

        // Define dados do usuário
        $vo->setId($this->params['id_usuario']);
        $vo->setNome($this->params['nome']);
        // $vo->setTipoUsuario($this->params['tipo_usuario']);
        $vo->setEmail($this->params['email']);
        $vo->setCpf($this->params['cpf']);
        $vo->setTelefone($this->params['telefone']);

        // Define dados do endereço
        // $vo->setEnderecoId($this->params['id_endereco']);    
        $vo->setRua($this->params['rua']);
        $vo->setBairro($this->params['bairro']);
        $vo->setCep($this->params['cep']);
        $vo->setCidade($this->params['cidade']);
        $vo->setEstado($this->params['estado']);

        $ret =  $this->ctrl_user->AlterarUsuarioCtrl($vo, false);
        return $ret;
    }
}
