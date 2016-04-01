<div class="panel panel-default">
  <div class="panel-heading clearfix">
    <h2 class="panel-title pull-left">Editar Entradas</h2>
    <a href="<?php echo site_url("c_financeiro/excluirentrada/".$entrada[0]->reId)?>" class="btn btn-default pull-right"> Excluir</a>
  </div>
  <div class="panel-body">
    <form action="<?php echo site_url("c_financeiro/salvarentrada/".$entrada[0]->reId)?>" method="post">
        <div class="form-group">
            <label for="mensalidade">Descrição da entrada:</label>
            <input class="form-control" value="<?php echo $entrada[0]->reDescricao ?>" type="text" name="reDescricao" id="mensalidade" />
        </div>        
        <div class="form-group">
            <label for="mensalidade">Data da entrada:</label>
            <input class="form-control tpData" type="text" value="<?php echo date('d/m/Y',strtotime($entrada[0]->reData)); ?>" name="reData" id="mensalidade" />
        </div>
        <div class="form-group">
            <label for="mensalidade">Categorias:</label>
                <?php 
                    foreach ($categorias as $value) {
                        $o_cats[$value->rcId] = $value->rcNome;
                    }
                    echo form_dropdown('reCategoria', $o_cats,$entrada[0]->reCategoria,'class="form-control js-select2"');
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
            <label for="mensalidade">Valor Recebido:</label>
            <div class="input-group">
                <div class="input-group-addon">R$</div>
                <input class="form-control" type="text" value="<?php echo $entrada[0]->reValor ?>" name="reValor" id="mensalidade" />
            </div>
        </div>
        <button type="submit" class="btn btn-default">Pagar</button>
    </form>
  </div>
</div>
﻿
            
