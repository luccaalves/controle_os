function MostrarMensagem(ret) {
  if (ret == 2) {
    toastr.info("Nenhum resultado encontrado!");
  } else if (ret == 1) {
    toastr.success("Ação realizada com sucesso!");
  } else if (ret == 0) {
    toastr.warning("Preencher os campos obrigatórios!");
  } else if (ret == -1) {
    toastr.error("Houve um erro na operação! Tente nvamente mais tarde");
  } else if (ret == -2) {
    toastr.error("CEP não encontrado!");
  } else if (ret == -3) {
    toastr.error("Formato de CEP inválido!");
  } else if (ret == -4) {
    toastr.error("CPF inválido!");
  } else if (ret == -5) {
    toastr.error("E-MAIL inválido!");
  } else if (ret == -6) {
    toastr.error("Esse E-MAIL já é cadastrado!");
  } else if (ret == -7) {
    toastr.error("Usuário não encontrado!");
  } else if (ret == -8) {
    toastr.info("CPF já cadastrado.");
  } else if (ret == -10) {
    toastr.info("!");
  }
}
