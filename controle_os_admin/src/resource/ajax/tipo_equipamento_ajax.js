function CadastrarTipoEquipamentoAJAX(formID) {

    if (NotificarCampos(formID)) {
        let nome = $("#nomeTipo").val();

        $.ajax({
            beforeSend: function () {
                Load();
            },
            type: "POST",
            url: BASE_URL_DATAVIEW('tipo_equipamento_dataview'),
            data: {
                nomeTipo: nome,
                btnCadastrar: 'ajx'
            },
            success: function (ret) {
                MostrarMensagem(ret);
                ConsultarTipoEquipamentoAJAX();
                LimparNotificacoes(formID);
            },
            complete: function () {
                RemoverLoad();
            }

        })
    }
}

function ConsultarTipoEquipamentoAJAX() {
    $.ajax({
        beforeSend: function () {
            Load();
        },
        type: "POST",
        url: BASE_URL_DATAVIEW('tipo_equipamento_dataview'),
        data: {
            consultarTipo: 'ajx'
        },
        success: function (dados) {
            $("#tableResultado").html(dados);
        },
        complete: function () {
            RemoverLoad();
        }
    })
}

function AlterarTipoEquipamentoAJAX(formID) {
    if (NotificarCampos(formID)) {
        let nome = $("#alterar_tipo").val();
        let id = $("#id_alterar").val();

        $.ajax({
            beforeSend: function () {
                Load();
            },
            type: "POST",
            url: BASE_URL_DATAVIEW('tipo_equipamento_dataview'),
            data: {
                alterar_tipo: nome,
                id_alterar: id,
                btnAlterar: 'ajx'
            },
            success: function (ret) {
                MostrarMensagem(ret);
                ConsultarTipoEquipamentoAJAX();
                FecharModal("alterar-tipo");
            },
            complete: function () {
                RemoverLoad();
            }

        })
    }
}
function ExcluirAJAX() {
    let id = $("#id_excluir").val();
    $.ajax({
        beforeSend: function () {
            Load();
        },
        type: "POST",
        url: BASE_URL_DATAVIEW('tipo_equipamento_dataview'),
        data: {
            id_excluir: id,
            btnExcluir: 'ajx'
        },
        success: function (ret) {
            MostrarMensagem(ret);
            ConsultarTipoEquipamentoAJAX();
            FecharModal("modal-excluir");
        },
        complete: function () {
            RemoverLoad();
        }

    })
} 
