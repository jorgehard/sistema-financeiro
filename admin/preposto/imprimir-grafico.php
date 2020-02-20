<?php 
include("../validar_session.php"); 
include("../config.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
    <title>Polêmica Construtora</title>
	<link rel="stylesheet" href="../../css/css.css?v1"/>
	<link rel="stylesheet" href="../../css/bootstrap.css"/>
	<link rel="stylesheet" href="../../css/jquery-ui.css"/>
	<link rel="icon" href="../../imagens/logo.ico" type="image/x-icon"/>
	<link rel="shortcut icon" href="../../imagens/logo.ico" type="image/x-icon"/>
	
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<style>
		table, tr, thead, tbody, td, th{
			border:1px solid rgba(23, 23, 23, 0.6) !important;
		}
	</style>
</head>
<script>window.onload = function() { window.print(); }</script>
<div class="col-md-12" style="margin:0 auto; text-align:center">
	<a href="#" class="btn btn-danger btn-xs hidden-print" style="width:60%; margin-top:10px; padding:50px; font-size:15px; font-weight:bold; margin-bottom:30px;" onclick="javascript:window.close()">Fechar</a>
</div>
<?php
	$se1 = "data";
	$se2 = "options";
	$se3 = "chart";
	$se4 = "chart_div";
	$obra_nomes = mysql_query("SELECT descricao FROM notas_obras WHERE id IN($obra_r)");
	while($ok = mysql_fetch_array($obra_nomes)){
		$nomes_obras .= $ok['descricao'].' & ';
	}
	$nomes_obras = substr($nomes_obras, 0, -3);
		echo '<table width="100%" style="margin-bottom:20px">';
		echo '<tr>
		<td style="padding:10px; text-align:center" width="10%"><img src="http://guaruja.polemicalitoral.com.br/imagens/logo.png" alt="Logo Polemica" width="50px" /></td>
		<td style="font-size:10px; padding-left:20px;" width="95%">
			<p class="pull-right" style="text-align: right; padding:10px 20px 10px 10px;">
				<b>POLÊMICA SERVIÇOS BÁSICOS LTDA.</b><br/>
				Rua Euclides Miragaia, 700, Salas 82 e 83 - Centro - CEP 12245-820 <br/>
				São José dos Campos - SP - TELEFAX (12) 3941-8555<br/>
				Inscrição Municipal Nº 66.133/3<br/>
				Inscrição Estadual - 645.412.590.115<br/>
			</p>
		</td>
		</tr>';
		echo '</table>';
?>
		<script type="text/javascript">
		  google.charts.load('current', {'packages':['corechart']});
		  google.charts.setOnLoadCallback(drawChart);

			function drawChart() {
				var <?php echo $se1 ?> = google.visualization.arrayToDataTable([
					<?php if($obra_r == '23'){ ?>
                        ['Mes', 'Faturamento', 'Despesas'],
                    <?php }else{ ?>
                        ['Mes', 'Faturamento', 'Executado', 'Despesas'],
                    <?php
                      }
					$ae_medicao = mysql_query("SELECT SUM(valor_reajuste_d + valor_reajuste_i) as valor_reajuste_total, data_ref, SUM(valor_despesas) as valor_despesas FROM ae_medicao WHERE (valor_reajuste_d <> '0.00' OR valor_reajuste_i <> '0.00') AND parcial = '0' and obra IN($obra_r) AND (data_ref BETWEEN '".$ano."-01' AND '".$ano."-12') GROUP BY data_ref");
                    while($c = mysql_fetch_array($ae_medicao)){ extract($c);
						$data_ref = explode("-",$data_ref);
						$inicial_se = $data_ref[0]."-".$data_ref[1]."-01";
						$final_se = $data_ref[0]."-".$data_ref[1]."-31";
						$data_ref = $data_ref[1].'/'.$data_ref[0];
                        $total_se_geral_grafico = mysql_result(mysql_query("select ss_se.servico, sum(ss_se.qtd * (SELECT preco FROM ss_itens WHERE id = ss_se.servico)) as sum_total FROM ss_se inner join ss_principal ON ss_se.cod_ss = ss_principal.id WHERE ss_principal.obra IN($obra_r) AND (ss_se.data between '$inicial_se' and '$final_se')"),0,"sum_total");
						if($obra_r == '23'){
                            echo "['$data_ref', $valor_reajuste_total, $valor_despesas],";
                        }else{
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
		<div style="width:1200px">
			<div class="col-md-12" style="margin-bottom:20px">
				<div id="<?php echo $se4 ?>" style="width: 100%; height: 400px;"></div>
			</div>
		</div>
		<div style="width:100%">
			<table class="table table-bordered table-condensed table-striped" style="background:#FFF;"> 
				<?php
				// - DATA REF - //
				$ae_medicao = mysql_query("SELECT SUM(valor_reajuste_d + valor_reajuste_i) as valor_reajuste_total, data_ref, SUM(valor_despesas) as valor_despesas FROM ae_medicao WHERE (valor_reajuste_d <> '0.00' OR valor_reajuste_i <> '0.00') AND parcial = '0' AND obra IN($obra_r) AND (data_ref BETWEEN '".$ano."-01' AND '".$ano."-12') GROUP BY data_ref");
				echo '<tr>';
					echo '<td class="active" style="text-align:center"><b style="font-size:10px">MÊS</b></td>';
					while($c = mysql_fetch_array($ae_medicao)){ extract($c);
						$data_ref2 = explode("-",$data_ref);
						echo '<td style="text-align:center"><b><span class="text-success">'.$data_ref2[1].'</span> / '.$data_ref2[0].'</b></td>';
						$data_geral .= $data_ref2[1].",";
					}
					$data_geral = substr($data_geral,0,-1);
					echo '<td class="active" style="text-align:center"><b style="font-size:10px">SALDO</b></td>';
				echo '</tr>';
				//EXECUTADO
                if($obra_r != '23') {
                    echo '<tr>';
                    echo '<td class="active" style="text-align:center"><b style="font-size:10px">EXECUTADO</b></td>';
                    $data_geral = explode(",",$data_geral);
                    foreach ($data_geral as $data_array) {
                        $inicial_se = $ano."-".$data_array."-01";
                        $final_se = $ano."-".$data_array."-31";	
                        $sql21 = mysql_query("select ss_se.servico, sum(ss_se.qtd * (SELECT preco FROM ss_itens WHERE id = ss_se.servico)) as sum_total FROM ss_se inner join ss_principal ON ss_se.cod_ss = ss_principal.id WHERE ss_principal.obra IN($obra_r) AND (ss_se.data between '$inicial_se' and '$final_se')");
                        while($la = mysql_fetch_array($sql21)) {		
                            $total_se_g += $la['sum_total'];
                            echo '<td style="text-align:center">R$ '.number_format($la['sum_total'],2,",",".").'</td>';
                        }
                    }
                    echo '<td class="active" style="text-align:center"><b>R$ '.number_format($total_se_g,2,",",".").'</b></td>';
                    echo '</tr>';
                }
				// - FATURADO - // 
				$ae_medicao2 = mysql_query("SELECT SUM(valor_reajuste_d + valor_reajuste_i) as valor_reajuste_total, data_ref, SUM(valor_despesas) as valor_despesas FROM ae_medicao WHERE (valor_reajuste_d <> '0.00' OR valor_reajuste_i <> '0.00') AND parcial = '0' AND obra IN($obra_r) AND (data_ref BETWEEN '".$ano."-01' AND '".$ano."-12') GROUP BY data_ref");
				echo '<tr>';
					echo '<td class="active" style="text-align:center"><b style="font-size:10px">FATURADO</b></td>';
					while($d = mysql_fetch_array($ae_medicao2)){ extract($d);
						$valor_total_anual_reajuste += $valor_reajuste_total;
						echo '<td style="text-align:center">R$ '.number_format($valor_reajuste_total,2,",",".").'</td>';
					}
					echo '<td class="active" style="text-align:center"><b>R$ '.number_format($valor_total_anual_reajuste,2,",",".").'</b></td>';
				echo '</tr>';
				// - DESPESAS - //
				$ae_medicao3 = mysql_query("SELECT SUM(valor_reajuste_d + valor_reajuste_i) as valor_reajuste_total, data_ref, SUM(valor_despesas) as valor_despesas FROM ae_medicao WHERE (valor_reajuste_d <> '0.00' OR valor_reajuste_i <> '0.00') AND parcial = '0' AND obra IN($obra_r) AND (data_ref BETWEEN '".$ano."-01' AND '".$ano."-12') GROUP BY data_ref");
				echo '<tr>';
					echo '<td class="active" style="text-align:center"><b style="font-size:10px">DESPESAS</b></td>';
					while($e = mysql_fetch_array($ae_medicao3)){ extract($e);
						$valor_total_anual_despesas += $valor_despesas;
						echo '<td style="text-align:center">R$ '.number_format($valor_despesas,2,",",".").'</td>';
					}
					
					echo '<td class="active" style="text-align:center"><b>R$ '.number_format($valor_total_anual_despesas,2,",",".").'</b></td>';
				echo '</tr>';
				// - SALDO - //
				$ae_medicao4 = mysql_query("SELECT SUM(valor_reajuste_d + valor_reajuste_i) as valor_reajuste_total, data_ref, SUM(valor_despesas) as valor_despesas FROM ae_medicao WHERE (valor_reajuste_d <> '0.00' OR valor_reajuste_i <> '0.00') AND parcial = '0' AND obra IN($obra_r) AND (data_ref BETWEEN '".$ano."-01' AND '".$ano."-12') GROUP BY data_ref");
				echo '<tr>';
					echo '<td class="active" style="text-align:center"><b style="font-size:10px">TOTAL</b></td>';
					while($f = mysql_fetch_array($ae_medicao4)){ extract($f);
						$acumulado = $valor_reajuste_total - $valor_despesas;
						echo '<td style="text-align:center"><b>R$ '.number_format($acumulado,2,",",".").'</b></td>';
					}
					$valor_total_acumulado = $valor_total_anual_reajuste-$valor_total_anual_despesas;
					echo '<td class="active" style="text-align:center"><b>R$ '.number_format(($valor_total_acumulado),2,",",".").'</b></td>';
				echo '</tr>';
				
				// - SALDO - //
				$ae_medicao5 = mysql_query("SELECT SUM(valor_reajuste_d + valor_reajuste_i) as valor_reajuste_total, data_ref, SUM(valor_despesas) as valor_despesas FROM ae_medicao WHERE (valor_reajuste_d <> '0.00' OR valor_reajuste_i <> '0.00') AND parcial = '0' AND obra IN($obra_r) AND (data_ref BETWEEN '".$ano."-01' AND '".$ano."-12') GROUP BY data_ref");
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
			?>
			</table>
		</div>