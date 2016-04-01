<div class="col-md-offset-3 col-md-6">
<div class="panel panel-default">
  <div class="panel-heading clearfix">
    <h2 class="panel-title pull-left">Editar Aluno</h2>
    <a href="<?php echo site_url("c_clientes/cadastrar")?>" class="btn btn-default pull-right"> + Novo</a>
    <a href="<?php echo site_url("c_clientes/excluir/".$clientes[0]->cliid)?>" class="btn btn-default pull-right">Excluir</a>
  </div>
  <div class="panel-body">
    <form action="<?php echo site_url("c_clientes/salvar/".$clientes[0]->cliid)?>" method="post">
        <div class="row">
            <div class="form-group col-md-12">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" name="nome" value="<?php echo $clientes[0]->cliNome ?>" id="nome" placeholder="Nome" autofocus>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6 col-sm-12">
                <label for="tel1">Telefone 1:</label>
                <input type="text" class="form-control" name="telefone1" value="<?php echo $clientes[0]->cliTelefone1 ?>" id="tel1" placeholder="Telefone - 1">
            </div>
            <div class="form-group col-md-6 col-sm-12">
                <label for="tel2">Telefone 2:</label>
                <input type="text" class="form-control" name="telefone2" value="<?php echo $clientes[0]->cliTelefone2 ?>" id="tel2" placeholder="Telefone - 2">
            </div>
        </div>
        <a href="<?php echo site_url("c_clientes/listar")?>" class="btn btn-default">Cancelar</a>
        <button type="submit" class="btn btn-default">Salvar</button>
    </form>
  </div>
</div>
</div>
﻿

