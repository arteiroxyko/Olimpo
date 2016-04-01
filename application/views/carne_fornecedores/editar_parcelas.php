<div class="col-md-12">
<div class="panel panel-default">
  <div class="panel-heading clearfix">
    <h2 class="panel-title pull-left">Editando Parcelas</h2>
    <a href="<?php echo site_url("c_carne_fornecedores/cadastrarParcelas")?>" class="btn btn-default pull-right"> + Novo</a>
    <a href="<?php echo site_url("c_carne_fornecedores/excluir/".$parcela[0]->fcId)?>" class="btn btn-default pull-right">Excluir</a>
  </div>
  <div class="panel-body">
    <form action="<?php echo site_url("c_carne_fornecedores/salvar/".$parcela[0]->fcId)?>" method="post">
        <div class="row">
            <div class="form-group col-md-12">
                <label for="nome">Vencimento</label>
                <input type="text" class="form-control tpData" name="fcVencimento" value="<?php echo date('d/m/Y',strtotime($parcela[0]->fcVencimento)) ?>" autofocus>
            </div> 
            <div class="form-group col-md-12">
                <label for="nome">Numero Parcela</label>
                <input type="text" class="form-control" name="fcParcela" value="<?php echo $parcela[0]->fcParcela ?>">
            </div>          
            <div class="form-group col-md-12">
                <label for="nome">Valor</label>
                <input type="text" class="form-control" name="fcValor" value="<?php echo $parcela[0]->fcValor ?>">
            </div>        
        </div>
        <a href="<?php echo site_url("c_carne_fornecedores/gerenciador")?>" class="btn btn-default">Cancelar</a>
        <button type="submit" class="btn btn-default">Salvar</button>
    </form>
  </div>
</div>
</div>
﻿
