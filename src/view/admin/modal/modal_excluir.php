<div class="modal fade" id="modal-excluir">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Confirmação de Exclusão!:</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id_excluir" id="id_excluir">
                <strong>Deseja excluir o registro: </strong>
                <br>
                <span id="nome_excluir"></span>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-info btn-sm" name="btnExcluir" onclick="ExcluirAJAX();">Excluir</button>
            </div>
        </div>
    </div>
</div>