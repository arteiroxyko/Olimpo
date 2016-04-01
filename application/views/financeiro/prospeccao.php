<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading clearfix">
			Prospecção para o ano de <?php echo $ano; ?>
		</div>
		<div class="panel-body">
			<div>
				<canvas id="pr_canvas" height="600" width="800"></canvas>
			</div>
		</div>
	</div>
</div>
<script>
	var barChartData = {
		labels : [
			<?php 
				if (count($entradas_pr) > count($saidas_pr)){
					foreach ($entradas_pr as $value) {
						echo "'".$value->carVencimento."',";
					}	
				}else{
					foreach ($saidas_pr as $value) {
						echo "'".$value->fcVencimento."',";
					}	
				}
			?>
		],
		datasets : [
			{
				label: "Entradas",
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
				label: "Entradas Previstas",
				fillColor : "rgba(110,110,255,0.5)",
				strokeColor : "rgba(110,110,255,0.8)",
				highlightFill: "rgba(110,110,255,0.75)",
				highlightStroke: "rgba(110,110,255,1)",
				data : [
						<?php 
							if (count($entradas_pr) > count($saidas_pr)){
								foreach ($entradas_pr as $value) {
									echo "'".$value->carValor."',";
								}
							}else{
								foreach ($saidas_pr as $car) {
									$encontrou = False;
									foreach ($entradas_pr as $value) {
										if ($value->carVencimento == $car->fcVencimento){
											echo "'".$value->carValor."',";
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
				label: "Saidas",
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
			},
			{
				label: "Saidas Previstas",
				fillColor : "rgba(255,255,110,0.5)",
				strokeColor : "rgba(255,255,110,0.8)",
				highlightFill: "rgba(255,255,110,0.75)",
				highlightStroke: "rgba(255,255,110,1)",
				data : [
						<?php 
							if (count($entradas_pr) > count($saidas_pr)){
								foreach ($entradas_pr as $ec) {
									$encontrou = False;
									foreach ($saidas_pr as $value) {
										if ($value->fcVencimento == $fc->carVencimento){
											echo "'".$value->fcValor."',";
											$encontrou = true;
										}
									}
									if (!$encontrou){
										echo "'0',";
									}
								}
							}else{
								foreach ($saidas_pr as $value) {
									echo "'".$value->fcValor."',";
								}
							}
						?>
				]
			}
		]
	}
	var ctx = document.getElementById("pr_canvas").getContext("2d");
	window.myBar = new Chart(ctx).Bar(barChartData, {
		responsive : true
	});
</script>	