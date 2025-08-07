<?php

namespace Src\VO;

use Src\public\Util;

class ChamadoVO{
    private $id;
    private $problema;
    private $laudo;
    private $id_funcionario;
    private $id_tecnico;

    public function setId(int $id) : void{
        $this->id = $id;
    }
    public function get() : int{
        return $this->id;
    }

    public function getDataAbertura(){
        return Util::DataAtualBr();
    }

    public function getHoraAbertura(){
        return Util::HoraAtual();
    }

    public function setProblema(string  $problema) : void{
        $this->problema = Util::TratarDados($problema);
    }
    public function getProblema() : string{
        return $this->problema;
    }

    public function getDataAtendimento(){
        return Util::DataAtualBr();
    }

    public function getHoraAtendimento(){
        return Util::HoraAtual();
    }

    public function setLaudo(string $laudo) : void{
        $this->laudo = Util::TratarDados($laudo);
    }
    public function getLaudo() : string{
        return $this->laudo;
    }

    public function getDataEncarramento(){
        return Util::DataAtual();
    }

    public function getHoraEncerramento(){
        return Util::HoraAtual();
    }

    public function setIdTecnico(int $id_tecnico) : void{
        $this->id_tecnico = $id_tecnico;
    }
    public function getIdTecnico() : int{
        return $this->id_tecnico;
    }

    public function setIdFuncionario(int $id_funcionario) : void{
        $this->id_funcionario = $id_funcionario;
    }
    public function getIdFuncionario() : int{
        return $this->id_funcionario;
    }

}