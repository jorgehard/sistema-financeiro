<?php
include("../config.php");
include("../validar_session.php");
getData();
getNivel();
?>
<script>
	$(document).ready(function(){
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
		<a href="preposto/imprimir-grafico.php?cidade=<?php echo $cidade; ?>&obra_r=<?php echo $obra_r; ?>&ano=<?php echo $ano ?>" target="_blank" style="letter-spacing:5px; position:relative; bottom:20px" class="pull-right btn btn-warning btn-sm"> 
			<span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Imprimir
		</a>
		<script type="text/javascript">
		  google.charts.load('current', {'packages':['corechart']});
		  google.charts.setOnLoadCallback(drawChart2);

			function drawChart2() {
				var <?php echo $se1 ?> = google.visualization.arrayToDataTable([
          <?php if($obra_r == '23'){ ?>
              ['Mes', 'Faturamento', 'Despesas'],
					<?php
            }else{
          ?>
              ['Mes', 'Faturamento', 'Executado', 'Despesas'],
          <?php
          }
					$ae_medicao = mysql_query("SELECT SUM(valor_reajuste_d + valor_reajuste_i) as valor_reajuste_total, data_ref, SUM(valor_despesas) as valor_despesas FROM ae_medicao WHERE obra in($obra_r) AND (data_ref BETWEEN '".$ano."-01' AND '".$ano."-12') GROUP BY data_ref");
          //(valor_reajuste_d <> '0.00' OR valor_reajuste_i <> '0.00') AND parcial = '0' and
					while($c = mysql_fetch_array($ae_medicao)){ extract($c);
						$data_ref = explode("-",$data_ref);
						$inicial_se = $data_ref[0]."-".$data_ref[1]."-01";
						$final_se = $data_ref[0]."-".$data_ref[1]."-31";
						$data_ref = $data_ref[1].'/'.$data_ref[0];
            if($obra_r == '23'){
                echo "['$data_ref', $valor_reajuste_total, $valor_despesas],";
            }else{
                $total_se_geral_grafico= mysql_result(mysql_query("select ss_se.servico, sum(ss_se.qtd * (SELECT preco FROM ss_itens WHERE id = ss_se.servico)) as sum_total FROM ss_se inner join ss_principal ON ss_se.cod_ss = ss_principal.id WHERE ss_principal.obra IN($obra_r) AND (ss_se.data between '$inicial_se' and '$final_se')"),0,"sum_total");
				
               // $total_se_geral_grafico_med0 = mysql_result(mysql_query("select ss_se.servico, sum(ss_se.qtd * (SELECT preco FROM ss_itens WHERE id = ss_se.servico)) as sum_total FROM ss_se inner join ss_principal ON ss_se.cod_ss = ss_principal.id WHERE ss_principal.medicao IN(0) AND ss_principal.obra IN($obra_r) AND (ss_se.data between '$inicial_se' and '$final_se')"),0,"sum_total");
				
                echo "['$data_ref', $valor_reajuste_total, $total_se_geral_grafico, $valor_despesas],";
            }
						
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
					  title: 'Mês'
					},
					vAxis: {
					  title: 'Valor R$'
					}
				};

				var <?php echo $se3 ?> = new google.visualization.LineChart(document.getElementById('<?php echo $se4 ?>'));
				<?php echo $se3 ?>.draw(<?php echo $se1 ?>, <?php echo $se2 ?>);
			}
		</script>
    <?php echo $alert; ?>
		<div class="container-fluid">
			<div class="col-md-12" style="margin-bottom:20px">
				<div id="<?php echo $se4 ?>" style="width: 100%; height: 400px;"></div>
			</div>
		</div>
		<div class="container-fluid">
			<table class="table table-bordered table-condensed table-striped" style="background:#FFF;"> 
			<?php
				// - DATA REF - //
				$ae_medicao = mysql_query("SELECT SUM(valor_reajuste_d + valor_reajuste_i) as valor_reajuste_total, data_ref, SUM(valor_despesas) as valor_despesas FROM ae_medicao WHERE obra IN($obra_r) AND (data_ref BETWEEN '".$ano."-01' AND '".$ano."-12') GROUP BY data_ref");
				echo '<tr>';
					echo '<td class="active" style="text-align:center"><b style="font-size:10px">MÊS</b></td>';
					while($c = mysql_fetch_array($ae_medicao)){
            extract($c);
						$data_ref2 = explode("-",$data_ref);
						echo '<td style="text-align:center"><b><span class="text-success">'.$data_ref2[1].'</span> / '.$data_ref2[0].'</b></td>';
						$data_geral .= $data_ref2[1].",";
					}
					$data_geral = substr($data_geral,0,-1);
					echo '<td class="active" style="text-align:center"><b style="font-size:10px">SALDO</b></td>';
				echo '</tr>';
				//EXECUTADO
        if($obra_r != '23'){
            echo '<tr>';
            echo '<td class="active" style="text-align:center"><b style="font-size:10px">EXECUTADO</b></td>';
            $data_geral = explode(",",$data_geral);
            foreach ($data_geral as $data_array) {
              $inicial_se = $ano."-".$data_array."-01";
              $final_se = $ano."-".$data_array."-31";	
              $sql21 = mysql_query("select ss_se.servico, sum(ss_se.qtd * (SELECT preco FROM ss_itens WHERE id = ss_se.servico)) as sum_total FROM ss_se inner join ss_principal ON ss_se.cod_ss = ss_principal.id WHERE ss_principal.obra IN($obra_r) AND (ss_se.data between '$inicial_se' and '$final_se')");
              while($la = mysql_fetch_array($sql21)) {		
                $total_se_g += $la['sum_total'];
                echo '<td style="text-align:center">'.number_format($la['sum_total'],2,",",".").'</td>';
              }
            }
            echo '<td class="active" style="text-align:center"><b>'.number_format($total_se_g,2,",",".").'</b></td>';
            echo '</tr>';
            /*echo '<tr>';
            echo '<td class="active" style="text-align:center"><b style="font-size:10px">S/MED</b></td>';
            foreach ($data_geral as $data_array) {
              $inicial_se = $ano."-".$data_array."-01";
              $final_se = $ano."-".$data_array."-31";	
              $sql22 = mysql_query("select ss_se.servico, sum(ss_se.qtd * (SELECT preco FROM ss_itens WHERE id = ss_se.servico)) as sum_total FROM ss_se inner join ss_principal ON ss_se.cod_ss = ss_principal.id WHERE ss_principal.medicao IN(0) and ss_principal.obra IN($obra_r) AND (ss_se.data between '$inicial_se' and '$final_se')");
              while($lb = mysql_fetch_array($sql22)) {		
                $total_se_med0_g += $lb['sum_total'];
                echo '<td style="text-align:center">'.number_format($lb['sum_total'],2,",",".").'</td>';
              }
            }
            echo '<td class="active" style="text-align:center"><b>'.number_format($total_se_med0_g,2,",",".").'</b></td>';
            echo '</tr>'; */
		} 
            // - FATURADO - // 
            $ae_medicao2 = mysql_query("SELECT SUM(valor_reajuste_d + valor_reajuste_i) as valor_reajuste_total, data_ref, SUM(valor_despesas) as valor_despesas FROM ae_medicao WHERE obra IN($obra_r) AND (data_ref BETWEEN '".$ano."-01' AND '".$ano."-12') GROUP BY data_ref");
            echo '<tr>';

					echo '<td class="active" style="text-align:center"><b style="font-size:10px">FATURADO</b></td>';
					while($d = mysql_fetch_array($ae_medicao2)){ extract($d);
						$valor_total_anual_reajuste += $valor_reajuste_total;
						echo '<td style="text-align:center">'.number_format($valor_reajuste_total,2,",",".").'</td>';
					}
					echo '<td class="active" style="text-align:center"><b>'.number_format($valor_total_anual_reajuste,2,",",".").'</b></td>';
				echo '</tr>';
				// - DESPESAS - //
				$ae_medicao3 = mysql_query("SELECT SUM(valor_reajuste_d + valor_reajuste_i) as valor_reajuste_total, data_ref, SUM(valor_despesas) as valor_despesas FROM ae_medicao WHERE obra IN($obra_r) AND (data_ref BETWEEN '".$ano."-01' AND '".$ano."-12') GROUP BY data_ref");
				echo '<tr>';
					echo '<td class="active" style="text-align:center"><b style="font-size:10px">DESPESAS</b></td>';
					while($e = mysql_fetch_array($ae_medicao3)){ extract($e);
						$valor_total_anual_despesas += $valor_despesas;
						echo '<td style="text-align:center">'.number_format($valor_despesas,2,",",".").'</td>';
					}
					
					echo '<td class="active" style="text-align:center"><b>'.number_format($valor_total_anual_despesas,2,",",".").'</b></td>';
				echo '</tr>';
				// - SALDO - //
				$ae_medicao4 = mysql_query("SELECT SUM(valor_reajuste_d + valor_reajuste_i) as valor_reajuste_total, data_ref, SUM(valor_despesas) as valor_despesas FROM ae_medicao WHERE obra IN($obra_r) AND (data_ref BETWEEN '".$ano."-01' AND '".$ano."-12') GROUP BY data_ref");
				echo '<tr>';
					echo '<td class="active" style="text-align:center"><b style="font-size:10px">TOTAL</b></td>';
					while($f = mysql_fetch_array($ae_medicao4)){ extract($f);
						$acumulado = $valor_reajuste_total - $valor_despesas;
						echo '<td style="text-align:center"><b>'.number_format($acumulado,2,",",".").'</b></td>';
					}
					$valor_total_acumulado = $valor_total_anual_reajuste-$valor_total_anual_despesas;
					echo '<td class="active" style="text-align:center"><b>'.number_format(($valor_total_acumulado),2,",",".").'</b></td>';
				echo '</tr>';
				
				// - SALDO - //
				$ae_medicao5 = mysql_query("SELECT SUM(valor_reajuste_d + valor_reajuste_i) as valor_reajuste_total, data_ref, SUM(valor_despesas) as valor_despesas FROM ae_medicao WHERE obra IN($obra_r) AND (data_ref BETWEEN '".$ano."-01' AND '".$ano."-12') GROUP BY data_ref");
				echo '<tr>';
					echo '<td class="active" style="text-align:center"><b style="font-size:10px">Porc % </b></td>';
					while($x = mysql_fetch_array($ae_medicao5)){ extract($x);
						@$acumulado = $valor_reajuste_total - $valor_despesas;
						@$porcentagem = ($acumulado / $valor_reajuste_total)*100;
						echo '<td style="text-align:center">'.($porcentagem > 30 ? '<span class="text-success">'.number_format($porcentagem,2,",",".").'% </span>' : '<span class="text-danger">'. number_format($porcentagem,2,",",".") .'% </span>').'</td>';
					}
					$total_porcentagem = ($valor_total_acumulado / $valor_total_anual_reajuste)*100;
					echo '<td style="text-align:center">'.($total_porcentagem > 30 ? '<span class="text-success">'.number_format($total_porcentagem,2,",",".").'% </span>' : '<span class="text-danger">'. number_format($total_porcentagem,2,",",".") .'% </span>').'</td>';
				echo '</tr>';
				$valor_total_anual_reajuste2 += $valor_total_anual_reajuste;
				$valor_total_anual_despesas2 += $valor_total_anual_despesas;
				$valor_total_acumulado2 += $valor_total_acumulado;
				
				$valor_total_anual_reajuste = 0;
				$valor_total_anual_despesas = 0;
				$valor_total_acumulado = 0;
			echo '</table>';
		echo '</div>';
	exit; 
} 
?>
<div class="row hidden-xs ">
	<h4 style="font-family: 'Oswald', sans-serif; text-align:center; width:100%"><span class="glyphicon glyphicon-calendar" aria-hidden="true" style="margin-right:20px;"></span>GRAFICO - SITUAÇÃO FINANCEIRA <b>CONTRATUAL</b></h4>
		<div class="row">
			<div class="callout-dark text-center fade-in-b" style="margin-bottom:30px">
				<h2 style="color:#021652">
					<div class="well well-sm">
						<form action="javascript:void(0)" onSubmit="posti(this,'preposto/saldo-financeiro.php?ac=listarGrafico1','.grafico1');" class="form-inline">
							<label style="margin-right:10px;">
								<b style="font-size:14px;">Obra: </b>
								<select name="ci[]" onChange="$('#contrato').load('preposto/saldo-financeiro.php?atu=ac&cidade=' + $(this).val() + '');" style="width:250px;" class="sel" multiple="multiple" required> 
									<?php
										$sql = mysql_query("select * from notas_obras_cidade where id IN($cidade_usuario) order by nome asc");
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
										$obrasql2 = mysql_query("select * from notas_obras where id IN($obra_usuario) AND status = '0' order by descricao asc");
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