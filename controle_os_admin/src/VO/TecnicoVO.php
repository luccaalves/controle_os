<?php

namespace Src\VO;

use Src\vo\UsuarioVO;
use Src\public\Util;

class TecnicoVO extends UsuarioVO{
    private $nome_empresa;
    
    //SET e GET do Nome da Empresa!
    public function setNomeEmpresa($nome_empresa) : void{
        $this->nome_empresa = Util::TratarDados($nome_empresa);
    }
    public function getNomeEmpresa() :  string{
        return $this->nome_empresa;
    }
}
