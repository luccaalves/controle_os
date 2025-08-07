<?php

namespace Src\Model;

use Exception;
use Src\Model\Conexao;
use Src\VO\EquipamentoVO;
use Src\Model\SQL\NOVO_EQUIPAMENTO_SQL;
use Src\VO\AlocarVo;

class NovoEquipamentoModel extends Conexao{
    private $conexao;

    public function __construct(){
        $this->conexao = parent::retornarConexao();
    }
    
    public function CadastrarNovoEquipamentoMODEL(EquipamentoVO $vo){

        $sql = $this->conexao->prepare(NOVO_EQUIPAMENTO_SQL::CADASTRAR_EQUIPAMENTO_SQL());
        $i = 1;

        $sql->bindValue($i++, $vo->getIdentificacaoEquipamento());
        $sql->bindValue($i++, $vo->getDescricaoEquipamento());
        $sql->bindValue($i++, $vo->getSituacaoEquipamento());
        $sql->bindValue($i++, $vo->getTipoEquipamento());
        $sql->bindValue($i++, $vo->getModeloEquipamento());


        try{
            $sql->execute();
            return 1;
        }catch(Exception $ex){
            $vo->setErroTecnico($ex->getMessage());
            parent::GravarErroLog($vo);
            return -1;
        }
    }

    public function FiltrarNovoEquipamentoMODEL($id_tipo, $id_modelo, $situacao) : array{
        $sql = $this->conexao->prepare(NOVO_EQUIPAMENTO_SQL::FILTRAR_EQUIPAMENTO_SQL($id_tipo, $id_modelo));

        $i = 1;

        $sql->bindValue($i++, $situacao);

        if($id_tipo != ''){
            $sql->bindValue($i++, $id_tipo);
        }

        if($id_modelo != ''){
            $sql->bindValue($i++, $id_modelo);
        }

        $sql->execute();

        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function SelecionarEquipamentoDisponivelMODEL(int $sitEquipamento, int $sitAlocado) : array | string{
        $sql = $this->conexao->prepare(NOVO_EQUIPAMENTO_SQL::SELECIONAR_EQUIPAMENTO_SQL());

        $i = 1;

        $sql->bindValue($i++, $sitEquipamento);
        $sql->bindValue($i++, $sitAlocado);

        $sql->execute();

        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function EquipamentoAlocadoSetorMODEL(int $setor_id, int $situacaoAlocado) : array | null{
        $sql = $this->conexao->prepare(NOVO_EQUIPAMENTO_SQL::EQUIPAMENTOS_ALOCADO_SETOR_SQL());

        $i = 1;

        $sql->bindValue($i++, $setor_id);
        $sql->bindValue($i++, $situacaoAlocado);

        $sql->execute();

        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function DetalharEquipamentoMODEL(int $id) : array{
        $sql = $this->conexao->prepare(NOVO_EQUIPAMENTO_SQL::DETALHAR_EQUIPAMENTO_SQL());

        $sql->bindValue(1, $id);

        $sql->execute();

        return $sql->fetch(\PDO::FETCH_ASSOC);
    }

    public function AlterarEquipamentoMODEL(EquipamentoVO $vo) : int{
        $sql = $this->conexao->prepare(NOVO_EQUIPAMENTO_SQL::ALTERAR_EQUIPAMENTO_SQL());

        $i = 1;

        $sql->bindValue($i++, $vo->getIdentificacaoEquipamento());
        $sql->bindValue($i++, $vo->getDescricaoEquipamento());
        $sql->bindValue($i++, $vo->getTipoEquipamento());
        $sql->bindValue($i++, $vo->getModeloEquipamento());
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

    public function ExcluirEquipamentoMODEL(EquipamentoVO $vo){
        $sql= $this->conexao->prepare(NOVO_EQUIPAMENTO_SQL::EXCLUIR_EQUIPAMENTO_SQL());

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

    public function RemoverEquipamentoSetorMODEL(AlocarVo $vo) : int{
        $sql = $this->conexao->prepare(NOVO_EQUIPAMENTO_SQL::REMOVER_EQUIPAMENTO_SETOR_SQL());

        $i = 1;

        $sql->bindValue($i++, $vo->getDataRemocao());
        $sql->bindValue($i++, $vo->getSituacao());
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

    public function DescarteEquipamentoModel(EquipamentoVO $vo) : int{
        $sql= $this->conexao->prepare(NOVO_EQUIPAMENTO_SQL::DESCARTE_EQUIPAMENTO_SQL());

        $i = 1;

        $sql->bindValue($i++, $vo->getDataDescarte());
        $sql->bindValue($i++, $vo->getMotivoDescarte());
        $sql->bindValue($i++, $vo->getSituacaoEquipamento());
        $sql->bindValue($i++, $vo->getId());

        try{
            $sql->execute();
            return 1;
        }catch(Exception $ex) {
            $vo->setErroTecnico($ex->getMessage());
            parent::GravarErroLog(($vo));
            return -1;
        }
    }

    public function AlocarEquipamentoMODEL(AlocarVo $vo) : int{
        $sql = $this->conexao->prepare(NOVO_EQUIPAMENTO_SQL::ALOCAR_EQUIPAMENTO_SQL());

        $i = 1;

        $sql->bindValue($i++, $vo->getDataAlocar());
        $sql->bindValue($i++, $vo->getSituacao());
        $sql->bindValue($i++, $vo->getIdEquipamento());
        $sql->bindValue($i++, $vo->getIdSetor());

        try{
            $sql->execute();
            return 1;
        }catch(Exception$ex){
            $vo->setErroTecnico(($ex->getMessage()));
            parent::GravarErroLog($vo);
            return -1;
        }
    }
}