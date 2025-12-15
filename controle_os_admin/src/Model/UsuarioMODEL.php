<?php

namespace Src\Model;

use Exception;
use Src\Model\Conexao;
use Src\Model\SQL\USUARIO_SQL;
use Src\VO\UsuarioVO;

use Src\VO\FuncionarioVO;
use Src\VO\TecnicoVO;


class UsuarioMODEL extends Conexao
{

    private $conexao;

    public function __construct()
    {
        $this->conexao = parent::retornarConexao();
    }
    public function ValidarLoginModel(string $login, int $status): array | null | bool
    {
        $sql = $this->conexao->prepare(USUARIO_SQL::VALIDAR_LOGIN_SQL());
        $sql->bindValue(1, $login);
        $sql->bindValue(2, $status);

        $sql->execute();

        return $sql->fetch(\PDO::FETCH_ASSOC);
    }
    public function VerificarEmailDuplicadoMODEL(string $email): bool
    {
        $sql = $this->conexao->prepare(USUARIO_SQL::VERIFICAR_EMAIL_SQL());
        $sql->bindValue(1, $email);
        $sql->execute();

        // Essa Variável aloca o Array que sera montado pelo PDO de acordo a verificação feita com o E-maiL!
        $verEmail = $sql->fetchAll(\PDO::FETCH_ASSOC);

        return $verEmail[0]['contar_email'] == 0 ? false : true;
    }
    public function VerificarCpfDuplicadoMODEL(string $cpf): bool
    {
        $sql = $this->conexao->prepare(USUARIO_SQL::BUSCAR_CPF());
        $sql->bindValue(1, $cpf);
        $sql->execute();
        $ver_cpf = $sql->fetch(\PDO::FETCH_ASSOC);
        return $ver_cpf['contar'] == 0 ? false : true;
    }
    public function CadastrarUsuarioMODEL($vo)
    {
        $sql = $this->conexao->prepare(USUARIO_SQL::CADASTRAR_USUARIO_SQL());

        $i = 1;

        $sql->bindValue($i++, $vo->getNome());
        $sql->bindValue($i++, $vo->getTipo());
        $sql->bindValue($i++, $vo->getEmail());
        $sql->bindValue($i++, $vo->getCPF());
        $sql->bindValue($i++, $vo->getSenha());
        $sql->bindValue($i++, $vo->getStatus());
        $sql->bindValue($i++, $vo->getTelefone());

        try {
            // Monitora toda a tentativa de execução desse algoritmo, caso de erro, volta tudo como estava anteriormente!
            $this->conexao->beginTransaction();

            // Cadastrar na Tabela Usuário!
            $sql->execute();

            // Vai recuperar o ID do usuário cadastrado, e tipa o perfil!
            $idUser = $this->conexao->lastInsertId();

            switch ($vo->getTipo()) {
                case USUARIO_FUNCIONARIO:
                    $sql = $this->conexao->prepare(USUARIO_SQL::CADASTRAR_FUNCIONARIO_SQL());

                    $i = 1;

                    $sql->bindValue($i++, $idUser);
                    $sql->bindValue($i++, $vo->getIdSetor());

                    // Cadastra o Tipo na Tabela Funcionario!
                    $sql->execute();

                    break;

                case USUARIO_TECNICO:
                    $sql = $this->conexao->prepare(USUARIO_SQL::CADASTRAR_TECNICO_SQL());

                    $i = 1;

                    $sql->bindValue($i++, $idUser);
                    $sql->bindValue($i++, $vo->getNomeEmpresa());

                    // Cadastra o Tipo na Tabela Técnico!
                    $sql->execute();

                    break;
            }

            // Processo que vai cadastrar o Endereço!
            // 1º Passo: Vamos verificar se a cidade já esta cadastrada!
            $sql = $this->conexao->prepare(USUARIO_SQL::VERIFICAR_CIDADE_CADASTRADA_SQL());

            $sql->bindValue(1, $vo->getCidade());
            $sql->bindValue(2, $vo->getEstado());

            $sql->execute();

            $temCidade = $sql->fetchAll(\PDO::FETCH_ASSOC);

            $idCidade = 0;

            // Vamos verificar se encontrou a Cidade!
            if (count($temCidade) > 0) {
                $idCidade = $temCidade[0]['id'];
            } else {
                $idEstado = 0;

                // 2º Passo: Verificar se já existe Estado cadastrado!
                $sql = $this->conexao->prepare(USUARIO_SQL::VERIFICAR_ESTADO_CADASTRADO_SQL());

                $sql->bindValue(1, $vo->getEstado());

                $sql->execute();

                $temEstado = $sql->fetchAll(\PDO::FETCH_ASSOC);

                // Vamos verificar se encontrou o Estado!
                if (count($temEstado) > 0) {
                    $idEstado = $temEstado[0]['id_estado'];
                } else {
                    // Caso não tenha o Estado cadastrado, vamos realizar o cadastro!
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
    public function AlterarUsuarioMODEL($vo): int
    {
        $sql = $this->conexao->prepare(USUARIO_SQL::ALTERAR_USUARIO_SQL());

        $i = 1;

        $sql->bindValue($i++, $vo->getNome());
        $sql->bindValue($i++, $vo->getEmail());
        $sql->bindValue($i++, $vo->getCPF());
        $sql->bindValue($i++, $vo->getSenha());
        $sql->bindValue($i++, $vo->getTelefone());
        $sql->bindValue($i++, $vo->getId());

        try {
            // Monitora toda a tentativa de execução desse algoritmo, caso de erro, volta tudo como estava anteriormente!
            $this->conexao->beginTransaction();
            // Cadastrar na Tabela Usuário!
            $sql->execute();

            switch ($vo->getTipo()) {
                case USUARIO_FUNCIONARIO:
                    $sql = $this->conexao->prepare(USUARIO_SQL::ALTERAR_FUNCIONARIO_SQL());
                    $i = 1;
                    $sql->bindValue($i++, $vo->getIdSetor());
                    $sql->bindValue($i++, $vo->getId());
                    $sql->execute();
                    break;
                case USUARIO_TECNICO:
                    $sql = $this->conexao->prepare(USUARIO_SQL::ALTERAR_TECNICO_SQL());
                    $i = 1;
                    $sql->bindValue($i++, $vo->getNomeEmpresa());
                    $sql->bindValue($i++, $vo->getId());
                    $sql->execute();
                    break;
            }

            // Processo que vai cadastrar o Endereço!
            // 1º Passo: Vamos verificar se a cidade já esta cadastrada!
            $sql = $this->conexao->prepare(USUARIO_SQL::VERIFICAR_CIDADE_CADASTRADA_SQL());
            $i = 1;
            $sql->bindValue($i++, $vo->getCidade());
            $sql->bindValue($i++, $vo->getEstado());
            $sql->execute();
            $temCidade = $sql->fetchAll(\PDO::FETCH_ASSOC);
            $idCidade = 0;

            if (count($temCidade) > 0) {
                $idCidade = $temCidade[0]['id'];
            } else {
                $idEstado = 0;
                $sql = $this->conexao->prepare(USUARIO_SQL::VERIFICAR_ESTADO_CADASTRADO_SQL());
                $sql->bindValue(1, $vo->getEstado());
                $sql->execute();
                $temEstado = $sql->fetchAll(\PDO::FETCH_ASSOC);

                if (count($temEstado) > 0) {
                    $idEstado = $temEstado[0]['id_estado'];
                } else {
                    // Caso não tenha o Estado cadastrado, vamos realizar o cadastro!
                    $sql = $this->conexao->prepare(USUARIO_SQL::CADASTRAR_ESTADO_SQL());
                    $sql->bindValue(1, $vo->getEstado());
                    $sql->execute();
                    $idEstado = $this->conexao->lastInsertId();
                }

                $sql = $this->conexao->prepare(USUARIO_SQL::CADASTRAR_CIDADE_SQL());
                $i = 1;
                $sql->bindValue($i++, $vo->getCidade());
                $sql->bindValue($i++, $idEstado);
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
            $vo->setErroTecnico($ex->getMessage());
            parent::GravarErroLog($vo);
            return -1;
        }
    }
    public function RegistrarLogAcesso(string $data, int $idUser): void
    {
        $sql = $this->conexao->prepare(USUARIO_SQL::REGISTRAR_LOG_ACESSO());
        $sql->bindValue(1, $data);
        $sql->bindValue(2, $idUser);
        $sql->execute();
    }
    public function AlterarSenhaMODEL(UsuarioVO $vo): int
    {
        $sql = $this->conexao->prepare(USUARIO_SQL::ALTERAR_SENHA_SQL());
        $i = 1;
        $sql->bindValue($i++, $vo->getSenha());
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
    public function BuscarSenhaMODEL(int $id): array|null
    {
        $sql = $this->conexao->prepare(USUARIO_SQL::BUSCAR_SENHA());
        $sql->bindValue(1, $id);
        $sql->execute();
        return $sql->fetch(\PDO::FETCH_ASSOC);
    }
}
