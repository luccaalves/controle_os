<?php

namespace Src\Controller;

use Src\public\Util;
use Src\VO\ModeloVo;
use Src\Model\ModeloEquipamentoMODEL;

class ModeloEquipamentoCTRL{

    private $model;

    public function __construct(){
        $this->model = new ModeloEquipamentoMODEL();
    }

    public function CadastrarModeloCTRL(ModeloVo $vo) : int{
        //Testa se os parametros da vo estão vazios 
        if (empty($vo->getNomeModelo())){
            return 0;
        }else{
            $vo->setCodLogado(Util::UsuarioLogado());
            $vo->setErroFuncao(CADASTRAR_MODELO_EQUIPAMENTO);

            $ret = $this->model->CadastrarModeloEquipamentoMODEL($vo);

            return $ret;
        }
    }

    public function ConsultarModeloEquipamentoCTRL() : array{
        return $this->model->ConsultarModeloEquipamentoMODEL();
    }

    public function AlterarModeloEquipamentoCTRL(ModeloVo $vo) : int{
        if(empty($vo->getNomeModelo()) || empty($vo->getId())){
            return 0;
        }else{

            $vo->setCodLogado(Util::UsuarioLogado());
            $vo->setErroFuncao(ALTERAR_MODELO_EQUIPAMENTO);

            return $this->model->AlterarModeloEquipamentoMODEL($vo);
        }
    }

    public function ExcluirModeloCTRL(ModeloVO $vo){
        if(empty($vo->getId())){
            return 0;
        }else{

            $vo->setCodLogado(Util::UsuarioLogado());
            $vo->setErroFuncao(EXCLUIR_MODELO_EQUIPAMENTO);
        
        return $this->model->ExcluirModeloEquipamentoMODEL($vo);
        }
    }
}