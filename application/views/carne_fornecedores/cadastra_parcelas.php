<div class="col-md-12">
<div class="panel panel-default">
  <div class="panel-heading clearfix">
    <h2 class="panel-title pull-left">Criando Parcelas</h2>
  </div>
  <div class="panel-body">
    <form action="<?php echo site_url("c_carne_fornecedores/gravar/".$carnes[0]->fcNum)?>" method="post">
        <input type="hidden" name="forId" value="<?php echo $carnes[0]->forId ?>">
        <input type="hidden" name="fcDescricao" value="<?php echo $carnes[0]->fcDescricao ?>">
        <div class="row">
        <div class="form-group col-md-3">
            <label for="Vencimento">Vencimento</label>
            <input type="text" class="form-control tpData" name="fcVencimento" value="" id="Vencimento" placeholder="Vencimento" autofocus>
        </div>           
        <div class="form-group col-md-3">
            <label for="numParcela">Numero de parcelas</label>
            <input type="text" class="form-control" name="fcParcela" value="" id="numParcela" >
        </div>                  
        <div class="form-group col-md-3">
            <label for="valor">Valor</label>
            <input type="text" class="form-control" name="fcValor" value="" id="valor" >
        </div>        
        </div>
        <a href="<?php echo site_url("c_carne_empresa/gerenciador")?>" class="btn btn-default">Cancelar</a>
        <button type="submit" class="btn btn-default">Salvar</button>
    </form>
  </div>
</div>
</div>
﻿