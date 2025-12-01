<?php 
include_once dirname(__DIR__, 3) . '/vendor/autoload.php';

use Src\public\Util;

Util::VerificarLogado();
use Dompdf\Dompdf;
$dompdf = new Dompdf();

