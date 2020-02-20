<?php
	include("../config.php");
	include("../validar_session.php");
	date_default_timezone_set('America/Sao_Paulo');
	setlocale(LC_MONETARY,"pt_BR", "ptb");
	$today = getdate(); 

	if($today['mon'] < 10) { 
		$today['mon'] = '0'.$today['mon'];
	} else { 
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
			maxHeight: 500,
			includeSelectAllOption: true,
			selectAllText: "Selecionar todos",
			enableFiltering: true,
			enableCaseInsensitiveFiltering: true,
			selectAllValue: 'multiselect-all',
			buttonWidth: 'auto'
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
	.nav-pills2 a{
		text-align:center;
		color:#999;
	}
	.nav-pills2 li{
		list-style-type:none;
		padding:10px;
	}
	.nav-pills2{
		border-bottom:1px solid #F3F3F3;
		padding:0px 10px 10px 10px;
		font-size:12px;
	}
	.activeb{
		color:#666;
		border-top-left-radius:8px;
		border-top-right-radius:8px;
		background:#F3F3F3;
		font-weight:bold;
	}
	#required-aviso{
		display:none;
	}
</style>
<?			
if($atu=='ac'){
		echo '<label><small>Contrato:</small>';
			echo '<select name="ob[]" style="width:250px;" class="sel" multiple="multiple">';
				$obras = mysql_query("select * from notas_obras where cidade IN($cidade) and id in(0,$obra_usuario) order by descricao asc");
				while($l = mysql_fetch_array($obras)) {
					echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>';
				}
			echo '</select>
		</label>';
		exit;
}
//MEDIÇÃO
	if($relatorio==5) {
		foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1); 
		foreach($st as $sts) { @$sta .= $sts.','; } $sta = substr($sta,0,-1); 
		foreach($md as $mds) { @$mda .= $mds.','; } $mda = substr($mda,0,-1);
		
		$inicial = implode("-",array_reverse(explode("/",$inicial))); 
		$final = implode("-",array_reverse(explode("/",$final))); 
		
		echo '<center><img src="http://www.polemicalitoral.com.br/guaruja/imagens/logo.png" width="80px;" style="margin-right:40px;"><h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:4px; text-align:center; margin-bottom:20px;"><p>RELATORIO POR MEDIÇÃO</p></h3></center>';
		echo '<p style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">';
					$obra_controle = mysql_query("SELECT * FROM notas_obras WHERE id IN($oba)") or die(mysql_error());
					while($c = mysql_fetch_array($obra_controle)){
						echo $c['descricao'].'<br/>';
					}
		echo '</p>';
		
		echo '<table class="table table-bordered table-striped table-min" border="1" style="margin:0 auto; width:100%; margin-bottom:40px;"><thead>';
		echo '
			<tr>
				<th style="background:#fff; border-top:1px solid #fff; border-left:1px solid #fff"></th>
				
				<th colspan="3" style="text-align:center; border:none; border-right:10px solid #FFF; background:#bee5f7">DESPESAS</th>
				
				<th colspan="3" style="text-align:center; border:none; border-right:10px solid #FFF; background:#bee5f7">INVESTIMENTO</th>
				
				<th colspan="3" style="text-align:center; border:none; background:#bee5f7">FATURAMENTO</th>
				
				<th style="background:#fff; border-top:1px solid #fff; border-right:1px solid #fff">';
					if($acesso_login == 'MASTER'){
						echo '<a href="#" onclick=\'$("#myModal2").modal("show"); ldy("ss/editar-valor-medicao.php",".modal-body")\' class="btn btn-xs btn-info pull-right"><span class="glyphicon glyphicon-cog"></span> </a>';
					}
				echo '</th>
			</tr>';
		echo '
			<tr class="small info">
				<th style="text-align:center; border-bottom:none;">MEDIÇÃO</th>
				
				<th style="text-align:center; border-bottom:none;">FATURADO</th>
				<th style="text-align:center; border-bottom:none;">CSI</th>
				<th style="text-align:center; border-bottom:none;">REAJUSTE %</th>
				
				<th style="text-align:center; border-bottom:none;">FATURADO</th>
				<th style="text-align:center; border-bottom:none;">CSI</th>
				<th style="text-align:center; border-bottom:none;">REAJUSTE %</th>
				
				<th style="text-align:center; border-bottom:none;">TOTAL</th>
				<th style="text-align:center; border-bottom:none;">DESPESAS</th>
				<th style="text-align:center; border-bottom:none;">SALDO</th>
				<th style="text-align:center; border-bottom:none;">% MARGEM</th>
			</tr></thead><tbody>';
		foreach($md as $mds) {
			$valor_sabesp = mysql_query("SELECT valor_sabesp_d, valor_sabesp_i, valor_reajuste_d, valor_reajuste_i, valor_despesas FROM ae_medicao WHERE medicao = '$mds' AND obra IN($oba)") or die(mysql_error());
			while($h = mysql_fetch_array($valor_sabesp)){
				$valor_sabesp_d += $h['valor_sabesp_d'];
				$valor_sabesp_i += $h['valor_sabesp_i'];
				$valor_reajuste_d += $h['valor_reajuste_d'];
				$valor_reajuste_i += $h['valor_reajuste_i'];
				$valor_despesas += $h['valor_despesas'];
			}
			$total_sabesp = $valor_sabesp_d + $valor_sabesp_i;
			@$total_porcentagem_1 = (($valor_reajuste_d / $valor_sabesp_d) - 1) * 100;
			@$total_porcentagem_2 = (($valor_reajuste_i / $valor_sabesp_i) - 1) * 100;
			
			@$total_porcentagem_final = (($total_sabesp / $valor_despesas) - 1) * 100;
			if($valor_reajuste_d == '0' && $valor_sabesp_d == '0' && $valor_reajuste_i == '0' && $valor_sabesp_i == '0' && $valor_despesas == '0' && $total_sabesp == '0'){

				echo '<tr class="hidden">';
			}else{
				echo '<tr>';
			}
			echo '
						<td style="text-align:center">'.($mds == 0 ? 'S/MED' : $mds).'</td>
						<td style="text-align:center">'.number_format($valor_reajuste_d,"2",",",".").'</td>
						<td style="text-align:center">'.number_format($valor_sabesp_d,"2",",",".").'</td>
						<td style="text-align:center">'.number_format($total_porcentagem_1,"2").' % </td>
						
						<td style="text-align:center">'.number_format($valor_reajuste_i,"2",",",".").'</td>
						<td style="text-align:center">'.number_format($valor_sabesp_i,"2",",",".").'</td>
						<td style="text-align:center">'.number_format($total_porcentagem_2,"2").'%</td>
						
						<td style="text-align:center">'.number_format($total_sabesp,"2",",",".").'</td></td>
						<td style="text-align:center">'.number_format($valor_despesas,"2",",",".").'</td>
						<td style="text-align:center">'.number_format(($total_sabesp - $valor_despesas),"2",",",".").'</td>
						<td style="text-align:center">'.number_format($total_porcentagem_final,"2").'%</td>
				</tr>';
			$valor_sabesp_d_g += $valor_sabesp_d;
			$valor_sabesp_i_g += $valor_sabesp_i;
			$valor_reajuste_d_g += $valor_reajuste_d;
			$valor_reajuste_i_g += $valor_reajuste_i;
			$valor_despesas_g += $valor_despesas;
			$valor_sabesp_g += $total_sabesp;
			$valor_sabesp_d = 0;
			$valor_sabesp_i = 0;
			$valor_reajuste_d = 0;
			$valor_reajuste_i = 0;
			$valor_despesas = 0;
		}
		echo '
			<tr class="active" style="font-weight:bold">
				<td style="text-align:center">Total</td>
				<td style="text-align:center">R$ '.number_format($valor_reajuste_d_g,"2",",",".").'</td>
				<td style="text-align:center">R$ '.number_format($valor_sabesp_d_g,"2",",",".").'</td>
				<td style="text-align:center">'.@number_format(((($valor_reajuste_d_g / $valor_sabesp_d_g) - 1) * 100),"2").'%</td>
				
				<td style="text-align:center">R$ '.number_format($valor_reajuste_i_g,"2",",",".").'</td>
				<td style="text-align:center">R$ '.number_format($valor_sabesp_i_g,"2",",",".").'</td>
				<td style="text-align:center">'.@number_format(((($valor_reajuste_i_g / $valor_sabesp_i_g) - 1) * 100),"2").'%</td>
				
				<td style="text-align:center">R$ '.number_format($valor_sabesp_g,"2",",",".").'</td>
				<td style="text-align:center">R$ '.number_format($valor_despesas_g,"2",",",".").'</td>
				<td style="text-align:center">R$ '.number_format($valor_sabesp_g - $valor_despesas_g,"2",",",".").'</td>
				<td style="text-align:center">'.@number_format(((($valor_sabesp_g / $valor_despesas_g) - 1) * 100),"2").'%</td>
			</tr>';
		echo '</tbody></table>';
		exit;		
	}
	//MEDIÇÃO
	if($relatorio=='6') { 
		foreach($st as $sts) { @$sta .= $sts.','; } $sta = substr($sta,0,-1); 
		foreach($md as $mds) { @$mda .= $mds.','; } $mda = substr($mda,0,-1);
		foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);
		
		$inicial = implode("-",array_reverse(explode("/",$inicial))); 
		$final = implode("-",array_reverse(explode("/",$final))); 
		
		echo '<center><img src="http://www.polemicalitoral.com.br/guaruja/imagens/logo.png" width="80px;" style="margin-right:40px;"><h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:4px; text-align:center; margin-bottom:20px;"><p>RESUMO MEDIÇÃO</p><small> ';
		$obra_controle = mysql_query("SELECT * FROM notas_obras WHERE id IN($oba)");
					while($c = mysql_fetch_array($obra_controle)){
						echo $c['descricao'].'<br/>';
					}
		echo '
		
		PERIODO DE '.implode("/",array_reverse(explode("-",$inicial))).' À '.implode("/",array_reverse(explode("-",$final))).'</small></h3></center>';
		if($acesso_login == 'MASTER' || $_SESSION['id_usuario_logado'] == '147'){
						echo '<a href="#" onclick=\'$("#myModal2").modal("show"); ldy("gestor/editar-valor-reajuste.php",".modal-body")\' class="btn btn-sm btn-info pull-right hidden-print"><span class="glyphicon glyphicon-cog"></span> </a>';
					}
		$total_sabesp_d = mysql_result(mysql_query("SELECT SUM(valor_sabesp_d) as total FROM ae_medicao WHERE id <> '0' AND obra IN($oba)"),0,"total");
		
		$total_sabesp_i = mysql_result(mysql_query("SELECT SUM(valor_sabesp_i) as total FROM ae_medicao WHERE id <> '0' AND obra IN($oba)"),0,"total");
		

			/*
			//INVESTIMENTO
			$jica1 = mysql_query("select *, sum(ss_se.qtd) as qtd_total from ss_se, ss_principal, ss_itens where ss_principal.situacao IN($sta) and ss_principal.obra IN($oba) and (ss_se.data between '$inicial' and '$final') and ss_itens.frente = '1' and ss_se.cod_ss = ss_principal.id and ss_se.servico = ss_itens.id AND ss_principal.medicao IN($mda) group by ss_se.servico"); 
			
			//DESPESAS
			$jica2 = mysql_query("select *, sum(ss_se.qtd) as qtd_total from ss_se, ss_principal, ss_itens where ss_principal.situacao IN($sta) and ss_principal.obra IN($oba) and (ss_se.data between '$inicial' and '$final') and ss_itens.frente = '2' and ss_se.cod_ss = ss_principal.id and ss_se.servico = ss_itens.id AND ss_principal.medicao IN($mda) group by ss_se.servico"); 
			
			$total_j_i = 0; $total_j_d = 0;
			while($c = mysql_fetch_array($jica1)) {
				$id_producao = mysql_result(mysql_query("select * from ss_itens where id = ".$c['servico'].""),0,"producao");
				$total = $c['qtd_total'] * (mysql_result(mysql_query("select * from ss_itens where id = ".$c['servico'].""),0,"preco"));
				$total_inv += $total;
			}
			while($d = mysql_fetch_array($jica2)) {
				$id_producao = mysql_result(mysql_query("select * from ss_itens where id = ".$d['servico'].""),0,"producao");
				$total = $d['qtd_total'] * (mysql_result(mysql_query("select * from ss_itens where id = ".$d['servico'].""),0,"preco"));
				$total_des += $total;
			}
			*/
		
		$total_itens_i = @mysql_result(mysql_query("SELECT SUM(total) as total FROM ss_itens WHERE obra IN($oba) and status = '0' and frente = 1"),0,"total");
		
		$total_itens_d = @mysql_result(mysql_query("SELECT SUM(total) as total FROM ss_itens WHERE obra IN($oba) and status = '0' and frente = 2"),0,"total");
		
		echo '<table class="table table-bordered table-striped" border="1" style="margin:0 auto; width:100%; margin-bottom:40px; font-size:20px;">';
		echo '<tr><th></th><th style="text-align:center">DESPESAS</th><th style="text-align:center">INVESTIMENTO</th><th style="text-align:center">TOTAL</th></tr>';
		$total_itens_geral = $total_itens_d + $total_itens_i;
		echo '
			<tr class="active">
				<th style="text-align:center">VALOR CONTRATO</th>
				<td style="text-align:center">R$ '.number_format($total_itens_d,"2",",",".").'</td>
				<td style="text-align:center">R$ '.number_format($total_itens_i,"2",",",".").'</td>
				<td style="text-align:center">R$ '.number_format($total_itens_geral,"2",",",".").'</td>
			</tr>';
		$total_sabesp_geral = $total_sabesp_d + $total_sabesp_i;
		echo '
			<tr class="active">
				<th style="text-align:center">MEDIDO SABESP CSI</th>
				<td style="text-align:center">R$ '.number_format($total_sabesp_d,"2",",",".").'</td>
				<td style="text-align:center">R$ '.number_format($total_sabesp_i,"2",",",".").'</td>
				<td style="text-align:center">R$ '.number_format($total_sabesp_geral,"2",",",".").'</td>
			</tr>';
		$total_medido_geral = $total_des + $total_inv;
		/* echo '
			<tr class="active">
				<th style="text-align:center">EXECUTADO POLEMICA</th>
				<td style="text-align:center">R$ '.number_format($total_des,"2",",",".").'</td>
				<td style="text-align:center">R$ '.number_format($total_inv,"2",",",".").'</td>
				<td style="text-align:center">R$ '.number_format($total_medido_geral,"2",",",".").'</td>
			</tr>';
		$total_div_1 = $total_des - $total_sabesp_d;
		$total_div_2 = $total_inv - $total_sabesp_i;
		$total_div_geral = $total_div_1 + $total_div_2;
		echo '
			<tr class="active">
				<th style="text-align:center">RECEBER</th>
				<td style="text-align:center">R$ '.number_format($total_div_1,"2",",",".").'</td>
				<td style="text-align:center">R$ '.number_format($total_div_2,"2",",",".").'</td>
				<td style="text-align:center">R$ '.number_format($total_div_geral,"2",",",".").'</td>
			</tr>';

		*/
		$total_saldo_1 = $total_itens_d - $total_sabesp_d;
		$total_saldo_2 = $total_itens_i - $total_sabesp_i;
		$total_saldo_geral = $total_saldo_1 + $total_saldo_2;
		echo '
			<tr class="active">
				<th style="text-align:center">SALDO / CONTRATO</th>
				<td style="text-align:center">R$ '.number_format($total_saldo_1,"2",",",".").'</td>
				<td style="text-align:center">R$ '.number_format($total_saldo_2,"2",",",".").'</td>
				<td style="text-align:center">R$ '.number_format($total_saldo_geral,"2",",",".").'</td>
			</tr>';
		@$total_div_1 = @($total_sabesp_d / $total_itens_d) * 100;
		@$total_div_2 = @($total_sabesp_i / $total_itens_i) * 100;
		@$total_div_geral = @($total_sabesp_geral / $total_itens_geral) * 100;
		echo '
			<tr class="active">
				<th style="text-align:center">MEDIDO %</th>
				<td style="text-align:center">'.number_format($total_div_1,"2",",",".").'%</td>
				<td style="text-align:center">'.number_format($total_div_2,"2",",",".").'%</td>
				<td style="text-align:center">'.number_format($total_div_geral,"2",",",".").'%</td>
			</tr>';

		
		$desembolso_di = mysql_query("SELECT max_med, id FROM notas_obras WHERE id IN($oba) AND max_med <> '0'");
		while($de = mysql_fetch_array($desembolso_di)){
			$desembolso_medicao = @mysql_result(mysql_query("SELECT medicao FROM ae_medicao WHERE obra = '".$de['id']."' AND parcial = '0' ORDER BY medicao DESC LIMIT 1"),0,"medicao");
			
			$total_final_medicao = $de['max_med'];
			
			$desembolso_total = $de['max_med'] - $desembolso_medicao;
			
			$total_itens_i2 = @mysql_result(mysql_query("SELECT SUM(total) as total FROM ss_itens WHERE obra = '$de[id]' and status = '0' and frente = 1"),0,"total");
		
			$total_itens_d2 = @mysql_result(mysql_query("SELECT SUM(total) as total FROM ss_itens WHERE obra = '$de[id]' and status = '0' and frente = 2"),0,"total");
		
			$total_sabesp_d2 = mysql_result(mysql_query("SELECT SUM(valor_sabesp_d) as total FROM ae_medicao WHERE id <> '0' AND obra = '$de[id]'"),0,"total");
		
			$total_sabesp_i2 = mysql_result(mysql_query("SELECT SUM(valor_sabesp_i) as total FROM ae_medicao WHERE id <> '0' AND obra = '$de[id]'"),0,"total");
			
			$saldo_contrato_d += ($total_itens_d2 - $total_sabesp_d2) / $desembolso_total;
			$saldo_contrato_i += ($total_itens_i2 - $total_sabesp_i2) / $desembolso_total;
		}
		//VALDINEI VAI TIRAR DEPOIS (MESMO EU ACHANDO QUE TA ERRADO)
		@$vaivoltar_atras = (100 / $total_final_medicao) * $desembolso_medicao;
		echo '
			<tr class="active">
				<th style="text-align:center">PREVISTO %</th>
				<td style="text-align:center">'.number_format($vaivoltar_atras,"2",",",".").'%</td>
				<td style="text-align:center">'.number_format($vaivoltar_atras,"2",",",".").'%</td>
				<td style="text-align:center">'.number_format($vaivoltar_atras,"2",",",".").'%</td>
			</tr>';
		
		echo '
			<tr class="active">
				<th style="text-align:center">SALDO %</th>
				<td style="text-align:center">'.number_format($vaivoltar_atras - $total_div_1,"2",",",".").' %</td>
				<td style="text-align:center">'.number_format($vaivoltar_atras - $total_div_2,"2",",",".").' %</td>
				<td style="text-align:center">'.number_format($vaivoltar_atras - $total_div_geral,"2",",",".").'%</td>
			</tr>';
		echo '
			<tr class="active">
				<th style="text-align:center">DESEMBOLSO</th>
				<td style="text-align:center">R$ '.number_format($saldo_contrato_d,"2",",",".").'</td>
				<td style="text-align:center">R$ '.number_format($saldo_contrato_i,"2",",",".").'</td>
				<td style="text-align:center">R$ '.number_format($saldo_contrato_d + $saldo_contrato_i,"2",",",".").'</td>
			</tr>';
			@$qtd_mes_d = $total_saldo_1 / $saldo_contrato_d;
			@$qtd_mes_i = $total_saldo_2 / $saldo_contrato_i;
			@$qtd_total_mes = $total_saldo_geral / ($saldo_contrato_d + $saldo_contrato_i);
		echo '
			<tr class="active">
			
				<th style="text-align:center">QTDE MÊS</th>
				<td style="text-align:center">'.number_format($qtd_mes_d,"2",",",".").'</td>
				<td style="text-align:center">'.number_format($qtd_mes_i,"2",",",".").'</td>
				<td style="text-align:center">'.number_format($qtd_total_mes,"2",",",".").'</td>
			</tr>';
		echo '</table>';
		exit;		
	}
	//MEDIÇÃO 2
	if($relatorio=='7') {
		foreach($st as $sts) { @$sta .= $sts.','; } $sta = substr($sta,0,-1); 
		foreach($md as $mds) { @$mda .= $mds.','; } $mda = substr($mda,0,-1);
		foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);
		
		$inicial = implode("-",array_reverse(explode("/",$inicial))); 
		$final = implode("-",array_reverse(explode("/",$final))); 
		
		echo '<center><img src="http://www.polemicalitoral.com.br/guaruja/imagens/logo.png" width="80px;" style="margin-right:40px;"><h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:4px; text-align:center; margin-bottom:20px;"><p>RESUMO MEDIÇÃO</p><small> PERIODO DE '.implode("/",array_reverse(explode("-",$inicial))).' À '.implode("/",array_reverse(explode("-",$final))).'</small></h3></center>';
		if($acesso_login == 'MASTER'){
						echo '<a href="#" onclick=\'$("#myModal2").modal("show"); ldy("gestor/editar-valor-reajuste.php",".modal-body")\' class="btn btn-sm btn-info pull-right"><span class="glyphicon glyphicon-cog"></span> </a>';
					}
		$total_sabesp_d = mysql_result(mysql_query("SELECT SUM(valor_sabesp_d) as total FROM ae_medicao WHERE obra IN($oba) and id <> '0'"),0,"total");
		
		$total_sabesp_i = mysql_result(mysql_query("SELECT SUM(valor_sabesp_i) as total FROM ae_medicao WHERE obra IN($oba) and id <> '0'"),0,"total");
		

			
			//INVESTIMENTO
			$jica1 = mysql_query("select *, sum(ss_se.qtd) as qtd_total from ss_se, ss_principal, ss_itens where ss_principal.situacao IN($sta) and ss_principal.obra IN($oba) and (ss_se.data between '$inicial' and '$final') and ss_itens.frente = '1' and ss_se.cod_ss = ss_principal.id and ss_se.servico = ss_itens.id AND ss_principal.medicao = '0' group by ss_se.servico"); 
			
			//DESPESAS
			$jica2 = mysql_query("select *, sum(ss_se.qtd) as qtd_total from ss_se, ss_principal, ss_itens where ss_principal.situacao IN($sta) and ss_principal.obra IN($oba) and (ss_se.data between '$inicial' and '$final') and ss_itens.frente = '2' and ss_se.cod_ss = ss_principal.id and ss_se.servico = ss_itens.id AND ss_principal.medicao = '0' group by ss_se.servico"); 
			
			$total_j_i = 0; $total_j_d = 0;
			while($c = mysql_fetch_array($jica1)) {
				$id_producao = mysql_result(mysql_query("select * from ss_itens where id = ".$c['servico'].""),0,"producao");
				$total = $c['qtd_total'] * (mysql_result(mysql_query("select * from ss_itens where id = ".$c['servico'].""),0,"preco"));
				$total_inv += $total;
			}
			while($d = mysql_fetch_array($jica2)) {
				$id_producao = mysql_result(mysql_query("select * from ss_itens where id = ".$d['servico'].""),0,"producao");
				$total = $d['qtd_total'] * (mysql_result(mysql_query("select * from ss_itens where id = ".$d['servico'].""),0,"preco"));
				$total_des += $total;
			}
			
		$total_itens_i = @mysql_result(mysql_query("SELECT SUM(total) as total FROM ss_itens WHERE obra IN($oba) and status = '0' and frente = 1"),0,"total");
		
		$total_itens_d = @mysql_result(mysql_query("SELECT SUM(total) as total FROM ss_itens WHERE obra IN($oba) and status = '0' and frente = 2"),0,"total");
		
		echo '<table class="table table-bordered table-striped" border="1" style="margin:0 auto; width:80%; margin-bottom:40px; font-size:20px;">';
		echo '<tr><th></th><th style="text-align:center">DESPESAS</th><th style="text-align:center">INVESTIMENTO</th><th style="text-align:center">TOTAL</th></tr>';
		$total_itens_geral = $total_itens_d + $total_itens_i;
		echo '
			<tr class="active">
				<th style="text-align:center">VALOR CONTRATO</th>
				<td style="text-align:center">R$ '.number_format($total_itens_d,"2",",",".").'</td>
				<td style="text-align:center">R$ '.number_format($total_itens_i,"2",",",".").'</td>
				<td style="text-align:center">R$ '.number_format($total_itens_geral,"2",",",".").'</td>
			</tr>';
		$total_sabesp_geral = $total_sabesp_d + $total_sabesp_i;
		echo '
			<tr class="active">
				<th style="text-align:center">MEDIDO SABESP</th>
				<td style="text-align:center">R$ '.number_format($total_sabesp_d,"2",",",".").'</td>
				<td style="text-align:center">R$ '.number_format($total_sabesp_i,"2",",",".").'</td>
				<td style="text-align:center">R$ '.number_format($total_sabesp_geral,"2",",",".").'</td>
			</tr>';
		$total_medido_sabesp_1 = $total_sabesp_d + $total_des;
		$total_medido_sabesp_2 = $total_sabesp_i + $total_inv;
		$total_medido_geral = $total_medido_sabesp_1 + $total_medido_sabesp_2;

		echo '
			<tr class="active">
				<th style="text-align:center">EXECUTADO</th>
				<td style="text-align:center">R$ '.number_format($total_medido_sabesp_1,"2",",",".").'</td>
				<td style="text-align:center">R$ '.number_format($total_medido_sabesp_2,"2",",",".").'</td>
				<td style="text-align:center">R$ '.number_format($total_medido_geral,"2",",",".").'</td>
			</tr>';
			$total_div_geral = $total_des + $total_inv;
		echo '
			<tr class="active">
				<th style="text-align:center">DIVIDA</th>
				<td style="text-align:center">R$ '.number_format($total_des,"2",",",".").'</td>
				<td style="text-align:center">R$ '.number_format($total_inv,"2",",",".").'</td>
				<td style="text-align:center">R$ '.number_format($total_div_geral,"2",",",".").'</td>
			</tr>';
		$reajuste_d = @mysql_result(mysql_query("SELECT SUM(reajuste_d) AS total FROM ae_reajuste WHERE obra IN($oba)"),0,"total");
		$reajuste_i = @mysql_result(mysql_query("SELECT SUM(reajuste_i) AS total FROM ae_reajuste WHERE obra IN($oba)"),0,"total");
		
		$reajuste_d = ($total_des * ($reajuste_d/100)) + $total_des;
		$reajuste_i = ($total_inv * ($reajuste_i/100)) + $total_inv;
		$reajuste_total = $reajuste_d + $reajuste_i;
		/*echo '
			<tr class="active">
			
				<th style="text-align:center">DIVIDA C/ REAJUSTE</th>
				<td style="text-align:center">R$ '.number_format($reajuste_d,"2",",",".").'</td>
				<td style="text-align:center">R$ '.number_format($reajuste_i,"2",",",".").'</td>
				<td style="text-align:center">R$ '.number_format($reajuste_total,"2",",",".").'</td>
			</tr>';*/
		$total_saldo_1 = $total_itens_d - $total_medido_sabesp_1;
		$total_saldo_2 = $total_itens_i - $total_medido_sabesp_2;
		$total_saldo_geral = $total_saldo_1 + $total_saldo_2;
		echo '
			<tr class="active">
			
				<th style="text-align:center">SALDO / CONTRATO</th>
				<td style="text-align:center">R$ '.number_format($total_saldo_1,"2",",",".").'</td>
				<td style="text-align:center">R$ '.number_format($total_saldo_2,"2",",",".").'</td>
				<td style="text-align:center">R$ '.number_format($total_saldo_geral,"2",",",".").'</td>
			</tr>';
		$desembolso_d = @mysql_result(mysql_query("SELECT SUM(desembolso_d) as total FROM ae_reajuste WHERE obra IN($oba)"),0,"total");
		$desembolso_i = @mysql_result(mysql_query("SELECT SUM(desembolso_i) as total FROM ae_reajuste WHERE obra IN($oba)"),0,"total");
		$desembolso_total = $desembolso_d + $desembolso_i;
		echo '
			<tr class="active">
			
				<th style="text-align:center">DESEMBOLSO</th>
				<td style="text-align:center">R$ '.number_format($desembolso_d,"2",",",".").'</td>
				<td style="text-align:center">R$ '.number_format($desembolso_i,"2",",",".").'</td>
				<td style="text-align:center">R$ '.number_format($desembolso_total,"2",",",".").'</td>
			</tr>';
			@$qtd_mes_d = $total_saldo_1 / $desembolso_d;
			@$qtd_mes_i = $total_saldo_2 / $desembolso_i;
			@$qtd_total_mes = $total_saldo_geral / $desembolso_total;
		echo '
			<tr class="active">
			
				<th style="text-align:center">QTDE MÊS</th>
				<td style="text-align:center">'.number_format($qtd_mes_d,"2",",",".").'</td>
				<td style="text-align:center">'.number_format($qtd_mes_i,"2",",",".").'</td>
				<td style="text-align:center">'.number_format($qtd_total_mes,"2",",",".").'</td>
			</tr>';
		echo '</table>';
		exit;		
	}
	//M E N S A L
	if($relatorio=='8') {
		foreach($st as $sts) { @$sta .= $sts.','; } $sta = substr($sta,0,-1); 
		foreach($md as $mds) { @$mda .= $mds.','; } $mda = substr($mda,0,-1);
		foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);
		$final2 = substr($final,0,-3);
		$inicial2 = substr($inicial,0,-3);
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
						RELATORIO MENSAL - MEDIDO
					</h3>
					<p style="text-align:center;  font-size:18px;"><small>Período: '.implode("/",array_reverse(explode("-",$final2))).'</small></p>
				</p>
				<hr/>
			';		
		
		$sql = mysql_query("SELECT SUM(valor_reajuste_d) as valor_reajuste_d, SUM(valor_reajuste_i) as valor_reajuste_i, SUM(valor_sabesp_d) as valor_sabesp_d, SUM(valor_sabesp_i) as valor_sabesp_i, obra, medicao, parcial, parcial_obs FROM ae_medicao WHERE (data_ref BETWEEN '$inicial2' and '$final2') AND obra IN($oba) GROUP BY obra ORDER BY medicao DESC");
		echo '<table class="table table-striped" style="margin:0 auto; width:100%; margin-bottom:10px; font-size:15px;">
				
				<tr class="active">
					<td style="text-align:center; vertical-align:middle; font-size:11px;" width="30%" rowspan="2" ><b>CONTRATO</b></td>
					<td style="text-align:center; vertical-align:middle; font-size:11px;" width="11%"><b>&nbsp;FRENTE&nbsp;</b></td>
					<td style="text-align:center; vertical-align:middle; font-size:11px;" width="15%"><b>FATURADO</b></td>
					<td style="text-align:center; vertical-align:middle; font-size:11px;" width="15%"><b>CSI</b></td>
					<td style="text-align:center; vertical-align:middle; font-size:11px;" width="5%"><b>%</b></td>
					<td style="text-align:center; vertical-align:middle; font-size:11px;" width="10%"><b>PARCIAL</b></td>
					<td style="text-align:center; vertical-align:middle; font-size:11px;" width="15%"><b>OBS</b></td>
					<td style="text-align:center; vertical-align:middle; font-size:11px;" width="10%" rowspan="2"><b>MEDIÇÃO</b></td>
				</tr>
				
				<tbody>';
				
		while($l = mysql_fetch_array($sql)){
			
				@$total_porcentagem_d = (($l['valor_reajuste_d'] / $l['valor_sabesp_d']) - 1) * 100;
				@$total_porcentagem_i = (($l['valor_reajuste_i'] / $l['valor_sabesp_i']) - 1) * 100;
			echo '
				<tr class="active">
					<td style="text-align:center; text-align:center; vertical-align:middle; font-size:15px;" rowspan="2" width="20%"><b>'.mysql_result(mysql_query("SELECT * FROM notas_obras WHERE id = ".$l['obra'].""),0,"descricao").'</b></td>
					<td style="text-align:center; vertical-align:middle; font-size:12px;" width="10%"><b>DESESPESAS</b></td>
					<td style="text-align:center; vertical-align:middle; font-size:18px;" width="15%"><b>R$ '.number_format($l['valor_reajuste_d'],"2",",",".").'</b></td>
					<td style="text-align:center; vertical-align:middle; font-size:18px;" width="15%"><b>R$ '.number_format($l['valor_sabesp_d'],"2",",",".").'</b></td>
					<td style="text-align:center; vertical-align:middle; font-size:18px;" width="5%"><b>'.number_format($total_porcentagem_d,"2",",",".").'%</b></td>
					<td style="text-align:center; vertical-align:middle; font-size:15px;" rowspan="2" width="10%"><b>'.($l['parcial'] == 0 ? "FINALIZADO" : "PARCIAL").'</b></td>
					<td style="text-align:center; vertical-align:middle; font-size:15px;" rowspan="2" width="15%"><b>'.$l['parcial_obs'].'</b></td>
					<td style="text-align:center; vertical-align:middle;" rowspan="2" width="10%"><b>'.$l['medicao'].'</b></td>
				</tr>';
				$total_faturado += $l['valor_reajuste_d'] + $l['valor_reajuste_i'];
				$total_medido += $l['valor_sabesp_d'] + $l['valor_sabesp_i'];
				
				echo '
				<tr class="active">
					<td style="text-align:center; text-align:center; vertical-align:middle; font-size:12px;" width="10%"><b>INVESTIMENTO</b></td>
					<td style="text-align:center; text-align:center; vertical-align:middle; font-size:18px;" ><b>R$ '.number_format($l['valor_reajuste_i'],"2",",",".").'</b></td>
					<td style="text-align:center; text-align:center; vertical-align:middle; font-size:18px;" ><b>R$ '.number_format($l['valor_sabesp_i'],"2",",",".").'</b></td>
					<td style="text-align:center; text-align:center; vertical-align:middle; font-size:18px;" ><b>'.number_format($total_porcentagem_i,"2",",",".").'% </b></td>
				</tr>';
			$total_geral += $l['valor_sabesp_d'] + $l['valor_sabesp_i'];
		}
		
				echo '<tr class="active">';
				
				@$total_porcentagem_geral = (($total_faturado / $total_medido) - 1) * 100;
					echo '<td colspan="2" style="text-align:center"> <b>TOTAL</b> </td>';
					echo '<td style="text-align:center"> <b>R$ '.number_format($total_faturado,"2",",",".").'</b> </td>';
					echo '<td style="text-align:center"> <b>R$ '.number_format($total_medido,"2",",",".").'</b> </td>';
					echo '<td style="text-align:center"> <b>'.number_format($total_porcentagem_geral,"2",",",".").'%</td>';	
					echo '<td style="text-align:center" colspan="3"> - </td>';	
				echo '</tr>';
			echo '</table>';
			echo '<h1 class="pull-right" style="font-family: \'Oswald\', sans-serif; letter-spacing:5px;">Total Reajuste <small> R$ '.number_format($total_faturado - $total_medido,2,",",".").'</small></h1>';
		exit;
	}	
	// R E A J U S T E 
	if($relatorio=='9') {
		foreach($st as $sts) { @$sta .= $sts.','; } $sta = substr($sta,0,-1); 
		foreach($md as $mds) { @$mda .= $mds.','; } $mda = substr($mda,0,-1);
		foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);
		$final2 = substr($final,0,-3);
		$inicial2 = substr($inicial,0,-3);
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
						RELATORIO MENSAL - FINANCEIRO
					</h3>
					<p style="text-align:center;  font-size:18px;"><small>Período: '.implode("/",array_reverse(explode("-",$inicial2))).' ate '.implode("/",array_reverse(explode("-",$final2))).'</small></p>
				</p>
				<hr/>
			';		
		
		$sql = mysql_query("SELECT SUM(valor_reajuste_d) as valor_reajuste_d, SUM(valor_reajuste_i) as valor_reajuste_i, SUM(valor_despesas) as valor_despesas, obra FROM ae_medicao WHERE (data_ref BETWEEN '$inicial2' and '$final2') AND obra IN($oba) GROUP BY obra");
		echo '<table class="table table-min" style="margin:0 auto; width:100%; margin-bottom:10px; font-size:15px;">';
				echo '
				<thead>
				<tr class="active">
					<td style="text-align:center; text-align:center; vertical-align:middle; font-size:11px;"><b>CONTRATO</b></td>
					<td style="text-align:center; text-align:center; vertical-align:middle; font-size:11px;"><b>DESPESAS</b></td>
					<td style="text-align:center; text-align:center; vertical-align:middle; font-size:11px;"><b>INVESTIMENTO</b></td>
					<td style="text-align:center; text-align:center; vertical-align:middle; font-size:11px;"><b>TOTAL</b></td>
					<td style="text-align:center; text-align:center; vertical-align:middle; font-size:11px;"><b>DESPESAS</b></td>
					<td style="text-align:center; text-align:center; vertical-align:middle; font-size:11px;"><b>SALDO</b></td>
					<td style="text-align:center; text-align:center; vertical-align:middle; font-size:11px;"><b>%</b></td>
				</tr>
				</thead>
				<tbody>';
		while($l = mysql_fetch_array($sql)){
				$total_faturamento = $l['valor_reajuste_d'] + $l['valor_reajuste_i'];
				$total_saldo = $total_faturamento-$l['valor_despesas'];
				
				@$total_porcentagem = (($total_faturamento / $l['valor_despesas']) - 1) * 100;
				echo '
				<tr>
					<td style="text-align:center; text-align:center; vertical-align:middle; font-size:15px;"><b>'.mysql_result(mysql_query("SELECT * FROM notas_obras WHERE id = ".$l['obra'].""),0,"descricao").'</b></td>
					<td style="text-align:center; vertical-align:middle; font-size:15px;"><b>'.number_format($l['valor_reajuste_d'] ,"2",",",".").'</b></td>
					<td style="text-align:center; vertical-align:middle; font-size:15px;"><b>'.number_format($l['valor_reajuste_i'] ,"2",",",".").'</b></td>
					<td style="text-align:center; vertical-align:middle; font-size:15px;"><b>'.number_format($total_faturamento ,"2",",",".").'</b></td>
					<td style="text-align:center; vertical-align:middle; font-size:15px;"><b>'.number_format($l['valor_despesas'] ,"2",",",".").'</b></td>
					<td style="text-align:center; vertical-align:middle; font-size:15px;"><b>'.number_format($total_saldo ,"2",",",".").'</b></td>';
					//<td style="text-align:center; vertical-align:middle; font-size:15px;"><b>'.($l['parcial'] == 0 ? "FINALIZADO" : "PARCIAL").'</b></td>
					echo '<td style="text-align:center; vertical-align:middle; font-size:15px;"><b>'.number_format($total_porcentagem, "2", ",", ".").' % </b></td>
				</tr>';
			$total_geral += $total_saldo;
			$total_faturamento_g += $total_faturamento;
			$total_despesas_g += $l['valor_despesas'];
			$total_reajuste_d += $l['valor_reajuste_d'];
			$total_reajuste_i += $l['valor_reajuste_i'];
		}
		@$total_porcentagem_g = (($total_faturamento_g / $total_despesas_g) - 1) * 100;
		echo '</tbody>';
		echo '
				<tfoot>
				<tr class="active">
					<td style="text-align:center; text-align:center; vertical-align:middle; font-size:15px;"><b>TOTAL</b></td>
					<td style="text-align:center; text-align:center; vertical-align:middle; font-size:15px;"><b>R$ '.number_format($total_reajuste_d ,"2",",",".").'</b></td>
					<td style="text-align:center; text-align:center; vertical-align:middle; font-size:15px;"><b>R$ '.number_format($total_reajuste_i ,"2",",",".").'</b></td>
					<td style="text-align:center; text-align:center; vertical-align:middle; font-size:15px;"><b>R$ '.number_format($total_faturamento_g ,"2",",",".").'</b></td>
					<td style="text-align:center; text-align:center; vertical-align:middle; font-size:15px;"><b>R$ '.number_format($total_despesas_g ,"2",",",".").'</b></td>
					<td style="text-align:center; text-align:center; vertical-align:middle; font-size:15px;"><b>R$ '.number_format($total_geral ,"2",",",".").'</b></td>
					<td style="text-align:center; text-align:center; vertical-align:middle; font-size:15px;"><b>'.number_format($total_porcentagem_g,"2").' % </b></td>
				</tr>
				</tfoot>';
		echo '</table>';
		echo '<h1 class="pull-right" style="font-family: \'Oswald\', sans-serif; letter-spacing:5px;">Total Geral <small> R$ '.number_format($total_geral,2,",",".").'</small></h1>';
		exit;
	}
?>
	<div style="clear: both;">
		<h3 style="font-family: 'Oswald', sans-serif;letter-spacing:8px;">
			RELATORIO <small> SS MEDIDAS</small>
			<a a href="javascript:window.print()" style="letter-spacing:5px; position:relative; bottom:10px;" class="hidden-xs hidden-print pull-right btn btn-warning btn-sm"> <span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Imprimir</a>
		</h3>
	</div>
	<div style="clear: both;">
		<hr></hr>
	</div>
	<form action="javascript:void(0)" onSubmit="posti(this,'gestor/relatorio-medicao.php','.resultado');" class="form-inline hidden-print">
		<div class="well well-sm">
		<label style="margin-top:10px"><small>Obra:</small>
			<select name="ci[]" onChange="$('#itens22').load('gestor/relatorio-medicao.php?atu=ac&cidade=' + $(this).val() + '');" style="width:250px;" class="sel" multiple="multiple" id="categ" required> 
				<?php
					$cidade = mysql_query("select * from notas_obras_cidade WHERE id IN(0,$cidade_usuario) order by nome asc");
					while($l = mysql_fetch_array($cidade)) {
						echo '<option value="'.$l['id'].'" selected>'.$l['nome'].'</option>';
					}
				?>	
			</select>
		</label>
		<label id="itens22">
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
		</label>
		<label for=""><small>Período:</small>  
			<input type="date" name="inicial" class="form-control input-sm" value="<?php echo $inicioMes; ?>" size="10" required />
		</label>
		<label for=""><small>ate</small>  
			<input type="date" name="final" class="form-control input-sm" size="10" value="<?php echo $todayTotal; ?>" placeholder="Final" size="8" required />
		</label>
		<label for=""><small>Tipo:</small>
			<select name="relatorio" class="form-control input-sm" style="width: 200px">
				<option value="" disabled>SELECIONE O RELATÓRIO</option>
				<option value="5">RELATORIO MEDICAO</option>
				<option value="6">SALDO CONTRATO</option>
				<option value="7">SALDO S / REAJUSTE</option>
				<option value="8">MENSAL MEDIDO</option>
				<option value="9">SALDO FINANCEIRO</option>
			</select>
		</label>
		<label for=""><small>Situação:</small>
			<select name="st[]" class="sel" multiple="multiple">
			<?php
				$sts = mysql_query("select * from ss_situacao order by descricao asc");
				while($l = mysql_fetch_array($sts)) { extract($l);
					echo '<option value="'.$id.'" selected>'.$descricao.'</option>';
				}
			?>
			</select>
		</label>
		<label for="">
			<small>Medição:</small>
			<select name="md[]" class="form-control input-sm sel" multiple="multiple" style="width: 120px">
				<?php
				$medicao = mysql_query("select * from ae_medicao group by medicao order by medicao asc");
				while($l = mysql_fetch_array($medicao)) {
					echo '<option value="'.$l['medicao'].'" selected>'.$l['medicao'].'</option>';
				}
				?>
			</select>
		</label>
		<label for="">
			<input type="submit" value="Listar" style="width:150px" class="btn btn-success btn-sm pull-right" />
		</label>
	</div>	
	</form>

	<div class="resultado"></div>

	<div class="modal" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:auto;">
		<div class="modal-dialog" style="width:90%;">
			<div class="modal-content" style="width:100%; padding-bottom:10px;">
				<div class="modal-header" style="width:100%">
					<button type="button" class="close" onclick="$('.modal').modal('hide')" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Configuração</h4>
				</div>
				<div class="modal-body" style="width:100%; max-height:500px; overflow:auto; border-bottom:1px solid #E5E5E5;">
					Aguarde um momento &nbsp;&nbsp; <img src="../../imagens/loading.gif" alt="Carregando" width="20px"/>
				</div>
			</div>
		</div>
	</div>