//#region FUNÇÕES DA API
function BASE_URL_API() {
    return "http://controle_os.test/controle_os_admin/src/resource/api/funcionario_api.php";
}
function HEADER_SEM_AUTENTICACAO() {
  const header = {
    "Content-Type": "application/json",
  };
  return header;
}
function HEADER_COM_AUTENTICACAO() {
  const header = {
    "Content-Type": "application/json",
    Authorization: "Bearer " + GetTnk(),
  };
  return header;
}
function UsuarioLogado() {
  const dados = GetTnkValue();
  return dados.cod_user;
}
function CodigoSetorLogado() {
  const dados = GetTnkValue();
  return dados.cod_setor;
}
//#endregion
//#region FUNÇÕES GENERICAS FORMULARIO
function BASE_URL_INTRANET() {
  return "http://controle_os.test/controle_os_funcionario/src/view/";
}
function RedirecionarPagina(page, segundos) {
  setTimeout(() => {
    window.location = BASE_URL_INTRANET() + page + ".php";
  }, segundos * 1000);
}
function MostrarElemento(id, mostrar) {
  if (mostrar) {
    document.getElementById(id).classList.remove("d-none");
  } else {
    document.getElementById(id).classList.add("d-none");
  }
}
function NotificarCampos(formID) {
  let ret = true;
  document
    .querySelectorAll(
      `#${formID} input, #${formID} textarea, #${formID} select`
    )
    .forEach((elemento) => {
      if (elemento.classList.contains("obg")) {
        if (elemento.value.trim() === "") {
          ret = false;
          elemento.classList.add("is-invalid");
          elemento.classList.remove("is-valid");
        } else {
          elemento.classList.remove("is-invalid");
          elemento.classList.add("is-valid");
        }
      }
    });

  if (!ret) {
    MostrarMensagem(MSG_CAMPO_VAZIO, COR_MSG_ATENCAO);
  }
  return ret;
}
async function NotificarCamposAsync(formID) {
  let ret = true;
  document
    .querySelectorAll(
      `#${formID} input, #${formID} textarea, #${formID} select`
    )
    .forEach((elemento) => {
      if (elemento.classList.contains("obg")) {
        if (elemento.value.trim() === "") {
          ret = false;
          elemento.classList.add("is-invalid");
          elemento.classList.remove("is-valid");
        } else {
          elemento.classList.remove("is-invalid");
          elemento.classList.add("is-valid");
        }
      }
    });

  if (!ret) {
    MensagemCustomizada(MSG_CAMPOS_VAZIOS, COR_MSG_ATENCAO);
  }
  return ret;
}
async function LimparNotificacoesAsync(formID) {
  document
    .querySelectorAll(
      `#${formID} input, #${formID} textarea, #${formID} select`
    )
    .forEach((elemento) => {
      elemento.value = "";
      elemento.classList.remove("is-invalid");
      elemento.classList.remove("is-valid");
    });
}
function LimparNotificacoes(formID) {
  document
    .querySelectorAll(
      `#${formID} input, #${formID} textarea, #${formID} select`
    )
    .forEach((elemento) => {
      elemento.value = "";
      elemento.classList.remove("is-invalid");
      elemento.classList.remove("is-valid");
    });
}
function FecharModal(nome_modal) {
  $("#" + nome_modal).modal("hide");
}
function Load() {
  $(".loader").addClass("is-active");
}
function RemoverLoad() {
  $(".loader").removeClass("is-active");
}
function SetarCampoValor(id, value) {
  document.getElementById(id).value = value;
}
function PegarValor(id_usuario) {
  return document.getElementById(id_usuario).value;
}

//#endregion
//#region Funções JWT
function AddTnk(t) {
  localStorage.setItem("user_tnk", t);
}
function GetTnkValue() {
  var token = GetTnk();
  var base64Url = token.split(".")[1];
  var base64 = base64Url.replace(/-/g, "+").replace(/_/g, "/");
  var j = decodeURIComponent(
    window
      .atob(base64)
      .split("")
      .map(function (c) {
        return "%" + ("00" + c.charCodeAt(0).toString(16)).slice(-2);
      })
      .join("")
  );
  return JSON.parse(j);
}
function GetTnk() {
  if (localStorage.getItem("user_tnk") != null) {
    return localStorage.getItem("user_tnk");
  }
}
function setNomeLogado(nome) {
  localStorage.setItem("nome_logado", nome);
}
function getNomeLogado() {
  return localStorage.getItem("nome_logado");
}
function MostrarNomeLogin() {
  if (localStorage.getItem("nome_logado") != null) {
    document.getElementById("nome_logado").innerHTML = getNomeLogado();
  }
}
function ClearTnk() {
  localStorage.clear();
}
function Sair() {
  ClearTnk();
  RedirecionarPagina("acesso/login");
}
function Verify() {
  if (localStorage.getItem("user_tnk") === null)
     Sair();
}
//#endregion
