<div class="panel panel-default">
  <div class="panel-heading clearfix">
    <h2 class="panel-title pull-left">Novo Usuario</h2>
    <a href="<?php echo site_url("c_usuarios/cadastrar")?>" class="btn btn-default pull-right"> + Novo</a>
  </div>
  <div class="panel-body">
    <form action="<?php echo site_url("c_usuarios/gravar")?>" method="post">
        <div class="row">
            <div class="form-group col-md-12">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" name="usuNome" id="nome" placeholder="Nome" autofocus>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <label for="nome">Senha</label>
                <input type="password" class="form-control" name="usuSenha" id="nome" placeholder="Nome" autofocus>
            </div>
        </div>
        <div class="form-group">
            <label for="conId">Contas:</label>
                <?php 
                    foreach ($contas as $value) {
                        $o_con[$value->conId] = $value->conNome;
                    }
                    echo form_dropdown('conId', $o_con,'','class="form-control js-select2"');
                ?>
        </div>
        <div class="form-group">
            <label for="perId">Perfil:</label>
                <?php 
                    $o_perf[0] = "Administrador";
                    $o_perf[1] = "Usuario";
                    echo form_dropdown('perId', $o_perf,'','class="form-control js-select2"');
                ?>
        </div>
        <a href="<?php echo site_url("c_usuarios/listar")?>" class="btn btn-default">Cancelar</a>
        <button type="submit" class="btn btn-default">Salvar</button>
    </form>
  </div>
</div>
﻿

