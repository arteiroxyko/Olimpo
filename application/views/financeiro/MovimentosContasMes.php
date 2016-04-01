<style type="text/css">
  .label{
    margin-left: 3px;
  }
</style>
<script type="text/javascript">
  function filtroDate(){
    var url = '<?php echo site_url("c_financeiro/".$this->uri->segment(2)); ?>';
    var date = document.getElementById('filtro').value;
    window.location.href = url+'/'+date;
  }
</script>
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading clearfix">
		  		<div class="form-inline">
			    	<div class="form-group input-group-sm">
					    <?php 
					      $month = $this->uri->segment(3);
					      $year = $this->uri->segment(4);
					      if(!empty($month)){
					        $date = $month."/".$year;
					      }else{
					        $date = date('m/Y');
					      }
					    ?>
		      			<input type="filtrar" value="<?php echo empty($date)?"":$date ?>" class="form-control tpDataMes" id="filtro" placeholder="Data">
		    		</div>
				    <button type="submit" onclick="filtroDate()" class="btn btn-default btn-sm">Filtrar</button>
			  	</div>
			</div>
		</div>
	</div>
	<div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <h2 class="panel-title pull-left">Resumo Por Contas</h2>
        </div>
        <div class="panel-body ">
          <table class="table table-hover dataTables">
            <thead>
              <tr>
                <th>Conta</th>
                <th>Entradas</th>
                <th>Saidas</th>
                <th>Diferença</th>
              </tr>
            </thead>
            <tbody>
                <?php 
                  $total = 0; 
                  foreach ($resumo as $row) {
                      echo "<tr>";
                      echo "<td>".$row->conNome."</td>";
                      echo "<td>R$ ".number_format($row->entradas,2,',','.')."</td>";
                      echo "<td>R$ ".number_format($row->saidas,2,',','.')."</td>";
                      echo "<td>R$ ".number_format($row->entradas - $row->saidas,2,',','.')."</td>";
                      echo "</tr>" ;
                  }
                ?>  
            </tbody>
          </table>
        </div>
      </div>
      </div>