<?php

namespace Src\VO;

use Src\public\Util;
use Src\VO\LogErroVO;

class SetorVO extends LogErroVO{

    private $id;
    private $nome_setor;
    
    public function setId(string $id) : void{
        $this->id = $id;
    }

    public function getId() : string{
        return $this->id;
    }

    public function setNomeSetor(string $nome_setor) : void{
        $this->nome_setor = Util::TratarDados($nome_setor);
    }

    public function getNomeSetor() : string{
        return $this->nome_setor;
    }
}