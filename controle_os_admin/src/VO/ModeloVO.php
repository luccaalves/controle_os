<?php

namespace Src\VO;

use Src\public\Util;
use Src\VO\LogErroVO;

class ModeloVo extends LogErroVO{
    private $id;
    private $nome_modelo;

    public function setId(int $id) : void{
        $this->id = $id;
    }
    public function getId() : int{
        return $this->id;
    }

    public function setNomeModelo(string $nome_modelo) : void{
        $this->nome_modelo = Util::RemoverTags($nome_modelo);
    }
    public function getNomeModelo() : string{
        return $this->nome_modelo;
    }
}