<?php
header("Access-Control-Allow-Origin: http://controle_os_funcionario.test");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

include_once dirname(__DIR__, 3) . '/vendor/autoload.php';
use Src\resource\api\Classe\TecnicoEndPoints;

$obj = new TecnicoEndPoints();
$obj->SetMethod($_SERVER['REQUEST_METHOD']);

if (!$obj->CheckMethod()) {
    $obj->SendData('METHOD INVÁLIDO', "-1", "ERROR");
}

// Recebe dados
$recebido = getallheaders();
$json = ($recebido['Content-Type'] ?? '') === 'application/json';

if ($json) {
    $dados = file_get_contents('php://input');
    $dados = json_decode($dados, true) ?: [];
} else {
    $dados = $_POST;
}

$endpoint = $dados['endpoint'] ?? null;
if (!$endpoint) {
    $obj->SendData('ENDPOINT NÃO INFORMADO', "-1", "ERROR");
}

$obj->SetEndPoint($endpoint);

if (!$obj->CheckEndPoint($obj->GetEndPoint())) {
    $obj->SendData('ENDPOINT INVÁLIDO', "-1", "ERROR");
}

$obj->AddParameters($dados);

$endpointMetodo = $obj->GetEndPoint();
if (!empty($endpointMetodo) && method_exists($obj, $endpointMetodo)) {
    $result = $obj->{$endpointMetodo}();
    $obj->SendData("RESULTADO", $result, 'SUCESSO');
} else {
    $obj->SendData('ENDPOINT INVÁLIDO', "-1", "ERROR");
}
