<?php
include_once dirname(__DIR__, 3) . '/vendor/autoload.php';
use Src\public\Util;
Util::VerificarLogado();
use Src\Controller\ChamadoCTRL;

$dados = (new ChamadoCTRL)->MostrarDadosChamadosCTRL();