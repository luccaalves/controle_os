function NotificarCampos(formID) {

    let ret = true;

    // O parâmetro formID representa todos os campos de dados do formulário!
    // Cada chamada dessa linha, busca pelos respectivos campos encontrados no formID!
    $("#" + formID + " input, #" + formID + " textarea, #" + formID + " select").each(function () {
        // alert($(this).val());

        // OBG representa os campos obrigatórios do Formulário!
        if ($(this).hasClass("obg")) {
            if ($(this).val() == "") {
                ret = false;
                $(this).addClass("is-invalid");
            } else {
                $(this).removeClass("is-invalid").addClass("is-valid");
            }
        }
    });

    if (!ret) {
        // MostrarMensagem(ret);
        MostrarMensagem(0);
    }

    return ret;
}

// Gerencia a chamada dos arquivos da dataview sem precisar digitar sempre o nome do arquivo!
function BASE_URL_DATAVIEW(dataview) {
    return '../../resource/dataview/' + dataview + '.php';
}

function LimparNotificacoes(formID) {
    $("#" + formID + " input, #" + formID + " textarea, #" + formID + " select").each(function () {
        $(this).val('');
        $(this).removeClass("is-invalid").removeClass("is-valid");
    });
}

function FecharModal(nome_modal) {
    $('#' + nome_modal).modal("hide");
}
// Essa função vai travar o disparo do formulário caso selecione o botão e tecle ENTER!
// Caso seja realizada a tentativa de disparo com ENTER, ele joga o cursor no próximo campo!
function FocarCampoEnter(ev, next) {
    if (ev.keyCode == 13) {
        // Não vai permitir o disparo para o Servidor
        ev.preventDefault();
        $('#' + next).focus();
    }
}

function Load() {
    $(".loader").addClass("is-active");
}

function RemoverLoad() {
    $(".loader").removeClass("is-active");
}

function LimparCamposEquipamento() {
    $("#item").val("");
    $("#tipo").val("0");
    $("#modelo").val("");
    $("#descricao").val("");
    $("#id_equipamento").val("0");
}

function CarregarCamposUsuario(tipo) {
    // Limpa os Campos!
    LimparNotificacoes("formCAD");
    $("#tipo").val(tipo);

    // Remove obrigatoriedade de todos
    $("#setor").removeClass("obg");
    $("#nomeEmp").removeClass("obg");

    // Limpa valores de todos os campos não usados
    $("#setor").val("");
    $("#nomeEmp").val("");

    switch (tipo) {
        case '1':
            // Usuário Administrador!
            $("#div-dados-usuario").show();
            $("#div-dados-local").show();
            $("#btn-cadastrar").show();

            $("#div-dados-funcionario").hide();
            $("#div-dados-tecnico").hide();

            break;

        case '2':
            // Usuário Funcionário!
            $("#div-dados-usuario").show();
            $("#div-dados-local").show();
            $("#btn-cadastrar").show();

            $("#div-dados-funcionario").show();
            $("#div-dados-tecnico").hide();

            // Setamos o obg no Setor!
            $("#setor").addClass("obg");
            SelecionarSetorAJAX();
            break;

        case '3':
            // Usuário Técnico!
            $("#div-dados-usuario").show();
            $("#div-dados-local").show();
            $("#btn-cadastrar").show();

            $("#div-dados-funcionario").hide();
            $("#div-dados-tecnico").show();

            // Setamos o obg no nome da empresa!
            $("#nomeEmp").addClass("obg");
            break;

        default:
            $("#div-dados-usuario").hide();
            $("#div-dados-local").hide();
            $("#btn-cadastrar").hide();

            $("#div-dados-funcionario").hide();
            $("#div-dados-tecnico").hide();
            break;
    }
}

function ValidarCPF(cpf) {
    if (cpf != "") {
        cpf = cpf.replace(/\D/g, "");
        if (cpf.toString().length != 11 || /^(\d)\1{10}$/.test(cpf)){
            MostrarMensagem(-4);
            $("#cpf").val("");
            return false;

        }

        var result = true;

        [9, 10].forEach(function (j) {
            var soma = 0,
                r;
            cpf.split(/(?=)/).splice(0, j).forEach(function (e, i) {
                soma += parseInt(e) * ((j + 2) - (i + 1));
            });
            r = soma % 11;
            r = (r < 2) ? 0 : 11 - r;
            if (r != cpf.substring(j, j + 1)) {
                MostrarMensagem(-4);
                $("#cpf").val("");
                result = false;
            }
        });

        if(!result){
            MostrarMensagem(-4);
            $("cpf").val('');
        }
        return result;
    }
}

function ValidarEmail(email1) {
    let re = /\S+@\S+\.\S+/;
    let retorno = true;

    if (!re.test(email1)) {
        $("#email1").val('');
        MostrarMensagem(-5);
        retorno = false;
    }

    return retorno;
}

function BASE_PATH() {
    return "http://controle_os.test/controle_os_admin/src/view/admin/";
}
function RedirecionarPagina(url, segundos){
    setTimeout(()=>{
        window.location = BASE_PATH() + url;
    }, segundos * 1000)
}
