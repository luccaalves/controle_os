<?php

namespace Src\Controller;

use Src\VO\EquipamentoVO;
use Src\Model\NovoEquipamentoMODEL;
use Src\public\Util;
use Src\VO\AlocarVo;

class NovoEquipamentoCTRL
{

    private $model;

    public function __construct(){
        $this->model = new NovoEquipamentoMODEL();
    }

    public function CadastrarEquipamentoCTRL(EquipamentoVO $vo): int{
        if (empty($vo->getTipoEquipamento()) || empty($vo->getModeloEquipamento()) || empty($vo->getIdentificacaoEquipamento()) || empty($vo->getDescricaoEquipamento())) {
            return 0;
        } else {
            $vo->setSituacaoEquipamento(SITUACAO_ATIVO);
            $vo->setErroFuncao(CADASTRAR_EQUIPAMENTO);
            $vo->setCodLogado(Util::UsuarioLogado());

            return $this->model->CadastrarNovoEquipamentoMODEL($vo);
        }
    }

    public function FiltrarNovoEquipamentoCTRL($id_tipo, $id_modelo): array{
        return $this->model->FiltrarNovoEquipamentoMODEL($id_tipo, $id_modelo, SITUACAO_EQUIPAMENTO_REMOVIDO);
    }

    public function SelecionarEquipamentoDisponivelCTRL() : array | string{
        return $this->model->SelecionarEquipamentoDisponivelMODEL(SITUACAO_ATIVO, SITUACAO_EQUIPAMENTO_REMOVIDO);
    }

    public function EquipamentoAlocadoSetorCTRL(int $setor_id) : array | null{
        return $this->model->EquipamentoAlocadoSetorMODEL($setor_id, SITUACAO_EQUIPAMENTO_ALOCADO);
    }

    public function DetalharEquipamentoCTRL(int $id): array | string{
        return $this->model->DetalharEquipamentoMODEL($id);
    }

    public function AlterarEquipamentoCTRL(EquipamentoVO $vo): int{
        if (empty($vo->getTipoEquipamento()) || empty($vo->getModeloEquipamento()) || empty($vo->getIdentificacaoEquipamento()) || empty($vo->getDescricaoEquipamento())) {

            return 0;
        } else {
            $vo->setErroFuncao(ALTERAR_EQUIPAMENTO);
            $vo->setCodLogado(Util::UsuarioLogado());

            return $this->model->AlterarEquipamentoMODEL($vo);
        }
    }

    public function ExcluirEquipamentoCTRL(EquipamentoVO $vo){
        if (empty($vo->getId())) {
            return 0;
        } else {
            $vo->setCodLogado(Util::UsuarioLogado());
            $vo->setErroFuncao(EXCLUIR_EQUIPAMENTO);

            return $this->model->ExcluirEquipamentoMODEL($vo);
        }
    }

    public function RemoverEquipamentoCTRL(AlocarVo $vo) : int {
        $vo->setCodLogado((Util::UsuarioLogado()));
        $vo->setErroFuncao(REMOVER_ALOCAR_EQUIPAMENTO);
        $vo->setSituacao(SITUACAO_EQUIPAMENTO_REMOVIDO);

        return $this->model->RemoverEquipamentoSetorModel($vo);
    }

    public function DescartarEquipamentoCTRL(EquipamentoVO $vo){
        if(empty($vo->getMotivoDescarte()) || empty($vo->getId()) || empty($vo->getDataDescarte())){
            return 0;
        }else{
            $vo->setSituacaoEquipamento(SITUACAO_DESCARTADO);
            $vo->setErroFuncao(DESCARTE_EQUIPAMENTO);
            $vo->setCodLogado(Util::UsuarioLogado());

            return $this->model->DescarteEquipamentoModel($vo);
        }
    }

    public function AlocarEquipamentoCTRL(AlocarVo $vo) : int{
        if(empty($vo->getIdEquipamento()) || empty($vo->getIdSetor())){
            return 0;
        }else{
            $vo->setSituacao(SITUACAO_EQUIPAMENTO_ALOCADO);
            $vo->setErroFuncao(ALOCAR_EQUIPAMENTO);
            $vo->setCodLogado(Util::UsuarioLogado());

            return $this->model->AlocarEquipamentoMODEL(($vo));
        }
    }
}
