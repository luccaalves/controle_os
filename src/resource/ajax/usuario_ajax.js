function VerificarEmailDuplicadoAJAX(email) {
    if (ValidarEmail(email)) {
        $.ajax({
            beforeSend: function () {
                Load();
            },
            type: "POST",
            url: BASE_URL_DATAVIEW("usuario_dataview"),
            data: {
                verificarEmailDuplicado: 'ajx',
                email: email
            },
            success: function (ret) {
                if (ret) {
                    MostrarMensagem(-6);
                    $("#email1").val('');
                }
            },
            complete: function () {
                RemoverLoad();
            }
        });
    }
}

function CadastrarUsuarioAJAX(formID) {

    let tipo = $("#tipo").val();

    if (NotificarCampos(formID)) {
        $.ajax({
            beforeSend: function () {
                Load();
            },
            type: "POST",
            url: BASE_URL_DATAVIEW("usuario_dataview"),
            data: {
                btnCadastrar: 'ajx',
                tipo: $("#tipo").val(),
                nomeEmp: tipo == 3 ? $("#nomeEmp").val() : '',
                setor: tipo == 2 ? $("#setor").val() : '',
                nome: $("#nome").val(),
                email1: $("#email1").val(),
                cpf: $("#cpf").val(),
                telefone: $("#telefone").val(),
                rua: $("#rua").val(),
                bairro: $("#bairro").val(),
                cep: $("#cep").val(),
                cidade: $("#cidade").val(),
                estado: $("#estado").val()
            },
            success: function (ret) {
                MostrarMensagem(ret);
                if (ret == 1) {
                    CarregarCamposUsuario(0);
                }
            },
            complete: function () {
                RemoverLoad();
            }
        });
    }
}

// function FiltrarUsuarioAJAX() {
//     let nome = document.getElementById("nomeFiltro").value;

//     if (nome.length > 2) {
//         $.ajax({
//             beforeSend: function () {
//                 Load();
//             },
//             type: "POST",
//             url: BASE_URL_DATAVIEW("usuario_dataview"),
//             data: {
//                 filtrarUsuario: 'ajx',
//                 nomeFiltro: nome
//             },
//             success: function (dados) {
//                 if (dados == 0) {
//                     MostrarMensagem(2);
//                     $("#divResult").hide();
//                 } else {
//                     $("#tableResult").html(dados);
//                     $("#divResult").show();
//                 }
//             },
//             complete: function () {
//                 RemoverLoad();
//             }
//         });
//     } else {
//         $("#tableResult").html("");
//         $("#divResult").hide();
//     }
// }

function FiltrarUsuarioAJAX() {
    let nome = document.getElementById("nomeFiltro").value;

    if (nome.length > 2) {
        $.ajax({
            beforeSend: function () {
                Load();
            },
            type: "POST",
            url: BASE_URL_DATAVIEW("usuario_dataview"),
            data: {
                filtrarUsuario: 'ajx',
                nomeFiltro: nome
            },
            success: function (dados) {
                if (dados == 0) {
                    MostrarMensagem(2);
                    $("#divResult").hide();
                } else {
                    $("#tableResult").html(dados);
                    $("#divResult").show();
                }
            },
            complete: function () {
                RemoverLoad();
            }
        });
    } else {
        $("#tableResult").html("");
        $("#divResult").hide();
    }
}

function AlterarStatusUsuarioAJAX(id, status) {
    $.ajax({
        beforeSend: function () {
            Load();
        },
        type: "POST",
        url: BASE_URL_DATAVIEW("usuario_dataview"),
        data: {
            alterarStatusUsuario: 'ajx',
            id_usuario: id,
            status_usuario: status
        },
        success: function (ret) {
            MostrarMensagem(ret);

            if (ret == 1) {
                FiltrarUsuarioAJAX();
            }
        },
        complete: function () {
            RemoverLoad();
        }
    });
}

function AlterarUsuarioAJAX(formID) {

    if (NotificarCampos(formID)) {

        let tipo_usuario = $("#tipoUsuario").val();
        let id_usuario = $("#codUsuario").val();
        let id_endereco = $("#codEndereco").val();
        console.log({
            btnAlterar: 'ajx',
            tipo: tipo_usuario,
            nome: $("#nome").val(),
            email: $("#email").val(),
            cpf: $("#cpf").val(),
            telefone: $("#telefone").val(),
            rua: $("#rua").val(),
            bairro: $("#bairro").val(),
            cep: $("#cep").val(),
            cidade: $("#cidade").val(),
            estado: $("#estado").val(),
            nomeEmp: tipo_usuario == 3 ? $("#nomeEmp").val() : '',
            setor: tipo_usuario == 2 ? $("#setor").val() : '',
            codUsuario: id_usuario,
            codEndereco: id_endereco,
        });
        $.ajax({
            beforeSend: function () {
                Load();
            },
            type: "POST",
            url: BASE_URL_DATAVIEW("usuario_dataview"),
            data: {
                btnAlterar: 'ajx',
                tipo: tipo_usuario,
                nome: $("#nome").val(),
                email: $("#email").val(),
                cpf: $("#cpf").val(),
                telefone: $("#telefone").val(),
                rua: $("#rua").val(),
                bairro: $("#bairro").val(),
                cep: $("#cep").val(),
                cidade: $("#cidade").val(),
                estado: $("#estado").val(),
                nomeEmp: tipo_usuario == 3 ? $("#nomeEmp").val() : '',
                setor: tipo_usuario == 2 ? $("#setor").val() : '',
                codUsuario: id_usuario,
                codEndereco: id_endereco,
            },
            success: function (ret) {
                MostrarMensagem(ret);
                console.log({ ret });

                "<pre>array(15) {\n  [\"btnAlterar\"]=>\n  string(3) \"ajx\"\n  [\"tipo\"]=>\n  string(1) \"3\"\n  [\"nome\"]=>\n  string(4) \"Luiz\"\n  [\"email\"]=>\n  string(14) \"luiz@teste.com\"\n  [\"cpf\"]=>\n  string(14) \"147.152.656-84\"\n  [\"telefone\"]=>\n  string(10) \"4399999999\"\n  [\"rua\"]=>\n  string(16) \"Avenida Maringá\"\n  [\"bairro\"]=>\n  string(8) \"Vitória\"\n  [\"cep\"]=>\n  string(8) \"86060000\"\n  [\"cidade\"]=>\n  string(8) \"Londrina\"\n  [\"estado\"]=>\n  string(2) \"PR\"\n  [\"nomeEmp\"]=>\n  string(4) \"Luiz\"\n  [\"setor\"]=>\n  string(0) \"\"\n  [\"codUsuario\"]=>\n  string(1) \"6\"\n  [\"codEndereco\"]=>\n  string(1) \"6\"\n}\n</pre>"
                [[Prototype]]
:
                Object

                // RedirecionarPagina("consultar_usuario.php?filtro=" + $("#nome").val(),3)
            },
            complete: function () {
                RemoverLoad();
            }
        });
    }
}