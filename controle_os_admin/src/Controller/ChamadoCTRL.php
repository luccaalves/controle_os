<?php

namespace Src\Controller;

use Src\public\Util;
use Src\Model\ChamadoMODEL;
use Src\VO\ChamadoVO;

class ChamadoCTRL
{
    private $model;
    public function __construct()
    {
        $this->model = new ChamadoMODEL;
    }

    public function AbrirChamadoCTRL(ChamadoVO $vo, $tem_sessao = true): int
    {
        if (empty($vo->getAlocarId()) || empty($vo->getProblema())) {
            return 0;
        }

        $vo->setErroFuncao(ABRIR_CHAMADO);
        $vo->setCodLogado($tem_sessao ? Util::UsuarioLogado() : $vo->getFuncionarioId());
        $vo->setSituacao(SITUACAO_EQUIPAMENTO_MANUTENCAO);

        return $this->model->AbrirChamadoMODEL($vo);
    }

    public function FiltrarChamadoCTRL(int $situacao, int $setor_id = -1): array| null
    {
        return $this->model->FiltrarChamadoMODEL($situacao, $setor_id);
    }
    public function DetalharChamadoCTRL(int $id): array| null
    {
        return $this->model->DetalharChamadoMODEL($id);
    }

    public function AtenderChamadoCtrl(ChamadoVO $vo): int
    {
        if (empty($vo->getTecnicoAtendimentoId()) || empty($vo->getId())) {
            return 0;
        }

        $vo->setErroFuncao(ATENDER_CHAMADO);
        $vo->setCodLogado($vo->getTecnicoAtendimentoId());
        return $this->model->AtenderChamadoMODEL($vo);
    }

    public function FinalizarChamadoCtrl(ChamadoVO $vo): int
    {
        if (empty($vo->getTecnicoEncerramentoId()) || empty($vo->getId()) || empty($vo->getLaudo()) || empty($vo->getAlocarId())) {
            return 0;
        }

        $vo->setSituacao(SITUACAO_CHAMADO_FINALIZADO);
        $vo->setErroFuncao(FINALIZAR_CHAMADO);
        $vo->setCodLogado($vo->getTecnicoEncerramentoId());
        return $this->model->FinalizarChamadoMODEL($vo);
    }
    public function MostrarDadosChamadosCTRL():array | bool{
        return $this->model->MostrarDadosChamadosMODEL();
    }
}
