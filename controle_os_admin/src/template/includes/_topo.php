<?php
include_once dirname(__DIR__, 3) . '/vendor/autoload.php';

use Src\public\Util;

Util::VerificarLogado();

?>

<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="../../view/admin/inicial.adm.php" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contato</a>
        </li>
    </ul>
</nav>
<!-- Chamada do conteúdo do LOADER na view -->
<div class="loader loader-default" data-text="Carregando..." data-blink></div>