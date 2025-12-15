function CarregarModalTipoEquipamento(id, nome){
    $("#id_alterar").val(id);
    $("#alterar_tipo").val(nome);
}

function CarregarModalModeloEquipamento(id, nome){
    $("#id_alterar").val(id);
    $("#alterar_modelo").val(nome);
}

function CarregarModalSetor(id, nome){
    $("#id_alterar").val(id);
    $("#alterar_setor").val(nome);
}

function CarregarModalExcluir(id, nome){
    $("#id_excluir").val(id);
    $("#nome_excluir").html(nome);
}

function CarregarModalDescarte(id, nome){
    $("#id_descarte").val(id);
    $("#nome_descarte").html(nome);
}

function CarregarDadosDescarte(data, nome, motivo){
    console.log("Data recebida:", data);
    $("#dados_data_descarte").val(data);
    $("#nome_dados_descarte").html(nome);
    $("#dados_motivo_descarte").val(motivo);
}