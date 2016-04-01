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
					      $day = $this->uri->segment(3);
					      $month = $this->uri->segment(4);
					      $year = $this->uri->segment(5);
					      if(!empty($month)){
					        $date = $day."/".$month."/".$year;
					      }else{
					        $date = date('d/m/Y');
					      }
					    ?>
			      		<input type="filtrar" value="<?php echo empty($date)?"":$date ?>" class="form-control tpData" id="filtro" placeholder="Data">
		    		</div>
			    	<button type="submit" onclick="filtroDate()" class="btn btn-default btn-sm">Filtrar</button>
		  		</div>
			</div>
		</div>
	</div>
	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
		<h3>Entradas - <?php echo $date ?></h3>
		<?php 
			$totalEntradas = 0;
			foreach ($entradasPorCategoria as $key => $value) {
				echo '<div class="col-md-12">';
				echo '<div class="panel panel-default">';
				echo '<div class="panel-heading" role="tab" id="headingOne">';
				echo '<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$value->rcid.'" aria-controls="collapse'.$value->rcid.'">';
				echo '<label class="panel-title">';
				echo $value->rcNome;
				echo '</label>';
				echo '<label class="pull-right">R$ '.number_format($value->valor,2,',','.')."<label>";
				echo '</a>';
				echo '</div>';
				echo '<div id="collapse'.$value->rcid.'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">';
				echo '<div class="panel-body" style="padding:0">';
				echo "<table class='table table-striped table-condensed'>";
				foreach ($entradas as $key2 => $row) {
					if($row->rcid == $value->rcid){
						echo "<tr>";
						echo "<td>";
						echo $row->conNome;
						echo "</td>";
						echo "<td>";
						echo $row->turNome;
						echo "</td>";
						echo "<td>R$ ";
						echo number_format($row->valor,2,',','.');
						echo "</td>";
						echo "</tr>";
						$totalEntradas += $row->valor;
						}
				}
				echo "</table>";
				echo '</div>';
				echo '</div>';
				echo '</div>';
				echo '</div>';
			}
			echo '<hr></hr>';
		?>
	</div>
	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
		<h3>Saidas- <?php echo $date ?></h3>
		<?php 
			$totalSaidas = 0;
			foreach ($saidasPorCategoria as $key => $value) {
				echo '<div class="col-md-12">';
				echo '<div class="panel panel-default">';
				echo '<div class="panel-heading" role="tab" id="headingOne">';
				echo '<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$value->rcid.'" aria-controls="collapse'.$value->rcid.'">';
				echo '<label class="panel-title">';
				echo $value->rcNome;
				echo '</label>';
				echo '<label class="pull-right">R$ '.number_format($value->valor,2,',','.')."<label>";
				echo '</a>';
				echo '</div>';
				echo '<div id="collapse'.$value->rcid.'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">';
				echo '<div class="panel-body" style="padding:0">';
				echo "<table class='table table-striped table-condensed'>";
				foreach ($saidas as $key2 => $row) {
					if($row->rcid == $value->rcid){
						echo "<tr>";
						echo "<td>";
						echo $row->conNome;
						echo "</td>";
						echo "<td>";
						echo $row->turNome;
						echo "</td>";
						echo "<td>R$ ";
						echo number_format($row->valor,2,',','.');
						echo "</td>";
						echo "</tr>";
						$totalSaidas += $row->valor;
					}
				}
				echo "</table>";
				echo '</div>';
				echo '</div>';
				echo '</div>';
				echo '</div>';
			}
			echo '<hr></hr>';
			echo '<div class="clearfix"><h4 class="pull-right" style="margin-right:10px">Total Entradas <span class="label label-primary ">R$ '.number_format($totalEntradas,2,',','.').'</span></h4></div>';
			echo '<div class="clearfix"><h4 class="pull-right" style="margin-right:10px">Total Saidas <span class="label label-primary ">R$ '.number_format($totalSaidas,2,',','.').'</span></h4></div>';
			$diferenca = $totalEntradas-$totalSaidas;
			if ($diferenca<0) {
				echo '<div class="clearfix"><h4 class="pull-right" style="margin-right:10px">Diferença <span class="label label-danger ">R$ '.number_format($diferenca,2,',','.').'</span></h4></div>';
			}else{
				echo '<div class="clearfix"><h4 class="pull-right" style="margin-right:10px">Diferença <span class="label label-success ">R$ '.number_format($diferenca,2,',','.').'</span></h4></div>';
			}
		?>
	</div>