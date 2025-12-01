<?php

namespace Src\Controller;

use Src\VO\TipoVO;
use Src\Model\TipoEquipamentoMODEL;
use Src\public\Util;

class TipoEquipamentoCTRL{

    private $model;
    public function __construct(){
        $this->model = new TipoEquipamentoMODEL();
    }

    public function CadastrarTipoEquipamentoCTRL(TipoVO $vo) : int{
        if(empty($vo->getNomeTipo())){
            return 0;
        }else{
            $vo->setCodLogado(Util::UsuarioLogado());
            $vo->setErroFuncao(CADASTRAR_TIPO_EQUIPAMENTO);

            $ret = $this->model->CadastrarTipoEquipamentoMODEL($vo);

            return $ret;
        }
    }

    public function ConsultarTipoEquipamentoCTRL() : array{
        return $this->model->ConsultarTipoEquipamentoMODEL();    
    }

    public function AlterarTipoEquipamentoCTRL(TipoVO $vo) : int{
        if(empty($vo->getNomeTipo()) || empty($vo->getId())){
            return 0;
        }else{
            $vo->setCodLogado(Util::UsuarioLogado());
            $vo->setErroFuncao(ALTERAR_TIPO_EQUIPAMENTO);

            return $this->model->AlterarTipoEquipamentoMODEL($vo);
        }
    }

    public function ExcluirTipoEquipamentoCTRL(TipoVO $vo){
        if(empty($vo->getId())){
            return 0;
        }else{
            $vo->setCodLogado(Util::UsuarioLogado());
            $vo->setErroFuncao(EXCLUIR_TIPO_EQUIPAMENTO);

            return $this->model->ExcluirTipoEquipamentoMODEL($vo);

        }
    }
}