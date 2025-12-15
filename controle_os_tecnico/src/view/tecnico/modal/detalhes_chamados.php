<div class="modal fade" id="modal-chamados">
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <div class="modal-header">
                <h4 class="modal-title">Detalhes do chamados</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id_chamado" id="id_chamado">
                <input type="hidden" name="id_alocar" id="id_alocar">
                <div class="form-group">
                    <label for="data_abertura">Dados do equipamento</label>
                    <input disabled type="text" class="form-control obg" id="equipamento">
                </div>
                <div class="form-group">
                    <label for="data_abertura">Data Abertura</label>
                    <input disabled class="form-control obg" id="data_abertura">
                </div>
                <div class="form-group">
                    <label for="problema">Problema</label>
                    <textarea readonly maxlength="100" type="text" class="form-control obg" id="problema" rows="2"></textarea>
                </div>
                <hr>
                <div id="tecAtendimento">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="data_atendimento">Data de atendimento</label>
                            <input disabled class="form-control obg" id="data_iniciou">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tec_ini">Técnico responsável pelo início do atendimento</label>
                            <input disabled type="text" class="form-control obg" id="tec_iniciou">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="laudo">Laudo</label>
                        <textarea maxlength="255" type="text" class="form-control obg" id="laudo" rows="2"></textarea>
                    </div>
                </div>
                <div id="tecEncerramento">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="data_encerramento">Data de encerramento</label>
                            <input disabled class="form-control obg" id="data_finalizou" rows="2">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tec_fina">Técnico responsável pela conclusão do atendimento</label>
                            <input disabled type="text" class="form-control obg" id="tec_finalizou">
                        </div>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-outline-dark" id="btn_acao" onclick="AtenderChamadoAJAX()">Iniciar</button>
                    <button type="button" class="btn btn-outline-dark" id="btn_finalizar" onclick="FinalizarChamadoAJAX('tecAtendimento')">Finalizar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog modal-lg -->
    </div>
    <!-- /.modal -->