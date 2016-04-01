<div class="col-md-12">
<div class="panel panel-default">
  <div class="panel-heading clearfix">
    <h2 class="panel-title pull-left">Nova Categoria</h2>
    <a href="<?php echo site_url("c_categorias/cadastrar")?>" class="btn btn-default pull-right"> + Novo</a>
  </div>
  <div class="panel-body">
    <form action="<?php echo site_url("c_categorias/gravar")?>" method="post">
        <div class="row">
        <div class="form-group col-md-12">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" name="rcNome" id="nome" placeholder="Nome" autofocus>
        </div>
        </div>
        <div class="form-group">
            <label class="radio-inline"><input type="radio" name="rcSaida" value="0">Entrada</label>
            <label class="radio-inline"><input type="radio" name="rcSaida" value="1">Saida</label> 
        </div>
        <a href="<?php echo site_url("c_categorias/listar")?>" class="btn btn-default">Cancelar</a>
        <button type="submit" class="btn btn-default">Salvar</button>
    </form>
  </div>
</div>
</div>
﻿

