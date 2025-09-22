<?php

include_once dirname(__DIR__, 3) . '/vendor/autoload.php';

use Src\resource\api\Classe\FuncionarioEndPoints;

$obj = new FuncionarioEndPoints();
$obj->SetMethod($_SERVER['REQUEST_METHOD']);

if (!$obj->CheckMethod()) {
    $obj->SendData('METHOD INVÁLIDO', "-1", "ERROR");
} else {

    $recebido = getallheaders();
    $json = $recebido['Content-Type'] == 'application/json' ? true : false;

    if ($json) {
        $dados = file_get_contents('php://input');
        $dados = json_decode($dados, true);
    } else {
        $dados = $_POST;
    }

    $obj->SetEndPoint($dados['endpoint']);

    if (!$obj->CheckEndPoint($obj->GetEndPoint())) {
        $obj->SendData('ENDPOINT INVÁLIDO', "-1", "ERROR");
    }

    $obj->AddParametes($dados);

    $result = $obj->{$obj->GetEndPoint()}();
    $obj->SendData("Resultado", $result, 'SUCESSO');

}

    if(!response.ok){
        MessagemCustomizada("Erro ao chamar a API");
    }

