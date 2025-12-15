async function DetalharChamadoAJAX(id_chamado) {
  if (id_chamado != "") {
    const dadosEnviar = {
      endpoint: API_DETALHAR_CHAMADO,
      id: id_chamado,
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
      const chamado = objDados.result;

      SetarCampoValor(
        "equipamento",
        chamado.nome_tipo +
          " / " +
          chamado.nome_modelo +
          " / " +
          chamado.identificacao
      );
      SetarCampoValor("data_abertura", chamado.data_abertura);
      SetarCampoValor("problema", chamado.problema);
      SetarCampoValor("id_chamado", chamado.id_chamado);
      SetarCampoValor("tec_iniciou", chamado.tecnico_atendimento);
      SetarCampoValor("data_iniciou", chamado.data_atendimento);
      SetarCampoValor("id_alocar", chamado.alocar_id);
      SetarCampoValor("data_finalizou", chamado.data_encerramento);
      SetarCampoValor("tec_finalizou", chamado.tecnico_finalizado);
      SetarCampoValor("laudo", chamado.laudo);

      const situacao_atual = VerSituacao(
        chamado.data_atendimento,
        chamado.data_encerramento
      );
      switch (situacao_atual) {
        case SITUACAO_AGUARDANDO:
          MostrarElemento("tecAtendimento", false);
          MostrarElemento("tecEncerramento", false);
          MostrarElemento("btn_acao", true);
          MostrarElemento("btn_finalizar", false);
          break;

        case SITUACAO_EM_ATENDIMENTO:
          MostrarElemento("tecAtendimento", true);
          MostrarElemento("tecEncerramento", false);
          MostrarElemento("btn_acao", false);
          MostrarElemento("btn_finalizar", true);
          break;

        case SITUACAO_ENCERRADO:
          MostrarElemento("tecAtendimento", true);
          MostrarElemento("tecEncerramento", true);
          MostrarElemento("btn_acao", false);
          MostrarElemento("btn_finalizar", false);
          HabilitarCampo("laudo", false);
          break;

        default:
          break;
      }
    } catch (error) {
      MensagemCustomizada(error.message, COR_MSG_ERRO);
    } finally {
      RemoverLoad();
    }
  }
}
async function FiltrarChamadoAJAX() {
  MostrarElemento("resultado", false);

  const dadosEnviar = {
    endpoint: API_FILTRAR_CHAMADO,
    situacao: PegarValor("situacao"),
  };

  try {
    Load();
    const response = await fetch(BASE_URL_API(), {
      method: "POST",
      headers: HEADER_COM_AUTENTICACAO(),
      body: JSON.stringify(dadosEnviar),
    });

    if (!response.ok) {
      throw new Error(MSG_ERRO_CALL_API);
    }

    const objDados = await response.json();
    const chamados = objDados.result;

    if (objDados.result === NAO_AUTORIZADO) {
      Sair();
      return;
    }
    if (chamados.length === 0) {
      MensagemCustomizada(MSG_DADOS_NAO_ENCONTRADOS, COR_MSG_INFO);
      return;
    }

    const tab_result = document.getElementById("table_result");
    let tab_content = `<thead>
                            <tr>
                                <th></th>
                                <th>Data Abertura</th>
                                <th>Situação</th>
                                <th>Funcionário</th>
                                <th>Equipamento</th>
                                <th>Problema</th>
                            </tr>
                        </thead>
                        <tbody>`;
    let data_tr = "";

    chamados.forEach((item) => {
      const situacao = VerSituacao(
        item.data_atendimento,
        item.data_encerramento
      );
      data_tr += ` <tr>
                        <td><a href="#" onclick="DetalharChamadoAJAX(${
                          item.chamado_id
                        })" data-toggle="modal" data-target="#modal-chamados">Ver Detalhes</a></td>
                        <td>${item.data_abertura}</td>
                        <td>${item.funcionario}</td>
                        <td>${situacao}</td>
                        <td>${
                          item.nome_tipo +
                          " / " +
                          item.nome_modelo +
                          " / " +
                          item.identificacao
                        }</td>
                        <td>${item.problema}</td>
                    </tr>`;
    });

    tab_content += data_tr;
    tab_content += "</tbody>";
    tab_result.innerHTML = tab_content;
    MostrarElemento("resultado", true);
  } catch (error) {
    MensagemCustomizada(error.message, COR_MSG_ERRO);
  } finally {
    RemoverLoad();
  }
}
async function AtenderChamadoAJAX() {
  try {
    Load();
    const id_chamado = PegarValor("id_chamado");
    const dadosEnviar = {
      id_tec: UsuarioLogado(),
      id_chamado: id_chamado,
      endpoint: API_ATENDER_CHAMADO,
    };

    const response = await fetch(BASE_URL_API(), {
      method: "POST",
      headers: HEADER_COM_AUTENTICACAO(),
      body: JSON.stringify(dadosEnviar),
    });

    if (!response.ok) {
      throw new Error(MSG_ERRO_CALL_API);
    }

    const objDados = await response.json();

    if (objDados.result == NAO_AUTORIZADO) {
      Sair();
      return;
    }

    if (objDados.result == 1) {
      MensagemCustomizada(MSG_SUCESSO, COR_MSG_SUCESSO);
      FecharModal("modal-detalhes");
      FiltrarChamadoAJAX();
    } else {
      MensagemCustomizada(MSG_ERRO, COR_MSG_ERRO);
    }
  } catch (error) {
    MensagemCustomizada(error.message, COR_MSG_ERRO);
  } finally {
    RemoverLoad();
  }
}
async function FinalizarChamadoAJAX(formID) {
  if (await NotificarCamposAsync(formID)) {
    try {
      Load();
      const id_chamado_form = PegarValor("id_chamado");
      const laudo_form = PegarValor("laudo");
      const id_alocar_form = PegarValor("id_alocar");

      const dadosEnviar = {
        id_tec: UsuarioLogado(),
        id_chamado: id_chamado_form,
        laudo: laudo_form,
        id_alocar: id_alocar_form,
        endpoint: API_FINALIZAR_CHAMADO,
      };
      const response = await fetch(BASE_URL_API(), {
        method: "POST",
        headers: HEADER_COM_AUTENTICACAO(),
        body: JSON.stringify(dadosEnviar),
      });
      if (!response.ok) {
        throw new Error(MSG_ERRO_CALL_API);
      }

      const objDados = await response.json();
      if (objDados.result == NAO_AUTORIZADO) {
        Sair();
        return;
      }
      if (objDados.result == 1) {
        MensagemCustomizada(MSG_SUCESSO, COR_MSG_SUCESSO);
        FecharModal("modal-detalhes");
        FiltrarChamadoAJAX();
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
function VerSituacao(data_atendimento, data_encerramento) {
  let situacao = "";

  if (data_atendimento == null) {
    situacao = SITUACAO_AGUARDANDO;
  } else if (data_encerramento != null) {
    situacao = SITUACAO_ENCERRADO;
  } else if (data_atendimento != null && data_encerramento == null) {
    situacao = SITUACAO_EM_ATENDIMENTO;
  }

  return situacao;
}
