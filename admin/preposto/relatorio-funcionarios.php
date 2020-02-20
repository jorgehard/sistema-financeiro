<?php
include("../config.php");
include("../validar_session.php");
date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_MONETARY,"pt_BR", "ptb");
$today = getdate(); 
$data = date("d/m/Y", mktime(gmdate("d"), gmdate("m"), gmdate("Y")));
$hora = $today['hours'].':'.$today['minutes'].':'.$today['seconds'].'';

	if($today['mon'] < 10){ 
		$today['mon'] = '0'.$today['mon'];
	} else { 
		$today['mon'] = $today['mon'];
	} 
	if($today['mday'] < 10){ 
		$today['mday'] = '0'.$today['mday']; 
	}else{ 
		$today['mday'] = $today['mday']; 
	}  
	$todayTotal	= 	$today['year'].'-'.$today['mon'].'-'.$today['mday'];
	$inicioMes	= 	$today['year'].'-'.$today['mon'].'-01';
	
	$data_min = new DateTime($todayTotal);
    $data_min->sub(new DateInterval('P3M'));
	$data_min=$data_min->format('Y-m-d');
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
			echo '<select name="ob[]" style="width:250px;" class="sel" multiple="multiple">';
				$obras = mysql_query("select * from notas_obras where cidade IN(0,$cidade) and id in(0,$obra_usuario) order by descricao asc");
				while($l = mysql_fetch_array($obras)) {
					echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>';
				}
			echo '</select>
		</label>
		<label for=""><small>Encarregados:</small>
			<select name="enc[]" class="sel" multiple="multiple">';
				$encarregados = mysql_query("select * from encarregados WHERE obra IN(0,$cidade) order by nome asc");
				while($z = mysql_fetch_array($encarregados)) {
					echo '<option value="'.$z['id'].'" selected>'.$z['nome'].'</option>';
				}		
			echo '</select>
		</label>
		<label for="">
			<small>Status:</small>
			<select name="st[]" OnChange="$(\'#itens2\').load(\'financeiro/relatorio-funcionarios.php?atu=st2&cidade='.$cidade.'&status3=\' + $(this).val() + \'\');" class="sel" multiple="multiple">
				<option value="0" selected>ATIVA</option>
				<option value="1" selected>INATIVA</option>
			</select>
		</label>
		<label id="itens2">
			<label for="">
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
	if($atu=='st2'){
		if(!isset($cidade)){
			$cidade = "0,".$cidade_usuario."";
		}
		echo '		
		<label for="">
			<label><small>Equipes:</small>
			<select name="eq[]" class="sel" multiple="multiple">';
				$equipe = mysql_query("select * from equipes WHERE obra IN(0, $cidade) AND status IN($status3) order by nome asc");
				while($x = mysql_fetch_array($equipe)) {
					echo '<option value="'.$x['id'].'" selected>'.$x['nome'].'</option>';
				}	
			echo '</select>
			</label>
		</label>';
		exit;
		
	}
	if(@$ac=='listar') {
		$consultalistalog = "Data:".$inicial." - ".$final." / Relatorio: ".$relatorio."";
		mysql_query("INSERT INTO `log_delete`(`data`, `user`, `descricao`) VALUES (now(),'$login_usuario','$consultalistalog')"); 
	// SIMPLES
	if($relatorio==1) {
		foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);
		foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1);
		foreach($si as $sis) { @$siu .= $sis.','; } $siu = substr($siu,0,-1);
		foreach($ci as $cis) { @$ciu .= $cis.','; } $ciu = substr($ciu,0,-1);
		foreach($enc as $encs) { @$enca .= $encs.','; } $enca = substr($enca,0,-1);
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
		echo '</table>';
		$ano = explode("-",$todayTotal);
		echo '
		<p>
			<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
				RELATÓRIO DETALHADO DE EQUIPES 
			</h3>
			<p style="text-align:center;  font-size:14px;"><small>Período: '.implode("/",array_reverse(explode("-",$todayTotal))).'</small></p>
		</p>
		<p style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">';
		$obra_controle = mysql_query("SELECT * FROM notas_obras WHERE id IN($oba)");
		while($c = mysql_fetch_array($obra_controle)){	echo $c['descricao'].'<br/>'; }
		echo '
		</p>
		<hr/>
		';
		echo '<table class="table table-striped table-condensed">';
		echo '<thead>';
		$encquery = mysql_query("SELECT * FROM encarregados WHERE id IN($enca) AND obra IN($ciu) ORDER BY nome ASC");
		while($a = mysql_fetch_array($encquery)){
			$eqpcount = mysql_num_rows(mysql_query("SELECT * FROM equipes WHERE encarregado = ".$a['id']." AND id IN($equ)"));
			if($eqpcount == 0){
			echo '<tr class="hidden">
						<th colspan="10">'.$a['nome'].'</th>
					</tr>';
			}else{
				echo '<tr class="success">
						<th colspan="10">'.$a['nome'].'</th>
					</tr>';
				
			}
			$eqpquery = mysql_query("SELECT * FROM equipes WHERE encarregado = ".$a['id']." AND obra IN($ciu) AND id IN($equ) ORDER BY nome ASC");
			$total_producao = 0;
			while($b = mysql_fetch_array($eqpquery)){
				echo '<tr class="small info">';
				echo '<th>Nº</th>
						<th>'.$b['nome'].' <small class="hidden-print"> &nbsp; / &nbsp; ID: '.$b['id'].'</small></th>
						<th width="10px">OBRA</th>
						<th width="10px">FUNÇÃO</th>
						<th width="10px">SITUAÇÃO</th>
						<th width="10px" class="hidden-print"></th>
					</tr>';
				$sql = mysql_query("SELECT *, id as id_2, funcao as cargo_func, (SELECT lider_geral FROM equipes WHERE lider_geral = id_2 GROUP BY lider_geral) as lider_geral, (SELECT salario FROM rh_funcoes WHERE rh_funcoes.id = cargo_func) as salario FROM rh_funcionarios WHERE situacao IN($siu) AND equipe = ".$b['id']." AND (obra IN($oba) OR tipo_emp = '1') ORDER BY lider_geral DESC");
				
				
				while($c = mysql_fetch_array($sql)) {
					$lider_geral = $b['lider_geral'];
					$salario = $c['salario'];
					$obra_fun = $c['obra'];
					$id_func = $c['id_2'];
					$situacao = explode("_",@mysql_result(@mysql_query("SELECT * FROM rh_situacao WHERE id = ".$c['situacao'].""),0,"descricao"));
					$se2 += 1;
					// =============================
					if(isset($c['lider_geral'])){
						echo '<tr class="text-danger">';
					}else{
						echo '<tr>';
					}
					echo '<td width="3%">'.$se2.'</td>';
					echo '<td width="35%">'.$c['nome'].'</td>';
					echo '<td width="15%">'.mysql_result(mysql_query("SELECT * FROM notas_obras WHERE id = $obra_fun"),0,"nome_exibir").'</td>';	
					echo '<td width="30%">'.mysql_result(mysql_query("SELECT * FROM rh_funcoes WHERE id = ".$c['funcao'].""),0,"descricao").'</td>';	
					echo '<td width="15%">'.$situacao[1].'</td>';		
					if($acesso_login == 'master' || $acesso_login == 'moderador' || $acesso_login=='rh' || $acesso_login == 'liderrh' || $acesso_login == 'lider_admin'){
						echo '<td width="10px" class="hidden-print"><a href="#" style="margin:0px 10px 0px 10px; font-size:8px" class="btn btn-xs btn-primary"onclick=\'ldy("rh/editar-funcionario.php?acesso_login='.$acesso_login.'&id='.$id_func.'",".resultado")\'><span class="glyphicon glyphicon-pencil"></span></a></td>';
					}else{
						echo '<td width="10px" class="hidden-print"><a href="#" style="margin:0px 10px 0px 10px; font-size:8px" class="btn btn-xs btn-info" onclick=\'ldy("rh/ver-rh.php?acesso_login='.$acesso_login.'&id='.$id_func.'",".resultado")\'><span class="glyphicon glyphicon-eye-open"></span></a></td>';
					}						
					echo '</tr>'; 
					$total_geral += $salario;

				}
			}
		}
		echo '</tbody>';
		echo '</table>';
	exit;
	}
	//GASTOS
	if($relatorio==2) {
		foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);
		foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1);
		foreach($si as $sis) { @$siu .= $sis.','; } $siu = substr($siu,0,-1);
		foreach($ci as $cis) { @$ciu .= $cis.','; } $ciu = substr($ciu,0,-1);
		foreach($enc as $encs) { @$enca .= $encs.','; } $enca = substr($enca,0,-1);
		if($inicial == '' || $final == ''){ 
			echo '<span class="text-danger">Periodo, obrigatorio</span>';
			exit;
		}
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
		echo '</table>';
		$ano = explode("-",$final);
		echo '
		<p>
			<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
				RELATÓRIO DE GASTOS GERAIS
			</h3>
			<p style="text-align:center;  font-size:14px;"><small>Período: '.implode("/",array_reverse(explode("-",$inicial))).' á '.implode("/",array_reverse(explode("-",$final))).'</small></p>
		</p>
		<p style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">';
		$obra_controle = mysql_query("SELECT * FROM notas_obras WHERE id IN($oba)");
		while($c = mysql_fetch_array($obra_controle)){	echo $c['descricao'].'<br/>'; }
		echo '
		</p>
		<hr/>
		';
		echo '<table class="table table-striped table-condensed small" style="font-size:10px">';
		echo '<thead>';
		$encquery = mysql_query("SELECT * FROM encarregados WHERE id IN($enca) ORDER BY nome ASC");
		while($a = mysql_fetch_array($encquery)){
			echo '<tr class="success"><th colspan="10">'.$a['nome'].'</th><th colspan="2"></th></tr>';
			
			$eqpquery = mysql_query("SELECT * FROM equipes WHERE encarregado = ".$a['id']." AND id IN($equ) ORDER BY nome ASC");
			$total_producao = 0;
			while($b = mysql_fetch_array($eqpquery)){
				echo '<tr class="small info">';
				echo '	<th>Nº</th>
						<th>'.$b['nome'].' &nbsp; / &nbsp; <small>ID: '.$b['id'].'</small></th>
						<th width="10px" style="text-align:center">SALARIO & ENCARGOS</th>
						<th width="10px" style="text-align:center">VR / VA / VT</th>
						<th width="10px" style="text-align:center">LOCAÇÃO</th>
						<th width="10px" style="text-align:center">COMBUSTIVEL</th>
						<th width="10px" style="text-align:center">GALÃO</th>
						<th width="10px" style="text-align:center">ALMOX</th>
						<th width="10px" style="text-align:center">NOTA</th>
						<th width="10px" style="text-align:center">MAO OBRA</th>
						<th width="10px" style="text-align:center">TOTAL</th>
						<th width="10px" style="text-align:center">MEDIDO</th>
					</tr>';
				
				$total_equipe = 0;
				$lider_geral = $b['lider_geral'];
				$categoria_equipe = $b['categoria'];
				
				$locacao = mysql_result(mysql_query("SELECT notas_nf.id, notas_nf.obra, notas_nf.dataxml, item, categoria, desconto, notas_itens_add.equipe, SUM(quantidade*valor) as total FROM notas_nf INNER JOIN notas_itens_add ON notas_itens_add.nota = notas_nf.id WHERE categoria = '12' AND notas_itens_add.equipe = '".$b['id']."' AND (dataxml BETWEEN '$inicial' AND '$final') AND notas_nf.obra IN($oba)"),0,"total");

				$total_gasolina = @mysql_result(mysql_query("SELECT SUM(qtd*vlr) AS total FROM comb_rm INNER JOIN comb_rm_itens ON comb_rm.id = comb_rm_itens.cod_rm INNER JOIN notas_equipamentos ON notas_equipamentos.id = comb_rm.equipamento WHERE notas_equipamentos.sub_categoria NOT IN(61) and comb_rm.equipe = '".$b['id']."' AND (comb_rm.data_ref BETWEEN '$inicial' AND '$final') AND comb_rm.obra IN($oba)"),0,"total");
				
				$reti_polemica = @mysql_result(mysql_query("SELECT SUM(quantidade * (SELECT valor FROM notas_itens_add INNER JOIN notas_nf ON notas_itens_add.nota = notas_nf.id WHERE notas_nf.obra = notas_retirada.obra AND notas_itens_add.item = notas_retirada_itens.id_item ORDER BY notas_itens_add.id DESC LIMIT 1)) as total FROM notas_retirada INNER JOIN notas_retirada_itens ON notas_retirada.id = notas_retirada_itens.id_retirada WHERE notas_retirada.equipe = '".$b['id']."' AND (notas_retirada.data BETWEEN '$inicial' and '$final')"),0,"total");

				$notafiscal = @mysql_result(mysql_query("select sum(quantidade*valor) as total FROM notas_nf INNER JOIN notas_itens_add ON notas_nf.id = notas_itens_add.nota WHERE notas_nf.obra IN($oba) AND notas_itens_add.categoria NOT IN(6,7,12,18,20) AND (notas_nf.dataxml BETWEEN '$inicial' AND '$final') AND notas_itens_add.equipe = '".$b['id']."'"),0,"total");
				
				$notafiscal_maoobra = @mysql_result(mysql_query("select sum(quantidade*valor) as total FROM notas_nf INNER JOIN notas_itens_add ON notas_nf.id = notas_itens_add.nota WHERE notas_nf.obra IN($oba) AND notas_itens_add.categoria IN(7,18) AND (notas_nf.dataxml BETWEEN '$inicial' AND '$final') AND notas_itens_add.equipe = '".$b['id']."'"),0,"total");
	
				$eqp2 = mysql_query("select *, sum(ss_se.qtd) as qtd_total from ss_se, ss_principal where ss_se.cod_ss = ss_principal.id and ss_se.equipe = '".$b['id']."' AND ss_principal.obra IN($oba) AND (ss_se.data between '$inicial' and '$final') group by ss_se.servico");
				$v_total = 0;
				while($z = mysql_fetch_array($eqp2)) {
					$total_producao = $z['qtd_total']*@mysql_result(mysql_query("select * from ss_itens where id = ".$z['servico'].""),0,"preco");
					$v_total += $total_producao;
				}
				$sql = mysql_query("SELECT *, id as id_2, funcao as cargo_func, (SELECT lider_geral FROM equipes WHERE lider_geral = id_2 GROUP BY lider_geral) as lider_geral, (SELECT salario FROM rh_funcoes WHERE rh_funcoes.id = cargo_func) as salario FROM rh_funcionarios WHERE situacao IN($siu) AND equipe = ".$b['id']." AND (obra IN($oba) OR tipo_emp = '1') ORDER BY lider_geral DESC");
				while($c = mysql_fetch_array($sql)) {
					$salario = $c['salario'];
					$encargo_valor = $salario*0.8;
					$se2 += 1;
					$vale_alimentacao = $c['vale_alimentacao'];
					// ==== COMBUSTIVEL & GALAO ====

					$galao = mysql_result(mysql_query("SELECT SUM(qtd*vlr) AS total FROM comb_rm INNER JOIN comb_rm_itens ON comb_rm.id = comb_rm_itens.cod_rm INNER JOIN notas_equipamentos ON comb_rm.equipamento = notas_equipamentos.id WHERE notas_equipamentos.sub_categoria = '61' and comb_rm_itens.funcionario = ".$c['id']." AND (comb_rm.data_ref BETWEEN '$inicial' AND '$final') AND comb_rm.obra IN($oba)"),0,"total");

					if(isset($c['lider_geral'])){
						echo '<tr class="text-danger">';
					}else{
						echo '<tr>';
					}
					echo '<td width="10px">'.$se2.'</td>';
					echo '<td width="300px">'.$c['nome'].'</td>';
					echo '<td width="10px" style="text-align:center">R$'.@number_format($salario + $encargo_valor,"2",",",".").'</td>';		
					// ==== FALTAS & DIAS ADICIONAIS ====
					$dias_adicionais = mysql_result(mysql_query("select *, count(id) as total from rh_horaextra where (data between '$inicial' and '$final') and funcionario = '".$c['id']."' and porcentagem <> 0 and hora_extra <> '0.00' and beneficio = 1"),0,"total");
					$faltas = mysql_result(mysql_query("select *, count(id) as total from rh_horaextra where (data between '$inicial' and '$final') and funcionario = '".$c['id']."' and falta IN(1,2)"),0,"total");
					$dias_uteis = ($du+$dias_adicionais)-$faltas;
					$total_refeicao = $dias_uteis*$c['vale_refeicao'];
					$transporte1 = $dias_uteis*($c['vale_qtd']*2);
					$transporte2 = $dias_uteis*($c['vale_qtd2']*2);
					$transporte_total = $transporte1 + $transporte2;
					$du_controle = $du - 3;
					
					echo '<td width="50px" style="text-align:center">R$'.@number_format($transporte_total + $total_refeicao + $vale_alimentacao,"2",",",".").'</td>';
					$vale_alimentacao = 0;

					if($locacao == ''){
						echo '<td width="50px" style="text-align:center"> - </td>';	
						$locacao = 0;
					}else{
						echo '<td width="50px" style="text-align:center">R$'.@number_format($locacao,"2",",",".").'</td>';	
					}
					if($total_gasolina == ''){
						$total_gasolina = 0;
						echo '<td width="50px" style="text-align:center"> - </td>';
					}else{
						echo '<td width="50px" style="text-align:center">R$'.@number_format($total_gasolina,"2",",",".").'</td>';
					}
					if($galao == ''){
						$galao = 0;
						echo '<td width="50px" style="text-align:center"> - </td>';
					}else{
						echo '<td width="50px" style="text-align:center">R$'.number_format($galao,"2",",",".").'</td>';
					}
					if($reti_polemica == ''){
						$reti_polemica = 0;
						echo '<td width="50px" style="text-align:center"> - </td>';
					}else{
						echo '<td width="50px" style="text-align:center">R$'.number_format($reti_polemica,"2",",",".").'</td>';
					}
					if($notafiscal == ''){
						$notafiscal = 0;
						echo '<td width="50px" style="text-align:center"> - </td>';
					}else{
						echo '<td width="50px" style="text-align:center">R$'.number_format($notafiscal,"2",",",".").'</td>';
					}
					if($notafiscal_maoobra == ''){
						$notafiscal_maoobra = 0;
						echo '<td width="50px" style="text-align:center"> - </td>';
					}else{
						echo '<td width="50px" style="text-align:center">R$'.number_format($notafiscal_maoobra,"2",",",".").'</td>';
					}
										
					$total_geral = $salario + $encargo_valor + $total_gasolina + $locacao + $galao + $vale_alimentacao + $total_refeicao + $valor_producao + $notafiscal + $notafiscal_maoobra + $reti_polemica + $transporte_total;
					echo '<td width="50px" style="text-align:center">R$'.@number_format($total_geral,"2",",",".").'</td>';
					if($v_total == '0'){
						$v_total = 0;
						echo '<td width="50px" style="text-align:center"> - </td>';
					}else{
						echo '<td width="50px" style="text-align:center">R$'.number_format($v_total,"2",",",".").'</td>';
					}
					echo '</tr>'; 
					//TOTAL EQUIPE
					$total_equipe += $total_geral;
					$total_salario += $salario;
					$total_encargos += $encargo_valor;
					$total_vale_transporte += $transporte_total;
					$total_vale_refeicao += $total_refeicao;
					$total_vale_alimentacao += $vale_alimentacao;
					$total_locacao += $locacao;
					$total_combustivel += $total_gasolina;
					$total_galao += $galao;
					$total_reti_polemica += $reti_polemica;
					$total_notafiscal += $notafiscal;
					$total_notafiscal_maoobra += $notafiscal_maoobra;
					$total_v_total_geral += $v_total;
					
					//TOTAL FINAL
					$total_equipe_2 += $total_geral;
					$total_salario_2 += $salario;
					$total_encargos_2 += $encargo_valor;
					$total_vale_transporte_2 += $transporte_total;
					$total_vale_refeicao_2 += $total_refeicao;
					$total_vale_alimentacao_2 += $vale_alimentacao;
					$total_locacao_2 += $locacao;
					$total_combustivel_2 += $total_gasolina;
					$total_galao_2 += $galao;
					$total_reti_polemica_2 += $reti_polemica;
					$total_notafiscal_2 += $notafiscal;
					$total_notafiscal_maoobra_2 += $notafiscal_maoobra;
					$total_v_total_geral_2 += $v_total;
					
					
					$notafiscal = 0;
					$notafiscal_maoobra = 0;
					$reti_polemica = 0;
					$total_retirada_geral = 0;
					$locacao = 0;
					$total_gasolina = 0;
					$retirada_polemica = 0;
					$v_total = 0;
				}
			
				echo '<tr class="active">
				<th colspan="2">Total</th>
				<th style="text-align:center">R$'.@number_format($total_salario + $total_encargos,"2",",",".").'</th>
				<th style="text-align:center">R$'.@number_format($total_vale_transporte + $total_vale_refeicao + $total_vale_alimentacao,"2",",",".").'</th>
				<th style="text-align:center">R$'.@number_format($total_locacao,"2",",",".").'</th>
				<th style="text-align:center">R$'.@number_format($total_combustivel,"2",",",".").'</th>
				<th style="text-align:center">R$'.@number_format($total_galao,"2",",",".").'</th>
				<th style="text-align:center">R$'.@number_format($total_reti_polemica,"2",",",".").'</th>
				<th style="text-align:center">R$'.@number_format($total_notafiscal,"2",",",".").'</th>
				<th style="text-align:center">R$'.@number_format($total_notafiscal_maoobra,"2",",",".").'</th>
				<th style="text-align:center">R$'.@number_format($total_equipe,"2",",",".").'</th>
				
				<th style="text-align:center">R$'.@number_format($total_v_total_geral,"2",",",".").'</th>
				</tr>';
				$total_geral_enca += $total_equipe;
				
				$total_salario = 0;
				$total_encargos = 0;
				$total_vale_transporte = 0;
				$total_vale_refeicao = 0;
				$total_vale_alimentacao = 0;
				$total_locacao = 0;
				$total_combustivel = 0;
				$total_galao = 0;
				$total_reti_polemica = 0;
				$total_notafiscal = 0;
				$total_notafiscal_maoobra = 0;
				$total_v_total_geral = 0;
			}
		}
		echo '</tbody>';
		echo '<tfoot>';
			echo '<tr><td><td></tr>';
			echo '<tr class="warning">
				<th colspan="2">Total</th>
				<th style="text-align:center">R$'.@number_format($total_salario_2 + $total_encargos_2,"2",",",".").'</th>
				<th style="text-align:center">R$'.@number_format($total_vale_transporte_2 + $total_vale_refeicao_2 + $total_vale_alimentacao_2,"2",",",".").'</th>	
				<th style="text-align:center">R$'.@number_format($total_locacao_2,"2",",",".").'</th>
				<th style="text-align:center">R$'.@number_format($total_combustivel_2,"2",",",".").'</th>
				<th style="text-align:center">R$'.@number_format($total_galao_2,"2",",",".").'</th>
				<th style="text-align:center">R$'.@number_format($total_reti_polemica_2,"2",",",".").'</th>
				<th style="text-align:center">R$'.@number_format($total_notafiscal_2,"2",",",".").'</th>
				<th style="text-align:center">R$'.@number_format($total_notafiscal_maoobra_2,"2",",",".").'</th>
				<th style="text-align:center">R$'.@number_format($total_equipe_2,"2",",",".").'</th>
				
				<th style="text-align:center">R$'.@number_format($total_v_total_geral_2 ,"2",",",".").'</th>
				</tr>';
		echo '</tfoot>';
		echo '</table>';
		
		echo '<h3 style="font-family: \'Oswald\', sans-serif;letter-spacing:8px;" class="pull-right">TOTAL: <small>R$'.@number_format($total_geral_enca,"2",",",".").'</small></h3>';
	exit;
}
	// ADM
	if($relatorio==3) {
		foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);
		foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1);
		foreach($si as $sis) { @$siu .= $sis.','; } $siu = substr($siu,0,-1);
		foreach($ci as $cis) { @$ciu .= $cis.','; } $ciu = substr($ciu,0,-1);
		foreach($enc as $encs) { @$enca .= $encs.','; } $enca = substr($enca,0,-1);
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
		echo '</table>';
		$ano = explode("-",$todayTotal);
		echo '
		<p>
			<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
				RELATÓRIO DE GASTOS ADMINISTRATIVO
			</h3>
			<p style="text-align:center;  font-size:14px;"><small>Período: '.implode("/",array_reverse(explode("-",$todayTotal))).'</small></p>
		</p>
		<p style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">';
		//$obra_controle = mysql_query("SELECT * FROM notas_obras WHERE id IN($oba)");
		//while($c = mysql_fetch_array($obra_controle)){	echo $c['descricao'].'<br/>'; }
		
		echo '
		</p>
		<hr/>
		';
		echo '<table class="table table-striped table-condensed small" style="font-size:10px">';
			$sql1 = mysql_query("SELECT * FROM notas_obras_cidade WHERE id IN($ciu) ORDER BY nome DESC");
			while($b = mysql_fetch_array($sql1)){
				echo '<tr class="small info">';
					echo '	<th>Nº</th>
							<th>'.$b['nome'].'</th>
							<th width="10px" style="text-align:center">SALARIO</th>
							<th width="10px" style="text-align:center">ENCARGOS</th>
							<th width="10px" style="text-align:center">VT</th>
							<th width="10px" style="text-align:center">VR</th>
							<th width="10px" style="text-align:center">VA</th>
							<th width="10px" style="text-align:center">TOTAL</th>
						</tr>';
				echo '</thead><tbody>';
			$eqpquery = mysql_query("SELECT *, id as id_2, funcao as cargo_func, obra as obra_2, (SELECT cidade FROM notas_obras WHERE id = obra_2 AND cidade = '".$b['id']."') as cidade2, (SELECT salario FROM rh_funcoes WHERE rh_funcoes.id = cargo_func) as salario FROM rh_funcionarios WHERE situacao IN($siu) AND adm = '1' ORDER BY nome DESC");
			while($c = mysql_fetch_array($eqpquery)){
				if($c['cidade2'] == $b['id']){
				$salario = $c['salario'];
				$encargo_valor = $salario*0.8;
				$se2 += 1;
				$vale_alimentacao = $c['vale_alimentacao'];
				echo '<tr>';
				echo '<td width="10px">'.$se2.'</td>';
				echo '<td width="300px">'.$c['nome'].'</td>';
				echo '<td width="10px" style="text-align:center">R$'.@number_format($salario,"2",",",".").'</td>';	
				echo '<td width="10px" style="text-align:center">R$'.@number_format($encargo_valor,"2",",",".").'</td>';	
				// ==== FALTAS & DIAS ADICIONAIS ====
				$dias_adicionais = mysql_result(mysql_query("select *, count(id) as total from rh_horaextra where (data between '$inicial' and '$final') and funcionario = '".$c['id']."' and porcentagem <> 0 and hora_extra <> '0.00' and beneficio = 1"),0,"total");
				$faltas = mysql_result(mysql_query("select *, count(id) as total from rh_horaextra where (data between '$inicial' and '$final') and funcionario = '".$c['id']."' and falta IN(1,2)"),0,"total");
				$dias_uteis = ($du+$dias_adicionais)-$faltas;
				$total_refeicao = $dias_uteis*$c['vale_refeicao'];
				$transporte1 = $dias_uteis*($c['vale_qtd']*2);
				$transporte2 = $dias_uteis*($c['vale_qtd2']*2);
				$transporte_total = $transporte1 + $transporte2;
				$du_controle = $du - 3;
					
				echo '<td width="50px" style="text-align:center">R$'.@number_format($transporte_total,"2",",",".").'</td>';
					
				echo '<td width="50px" style="text-align:center">R$'.@number_format($total_refeicao,"2",",",".").'</td>';
					
				if($dias_uteis >= $du_controle){
					echo '<td style="text-align:center">R$'.number_format($vale_alimentacao,"2",",",".").'</td>';	
				}else{
					$vale_alimentacao = 0;
					echo '<td style="text-align:center"> - </td>';	
				}
				
				$total_geral = $salario + $encargo_valor + $vale_alimentacao + $total_refeicao + $transporte_total;
					
				echo '<td width="50px" style="text-align:center">R$'.@number_format($total_geral,"2",",",".").'</td>';
				echo '</tr>'; 

				//TOTAL EQUIPE
				$total_equipe += $total_geral;
				$total_salario += $salario;
				$total_encargos += $encargo_valor;
				$total_vale_transporte += $transporte_total;
				$total_vale_refeicao += $total_refeicao;
				$total_vale_alimentacao += $vale_alimentacao;

				//TOTAL FINAL
				$total_equipe_2 += $total_geral;
				$total_salario_2 += $salario;
				$total_encargos_2 += $encargo_valor;
				$total_vale_transporte_2 += $transporte_total;
				$total_vale_refeicao_2 += $total_refeicao;
				$total_vale_alimentacao_2 += $vale_alimentacao;
			}
		}
			echo '<tr class="active">
						<th colspan="2">Total</th>
						<th style="text-align:center">R$'.@number_format($total_salario,"2",",",".").'</th>
						<th style="text-align:center">R$'.@number_format($total_encargos,"2",",",".").'</th>
						<th style="text-align:center">R$'.@number_format($total_vale_transporte,"2",",",".").'</th>
						<th style="text-align:center">R$'.@number_format($total_vale_refeicao,"2",",",".").'</th>
				<th style="text-align:center">R$'.@number_format($total_vale_alimentacao,"2",",",".").'</th>
				<th style="text-align:center">R$'.@number_format($total_equipe,"2",",",".").'</th>
				</tr>';
				$total_salario = 0;
				$total_encargos = 0;
				$total_vale_transporte = 0;
				$total_vale_refeicao = 0;
				$total_vale_alimentacao = 0;
				$total_equipe = 0;
		}
			echo '<tr><td><td></tr>';
			echo '<tr class="warning">
				<th colspan="2">Total</th>
				<th style="text-align:center">R$'.@number_format($total_salario_2,"2",",",".").'</th>
				<th style="text-align:center">R$'.@number_format($total_encargos_2,"2",",",".").'</th>
				<th style="text-align:center">R$'.@number_format($total_vale_transporte_2,"2",",",".").'</th>
				<th style="text-align:center">R$'.@number_format($total_vale_refeicao_2,"2",",",".").'</th>
				<th style="text-align:center">R$'.@number_format($total_vale_alimentacao_2,"2",",",".").'</th>
				<th style="text-align:center">R$'.@number_format($total_equipe_2,"2",",",".").'</th>
				</tr>';
		echo '</table>';
				$total_geral_enca += $total_equipe_2;

		echo '<h3 style="font-family: \'Oswald\', sans-serif;letter-spacing:8px;" class="pull-right">TOTAL: <small>R$'.@number_format($total_geral_enca,"2",",",".").'</small></h3>';
	exit;	
	}
	// NOTA FISCAL / DETALHADO
	if($relatorio==5){	
			foreach($et as $ets) { @$eta .= $ets.','; } $eta = substr($eta,0,-1);
			foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);
			foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1);
			foreach($md as $mds) { @$mdu .= $mds.','; } $mdu = substr($mdu,0,-1);
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
					<p style="text-align:center;  font-size:14px;"><small>Período: '.implode("/",array_reverse(explode("-",$inicial))).' á '.implode("/",array_reverse(explode("-",$final))).'</small></p>
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
			
			$ss_s = mysql_query("select sum(notas_itens_add.quantidade*notas_itens_add.valor) as totall, notas_nf.id as id_n, notas_nf.empresa as empresa, notas_itens_add.quantidade, notas_itens_add.valor, notas_nf.obra, notas_nf.numero FROM notas_nf INNER JOIN notas_itens_add ON notas_nf.id = notas_itens_add.nota WHERE notas_itens_add.equipe in ($equ) and notas_itens_add.categoria IN($eta) AND notas_nf.obra in ($oba) and (notas_nf.dataxml between '$inicial' and '$final') GROUP BY notas_nf.id ORDER BY notas_nf.numero") or die (mysql_error());
			
			while($l = mysql_fetch_array($ss_s)) { extract($l);	
				$total_nota += $totall;
				$medvenc = mysql_query("select * from notas_nf_venc where nota = $id_n AND medicaovenc in($mdu)");
				while($b = mysql_fetch_array($medvenc)) {
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
					echo '<tr><td width="3%"><b><small>Med: </b>'.$b['medicaovenc'].'</small></b></td>';
					echo '<td><b><small>ITEM:</small></b></td>';
					echo '<td><b><small>Parcela:</small></b></td>';
					echo '<td><b><small>EQUIPE:</small></b></td>';
					echo '<td><b><small>CATEGORIA:</small></b></td>';
					echo '<td><b><small>OBS.:</small></b></td>';
					echo '<td><b><small>QTD:</small></b></td>';
					echo '<td><b><small>VLR:</small></b></td>';
					echo '<td><b><small>TOTAL ITEM:</small></b></td>';
					echo '<td><b class="text-warning"><small></b>Valor Parcela:<span class="pull-right">R$ '.number_format($b['valor'],2,",",".").'</span></small></td>';
					echo '<td></td>';
					$total_geral += $b['valor'];
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
								echo '<td></td>';
								echo '<td></td>';
							echo '</tr>';
						}	
						echo '<tr style="border:1px solid #fff;"><td colspan="9"></td></tr>';
				}			
			}
			echo '</tbody></table>';
			echo '
			<table class="table pull-right">
				<tr><h2 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px;">Total Parcelas: <small> R$ '.number_format($total_geral,2,",",".").'</small></h2></tr>
				<tr><h2 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px;">Total Equipe: <small> R$ '.number_format($total_nota,2,",",".").'</small></h2></tr>
			</table>';
		exit;
	}
	// NOTA FISCAL / M A T E R I A L ------------------------------------------------------------------------
	if($relatorio==7) {
			foreach($et as $ets) { @$eta .= $ets.','; } $eta = substr($eta,0,-1);
			foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);
			foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1);
			foreach($md as $mds) { @$mdu .= $mds.','; } $mdu = substr($mdu,0,-1);
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
					<p style="text-align:center;  font-size:14px;"><small>Período: '.implode("/",array_reverse(explode("-",$inicial))).' á '.implode("/",array_reverse(explode("-",$final))).'</small></p>
				</p>
				<p class="hidden-xs hidden-lg hidden-md visible-print" style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
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
			echo '<thead><tr><th>ID</th><th>Categoria</th><th>Porce</th><th>Qtd</th><th>Media</th><th>Total</th></tr></thead><tbody>';
			$se = 0;	
			
			$categorias = mysql_query("select * from notas_itens");
			$categorias2 = mysql_query("select * from notas_itens");
			while($d = mysql_fetch_array($categorias2)) {
				$cat_id = $d['id'];
				$tot = mysql_result(mysql_query("select SUM(notas_itens_add.quantidade*notas_itens_add.valor) as totalSum, notas_itens_add.nota, notas_itens_add.item, notas_itens_add.categoria, notas_itens_add.quantidade, notas_itens_add.valor, notas_nf.recebimento FROM notas_nf, notas_itens_add WHERE notas_nf.id = notas_itens_add.nota AND notas_nf.obra in ($oba) AND notas_itens_add.item = '$cat_id' AND notas_itens_add.equipe in ($equ) AND notas_itens_add.categoria IN($eta) AND (notas_nf.dataxml BETWEEN '$inicial' AND '$final') ORDER BY notas_itens_add.categoria"),0,"totalSum");
				$total_porc += $tot;
			}
			while($c = mysql_fetch_array($categorias)) {
				$cat_id = $c['id'];
				if(mysql_result(mysql_query("select SUM(notas_itens_add.quantidade*notas_itens_add.valor) as totalSum, notas_itens_add.nota, notas_itens_add.item, notas_itens_add.categoria, notas_itens_add.quantidade, notas_itens_add.valor, notas_nf.recebimento FROM notas_nf, notas_itens_add WHERE notas_nf.id = notas_itens_add.nota AND notas_nf.obra in ($oba) AND notas_itens_add.item = '$cat_id' AND notas_itens_add.equipe in ($equ) AND notas_itens_add.categoria IN($eta) AND (notas_nf.dataxml BETWEEN '$inicial' AND '$final') ORDER BY notas_itens_add.categoria"),0,"totalSum") == ''){ 
					echo '<tr class="hidden">'; }else{ echo '<tr>'; $se += 1; 
				}
				echo '<td width="3%">'.$se.'</td>';
				
				if($categoria == 20){
					echo '<td width="45%"># - error! EQUIPAMENTO - # </td>';
				}else{
					echo '<td width="45%">'.$c['descricao'].'</td>';
				}
				
				$totall = mysql_result(mysql_query("select SUM(notas_itens_add.quantidade*notas_itens_add.valor) as totalSum, notas_itens_add.nota, notas_itens_add.item, notas_itens_add.categoria, notas_itens_add.quantidade, notas_itens_add.valor, notas_nf.recebimento FROM notas_nf, notas_itens_add WHERE notas_nf.id = notas_itens_add.nota AND notas_nf.obra in ($oba) AND notas_itens_add.categoria IN($eta) AND notas_itens_add.item = '$cat_id' AND notas_itens_add.equipe in ($equ) AND (notas_nf.dataxml BETWEEN '$inicial' AND '$final') ORDER BY notas_itens_add.categoria"),0,"totalSum");
				
				$total_quantidade = mysql_result(mysql_query("select SUM(notas_itens_add.quantidade) as total_quantidade FROM notas_nf, notas_itens_add WHERE notas_nf.id = notas_itens_add.nota AND notas_nf.obra in ($oba) AND notas_itens_add.categoria IN($eta) AND notas_itens_add.item = '$cat_id' AND notas_itens_add.equipe in ($equ) AND (notas_nf.dataxml BETWEEN '$inicial' AND '$final') ORDER BY notas_itens_add.categoria"),0,"total_quantidade");
				$total_geral += $totall;
				$porc = ($totall/$total_porc)*100;
				@$media = $totall/$total_quantidade;
				echo '<td width="10%">'.number_format($porc,2,',','').'%</td>';
				echo '<td width="10%">'.$total_quantidade.'</td>';
				echo '<td width="15%">'.money_format('%n', $media).'</td>';
				echo '<td width="15%">'.money_format('%n', $totall).'</td>';
				echo '</tr>';
			}
			echo '</tbody></table>';
			echo '	<div class="page-header">
						<h1 class="pull-right" style="font-family: \'Oswald\', sans-serif; letter-spacing:5px;">Total Geral <small> R$ '.number_format($total_geral,2,",",".").'</small></h1>
					</div>';	
			exit;			
	}
	// NOTA FISCAL / CATEGORIA
	if($relatorio==6){	
			foreach($et as $ets) { @$eta .= $ets.','; } $eta = substr($eta,0,-1);
			foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);
			foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1);
			foreach($md as $mds) { @$mdu .= $mds.','; } $mdu = substr($mdu,0,-1);
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
					<p style="text-align:center;  font-size:14px;"><small>Período: '.implode("/",array_reverse(explode("-",$inicial))).' á '.implode("/",array_reverse(explode("-",$final))).'</small></p>
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
			$categorias = mysql_query("SELECT * FROM notas_categorias WHERE id IN($eta)"); 
			$se = 0; $total_geral = 0;
			$categorias2 = mysql_query("SELECT * FROM notas_categorias WHERE id IN($eta)");
			while($d = mysql_fetch_array($categorias2)) {
				$cat_id = $d['id'];
				$tot = mysql_result(mysql_query("SELECT SUM(notas_itens_add.quantidade*notas_itens_add.valor) AS totalSum, notas_itens_add.nota, notas_itens_add.item, notas_itens_add.categoria, notas_itens_add.quantidade, notas_itens_add.valor, notas_nf.recebimento FROM notas_nf, notas_itens_add WHERE notas_nf.id = notas_itens_add.nota AND notas_itens_add.categoria = '$cat_id' AND notas_nf.obra IN($oba) AND (notas_nf.dataxml between '$inicial' and '$final') and notas_itens_add.equipe in ($equ) ORDER BY notas_itens_add.categoria"),0,"totalSum");
				$total_porc += $tot;
			}
			while($c = mysql_fetch_array($categorias)) {
				$cat_id = $c['id'];
				if(mysql_result(mysql_query("select SUM(notas_itens_add.quantidade*notas_itens_add.valor) as totalSum, notas_itens_add.nota, notas_itens_add.item, notas_itens_add.categoria, notas_itens_add.quantidade, notas_itens_add.valor, notas_nf.recebimento FROM notas_nf, notas_itens_add WHERE notas_nf.id = notas_itens_add.nota AND notas_itens_add.categoria = '$cat_id' and notas_nf.obra in ($oba) AND (notas_nf.dataxml between '$inicial' and '$final') and notas_itens_add.equipe in ($equ) order by notas_itens_add.categoria"),0,"totalSum") == ''){ echo '<tr class="hidden">'; }else{ echo '<tr>'; $se += 1; }
				echo '<td width="20px">'.$se.'</td>';
				echo '<td>'.$c['descricao'].'</td>';
				$totall = mysql_result(mysql_query("select SUM(notas_itens_add.quantidade*notas_itens_add.valor) as totalSum, notas_itens_add.nota, notas_itens_add.item, notas_itens_add.categoria, notas_itens_add.quantidade, notas_itens_add.valor, notas_nf.recebimento FROM notas_nf, notas_itens_add WHERE notas_nf.id = notas_itens_add.nota AND notas_itens_add.categoria = '$cat_id' and notas_nf.obra in ($oba) AND (notas_nf.dataxml between '$inicial' and '$final') and notas_itens_add.equipe in ($equ) order by notas_itens_add.categoria"),0,"totalSum");
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
	// NOTA FISCAL /  S I M P L E S  -----------------------------------------------------------------------------------------------------------------
	if($relatorio==11) {
			foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1);
			foreach($et as $ets) { @$eta .= $ets.','; } $eta = substr($eta,0,-1);
			foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);
			foreach($md as $mds) { @$mdu .= $mds.','; } $meu = substr($mdu,0,-1);
			
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
					<p style="text-align:center;  font-size:14px;"><small>Período: '.implode("/",array_reverse(explode("-",$inicial))).' á '.implode("/",array_reverse(explode("-",$final))).'</small></p>
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
	exit;
}
?>

	<div style="clear: both;" class="hidden-print">
		<h3 style="font-family: 'Oswald', sans-serif; letter-spacing:5px;"> 
			<p>RELATÓRIO<small> - <b>CONTROLE DE GASTOS</B></small></p>
		</h3>
		<a a href="javascript:window.print()" style="letter-spacing:5px; position:relative; bottom:10px;" class="hidden-xs hidden-print pull-right btn btn-warning btn-sm"> <span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Imprimir</a>
	</div>
	<div style="clear: both;" class="hidden-print">
		<hr></hr>
	</div>
<div class="hidden-print">
<div class="well well-sm" style="padding:5px 10px 0px 10px;">
<form action="javascript:void(0)" onSubmit="posti(this,'financeiro/relatorio-funcionarios.php?ac=listar','.resultado');" class="form-inline">
	<label style="margin-top:10px"><small>Obra:</small>
		<select name="ci[]" onChange="$('#itens').load('financeiro/relatorio-funcionarios.php?atu=ac&cidade=' + $(this).val() + '');" style="width:250px;" class="sel" id="categ" required> 
			<option value="">Selecione uma obra</option>
			<?php
				@$cidade = mysql_query("select * from notas_obras_cidade WHERE id IN(0,$cidade_usuario) order by nome asc");
				while($l = @mysql_fetch_array($cidade)) {
					echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>';
				}
			?>	
		</select>
	</label>
	<label id="itens">
		<label><small>Contrato:</small>
			<select name="ob[]" class="sel">
				<option value="">Selecione uma obra</option>	
			</select>
		</label>
		<label for=""><small>Encarregados:</small>
			<select name="enc[]" class="sel" multiple="multiple">
			<?php
				@$encarregados = mysql_query("select * from encarregados WHERE obra IN(0,$cidade_usuario) order by nome asc");
				while($z = @mysql_fetch_array($encarregados)) {
					echo '<option value="'.$z['id'].'" selected>'.$z['nome'].'</option>';
				}
			?>		
			</select>
		</label>
		<label for="">
			<small>Status:</small>
			<select name="st[]" OnChange="$('#itens2').load('financeiro/relatorio-funcionarios.php?atu=st2&status3=' + $(this).val() + '');" class="sel" multiple="multiple">
				<option value="0" selected>ATIVA</option>
				<option value="1" selected>INATIVA</option>
			</select>
		</label>
		<label id="itens2">
			<label for="">
				<small>Equipes:</small>
				<select name="eq[]" class="sel" multiple="multiple">
					<?php
						$encarregados = mysql_query("select * from equipes WHERE obra IN(0,$cidade_usuario) order by nome asc");
						while($x = @mysql_fetch_array($encarregados)) {
							echo '<option value="'.$x['id'].'" selected>'.$x['nome'].'</option>';
						}
					?>		
				</select>
			</label>
		</label>
	</label>
	<label><small>Situação:</small>
		<select name="si[]" class="sel" multiple="multiple">
		<option value="0" selected> SEM SITUACAO </option>
		<?php
			$situacao = mysql_query("select * from rh_situacao order by descricao asc");
			while($l = mysql_fetch_array($situacao)) { extract($l);
				echo '<option value="'.$id.'" selected>'.$descricao.'</option>';
			}
		?>		
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
	</label><br/>
	<label>
		<small>Dias Uteis:</small> 
		<input type="number" step="1" name="du" class="form-control input-sm" size="3" value="21" style="width:60px"/>
	</label>
	<label><small>De:</small>
		<input type="date" name="inicial" value="<?php echo $inicioMes; ?>" min="<?php echo $data_min; ?>" max="<?php echo $todayTotal ?>" class="form-control input-sm" required/>
	</label>
	<label><small>ate:</small>
		<input type="date" name="final" value="<?php echo $todayTotal; ?>" min="<?php echo $data_min; ?>" max="<?php echo $todayTotal ?>" class="form-control input-sm" required/>
	</label>
	<label for=""><small>Tipo:</small>
		<select name="relatorio" class="form-control input-sm disabled" style="width: 180px">
			<option value="1">SIMPLES</option>
			<option value="2">GASTOS</option>
			<option value="3">ADMINISTRATIVO</option>
			<!--<option value="4">ADM VEICULO</option>-->
			<option value="5">NF - DETALHADA</option>
			<option value="11">NF - SIMPLES</option>
			<option value="6">NF - MEMORIA P/ CATEGORIA </option>
			<option value="7">NF - MEMORIA P/ MATERIAL </option>
		</select>
	</label>
		<label for="">
			<small>Medição:</small>
			<select name="md[]" class="form-control input-sm sel" multiple="multiple" style="width: 120px">
				<option value="0" selected>S/MED</option>
				<?php
				$medicao = mysql_query("select * from ae_medicao GROUP BY medicao order by medicao asc ");
				while($l = mysql_fetch_array($medicao)) {
					echo '<option value="'.$l['medicao'].'" selected>'.$l['medicao'].'</option>';
				}
				?>
				<option value="99" selected>99</option>
			</select>
		</label>
	<input type="submit" value="Listar" style="width:200px; margin-left:5px;" class="btn btn-success btn-sm" />
</div>	
</form>

</div>
<div class="resultado"></div>