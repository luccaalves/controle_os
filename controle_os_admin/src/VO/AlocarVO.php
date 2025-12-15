<?php

namespace Src\VO;

use Src\public\Util;
use Src\VO\LogErroVO;

class AlocarVo extends LogErroVO
{
    private $id;
    private $id_equipamento;
    private $id_setor;
    private $situacao;


    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function getId(): int
    {
        return $this->id;
    }

    public function getDataAlocar(): string
    {
        return Util::DataAtual();
    }

    public function getDataRemocao(): string
    {
        return Util::DataAtual();
    }

    public function setIdEquipamento(int $id_equipamento): void
    {
        $this->id_equipamento = $id_equipamento;
    }
    public function getIdEquipamento(): int
    {
        return $this->id_equipamento;
    }

    public function setIdSetor(int $id_setor): void
    {
        $this->id_setor = $id_setor;
    }
    public function getIdSetor(): int
    {
        return $this->id_setor;
    }

    public function setSituacao(int $situacao): void
    {
        $this->situacao = $situacao;
    }
    public function getSituacao(): int
    {
        return $this->situacao;
    }
}
