<?php

namespace Src\VO;

use Src\public\Util;

class LogErroVO{
    private $erro_tecnico;
    private $cod_logado;
    private $erro_funcao;

    public function setErroTecnico(string $erro_tecnico) : void{
        $this->erro_tecnico = $erro_tecnico;
    }
    public function getErroTecnico() : string{
        return $this->erro_tecnico;
    }

    public function setCodLogado(int $cod_logado) : void{
        $this->cod_logado = $cod_logado;
    }
    public function getCodLogado() : int{
        return $this->cod_logado;
    }

    public function setErroFuncao(string $erro_funcao) : void{
        $this->erro_funcao = $erro_funcao;
    }
    public function getErroFuncao() : string{
        return $this->erro_funcao;
    }

    public function getDataErro() : string{
        return Util::DataAtual();
    }

    public function getHoraErro() : string{
        return Util::HoraAtual();
    }
}