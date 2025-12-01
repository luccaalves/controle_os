function CadastrarEquipamentoAJAX(formID) {
    if (NotificarCampos(formID)) {
        $.ajax({
            beforeSend: function () {
                Load();
            },
            type: "POST",
            url: BASE_URL_DATAVIEW('novo_equipamento_dataview'),
            data: {
                tipo: $("#tipo").val(),
                modelo: $("#modelo").val(),
                identificacao: $("#identificacao").val(),
                descricao: $("#descricao").val(),
                btnCadastrar: 'ajx'
            },
            success: function (ret) {
                MostrarMensagem(ret);
                LimparNotificacoes(formID);
            },
            complete: function () {
                RemoverLoad();
            }
        })
    }
}

function GravarEquipamentoAJAX(formID) {
    if (NotificarCampos(formID)) {
        $.ajax({
            beforeSend: function () {
                Load();
            },
            type: "POST",
            url: BASE_URL_DATAVIEW('novo_equipamento_dataview'),
            data: {
                btnGravar: $("#id_equipamento").val() == '' ? 'Cadastrar' : 'Alterar',
                tipo: $("#tipo").val(),
                modelo: $("#modelo").val(),
                identificacao: $("#identificacao").val(),
                descricao: $("#descricao").val(),
                id_equipamento: $("#id_equipamento").val()
            },
            success: function (ret) {
                MostrarMensagem(ret);
                if ($("#id_equipamento").val() == "") {
                    LimparNotificacoes(formID);
                } else {
                    setTimeout(function () {
                        window.location.href = 'consultar_equipamento.php';
                    }, 1500);
                }
            },
            complete: function () {
                RemoverLoad();
            }
        })
    }
}

function CarregarTiposAJAX() {
    $.ajax({
        beforeSend: function () {
            Load();
        },
        type: "post",
        url: BASE_URL_DATAVIEW("novo_equipamento_dataview"),
        data: {
            consultarTipo: 'ajx',
            id_tipo: $("#id_tipo").val(),
        },
        success: function (dados) {
            $("#tipo").html(dados);
            //alert(dados);
        },
        complete: function () {
            RemoverLoad();
        }
    })
}

function CarregarModelosAJAX() {
    $.ajax({
        beforeSend: function () {
            Load();
        },
        type: "post",
        url: BASE_URL_DATAVIEW("novo_equipamento_dataview"),
        data: {
            consultarModelo: 'ajx',
            id_modelo: $("#id_modelo").val(),
        },
        success: function (dados) {
            $("#modelo").html(dados);
            //alert(dados);
        },
        complete: function () {
            RemoverLoad();
        }
    })
}

function FiltrarEquipamentoAJAX() {
    let idTipo = $("#tipo").val();
    let idModelo = $("#modelo").val();
    $.ajax({
        beforeSend: function () {
            Load();
        },
        type: "post",
        url: BASE_URL_DATAVIEW("novo_equipamento_dataview"),
        data: {
            filtrarEquipamentos: 'ajx',
            tipo: idTipo,
            modelo: idModelo
        },
        success: function (dados) {
            $("#tableResult").html(dados);
        },
        complete: function () {
            RemoverLoad();
        }
    })
}

function SelecionarEquipamentoDisponivelAJAX() {
    $.ajax({
        beforeSend: function () {
            Load();
        },
        type: "POST",
        url: BASE_URL_DATAVIEW('novo_equipamento_dataview'),
        data: {
            selecionarEquipamentoDisponivel: 'ajx'
        },
        success: function (dados) {
            $("#equipamento").html(dados);
        },
        complete: function () {
            RemoverLoad();
        }
    })
}

function ExcluirAJAX() {
    $.ajax({
        beforeSend: function () {
            Load();
        },
        type: "post",
        url: BASE_URL_DATAVIEW("novo_equipamento_dataview"),
        data: {
            btnExcluir: $("#itemTela").val() == 'telaRemover' ? 'RemoverEquipamento' : 'Excluir',
            id_equipamento: $("#id_excluir").val()
        },
        success: function (ret) {
            MostrarMensagem(ret);

            if ($("#itemTela").val() == 'Excluir') {
                FiltrarEquipamentoAJAX();
            } else {
                ConsultarEquipamentoAlocadoAJAX($("#setor").val());
            }
            FecharModal("modal-excluir");
        },
        complete: function () {
            RemoverLoad();
        }
    })
}

function DescartarAJAX(formID) {
    if (NotificarCampos(formID)) {
        $.ajax({
            beforeSend: function () {
                Load();
            },
            type: "POST",
            url: BASE_URL_DATAVIEW("novo_equipamento_dataview"),
            data: {
                btnDescarte: 'Descarte',
                id_equipamento: $("#id_descarte").val(),
                motivo_descarte: $("#motivo_descarte").val(),
                data_descarte: $("#data_descarte").val()
            },
            success: function (ret) {
                MostrarMensagem(ret);
                LimparNotificacoes(formID);
                FiltrarEquipamentoAJAX();
                FecharModal("modal-descarte");
            },
            complete: function () {
                RemoverLoad();
            }
        })
    }
}

function AlocarEquipamentoAJAX(formID) {
    if (NotificarCampos(formID)) {
        $.ajax({
            beforeSend: function () {
                Load();
            },
            type: "POST",
            url: BASE_URL_DATAVIEW('novo_equipamento_dataview'),
            data: {
                alocarEquipamento: 'ajx',
                id_equipamento: $("#equipamento").val(),
                id_setor: $("#setor").val()
            },
            success: function (ret) {
                MostrarMensagem(ret);
                LimparNotificacoes(formID);
                SelecionarEquipamentoDisponivelAJAX();
            },
            complete: function () {
                RemoverLoad();
            }
        })
    }
}

function ConsultarEquipamentoAlocadoAJAX(id_setor) {
    // console.log("Setor enviado:", id_setor);
    if (id_setor != '') {
        $.ajax({
            beforeSend: function () {
                Load();
            },
            type: "POST",
            url: BASE_URL_DATAVIEW('novo_equipamento_dataview'),
            data: {
                consultarEquipamentoAlocado: 'ajx',
                id_setor: id_setor
            },
            success: function (dados) {
                // console.log('Retorno do PHP:', dados); 
                $("#tableResult").html(dados);
                $("#div-resultado").show();
            },
            complete: function () {
                RemoverLoad();
            }
        })
    } else {
        $("#tableResult").html('');
        $("#div-resultado").hide();
    }
}
