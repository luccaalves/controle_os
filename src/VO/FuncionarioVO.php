<?php

namespace Src\VO;

use Src\vo\UsuarioVO;

class FuncionarioVO extends UsuarioVO{

    private $id_setor;

    //SET e GET do ID do Setor!
    public function setIdSetor(int $id_setor) : void{
        $this->id_setor = $id_setor;
    }
    public function getIdSetor() : int{
        return $this->id_setor;
    }

}
