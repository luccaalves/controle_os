function HabilitarCampos(flag) {
    $("#cidade").prop("#disabled", flag);
    $("#estado").prop("#disabled", flag);
}

function LimparFormularioCEP() {
    //Limpa valores do formulário de cep.
    document.getElementById('rua').value = ("");
    document.getElementById('bairro').value = ("");
    document.getElementById('cidade').value = ("");
    document.getElementById('estado').value = ("");
    document.getElementById('cep').value = ("");
    $("#cep").focus();
}

function MeuCallBack(conteudo) {
    if (!("erro" in conteudo)) {
        //Atualiza os campos com os valores.
        document.getElementById('rua').value = (conteudo.logradouro);
        document.getElementById('bairro').value = (conteudo.bairro);
        document.getElementById('cidade').value = (conteudo.localidade);
        document.getElementById('estado').value = (conteudo.uf);
        HabilitarCampos(true)
    } else {
        //CEP não Encontrado.
        LimparFormularioCEP();
        MostrarMensagem(-2);
        HabilitarCampos(false)
    }
}

function PesquisarCep(valor) {
    //Nova variável "cep" somente com dígitos.
    var cep = valor.replace(/\D/g, '');
    //Verifica se campo cep possui valor informado.
    if (cep != "") {
        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if (validacep.test(cep)) {

            //Preenche os campos com "..." enquanto consulta webservice.
            document.getElementById('rua').value = "...";
            document.getElementById('bairro').value = "...";
            document.getElementById('cidade').value = "...";
            document.getElementById('estado').value = "...";

            //Cria um elemento javascript.
            var script = document.createElement('script');

            //Sincroniza com o callback.
            script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=MeuCallBack';

            //Insere script no documento e carrega o conteúdo.
            document.body.appendChild(script);

        } //end if.
        else {
            //cep é inválido.
            LimparFormularioCEP();
            MostrarMensagem(-3);
            HabilitarCampos(false)
        }
    } //end if.
    else {
        //cep sem valor, limpa formulário.
        LimparFormularioCEP();
    }
};
