<?php

namespace Src\public;

class Util
{
    public static function UsuarioLogado()
    {
        // Essa function por enquanto fará de forma simulada o acesso de um Usuario na aplicação.
        return 1;
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
}
