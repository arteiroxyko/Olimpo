<div class="col-md-12">
<div class="panel panel-default">
  <div class="panel-heading clearfix">
    <h2 class="panel-title pull-left">Gerenciado de carnes dos clientes</h2>
    <a href="<?php echo site_url("c_carne_clientes/form_carnes_clientes")?>" class="btn btn-default pull-right"> + Novo</a>
  </div>
  <div class="panel-body ">
    <table class="table table-hover dataTables">
      <thead>
        <tr>
          <th>Cliente</th>
          <th>Descricao</th>
          <th>Total Ainda a receber</th>
          <th>Parcelas</th>
          <th>Detalhes</th>
        </tr>
      </thead>
      <tbody>
          <?php 
            foreach ($carnes as $carne) {
               echo "<tr>";
                    echo "<td>$carne->cliNome</td>";
                    echo "<td>$carne->carDescricao</td>";
                    echo "<td>".(!empty($carne->aindaReceber)?("R$ ".number_format($carne->aindaReceber,2,',','.')):('Quitado'))."</td>";
                    echo "<td>$carne->pagos/$carne->parcelas</td>";
                    echo "<td><a href=".site_url('c_carne_clientes/detalhes/'.$carne->carNum)." class='button tiny'>Detalhes</a></td>";
               echo "</tr>" ;
            }
          ?>  
      </tbody>
    </table>
  </div>
</div>
</div>