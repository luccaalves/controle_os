<?php
//SET: Entrada de Valor!
//GET: Saída de Valor!

//Tipagem de Dados:
//void: Recebe ou Envia em vazio (Todo SET é "void" pois não retorna nada).
//String: Tipo de dados em forma de TEXTO.
//int: Tipo de dados em forma de NÚMERO.
//bool: Tipo de dados para verificação de Verdadeiro ou Falso (True / False).

//Realiza a localização da classe atual em outras camadas!
namespace Src\VO;

//Chamada de Classe!
use Src\public\Util;
use Src\VO\EnderecoVO;


class UsuarioVO extends EnderecoVO{
    //Parametros privados da classe VO!
    private $id;
    private $nome;
    private $tipo;
    private $email;
    private $cpf;
    private $senha;
    private $status;
    private $telefone;

    //SET e GET do ID do Usuário!
    public function setId(int $id) : void{
        $this->id = $id;
    }
    public function getId() : int{
        return $this->id;
    }
    
    //SET e GET do NOME do Usuário!
    public function setNome(string $nome) : void{
        $this->nome = Util::RemoverTags($nome);
    }
    public function getNome() : string{
        return $this->nome;
    }

    //SET e GET do TIPO do Usuário!
    public function setTipo(int $tipo) : void{
        $this->tipo = $tipo;
    }
    public function getTipo() : int{
        return $this->tipo;
    }

    //SET e GET do EMAIL do Usuário!
    public function setEmail($email) : void{
        $this->email = Util::RemoverTags($email);
    }
    public function getEmail(){
        return $this->email;
    }

    public function setCPF(string $cpf) : void{
        $this->cpf = Util::TirarCaracteresEspeciais($cpf);
    }

    public function getCPF() : string{
        return $this->cpf;
    }    


    //SET e GET do SENHA do Usuário!
    public function setSenha(string $senha) : void{
        $this->senha = $senha;
    }
    public function getSenha() : string{
        return $this->senha;
    }

    //SET e GET da STATUS do Usuário!
    public function setStatus(int $status) : void{
        $this->status = $status;
    }
    public function getStatus() : int{
        return $this->status;
    }

    //SET e GET do TELEFONE do Usuário!
    public function setTelefone(string $telefone) : void{
        $this->telefone = Util::TirarCaracteresEspeciais($telefone);
    }
    public function getTelefone() : int{
        return $this->telefone;
    }
}
