<div class="col-md-12">
<div class="panel panel-default">
  <div class="panel-heading clearfix">
    <h2 class="panel-title pull-left">Editando Categoria</h2>
    <a href="<?php echo site_url("c_categorias/cadastrar")?>" class="btn btn-default pull-right"> + Novo</a>
    <a href="<?php echo site_url("c_categorias/excluir/".$categorias[0]->rcId)?>" class="btn btn-default pull-right">Excluir</a>
  </div>
  <div class="panel-body">
    <form action="<?php echo site_url("c_categorias/salvar/".$categorias[0]->rcId)?>" method="post">
        <div class="row">
        <div class="form-group col-md-12">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" name="rcNome" value="<?php echo $categorias[0]->rcNome ?>" id="nome" placeholder="Nome" autofocus>
        </div>
        </div>
        <div class="form-group">
            <label class="radio-inline"><input type="radio" <?php echo (($categorias[0]->rcSaida==0)?'checked':''); ?> name="rcSaida" value="0">Entrada</label>
            <label class="radio-inline"><input type="radio" <?php echo (($categorias[0]->rcSaida==1)?'checked':''); ?> name="rcSaida" value="1">Saida</label> 
        </div>
        <a href="<?php echo site_url("c_categorias/listar")?>" class="btn btn-default">Cancelar</a>
        <button type="submit" class="btn btn-default">Salvar</button>
    </form>
  </div>
</div>
</div>
﻿


