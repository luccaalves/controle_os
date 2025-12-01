<?php

namespace Src\VO;

use Src\public\Util;
use Src\VO\LogErroVO;

class EquipamentoVO extends LogErroVO{
    private $id;
    private $identificacao;
    private $descricao;
    private $situacao;
    private $id_tipo;
    private $id_modelo;
    private $motivo_descarte;
    private $data_descarte;

    //SET e GET do ID do Equipamento!
    public function setId(int $id) : void{
        $this->id = $id;
    }
    public function getId() : int{
        return $this->id;
    }

    //SET e GET da IDENTIFICAÇÃO do Equipamento!
    public function setIdentificacaoEquipamento(string $identificacao) : void{
        $this->identificacao = Util::RemoverTags($identificacao);
    }
    public function getIdentificacaoEquipamento() : string{
        return $this->identificacao;
    }

    //SET e GET da DESCRIÇÃO do Equipamento!
    public function setDescricaoEquipamento(string $descricao) : void{
        $this->descricao = Util::RemoverTags($descricao);
    }
    public function getDescricaoEquipamento() : string{
        return $this->descricao;
    }

    //SET e GET da SITUAÇÃO do Equipamento!
    public function setSituacaoEquipamento(int $situacao) : void{
        $this->situacao = $situacao;
    }
    public function getSituacaoEquipamento() : int{
        return $this->situacao;
    }

    //SET e GET do TIPO do Equipamento!
    public function setTipoEquipamento(int $id_tipo) : void{
        $this->id_tipo = ($id_tipo);
    }
    public function getTipoEquipamento() : int{
        return $this->id_tipo;
    }

    //SET e GET do MODELO do Equipamento!
    public function setModeloEquipamento(int $id_modelo) : void{
        $this->id_modelo = $id_modelo;
    }
    public function getModeloEquipamento() : int{
        return $this->id_modelo;
    }

    public function setDataDescarte(string $data_descarte) : void{
        $this->data_descarte = $data_descarte;
    }
    public function getDataDescarte() : string{
        return $this->data_descarte;
    }

    public function setMotivoDescarte(string $motivo_descarte) : void{
        $this->motivo_descarte = Util::TratarDados($motivo_descarte);
    }
    public function getMotivoDescarte() : string{
        return $this->motivo_descarte;
    }

}
