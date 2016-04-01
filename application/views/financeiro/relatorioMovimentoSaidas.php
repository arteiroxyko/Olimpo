<style type="text/css">
  .label{
    margin-left: 3px;
  }
</style>
<script type="text/javascript">
  function filtroDate(e){
    e.preventDefault();
    var url = '<?php echo site_url("c_financeiro/ralatorioMovimentosSaida"); ?>';
    var date = document.getElementById('filtro').value;
    window.location.href = url+'/'+date;
  }
</script>

<div class="col-md-12 ">
  <div class="panel panel-default">
    <div class="panel-heading clearfix">
      <div class="form-inline">
        <form method="post" class="form-group input-group-sm">
        <?php 
          $day = $this->uri->segment(3);
          $month = $this->uri->segment(4);
          $year = $this->uri->segment(5);
          if(!empty($day)){
            $date = $day."/".$month."/".$year;
          }else{
            $date = "";
          }
        ?>
          <input name="dia" type="filtrar" value="<?php echo empty($date)?"":$date ?>" class="form-control tpData" id="filtro" placeholder="Data">
          <button onclick="filtroDate(event)" class="btn btn-default btn-sm">Filtrar</button>
          <button type="submit" class="btn btn-default btn-sm" formaction="<?php echo site_url("c_financeiro/imprimir_relatorio_dia_saidas"); ?>">Relatório do Dia</button>
          <button type="submit" class="btn btn-default btn-sm" formaction="<?php echo site_url("c_financeiro/imprimir_relatorio_mes_saidas"); ?>">Relatório do Mês</button>
        </form>
      </div>
    </div>
  </div>
<br>
  <div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#dia" aria-controls="d" role="dia" data-toggle="tab">Dia</a></li>
    <li role="presentation"><a href="#mes" aria-controls="mes" role="tab" data-toggle="tab">Mês</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="dia">
      <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <h2 class="panel-title pull-left">Saidas do dia - <?php echo $conta[0]->conNome ?></h2>
        </div>
        <div class="panel-body ">
          <table class="table table-hover dataTables">
            <thead>
              <tr>
                <th>Data</th>
                <th>Descrição</th>
                <th>Categoria</th>
                <th>Valor</th>
                <th>Editar</th>
              </tr>
            </thead>
            <tbody>
                <?php 
                  $total = 0;
                  foreach ($movimentosDia as $row) {
                      echo "<tr>";
                      echo "<td>".date("d/m/Y",strtotime($row->rsData))."</td>";
                      echo "<td>$row->rsDescricao</td>";
                      echo "<td>$row->rcNome</td>";
                      echo "<td>R$ ".number_format($row->rsValor,2,',','.')."</td>";
                      echo "<td><a href=".site_url('c_financeiro/editarSaida/'.$row->rsId)." class='button tiny'>Editar</a></td>";
                      echo "</tr>" ;
                      $total +=$row->rsValor;
                  }
                  echo "<tr>";
                  echo "<td colspan='4'>Total</td>";
                  echo "<td>R$ ".number_format($total,2,',','.')."</td>";
                  echo "</tr>" ;
                ?>  
            </tbody>
          </table>
        </div>
      </div>
      </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="mes">
      ﻿<div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <h2 class="panel-title pull-left">Saidas do mês - <?php echo $conta[0]->conNome; ?></h2>
        </div>
        <div class="panel-body ">
          <?php  
            foreach ($movimentosPorCategoria as $row){
              echo '<span class="label label-default">'.$row->rcNome.' - R$'.number_format($row->valor,2,',','.').'</span>';
            }
          ?>
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Data</th>
                <th>Descrição</th>
                <th>Categoria</th>
                <th>Valor</th>
                <th>Editar</th>
              </tr>
            </thead>
            <tbody>
                <?php 
                  $total = 0;
                  foreach ($movimentosMes as $alunos) {
                      echo "<tr>";
                      echo "<td>".date("d/m/Y",strtotime($alunos->rsData))."</td>";
                      echo "<td>$alunos->rsDescricao</td>";
                      echo "<td>$alunos->rcNome</td>";
                      echo "<td>R$ ".number_format($alunos->rsValor,2,',','.')."</td>";
                      echo "<td><a href=".site_url('c_financeiro/editarSaida/'.$alunos->rsId)." class='button tiny'>Editar</a></td>";
                      $total +=$alunos->rsValor;
                  }
                  echo "<tr>";
                  echo "<td colspan='4'>Total</td>";
                  echo "<td>R$ ".number_format($total,2,',','.')."</td>";
                  echo "</tr>" ;
                ?>  
            </tbody>
          </table>
        </div>
      </div>
      </div>
  </div>

</div>
</div>