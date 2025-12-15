<?php

namespace Src\VO;

use Src\public\Util;

class ChamadoVO extends LogErroVO{
    private $id;
    private $problema;
    private $laudo;
    private $alocar_id;
    private $situacao;
    private $funcionario_id;
    private $equipamento_id;
    private $tecnico_atendimento_id;
    private $tecnico_encerramento_id;

    public function setId(int $id) : void{
        $this->id = $id;
    }
    public function getId() : int{
        return $this->id;
    }

    public function setProblema(string  $problema) : void{
        $this->problema = Util::TratarDados($problema);
    }
    public function getProblema() : string{
        return $this->problema;
    }

    public function setLaudo(string $laudo) : void{
        $this->laudo = Util::TratarDados($laudo);
    }
    public function getLaudo() : string{
        return $this->laudo;
    }

    public function setAlocarId(string $alocar_id) : void{
        $this->alocar_id = Util::TratarDados($alocar_id);
    }
    public function getAlocarId() : string{
        return $this->alocar_id;
    }

    public function setSituacao(string $situacao) : void{
        $this->situacao = Util::TratarDados($situacao);
    }
    public function getSituacao() : string{
        return $this->situacao;
    }

    public function setFuncionarioId(string $funcionario_id) : void{
        $this->funcionario_id = Util::TratarDados($funcionario_id);
    }
    public function getFuncionarioId() : string{
        return $this->funcionario_id;
    }

    public function setEquipamentoId(string $equipamento_id) : void{
        $this->equipamento_id = Util::TratarDados($equipamento_id);
    }
    public function getEquipamentoId() : string{
        return $this->equipamento_id;
    }

    public function setTecnicoAtendimentoId(int $tecnico_atendimento_id) : void{
        $this->tecnico_atendimento_id = $tecnico_atendimento_id;
    }
    public function getTecnicoAtendimentoId() : int{
        return $this->tecnico_atendimento_id;
    }

    public function setTecnicoEncerramentoId(int $tecnico_encerramento_id) : void{
        $this->tecnico_encerramento_id = $tecnico_encerramento_id;
    }
    public function getTecnicoEncerramentoId() : int{
        return $this->tecnico_encerramento_id;
    }

    public function getDataAbertura(){
        return Util::DataAtual();
    }
    public function getHoraAbertura(){
        return Util::HoraAtual();
    }

    public function getDataAtendimento(){
        return Util::DataAtual();
    }

    public function getHoraAtendimento(){
        return Util::HoraAtual();
    }

    public function getDataEncarramento(){
        return Util::DataAtual();
    }

    public function getHoraEncerramento(){
        return Util::HoraAtual();
    }
}