async function GravarMeusDadosApi(formID) {
  if (NotificarCampos(formID)) {
    const dados = {
      id_usuario: UsuarioLogado(),
      endpoint: API_GRAVAR_MEUS_DADOS,
      empresa: PegarValor("nome_empresa"),
      nome: PegarValor("nome"),
      email: PegarValor("email"),
      cpf: PegarValor("cpf"),
      telefone: PegarValor("telefone"),
      id_endereco: PegarValor("id"),
      rua: PegarValor("rua"),
      bairro: PegarValor("bairro"),
      cep: PegarValor("cep"),
      cidade: PegarValor("cidade"),
      estado: PegarValor("estado"),
      tipo_usuario: PegarValor("tipo_usuario"),
    };

    try {
      Load();

      const response = await fetch(BASE_URL_API(), {
        method: "POST",
        headers: HEADER_COM_AUTENTICACAO(),
        body: JSON.stringify(dados),
      });

      if (!response.ok) {
        throw new Error(MSG_ERRO_CALL_API);
      }

      const objDados = await response.json();
      if (objDados.result == NAO_AUTORIZADO) {
        Sair();
        return;
      }
      MostrarMensagem(objDados.result);
    } catch (error) {
      MensagemCustomizada(error.message, COR_MSG_ERRO);
    } finally {
      RemoverLoad();
    }
  }
}
async function DetalharMeusDados() {
  try {
    const dados = {
      id_user: UsuarioLogado(),
      endpoint: API_DETALHAR_USUARIO,
    };

    Load();
    const response = await fetch(BASE_URL_API(), {
      method: "POST",
      headers: HEADER_COM_AUTENTICACAO(),
      body: JSON.stringify(dados),
    });

    if (!response.ok) {
      throw new Error(MSG_ERRO_CALL_API);
    }

    const objDados = await response.json();
    if (objDados.result == NAO_AUTORIZADO) {
      Sair();
      return;
    }
    const dadosUser = objDados.result;

    SetarCampoValor("nome", dadosUser.nome_usuario);
    SetarCampoValor("telefone", dadosUser.tel_usuario);
    SetarCampoValor("cpf", dadosUser.cpf_usuario);
    SetarCampoValor("email", dadosUser.email_usuario);
    SetarCampoValor("rua", dadosUser.rua);
    SetarCampoValor("bairro", dadosUser.bairro);
    SetarCampoValor("cep", dadosUser.cep);
    SetarCampoValor("estado", dadosUser.sigla_estado);
    SetarCampoValor("cidade", dadosUser.nome_cidade);
    SetarCampoValor("empresa", dadosUser.nome_empresa);
    SetarCampoValor("id_endereco", dadosUser.id_endereco);
    SetarCampoValor("tipo_usuario", dadosUser.tipo_usuario);
  } catch (error) {
    MensagemCustomizada(error.message, COR_MSG_ERRO);
  } finally {
    RemoverLoad();
  }
}
async function VerificarSenhaAtual(formID, formID2) {
  if (NotificarCamposAsync(formID)) {
    try {
      const dados = {
        endpoint: API_VERIFICAR_SENHA_ATUAL,
        id_user: UsuarioLogado(),
        senha_digitada: PegarValor("senha"),
      };

      Load();

      const response = await fetch(BASE_URL_API(), {
        method: "post",
        headers: HEADER_COM_AUTENTICACAO(),
        body: JSON.stringify(dados),
      });

      if (!response.ok) throw new Error(MSG_ERRO_CALL_API);

      const objDados = await response.json();
      if (objDados.result == NAO_AUTORIZADO) {
        Sair();
        return;
      }

      if (objDados.result == 1) {
        document.getElementById(formID).classList.add("d-none");
        document.getElementById(formID2).classList.remove("d-none");
        MensagemCustomizada(MSG_SUCESSO, COR_MSG_SUCESSO);
      } else if (objDados.result === -1) {
        MensagemCustomizada(MSG_ERRO_SENHA_INCORRETA, COR_MSG_ERRO);
      }
    } catch (error) {
      MensagemCustomizada(error.message, COR_MSG_ERRO);
    } finally {
      RemoverLoad();
    }
  }
}
async function MudarSenha(formID, formID2) {
  if (await NotificarCamposAsync(formID)) {
    const nova_senha = PegarValor("nova_senha");
    const rep_senha = PegarValor("rep_senha");

    if (nova_senha.lenght < TAMANHO_SENHA_PERMITIDA) {
      MensagemCustomizada(MSG_SENHA_MENOR, COR_MSG_ATENCAO);
    } else if (nova_senha !== rep_senha) {
      MensagemCustomizada(MSG_SENHA_REPETIR, COR_MSG_ATENCAO);
    } else {
      const dadosEnviar = {
        endpoint: API_ALTERAR_SENHA_ATUAL,
        nova_senha: PegarValor("nova_senha"),
        cod_usuario: UsuarioLogado(),
      };
      try {
        Load();

        const response = await fetch(BASE_URL_API(), {
          method: "POST",
          headers: HEADER_COM_AUTENTICACAO(),
          body: JSON.stringify(dadosEnviar),
        });

        if (!response.ok) throw new Error(MSG_ERRO_CALL_API);

        const objDados = await response.json();
        if (objDados.result == NAO_AUTORIZADO) {
          Sair();
          return;
        }
        if (objDados.result == 1) {
          MensagemCustomizada(MSG_SUCESSO, COR_MSG_SUCESSO);
          await LimparNotificacoesAsync(formID);
          await LimparNotificacoesAsync(formID2);
          MostrarElemento(formID2, true);
          MostrarElemento(formID, false);

          // document.getElementById(formID2).classList.remove("d-none");
          // document.getElementById(formID).classList.add("d-none");
        } else {
          MensagemCustomizada(MSG_ERRO, COR_MSG_ERRO);
        }
      } catch (error) {
        MensagemCustomizada(error.message, COR_MSG_ERRO);
      } finally {
        RemoverLoad();
      }
    }
  }
}
async function Acessar(formID) {
  if (await NotificarCamposAsync(formID)) {
    const login = PegarValor("login_usuario");
    const senha = PegarValor("senha_usuario");

    const dadosEnviar = {
      endpoint: API_ACESSAR,
      login: login,
      senha: senha,
    };
    try {
      Load();

      const response = await fetch(BASE_URL_API(), {
        method: "POST",
        headers: HEADER_COM_AUTENTICACAO(),
        body: JSON.stringify(dadosEnviar),
      });

      if (!response.ok) throw new Error(MSG_ERRO_CALL_API);

      const objDados = await response.json();

      if (objDados.result == -7) {
        MensagemCustomizada(MSG_USUARIO_NAO_ENCONTRADO, COR_MSG_INFO);
        return;
      }
      AddTnk(objDados.result);
      const objDadosToken = GetTnkValue();
      setNomeLogado(objDadosToken.nome);
      RedirecionarPagina("tecnico/meus_dados");
    } catch (error) {
      MensagemCustomizada(error.message, COR_MSG_ERRO);
    } finally {
      RemoverLoad();
    }
  }
}
