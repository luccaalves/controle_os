<?php

namespace Src\Model;

use Src\Model\Conexao;
use Src\Model\SQL\USUARIO_SQL;
use Src\VO\UsuarioVO;
use Exception;

class UsuarioMODEL extends Conexao
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = parent::retornarConexao();
    }

    public function VerificarEmailDuplicadoMODEL($email): bool
    {
        $sql = $this->conexao->prepare(USUARIO_SQL::VERIFICAR_EMAIL_SQL());

        $sql->bindValue(1, $email);

        $sql->execute();

        $verEmail = $sql->fetchAll(\PDO::FETCH_ASSOC);

        return $verEmail[0]['contar_email'] == 0 ? false : true;
    }

    public function CadastrarUsuarioMODEL($vo)
    {
        $sql = $this->conexao->prepare(USUARIO_SQL::CADASTRAR_USUARIO_SQL());

        $i = 1;

        $sql->bindValue($i++, $vo->getTipo());
        $sql->bindValue($i++, $vo->getNome());
        $sql->bindValue($i++, $vo->getEmail());
        $sql->bindValue($i++, $vo->getCPF());
        $sql->bindValue($i++, $vo->getStatus());
        $sql->bindValue($i++, $vo->getTelefone());

        try {
            //Monitora toda tentativa de execução desse algoritimo, caso de erro, volta tudo como estava anteriormente!
            $this->conexao->beginTransaction();

            //Cadastra na Tabela Usuário!
            $sql->execute();

            //Vai recuperar o ID do usuário cadastrado, e tipar o perfil!
            $idUser = $this->conexao->lastInsertId();

            switch ($vo->getTipo()) {
                case USUARIO_FUNCIONARIO:
                    $sql = $this->conexao->prepare(USUARIO_SQL::CADASTRAR_FUNCIONARIO_SQL());

                    $i = 1;

                    $sql->bindValue($i++, $idUser);
                    $sql->bindValue($i++, $vo->getIdSetor());

                    //Cadastra o Tipo na Tabela Funcionário!
                    $sql->execute();

                    break;

                case USUARIO_TECNICO:
                    $sql = $this->conexao->prepare(USUARIO_SQL::CADASTRAR_TECNICO_SQL());

                    $i = 1;

                    $sql->bindValue($i++, $idUser);
                    $sql->bindValue($i++, $vo->getNomeEmpresa());

                    //Cadastra o Tipo na Tabela Técnico!
                    $sql->execute();

                    break;
            }

            //Processo que vai Cadastrar o Endereço!
            //1º Passo: Vamos Verificar se a Cidade já está Cadastrada!

            $sql = $this->conexao->prepare(USUARIO_SQL::VERIFICAR_CIDADE_CADASTRADA_SQL());

            $sql->bindValue(1, $vo->getCidade());
            $sql->bindValue(2, $vo->getEstado());

            $sql->execute();

            $temCidade = $sql->fetchAll(\PDO::FETCH_ASSOC);

            $idCidade = 0;

            //Vamos Verificar se Encontrou a Cidade!
            if (count($temCidade) > 0) {
                $idCidade = $temCidade[0]['id'];
            } else {
                $idEstado = 0;

                //2º Passo: Verificar se já Existe o Estado Cadastrado!
                $sql = $this->conexao->prepare(USUARIO_SQL::VERIFICAR_ESTADO_CADASTRADO_SQL());

                $sql->bindValue(1, $vo->getEstado());

                $sql->execute();
                $temEstado = $sql->fetchAll(\PDO::FETCH_ASSOC);

                //Vamos Verificar se Encontrou o Estado!

                if (count($temEstado) > 0) {
                    $idEstado = $temEstado[0]['id_estado'];
                } else {
                    //caso não tenha o estado Cadastrado, vamos realizar o cadastro!

                    $sql = $this->conexao->prepare(USUARIO_SQL::CADASTRAR_ESTADO_SQL());

                    $sql->bindValue(1, $vo->getEstado());

                    $sql->execute();

                    $idEstado = $this->conexao->lastInsertId();
                }

                $sql = $this->conexao->prepare(USUARIO_SQL::CADASTRAR_CIDADE_SQL());

                $sql->bindValue(1, $vo->getCidade());
                $sql->bindValue(2, $idEstado);

                $sql->execute();

                $idCidade = $this->conexao->lastInsertId();
            }

            $sql = $this->conexao->prepare(USUARIO_SQL::CADASTRAR_ENDERECO_SQL());

            $i = 1;

            $sql->bindValue($i++, $vo->getRua());
            $sql->bindValue($i++, $vo->getBairro());
            $sql->bindValue($i++, $vo->getCEP());
            $sql->bindValue($i++, $idCidade);

            $sql->bindValue($i++, $idUser);

            $sql->execute();


            $this->conexao->commit();

            return 1;
        } catch (Exception $ex) {
            $this->conexao->rollback();
            $vo->setErroTecnico($ex->getMessage());
            parent::GravarErroLog($vo);
            return -1;
        }
    }
    public function FiltrarUsuarioMODEL(string $nome): array
    {
        $sql = $this->conexao->prepare(USUARIO_SQL::FILTRAR_USUARIO_SQL());

        $sql->bindValue(1, "%$nome%");

        $sql->execute();

        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function AlterarStatusUsuarioMODEL(UsuarioVO $vo)
    {
        $sql = $this->conexao->prepare(USUARIO_SQL::ALTERAR_STATUS_USUARIO_SQL());

        $i = 1;

        $sql->bindValue($i++, $vo->getStatus());
        $sql->bindValue($i++, $vo->getId());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            $vo->setErroTecnico($ex->getMessage());
            parent::GravarErroLog($vo);
            return -1;
        }
    }
    public function DetalharUsuarioMODEL(int $id): array
    {
        $sql = $this->conexao->prepare(USUARIO_SQL::DETALHAR_USUARIO_SQL());

        $sql->bindValue(1, $id);

        $sql->execute();

        return $sql->fetch(\PDO::FETCH_ASSOC);
    }

    public function AlterarUsuarioMODEL($vo)
    {
        $sql = $this->conexao->prepare(USUARIO_SQL::ALTERAR_USUARIO_SQL());

        $i = 1;

        $sql->bindValue($i++, $vo->getNome());
        $sql->bindValue($i++, $vo->getCpf());
        $sql->bindValue($i++, $vo->getEmail());
        $sql->bindValue($i++, $vo->getSenha());
        $sql->bindValue($i++, $vo->getTelefone());
        $sql->bindValue($i++, $vo->getId());

        try {
            //Monitora toda tentativa de execução desse algoritimo, caso de erro, volta tudo como estava anteriormente!
            $this->conexao->beginTransaction();

            //Cadastra na Tabela Usuário!
            $sql->execute();

            switch ($vo->getTipo()) {
                case USUARIO_FUNCIONARIO:
                    $sql = $this->conexao->prepare(USUARIO_SQL::ALTERAR_FUNCIONARIO_SQL());

                    $i = 1;

                    $sql->bindValue($i++, $vo->getIdSetor());
                    $sql->bindValue($i++, $vo->getId());

                    //Cadastra o Tipo na Tabela Funcionário!
                    $sql->execute();



                    break;

                case USUARIO_TECNICO:
                    $sql = $this->conexao->prepare(USUARIO_SQL::ALTERAR_TECNICO_SQL());

                    $i = 1;

                    $sql->bindValue($i++, $vo->getNomeEmpresa());
                    $sql->bindValue($i++, $vo->getId());

                    //Cadastra o Tipo na Tabela Técnico!
                    $sql->execute();

                    break;
            }


            //Processo que vai Cadastrar o Endereço!
            //1º Passo: Vamos Verificar se a Cidade já está Cadastrada!


            $sql = $this->conexao->prepare(USUARIO_SQL::VERIFICAR_CIDADE_CADASTRADA_SQL());

            $sql->bindValue(1, $vo->getCidade());
            $sql->bindValue(2, $vo->getEstado());

            $sql->execute();

            $temCidade = $sql->fetch(\PDO::FETCH_ASSOC);

            $idCidade = 0;

            //Vamos Verificar se Encontrou a Cidade!

            if (count($temCidade) > 0) {
                $idCidade = $temCidade[0]['cidade_id'];
            } else {
                $idEstado = 0;

                //2º Passo: Verificar se já Existe o Estado Cadastrado!
                $sql = $this->conexao->prepare(USUARIO_SQL::VERIFICAR_ESTADO_CADASTRADO_SQL());

                $sql->bindValue(1, $vo->getEstado());

                $sql->execute();
                $temEstado = $sql->fetchAll(\PDO::FETCH_ASSOC);

                //Vamos Verificar se Encontrou o Estado!

                if (count($temEstado) > 0) {
                    $idEstado = $temEstado[0]['estado_id'];
                } else {
                    //caso não tenha o estado Cadastrado, vamos realizar o cadastro!

                    $sql = $this->conexao->prepare(USUARIO_SQL::CADASTRAR_ESTADO_SQL());

                    $sql->bindValue(1, $vo->getEstado());

                    $sql->execute();

                    $idEstado = $this->conexao->lastInsertId();
                }

                $sql = $this->conexao->prepare(USUARIO_SQL::CADASTRAR_CIDADE_SQL());

                $sql->bindValue(1, $vo->getCidade());
                $sql->bindValue(2, $idEstado);

                $sql->execute();

                $idCidade = $this->conexao->lastInsertId();
            }

            $sql = $this->conexao->prepare(USUARIO_SQL::ALTERAR_ENDERECO_SQL());

            $i = 1;

            $sql->bindValue($i++, $vo->getRua());
            $sql->bindValue($i++, $vo->getBairro());
            $sql->bindValue($i++, $vo->getCEP());
            $sql->bindValue($i++, $idCidade);
            $sql->bindValue($i++, $vo->getIdCidade());

            $sql->execute();

            $this->conexao->commit();


            return 1;
        } catch (Exception $ex) {
            $this->conexao->rollback();
            $vo->setErrorTecnico($ex->getMessage());
            parent::GravarErroLog($vo);
            return -1;
        }
    }
}
