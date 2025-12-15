async function CarregarEquipamentosSetorAJAX() {
  const dadosEnviar = {
    endpoint: API_LISTAR_EQUIPAMENTO_SETOR,
    setor_id: CodigoSetorLogado(),
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
    const equipamentos = objDados.result;

    if (equipamentos === NAO_AUTORIZADO) {
      Sair();
      return;
    }

    const comboEquipamento = document.getElementById("equipamento");
    comboEquipamento.innerHTML = "<option value=''>Selecione</option>";

    equipamentos.forEach((item) => {
      const opt = document.createElement("option");
      opt.value = item.alocar_id;
      opt.textContent = `${item.nome_tipo} / ${item.nome_modelo} / Identificação: ${item.identificacao}`;
      comboEquipamento.appendChild(opt);
    });
  } catch (error) {
    MensagemCustomizada(error.message, COR_MSG_ERRO);
  } finally {
    RemoverLoad();
  }
}
async function AbrirChamadoAJAX(formID) {
  if (await NotificarCamposAsync(formID)) {
    const dadosEnviar = {
      endpoint: API_ABRIR_CHAMADO,
      alocar_id: PegarValor("equipamento"),
      func_id: UsuarioLogado(),
      problema: PegarValor("problema"),
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

      if (objDados.result === NAO_AUTORIZADO) {
        Sair();
        return;
      }

      if (objDados.result === 1) {
        MensagemCustomizada(MSG_SUCESSO, COR_MSG_SUCESSO);
        await LimparNotificacoesAsync(formID);
        await CarregarEquipamentosSetorAJAX();
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
        BODY: json.stringify(dadosEnviar),
      });
      if (!response.ok) throw new Error(MSG_ERRO_CALL_API);

      const objDados = await response.json();
      const chamado = objDados.result;
      if (objDados.result == NAO_AUTORIZADO) {
        Sair();
        return;
      }

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
      // SetarCampoValor("id_chamado", chamado.id_chamado);
      SetarCampoValor("tec_iniciou", chamado.tecnico_atendimento);
      SetarCampoValor("data_iniciou", chamado.data_atendimento);
      // SetarCampoValor("id_alocar", chamado.alocar_id);
      SetarCampoValor("data_finalizou", chamado.data_encerramento);
      SetarCampoValor("tec_finalizou", chamado.tecnico_finalizado);
      SetarCampoValor("laudo", chamado.laudo);
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
    setor_id: CodigoSetorLogado(),
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
                                    <th>Funcionário</th>
                                    <th>Situação</th>
                                    <th>Equipamento</th>
                                    <th>Problema</th>
                                </tr>
                            </thead><tbody>`;
    let data_tr = "";
    chamados.forEach((item) => {
      const situacao = VerSituacao(item.data_atendimento, item.data_encerramento);
      data_tr += ` <tr>
                        <td>${item.tecnico_atendimento !== null ? `<a href="#" data-toggle="modal" onclick="DetalharChamado(${item.id_chamado})" data-target="#modal-chamados" class="btn btn-warning btn-xs">Ver detalhes</a>` : ""}</td>
                        <td>${item.data_abertura}</td>
                        <td>${item.funcionario}</td>
                        <td>${situacao}</td>
                        <td>${item.nome_tipo} / ${item.nome_modelo} / ${item.identificacao}</td>
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
function VerSituacao(data_atendimento, data_encerramento) {
  if (data_atendimento === null) {
    return AGUARDANDO_ATENDIMENTO;
  } else if (data_encerramento !== null) {
    return ATENDIMENTO_ENCERRADO;
  } else if (data_atendimento !== null && data_encerramento === null) {
    return EM_ATENDIMENTO;
  }
}
