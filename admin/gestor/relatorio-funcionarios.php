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
				$obras = mysql_query("select * from notas_obras where cidade IN($cidade) and id in(0,$obra_usuario) order by descricao asc");
				while($l = mysql_fetch_array($obras)) {
					echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>';
				}
			echo '</select>
		</label>
		<label for=""><small>Encarregados:</small>
			<select name="enc[]" class="sel" multiple="multiple">';
				$encarregados = mysql_query("select * from encarregados WHERE obra IN($cidade) order by nome asc");
				while($z = mysql_fetch_array($encarregados)) {
					echo '<option value="'.$z['id'].'" selected>'.$z['nome'].'</option>';
				}		
			echo '</select>
		</label>
		<label for="">
			<small>Status:</small>
			<select name="st[]" OnChange="$(\'#itens2\').load(\'gestor/relatorio-funcionarios.php?atu=st2&cidade='.$cidade.'&status3=\' + $(this).val() + \'\');" class="sel" multiple="multiple">
				<option value="0" selected>ATIVA</option>
				<option value="1" selected>INATIVA</option>
			</select>
		</label>
		<label id="itens2">
			<label for="">
			<label><small>Equipes:</small>
			<select name="eq[]" class="sel" multiple="multiple">';
				$equipe = mysql_query("select * from equipes WHERE obra IN($cidade) order by nome asc");
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
				$equipe = mysql_query("select * from equipes WHERE obra IN($cidade) AND status IN($status3) order by nome asc");
				while($x = mysql_fetch_array($equipe)) {
					echo '<option value="'.$x['id'].'" selected>'.$x['nome'].'</option>';
				}	
			echo '</select>
			</label>
		</label>';
		exit;
		
	}
	if(@$ac=='listar') {
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
				$sql = mysql_query("SELECT *, id as id_2, funcao as cargo_func, (SELECT lider_geral FROM equipes WHERE lider_geral = id_2 GROUP BY lider_geral) as lider_geral, (SELECT salario FROM rh_funcoes WHERE rh_funcoes.id = cargo_func) as salario FROM rh_funcionarios WHERE situacao IN($siu) AND equipe = ".$b['id']." AND obra IN($oba) ORDER BY lider_geral DESC");
				
				
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
						echo '<td width="2%" class="hidden-print"><a href="#" style="margin:0px 10px 0px 10px; font-size:8px" class="btn btn-xs btn-primary"onclick=\'ldy("rh/editar-funcionario.php?acesso_login='.$acesso_login.'&id='.$id_func.'",".resultado")\'><span class="glyphicon glyphicon-pencil"></span></a></td>';
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
		$encquery = mysql_query("SELECT * FROM encarregados WHERE id IN($enca) AND obra IN($ciu) ORDER BY nome ASC");
		while($a = mysql_fetch_array($encquery)){
			echo '<tr class="success"><th colspan="15">'.$a['nome'].'</th></tr>';
			
			$eqpquery = mysql_query("SELECT * FROM equipes WHERE encarregado = ".$a['id']." AND obra IN($ciu) AND id IN($equ) ORDER BY nome ASC");
			$total_producao = 0;
			while($b = mysql_fetch_array($eqpquery)){
				echo '<tr class="small info">';
				echo '	<th>Nº</th>
						<th>'.$b['nome'].' &nbsp; / &nbsp; <small>ID: '.$b['id'].'</small></th>
						<th width="10px" style="text-align:center">SALARIO</th>
						<th width="10px" style="text-align:center">ENCARGOS</th>
						<th width="10px" style="text-align:center">VT</th>
						<th width="10px" style="text-align:center">VR</th>
						<th width="10px" style="text-align:center">VA</th>
						<th width="10px" style="text-align:center">LOCAÇÃO</th>
						<th width="10px" style="text-align:center">COMBUSTIVEL</th>
						<th width="10px" style="text-align:center">GALÃO</th>
						<th width="10px" style="text-align:center">POLEMICA</th>
						<th width="10px" style="text-align:center">NOTA</th>
						<th width="10px" style="text-align:center">SABESP</th>
						<th width="10px" style="text-align:center">PREMIAÇÃO</th>
						<th width="10px" style="text-align:center">TOTAL</th>
					</tr>';
				
				$total_equipe = 0;
				$lider_geral = $b['lider_geral'];
				$categoria_equipe = $b['categoria'];
				
				$locacao = mysql_result(mysql_query("SELECT notas_nf.id, notas_nf.obra, notas_nf.dataxml, item, categoria, desconto, notas_itens_add.equipe, SUM(quantidade*valor) as total FROM notas_nf INNER JOIN notas_itens_add ON notas_itens_add.nota = notas_nf.id WHERE categoria = '12' AND notas_itens_add.equipe = '".$b['id']."' AND (dataxml BETWEEN '$inicial' AND '$final') AND notas_nf.obra IN($oba)"),0,"total");
				


				$total_gasolina = @mysql_result(mysql_query("SELECT SUM(qtd*vlr) AS total FROM comb_rm INNER JOIN comb_rm_itens ON comb_rm.id = comb_rm_itens.cod_rm WHERE equipamento NOT IN(1264,1272,1266,1244,1193,70,1197,1196,1107) and equipe = '".$b['id']."' AND (comb_rm.data_ref BETWEEN '$inicial' AND '$final') AND comb_rm.obra IN($oba)"),0,"total");
				
				$reti_polemica = @mysql_result(mysql_query("SELECT SUM(quantidade * (SELECT valor FROM notas_itens_add INNER JOIN notas_nf ON notas_itens_add.nota = notas_nf.id WHERE notas_nf.obra = notas_retirada.obra AND notas_itens_add.item = notas_retirada_itens.id_item ORDER BY notas_itens_add.id DESC LIMIT 1)) as total FROM notas_retirada INNER JOIN notas_retirada_itens ON notas_retirada.id = notas_retirada_itens.id_retirada WHERE notas_retirada.equipe = '".$b['id']."' AND (notas_retirada.data BETWEEN '$inicial' and '$final')"),0,"total");		
				
				$notafiscal = mysql_result(mysql_query("select sum(quantidade*valor) as total FROM notas_nf INNER JOIN notas_itens_add ON notas_nf.id = notas_itens_add.nota WHERE notas_nf.obra IN($oba) AND notas_itens_add.categoria NOT IN(6,12) AND (notas_nf.recebimento BETWEEN '$inicial' AND '$final') AND notas_itens_add.equipe = '".$b['id']."'"),0,"total");
	
				
				//RETIRADA
				$retirada_sabesp_1 = @mysql_result(@mysql_query("SELECT SUM(quantidade * (SELECT vlr FROM ss_rm INNER JOIN ss_rm_itens ON ss_rm.id = ss_rm_itens.cod_rm WHERE ss_rm.obra = ss_retirada_sabesp.obra AND ss_rm_itens.item = ss_retirada_itens.id_item ORDER BY ss_rm.`data` DESC LIMIT 1)) as total FROM ss_retirada_sabesp INNER JOIN ss_retirada_itens ON ss_retirada_sabesp.id = ss_retirada_itens.id_retirada WHERE ss_retirada_itens.tipo = '1' AND ss_retirada_sabesp.equipe = '".$b['id']."' AND (ss_retirada_sabesp.data BETWEEN '2017-04-01' and '$final') GROUP BY ss_retirada_sabesp.equipe"),0,"total");
				
				//DEVOLUÇÃO
				$devolucao_sabesp_2 = @mysql_result(@mysql_query("SELECT SUM(quantidade * (SELECT vlr FROM ss_rm INNER JOIN ss_rm_itens ON ss_rm.id = ss_rm_itens.cod_rm WHERE ss_rm.obra = ss_retirada_sabesp.obra AND ss_rm_itens.item = ss_retirada_itens.id_item ORDER BY ss_rm.`data` DESC LIMIT 1)) as total FROM ss_retirada_sabesp INNER JOIN ss_retirada_itens ON ss_retirada_sabesp.id = ss_retirada_itens.id_retirada WHERE ss_retirada_itens.tipo = '2' AND ss_retirada_sabesp.equipe = '".$b['id']."' AND (ss_retirada_sabesp.data BETWEEN '2017-04-01' and '$final') GROUP BY ss_retirada_sabesp.equipe"),0,"total");
				
				//SAIDA 
				$saida_sabesp = @mysql_result(@mysql_query("SELECT SUM(qtd * (SELECT vlr FROM ss_rm INNER JOIN ss_rm_itens ON ss_rm.id = ss_rm_itens.cod_rm WHERE ss_rm.obra = ss_principal.obra AND ss_rm_itens.item = ss_ma.material ORDER BY ss_rm.`data` DESC LIMIT 1)) as total FROM ss_principal INNER JOIN ss_ma ON ss_principal.id = ss_ma.cod_ss WHERE ss_ma.equipe = '".$b['id']."' AND (ss_ma.data_uso BETWEEN '2017-04-01' and '$final') GROUP BY ss_ma.equipe"),0,"total");

				$total_retirada_geral = ($retirada_sabesp_1 - $devolucao_sabesp_2) - $saida_sabesp;
	
				$eqp2 = mysql_query("select *, sum(ss_se.qtd) as qtd_total from ss_se, ss_principal where ss_se.cod_ss = ss_principal.id and ss_se.equipe = '".$b['id']."' and ss_principal.situacao IN(2) AND ss_principal.obra IN($oba) AND (ss_se.data between '$inicial' and '$final') group by ss_se.servico");
				$v_total = 0;
				while($z = mysql_fetch_array($eqp2)) {
					if(mysql_result(mysql_query("select * from ss_itens where id = ".$z['servico'].""),0,"preco")<>0) {
						$meta_equipe_valor = @mysql_result(mysql_query("select * from metas where id = $categoria_equipe"),0,"valor");
						$meta_equipe_qtd = @mysql_result(mysql_query("select * from metas where id = $categoria_equipe"),0,"quantidade");
						@$total_producao = $z['qtd_total']*@mysql_result(mysql_query("select * from ss_itens where id = ".$z['servico'].""),0,"preco");
						$v_total += $total_producao;
					}
				}
				@$portc = $v_total / $meta_equipe_valor; 
				$valor_producao = $portc * $meta_equipe_qtd; 
				
				
				$sql = mysql_query("SELECT *, id as id_2, funcao as cargo_func, (SELECT lider_geral FROM equipes WHERE lider_geral = id_2 GROUP BY lider_geral) as lider_geral, (SELECT salario FROM rh_funcoes WHERE rh_funcoes.id = cargo_func) as salario FROM rh_funcionarios WHERE situacao IN($siu) AND equipe = ".$b['id']." AND obra IN($oba) ORDER BY lider_geral DESC");
				while($c = mysql_fetch_array($sql)) {
					$salario = $c['salario'];
					$encargo_valor = $salario*0.8;
					$se2 += 1;
					$vale_alimentacao = $c['vale_alimentacao'];
					// ==== COMBUSTIVEL & GALAO ====

					$galao = mysql_result(mysql_query("SELECT SUM(qtd*vlr) AS total FROM comb_rm INNER JOIN comb_rm_itens ON comb_rm.id = comb_rm_itens.cod_rm WHERE equipamento IN(1264,1272,1266,1244,1193,70,1197,1196,1107) and comb_rm_itens.funcionario = ".$c['id']." AND (comb_rm.data_ref BETWEEN '$inicial' AND '$final') AND comb_rm.obra IN($oba)"),0,"total");

					if(isset($c['lider_geral'])){
						echo '<tr class="text-danger">';
					}else{
						echo '<tr>';
					}
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
					if($total_retirada_geral == ''){
						$total_retirada_geral = 0;
						echo '<td width="50px" style="text-align:center"> - </td>';
					}else{
						echo '<td width="50px" style="text-align:center">R$'.number_format($total_retirada_geral,"2",",",".").'</td>';
					}
					if($valor_producao == '0'){
						$valor_producao = 0;
						echo '<td width="50px" style="text-align:center"> - </td>';
					}else{
						echo '<td width="50px" style="text-align:center">R$'.number_format($valor_producao,"2",",",".").'</td>';
					}
					
					$total_geral = $salario + $encargo_valor + $total_gasolina + $locacao + $galao + $vale_alimentacao + $total_refeicao + $valor_producao + $notafiscal + $reti_polemica + $total_retirada_geral + $transporte_total;
					
					
					
					echo '<td width="50px" style="text-align:center">R$'.@number_format($total_geral,"2",",",".").'</td>';
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
					$total_retirada_geral_global += $total_retirada_geral;
					$total_producao_geral += $valor_producao;
					
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
					$total_retirada_geral_global_2 += $total_retirada_geral;
					$total_producao_geral_2 += $valor_producao;
					
					
					$notafiscal = 0;
					$reti_polemica = 0;
					$total_retirada_geral = 0;
					$locacao = 0;
					$total_gasolina = 0;
					$retirada_polemica = 0;
				}
			
				echo '<tr class="active">
				<th colspan="2">Total</th>
				<th style="text-align:center">R$'.@number_format($total_salario,"2",",",".").'</th>
				<th style="text-align:center">R$'.@number_format($total_encargos,"2",",",".").'</th>
				<th style="text-align:center">R$'.@number_format($total_vale_transporte,"2",",",".").'</th>
				<th style="text-align:center">R$'.@number_format($total_vale_refeicao,"2",",",".").'</th>
				<th style="text-align:center">R$'.@number_format($total_vale_alimentacao,"2",",",".").'</th>
				<th style="text-align:center">R$'.@number_format($total_locacao,"2",",",".").'</th>
				<th style="text-align:center">R$'.@number_format($total_combustivel,"2",",",".").'</th>
				<th style="text-align:center">R$'.@number_format($total_galao,"2",",",".").'</th>
				<th style="text-align:center">R$'.@number_format($total_reti_polemica,"2",",",".").'</th>
				<th style="text-align:center">R$'.@number_format($total_notafiscal,"2",",",".").'</th>
				
				<th style="text-align:center">R$'.@number_format($total_retirada_geral_global,"2",",",".").'</th>
				<th style="text-align:center">R$'.@number_format($total_producao_geral,"2",",",".").'</th>
				<th style="text-align:center">R$'.@number_format($total_equipe,"2",",",".").'</th>
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
				$total_retirada_geral_global = 0;
				$total_producao_geral = 0;
			}
		}
		echo '</tbody>';
		echo '<tfoot>';
			echo '<tr><td><td></tr>';
			echo '<tr class="warning">
				<th colspan="2">Total</th>
				<th style="text-align:center">R$'.@number_format($total_salario_2,"2",",",".").'</th>
				<th style="text-align:center">R$'.@number_format($total_encargos_2,"2",",",".").'</th>
				<th style="text-align:center">R$'.@number_format($total_vale_transporte_2,"2",",",".").'</th>
				<th style="text-align:center">R$'.@number_format($total_vale_refeicao_2,"2",",",".").'</th>
				<th style="text-align:center">R$'.@number_format($total_vale_alimentacao_2,"2",",",".").'</th>
				<th style="text-align:center">R$'.@number_format($total_locacao_2,"2",",",".").'</th>
				<th style="text-align:center">R$'.@number_format($total_combustivel_2,"2",",",".").'</th>
				<th style="text-align:center">R$'.@number_format($total_galao_2,"2",",",".").'</th>
				
				<th style="text-align:center">R$'.@number_format($total_reti_polemica_2,"2",",",".").'</th>
				
				<th style="text-align:center">R$'.@number_format($total_notafiscal_2,"2",",",".").'</th>
				<th style="text-align:center">R$'.@number_format($total_retirada_geral_global_2,"2",",",".").'</th>
				<th style="text-align:center">R$'.@number_format($total_producao_geral_2 ,"2",",",".").'</th>
				<th style="text-align:center">R$'.@number_format($total_equipe_2,"2",",",".").'</th>
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
if($relatorio==4) {
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
				RELATÓRIO DETALHADO DE EQUIPES 
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
						<th>'.$b['nome'].' &nbsp; / &nbsp; <small>ID: '.$b['id'].'</small></th>
						<th width="10px">FUNÇÃO</th>
						<th width="10px">SITUAÇÃO</th>
						<th width="10px">VEICULO / PLACA</th>
						<th width="10px">OBS</th>
						<th width="10px" class="hidden-print"></th>
					</tr>';
				$sql = mysql_query("SELECT *, id as id_2, funcao as cargo_func, (SELECT lider_geral FROM equipes WHERE lider_geral = id_2 GROUP BY lider_geral) as lider_geral, (SELECT salario FROM rh_funcoes WHERE rh_funcoes.id = cargo_func) as salario FROM rh_funcionarios WHERE situacao IN($siu) AND equipe = ".$b['id']." AND obra IN($oba) ORDER BY lider_geral DESC");
				
				
				while($c = mysql_fetch_array($sql)) {
					$lider_geral = $b['lider_geral'];
					$salario = $c['salario'];
					$obra_fun = $c['obra'];
					$id_func = $c['id_2'];
					$situacao = explode("_",@mysql_result(@mysql_query("SELECT * FROM rh_situacao WHERE id = ".$c['situacao'].""),0,"descricao"));
					$se2 += 1;
					// =============================
					if($c['adm'] == '1'){
						echo '<tr class="text-danger">';
					}else{
						echo '<tr>';
					}
					echo '<td width="3%">'.$se2.'</td>';
					echo '<td width="25%">'.$c['nome'].'</td>';
					echo '<td width="20%" >'.mysql_result(mysql_query("SELECT * FROM rh_funcoes WHERE id = ".$c['funcao'].""),0,"descricao").'</td>';	
					echo '<td width="5%" >'.$situacao[1].'</td>';
					echo '<td width="10%" >'.@mysql_result(mysql_query("SELECT marca FROM notas_equipamentos WHERE categoria = '31' and local = '$id_func' ORDER BY id DESC LIMIT 1"),0,"marca").' / '.@mysql_result(mysql_query("SELECT placa FROM notas_equipamentos WHERE categoria = '31' and local = '$id_func' ORDER BY id DESC LIMIT 1"),0,"placa").'</td>';
					echo '<td>'.$c['adm_obs'].'</td>';
					if($acesso_login == 'master' || $acesso_login == 'moderador' || $acesso_login=='rh' || $acesso_login == 'liderrh' || $acesso_login == 'lider_admin'){
						echo '<td width="10px" class="hidden-print"><a href="#" style="margin:0px 10px 0px 10px; font-size:8px" class="btn btn-xs btn-primary"onclick=\'ldy("rh/editar-funcionario.php?acesso_login='.$acesso_login.'&id='.$id_func.'",".resultado")\'><span class="glyphicon glyphicon-pencil"></span></a></td>';
					}					
					echo '</tr>'; 
					$total_geral += $salario;

				}
			}
		}
		echo '</tbody>';
		echo '</table>';
		
		echo '<h3 style="font-family: \'Oswald\', sans-serif;letter-spacing:8px;" class="pull-right">TOTAL: <small>R$'.@number_format($total_geral,"2",",",".").'</small></h3>';
	exit;
}
}
?>

	<div style="clear: both;" class="hidden-print">
		<h3 style="font-family: 'Oswald', sans-serif; letter-spacing:5px;"> 
			<p>RELATÓRIO<small> - <b>CONTROLE DE FUNCIONÁRIOS</B></small></p>
		</h3>
		<a a href="javascript:window.print()" style="letter-spacing:5px; position:relative; bottom:10px;" class="hidden-xs hidden-print pull-right btn btn-warning btn-sm"> <span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Imprimir</a>
	</div>
	<div style="clear: both;" class="hidden-print">
		<hr></hr>
	</div>
<div class="hidden-print">
<div class="well well-sm" style="padding:5px 10px 0px 10px;">
<form action="javascript:void(0)" onSubmit="posti(this,'gestor/relatorio-funcionarios.php?ac=listar','.resultado');" class="form-inline">
	<label style="margin-top:10px"><small>Obra:</small>
		<select name="ci[]" onChange="$('#itens').load('gestor/relatorio-funcionarios.php?atu=ac&cidade=' + $(this).val() + '');" style="width:250px;" class="sel" multiple="multiple" id="categ" required> 
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
			<select name="ob[]" class="sel" multiple="multiple">
				<?php
					$obras = mysql_query("select * from notas_obras where id IN(0,$obra_usuario) order by descricao asc");
					while($l = mysql_fetch_array($obras)) {
						echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>';
					}
				?>		
			</select>
		</label>
		<label for=""><small>Encarregados:</small>
			<select name="enc[]" class="sel" multiple="multiple">
			<?php
				$encarregados = mysql_query("select * from encarregados WHERE obra IN(0,$cidade_usuario) order by nome asc");
				while($z = mysql_fetch_array($encarregados)) {
					echo '<option value="'.$z['id'].'" selected>'.$z['nome'].'</option>';
				}
			?>		
			</select>
		</label>
		<label for="">
			<small>Status:</small>
			<select name="st[]" OnChange="$('#itens2').load('gestor/relatorio-funcionarios.php?atu=st2&status3=' + $(this).val() + '');" class="sel" multiple="multiple">
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
						while($x = mysql_fetch_array($encarregados)) {
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
	</label><br/>
	<label>
		<small>Dias Uteis:</small> 
		<input type="number" step="1" name="du" class="form-control input-sm" size="3" value="21" style="width:60px"/>
	</label>
	<label><small>De:</small>
		<input type="date" name="inicial" value="<?php echo $inicioMes; ?>" class="form-control input-sm"/>
	</label>
	<label><small>ate:</small>
		<input type="date" name="final" value="<?php echo $todayTotal; ?>" class="form-control input-sm"/>
	</label>
	<label for=""><small>Tipo:</small>
		<select name="relatorio" class="form-control input-sm disabled" style="width: 180px">
			<option value="1">SIMPLES</option>
			<option value="2">GASTOS</option>
			<option value="3">ADMINISTRATIVO</option>
			<option value="4">ADM VEICULO</option>
		</select>
	</label>
	<input type="submit" value="Listar" style="width:200px; margin-left:5px;" class="btn btn-success btn-sm" />
</div>	
</form>

</div>
<div class="resultado"></div>