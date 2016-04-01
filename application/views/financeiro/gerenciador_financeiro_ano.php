<div class="col-md-6">
	<div class="panel panel-default">
		<div class="panel-heading clearfix">
			Grafico de movimentações de <?php echo $ano; ?>
		</div>
		<div class="panel-body">
			<div>
				<canvas id="canvas" height="600" width="800"></canvas>
			</div>
		</div>
	</div>
</div>
<script>
	var barChartData = {
		labels : [
			<?php 
				if (count($entradas_mv) > count($saidas_mv)){
					foreach ($entradas_mv as $value) {
						echo "'".$value->reData."',";
					}	
				}else{
					foreach ($saidas_mv as $value) {
						echo "'".$value->rsData."',";
					}	
				}
			?>
		],
		datasets : [
			{
				fillColor : "rgba(110,255,110,0.5)",
				strokeColor : "rgba(110,255,110,0.8)",
				highlightFill: "rgba(110,255,110,0.75)",
				highlightStroke: "rgba(110,255,110,1)",
				data : [
						<?php 
							if (count($entradas_mv) > count($saidas_mv)){
								foreach ($entradas_mv as $value) {
									echo "'".$value->reValor."',";
								}
							}else{
								foreach ($saidas_mv as $car) {
									$encontrou = False;
									foreach ($entradas_mv as $value) {
										if ($value->reData == $car->rsData){
											echo "'".$value->reValor."',";
											$encontrou = true;
										}
									}
									if (!$encontrou){
										echo "'0',";
									}
								}
							}
						?>

				]
			},
			{
				fillColor : "rgba(255,110,110,0.5)",
				strokeColor : "rgba(255,110,110,0.8)",
				highlightFill: "rgba(255,110,110,0.75)",
				highlightStroke: "rgba(255,110,110,1)",
				data : [
						<?php 
							if (count($entradas_mv) > count($saidas_mv)){
								foreach ($entradas_mv as $ec) {
									$encontrou = False;
									foreach ($saidas_mv as $value) {
										if ($value->rsData == $ec->reData){
											echo "'".$value->rsValor."',";
											$encontrou = true;
										}
									}
									if (!$encontrou){
										echo "'0',";
									}
								}
							}else{
								foreach ($saidas_mv as $value) {
									echo "'".$value->rsValor."',";
								}
							}
						?>
				]
			}
		]

	}
	var ctx = document.getElementById("mv_canvas").getContext("2d");
	window.myBar = new Chart(ctx).Bar(barChartData, {
		responsive : true
	});
</script>
