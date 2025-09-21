<?php

    namespace Src\Controller;

    use Src\public\Util;
    use Src\Model\UsuarioMODEL;
    use Src\VO\UsuarioVO;

    class UsuarioCTRL{

        private $model;

        public function __construct(){
            $this->model = new UsuarioMODEL();
        }

    public function ValidarLoginCtrl(string $login, string $senha)
    {
        if (empty($login) || empty($senha)) {
            return 0;
        }

        $usuario = $this->model->ValidarLoginModel($login, SITUACAO_ATIVO);

        if (empty($usuario)) {
            return -10;
        }

        if (!Util::VerificarSenha($senha, $usuario['senha_usuario'])) {
            return -7;
        }

        $this->model->RegistrarLogAcesso(Util::DataHoraAtual(), $usuario['id']);
        Util::CriarSessao($usuario['id'], $usuario['nome_usuario']);
        Util::ChamarPagina('\src\view\admin\index');
    }

        public function VerificarEmailDuplicadoCTRL(string $email) : bool{
            return $this->model->VerificarEmailDuplicadoMODEL($email);
        }

        public function CadastrarUsuarioCTRL($vo): int{
            // Validação das propriedades comum entre todos os tipos de Usuários!
            if(
                empty($vo->getNome()) || empty($vo->getTipo()) || empty($vo->getEmail()) || 
                empty($vo->getCPF()) || empty($vo->getTelefone())
            ){
                return 0;
            }else{
                if((int)$vo->getTipo() == USUARIO_TECNICO && empty($vo->getNomeEmpresa())){
                    return 0;
                }

                if((int)$vo->getTipo() == USUARIO_FUNCIONARIO && empty($vo->getIdSetor())){
                    return 0;
                }

                // Setando as propriedades do Gravar Erro Log!
                $vo->setErroFuncao(CADASTRAR_USUARIO);
                $vo->setCodLogado(Util::UsuarioLogado());
                // Setando o Status do Usuário!
                $vo->setStatus(SITUACAO_ATIVO);
                // Setando a Senha Criptografada!
                $vo->setSenha(Util::CriptografarSenha($vo->getCPF()));

                return $this->model->CadastrarUsuarioMODEL($vo);
            }
        }

        public function FiltrarUsuarioCTRL($nome) : array{
            return $this->model->FiltrarUsuarioMODEL($nome);
        }

        public function AlterarStatusUsuarioCTRL(UsuarioVO $vo) : int{
            $vo->setErroFuncao(ALTERAR_STATUS_USUARIO);
            $vo->setStatus($vo->getStatus() == SITUACAO_ATIVO ? SITUACAO_INATIVO : SITUACAO_ATIVO);

            return $this->model->AlterarStatusUsuarioMODEL($vo);
        }

        public function DetalharUsuarioCTRL(int $id) : array | int{
            if($id == '' || $id <= 0){
                return 0;
            }else{
                return $this->model->DetalharUsuarioMODEL($id);
            }
        }

        public function AlterarUsuarioCTRL($vo) : int{
            if (
                empty($vo->getNome()) || empty($vo->getEmail()) ||
                empty($vo->getCPF()) || empty($vo->getTelefone()) || empty($vo->getRua()) ||
                empty($vo->getBairro()) || empty($vo->getCEP()) || empty($vo->getCidade()) ||
                empty($vo->getEstado())
            ) {
                return 0;
            }else{
                 if((int)$vo->getTipo() == USUARIO_TECNICO && empty($vo->getNomeEmpresa())){
                    return 0;
                }

                $vo->setErroFuncao(ALTERAR_USUARIO);
                $vo->setCodLogado(Util::UsuarioLogado());
                $vo->setSenha(Util::CriptografarSenha($vo->getCPF()));

                return $this->model->AlterarUsuarioMODEL($vo);
            }
        }
    }