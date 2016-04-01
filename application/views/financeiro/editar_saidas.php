<div class="panel panel-default">
  <div class="panel-heading clearfix">
    <h2 class="panel-title pull-left">Editar Saidas</h2>
    <a href="<?php echo site_url("c_financeiro/excluirsaida/".$saida[0]->rsId)?>" class="btn btn-default pull-right"> Excluir</a>
  </div>
  <div class="panel-body">
    <form action="<?php echo site_url("c_financeiro/salvarsaida/".$saida[0]->rsId) ?>" method="post">
        <div class="form-group">
            <label for="mensalidade">Descrição da Saida:</label>
            <input class="form-control" value="<?php echo $saida[0]->rsDescricao ?>" type="text" name="rsDescricao" id="mensalidade" />
        </div>        
        <div class="form-group">
            <label for="mensalidade">Data da saida:</label>
            <input class="form-control tpData" type="text" value="<?php echo date('d/m/Y',strtotime($saida[0]->rsData)); ?>" name="rsData" id="mensalidade" />
        </div>
        <div class="form-group">
            <label for="mensalidade">Categorias:</label>
                <?php 
                    foreach ($categorias as $value) {
                        $o_cats[$value->rcId] = $value->rcNome;
                    }
                    echo form_dropdown('rsCategoria', $o_cats,$saida[0]->rsCategoria,'class="form-control js-select2"');
                ?>
        </div>
        <div class="form-group">
            <label for="mensalidade">Conta:</label>
                <?php 
                    if ($this->session->userdata['Perfil']==0) {
                        foreach ($contas as $value) {
                            $o_con[$value->conId] = $value->conNome;
                        }
                        echo form_dropdown('conId', $o_con,$this->session->userdata['Conta'],'class="form-control js-select2"');
                    }else{
                        foreach ($contas as $value) {
                            $o_con[$value->conId] = $value->conNome;
                        }
                        echo form_dropdown('conId', $o_con,$this->session->userdata['Conta'],'disabled="" class="disabled form-control"');
                    }
                ?>
        </div>
        <div class="form-group">
            <label for="mensalidade">Valor Retirado:</label>
            <div class="input-group">
                <div class="input-group-addon">R$</div>
                <input class="form-control" value="<?php echo $saida[0]->rsValor ?>"type="text" name="rsValor" id="mensalidade" />
            </div>
        </div>
        <button type="submit" class="btn btn-default">Pagar</button>
    </form>
  </div>
</div>
﻿
            
