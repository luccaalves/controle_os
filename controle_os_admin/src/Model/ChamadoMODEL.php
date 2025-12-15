<?php

namespace Src\Model;

use Exception;
use Src\Model\Conexao;
use Src\VO\ChamadoVO;
use Src\Model\SQL\CHAMADO_SQL;

class ChamadoMODEL extends Conexao
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = parent::retornarConexao();
    }

    public function AbrirChamadoMODEL(ChamadoVO $vo): int
    {
        $sql = $this->conexao->prepare(CHAMADO_SQL::ABRIR_CHAMADO_SQL());

        $i = 1;
        $sql->bindValue($i++, $vo->getDataAbertura());
        $sql->bindValue($i++, $vo->getHoraAbertura());
        $sql->bindValue($i++, $vo->getProblema());
        $sql->bindValue($i++, $vo->getFuncionarioId());
        $sql->bindValue($i++, $vo->getAlocarId());

        $this->conexao->beginTransaction();
        try {
            $sql->execute();

            $sql = $this->conexao->prepare(CHAMADO_SQL::ATUALIZAR_ALOCAMENTO_SQL());
            $i = 1;
            $sql->bindValue($i++, $vo->getSituacao());
            $sql->bindValue($i++, $vo->getAlocarId());
            $sql->execute();
            $this->conexao->commit();
            return 1;
        } catch (\Exception $ex) {
            $vo->setErroTecnico($ex->getMessage());
            parent::GravarErroLog($vo);
            $this->conexao->rollback();
            return -1;
        }
    }

    public function FiltrarChamadoMODEL(int $situacao, int $setor_id): array| null
    {
        $tem_setor = $setor_id == -1 ? false : true;

        $sql = $this->conexao->prepare(CHAMADO_SQL::FILTRAR_CHAMADO_SQL($situacao, $tem_setor));

        if ($tem_setor)
            $sql->bindValue(1, $setor_id);

        $sql->execute();
        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function DetalharChamadoMODEL(int $id): array | bool
    {
        $sql = $this->conexao->prepare(CHAMADO_SQL::DETALHAR_CHAMADO_SQL());
        $sql->bindValue(1, $id);
        $sql->execute();
        return $sql->fetch(\PDO::FETCH_ASSOC);
    }

    public function AtenderChamadoMODEL(ChamadoVO $vo): int
    {
        $sql = $this->conexao->prepare(CHAMADO_SQL::ATENDER_CHAMADO_SQL());
        $i = 1;
        $sql->bindValue($i++, $vo->getDataAtendimento());
        $sql->bindValue($i++, $vo->getHoraAtendimento());
        $sql->bindValue($i++, $vo->getTecnicoAtendimentoId());
        $sql->bindValue($i++, $vo->getId());

        try {
            $sql->execute();
            return 1;
        } catch (\Exception $ex) {
            $vo->setErroTecnico($ex->getMessage());
            parent::GravarErroLog($vo);
            $this->conexao->rollback();
            return -1;
        }
    }
    public function FinalizarChamadoMODEL(ChamadoVO $vo): int
    {
        $sql = $this->conexao->prepare(CHAMADO_SQL::FINALIZAR_CHAMADO_SQL());
        $i = 1;
        $sql->bindValue($i++, $vo->getDataEncarramento());
        $sql->bindValue($i++, $vo->getHoraEncerramento());
        $sql->bindValue($i++, $vo->getLaudo());
        $sql->bindValue($i++, $vo->getTecnicoEncerramentoId());
        $sql->bindValue($i++, $vo->getId());

        $this->conexao->beginTransaction();

        try {
            $sql->execute();
            $sql = $this->conexao->prepare(CHAMADO_SQL::ATUALIZAR_ALOCAMENTO_SQL());
            $i = 1;
            $sql->bindValue($i++, $vo->getSituacao());
            $sql->bindValue($i++, $vo->getAlocarId());
            $sql->execute();
            $this->conexao->commit();
            return 1;
        } catch (\Exception $ex) {
            $vo->setErroTecnico($ex->getMessage());
            parent::GravarErroLog($vo);
            $this->conexao->rollback();
            return -1;
        }
    }
    public function MostrarDadosChamadosMODEL(): array | bool{
        $sql = $this->conexao->prepare(CHAMADO_SQL::NUMEROS_CHAMADOS_ATUAIS_SQL());
        $sql->execute();
        return $sql->fetch(\PDO::FETCH_ASSOC);
    }
}
