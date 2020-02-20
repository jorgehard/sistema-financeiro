<?php
include("../config.php");
include("../validar_session.php");
getData();
getNivel();
?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-63177007-2', 'auto');
  ga('send', 'pageview');
  
	$(document).ready(function(){
		
		$(".decimal").maskMoney({precision:2});
		$('.sel').multiselect({
			buttonClass: 'btn btn-sm', 
			numberDisplayed: 1,
			maxHeight: 500,
			includeSelectAllOption: true,
			selectAllText: "Selecionar todos",
			enableFiltering: true,
			enableCaseInsensitiveFiltering: true,
			selectAllValue: 'multiselect-all',
			buttonWidth: 'auto'
		}); 
	});
</script>
<style>
	.btn-sm2 {
		margin: 10px !important;
		background-color:#FDFDFD !important;
		color:#092A5D;
		width:110px;
		height:80px;
		padding-top:15px;
	}
	.ds-button{
		 padding:20px 0px 0px 40px;
	}
	.lg {
		font-size:28px;
	}
	body {
		background: url("../imagens/bg-dash.jpg") repeat center 20%;
		-moz-background-size: cover; -webkit-background-size: cover; -o-background-size: cover; background-size: cover;
	}
	.navbar-nav > li > a:hover, .navbar-default .navbar-nav > li > a:focus {
		color: #6b6e6f;
		background:#eaeaea;
		border-top-right-radius:10px;
		border-top-left-radius:10px;
	}
	.active-nav{
		color: #000;
		background:#eaeaea;
		-webkit-box-shadow: 0px -4px 24px -8px rgba(87,87,87,1);
		-moz-box-shadow: 0px -4px 24px -8px rgba(87,87,87,1);
		box-shadow: 0px -4px 24px -8px rgba(87,87,87,1);
		border-top-right-radius:20px;
		border-top-left-radius:20px;
		opacity:0.7;
	}
	.navbar-nav > li > a {
		color:#6b6e6f;
	}
	.ano-style{
		border:none;
		border-radius:5px;
		padding:5px 10px 5px 10px;
		font-size:20px;
		margin-left:30px;
		font-family: 'Oswald', sans-serif;
		background-color:transparent;
	}
	@media (min-width: 1199px) and (max-width: 1350px){
		.ds-button{
			padding:0px !important;
		}
		.icon-pole{
			margin-bottom:10px;
		}
		.button-index{
			margin: 5px;
		}
		.button-index a{
			font-size:12px !important;
		}
		.msg-alert{
			margin-left:20px !important;
			width:30% !important;
		}
	}
	@media (min-width: 900px) and (max-width: 1199px){
		.db-pricing-eleven .price{
			font-size:3.5em;
		}
		.db-pricing-eleven .type{
			font-size:1.5em;
		}
		.button-index a{
			font-size:12px !important;
		}
		.msg-alert .alert h5{
			font-size:12px;
		}
	}
	@media (min-width: 650px) and (max-width: 900px){
		.db-pricing-eleven .price{
			font-size:2.5em;
		}
		.db-pricing-eleven .type{
			font-size:1.3em;
		}
		.button-index a{
			font-size:12px !important;
		}
		.button-index i{
			font-size:25px;
		}
		.msg-alert .alert h5{
			font-size:12px;
		}
	}
		@media (max-width: 650px){
			.top-dash{
				position:absolute;
				top:20px;
				left:-40px;
				padding: 0px; margin:0px;
			}
			.icon-pole{
				position:relative;
				left:25px;
			}
			.container-fluid{
				margin:0px;
			}
			.button-index a{
				font-size:10px !important;
				width:90px;
				margin:0px;
			}
			.button-index span, i{
				margin-bottom:10px;
			}
			.button-index i{
				font-size:25px;
			}
			.ds-button{
				margin-left:-20px;
				
			}
		}
</style>

<?php
	if($atu=='ac'){
		echo '<b style="font-size:14px;">Contrato: </b>';
			echo '<select name="ob[]" style="width:250px;" class="sel" multiple="multiple">';
					$obrasql2 = mysql_query("select * from notas_obras where cidade IN($cidade) AND status = '0' order by descricao asc");
					while($o = mysql_fetch_array($obrasql2)) {
						echo '<option value="'.$o['id'].'" selected>'.$o['descricao'].'</option>';
					}
			echo '</select>';
		exit;
	}
	if($ac == 'listarGrafico1'){
		$se1 = "data";
		$se2 = "options";
		$se3 = "chart";
		$se4 = "chart_div";
		foreach($ob as $obs) { @$obu .= $obs.','; } $obra_r = substr($obu,0,-1); 
		foreach($ci as $cis) { @$ciu .= $cis.','; } $cidade = substr($ciu,0,-1); 
		$obra_nomes = mysql_query("SELECT descricao FROM notas_obras WHERE id IN($obra_r)");
		while($ok = mysql_fetch_array($obra_nomes)){
			$nomes_obras .= $ok['descricao'].' & ';
		}
		$nomes_obras = substr($nomes_obras, 0, -3);
?>
		<a href="imprimir-grafico.php?cidade=<?php echo $cidade; ?>&obra_r=<?php echo $obra_r; ?>&ano=<?php echo $ano ?>" target="_blank" style="letter-spacing:5px; position:relative; bottom:20px" class="pull-right btn btn-warning btn-sm"> 
			<span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Imprimir
		</a>
		<script type="text/javascript">
		  google.charts.load('current', {'packages':['corechart']});
		  google.charts.setOnLoadCallback(drawChart2);

			function drawChart2() {
				var <?php echo $se1 ?> = google.visualization.arrayToDataTable([
				['Medicao', 'Medido CSI', 'Valor Pago'],
          <?php
					$ae_medicao = mysql_query("SELECT SUM(valor_sabesp_d + valor_sabesp_i) as valor_reajuste_total, medicao as medicao_grafico FROM ae_medicao WHERE obra in($obra_r) GROUP BY medicao ORDER BY medicao DESC LIMIT 12");
					while($c = mysql_fetch_array($ae_medicao)){ extract($c);
					
						$total_se_geral_grafico_med = mysql_result(mysql_query("select ss_se.servico, sum(ss_se.qtd * (SELECT preco FROM ss_itens WHERE id = ss_se.servico)) as sum_total FROM ss_se inner join ss_principal ON ss_se.cod_ss = ss_principal.id WHERE ss_principal.medicao = '$medicao_grafico' and ss_principal.obra IN($obra_r) "),0,"sum_total");
						if($total_se_geral_grafico_med == ''){ $total_se_geral_grafico_med = 0.0; }
						echo "['$medicao_grafico', $valor_reajuste_total, $total_se_geral_grafico_med],";
					}
				?>
				]);
				var <?php echo $se2 ?> = {
					title: '<?php echo $nomes_obras ?>',
					curveType: 'function',
					backgroundColor: '#f3f3f3',
					legend: { position: 'right' },
					series: {
						0: { color: '#0a004c' },
						1: { color: '#0abbfe' },
						2: { color: '#FF0000' }
					},
					hAxis: {
					  title: 'Medicao'
					},
					vAxis: {
					  title: 'Valor R$'
					}
				};

				var <?php echo $se3 ?> = new google.visualization.LineChart(document.getElementById('<?php echo $se4 ?>'));
				<?php echo $se3 ?>.draw(<?php echo $se1 ?>, <?php echo $se2 ?>);
			}
		</script>
		<div class="container-fluid">
			<div class="col-md-12" style="margin-bottom:20px">
				<div id="<?php echo $se4 ?>" style="width: 100%; height: 400px;"></div>
			</div>
		</div>
		<div class="container-fluid">
			<table class="table table-bordered table-condensed table-striped" style="background:#FFF;"> 
			<?php
				// - DATA REF - //
				$ae_medicao = mysql_query("SELECT SUM(valor_sabesp_d + valor_sabesp_i) as valor_reajuste_total, medicao as medicao_grafico FROM ae_medicao WHERE obra in($obra_r) GROUP BY medicao ORDER BY medicao DESC LIMIT 12");
				echo '<tr>';
					echo '<td class="active" style="text-align:center"><b style="font-size:10px">MÊS</b></td>';
					while($c = mysql_fetch_array($ae_medicao)){ extract($c);
						echo '<td style="text-align:center"><b><span class="text-success">'.$medicao_grafico.'</b></td>';
						$medicao_geral .= $medicao_grafico.",";
					}
					$medicao_geral = substr($medicao_geral,0,-1);
					echo '<td class="active" style="text-align:center"><b style="font-size:10px">SALDO</b></td>';
				echo '</tr>';
			
				// - MEDIDO CSI - //
				$ae_medicao = mysql_query("SELECT SUM(valor_sabesp_d + valor_sabesp_i) as valor_reajuste_total FROM ae_medicao WHERE obra in($obra_r) GROUP BY medicao ORDER BY medicao DESC LIMIT 12");
				echo '<tr>';
					echo '<td class="active" style="text-align:center"><b style="font-size:10px">MEDIDO CSI</b></td>';
					while($c = mysql_fetch_array($ae_medicao)){ extract($c);
						echo '<td style="text-align:center"><b><span class="text-success">'.number_format($valor_reajuste_total,2,",",".").'</b></td>';
						$valor_total_anual_reajuste += $valor_reajuste_total;
					}
					echo '<td class="active" style="text-align:center"><b>'.number_format($valor_total_anual_reajuste,2,",",".").'</b></td>';
				echo '</tr>';
				//EXECUTADO
				echo '<tr>';
					echo '<td class="active" style="text-align:center"><b style="font-size:10px">VALOR PAGO</b></td>';
					$medicao_geral = explode(",",$medicao_geral);
					foreach ($medicao_geral as $medicao_array) {
					  $sql21 = mysql_query("select ss_se.servico, sum(ss_se.qtd * (SELECT preco FROM ss_itens WHERE id = ss_se.servico)) as sum_total FROM ss_se inner join ss_principal ON ss_se.cod_ss = ss_principal.id WHERE ss_principal.medicao = '$medicao_array' and ss_principal.obra IN($obra_r)");
					  while($la = mysql_fetch_array($sql21)) {		
						$total_se_g += $la['sum_total'];
						echo '<td style="text-align:center">'.number_format($la['sum_total'],2,",",".").'</td>';
					  }
					}
					echo '<td class="active" style="text-align:center"><b>'.number_format($total_se_g,2,",",".").'</b></td>';
				echo '</tr>';
				//DIFERENÇA
				$ae_medicao = mysql_query("SELECT SUM(valor_sabesp_d + valor_sabesp_i) as valor_reajuste_total, medicao as medicao_grafico FROM ae_medicao WHERE obra in($obra_r) GROUP BY medicao ORDER BY medicao DESC LIMIT 12");
				echo '<tr>';
					echo '<td class="active" style="text-align:center"><b style="font-size:10px">DIFERENÇA</b></td>';
					while($lc = mysql_fetch_array($ae_medicao)){
						$medicao_grafico_2 = $lc['medicao_grafico'];
						$total_se_geral_grafico_med = mysql_result(mysql_query("select ss_se.servico, sum(ss_se.qtd * (SELECT preco FROM ss_itens WHERE id = ss_se.servico)) as sum_total FROM ss_se inner join ss_principal ON ss_se.cod_ss = ss_principal.id WHERE ss_principal.medicao = '$medicao_grafico_2' and ss_principal.obra IN($obra_r) "),0,"sum_total");
						
						$total_diferenca = $total_se_geral_grafico_med - $lc['valor_reajuste_total'];
						echo '<td style="text-align:center"><b><span class="text-warning">'.number_format($total_diferenca,2,",",".").'</b></td>';
						$valor_total_diferenca += $total_diferenca;
					}
					echo '<td class="active" style="text-align:center"><b>'.number_format($valor_total_diferenca,2,",",".").'</b></td>';
				echo '</tr>';
			echo '</table>';
		echo '</div>';
	exit; 
} 
?>
<div class="row">
	<h4 style="font-family: 'Oswald', sans-serif; text-align:center; width:100%"><span class="glyphicon glyphicon-calendar" aria-hidden="true" style="margin-right:20px;"></span>GRAFICO - CONFERENCIA DE <b>MEDICAO</b></h4>
		<div class="row">
			<div class="callout-dark text-center fade-in-b" style="margin-bottom:30px">
				<h2 style="color:#021652">
					<div class="well well-sm">
						<form action="javascript:void(0)" onSubmit="posti(this,'gestor/grafico-contrato-med.php?ac=listarGrafico1','.grafico1');" class="form-inline">
							<label style="margin-right:10px;">
								<b style="font-size:14px;">Obra: </b>
								<select name="ci[]" onChange="$('#contrato').load('gestor/grafico-contrato-med.php?atu=ac&cidade=' + $(this).val() + '');" style="width:250px;" class="sel" multiple="multiple" required> 
									<?php
										$sql = mysql_query("select * from notas_obras_cidade where id IN($cidade_usuario) order by nome asc") or die(mysql_error());
										while($o = mysql_fetch_array($sql)) {
											echo '<option value="'.$o['id'].'" selected>'.$o['nome'].'</option>';
										}
									?>	
								</select>
							</label>
							<label id="contrato" style="margin-right:10px;">
								<b style="font-size:14px;">Contrato: </b>
								<select name="ob[]" class="sel" multiple="multiple" required>
									<?php
										$obrasql2 = mysql_query("select * from notas_obras where id IN($obra_usuario) AND status = '0' order by descricao asc") or die(mysql_error());
										while($o = mysql_fetch_array($obrasql2)) {
											echo '<option value="'.$o['id'].'" selected>'.$o['descricao'].'</option>';
										}
									?>	
								</select>
							</label>
							<label style="margin-right:20px;">
								<b style="font-size:14px;">Ano: </b>
								<select name="ano" class="sel" style="margin-top:10px">
									<option value="2018"> 2018</option>
									<option value="2017"> 2017</option>
									<option value="2016"> 2016</option>
								</select>
							</label>
							<label>
								<button type="submit" id="graficoButton" class="btn btn-success btn-sm" style="margin-left:10px; width:100px"><span class="glyphicon glyphicon-search"></span></button>
							</label>
						</form>
					</div>
				</h2>
			</div>
		</div>
		<div class="row" style="background:transparent; padding:20px;">
			<div class="grafico1"> </div>
		</div>
</div>