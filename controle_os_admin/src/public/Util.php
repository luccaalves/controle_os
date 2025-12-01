<?php

namespace Src\public;

class Util
{
    public static function IniciarSessao(): void
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    public static function CriarSessao(int $id, string $nome): void
    {
        self::IniciarSessao();

        $_SESSION['cod'] = $id;
        $_SESSION['nome'] = $nome;
    }


    public static function UsuarioLogado(): int
    {
        self::IniciarSessao();
        return $_SESSION['cod'];
    }

    public static function NomeLogado(): string
    {
        self::IniciarSessao();
        return $_SESSION['nome'];
    }

    public static function Deslogar()
    {
        self::IniciarSessao();
        unset($_SESSION['cod']);
        unset($_SESSION['nome']);
        self::ChamarPagina('http://localhost/src/view/acesso/login');
    }

    public static function VerificarLogado()
    {
        self::IniciarSessao();
        if (!isset($_SESSION['cod']) || empty($_SESSION['cod'])) {
            self::ChamarPagina('http://localhost/src/view/acesso/login');
        }
    }


    // Função de Tratativas de Caracteres Especiais e inject JavaScript!
    public static function TratarDados($palavra)
    {
        $especiais = array(".", ",", ";", "!", "@", "#", "%", "¨", "*", "(", ")", "+", "-", "=", "§", "$", "/", "|", "\\", ":", "<", ">", "?", "{", "}", "[", "]", "&", "'", "`", "´", "°", "ª", "^", "~", '"', '.',);
        $palavra = strip_tags($palavra);
        $palavra = str_replace($especiais, "", trim($palavra));

        return $palavra;
    }

    // Função de Tratativas de Caracteres Especiais e inject JavaScript!
    public static function TirarCaracteresEspeciais($palavra)
    {
        $especiais = array(".", ",", ";", "!", "@", "#", "%", "¨", "*", "(", ")", "+", "-", "=", "§", "$", "/", "|", "\\", ":", "<", ">", "?", "{", "}", "[", "]", "&", "'", "`", "´", "°", "ª", "^", "~", '"', '.',);
        $palavra = str_replace($especiais, "", trim($palavra));

        return $palavra;
    }

    //Função para Tratativa e Proteção de Inject JavaScript nos formulários!
    public static function RemoverTags($palavra)
    {
        $palavra = strip_tags($palavra);

        return $palavra;
    }

    // Função para confirmar o Fuso Horario correto de uso da Aplicação!
    private static function SetarFusoHorario()
    {
        date_default_timezone_set('America/Sao_Paulo');
    }

    // Função para identificar a Hora Atual correta!
    public static function HoraAtual()
    {
        self::SetarFusoHorario();

        return date('H:i');
    }

    //Função que identifica a Data e Hora atual!
    public static function DataHoraAtual()
    {
        self::SetarFusoHorario();

        return date('Y-m-d H-i');
    }

    //Função que identifica a data Atual!
    public static function DataAtual()
    {
        self::SetarFusoHorario();
        return date('Y-m-d');
    }

    //Função que identifica a Data Atual no formato Brasil!
    public static function DataAtualBr()
    {
        self::SetarFusoHorario();
        //Padrão Brasileiro:
        return date('d/m/Y');
    }

    public static function MostrarSituacao(int $sit): string
    {

        $situacao = '';

        switch ($sit) {
            case SITUACAO_ATIVO:
                $situacao = '<strong style="color:#008800">ATIVO<strong/>';
                break;

            case SITUACAO_INATIVO:
                $situacao = '<strong style="color:#FF0000">INATIVO<strong/>';
                break;
        }

        return $situacao;
    }

    public static function ChamarPagina($pag)
    {
        header("location: $pag.php");
        exit;
    }

    public static function CriptografarSenha($senha): string
    {
        return password_hash($senha, PASSWORD_DEFAULT);
    }

    public static function VerificarSenha($senhaDigitada, $senhaHash): bool
    {
        return password_verify($senhaDigitada, $senhaHash);
    }

    public static function MostrarTipoUsuario(int $tipo): string
    {
        $nomeTipo = '';

        switch ($tipo) {
            case USUARIO_ADM:
                $nomeTipo = "ADMINISTRADOR";
                break;
            case USUARIO_FUNCIONARIO:
                $nomeTipo = "FUNCIONARIO";
                break;
            case USUARIO_TECNICO:
                $nomeTipo = "TECNICO";
                break;
        }

        return $nomeTipo;
    }

    public static function CreateTokenAuthentication(array $dados_usuario){
        $header = [
            'typ' => 'JWT',
            'alg' => 'HS256'
        ];

        $payload = $dados_usuario;
        $header = json_encode($header);
        $payload = json_encode($payload);
        $header = base64_encode($header);
        $payload = base64_encode($payload);
        $sign = hash_hmac(
            "sha256",
            $header . '.' . $payload,
            SECRET,
            true
        );
        $sign = base64_encode($sign);
        $token = $header . '.' . $payload . '.' . $sign;
        return $token;
    }

    public static function AuthenticationTokenAccess(){
        $http_header = apache_request_headers();
        // Verifica se o header Authorization contém um token válido
        if($http_header['Authorization'] != null &&
            str_contains($http_header['Authorization'], '.')
        ) :
            $bearer = explode(' ', $http_header['Authorization']);
            $token = explode('.', $bearer[1]);

            // Decompõe o token e verifica a assinatura
            $header = $token[0];
            $payload = $token[1];
            $sign = $token[2];
            //Criptografa Novamente para verificar se Bate com a Chave.
            $valid = hash_hmac(
                'sha256',
                $header . '.' . $payload,
                SECRET,
                true
            );
            $valid = base64_encode($valid);
            if($valid === $sign)
                return true;
            else
                return false;
        endif;    
        return false;
    }
}
