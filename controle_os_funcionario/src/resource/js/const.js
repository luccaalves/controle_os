//#region VALORES FIXOS DA REGRA
    const TAMANHO_SENHA_PERMITIDA = 6;
//#endregion

//#region MENSAGENS DO AMBIENTE
const MSG_ERRO_CALL_API = "Erro ao chamar a API!";
const MSG_ERRO_SENHA_INCORRETA = "Senha incorreta!";
const MSG_SUCESSO = "Ação realizada com sucesso!";
const MSG_ERRO = "Houve um erro na operação!";
const MSG_CAMPOS_VAZIOS = "Preencher os campos obrigatórios!";
const MSG_SENHA_MENOR = `Preencher a senha com no mínimo ${TAMANHO_SENHA_PERMITIDA} caracteres!`;
const MSG_SENHA_REPETIR = "As senhas digitadas devem ser iguais!";
const MSG_DADOS_NAO_ENCONTRADOS = "Resultado não encontrado!";
const MSG_USUARIO_NAO_ENCONTRADO = "Usuário não encontrado! Tente novamente!"

const COR_MSG_INFO = "2";
const COR_MSG_SUCESSO = "1";
const COR_MSG_ATENCAO = "0";
const COR_MSG_ERRO = "-1";
const NAO_AUTORIZADO = -1000;
//#endregion

//#region ENDPOINTS
const API_DETALHAR_USUARIO = 'DetalharUsuarioAPI';
const API_GRAVAR_MEUS_DADOS = 'AlterarMeusDadosAPI';
const API_VERIFICAR_SENHA_ATUAL = 'VerificarSenhaAPI';
const API_ALTERAR_SENHA_ATUAL = 'AlterarSenhaAPI';
const API_LISTAR_EQUIPAMENTO_SETOR = 'ListarEquipamentoAlocadoSetorAPI';
const API_ABRIR_CHAMADO = 'AbrirChamadoAPI';
const API_FILTRAR_CHAMADO = 'FiltrarChamadoAPI';
const API_DETALHAR_CHAMADO = 'DetalharChamadoAPI';
const API_ACESSAR = "ValidarLoginAPI";
//#endregion