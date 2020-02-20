<?php
	include("../config.php");
	include("../validar_session.php");
	include("../../functions/function-print.php");
	getData();
	getNivel();
	
	$data_min = new DateTime($todayTotal);
    $data_min->sub(new DateInterval('P6M'));
	$data_min=$data_min->format('Y-m-d');
?>
<style>	
	@media print{
		table, tr, thead, tbody, td, th{
			border:1px solid rgba(23, 23, 23, 0.6) !important;
		}
	}
	td.money {
		text-align: right;
	}

	.currencySymbol {
		float: left;
	}
	.text-success{
		color:#1D7619 !important;
		font-weight:600;
	}
</style>
<script type="text/javascript">
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
		buttonWidth: '100%'
	}); 
	$(function() {
        $("table").tablesorter({
            textExtraction: function(node){ 
                var cell_value = $(node).text();
                var sort_value = $(node).data('value');
                return (sort_value != undefined) ? sort_value : cell_value;
            }
        })
    });
});
</script>
<?php
	if(@$ac=='listar') {
	// C A T E G O R I A ------------------------------------------------------------------------------------
		if($relatorio==7) {		
			foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1); //Obra
			foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1); //Conta
			foreach($ci as $cis) { @$ciu .= $cis.','; } $ciu = substr($ciu,0,-1); //Cidade
			foreach($ti as $tis) { @$tiu .= $tis.','; } $tiu = substr($tiu,0,-1); //Tipo
			foreach($emp as $emps) { @$empa .= $emps.','; } $empa = substr($empa,0,-1); //Empresa
			foreach($et as $ets) { @$eta .= $ets.','; } $eta = substr($eta,0,-1); //CATEGORIA
			foreach($sub as $suba) { @$subs .= $suba.','; } $subs = substr($subs,0,-1); //SUB-CATEGORIA
			echo '
				<p>
					<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
						RELATORIO NOTAS - CATEGORIA
					</h3>
					<p style="text-align:center;  font-size:14px;"><small>Período: '.implode("/",array_reverse(explode("-",$inicial))).' á '.implode("/",array_reverse(explode("-",$final))).'</small></p>
				</p>';		
			//GRAFICO
?>
<!--
	<script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
		<?php
			/*$data_inicio = $todayTotal;
			
			$data_termino1 = new DateTime($data_inicio);
			//$data_termino1 -> add(new DateInterval('P1M'));
			$data_termino1 = $data_termino1->format('Y-m');
			
			$data_termino2 = new DateTime($data_inicio);
			$data_termino2 -> add(new DateInterval('P1M'));
			$data_termino2 = $data_termino2->format('Y-m');
			
			$data_termino3 = new DateTime($data_inicio);
			$data_termino3 -> add(new DateInterval('P2M'));
			$data_termino3 = $data_termino3->format('Y-m');
			
			
			$string_grafico1 = "'".implode("/",array_reverse(explode("-",$data_termino1)))."', '".implode("/",array_reverse(explode("-",$data_termino2)))."', '".implode("/",array_reverse(explode("-",$data_termino3)))."'";
		?>	
          ['Categorias', <?php echo $string_grafico1 ?>],
		<?php
		$categoria_grafico  = mysql_query("SELECT * FROM notas_categorias_sub WHERE id IN($subs) and status = '0' ORDER BY descricao ASC"); 
		while($cat = mysql_fetch_array($categoria_grafico)){
			$cat_id2 = $cat['id'];
			$total_parcela_item1 = 0;
			$total_parcela_item2 = 0;
			$total_parcela_item3 = 0;
			
			$total_1 = mysql_query("SELECT notas_nf_venc.data AS data_venc, notas_nf_venc.parcela, SUM((notas_itens_add.valor-notas_itens_add.desconto)*notas_itens_add.quantidade) AS total_item_sub, notas_itens_add.nota AS nota_id, (SELECT COUNT(*) FROM notas_nf_venc WHERE nota = nota_id) AS contagem_parcelas, (SELECT SUM((notas_itens_add.valor-notas_itens_add.desconto)*notas_itens_add.quantidade) as total_nota  FROM notas_nf INNER JOIN notas_itens_add ON notas_nf.id = notas_itens_add.nota WHERE notas_nf.id = nota_id AND notas_nf.tipo_nota IN($tiu) AND notas_nf.obra IN($oba) and notas_nf_venc.conta IN($equ)) AS total_nota, (SELECT numero FROM notas_nf WHERE notas_nf.id = nota_id) AS numero_nf, notas_nf_venc.valor as valor_venc FROM notas_itens_add INNER JOIN notas_nf_venc ON notas_itens_add.nota = notas_nf_venc.nota WHERE notas_itens_add.categoria = '".$cat_id2."' AND (notas_nf_venc.data BETWEEN '".$data_termino1."-01' and '".$data_termino1."-31')  GROUP BY notas_nf_venc.id");
			while($c = mysql_fetch_array($total_1)) {
				$total_parcela_item1 += $c['total_item_sub'] / $c['contagem_parcelas'];
			}
			$total_geral_1 += $total_parcela_item1;
			$total_2 = mysql_query("SELECT notas_nf_venc.data AS data_venc, notas_nf_venc.parcela, SUM((notas_itens_add.valor-notas_itens_add.desconto)*notas_itens_add.quantidade) AS total_item_sub, notas_itens_add.nota AS nota_id, (SELECT COUNT(*) FROM notas_nf_venc WHERE nota = nota_id) AS contagem_parcelas, (SELECT SUM((notas_itens_add.valor-notas_itens_add.desconto)*notas_itens_add.quantidade) as total_nota  FROM notas_nf INNER JOIN notas_itens_add ON notas_nf.id = notas_itens_add.nota WHERE notas_nf.id = nota_id AND notas_nf.tipo_nota IN($tiu) AND notas_nf.obra IN($oba) and notas_nf_venc.conta IN($equ)) AS total_nota, (SELECT numero FROM notas_nf WHERE notas_nf.id = nota_id) AS numero_nf, notas_nf_venc.valor as valor_venc FROM notas_itens_add INNER JOIN notas_nf_venc ON notas_itens_add.nota = notas_nf_venc.nota WHERE notas_itens_add.categoria = '".$cat_id2."' AND (notas_nf_venc.data BETWEEN '".$data_termino2."-01' and '".$data_termino2."-31')  GROUP BY notas_nf_venc.id");
			while($d = mysql_fetch_array($total_2)) {
				$total_parcela_item2 += $d['total_item_sub'] / $d['contagem_parcelas'];
			}
			$total_geral_2 += $total_parcela_item2;
			$total_3 = mysql_query("SELECT notas_nf_venc.data AS data_venc, notas_nf_venc.parcela, SUM((notas_itens_add.valor-notas_itens_add.desconto)*notas_itens_add.quantidade) AS total_item_sub, notas_itens_add.nota AS nota_id, (SELECT COUNT(*) FROM notas_nf_venc WHERE nota = nota_id) AS contagem_parcelas, (SELECT SUM((notas_itens_add.valor-notas_itens_add.desconto)*notas_itens_add.quantidade) as total_nota  FROM notas_nf INNER JOIN notas_itens_add ON notas_nf.id = notas_itens_add.nota WHERE notas_nf.id = nota_id AND notas_nf.tipo_nota IN($tiu) AND notas_nf.obra IN($oba) and notas_nf_venc.conta IN($equ)) AS total_nota, (SELECT numero FROM notas_nf WHERE notas_nf.id = nota_id) AS numero_nf, notas_nf_venc.valor as valor_venc FROM notas_itens_add INNER JOIN notas_nf_venc ON notas_itens_add.nota = notas_nf_venc.nota WHERE notas_itens_add.categoria = '".$cat_id2."' AND (notas_nf_venc.data BETWEEN '".$data_termino3."-01' and '".$data_termino3."-31')  GROUP BY notas_nf_venc.id");
			while($e = mysql_fetch_array($total_3)) {
				$total_parcela_item3 += $e['total_item_sub'] / $e['contagem_parcelas'];
			}
			$total_geral_3 += $total_parcela_item3;
			
			if($total_parcela_item1 == '') { $total_parcela_item1 = 0; }
			if($total_parcela_item2 == '') { $total_parcela_item2 = 0; }
			if($total_parcela_item3 == '') { $total_parcela_item3 = 0; }
			$total_parcela_item1 = number_format($total_parcela_item1, 2, '.', '');
			$total_parcela_item2 = number_format($total_parcela_item2, 2, '.', '');
			$total_parcela_item3 = number_format($total_parcela_item3, 2, '.', '');
			echo "['".$cat['descricao']."', $total_parcela_item1, $total_parcela_item2, $total_parcela_item3],";
		}
		*/ ?>
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

	<div id="columnchart_material" style="padding:30px; background:#fff; width:100%; height:500px;"></div>-->

			<?php
			
			$inicial = implode("-",array_reverse(explode("/",$inicial))); 
			$final = implode("-",array_reverse(explode("/",$final)));
			
			$data_inicio = $todayTotal;
			
			$data_termino1 = new DateTime($data_inicio);
			//$data_termino1 -> add(new DateInterval('P1M'));
			$data_termino1 = $data_termino1->format('Y-m');
			
			$data_termino2 = new DateTime($data_inicio);
			$data_termino2 -> add(new DateInterval('P1M'));
			$data_termino2 = $data_termino2->format('Y-m');
			
			$data_termino3 = new DateTime($data_inicio);
			$data_termino3 -> add(new DateInterval('P2M'));
			$data_termino3 = $data_termino3->format('Y-m');
			
			$total_geral = 0;
			$total_geral_1 = 0; $total_geral_2 = 0; $total_geral_3 = 0;
			echo '<table id="resultadoTabela" class="table table-bordered table-color">';
			echo '<thead><tr><th>Nº</th><th>Sub-Categoria</th>
			<th>'.implode("/",array_reverse(explode("-",$data_termino1))).'</th>
			<th>'.implode("/",array_reverse(explode("-",$data_termino2))).'</th>
			<th>'.implode("/",array_reverse(explode("-",$data_termino3))).'</th>
			</tr></thead><tbody>';
			$se2 = 0;
			$categoriasbb = mysql_query("SELECT * FROM notas_categorias WHERE id IN($eta) AND status = '0' ORDER BY descricao ASC"); 
			while($b = mysql_fetch_array($categoriasbb)) {
				echo '<tr class="info"><td colspan="5">'.$b['descricao'].'</td></tr>';
				$categorias = mysql_query("SELECT * FROM notas_categorias_sub WHERE id IN($subs) AND id_categoria = '".$b['id']."' AND status = '0' ORDER BY descricao ASC"); 
				while($c = mysql_fetch_array($categorias)) {
					$total_parcela_item1 = 0;
					$total_parcela_item2 = 0;
					$total_parcela_item3 = 0;
					$cat_id = $c['id'];
					echo '<tr style="font-size:18px;">';
					$se2 += 1;
					echo '<td width="2%">'.$se2.'</td>';
					echo '<td width="35%">'.$c['descricao'].'</td>';
					$total_1 = mysql_query("SELECT notas_nf_venc.data AS data_venc, notas_nf_venc.parcela, SUM((notas_itens_add.valor-notas_itens_add.desconto)*notas_itens_add.quantidade) AS total_item_sub, notas_itens_add.nota AS nota_id, (SELECT COUNT(*) FROM notas_nf_venc WHERE nota = nota_id) AS contagem_parcelas, (SELECT SUM((notas_itens_add.valor-notas_itens_add.desconto)*notas_itens_add.quantidade) as total_nota  FROM notas_nf INNER JOIN notas_itens_add ON notas_nf.id = notas_itens_add.nota WHERE notas_nf.id = nota_id AND notas_nf.tipo_nota IN($tiu) AND notas_nf.obra IN($oba) and notas_nf_venc.conta IN($equ)) AS total_nota, (SELECT numero FROM notas_nf WHERE notas_nf.id = nota_id) AS numero_nf, notas_nf_venc.valor as valor_venc FROM notas_itens_add INNER JOIN notas_nf_venc ON notas_itens_add.nota = notas_nf_venc.nota WHERE notas_itens_add.categoria = '".$cat_id."' AND (notas_nf_venc.data BETWEEN '".$data_termino1."-01' and '".$data_termino1."-31')  GROUP BY notas_nf_venc.id");
					while($x = mysql_fetch_array($total_1)) {
						$total_parcela_item1 += $x['total_item_sub'] / $x['contagem_parcelas'];
					}
					if($c['id_categoria'] == 13 || $c['id_categoria'] == 8){ 
						$total_rendimento_1 += $total_parcela_item1;
					}else{
						$total_geral_1 += $total_parcela_item1;
					}
					$total_2 = mysql_query("SELECT notas_nf_venc.data AS data_venc, notas_nf_venc.parcela, SUM((notas_itens_add.valor-notas_itens_add.desconto)*notas_itens_add.quantidade) AS total_item_sub, notas_itens_add.nota AS nota_id, (SELECT COUNT(*) FROM notas_nf_venc WHERE nota = nota_id) AS contagem_parcelas, (SELECT SUM((notas_itens_add.valor-notas_itens_add.desconto)*notas_itens_add.quantidade) as total_nota  FROM notas_nf INNER JOIN notas_itens_add ON notas_nf.id = notas_itens_add.nota WHERE notas_nf.id = nota_id AND notas_nf.tipo_nota IN($tiu) AND notas_nf.obra IN($oba) and notas_nf_venc.conta IN($equ)) AS total_nota, (SELECT numero FROM notas_nf WHERE notas_nf.id = nota_id) AS numero_nf, notas_nf_venc.valor as valor_venc FROM notas_itens_add INNER JOIN notas_nf_venc ON notas_itens_add.nota = notas_nf_venc.nota WHERE notas_itens_add.categoria = '".$cat_id."' AND (notas_nf_venc.data BETWEEN '".$data_termino2."-01' and '".$data_termino2."-31')  GROUP BY notas_nf_venc.id");
					while($d = mysql_fetch_array($total_2)) {
						$total_parcela_item2 += $d['total_item_sub'] / $d['contagem_parcelas'];
					}
					if($c['id_categoria'] == '13'){ 
						$total_rendimento_2 += $total_parcela_item2;
					}else{
						$total_geral_2 += $total_parcela_item2;
					}
					$total_3 = mysql_query("SELECT notas_nf_venc.data AS data_venc, notas_nf_venc.parcela, SUM((notas_itens_add.valor-notas_itens_add.desconto)*notas_itens_add.quantidade) AS total_item_sub, notas_itens_add.nota AS nota_id, (SELECT COUNT(*) FROM notas_nf_venc WHERE nota = nota_id) AS contagem_parcelas, (SELECT SUM((notas_itens_add.valor-notas_itens_add.desconto)*notas_itens_add.quantidade) as total_nota  FROM notas_nf INNER JOIN notas_itens_add ON notas_nf.id = notas_itens_add.nota WHERE notas_nf.id = nota_id AND notas_nf.tipo_nota IN($tiu) AND notas_nf.obra IN($oba) and notas_nf_venc.conta IN($equ)) AS total_nota, (SELECT numero FROM notas_nf WHERE notas_nf.id = nota_id) AS numero_nf, notas_nf_venc.valor as valor_venc FROM notas_itens_add INNER JOIN notas_nf_venc ON notas_itens_add.nota = notas_nf_venc.nota WHERE notas_itens_add.categoria = '".$cat_id."' AND (notas_nf_venc.data BETWEEN '".$data_termino3."-01' and '".$data_termino3."-31')  GROUP BY notas_nf_venc.id");
					while($e = mysql_fetch_array($total_3)) {
						$total_parcela_item3 += $e['total_item_sub'] / $e['contagem_parcelas'];
					}
					if($c['id_categoria'] == '13'){ 
						$total_rendimento_3 += $total_parcela_item3;
					}else{
						$total_geral_3 += $total_parcela_item3;
					}
					$total_parcela_item1 = number_format($total_parcela_item1,2,".","");
					$total_parcela_item2 = number_format($total_parcela_item2,2,".","");
					$total_parcela_item3 = number_format($total_parcela_item3,2,".","");
					echo '<td width="15%" data-value="'.$total_parcela_item1.'">R$ '.number_format($total_parcela_item1,2,",",".").'</td>';
					echo '<td width="15%" data-value="'.$total_parcela_item2.'">R$ '.number_format($total_parcela_item2,2,",",".").'</td>';
					echo '<td width="15%" data-value="'.$total_parcela_item3.'">R$ '.number_format($total_parcela_item3,2,",",".").'</td>';

					echo '</tr>';
				}
			}
			echo '</tbody>';
			echo '<tfoot>';
			echo '<tr class="small">';
				echo '<td colspan="2" style="text-align:center">DESPESAS</td>';
				echo '<td>'.money_format('%n', $total_geral_1).'</td>';
				echo '<td>'.money_format('%n', $total_geral_2).'</td>';
				echo '<td>'.money_format('%n', $total_geral_3).'</td>';
			echo '</tr>';
			echo '<tr class="small">';
				echo '<td colspan="2" style="text-align:center">RENDIMENTO</td>';
				echo '<td>'.money_format('%n', $total_rendimento_1).'</td>';
				echo '<td>'.money_format('%n', $total_rendimento_2).'</td>';
				echo '<td>'.money_format('%n', $total_rendimento_3).'</td>';
			echo '</tr>';
			echo '<tr class="small active" style="font-weight:bold">';
				echo '<td colspan="2" style="text-align:center">SALDO</td>';
				$saldo_geral_1 = $total_rendimento_1 - $total_geral_1;
				$saldo_geral_2 = $total_rendimento_2 - $total_geral_2;
				$saldo_geral_3 = $total_rendimento_3 - $total_geral_3;
				
				echo '<td>'.money_format('%n', $saldo_geral_1).'</td>';
				echo '<td>'.money_format('%n', $saldo_geral_2).'</td>';
				echo '<td>'.money_format('%n', $saldo_geral_3).'</td>';
			echo '</tr>';
			echo '</tfoot>';
			echo '</table>';		
			exit;		
		}
	// C A T E G O R I A ------------------------------------------------------------------------------------
		if($relatorio==8) {		
			foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1); //Obra
			foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1); //Conta
			foreach($ci as $cis) { @$ciu .= $cis.','; } $ciu = substr($ciu,0,-1); //Cidade
			foreach($ti as $tis) { @$tiu .= $tis.','; } $tiu = substr($tiu,0,-1); //Tipo
			foreach($emp as $emps) { @$empa .= $emps.','; } $empa = substr($empa,0,-1); //Empresa
			foreach($et as $ets) { @$eta .= $ets.','; } $eta = substr($eta,0,-1); //CATEGORIA
			foreach($sub as $suba) { @$subs .= $suba.','; } $subs = substr($subs,0,-1); //SUB-CATEGORIA
			echo '
				<p>
					<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
						RELATORIO NOTAS - CATEGORIA
					</h3>
					<p style="text-align:center;  font-size:14px;"><small>Período: '.implode("/",array_reverse(explode("-",$inicial))).' á '.implode("/",array_reverse(explode("-",$final))).'</small></p>
				</p>';	
			
			$total_geral = 0;
			$total_geral_1 = 0; $total_geral_2 = 0; $total_geral_3 = 0;
			echo '<table id="resultadoTabela" class="table table-bordered table-condensed" style="background:#FFF">';
			echo '<thead><tr><th>Nº</th><th>Sub-Categoria</th><th>Valor</th></tr></thead><tbody>';
			$se2 = 0;
			$categoriasbb = mysql_query("SELECT * FROM notas_categorias WHERE id IN($eta) AND status = '0' ORDER BY descricao ASC"); 
			while($b = mysql_fetch_array($categoriasbb)) {
				$se += 1;
				echo '<tr class="info"><td>'.$se.'</td><td colspan="2">'.$b['descricao'].'</td></tr>';
				$categorias = mysql_query("SELECT * FROM notas_categorias_sub WHERE id IN($subs) AND id_categoria = '".$b['id']."' AND status = '0' ORDER BY descricao ASC"); 
				while($c = mysql_fetch_array($categorias)) {
					$total_parcela_item1 = 0;
					$se2 += 1;
					$cat_id = $c['id'];
					$total_1 = mysql_query("SELECT notas_nf_venc.data AS data_venc, notas_nf_venc.parcela, SUM((notas_itens_add.valor-notas_itens_add.desconto)*notas_itens_add.quantidade) AS total_item_sub, notas_itens_add.nota AS nota_id, (SELECT COUNT(*) FROM notas_nf_venc WHERE nota = nota_id) AS contagem_parcelas, (SELECT SUM((notas_itens_add.valor-notas_itens_add.desconto)*notas_itens_add.quantidade) as total_nota  FROM notas_nf INNER JOIN notas_itens_add ON notas_nf.id = notas_itens_add.nota WHERE notas_nf.id = nota_id AND notas_nf.tipo_nota IN($tiu) AND notas_nf.obra IN($oba) and notas_nf_venc.conta IN($equ)) AS total_nota, (SELECT numero FROM notas_nf WHERE notas_nf.id = nota_id) AS numero_nf, notas_nf_venc.valor as valor_venc FROM notas_itens_add INNER JOIN notas_nf_venc ON notas_itens_add.nota = notas_nf_venc.nota WHERE notas_itens_add.categoria = '".$cat_id."' AND (notas_nf_venc.data BETWEEN '".$inicial."' and '".$final."')  GROUP BY notas_nf_venc.id");
					while($x = mysql_fetch_array($total_1)) {
						$total_parcela_item1 += $x['total_item_sub'] / $x['contagem_parcelas'];
					}
					$total_parcela_item1 = number_format($total_parcela_item1,2,".","");
					if($total_parcela_item1 != '0'){
						echo '<tr class="small warning">';
						echo '<td style="padding-left:20px" width="2%">'.$se.'.'.$se2.'</td>';
						echo '<td width="35%">'.$c['descricao'].'</td>';
						echo '<td width="15%" data-value="'.$total_parcela_item1.'">R$ '.number_format($total_parcela_item1,2,",",".").'</td>';
						echo '</tr>';
					}
					
					$item = mysql_query("SELECT * FROM notas_itens WHERE categoria = '".$c['id']."' ORDER BY descricao ASC");
					$se3 = 0;
					while($i = mysql_fetch_array($item)){
						
						$total_item1 = 0;
						$se3 += 1;
						
						$itemtot_1 = mysql_query("SELECT notas_nf_venc.data AS data_venc, notas_nf_venc.parcela, SUM((notas_itens_add.valor-notas_itens_add.desconto)*notas_itens_add.quantidade) AS total_item_sub, notas_itens_add.nota AS nota_id, (SELECT COUNT(*) FROM notas_nf_venc WHERE nota = nota_id) AS contagem_parcelas, (SELECT SUM((notas_itens_add.valor-notas_itens_add.desconto)*notas_itens_add.quantidade) as total_nota  FROM notas_nf INNER JOIN notas_itens_add ON notas_nf.id = notas_itens_add.nota WHERE notas_nf.id = nota_id AND notas_nf.tipo_nota IN($tiu) AND notas_nf.obra IN($oba) and notas_nf_venc.conta IN($equ)) AS total_nota, (SELECT numero FROM notas_nf WHERE notas_nf.id = nota_id) AS numero_nf, notas_nf_venc.valor as valor_venc FROM notas_itens_add INNER JOIN notas_nf_venc ON notas_itens_add.nota = notas_nf_venc.nota WHERE notas_itens_add.item = '".$i['id']."' AND (notas_nf_venc.data BETWEEN '".$inicial."' and '".$final."')  GROUP BY notas_nf_venc.id");
						while($x1 = mysql_fetch_array($itemtot_1)) {
							$total_item1 += $x1['total_item_sub'] / $x1['contagem_parcelas'];
						}
						if($c['id_categoria'] == 13 || $c['id_categoria'] == 8){ 
							$total_rendimento_1 += $total_item1;
						}else{
							$total_geral_1 += $total_item1;
						}
						$total_item1 = number_format($total_item1,2,".","");
						if($total_item1 != '0'){
						echo '<tr class="small" id="cupomx'.$i['id'].'">';
						echo '<td style="padding-left:40px">'.$se.'.'.$se2.'.'.$se3.'</td>';
						echo '<td>'.$i['descricao'].'</td>';
						echo '<td width="15%" data-value="'.$total_item1.'">R$ '.number_format($total_item1,2,",",".").'</td>';
						echo '</tr>';
						}
					}
				}
			}
			echo '</tbody>';
			echo '<tfoot>';
			echo '<tr class="small">';
				echo '<td colspan="2" style="text-align:center">DESPESAS</td>';
				echo '<td>'.money_format('%n', $total_geral_1).'</td>';
			echo '</tr>';
			echo '<tr class="small">';
				echo '<td colspan="2" style="text-align:center">RENDIMENTO</td>';
				echo '<td>'.money_format('%n', $total_rendimento_1).'</td>';
			echo '</tr>';
			echo '<tr class="small active" style="font-weight:bold">';
				echo '<td colspan="2" style="text-align:center">SALDO</td>';
				$saldo_geral_1 = $total_rendimento_1 - $total_geral_1;
				
				echo '<td>'.money_format('%n', $saldo_geral_1).'</td>';
			echo '</tr>';
			echo '</tfoot>';
			echo '</table>';		
			exit;		
		}
		
		if($relatorio == 4) {
			foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1); //Obra
			foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1); //Conta
			foreach($ci as $cis) { @$ciu .= $cis.','; } $ciu = substr($ciu,0,-1); //Cidade
			foreach($ti as $tis) { @$tiu .= $tis.','; } $tiu = substr($tiu,0,-1); //Tipo
			foreach($emp as $emps) { @$empa .= $emps.','; } $empa = substr($empa,0,-1); //Empresa
			foreach($et as $ets) { @$eta .= $ets.','; } $eta = substr($eta,0,-1); //CATEGORIA
			foreach($sub as $suba) { @$subs .= $suba.','; } $subs = substr($subs,0,-1); //SUB-CATEGORIA
			topoPrint();
			
			$ano = explode("-",$final);
			echo '
				<p>
					<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
						RELATORIO NOTA FISCAL - CONFERIR
					</h3>
					<p style="text-align:center;  font-size:14px;"><small>Período: '.implode("/",array_reverse(explode("-",$inicial))).' á '.implode("/",array_reverse(explode("-",$final))).'</small></p>
				</p>
				<p style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
					';
					$obra_controle = mysql_query("SELECT * FROM notas_obras WHERE id IN($oba)");
					while($c = mysql_fetch_array($obra_controle)){
						echo $c['descricao'].'<br/>';
					}
					echo '
				</p>';		
			echo '<table class="table table-bordered table-color">';
			$categorias = mysql_query("SELECT * FROM notas_categorias_sub WHERE id IN($subs) and status = '0'");
			echo '<tbody>';
			while($l = mysql_fetch_array($categorias)) { extract($l);	
				echo '<tr class="info">';	
					echo '<td>'.$l['id'].'</td>';
					echo '<td colspan="6">'.$l['descricao'].'</td>';
				echo '</tr>';
				echo '<tr colspan="success">
						<th style="text-align:center">Nota</th>
						<th style="text-align:center">Total Sub-Categoria</th>
						<th style="text-align:center">Total da Nota</th>
						<th style="text-align:center">Total do item (Parcela)</th>
						<th style="text-align:center">Total Vencimento</th>
						<th style="text-align:center">Parcelas</th>
						<th style="text-align:center">Venc</th>
						<th style="text-align:center">Porcentagem</th>
				</tr>';
				$notas_sql = mysql_query("SELECT notas_nf_venc.data AS data_venc, notas_nf_venc.parcela, SUM((notas_itens_add.valor-notas_itens_add.desconto)*notas_itens_add.quantidade) AS total_item_sub, notas_itens_add.nota AS nota_id, (SELECT COUNT(*) FROM notas_nf_venc WHERE nota = nota_id) AS contagem_parcelas, (SELECT SUM((notas_itens_add.valor-notas_itens_add.desconto)*notas_itens_add.quantidade) as total_nota  FROM notas_nf INNER JOIN notas_itens_add ON notas_nf.id = notas_itens_add.nota WHERE notas_nf.id = nota_id AND notas_nf.tipo_nota IN($tiu) AND notas_nf.obra IN($oba) and notas_nf_venc.conta IN($equ)) AS total_nota, (SELECT numero FROM notas_nf WHERE notas_nf.id = nota_id) AS numero_nf, notas_nf_venc.valor as valor_venc FROM notas_itens_add INNER JOIN notas_nf_venc ON notas_itens_add.nota = notas_nf_venc.nota WHERE notas_itens_add.categoria = '".$l['id']."' AND (notas_nf_venc.data BETWEEN '$inicial' AND '$final') GROUP BY notas_nf_venc.id");
				while($c = mysql_fetch_array($notas_sql)) {
					$porcentagem_item = @round((($c['total_item_sub'] / $c['total_nota'])*100),2);
					$total_parcela_item = $c['total_item_sub'] / $c['contagem_parcelas'];
					echo '<tr>';	
						echo '<td>'.$c['numero_nf'].'</td>';
						echo '<td>R$ '.number_format($c['total_item_sub'],2,",",".").'</td>';
						echo '<td>R$ '.number_format($c['total_nota'],2,",",".").'</td>';
						echo '<td>R$ '.number_format($total_parcela_item,2,",",".").'</td>';
						echo '<td>R$ '.number_format($c['valor_venc'],2,",",".").'</td>';
						echo '<td>'.$c['contagem_parcelas'].'</td>';
						echo '<td>'.implode("/",array_reverse(explode("-",$c['data_venc']))).'</td>';
						echo '<td>'.$porcentagem_item.'%</td>';
					echo '</tr>';
					$total_item_sub_g += $c['total_item_sub'];
					$total_vencimentos_g += $c['valor_venc'];
					$total_nota_g += $c['total_nota'];
					$total_parcela_g += $total_parcela_item;
				}
			}
			echo '<tr colspan="warning">
						<th style="text-align:center">Nota</th>
						<th style="text-align:center">'.number_format($total_item_sub_g,2,",",".").'</th>
						<th style="text-align:center">'.number_format($total_nota_g,2,",",".").'</th>
						<th style="text-align:center">'.number_format($total_parcela_g,2,",",".").'</th>
						<th style="text-align:center">'.number_format($total_vencimentos_g,2,",",".").'</th>
						<th colspan="3"></th>
				</tr>';
			echo '<tbody></table>';		
			exit;		
		}
	}
?>
	<div class="container-fluid hidden-print" style="padding:0px 0px 15px 0px; margin-bottom:20px; border-bottom:1px solid #CCC">
		<h3 style="font-family: 'Oswald', sans-serif; letter-spacing:5px;"> 
			GRAFICO <small><b>CONTROLE DE CONTAS</b></small>
			<a href="javascript:window.print()" style="letter-spacing:8px; padding-left:40px; padding-right:40px;" class="hidden-xs hidden-print pull-right btn btn-warning btn-sm"> <span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Imprimir</a>
		</h3>
	</div>
	<div class="well well-sm hidden-print" style="padding:10px 10px 5px 10px;">
		<form action="javascript:void(0)" onSubmit="posti(this,'gestor/relatorio-notas.php?ac=listar','.resultado');" class="form-inline">
			<div class="container-fluid" style="padding:0px">
				<div class="col-xs-12" style="padding:2px">
					<div class="col-xs-2" style="padding:2px">
						<label style="width:100%"><small>Obra:</small><br/>
							<select name="ci[]" onChange="$('#item-consulta-obra').load('../functions/functions-load.php?atu=categoria12&cidade=' + $(this).val() + '');" class="sel" multiple="multiple" id="categ" required> 
							<?php
								$cidade = mysql_query("select * from notas_obras_cidade WHERE id IN(0,$cidade_usuario) order by nome asc");
								while($l = mysql_fetch_array($cidade)) {
									echo '<option value="'.$l['id'].'" selected>'.$l['nome'].'</option>';
								}
							?>	
							</select>
						</label>
					</div>
					<div class="col-xs-10" style="padding:0px">
						<div id="item-consulta-obra">
							<div class="col-xs-3" style="padding:2px">
								<label style="width:100%"><small>Contrato:</small><br/>
								<select name="ob[]" class="sel" multiple="multiple">
									<?php
									$obras = mysql_query("select * from notas_obras where id IN(0,$obra_usuario) order by descricao asc");
									while($l = mysql_fetch_array($obras)) {
										echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>';
									}
									?>		
								</select>
								</label>
							</div>
							<div class="col-xs-3" style="padding:2px">
								<label style="width:100%">
								<small>Contas:</small>
								<select name="eq[]" class="sel" multiple="multiple">
									<?php
									$encarregados = mysql_query("select * from equipes WHERE obra IN(0,$cidade_usuario) order by nome asc");
									while($x = mysql_fetch_array($encarregados)) {
										echo '<option value="'.$x['id'].'" selected>'.$x['nome'].'</option>';
									}
									?>		
								</select>
								</label>
							</div>
							<div class="col-xs-3" style="padding:2px">
								<label style="width:100%"><small>Categoria: </small>
									<select name="et[]" onChange="$('#item-categoria').load('../functions/functions-load.php?atu=categoria_multiple&categoriaID=' + $(this).val() + '');" class="sel" multiple="multiple">
										<?php
										$sql = mysql_query("select * from notas_categorias WHERE obra in(0,$cidade_usuario) AND status = '0' order by descricao asc");
										while($l = mysql_fetch_array($sql)) { extract($l);
											echo '<option value="'.$id.'" selected>'.$descricao.'</option>';
										}
										?>
									</select>
								</label>
							</div>
							<div class="col-xs-3" style="padding:2px">
								<div id="item-categoria">
									<label style="width:100%"><small>Sub-Categoria: </small>
										<select name="sub[]" class="sel" multiple="multiple">
											<?php
											$categoria_controle = mysql_query("select * from notas_categorias WHERE obra in($cidade_usuario) AND status = '0' order by descricao asc");
											while($s = mysql_fetch_array($categoria_controle)){
												$cat_ids .= $s['id'].',';
											}
											$cat_ids = substr($cat_ids,0,-1);
											$sql = mysql_query("select * from notas_categorias_sub WHERE id_categoria IN($cat_ids) and status = '0' order by descricao asc");
											while($l = mysql_fetch_array($sql)) { extract($l);
												echo '<option value="'.$id.'" selected>'.$descricao.'</option>';
											}
											?>
										</select>
									</label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container-fluid" style="padding:0px">
				<div class="col-xs-2" style="padding:2px">
					<label style="width:100%"><small>Fornecedor: </small>
						<select name="emp[]" class="sel" multiple="multiple">
							<?php
							$sql = mysql_query("select * from empresa_cadastro order by razao_social asc");
							while($l = mysql_fetch_array($sql)) { extract($l);
								echo '<option value="'.$id.'" selected>'.$razao_social.'</option>';
							}
							?>
						</select>
					</label>
				</div>
				<div class="col-xs-2" style="padding:2px">
						<label style="width:100%"><small>Tipo Nota: </small>
							<select name="ti[]" class="sel" multiple="multiple">
								<option value="0" selected>NOTA FISCAL - DESPESAS</option>
								<option value="1" selected>LOCAÇÃO</option>
								<option value="2" selected>SERVIÇO</option>
								<option value="3" selected>VENDA</option>
							</select>
						</label>
				</div>
				<div class="col-xs-2" style="padding:2px">
					<label style="width:100%"><small>Tipo:</small>
						<select name="relatorio" class="form-control input-sm disabled" style="width:100%">
							<option value="7">MEMORIA P/ CATEGORIA</option>
							<option value="8">MEMORIA P/ ITEM</option>
							<option value="4">TESTE</option>
						</select>
					</label>
				</div>
				<div class="col-xs-4" style="padding:0px">
					<div class="col-xs-6" style="padding:2px">
						<label style="width:100%"><small>De:</small><br/>
							<input type="date" name="inicial" value="<?php echo $inicioMes; ?>" class="form-control input-sm" style="width:100%" />
						</label>
					</div>
					<div class="col-xs-6" style="padding:2px">
						<label style="width:100%"><small>ate:</small><br/>
							<input type="date" name="final" value="<?php echo $todayTotal; ?>" class="form-control input-sm" style="width:100%" />
						</label>
					</div>
				</div>
				<div class="col-xs-2" style="padding:2px 10px 2px 10px;">
					<label class="pull-right" style="width:100%"><br/>
						<input type="submit" value="Pesquisar" style="width:100%" class="btn btn-success btn-sm">
					</label>
				</div>
			</div>
		</form>
	</div>
<div class="resultado"></div>

	<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="height:auto;">
		<div class="modal-dialog" style="width:80%;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" style="color:#C9302C; opacity:1; "  onclick="$('.modal').modal('hide')" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Editar</h4>
				</div>
				<div class="modal-body">
					Aguarde um momento &nbsp;&nbsp; <img src="../../imagens/loading.gif" alt="Carregando" width="20px"/>
				</div>
			</div>
		</div>
	</div>