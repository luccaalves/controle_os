<?php 

namespace Src\Model;

use Exception;
use Src\Model\Conexao;
use Src\VO\ModeloVo;
use Src\Model\SQL\MODELO_EQUIPAMENTO_SQL;

class ModeloEquipamentoMODEL extends Conexao{

    private $conexao; 

    public function __construct(){
        $this->conexao = parent::retornarConexao();   
    }
    public function CadastrarModeloEquipamentoMODEL(ModeloVo $vo){
        $sql = $this->conexao->prepare(MODELO_EQUIPAMENTO_SQL::CADASTRAR_MODELO_EQUIPAMENTO_SQL());

        $sql->bindValue(1, $vo->getNomeModelo());

        try{
            $sql->execute();
            return 1;
        }catch(Exception $ex){
            $vo->setErroTecnico($ex->getMessage());
            parent::GravarErroLog($vo);
            return -1;
        }
    }

    public function ConsultarModeloEquipamentoMODEL(){
        $sql = $this->conexao->prepare(MODELO_EQUIPAMENTO_SQL::CONSULTAR_MODELO_EQUIPAMENTO_SQL());

        $sql->execute();

        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function AlterarModeloEquipamentoMODEL(ModeloVO $vo){
        $sql = $this->conexao->prepare(MODELO_EQUIPAMENTO_SQL::ALTERAR_MODELO_EQUIPAMENTO_SQL());

        $i=1;

        $sql->bindValue($i++, $vo->getNomeModelo());
        $sql->bindValue($i++, $vo->getId());

        try{
            $sql->execute();
            return 1;
        }catch(Exception $ex){
            $vo->setErroTecnico($ex->getMessage());
            parent::GravarErroLog($vo);
            return -1;
        }
    }

    public function ExcluirModeloEquipamentoMODEL(ModeloVo $vo){
        $sql = $this->conexao->prepare(MODELO_EQUIPAMENTO_SQL::EXCLUIR_MODELO_EQUIPAMENTO_SQL());

        $sql->bindValue(1, $vo->getId());

        try{
            $sql->execute();
            return 1;
        }catch(Exception $ex){
            $vo->setErroTecnico($ex->getMessage());
            parent::GravarErroLog($vo);
            return -1;
        }
    }
}