<nav class="navbar navbar-default navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo site_url() ?>">Olimpo Finan</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $this->session->userdata['Nome'] ?><span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url('c_principal/ajuda') ?>">Ajuda</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="<?php echo site_url('c_login/logoff') ?>">Sair</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Menu</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cadastros<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url("c_clientes/listar")?>">Clientes</a></li>
            <li><a href="<?php echo site_url("c_fornecedores/listar")?>">Fornecedores</a></li>        
            <li><a href="<?php echo site_url("c_categorias/listar")?>">Categorias Finaneiro</a></li>        
            <li><a href="<?php echo site_url("c_contas/listar")?>">Contas</a></li>
            <li><a href="<?php echo site_url("c_usuarios/listar")?>">Usuarios</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Clientes<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url("c_carne_clientes/gerenciador")?>">Carnes</a></li>
            <li><a href="<?php echo site_url("c_secretaria/registrarEntrada")?>">Entradas</a></li>
          </ul>
        </li> 
<?php if ($this->session->userdata['Perfil']==0) { ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Fornecedores<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url("c_carne_fornecedores/gerenciador")?>">Carnes</a></li>
            <li><a href="<?php echo site_url("c_secretaria/registrarSaida")?>">Saidas</a></li>
          </ul>
        </li>
<?php } ?>
       
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Consultas<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url("c_financeiro/movimentos")?>">Movimentos de Entrada</a></li>
            <li><a href="<?php echo site_url("c_financeiro/movimentosSaida")?>">Movimentos de Saida</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo site_url("c_financeiro/gerenciador_financeiro")?>">Resumos Mês</a></li>
            <li><a href="<?php echo site_url("c_financeiro/gerenciador_financeiro_dia")?>">Resumos Dia</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo site_url("c_financeiro/prospecao")?>">Grafico de Prospecção</a></li>
            <li><a href="<?php echo site_url("c_financeiro/resumoDeContasMes")?>">Resumo por Conta</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
