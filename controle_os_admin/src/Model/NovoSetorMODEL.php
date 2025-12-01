<?php

namespace Src\Model;

use Exception;
use Src\VO\SetorVO;
use Src\Model\Conexao;
use Src\Model\SQL\NOVO_SETOR_SQL;

class NovoSetorMODEL extends Conexao{
    private $conexao;

    public function __construct()
    {
        $this->conexao = parent::retornarConexao();
    }

    public function CadastrarSetorMODEL(SetorVO $vo){
        $sql = $this->conexao->prepare(NOVO_SETOR_SQL::CADASTRAR_SETOR_SQL());

        $sql->bindValue(1, $vo->getNomeSetor());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            $vo->setErroTecnico($ex->getMessage());
            parent::GravarErroLog($vo);

            return -1;
        }
    }

    public function ConsultarSetorMODEL(){
        $sql = $this->conexao->prepare(NOVO_SETOR_SQL::CONSULTAR_SETOR_SQL());

        $sql->execute();

        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    // public function SelecionarSetorMODEL(){
    //     $sql = $this->conexao->prepare(NOVO_SETOR_SQL::SELECIONAR_SETOR_SQL());

    //     $sql->execute();

    //     return $sql->fetchAll(\PDO::FETCH_ASSOC);
    // }

    public function AlterarSetorMODEL(SetorVO $vo){
        $sql = $this->conexao->prepare(NOVO_SETOR_SQL::ALTERAR_SETOR_SQL());

        $i = 1;

        $sql->bindValue($i++, $vo->getNomeSetor());
        $sql->bindValue($i++, $vo->getId());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            $vo->setErroTecnico($ex->getMessage());
            parent::GravarErroLog($vo);

            return -1;
        }
    }

    public function ExcluirSetorMODEL(SetorVO $vo){
        $sql = $this->conexao->prepare(NOVO_SETOR_SQL::EXCLUIR_SETOR_SQL());

        $sql->bindValue(1, $vo->getId());

        try{
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            $vo->setErroTecnico($ex->getMessage());
            parent::GravarErroLog($vo);
            return -1;
        }
    }
}
