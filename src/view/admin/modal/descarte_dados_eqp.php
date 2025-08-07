<div class="modal fade" id="modal-dados-descarte">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Veja os Dados do Descarte</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id_dados_descarte" name="id_dados_descarte">
                <strong>Deseja DESCARTAR o Equipamento: </strong>
                <br>
                <strong>Registro: </strong><span id="nome_dados_descarte"></span>
                <div class="form-group">
                    <label>Data de Descarte:</label>
                    <input disabled type="date" class="form-control" id="dados_data_descarte" name="dados_data_descarte">
                </div>
                <div class="form-group">
                    <label>Motivo do Descarte:</label>
                    <textarea disabled class="form-control" rows="6" name="dados_motivo_descarte" id="dados_motivo_descarte" ></textarea>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>