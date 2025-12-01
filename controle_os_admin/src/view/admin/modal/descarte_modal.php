<div class="modal fade" id="modal-descarte">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Confirmação de Descarte:</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id_descarte" id="id_descarte">
                <strong>Deseja DESCARTAR o Equipamento: </strong>
                <br>
                <strong>Registro: </strong><span id="nome_descarte"></span>
                <div class="form-group">
                    <label>Data de Descarte:</label>
                    <input type="date" class="form-control obg" name="data_descarte" id="data_descarte">
                </div>
                <div class="form-group">
                    <label>Motivo do Descarte:</label>
                    <textarea class="form-control obg" rows="6" name="motivo_descarte" id="motivo_descarte" placeholder="Digite o Motivo do Descarte aqui..." maxlength="200"></textarea>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger btn-sm" name="btnDescarte" onclick="DescartarAJAX('formDesc')" >Sim</button>
            </div>
        </div>
    </div>
</div>