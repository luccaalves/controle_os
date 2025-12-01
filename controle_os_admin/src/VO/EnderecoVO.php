<?php

namespace Src\VO;

use Src\public\Util;
use Src\VO\LogErroVO;


class EnderecoVO extends LogErroVO
{
    private $idCid;
    private $rua;
    private $bairro;
    private $cep;
    private $cidade;
    private $estado;


    public function setIdCidade(int $idCid): void
    {
        $this->idCid = $idCid;
    }
    public function getIdCidade(): int
    {
        return $this->idCid;
    }

    public function setRua(string $rua): void
    {
        $this->rua = Util::TratarDados($rua);
    }
    public function getRua(): string
    {
        return $this->rua;
    }

    public function setBairro(string $bairro): void
    {
        $this->bairro = Util::TratarDados($bairro);
    }
    public function getBairro(): string
    {
        return  $this->bairro;
    }

    public function setCEP($cep)
    {
        $this->cep = Util::TirarCaracteresEspeciais($cep);
    }

    public function getCep(): string
    {
        return $this->cep;
    }

    public function setCidade(string $cidade): void
    {
        $this->cidade = $cidade;
    }
    public function getCidade(): string
    {
        return $this->cidade;
    }

    public function setEstado(string $estado): void
    {
        $this->estado = $estado;
    }
    public function getEstado(): string
    {
        return $this->estado;
    }
}
