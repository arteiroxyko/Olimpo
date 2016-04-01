<div class="col-md-12">
<div class="panel panel-default">
  <div class="panel-heading clearfix">
    <h2 class="panel-title pull-left">Nova Conta</h2>
    <a href="<?php echo site_url("c_contas/cadastrar")?>" class="btn btn-default pull-right"> + Novo</a>
  </div>
  <div class="panel-body">
    <form action="<?php echo site_url("c_contas/gravar")?>" method="post">
        <div class="row">
        <div class="form-group col-md-12">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" name="conNome" id="nome" placeholder="Nome" autofocus>
        </div>
        </div>
        <a href="<?php echo site_url("c_contas/listar")?>" class="btn btn-default">Cancelar</a>
        <button type="submit" class="btn btn-default">Salvar</button>
    </form>
  </div>
</div>
</div>
﻿

