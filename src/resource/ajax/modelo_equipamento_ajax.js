function CadastrarModeloEquipamentoAJAX(formID){
    if(NotificarCampos(formID)){
        let nome = $("#nomeModelo").val();

        $.ajax({
            beforeSend: function(){
                Load();
            },
            type: "POST",
            url: BASE_URL_DATAVIEW('modelo_equipamento_dataview'),
            data: {
                nomeModelo: nome,
                btnCadastrar: 'ajx'
            },
            success: function(ret){
                MostrarMensagem(ret);
                LimparNotificacoes(formID);
                ConsultarModeloEquipamentoAJAX();
            },
            complete: function(){
                RemoverLoad();
            }
        })
    }
}

function ConsultarModeloEquipamentoAJAX(){
    $.ajax({
        beforeSend: function(){
            Load();
        },
        type: "POST",
        url: BASE_URL_DATAVIEW('modelo_equipamento_dataview'),
        data:{
            consultarModelo: 'ajx'
        },
        success: function(dados){
            $("#tableResultado").html(dados);
        },
        complete: function(){
            RemoverLoad();
        }
    })
}

function AlterarModeloEquipamentoAJAX(formID){
    if(NotificarCampos(formID)){
        let nome = $("#alterar_modelo").val();
        let id = $("#id_alterar").val();
        
        $.ajax({
            beforeSend: function(){
                Load();
            },
            type: "POST",
            url: BASE_URL_DATAVIEW('modelo_equipamento_dataview'),
            data: {
                alterar_modelo: nome,
                id_alterar: id,
                btnAlterar: 'ajx',
            },
            success: function(ret){
                MostrarMensagem(ret);
                ConsultarModeloEquipamentoAJAX();
                // Chama a função do arquivo FUNÇÕES.JS e pega o NOME DA MODAL para fechar!
                FecharModal("alterar-modelo");
            },
            complete: function(){
                RemoverLoad();
            }
        })
    }
}

function ExcluirAJAX(){
    let id = $("#id_excluir").val();
        
    $.ajax({
        beforeSend: function(){
            Load();
        },
        type: "POST",
        url: BASE_URL_DATAVIEW('modelo_equipamento_dataview'),
        data: {
            id_excluir: id,
            btnExcluir: 'ajx',
        },
        success: function(ret){
            MostrarMensagem(ret);
            ConsultarModeloEquipamentoAJAX();
            // Chama a função do arquivo FUNÇÕES.JS e pega o NOME DA MODAL para fechar!
            FecharModal("modal-excluir");
        },
        complete: function(){
            RemoverLoad();
        }
    })
}