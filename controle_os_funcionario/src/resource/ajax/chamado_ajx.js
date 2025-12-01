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

    if (!response.ok) throw new Error(MSG_ERRO_CALL_API);

    const objDados = await response.json();
    const equipamentos = objDados.result;
    if (objDados.result == NAO_AUTORIZADO) {
      Sair();
      return;
    }

    const combo_equipamento = document.getElementById("equipamento");
    combo_equipamento.innerHTML = "<option value =''>Selecione </option>";

    equipamentos.forEach((item) => {
      const opt = document.createElement("option");
      opt.value = item.alocar_id;
      opt.text =
        item.nome_tipo +
        " / " +
        item.nome_modelo +
        " / Identificação: " +
        item.identificacao;
    });
  } catch (error) {
    MensagemCustomizada(error.message, COR_MSG_ERRO);
  } finally {
    RemoverLoad();
  }
}
async function AbrirChamadoAJAX(formID) {
  if (awaitNotificarCamposAsync(formID)) {
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
      if (objDados.result == NAO_AUTORIZADO) {
        Sair();
        return;
      }

      if (objDados.result == 1) {
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
    console.log(chamados);
    const chamados = objDados.result;
    if (objDados.result == NAO_AUTORIZADO) {
      Sair();
      return;
    }
    if (chamados.length === 0) {
      Mensagem(MSG_DADOS_NAO_ENCONTRADOS, COR_MSG_INFO);
      return;
    }

    const tab_result = document.getElementById("table_result");
    let tab_content = `<thead>
                                <tr>
                                    <th></th>
                                    <th>Data Abertura</th>
                                    <th>Funcionário</th>
                                    <th>Equipamento</th>
                                    <th>Problema</th>
                                </tr>
                            </thead>
                            <tbody>`;
    let data_tr = "";
    chamados.forEach((item) => {
      situacao = VerSituacao(item.data_atendimento, item.data_encerramento);
      data_tr += ` <tr>
                    <td>`;
      data_tr += `<a href="#" onclick="DetalharChamadoAJAX(${item.chamado_id})" class+"btn btn-warnig btn-sm" data-toggle="modal" data-target="#modal-datelhes"></a>`;

      data_tr += `<td/>
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
    tab_result.innerHTML = teb_content;
    MostrarElemento("resultado", true);
  } catch (error) {
    MensagemCustomizada(error.message, COR_MSG_ERRO);
  } finally {
    RemoverLoad();
  }
}
