<?php 
include("../validar_session.php"); 
include("../config.php");
getData();
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
		.dropdown-menu {
			font-size: 15px;
		}
		@media (max-width: 1199px){
			.navbar, .dropdown-menu, .dropdown-header{
				font-size:10px;
			}

		}
		table, tr, thead, tbody, td, th{
			border:1px solid rgba(23, 23, 23, 0.6) !important;
		}
	</style>
</head>
<div class="col-md-12" style="margin:0 auto; text-align:center">
	<a href="#" class="btn btn-danger btn-xs hidden-print" style="width:60%; margin-top:10px; padding:50px; font-size:15px; font-weight:bold; margin-bottom:30px;" onclick="javascript:window.close()">Fechar</a>
</div>
<?php
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
		  google.charts.load('current', {'packages':['bar']});
		  google.charts.setOnLoadCallback(drawChart);

		  function drawChart() {
			var data = google.visualization.arrayToDataTable([
			<?php
				$data_inicio = $todayTotal;
				
				$data_termino = new DateTime($data_inicio);
				$data_termino -> sub(new DateInterval('P1M'));
				$data_termino = $data_termino->format('Y-m');
				
				$data_termino2 = new DateTime($data_termino);
				$data_termino2 -> sub(new DateInterval('P1M'));
				$data_termino2 = $data_termino2->format('Y-m');
				
				$data_termino0 = substr($data_inicio, 0 , -3);
				$string_grafico1 = "'".implode("/",array_reverse(explode("-",$data_termino2)))."', '".implode("/",array_reverse(explode("-",$data_termino)))."', '".implode("/",array_reverse(explode("-",$data_termino0)))."'";
			?>	
			  ['Categorias', <?php echo $string_grafico1 ?>],
			<?php
			$categoria_grafico = mysql_query("SELECT * FROM notas_categorias WHERE id IN($eta) and status = '0'");
			while($cat = mysql_fetch_array($categoria_grafico)){
				echo $oba;
				$total_1 = mysql_result(mysql_query("select SUM(notas_itens_add.quantidade*notas_itens_add.valor) as totalSum FROM notas_nf, notas_itens_add WHERE notas_nf.id = notas_itens_add.nota AND notas_itens_add.categoria = '".$cat['id']."' and notas_nf.obra in ($obra_r) AND (notas_nf.dataxml between '".$data_termino2."-01' and '".$data_termino2."-31') order by notas_itens_add.categoria"),0,"totalSum");
				
				$total_2 = mysql_result(mysql_query("select SUM(notas_itens_add.quantidade*notas_itens_add.valor) as totalSum FROM notas_nf, notas_itens_add WHERE notas_nf.id = notas_itens_add.nota AND notas_itens_add.categoria = '".$cat['id']."' and notas_nf.obra in ($obra_r) AND (notas_nf.dataxml between '".$data_termino."-01' and '".$data_termino."-31') order by notas_itens_add.categoria"),0,"totalSum");
				
				$total_3 = mysql_result(mysql_query("select SUM(notas_itens_add.quantidade*notas_itens_add.valor) as totalSum FROM notas_nf, notas_itens_add WHERE notas_nf.id = notas_itens_add.nota AND notas_itens_add.categoria = '".$cat['id']."' and notas_nf.obra in ($obra_r) AND (notas_nf.dataxml between '".$data_termino0."-01' and '".$data_termino0."-31') order by notas_itens_add.categoria"),0,"totalSum");
				
				if($total_1 == '') { $total_1 = 0; }
				if($total_2 == '') { $total_2 = 0; }
				if($total_3 == '') { $total_3 = 0; }
				echo "['".$cat['descricao']."', $total_1, $total_2, $total_3],";
			}
			?>
			]);

			var options = {
			  chart: {
				title: 'Categoria Itens',
				subtitle: 'Comparativo dos ultimos 3 meses',
			  }
			};

			var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

			chart.draw(data, google.charts.Bar.convertOptions(options));
		  }
		</script>
		<div style="width:1000px">
			<div class="col-md-12" style="margin-bottom:20px">
				<div id="columnchart_material" style="width: 100%; height:400px;"></div>
			</div>
		</div>
		<div class="container-fluid">
			<?php
			
			$inicial = implode("-",array_reverse(explode("/",$inicial))); 
			$final = implode("-",array_reverse(explode("/",$final)));
			//
			$data_inicio = $todayTotal;
			
			$data_termino = new DateTime($data_inicio);
			$data_termino -> sub(new DateInterval('P1M'));
			$data_termino = $data_termino->format('Y-m');
			
			$data_termino2 = new DateTime($data_termino);
			$data_termino2 -> sub(new DateInterval('P1M'));
			$data_termino2 = $data_termino2->format('Y-m');
			
			$data_termino0 = substr($data_inicio, 0 , -3);
			//
			$data_termino_fat1 = new DateTime($data_inicio);
			$data_termino_fat1 -> sub(new DateInterval('P1M'));
			$data_termino_fat1 = $data_termino_fat1->format('Y-m');
			
			$data_termino_fat2 = new DateTime($data_termino_fat1);
			$data_termino_fat2 -> sub(new DateInterval('P1M'));
			$data_termino_fat2 = $data_termino_fat2->format('Y-m');
			
			$data_termino_fat3 = new DateTime($data_termino_fat2);
			$data_termino_fat3 -> sub(new DateInterval('P1M'));
			$data_termino_fat3 = $data_termino_fat3->format('Y-m');
			

			/*echo $data_termino0.' = '.$data_termino_fat1.'<br/>';
			echo $data_termino.' = '.$data_termino_fat2.'<br/>';
			echo $data_termino2.' = '.$data_termino_fat3.'<br/>';*/
			
			
			$categorias = mysql_query("SELECT * FROM notas_categorias WHERE id IN($eta)"); 
			$se = 0; $total_geral = 0;
			
			echo '<table class="table table-min table-striped" style="font-size:18px;">';
			echo '<thead><tr><th>Nº</th><th>Categoria</th>
			<th>'.implode("/",array_reverse(explode("-",$data_termino2))).'</th>
			<th>'.implode("/",array_reverse(explode("-",$data_termino))).'</th>
			<th>'.implode("/",array_reverse(explode("-",$data_termino0))).'</th>
			</tr></thead><tbody>';
			echo '<tr>';
				echo '<td>  </td>';
				echo '<td style="text-align:center">FATURAMENTO BRUTO</td>';
				$total_faturamento_01 = mysql_result(mysql_query("SELECT SUM(valor_sabesp_d + valor_sabesp_i) as totalSum FROM ae_medicao WHERE (data_ref between '".$data_termino_fat3."' and '".$data_termino_fat3."') AND obra IN($obra_r)"),0,"totalSum");
				
				$total_faturamento_02 = mysql_result(mysql_query("SELECT SUM(valor_sabesp_d + valor_sabesp_i) as totalSum FROM ae_medicao WHERE (data_ref between '".$data_termino_fat2."' and '".$data_termino_fat2."') AND obra IN($obra_r)"),0,"totalSum");
				
				$total_faturamento_03 = mysql_result(mysql_query("SELECT SUM(valor_sabesp_d + valor_sabesp_i) as totalSum FROM ae_medicao WHERE (data_ref between '".$data_termino_fat1."' and '".$data_termino_fat1."') AND obra IN($obra_r)"),0,"totalSum");
			
				echo '<td width="20%">'.money_format('%n', $total_faturamento_01).'</td>';
				echo '<td width="20%">'.money_format('%n', $total_faturamento_02).'</td>';
				echo '<td width="20%">'.money_format('%n', $total_faturamento_03).'</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td>  </td>';
				echo '<td style="text-align:center">FATURAMENTO LIQUIDO</td>';
				echo '<td width="20%">'.money_format('%n', $total_faturamento_01*75/100).'</td>';
				echo '<td width="20%">'.money_format('%n', $total_faturamento_02*75/100).'</td>';
				echo '<td width="20%">'.money_format('%n', $total_faturamento_03*75/100).'</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td> </td>';
				echo '<td style="text-align:center">FOLHA DE PAGAMENTO</td>';
				//$total_folha_01 = mysql_result(mysql_query(" - "),0,"totalSum");
				
				$total_folha_03 = mysql_result(mysql_query("SELECT SUM(((select salario from rh_funcoes where id = funcao)*0.8) + (select salario from rh_funcoes where id = funcao)+((vale_qtd*2)*21)+((vale_qtd2*2)*21)+(vale_refeicao*21)+(vale_alimentacao)) as totalSum FROM rh_funcionarios WHERE demissao = '0000-00-00' and situacao IN(6,10,7,12) and (obra IN($obra_r) OR tipo_emp = '1') order by rh_funcionarios.nome asc"),0,"totalSum");
				
				echo '<td width="20%">'.money_format('%n', $total_folha_03).'</td>';
				echo '<td width="20%">'.money_format('%n', $total_folha_03).'</td>';
				echo '<td width="20%">'.money_format('%n', $total_folha_03).'</td>';
			echo '</tr>';
			while($c = mysql_fetch_array($categorias)) {
				$cat_id = $c['id'];
				echo '<tr>';
				$se += 1;
				echo '<td width="20px">'.$se.'</td>';
				echo '<td>'.$c['descricao'].'</td>';
				$total_1 = mysql_result(mysql_query("select SUM(notas_itens_add.quantidade*notas_itens_add.valor) as totalSum FROM notas_nf, notas_itens_add WHERE notas_nf.id = notas_itens_add.nota AND notas_itens_add.categoria = '".$c['id']."' and notas_nf.obra in ($obra_r) AND (notas_nf.dataxml between '".$data_termino2."-01' and '".$data_termino2."-31') order by notas_itens_add.categoria"),0,"totalSum");
			
				$total_2 = mysql_result(mysql_query("select SUM(notas_itens_add.quantidade*notas_itens_add.valor) as totalSum FROM notas_nf, notas_itens_add WHERE notas_nf.id = notas_itens_add.nota AND notas_itens_add.categoria = '".$c['id']."' and notas_nf.obra in ($obra_r) AND (notas_nf.dataxml between '".$data_termino."-01' and '".$data_termino."-31') order by notas_itens_add.categoria"),0,"totalSum");
				
				$total_3 = mysql_result(mysql_query("select SUM(notas_itens_add.quantidade*notas_itens_add.valor) as totalSum FROM notas_nf, notas_itens_add WHERE notas_nf.id = notas_itens_add.nota AND notas_itens_add.categoria = '".$c['id']."' and notas_nf.obra in ($obra_r) AND (notas_nf.dataxml between '".$data_termino0."-01' and '".$data_termino0."-31') order by notas_itens_add.categoria"),0,"totalSum");
				
				echo '<td width="20%">'.money_format('%n', $total_1).'</td>';
				echo '<td width="20%">'.money_format('%n', $total_2).'</td>';
				echo '<td width="20%">'.money_format('%n', $total_3).'</td>';
				

				$total_geral_1 += $total_1;
				$total_geral_2 += $total_2;
				$total_geral_3 += $total_3;
				
				$total_geral += $total_1 + $total_2 + $total_3;
				echo '</tr>';
			}
			echo '</tbody>';
			echo '<tfoot>';
			echo '<tr>';
				echo '<td colspan="2" style="text-align:center">TOTAL CATEGORIAS</td>';
				echo '<td>'.money_format('%n', $total_geral_1).'</td>';
				echo '<td>'.money_format('%n', $total_geral_2).'</td>';
				echo '<td>'.money_format('%n', $total_geral_3).'</td>';
			echo '</tr>';
			$total_saldo_01 = ($total_faturamento_01*75/100) - $total_folha_03 - $total_geral_1;
			$total_saldo_02 = ($total_faturamento_02*75/100) - $total_folha_03 - $total_geral_2;
			$total_saldo_03 = ($total_faturamento_03*75/100) - $total_folha_03 - $total_geral_3;
			echo '<tr class="info" style="font-weight:bold">';
				echo '<td colspan="2" style="text-align:center">SALDO (LIQUIDO - TOTAL)</td>';
				echo '<td>';
				if($total_saldo_01 > 0){
					echo '<span class="text-success">'.money_format('%n', $total_saldo_01).'</span>';
				}else{
					echo '<span class="text-danger">'.money_format('%n', $total_saldo_01).'</span>';
				}
				echo '</td>';
				echo '<td>';
				if($total_saldo_02 > 0){
					echo '<span class="text-success">'.money_format('%n', $total_saldo_02).'</span>';
				}else{
					echo '<span class="text-danger">'.money_format('%n', $total_saldo_02).'</span>';
				}
				echo '</td>';
				echo '<td>';
				if($total_saldo_03 > 0){
					echo '<span class="text-success">'.money_format('%n', $total_saldo_03).'</span>';
				}else{
					echo '<span class="text-danger">'.money_format('%n', $total_saldo_03).'</span>';
				}
				echo '</td>';
			echo '</tr>';
			echo '</tfoot>';
			echo '</table>';	
			?>
		</div>
        
<script>window.onload = function() { setTimeout(function(){ window.print(); }, 1000); }</script>
