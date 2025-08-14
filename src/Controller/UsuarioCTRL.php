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

        public function ValidarLoginCTRL(string $login, string $senha) : int{
            if(empty($login) || empty($senha)){
                return 0;
            }else{
                $usuario = $this->model->ValidarLoginMODEL($login, SITUACAO_ATIVO);

                // Caso o Login não seja encontrado!
                if(empty($usuario)){
                    return -7;
                }

                if(!Util::VerificarSenha($senha, $usuario['cpf_usuario'])){
                    return -7;
                }

                Util::CriarSessao($usuario['id'], $usuario['nome_usuario']);

                Util::ChamarPagina('inicial_adm');
            }
        }

        public function VerificarEmailDuplicadoCTRL(string $email) : bool{
            return $this->model->VerificarEmailDuplicadoMODEL($email);
        }

        public function CadastrarUsuarioCTRL($vo){
            // Validação das propriedades comum entre todos os tipos de Usuários!
            if(
                empty($vo->getNome()) || empty($vo->getTipo()) || empty($vo->getEmail()) || 
                empty($vo->getCPF()) || empty($vo->getTelefone()) || empty($vo->getRua()) || 
                empty($vo->getBairro()) || empty($vo->getCEP()) || empty($vo->getCidade()) || 
                empty($vo->getEstado())
            ){
                return 0;
            }else{
                if((int)$vo->getTipo() == USUARIO_TECNICO && empty($vo->getNomeEmpresa())){
                    return 0;
                }

                if((int)$vo->getTipo() == USUARIO_FUNCIONARIO && empty($vo->getIdSetor())){
                    return 0;
                }

                // Setando o Status do Usuário!
                $vo->setStatus(SITUACAO_ATIVO);

                // Setando a Senha Criptografada!
                $vo->setSenha(Util::CriptografarSenha($vo->getCPF()));

                // Setando as propriedades do Gravar Erro Log!
                $vo->setFuncaoErro(CADASTRAR_USUARIO);
                $vo->setCodLogado(Util::UsuarioLogado());

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
                empty($vo->getCPF()) || empty($vo->getTele()) || empty($vo->getRua()) ||
                empty($vo->getBairro()) || empty($vo->getCEP()) || empty($vo->getCidade()) ||
                empty($vo->getEstado())
            ) {
                return 0;
            }else{
                 if((int)$vo->getTipo() == USUARIO_TECNICO && empty($vo->getNomeEmpresa())){
                    return 0;
                }

                $vo->setSenha(Util::CriptografarSenha($vo->getCPF()));

                $vo->setFuncaoErro(ALTERAR_USUARIO);
                $vo->setCodLogado(Util::UsuarioLogado());

                return $this->model->AlterarUsuarioMODEL($vo);
            }
        }
    }