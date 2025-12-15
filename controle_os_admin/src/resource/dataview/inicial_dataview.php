<?php
use Src\Controller\ChamadoCTRL;

include_once dirname(__DIR__, 3) . '/vendor/autoload.php';
use Src\public\Util;
Util::VerificarLogado();

$dados = (new ChamadoCTRL)->MostrarDadosChamadosCTRL();