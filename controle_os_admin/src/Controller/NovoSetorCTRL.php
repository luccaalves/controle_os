<?php

namespace Src\Controller;

use Src\public\Util;
use Src\VO\SetorVO;
use Src\Model\NovoSetorMODEL;

class NovoSetorCTRL
{
    private $model;
    public function __construct(){
        $this->model = new NovoSetorMODEL();
    }
    public function CadastrarSetorCTRL(SetorVO $vo): int{
        if (empty($vo->getNomeSetor())){
            return 0;
        }else{

            // $vo->setCodLogado(Util::UsuarioLogado());
            $vo->setErroFuncao(CADASTRAR_SETOR_USUARIO);

            $ret = $this->model->CadastrarSetorMODEL($vo);
            return $ret;
        }
    }

    public function ConsultarSetorCTRL(){
        return $this->model->ConsultarSetorMODEL();
    }

    // public function SelecionarSetorCTRL(){
    //     return $this->model->ConsultarSetorMODEL();
    // }


    public function AlterarSetorCTRL(SetorVO $vo){
        if (empty($vo->getNomeSetor()) || empty($vo->getId())) {
            return 0;
        }else{
            $vo->setCodLogado(Util::UsuarioLogado());
            $vo->setErroFuncao(ALTERAR_SETOR_USUARIO);

            return $this->model->AlterarSetorMODEL($vo);
        }
    }

    public function ExcluirSetorCTRL(SetorVO $vo){
        if (empty($vo->getId())) {
            return 0;
        }else{
            $vo->setCodLogado(Util::UsuarioLogado());
            $vo->setErroFuncao(EXCLUIR_SETOR_USUARIO);

            return $this->model->ExcluirSetorMODEL($vo);
        }
    }
}
