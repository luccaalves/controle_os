<?php

namespace Src\Model;

    //Self comando que reaproveita comandos da mesma classe
    //PDO Classe imbutida propria do PHP para interagir com todos os SGBDs (Softwares de gerenciamento de SQL)

    // Configurações do site
    define('HOST', '127.0.0.1'); //IP
    define('USER', 'root'); //usuario
    define('PASS', 'root'); //Senha
    define('DB', 'db_controle_os'); //Banco
    /**
     * Conexao.class TIPO [Conexão]
     * Descricao: Estabelece conexões com o banco usando SingleTon
     * @copyright (c) year, WMBarros
     */

    class Conexao {
        /** @var PDO */
        private static $Connect;

        //Função estática não cria objeto na memoria, funciona de forma direta
        //Quando uma estrutura de função é padrão, não sofre alterações, podemos utilizar a função estatica
        private static function Conectar() {
            try {

                //Verifica se a conexão não existe
                if (self::$Connect == null):

                    $dsn = 'mysql:host=' . HOST . ';dbname=' . DB;
                    self::$Connect = new \PDO($dsn, USER, PASS, null);
                endif;
            } catch (\PDOException $e) {
                echo $e->getMessage();
            }
        
            //Seta os atributos para que seja retornado as excessões do banco
            self::$Connect->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
        
            return  self::$Connect;
        }

        public static function retornarConexao() {
            return  self::Conectar();
        }

        public static function GravarErroLog($vo){
            // Variável que vai armazenar o nome do arquivo e seu caminho!
            $arquivo = PATH . 'Model/Logs/log_erro.txt';

            // Vamos verificar se NÃO EXISTE o arquivo!
            // fopen = FILE OPEN (Abrir Arquivo)!
            // w = Uma palavra reservada do PHP para abrir algum arquivo! 
            if(!file_exists($arquivo)){
                // Será criado o arquivo específicado!
                $arquivo = fopen($arquivo, 'w');
            }else{
                // Caso já exista o arquivo, será aberto para um novo registro e manter o cursor no final do registro!
                // a+ = Abre o arquivo para leitura e escrita, e direciona o cursor para o final!
                $arquivo = fopen($arquivo, 'a+');
            }

                // Cria uma Variável para escrever no arquivo!
                // $msg.= é a mesma coisa que $msg = $msg . 'valor';!
            $msg = '===============================================================================' . PHP_EOL;
            $msg = $msg . 'Data do Erro: ' . $vo->getDataErro() . PHP_EOL;
            $msg .= 'Hora do Erro: ' . $vo->getHoraErro() . PHP_EOL;;
            // $msg .= 'Código Logado: ' . $vo->getCodLogado() . PHP_EOL;;
            $msg .= 'Função do Erro: ' . $vo->getErroFuncao() . PHP_EOL;;
            $msg .= 'Erro Ténico: ' . $vo->getErroTecnico() . PHP_EOL;; 

            //Ecreve o erro gerado no arquivo já aberto!
            fwrite($arquivo, $msg);
            fclose($arquivo);    
        }
    }    