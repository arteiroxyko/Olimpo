<div class="col-md-12">
<div class="panel panel-default">
  <div class="panel-heading clearfix">
    <h2 class="panel-title pull-left">Categorias do Financeiro</h2>
    <a href="<?php echo site_url("c_categorias/cadastrar")?>" class="btn btn-default pull-right"> + Novo</a>
  </div>
  <div class="panel-body ">
    <table class="table table-hover dataTables">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Entrada/Saida</th>
          <th>Editar</th>
        </tr>
      </thead>
      <tbody>
          <?php 
            foreach ($categorias as $row) {
               echo "<tr>";
                    echo "<td>$row->rcNome</td>";
                    echo (($row->rcSaida==0) ? "<td>Entrada</td>":"<td>Saida</td>");
                    echo "<td><a href=".site_url('c_categorias/editar/'.$row->rcId)." class='button tiny'>Editar</a></td>";
               echo "</tr>" ;
            }
          ?>  
      </tbody>
    </table>
  </div>
</div>
</div>