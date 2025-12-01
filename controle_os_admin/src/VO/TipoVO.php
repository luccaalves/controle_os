<?php

namespace Src\VO;

use Src\public\Util;
use Src\VO\LogErroVO;

class TipoVO extends LogErroVO{
    private $id;
    private $nome_tipo;

    public function setId(int $id){
        $this->id = $id;
    }
    public function getId() : int{
        return $this->id;
    }

    public function setNomeTipo(string $nome_tipo) : void{
        $this->nome_tipo = Util::RemoverTags($nome_tipo);
    }
    public function getNomeTipo() : string{
        return $this->nome_tipo;
    }
}