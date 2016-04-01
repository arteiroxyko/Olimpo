<div class="col-md-12">
<div class="panel panel-default">
  <div class="panel-heading clearfix">
    <h2 class="panel-title pull-left">Contas</h2>
    <a href="<?php echo site_url("c_contas/cadastrar")?>" class="btn btn-default pull-right"> + Novo</a>
  </div>
  <div class="panel-body ">
    <table class="table table-hover dataTables">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Editar</th>
        </tr>
      </thead>
      <tbody>
          <?php 
            foreach ($contas as $row) {
               echo "<tr>";
                    echo "<td>$row->conNome</td>";
                    echo "<td><a href=".site_url('c_contas/editar/'.$row->conId)." class='button tiny'>Editar</a></td>";
               echo "</tr>" ;
            }
          ?>  
      </tbody>
    </table>
  </div>
</div>
</div>