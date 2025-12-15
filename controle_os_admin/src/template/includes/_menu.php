<?php 
include_once dirname(__DIR__, 3) . '/vendor/autoload.php';

use Src\public\Util;

if(isset($_GET['close']) && $_GET['close'] == 1){
  Util::Deslogar();
}
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="../../index3.html" class="brand-link">
    <img src="../../template/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Controle OS</span>
  </a>

  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="../../template/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Lucca Alves</a>
      </div>
    </div>
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-keyboard"></i>
            <p>Equipamentos<i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="novo_equipamento.php" class="nav-link">
                <i class="fa fa-laptop nav-icon"></i>
                <p>Cadastrar Equipamento</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="consultar_equipamento.php" class="nav-link">
                <i class="fa fa-search nav-icon"></i>
                <p>Consultar Equipamento</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="alocar_equipamento.php" class="nav-link">
                <i class="fa fa-wrench nav-icon"></i>
                <p>Alocar Equipamento</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="gerenciar_modelo_equipamento.php" class="nav-link">
                <i class="fa fa-list nav-icon"></i>
                <p>Modelo Equipamento</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="gerenciar_tipo_equipamento.php" class=" nav-link">
                <i class="fa fa-list nav-icon"></i>
                <p>Tipo Equipamento</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="remover_equipamento.php" class=" nav-link">
                <i class="fa fa-trash nav-icon"></i>
                <p>Remover Equipamento</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>
              Usuário<i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="novo_setor.php" class="nav-link">
                <i class="fas fa-users nav-icon"></i>
                <p>Cadastrar Setor</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="novo_usuario.php" class="nav-link">
                <i class="fa fa-user-plus nav-icon"></i>
                <p>Cadastrar Usuário</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="consultar_usuario.php" class="nav-link">
                <i class="fa fa-search nav-icon"></i>
                <p>Consultar Usuário</p>
              </a>
            </li>
          </ul>
        </li>
          <a href="../../template/includes/_menu.php?close=1" class="nav-link">
            <i class="fa fa-power-off nav-icon"></i>
            <p>Sair</p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>