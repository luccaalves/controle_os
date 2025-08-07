<div class="modal fade" id="alterar-tipo">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Alterar Tipo Equipamento:</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id_alterar" id="id_alterar">
                <label>Tipo do Equipamento:</label>
                <input type="text" class="form-control obg" placeholder="Digite aqui..." name="alterar_tipo" id="alterar_tipo">
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success btn-sm" name="btnAlterar" onclick="return AlterarTipoEquipamentoAJAX('formAlt')">Salvar</button>
            </div>
        </div>
    </div>
</div>