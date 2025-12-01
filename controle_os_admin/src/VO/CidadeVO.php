<?php

namespace Src\VO;

use Src\public\Util;

class CidadeVO{

    private $id_cidade;
    private $nome_cidade;
    private $id_estado;

    public function setIdCidade(int $id_cidade) : void{
        $this->id_cidade = $id_cidade;
    }
    public function getIdCidade() : int{
        return $this->id_cidade;

    }

    public function setNomeCidade(string $nome_cidade) : void{
        $this->nome_cidade = $nome_cidade;
    }
    public function getNomeCidade() : string{
        return $this->nome_cidade;

    }

    public function setIdEstado(int $id_estado) : void{
        $this->id_estado = $id_estado;
    }
    public function getIdEstado() : int{
        return $this->id_estado;
    }
}