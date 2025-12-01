<?php
// Variavel constante do PHP, para manter um valor fixo sempre (Padrão de Navegação do Ambiente da Aplicação)!
// Vai ser um apontamento raiz de caminho para todas as paginas deste projeto!

    define('PATH', $_SERVER['DOCUMENT_ROOT'] . '/controle_os_admin/src/');


// $_SERVER['DOCUMENT_ROOT'] traz o caminho raiz de todo meu projeto!
// echo $_SERVER['DOCUMENT_ROOT'];  

//GERENCIAR DADOS DO USUÁRIO.
const USUARIO_ADM = 1;
const USUARIO_FUNCIONARIO = 2;
const USUARIO_TECNICO = 3;

const CADASTRAR_USUARIO = "CadastrarUsuario";
const ALTERAR_USUARIO = "AlterarUsuario";
const ALTERAR_STATUS_USUARIO = "AlterarStatusUsuario";
const ALTERAR_SENHA_USUARIO = "AlterarSenhaUsuario";


//FUNÇÕES DO MODULO TIPO DO EQUIPAMENTO.
const CADASTRAR_TIPO_EQUIPAMENTO = "CadastrarTipoEquipamento";
const ALTERAR_TIPO_EQUIPAMENTO = "AlterarTipoEquipamento";
const EXCLUIR_TIPO_EQUIPAMENTO = "ExcluirTipoEquipamento";

//FUNÇÕES DO MODULO MODELO DO EQUIPAMENTO.
const CADASTRAR_MODELO_EQUIPAMENTO = "CadastrarModeloEquipamento";
const ALTERAR_MODELO_EQUIPAMENTO = "AlterarModeloEquipamento";
const EXCLUIR_MODELO_EQUIPAMENTO = "ExcluirModeloEquipamento";

//FUNÇÕES DO MODULO SETOR DO USUARIO.
const CADASTRAR_SETOR_USUARIO = "CadastrarSetorUsuario";
const ALTERAR_SETOR_USUARIO = "AlterarSetorUsuario";
const EXCLUIR_SETOR_USUARIO = "ExcluirSetorUsuario";

//FUNÇÕES DO MODULO CADASTRAR EQUIPAMENTO.
const CADASTRAR_EQUIPAMENTO = "CadastrarEquipamento";
const ALTERAR_EQUIPAMENTO = "AlterarEquipamento";
const EXCLUIR_EQUIPAMENTO = "ExcluirEquipamento";
const DESCARTE_EQUIPAMENTO = "DescartarEquipamento";
const ALOCAR_EQUIPAMENTO = "AlocarEquipamento";
const REMOVER_ALOCAR_EQUIPAMENTO = "RemoverEquipamentoSetor";

//SITUAÇÃO
const SITUACAO_ATIVO = 1;
const SITUACAO_INATIVO = 0;
const SITUACAO_DESCARTADO = 0;

//FLAG DE COMUNICAÇÃO
const SITUACAO_EQUIPAMENTO_ALOCADO = 1;
const SITUACAO_EQUIPAMENTO_REMOVIDO = 2;
const SITUACAO_EQUIPAMENTO_MANUTENCAO = 3;

//CHAMADO
const ABRIR_CHAMADO = "AbrirChamado";
const ATENDER_CHAMADO = "AtenderChamado";
const FINALIZAR_CHAMADO = "FinalizarChamado";

//FLAG SITUAÇÃO CHAMADO
const SITUACAO_CHAMADO_AGUARDANDO_ATENDIMENTO = 1;
const SITUACAO_CHAMADO_EM_ATENDIMENTO = 2;
const SITUACAO_CHAMADO_FINALIZADO = 3;

//ESTADO DE TELA
const ESTADO_TELA_CADASTRAR = "Cadastrar";
const ESTADO_TELA_ALTERAR = "Alterar";

const SECRET = "avancado2025";
const NAO_AUTORIZADO = -1000;