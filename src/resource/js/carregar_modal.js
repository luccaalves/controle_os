function CarregarModalTipoEquipamento(id, nome){
    $("#alterar_tipo").val(nome);
    $("#id_alterar").val(id);
}

function CarregarModalModeloEquipamento(id, nome){
    $("#alterar_modelo").val(nome);
    $("#id_alterar").val(id);
}

function CarregarModalSetor(id, nome){
    $("#alterar_setor").val(nome);
    $("#id_alterar").val(id);
}

function CarregarModalExcluir(id, nome){
    $("#nome_excluir").html(nome);
    $("#id_excluir").val(id);
}

function CarregarModalDescarte(id, nome){
    $("#nome_descarte").html(nome);
    $("#id_descarte").val(id);
}

function CarregarDadosDescarte(data, nome, motivo){
    console.log("Data recebida:", data);
    $("#dados_data_descarte").val(data);
    $("#nome_dados_descarte").html(nome);
    $("#dados_motivo_descarte").val(motivo);
}