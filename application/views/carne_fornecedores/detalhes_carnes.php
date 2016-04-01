<div class="col-md-12">
<div class="panel panel-default">
  <div class="panel-heading clearfix">
    <h2 class="panel-title pull-left">Carne Detalhamento</h2>
    <a href="<?php echo site_url('c_carne_fornecedores/cadastrarParcelas/'.$carnes[0]->fcNum)?>" class="btn btn-default btn-sm pull-right">Nova Parcela</a>
    <a href="<?php echo site_url('c_carne_fornecedores/excluir_carne/'.$carnes[0]->fcNum)?>" class="btn btn-default btn-sm pull-right">Excluir Carne</a>
    <a href="<?php echo site_url('c_carne_fornecedores/gerenciador')?>" class="btn btn-default btn-sm pull-right">Voltar</a>
  </div>
  <div class="panel-body ">
    <fieldset>
      <legend>Aluno</legend>
      <ul class="list-inline">
        <li><b>Empresa:</b><?php echo $carnes[0]->forNome; ?></li>
        <li><b>Descricao:</b><?php echo $carnes[0]->fcDescricao; ?></li>
        <li><b>Telefones:</b><?php echo $carnes[0]->forTelefone1." - ".$carnes[0]->forTelefone2; ?></li>
      </ul>
    </fieldset>
    <form method='post' action="<?php echo site_url('c_carne_fornecedores/excluir_parcelas'); ?>">
    <input type="hidden" name="carne" value="<?php echo $carnes[0]->fcNum; ?>">
    <table class="table table-hover dataTables">
      <thead>
        <tr>
          <th><input type="checkbox"/></th>
          <th>Parcela</th>
          <th>Data</th>
          <th>valor</th>
          <th>Valor Vencido</th>
          <th>pago</th>
          <th>ações</th>
        </tr>
      </thead>
      <tbody>
          <?php 
            $hoje = date("Ymd",time());
            foreach ($carnes as $carne) {
              $vencimento = date("Ymd",strtotime($carne->fcVencimento));
              $class = "";
              $class = (($hoje<$vencimento)?$class:"class='danger'");
              $class = (($carne->fcPago==0)?$class:"class='success'");
                echo "<tr ".$class.">";
                if ($carne->fcPago==0){
                  echo "<th> <input type='checkbox' value='$carne->fcId' name='parcelas[]' /> </th>";
                }else{
                  echo "<td></td>";
                }
                echo "<td>$carne->fcParcela</td>";
                echo "<td>".date("d/m/Y",strtotime($carne->fcVencimento))."</td>";
                echo "<td>".number_format($carne->fcValor,2,',','.')."</td>";
                echo "<td>".number_format($carne->fcValorVencido,2,',','.')."</td>";
                echo "<td>".(($carne->fcPago==0)?"Não":"Sim")."</td>";
                if ($carne->fcPago==0){
                  echo "<td><a href=".site_url('c_carne_fornecedores/registrarPagamento/'.$carne->fcId)." class='btn btn-default btn-xs glyphicon glyphicon-usd'></a>";
                  echo "<a href=".site_url('c_carne_fornecedores/editarParcelas/'.$carne->fcId)." class='btn btn-default btn-xs tiny glyphicon glyphicon-pencil'></a></td>";
                }else{
                  echo "<td></td>";
                }
              echo "</tr>" ;
            }
          ?>  
      </tbody>
    </table>
    <button type="submit" class="btn btn-default btn-xs">Excluir selecionados</button>
  </form>
  </div>
</div>
</div>