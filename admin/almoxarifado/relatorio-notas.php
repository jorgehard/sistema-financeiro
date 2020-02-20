<?php
include("../config.php");
include("../validar_session.php");
date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_MONETARY,"pt_BR", "ptb");
$today = getdate(); 

if($today['mon'] < 10) { 
	$today['mon'] = '0'.$today['mon'];
}else{ 
	$today['mon'] = $today['mon'];
} 
if($today['mday'] < 10){ 
	$today['mday'] = '0'.$today['mday']; 
}else{ 
	$today['mday'] = $today['mday']; 
} 

$todayTotal = $today['year'].'-'.$today['mon'].'-'.$today['mday'];
$inicioMes = $today['year'].'-'.$today['mon'].'-01';

?>

<script type="text/javascript">
$(document).ready(function(){
	$(".decimal").maskMoney({precision:2})
	$('.sel').multiselect({
      buttonClass: 'btn btn-sm',
	  numberDisplayed: 1,
	  maxHeight: 200,
	  includeSelectAllOption: true,
	  selectAllText: "Selecionar todos",
	  enableFiltering: true,
	  enableCaseInsensitiveFiltering: true,
	  selectAllValue: 'multiselect-all'
	}); 

});
</script>
<script>
$(document).ready(function(){
	$(function(){
		$("table").tablesorter();
	});
});
</script>
<style>
	@media print
	{
		table, tr, thead, tbody, td, th{
			border:1px solid rgba(23, 23, 23, 0.6) !important;
		}
	}

</style>
<?php
	if($atu=='ac'){
		echo '<label><small>Contrato:</small>';
			echo "<select name=\"ob[]\" style=\"width:250px;\" class=\"sel\" multiple=\"multiple\">";
					$obras = mysql_query("select * from notas_obras where cidade IN($cidade) and id in($obra_usuario) order by descricao asc");
					while($l = mysql_fetch_array($obras)) {
						echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>';
					}
			echo '</select>
		</label>
		<label for="">
			<small>Status:</small>
			<select name="st[]" OnChange="$(\'#itens2\').load(\'ss/relatorio-medicao-equipes-novo.php?atu=st2&cidade='.$cidade.'&status3=\' + $(this).val() + \'\');" class="sel" multiple="multiple">
				<option value="0" selected>ATIVA</option>
				<option value="1" selected>INATIVA</option>
			</select>
		</label>
		<label for="" id="itens2">
			<label><small>Equipes:</small>
			<select name="eq[]" class="sel" multiple="multiple">';
				$equipe = mysql_query("select * from equipes WHERE obra IN(0,$cidade) order by nome asc");
				while($x = mysql_fetch_array($equipe)) {
					echo '<option value="'.$x['id'].'" selected>'.$x['nome'].'</option>';
				}	
			echo '</select>
			</label>
		</label>';
		exit;
	}
	if(@$ac=='listar') {
	// C A T E G O R I A ------------------------------------------------------------------------------------
		if($relatorio==7) {		
			foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1);foreach($et as $ets) { @$eta .= $ets.','; } $eta = substr($eta,0,-1);
			foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);foreach($me as $med) { @$meu .= $med.','; } $meu = substr($meu,0,-1);
			echo '<table class="hidden-xs hidden-lg hidden-md visible-print" width="100%" style="margin-bottom:20px">';
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
			echo '<tr> </tr>';
		
			echo '</table>';
			$ano = explode("-",$final);
			echo '
				<p>
					<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
						RELATORIO NOTA FISCAL - CATEGORIA
					</h3>
					<p style="text-align:center;  font-size:14px;"><small>Periodo: '.implode("/",array_reverse(explode("-",$inicial))).' à '.implode("/",array_reverse(explode("-",$final))).'</small></p>
				</p>
				<p style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
					';
					$obra_controle = mysql_query("SELECT * FROM notas_obras WHERE id IN($oba)");
					while($c = mysql_fetch_array($obra_controle)){
						echo $c['descricao'].'<br/>';
					}
					echo '
				</p>
				<hr/>
			';		

			echo '<table class="table table-min table-striped" style="font-size:18px;">';
			echo '<thead><tr><th>ID</th><th>Categoria</th><th>Porc</th><th>Total</th></tr></thead><tbody>';
			
			$inicial = implode("-",array_reverse(explode("/",$inicial))); $final = implode("-",array_reverse(explode("/",$final)));
			
			$categorias = mysql_query("SELECT * FROM notas_categorias WHERE id IN($eta)"); 
			
			$se = 0; $total_geral = 0;
			
			$categorias2 = mysql_query("SELECT * FROM notas_categorias WHERE id IN($eta)");

			while($d = mysql_fetch_array($categorias2)) {
				$cat_id = $d['id'];
				$tot = mysql_result(mysql_query("SELECT SUM(notas_itens_add.quantidade*notas_itens_add.valor) AS totalSum, notas_itens_add.nota, notas_itens_add.item, notas_itens_add.categoria, notas_itens_add.quantidade, notas_itens_add.valor, notas_nf.recebimento FROM notas_nf, notas_itens_add WHERE notas_nf.id = notas_itens_add.nota AND notas_itens_add.categoria = '$cat_id' AND notas_nf.obra IN($oba) AND (notas_nf.recebimento between '$inicial' and '$final') and notas_itens_add.equipe in ($equ) ORDER BY notas_itens_add.categoria"),0,"totalSum");
				$total_porc += $tot;
			}
			while($c = mysql_fetch_array($categorias)) {
				$cat_id = $c['id'];
				if(mysql_result(mysql_query("select SUM(notas_itens_add.quantidade*notas_itens_add.valor) as totalSum, notas_itens_add.nota, notas_itens_add.item, notas_itens_add.categoria, notas_itens_add.quantidade, notas_itens_add.valor, notas_nf.recebimento FROM notas_nf, notas_itens_add WHERE notas_nf.id = notas_itens_add.nota AND notas_itens_add.categoria = '$cat_id' and notas_nf.obra in ($oba) AND (notas_nf.recebimento between '$inicial' and '$final') and notas_itens_add.equipe in ($equ) order by notas_itens_add.categoria"),0,"totalSum") == ''){ echo '<tr class="hidden">'; }else{ echo '<tr>'; $se += 1; }
				echo '<td width="20px">'.$se.'</td>';
				echo '<td>'.$c['descricao'].'</td>';
				$totall = mysql_result(mysql_query("select SUM(notas_itens_add.quantidade*notas_itens_add.valor) as totalSum, notas_itens_add.nota, notas_itens_add.item, notas_itens_add.categoria, notas_itens_add.quantidade, notas_itens_add.valor, notas_nf.recebimento FROM notas_nf, notas_itens_add WHERE notas_nf.id = notas_itens_add.nota AND notas_itens_add.categoria = '$cat_id' and notas_nf.obra in ($oba) AND (notas_nf.recebimento between '$inicial' and '$final') and notas_itens_add.equipe in ($equ) order by notas_itens_add.categoria"),0,"totalSum");
				$total_geral += $totall;
				$porc = ($totall/$total_porc)*100;
				echo '<td width="20%">'.number_format($porc,2,',','').'%</td>';
				echo '<td width="20%">'.money_format('%n', $totall).'</td>';
				
				echo '</tr>';
			}
			echo '</tbody></table>';	
			echo '	<div class="page-header">
						<h1 class="pull-right" style="font-family: \'Oswald\', sans-serif; letter-spacing:5px;">Total Geral <small> R$ '.number_format($total_geral,2,",",".").'</small></h1>
					</div>';		
			exit;		
		}
	// M A T E R I A L ------------------------------------------------------------------------
		if($relatorio==8) {
			foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1);foreach($et as $ets) { @$eta .= $ets.','; } $eta = substr($eta,0,-1);
			foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);foreach($me as $med) { @$meu .= $med.','; } $meu = substr($meu,0,-1);
			echo '<table class="hidden-xs hidden-lg hidden-md visible-print" width="100%" style="margin-bottom:20px">';
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
			echo '<tr> </tr>';
		
			echo '</table>';
			$ano = explode("-",$final);
			echo '
				<p>
					<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
						RELATORIO NOTA FISCAL - MATERIAL
					</h3>
					<p style="text-align:center;  font-size:14px;"><small>Periodo: '.implode("/",array_reverse(explode("-",$inicial))).' à '.implode("/",array_reverse(explode("-",$final))).'</small></p>
				</p>
				<p style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
					';
					$obra_controle = mysql_query("SELECT * FROM notas_obras WHERE id IN($oba)");
					while($c = mysql_fetch_array($obra_controle)){
						echo $c['descricao'].'<br/>';
					}
					echo '
				</p>
				<hr/>
			';		
			echo '<table class="table table-min table-striped" style="font-size:18px;">';
			echo '<thead><tr><th>ID</th><th>Categoria</th><th>Porce</th><th>Total</th></tr></thead><tbody>';
			$se = 0;	
			
			$categorias = mysql_query("select * from notas_itens");
			$categorias2 = mysql_query("select * from notas_itens");
			while($d = mysql_fetch_array($categorias2)) {
				$cat_id = $d['id'];
				$tot = mysql_result(mysql_query("select SUM(notas_itens_add.quantidade*notas_itens_add.valor) as totalSum, notas_itens_add.nota, notas_itens_add.item, notas_itens_add.categoria, notas_itens_add.quantidade, notas_itens_add.valor, notas_nf.recebimento FROM notas_nf, notas_itens_add WHERE notas_nf.id = notas_itens_add.nota AND notas_nf.obra in ($oba) AND notas_itens_add.item = '$cat_id' AND notas_itens_add.equipe in ($equ) AND notas_itens_add.categoria IN($eta) AND (notas_nf.recebimento BETWEEN '$inicial' AND '$final')ORDER BY notas_itens_add.categoria"),0,"totalSum");
				$total_porc += $tot;
			}
			while($c = mysql_fetch_array($categorias)) {
				$cat_id = $c['id'];
				if(mysql_result(mysql_query("select SUM(notas_itens_add.quantidade*notas_itens_add.valor) as totalSum, notas_itens_add.nota, notas_itens_add.item, notas_itens_add.categoria, notas_itens_add.quantidade, notas_itens_add.valor, notas_nf.recebimento FROM notas_nf, notas_itens_add WHERE notas_nf.id = notas_itens_add.nota AND notas_nf.obra in ($oba) AND notas_itens_add.item = '$cat_id' AND notas_itens_add.equipe in ($equ) AND notas_itens_add.categoria IN($eta) AND (notas_nf.recebimento BETWEEN '$inicial' AND '$final')ORDER BY notas_itens_add.categoria"),0,"totalSum") == ''){ 
					echo '<tr class="hidden">'; }else{ echo '<tr>'; $se += 1; 
				}
				echo '<td width="3%">'.$se.'</td>';
				
				echo '<td width="77%">'.$c['descricao'].'</td>';
				
				$totall = mysql_result(mysql_query("select SUM(notas_itens_add.quantidade*notas_itens_add.valor) as totalSum, notas_itens_add.nota, notas_itens_add.item, notas_itens_add.categoria, notas_itens_add.quantidade, notas_itens_add.valor, notas_nf.recebimento FROM notas_nf, notas_itens_add WHERE notas_nf.id = notas_itens_add.nota AND notas_nf.obra in ($oba) AND notas_itens_add.categoria IN($eta) AND notas_itens_add.item = '$cat_id' AND notas_itens_add.equipe in ($equ) AND (notas_nf.recebimento BETWEEN '$inicial' AND '$final')ORDER BY notas_itens_add.categoria"),0,"totalSum");
				$total_geral += $totall;
				$porc = ($totall/$total_porc)*100;
				echo '<td width="10%">'.number_format($porc,2,',','').'%</td>';
				echo '<td width="20%">'.money_format('%n', $totall).'</td>';
				echo '</tr>';
			}
			echo '</tbody></table>';
			echo '	<div class="page-header">
						<h1 class="pull-right" style="font-family: \'Oswald\', sans-serif; letter-spacing:5px;">Total Geral <small> R$ '.number_format($total_geral,2,",",".").'</small></h1>
					</div>';	
			exit;			
		}
	// E M P R E S A  ------------------------------------------------------------------------------------
		if($relatorio==13) {
			foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1);
			foreach($et as $ets) { @$eta .= $ets.','; } $eta = substr($eta,0,-1);
			foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);
			foreach($me as $med) { @$meu .= $med.','; } $meu = substr($meu,0,-1);
			echo '<table class="hidden-xs hidden-lg hidden-md visible-print" width="100%" style="margin-bottom:20px">';
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
			echo '<tr> </tr>';
		
			echo '</table>';
			$ano = explode("-",$final);
			echo '
				<p>
					<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
						RELATORIO NOTA FISCAL - EMPRESA
					</h3>
					<p style="text-align:center;  font-size:14px;"><small>Periodo: '.implode("/",array_reverse(explode("-",$inicial))).' à '.implode("/",array_reverse(explode("-",$final))).'</small></p>
				</p>
				<p style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
					';
					$obra_controle = mysql_query("SELECT * FROM notas_obras WHERE id IN($oba)");
					while($c = mysql_fetch_array($obra_controle)){
						echo $c['descricao'].'<br/>';
					}
					echo '
				</p>
				<hr/>
			';		
			echo '<table class="table table-min table-striped" style="font-size:18px;">';
			echo '<thead><tr><th>ID</th><th>Categoria</th><th>Total</th></tr></thead><tbody>';
					
			$categorias = mysql_query("select * from notas_empresas"); $se = 0; $total_geral = 0;
			while($c = mysql_fetch_array($categorias)) {
				$cat_id = $c['id'];
				if(mysql_result(mysql_query("select SUM(notas_itens_add.quantidade*notas_itens_add.valor) as totalSum, notas_itens_add.nota, notas_itens_add.item, notas_itens_add.categoria, notas_itens_add.quantidade, notas_itens_add.valor, notas_nf.recebimento FROM notas_nf, notas_itens_add WHERE notas_nf.id = notas_itens_add.nota AND notas_nf.obra in ($oba) AND notas_nf.empresa = '$cat_id' and (notas_nf.recebimento between '$inicial' and '$final')order by notas_nf.empresa"),0,"totalSum") == ''){ echo '<tr class="hidden">'; }else{ echo '<tr>'; $se += 1; }
				echo '<td width="20px">'.$se.'</td>';
				echo '<td>'.$c['nome'].'</td>';
				$totall = mysql_result(mysql_query("select SUM(notas_itens_add.quantidade*notas_itens_add.valor) as totalSum, notas_itens_add.nota, notas_itens_add.item, notas_itens_add.categoria, notas_itens_add.quantidade, notas_itens_add.valor, notas_nf.recebimento FROM notas_nf, notas_itens_add WHERE notas_nf.id = notas_itens_add.nota AND notas_nf.obra in ($oba) AND notas_nf.empresa = '$cat_id' and (notas_nf.recebimento between '$inicial' and '$final')order by notas_nf.empresa"),0,"totalSum");
				$total_geral += $totall;
				echo '<td width="10%">'.number_format($totall,2,",","").'</td>';
				
				echo '</tr>';
			}
			echo '</tbody></table>';	
			echo '	<div class="page-header">
						<h1 class="pull-right" style="font-family: \'Oswald\', sans-serif; letter-spacing:5px;">Total Geral <small> R$ '.number_format($total_geral,2,",",".").'</small></h1>
					</div>';		
			exit;		
		}
	// A L  M O X  --------------------------------------------------------------------------------------------------
		if($relatorio==9) {
			foreach($est as $ets) { @$stu .= $ets.','; } $stu = substr($stu,0,-1);
			foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1);
			foreach($et as $ets) { @$eta .= $ets.','; } $eta = substr($eta,0,-1);
			foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);
			foreach($me as $med) { @$meu .= $med.','; } $meu = substr($meu,0,-1);
			echo '<table class="hidden-xs hidden-lg hidden-md visible-print" width="100%" style="margin-bottom:20px">';
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
			echo '<tr> </tr>';
		
			echo '</table>';
			$ano = explode("-",$final);
			echo '
				<p>
					<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
						RELATORIO NOTA FISCAL - ALMOXARIFADO
					</h3>
					<p style="text-align:center;  font-size:14px;"><small>Periodo: '.implode("/",array_reverse(explode("-",$inicial))).' à '.implode("/",array_reverse(explode("-",$final))).'</small></p>
				</p>
				<p style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
					';
					$obra_controle = mysql_query("SELECT * FROM notas_obras WHERE id IN($oba)");
					while($c = mysql_fetch_array($obra_controle)){
						echo $c['descricao'].'<br/>';
					}
					echo '
				</p>
				<hr/>
			';		
			echo '<table class="table table-min table-striped table-bordered ">';
			echo '<thead>
						<tr>
							<th colspan="4" style="background:#fff; border-top:1px solid #fff; border-left:1px solid #fff; border-right:1px solid #ccc"></th>
							<th colspan="3" style="text-align:center">Controle Material</th>
							<th colspan="2" style="background:#fff; border-top:1px solid #fff; border-left:1px solid #ccc; border-right:1px solid #fff"></th>
						</tr>
						<tr><th>ID</th> <th>Status</th> <th>Categoria</th><th>Material / Sub-Categoria </th><th style="text-align:center">Entrada</th><th style="text-align:center">Saida</th><th style="text-align:center">Total</th><th style="text-align:center">Vlr UN</th><th style="text-align:center">Total Vlr</th></tr>
					</thead>
					<tbody>';
			
			$se = 0;	
			
			$categorias = mysql_query("select * from notas_itens where categoria in($eta) AND oculto IN($stu)");
			
			while($c = mysql_fetch_array($categorias)) {
				$cat_id = $c['id'];
				$categoria_id = $c['categoria'];
				
				$totall = mysql_result(mysql_query("SELECT SUM(notas_itens_add.quantidade) as totalSum FROM notas_nf INNER JOIN notas_itens_add ON notas_nf.id = notas_itens_add.nota WHERE notas_itens_add.item = '$cat_id' AND notas_itens_add.categoria <> '20' AND notas_itens_add.equipe IN($equ) AND (notas_nf.recebimento BETWEEN '$inicial' AND '$final') and notas_nf.obra IN($oba) ORDER BY notas_itens_add.categoria"),0,"totalSum");	

				$totallValor = mysql_result(mysql_query("SELECT SUM(notas_itens_add.quantidade*notas_itens_add.valor) as totalSum FROM notas_nf INNER JOIN notas_itens_add ON notas_nf.id = notas_itens_add.nota WHERE notas_itens_add.item = '$cat_id' AND notas_itens_add.categoria <> '20' AND notas_itens_add.equipe IN($equ) AND (notas_nf.recebimento BETWEEN '$inicial' AND '$final') and notas_nf.obra IN($oba)"),0,"totalSum");

				$totallUN = @mysql_result(mysql_query("SELECT notas_itens_add.valor as valor FROM notas_nf INNER JOIN notas_itens_add ON notas_nf.id = notas_itens_add.nota WHERE notas_itens_add.item = '$cat_id' AND notas_itens_add.categoria <> '20' AND notas_nf.obra IN($oba) ORDER BY notas_itens_add.id DESC LIMIT 1"),0,"valor");

				$total_cupom = mysql_result(mysql_query("SELECT SUM(notas_retirada_itens.quantidade) as totalCupom FROM notas_retirada INNER JOIN notas_retirada_itens ON notas_retirada.id = notas_retirada_itens.id_retirada WHERE id_item = '$cat_id' and notas_retirada.tipo = 1 and (notas_retirada.data between '$inicial' and '$final') and notas_retirada.obra IN($oba)"),0,"totalCupom");

				$totalnfcupom = $totall - $total_cupom;
				
				if($totall != '' || $total_cupom != ''){
					echo '<tr>'; $se += 1;
					echo '<td width="3%">'.$cat_id.'</td>';
					
					echo '<td width="3%">';
					if($c['oculto'] == '1'){ 
						echo '<span class="btn btn-xs small btn-danger" style="font-size:8px; width:45px;">INATIVO</span>';
					}else if($c['oculto'] == '2'){
						echo '<span class="btn btn-xs small btn-success" style="font-size:8px; width:45px;">ATIVO</span>';
					}
					echo '</td>'; 
					echo '<td>'.mysql_result(mysql_query("select * from notas_categorias where id = $categoria_id"),0,"descricao").'</td>';
					echo '<td width="50%">'.$c['descricao'].'</td>'; 
					echo '<td width="10%" style="text-align:center">'.number_format($totall,2,",","").'</td>';
					echo '<td width="10%" style="text-align:center">'.number_format($total_cupom,2,",","").'</td>';
					echo '<td width="10%" style="text-align:center">'.number_format($totalnfcupom,2,",","").'</td>';

					echo '<td width="10%" style="text-align:center">R$ '.number_format($totallUN,2,",",".").'</td>';
					echo '<td width="10%" style="text-align:center">R$ '.number_format($totallValor,2,",",".").'</td>';
					//echo '<td width="10%">R$ '.number_format($totallUN,2,",",".").'</td>';

					echo '</tr>';

					$total_geral += $totallValor;
				}
			}
			echo '</tbody></table>';
				echo '	<div class="page-header">
						<h1 class="pull-right" style="font-family: \'Oswald\', sans-serif; letter-spacing:5px;">Total Geral <small> R$ '.number_format($total_geral,2,",",".").'</small></h1>
					</div>';	
			exit;			
		}
	// D E T A L H A D O  --------------------------------------------------------------------------------------------------------------------
		if($relatorio==10) {
			foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1);foreach($et as $ets) { @$eta .= $ets.','; } $eta = substr($eta,0,-1);
			foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);foreach($me as $med) { @$meu .= $med.','; } $meu = substr($meu,0,-1);
			echo '<table class="hidden-xs hidden-lg hidden-md visible-print" width="100%" style="margin-bottom:20px">';
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
			echo '<tr> </tr>';
		
			echo '</table>';
			$ano = explode("-",$final);
			echo '
				<p>
					<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
						RELATORIO NOTA FISCAL - DETALHADO
					</h3>
					<p style="text-align:center;  font-size:14px;"><small>Periodo: '.implode("/",array_reverse(explode("-",$inicial))).' à '.implode("/",array_reverse(explode("-",$final))).'</small></p>
				</p>
				<p style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
					';
					$obra_controle = mysql_query("SELECT * FROM notas_obras WHERE id IN($oba)");
					while($c = mysql_fetch_array($obra_controle)){
						echo $c['descricao'].'<br/>';
					}
					echo '
				</p>
				<hr/>
			';		
			echo '<table class="table table-min table-striped">';
			echo '<tbody>';
			
			$ss_s = mysql_query("select sum(notas_itens_add.quantidade*notas_itens_add.valor) as totall, notas_nf.id as id_n, notas_nf.empresa as empresa, notas_itens_add.quantidade, notas_itens_add.valor, notas_nf.obra, notas_nf.numero FROM notas_nf INNER JOIN notas_itens_add ON notas_nf.id = notas_itens_add.nota WHERE notas_itens_add.equipe in ($equ) and notas_itens_add.categoria IN($eta) AND notas_nf.obra in ($oba) and (notas_nf.recebimento between '$inicial' and '$final') GROUP BY notas_nf.id ORDER BY notas_nf.numero") or die (mysql_error());
			
			while($l = mysql_fetch_array($ss_s)) { extract($l);	
				$total_nota += $totall;
				$mdvenc = mysql_query("select *, SUM(valor) as sum_parcelas from notas_nf_venc where nota = '$id_n' AND medicaovenc in($meu)");
				while($b = mysql_fetch_array($mdvenc)) {
					$total_geral2 += $totall; $se += 1;
					echo '<tr style="background: #d9edf7;">';	
						echo '<td><b>'.$se.'</b></td>';
						echo '<td width="30%" colspan="3" style="font-weight:bold"><b class="text-info">Nota: &nbsp;</b>'.$numero .' / '.@mysql_result(mysql_query("select * from notas_empresas where id = $empresa"),0,"nome").'</td>';
						echo '<td width="8%" colspan="2" style="font-weight:bold"><b class="text-info">Receb.: &nbsp;</b><span class="pull-right">'.implode("/",array_reverse(explode("-",$recebimento))).'</span></td>';
						echo '<td width="30%" colspan="3" style="font-weight:bold"><b class="text-info">Obra: &nbsp;</b>'.mysql_result(mysql_query("select * from notas_obras where id = '$obra'"),0,"descricao").'</td>';
						echo '<td width="10%" style="font-weight:bold;"><b class="text-info">Valor Nota: </b><span class="pull-right">R$ '.number_format($totall,2,",",".").'</span></td>';	
						echo '<td width="3%">';
						if($acesso_login == 'financeiro' || $acesso_login == 'moderador' || $acesso_login == 'master' || $acesso_login == 'financeiro-rh-ss' || $acesso_login == 'financeirorh' || $acesso_login == 'financeiroprov' || $acesso_login == 'liderrh' || $acesso_login == 'lider_admin' || $acesso_login == 'lider_equipamento') {
							echo '<a href="#" onclick=\'ldy("financeiro/itens-nota.php?id='.$id_n.'",".resultado")\' class="btn btn-info btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>';
						}
						echo '</td>';
					echo '</tr>';
					echo '<tr>';
						echo '<td width="3%"><b><small>Med: </b>'.$b['medicaovenc'].'</small></b></td>';
						echo '<td><b><small>ITEM:</small></b></td>';
						echo '<td><b><small>PARCELA:</small></b></td>';
						echo '<td><b><small>EQUIPE:</small></b></td>';
						echo '<td><b><small>CATEGORIA:</small></b></td>';
						echo '<td><b><small>OBS.:</small></b></td>';
						echo '<td><b><small>QTD:</small></b></td>';
						echo '<td><b><small>VLR:</small></b></td>';
						echo '<td><b><small>TOTAL ITEM:</small></b></td>';
						echo '<td><b class="text-warning"><small></b>Valor Parcela:<span class="pull-right">R$ '.number_format($b['valor'],2,",",".").'</span></small></td>';
						$total_geral += $b['valor'];
						echo '<td></td>';
					echo '</tr>';
						$itens = mysql_query("SELECT * FROM notas_itens_add WHERE nota = $id_n AND notas_itens_add.equipe in ($equ)");
						$si = 0;
						while($c = mysql_fetch_array($itens)){
							$si += 1;
							$cat_itens_de = $c['categoria'];
							$ite_de = $c['item'];
							$equipe_item = $c['equipe'];
							$parcela = $c['parcela'];
							echo '<tr>';
								echo '<td><small>'.$si.'</small></td>';
								if($cat_itens_de == 20){
									echo '<td>'.@mysql_result(mysql_query("select * from notas_equipamentos where id = $ite_de"),0,"marca").' / '.@mysql_result(mysql_query("select * from notas_equipamentos where id = $ite_de"),0,"placa").'</td>';
									echo '<td>'.$parcela.'</td>';
								}else{
									echo '<td>'.@mysql_result(mysql_query("select * from notas_itens where id = $ite_de"),0,"descricao").'</td>';
									echo '<td> - </td>';
								}
								echo '<td>'.@mysql_result(mysql_query("select * from equipes where id = $equipe_item"),0,"nome").'</td>';
								echo '<td>'.@mysql_result(mysql_query("select * from notas_categorias where id = '$cat_itens_de'"),0,"descricao").'</td>';
								if($c['observacoes'] == ''){
									echo '<td style="text-align:center"><small>S/OBS</small></td>';
								}else{
									echo '<td style="text-align:center">'.$c['observacoes'].'</td>';
								}
								echo '<td>'.number_format($c['quantidade'],2,",",".").'</td>';
								echo '<td>R$ '.number_format($c['valor'],2,",",".").'</td>';
								$valorB = $c['valor'] - $c['desconto'];
								$total_item_de = $c['quantidade']*$valorB;
								echo '<td>R$ '.number_format($total_item_de,2,",",".").'</td>';
								echo '<td colspan="2"></td>';
							echo '</tr>';
						}	
						echo '<tr style="border:1px solid #fff;"><td colspan="10"></td></tr>';
				}			
			}
			echo '</tbody></table>';
			echo '
			<table class="table pull-right">
				<tr><h2 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px;">Total de Parcelas: <small> R$ '.number_format($total_geral,2,",",".").'</small></h2></tr>
				<tr><h2 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px;">Total Itens: <small> R$ '.number_format($total_nota,2,",",".").'</small></h2></tr>
			</table>';
			
			exit;		
		}
	//  S I M P L E S  -----------------------------------------------------------------------------------------------------------------
		if($relatorio==11) {
			foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1);foreach($et as $ets) { @$eta .= $ets.','; } $eta = substr($eta,0,-1);
			foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);foreach($me as $med) { @$meu .= $med.','; } $meu = substr($meu,0,-1);
			echo '<table class="hidden-xs hidden-lg hidden-md visible-print" width="100%" style="margin-bottom:20px">';
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
			echo '<tr> </tr>';
		
			echo '</table>';
			$ano = explode("-",$final);
			echo '
				<p>
					<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
						RELATORIO NOTA FISCAL - SIMPLES
					</h3>
					<p style="text-align:center;  font-size:14px;"><small>Periodo: '.implode("/",array_reverse(explode("-",$inicial))).' à '.implode("/",array_reverse(explode("-",$final))).'</small></p>
				</p>
				<p style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
					';
					$obra_controle = mysql_query("SELECT * FROM notas_obras WHERE id IN($oba)");
					while($c = mysql_fetch_array($obra_controle)){
						echo $c['descricao'].'<br/>';
					}
					echo '
				</p>
				<hr/>
			';		
			echo '<table class="table table-min table-striped" style="font-size:11px;">';
			echo '<tbody>';
			$ss_s = mysql_query("SELECT SUM(quantidade*(valor-desconto)) AS totall, notas_nf.id AS id_n, notas_nf.numero, notas_nf.empresa AS empresa, notas_itens_add.quantidade, notas_itens_add.valor, notas_itens_add.desconto, notas_nf.obra FROM notas_nf INNER JOIN notas_itens_add ON notas_nf.id = notas_itens_add.nota WHERE notas_itens_add.equipe in ($equ) AND notas_nf.obra IN($oba) AND notas_itens_add.categoria IN($eta) AND notas_itens_add.categoria NOT IN(18) AND (notas_nf.recebimento between '$inicial' and '$final') GROUP BY notas_nf.id ORDER BY notas_nf.numero") or die (mysql_error());		
			while($l = mysql_fetch_array($ss_s)) { extract($l);	
				$total_notas += $totall;
				$medvenc = mysql_query("select * from notas_nf_venc where nota = $id_n AND medicaovenc in($meu)");
				while($b = mysql_fetch_array($medvenc)) {		
					$total_geral2 += $totall;
					echo '<tr style="background: #d9edf7;">';	
					echo '<td width="10%" style="font-weight:bold"><b class="text-info">Nota: &nbsp;</b>'.$numero.'</td>';
					echo '<td width="20%" style="font-weight:bold"><b class="text-info">Obra: &nbsp;</b>'.mysql_result(mysql_query("select * from notas_obras where id = '$obra'"),0,"descricao").'</td>';
					echo '<td width="20%" style="font-weight:bold"><b class="text-info">Receb.: &nbsp;</b><span class="pull-right">'.implode("/",array_reverse(explode("-",$recebimento))).'</span></td>';
					echo '<td width="40%" style="font-weight:bold"><b class="text-info">Empresa: &nbsp;</b>'.@mysql_result(mysql_query("select * from notas_empresas where id = $empresa"),0,"nome").'</td>';
					echo '<td style="font-weight:bold;"><b class="text-info">Valor: </b><span class="pull-right">R$ '.number_format($totall,2,",",".").'</span></td>';				
					echo '<tr><td style="border:none;"></td>';
					echo '<td><b><small>Medi��o: </b>'.$b['medicaovenc'].'</small></td>';
					echo '<td><b><small>Vencimento: </b><span class="pull-right">'.implode("/",array_reverse(explode("-",$b['data']))).'</small></span></td>';
					if($observacoes != ''){
						echo '<td style="opacity:0.7"><b><small>Obs.: '.$observacoes.'</small></td>';
					}else{
						echo '<td></td>';	
					}
						$valorB = $l['valor'] - $l['desconto'];
						$total_item_de = $l['quantidade']*$valorB;
					echo '<td><b class="text-warning"><small></b> <span class="pull-right">R$ '.number_format($total_item_de,2,",",".").'</span></small></td>';
					echo '</tr>';
					$total_geral += $b['valor'];				
				}			
			}
			echo '</tbody></table>';
			echo '<div class="page-header">
					<h1 class="pull-right" style="font-family: \'Oswald\', sans-serif; letter-spacing:5px;">Total Geral <small> R$ '.number_format($total_notas,2,",",".").'</small></h1>
					</div>';		
			exit;		
		}			
		if($relatorio=='111') {
			foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1);foreach($et as $ets) { @$eta .= $ets.','; } $eta = substr($eta,0,-1);
			foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);foreach($me as $med) { @$meu .= $med.','; } $meu = substr($meu,0,-1);
			echo '<table class="hidden-xs hidden-lg hidden-md visible-print" width="100%" style="margin-bottom:20px">';
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
			echo '<tr> </tr>';
		
			echo '</table>';
			$ano = explode("-",$final);
			echo '
				<p>
					<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
						RELATORIO NOTA FISCAL - SIMPLES
					</h3>
					<p style="text-align:center;  font-size:14px;"><small>Periodo: '.implode("/",array_reverse(explode("-",$inicial))).' à '.implode("/",array_reverse(explode("-",$final))).'</small></p>
				</p>
				<p style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
					';
					$obra_controle = mysql_query("SELECT * FROM notas_obras WHERE id IN($oba)");
					while($c = mysql_fetch_array($obra_controle)){
						echo $c['descricao'].'<br/>';
					}
					echo '
				</p>
				<hr/>
			';		
			echo '<table class="table table-min table-striped" style="font-size:11px;">';
			echo '<tbody>';
			$ss_s = mysql_query("SELECT SUM(quantidade*(valor-desconto)) AS totall, notas_nf.id AS id_n, notas_nf.numero, notas_nf.empresa AS empresa, notas_itens_add.quantidade, notas_itens_add.valor, notas_itens_add.desconto, notas_nf.obra FROM notas_nf INNER JOIN notas_itens_add ON notas_nf.id = notas_itens_add.nota WHERE notas_itens_add.equipe in ($equ) AND notas_nf.obra IN($oba) AND notas_itens_add.categoria IN($eta) AND notas_itens_add.categoria NOT IN(18) AND (notas_nf.dataxml between '$inicial' and '$final') GROUP BY notas_nf.id ORDER BY notas_nf.numero") or die (mysql_error());		
			while($l = mysql_fetch_array($ss_s)) { extract($l);	
				$total_notas += $totall;
				$medvenc = mysql_query("select * from notas_nf_venc where nota = $id_n AND medicaovenc in($meu)");
				while($b = mysql_fetch_array($medvenc)) {		
					$total_geral2 += $totall;
					echo '<tr style="background: #d9edf7;">';	
					echo '<td width="10%" style="font-weight:bold"><b class="text-info">Nota: &nbsp;</b>'.$numero.'</td>';
					echo '<td width="20%" style="font-weight:bold"><b class="text-info">Obra: &nbsp;</b>'.mysql_result(mysql_query("select * from notas_obras where id = '$obra'"),0,"descricao").'</td>';
					echo '<td width="20%" style="font-weight:bold"><b class="text-info">Receb.: &nbsp;</b><span class="pull-right">'.implode("/",array_reverse(explode("-",$recebimento))).'</span></td>';
					echo '<td width="40%" style="font-weight:bold"><b class="text-info">Empresa: &nbsp;</b>'.@mysql_result(mysql_query("select * from notas_empresas where id = $empresa"),0,"nome").'</td>';
					echo '<td style="font-weight:bold;"><b class="text-info">Valor: </b><span class="pull-right">R$ '.number_format($totall,2,",",".").'</span></td>';				
					echo '<tr><td style="border:none;"></td>';
					echo '<td><b><small>Medição: </b>'.$b['medicaovenc'].'</small></td>';
					echo '<td><b><small>Vencimento: </b><span class="pull-right">'.implode("/",array_reverse(explode("-",$b['data']))).'</small></span></td>';
					if($observacoes != ''){
						echo '<td style="opacity:0.7"><b><small>Obs.: '.$observacoes.'</small></td>';
					}else{
						echo '<td></td>';	
					}
						$valorB = $l['valor'] - $l['desconto'];
						$total_item_de = $l['quantidade']*$valorB;
					echo '<td><b class="text-warning"><small></b> <span class="pull-right">R$ '.number_format($total_item_de,2,",",".").'</span></small></td>';
					echo '</tr>';
					$total_geral += $b['valor'];				
				}			
			}
			echo '</tbody></table>';
			echo '<div class="page-header">
					<h1 class="pull-right" style="font-family: \'Oswald\', sans-serif; letter-spacing:5px;">Total Geral <small> R$ '.number_format($total_notas,2,",",".").'</small></h1>
					</div>';		
			exit;		
		}				
	}
?>
	<div style="clear: both;" class="hidden-print">
		<img class="logo-print" src="http://polemicalitoral.com.br/guaruja/imagens/logo.png" style="float:left; position:relative; bottom:10px; margin-right:10px" width="50px"/>
		<h3 style="font-family: 'Oswald', sans-serif; letter-spacing:5px; position:relative; top:10px;"> 
			<p>RELATORIO <small>NOTAS FISCAIS</small></p>
		</h3>
		<a a href="javascript:window.print()" style="letter-spacing:5px; position:relative; bottom:10px;" class="hidden-xs hidden-print pull-right btn btn-warning btn-sm"> <span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Imprimir</a>
	</div>
	<div style="clear: both;" class="hidden-print">
		<hr></hr>
	</div>
	<div class="hidden-print">
		<form action="javascript:void(0)" onSubmit="posti(this,'almoxarifado/relatorio-notas.php?ac=listar','.resultado');" class="form-inline">
			<div class="well well-sm" style="padding:5px 10px 0px 10px;">
				<label><small>Obra:</small>
					<select name="cidade" onChange="$('#itens').load('almoxarifado/relatorio-notas.php?atu=ac&cidade=' + $(this).val() + '');" class="sel" multiple="multiple" required> 
						<?php
							$cidade = mysql_query("select * from notas_obras_cidade WHERE id IN(0,$cidade_usuario) order by nome asc");
							while($l = mysql_fetch_array($cidade)) {
								echo '<option value="'.$l['id'].'" selected>'.$l['nome'].'</option>';
							}
						?>	
					</select>
				</label>
				<label id="itens">
					<label><small>Contrato:</small>
						<select name="ob[]" class="sel" multiple="multiple" style="width:100%">
							<?php
								$obras = mysql_query("select * from notas_obras where id IN(0,$obra_usuario) order by descricao asc");
								while($l = mysql_fetch_array($obras)) {
									echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>';
								}
							?>		
						</select>
					</label>
					<label for="">
						<small>Status:</small>
						<select name="st[]" OnChange="$('#itens2').load('ss/relatorio-medicao-equipes-novo.php?atu=st2&status3=' + $(this).val() + '');" class="sel" multiple="multiple">
							<option value="0" selected>ATIVA</option>
							<option value="1" selected>INATIVA</option>
						</select>
					</label>
					<label id="itens2">
						<label for="" id="itens2">
							<small>Equipes:</small>
							<select name="eq[]" class="sel" multiple="multiple">
								<?php
									$encarregados = mysql_query("select * from equipes WHERE obra IN(0,$cidade_usuario) order by nome asc");
									while($x = mysql_fetch_array($encarregados)) {
										echo '<option value="'.$x['id'].'" selected>'.$x['nome'].'</option>';
									}
								?>		
							</select>
						</label>
					</label>
				</label>
				
				<label for=""><input type="date" name="inicial" value="<?php echo $inicioMes; ?>" class="form-control input-sm" size="6" placeholder="Inicial" required/></label>
				<label for=""><input type="date" name="final" value="<?php echo $todayTotal; ?>" class="form-control input-sm" size="6" placeholder="Final" required/></label>
				<label for="">
					<select name="relatorio" class="form-control input-sm" style="width: 180px">
						<option value="" disabled>SELECIONE O TIPO DE RELATÓRIO DESEJADO</option>
						<option value="10">DETALHADA</option>
						<option value="11">SIMPLES</option>
						<option value="111">SIMPLES (REF)</option>
						<option value="13">MEMORIA P/ EMPRESA </option>
						<option value="7">MEMORIA P/ CATEGORIA</option>
						<option value="8">MEMORIA P/ MATERIAL</option>
						<option value="9">MEMORIA ALMOX </option>
					</select>
				</label>
				<label for=""><small>Categoria: </small>
					<select name="et[]" class="sel" multiple="multiple">
						<?php
							$sql = mysql_query("select * from notas_categorias order by descricao asc");
							while($l = mysql_fetch_array($sql)) { extract($l);
								echo '<option value="'.$id.'" selected>'.$descricao.'</option>';
							}
						?>
					</select>
				</label>
				<label for=""><small>Status Material:</small> 
						<select name="est[]" class="sel" multiple="multiple">
							<option value="1" selected> INATIVO</option>
							<option value="2" selected> ATIVO</option>
						</select>
				</label>
				<label for=""><small>Medição:</small>
					<select name="me[]" class="sel" multiple="multiple">
						<option value="0" selected>S/MEDICAO</option>
						<?php 
						for($i = 1; $i <= 50; $i++)
						{
							echo '<option value='.$i.' selected>'.$i.'</option>';
						}
						?>						
					</select>
				</label>
				
				<input type="submit" style="margin-left:5px; width:100px;" value="Buscar" class="btn btn-success btn-sm" />
			</div>	
		</form>
	</div>
	<div class="resultado"></div>