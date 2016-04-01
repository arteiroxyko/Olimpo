<div class="col-md-12">
  <div class="col-md-6 col-sm-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <h2 class="panel-title pull-left">Fornecedores Vencidos</h2>
      </div>
      <div class="panel-body ">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Data</th>
              <th>Fornecedor</th>
              <th>Descrição</th>
              <th>Valor</th>
              <th>Pagar</th>
            </tr>
          </thead>
          <tbody>
              <?php 
                $total = 0;
                foreach ($fornecedoresVencidos as $carne) {
                    echo "<tr>";
                    echo "<td>".date("d/m/Y",strtotime($carne->fcVencimento))."</td>";
                    echo "<td>$carne->forNome</td>";
                    echo "<td>$carne->fcDescricao</td>";
                    echo "<td>R$ ",number_format($carne->fcValor,2,',','.')."</td>";
                    echo "<td><a href=".site_url('c_carne_fornecedores/registrarPagamento/'.$carne->fcId)." class='button tiny'>Pagar</a></td>";
                    echo "</tr>" ;
                    $total += $carne->fcValor;
                }
                echo "<tr>";
                echo "<th colspan='4'>Total Em aberto</th>";
                echo "<th>R$ ",number_format($total,2,',','.')."</th>";
                echo "</tr>" ;
              ?>  
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-sm-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <h2 class="panel-title pull-left">Clientes Vencidos</h2>
      </div>
      <div class="panel-body ">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Data</th>
              <th>Cliente</th>
              <th>Descrição</th>
              <th>Valor</th>
              <th>Pagar</th>
            </tr>
          </thead>
          <tbody>
              <?php 
                $total = 0;
                foreach ($clientesVencidos as $carne) {
                    echo "<tr>";
                    echo "<td>".date("d/m/Y",strtotime($carne->carVencimento))."</td>";
                    echo "<td>$carne->cliNome</td>";
                    echo "<td>$carne->carDescricao</td>";
                    echo "<td>R$ ",number_format($carne->carValor,2,',','.')."</td>";
                    echo "<td><a href=".site_url('c_carne_clientes/registrarPagamento/'.$carne->carId)." class='button tiny'>Pagar</a></td>";
                    echo "</tr>" ;
                    $total += $carne->carValor;
                }
                echo "<tr>";
                echo "<th colspan='4'>Total Em aberto</th>";
                echo "<th>R$ ",number_format($total,2,',','.')."</th>";
                echo "</tr>" ;
              ?>  
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>