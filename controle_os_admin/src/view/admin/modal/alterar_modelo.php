<div class="modal fade" id="alterar-modelo">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Alterar Modelo Equipamento:</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id_alterar" id="id_alterar">
                <label>Modelo do Equipamento:</label>
                <input type="text" class="form-control obg" placeholder="Digite aqui..." name="alterar_modelo" id="alterar_modelo">
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success btn-sm" name="btnAlterar" onclick="return AlterarModeloEquipamentoAJAX('formAlt')">Salvar</button>
            </div>
        </div>
    </div>
</div>