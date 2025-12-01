function CadastrarSetorUsuarioAJAX(formID){

    if(NotificarCampos(formID)){
        let nome = $("#nomeSetor").val();
        
        $.ajax({
            beforeSend: function(){
                Load();
            },
            type: "POST",
            url: BASE_URL_DATAVIEW('novo_setor_dataview'),
            data: {
                nomeSetor: nome,
                btnCadastrar: 'ajx',
            },
            success: function(ret){
                MostrarMensagem(ret);
                ConsultarSetorUsuarioAJAX();
                LimparNotificacoes(formID);
            },
            complete: function(){
                RemoverLoad();
            }
        })
    }
}

function ConsultarSetorUsuarioAJAX(){
    $.ajax({
        type: "POST",
        url: BASE_URL_DATAVIEW('novo_setor_dataview'),
        data:{
            consultarSetor: 'ajx'
        },
        success: function(dados){
            $("#tableResultado").html(dados);
        }
    })
}

function SelecionarSetorAJAX(){
    $.ajax({
        type: "POST",
        url: BASE_URL_DATAVIEW('novo_setor_dataview'),
        data:{
            selecionarSetor: 'ajx'
        },
        success: function(dados){
            $("#setor").html(dados);
        }
    })
}

function AlterarSetorUsuarioAJAX(formID){
    if(NotificarCampos(formID)){
        let nome = $("#alterar_setor").val();
        let id = $("#id_alterar").val();
        
        $.ajax({
            type: "POST",
            url: BASE_URL_DATAVIEW('novo_setor_dataview'),
            data: {
                alterar_setor: nome,
                id_alterar: id,
                btnAlterar: 'ajx',
            },
            success: function(ret){
                MostrarMensagem(ret);
                ConsultarSetorUsuarioAJAX();
                // Chama a função do arquivo FUNÇÕES.JS e pega o NOME DA MODAL para fechar!
                FecharModal("alterar-setor");
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
        url: BASE_URL_DATAVIEW('novo_setor_dataview'),
        data: {
            id_excluir: id,
            btnExcluir: 'ajx',
        },
        success: function(ret){
            MostrarMensagem(ret);
            ConsultarSetorUsuarioAJAX();
            FecharModal("modal-excluir");
        },
        complete: function(){
            RemoverLoad();
        }
    })
}