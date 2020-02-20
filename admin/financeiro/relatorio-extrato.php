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
	@media print {
		table, tr, thead, tbody, td, th{
			border:1px solid #000 !important;
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
		// RELATORIO DE Contas
		if($relatorio == 1) {
			foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1); //Obra
			foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1); //Conta
			foreach($ci as $cis) { @$ciu .= $cis.','; } $ciu = substr($ciu,0,-1); //Cidade
			foreach($ti as $tis) { @$tiu .= $tis.','; } $tiu = substr($tiu,0,-1); //Tipo
			foreach($emp as $emps) { @$empa .= $emps.','; } $empa = substr($empa,0,-1); //Empresa
			topoPrint();
			
			$ano = explode("-",$final);
			echo '
				<p>
					<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
						RELATORIO NOTA FISCAL - DESPESAS
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
			echo '<table class="table table-condensed table-bordered table-color" style="font-size:11px;">';
			echo '<thead><tr>
						<th style="text-align:center">Nota</th>
						<th style="text-align:center">Emissão</th>
						<th style="text-align:center">Obra</th>
						<th>Empresa</th>
						<th style="text-align:center">Conta</th>
						<th style="text-align:center">Previsão</th>
						<th style="text-align:center">Valor Pago</th>
						<th style="text-align:center">Parcela</th>
						<th style="text-align:center">Editar</th>
					</tr></thead>';
			$nota_sql = mysql_query("SELECT notas_nf_venc.*, notas_nf_venc.id as id_venc, notas_nf_venc.data as data_venc, notas_nf.numero, notas_nf.obra, notas_nf.recebimento, notas_nf.empresa, notas_nf.id as id_nota_c, notas_nf.tipo_nota FROM notas_nf_venc INNER JOIN notas_nf ON notas_nf_venc.nota = notas_nf.id WHERE (notas_nf_venc.data_pagamento BETWEEN '$inicial' and '$final') AND notas_nf.tipo_nota IN($tiu) AND notas_nf_venc.conta IN($equ) AND notas_nf.empresa IN($empa) AND notas_nf.obra IN($oba) ORDER BY notas_nf_venc.data ASC");		
			echo '<tbody>';
			while($l = mysql_fetch_array($nota_sql)) { extract($l);	
				$cidade_nt = mysql_result(mysql_query("SELECT cidade FROM notas_obras WHERE id = '$obra'"),0,"cidade");
				echo '<tr>';	
				echo '<td width="5%" style="text-align:center">'.$numero.'</td>';
				echo '<td width="5%" data-value="'.$recebimento.'" style="text-align:center">'.implode("/",array_reverse(explode("-",$recebimento))).'</td>';
				echo '<td width="8%" style="text-align:center">'.mysql_result(mysql_query("select * from notas_obras where id = '$obra'"),0,"descricao").'</td>';
				echo '<td width="30%">'.@mysql_result(mysql_query("select * from empresa_cadastro where id = '$empresa'"),0,"razao_social").'</td>';
				echo '<td width="8%"  style="text-align:center">'.@mysql_result(mysql_query("select * from equipes where id = '$conta'"),0,"nome").'</td>';
				echo '<td width="10%" data-value="'.$data_pagamento.'" style="text-align:center"><span class="text-info"><b>'.implode("/",array_reverse(explode("-",$data_pagamento))).'</b></span></td>';
				echo '<td style="width:8%; text-align:center">';
				if($tipo_nota == '0'){
					echo '<b class="text-danger">- R$ '.number_format($valor_pagamento,2,",",".").'</b>';
					$total_geral_pago += $valor_pagamento;	
				}else if($tipo_nota == '1'){
					echo '<b class="text-success">R$ '.number_format($valor_pagamento,2,",",".").'</b>';				
					$total_geral_recebido += $valor_pagamento;		
				}else if($tipo_nota == '2'){
					echo '<b class="text-success">R$ '.number_format($valor_pagamento,2,",",".").'</b>';				
					$total_geral_recebido += $valor_pagamento;	
				}
				echo '</td>';
				echo '<td width="8%" style="text-align:center"><b>'.$parcela.'</b> / '.mysql_num_rows(mysql_query("SELECT * FROM notas_nf_venc WHERE nota = '$id_nota_c'")).'</td>';
				echo '<td  width="5%" style="text-align:center"> <a href="#" onclick=\'$(".modal-body").load("financeiro/editar-vencimento.php?id_venc='.$id_venc.'&cidade_nt='.$cidade_nt.'")\' data-toggle="modal" data-target="#myModal"  class="btn btn-info btn-xs" style="margin:0px; padding:5px; font-size:9px;"><span class="glyphicon glyphicon-edit"></span></a></td>';	
				$total_geral_venc += $valor;				
				$total_geral_previsao += $valor_pagamento;								
							
			}
			echo '<tbody></table>';
			echo '<div class="container-fluid">
				<h1 class="pull-right" style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:right">
					Despesas <small> R$ '.number_format($total_geral_pago,2,",",".").'</small><br/>
					Recebimento<small> R$ '.number_format($total_geral_recebido,2,",",".").'</small>
				</h1>
				
				</div>';			
			exit;		
		}
		// RELATORIO DE Contas
		if($relatorio == 2) {
			foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1); //Obra
			foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1); //Conta
			foreach($ci as $cis) { @$ciu .= $cis.','; } $ciu = substr($ciu,0,-1); //Cidade
			foreach($ti as $tis) { @$tiu .= $tis.','; } $tiu = substr($tiu,0,-1); //Tipo
			foreach($emp as $emps) { @$empa .= $emps.','; } $empa = substr($empa,0,-1); //Empresa
			topoPrint();
			
			$ano = explode("-",$final);
			echo '
				<p>
					<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
						RELATORIO NOTA FISCAL - TESTE
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
			echo '<table class="table table-condensed table-bordered table-color" style="font-size:11px;">';
			echo '<thead><tr>
						<th style="text-align:center">Nota</th>
						<th style="text-align:center">Emissão</th>
						<th style="text-align:center">Obra</th>
						<th>Empresa</th>
						<th style="text-align:center">Conta</th>
						<th style="text-align:center">Venc</th>
						<th style="text-align:center">Valor Venc</th>
						<th style="text-align:center">Parcela</th>
						<th style="text-align:center">Editar</th>
					</tr></thead>';
			$nota_sql = mysql_query("SELECT notas_nf_venc.*, notas_nf_venc.id as id_venc, notas_nf_venc.data as data_venc, notas_nf.numero, notas_nf.obra, notas_nf.recebimento, notas_nf.empresa, notas_nf.id as id_nota_c, notas_nf.tipo_nota FROM notas_nf_venc INNER JOIN notas_nf ON notas_nf_venc.nota = notas_nf.id WHERE (notas_nf_venc.data BETWEEN '$inicial' and '$final') AND notas_nf.tipo_nota IN($tiu) AND notas_nf_venc.conta IN($equ) AND notas_nf.empresa IN($empa) AND notas_nf.obra IN($oba) ORDER BY notas_nf_venc.data ASC");		
			echo '<tbody>';
			while($l = mysql_fetch_array($nota_sql)) { extract($l);	
				$cidade_nt = mysql_result(mysql_query("SELECT cidade FROM notas_obras WHERE id = '$obra'"),0,"cidade");
				echo '<tr>';	
				echo '<td width="5%" style="text-align:center">'.$numero.'</td>';
				echo '<td width="5%" data-value="'.$recebimento.'" style="text-align:center">'.implode("/",array_reverse(explode("-",$recebimento))).'</td>';
				echo '<td width="8%" style="text-align:center">'.mysql_result(mysql_query("select * from notas_obras where id = '$obra'"),0,"descricao").'</td>';
				echo '<td width="30%">'.@mysql_result(mysql_query("select * from empresa_cadastro where id = '$empresa'"),0,"razao_social").'</td>';
				echo '<td width="8%"  style="text-align:center">'.@mysql_result(mysql_query("select * from equipes where id = '$conta'"),0,"nome").'</td>';
				echo '<td width="10%" data-value="'.$data_venc.'" style="text-align:center"><span class="text-info"><b>'.implode("/",array_reverse(explode("-",$data_venc))).'</b></span></td>';
				
				echo '<td style="width:8%; text-align:center">';
				if($tipo_nota == '0'){
					echo '<b class="text-danger">- R$ '.number_format($valor_pagamento,2,",",".").'</b>';
					$total_geral_pago += $valor_pagamento;	
				}else if($tipo_nota == '1'){
					echo '<b class="text-success">R$ '.number_format($valor_pagamento,2,",",".").'</b>';				
					$total_geral_recebido += $valor_pagamento;		
				}else if($tipo_nota == '2'){
					echo '<b class="text-success">R$ '.number_format($valor_pagamento,2,",",".").'</b>';				
					$total_geral_recebido += $valor_pagamento;	
				}
				echo '</td>';
				
				echo '<td width="8%" style="text-align:center"><b>'.$parcela.'</b> / '.mysql_num_rows(mysql_query("SELECT * FROM notas_nf_venc WHERE nota = '$id_nota_c'")).'</td>';
				echo '<td  width="5%" style="text-align:center"> <a href="#" onclick=\'$(".modal-body").load("financeiro/editar-vencimento.php?id_venc='.$id_venc.'&cidade_nt='.$cidade_nt.'")\' data-toggle="modal" data-target="#myModal"  class="btn btn-info btn-xs" style="margin:0px; padding:5px; font-size:9px;"><span class="glyphicon glyphicon-edit"></span></a></td>';	
				$total_geral_venc += $valor;				
				$total_geral_previsao += $valor_pagamento;								
							
			}
			echo '<tbody></table>';
			echo '<div class="container-fluid">
				<h1 class="pull-right" style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:right">
					Despesas <small> R$ '.number_format($total_geral_pago,2,",",".").'</small><br/>
					Recebimento<small> R$ '.number_format($total_geral_recebido,2,",",".").'</small>
				</h1>
				
				</div>';			
			exit;		
		}
		// SALDO FIXO
		if($relatorio == 3) {
			foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1); //Obra
			foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1); //Conta
			foreach($ci as $cis) { @$ciu .= $cis.','; } $ciu = substr($ciu,0,-1); 
			$nome_empresa_ex = mysql_result(mysql_query(
			"SELECT * FROM notas_obras_cidade WHERE id = '$ciu'"),0,"nome_exibir");
			//Cidade
			foreach($ti as $tis) { @$tiu .= $tis.','; } $tiu = substr($tiu,0,-1); //Tipo
			foreach($emp as $emps) { @$empa .= $emps.','; } $empa = substr($empa,0,-1); //Empresa
			topoPrint();
			echo '<div class="col-xs-12" style="border-top:1px solid #CCC; border-bottom:1px solid #CCC; padding:10px 0px; font-size:12px; margin:10px 0px 20px 0px">';
			echo '<div class="col-xs-6" style="padding:0px">'.$nome_empresa_ex.'</div>';
			echo '<div class="col-xs-6" style="padding:0px"><span class="pull-right">*Periodo: '.implode("/",array_reverse(explode("-",$inicial))).' a '.implode("/",array_reverse(explode("-",$final))).'</span></div>';
			echo '</div>';
			echo '<table class="table table-condensed table-color" style="font-size:11px;">';
			echo '<thead><tr>
						<th style="text-align:center">Data</th>
						<th style="text-align:center">Filial</th>
						<th>Descrição</th>
						<th>Obs</th>
						<th style="text-align:center">Numero</th>
						<th style="text-align:center">Conta</th>
						<th style="text-align:center">Parcela</th>
						<th style="text-align:center">Valor Pago</th>
						<th class="hidden-print" style="text-align:center">Editar</th>
					</tr></thead>';
			$nota_sql = mysql_query("SELECT notas_nf_venc.*, notas_nf_venc.id as id_venc, notas_nf_venc.data as data_venc, notas_nf.numero, notas_nf.obra, notas_nf.recebimento, notas_nf.empresa, notas_nf.id as id_nota_c, notas_nf.tipo_nota FROM notas_nf_venc INNER JOIN notas_nf ON notas_nf_venc.nota = notas_nf.id WHERE (notas_nf_venc.data_pagamento BETWEEN '$inicial' and '$final') AND notas_nf.tipo_nota IN($tiu) AND notas_nf_venc.conta IN($equ) AND notas_nf.empresa IN($empa) AND notas_nf.obra IN($oba) ORDER BY notas_nf_venc.data_pagamento ASC");
			echo '<tbody>';
			while($l = mysql_fetch_array($nota_sql)) { extract($l);	
				$conta_nome = explode("_",mysql_result(mysql_query("select * from equipes where id = '$conta'"),0,"nome"));
				$cidade_nt = mysql_result(mysql_query("SELECT cidade FROM notas_obras WHERE id = '$obra'"),0,"cidade");
				echo '<tr>';	
				echo '<td width="5%" data-value="'.$data_pagamento.'" style="text-align:center"><span class="text-info"><b>'.implode("/",array_reverse(explode("-",$data_pagamento))).'</b></span></td>';
				echo '<td width="10%" style="text-align:center">'.mysql_result(mysql_query("select * from notas_obras where id = '$obra'"),0,"descricao").'</td>';
				if($tipo_nota == '0'){
					echo '<td width="30%">PAGTO '.@mysql_result(mysql_query("select * from empresa_cadastro where id = '$empresa'"),0,"razao_social").'</td>';
				}else if($tipo_nota == '1'){
					echo '<td width="30%">RECEBIMENTO '.@mysql_result(mysql_query("select * from empresa_cadastro where id = '$empresa'"),0,"razao_social").'</td>';
				}else if($tipo_nota == '2'){
					echo '<td width="30%">VENDA '.@mysql_result(mysql_query("select * from empresa_cadastro where id = '$empresa'"),0,"razao_social").'</td>';
				}
				
				echo '<td width="5%" style="text-align:center">'.$obs.'</td>';
				echo '<td width="5%" style="text-align:center">'.$numero.'</td>';
				echo '<td width="8%"  style="text-align:center">'.($conta <> 0 ? $conta_nome[1] : 'A PAGAR').'</td>';
				
				echo '<td width="5%" style="text-align:center"><b>'.$parcela.'</b> / '.mysql_num_rows(mysql_query("SELECT * FROM notas_nf_venc WHERE nota = '$id_nota_c'")).'</td>';
				
				echo '<td class="money" width="8%" data-value="'.$valor_pagamento.'" >';
				if($tipo_nota == '0'){
					echo '<b class="text-danger">- R$ '.number_format($valor_pagamento,2,",",".").'</b>';
					$total_geral_pago += $valor_pagamento;	
				}else if($tipo_nota == '1'){
					echo '<b class="text-success">R$ '.number_format($valor_pagamento,2,",",".").'</b>';				
					$total_geral_recebido += $valor_pagamento;		
				}else if($tipo_nota == '2'){
					echo '<b class="text-success">R$ '.number_format($valor_pagamento,2,",",".").'</b>';				
					$total_geral_recebido += $valor_pagamento;	
				}
				echo '</td>';
				echo '<td  width="5%" class="hidden-print" style="text-align:center"> <a href="#" onclick=\'$(".modal-body").load("financeiro/editar-vencimento.php?id_venc='.$id_venc.'&cidade_nt='.$cidade_nt.'")\' data-toggle="modal" data-target="#myModal"  class="btn btn-info btn-xs" style="margin:0px; padding:5px; font-size:9px;"><span class="glyphicon glyphicon-edit"></span></a></td>';	
				echo '</tr>';
			}
			/* ---------------- SAIDA --------------- */
			$transf_sql = mysql_query("SELECT * FROM conta_operacoes WHERE (data_operacao BETWEEN '$inicial' and '$final') AND conta_saida IN($equ) AND obra IN($oba)");
			while($k = mysql_fetch_array($transf_sql)) {
				if($k['conta_entrada'] == '0'){
					$conta_nome_e = 'TED';
				}else{
					$conta_nome_e = explode("_",mysql_result(mysql_query("select * from equipes where id = '$k[conta_entrada]'"),0,"nome"));
					$conta_nome_e = $conta_nome_e[1];
				}
				echo '<tr>';	
				echo '<td width="5%" data-value="'.$k['data_operacao'].'" style="text-align:center"><span class="text-info"><b>'.implode("/",array_reverse(explode("-",$k['data_operacao']))).'</b></span></td>';
				echo '<td width="8%" style="text-align:center">'.mysql_result(mysql_query("select * from notas_obras where id = '$k[obra]'"),0,"descricao").'</td>';
				echo '<td width="30%">TRANSFERENCIA '.$conta_nome_e.' </td>';
				echo '<td width="5%" style="text-align:center"> - </td>';
				echo '<td width="10%" style="text-align:center"> 0000 </td>';
				echo '<td width="8%"  style="text-align:center">'.$conta_nome[1].'</td>';
				echo '<td width="5%" style="text-align:center"> - </td>';	
				echo '<td class="money" width="8%" data-value="'.$k['valor_operacao'].'" >';
				echo '<b class="text-danger">- R$ '.number_format($k['valor_operacao'],2,",",".").'</b>';
				$total_geral_pago += $k['valor_operacao'];	
				echo '</td>';
				echo '<td class="hidden-print" width="5%" style="text-align:center"> - </td>';
				echo '</tr>';
			}
			
			/* ----------- ENTRADAS ------------ */
			$transf_sql2 = mysql_query("SELECT * FROM conta_operacoes WHERE (data_operacao BETWEEN '$inicial' and '$final') AND conta_entrada IN($equ) AND obra IN($oba)");
			while($k2 = mysql_fetch_array($transf_sql2)) {
				if($k2['conta_saida'] == '0'){
					$conta_nome_s = 'TED';
				}else{
					$conta_nome_s = explode("_",mysql_result(mysql_query("select * from equipes where id = '$k2[conta_saida]'"),0,"nome"));
					$conta_nome_s = $conta_nome_s[1];
				}
					
				echo '<tr>';	
				echo '<td width="5%" data-value="'.$k2['data_operacao'].'" style="text-align:center"><span class="text-info"><b>'.implode("/",array_reverse(explode("-",$k2['data_operacao']))).'</b></span></td>';
				echo '<td width="8%" style="text-align:center">'.mysql_result(mysql_query("select * from notas_obras where id = '$k2[obra]'"),0,"descricao").'</td>';
				echo '<td width="30%">TRANSFERENCIA '.$conta_nome_s.' </td>';
				echo '<td width="5%" style="text-align:center"> - </td>';
				echo '<td width="10%" style="text-align:center"> 0000 </td>';
				echo '<td width="8%"  style="text-align:center">'.$conta_nome[1].'</td>';
				echo '<td width="10%" style="text-align:center"> - </td>';	
				echo '<td class="money" width="8%" data-value="'.$k2['valor_operacao'].'" >';
				echo '<b class="text-success">R$ '.number_format($k2['valor_operacao'],2,",",".").'</b>';				
					$total_geral_recebido += $k2['valor_operacao'];	
				echo '</td>';
				echo '<td  width="5%" class="hidden-print" style="text-align:center"> - </td>';
				echo '</tr>';
			}
			/* ----------- ENTRADAS TAXAS E JUROS------------ */
			$taxas_sql = mysql_query("SELECT * FROM conta_taxas WHERE (data_operacao BETWEEN '$inicial' and '$final') AND conta IN($equ) AND obra IN($oba)");
			while($k3 = mysql_fetch_array($taxas_sql)) {
				$conta_nome_s11 = explode("_",mysql_result(mysql_query("select * from equipes where id = '$k3[conta]'"),0,"nome"));
				$conta_nome_s11 = $conta_nome_s11[1];
					
				echo '<tr>';	
				echo '<td width="5%" data-value="'.$k3['data_operacao'].'" style="text-align:center"><span class="text-info"><b>'.implode("/",array_reverse(explode("-",$k3['data_operacao']))).'</b></span></td>';
				echo '<td width="8%" style="text-align:center">'.mysql_result(mysql_query("select * from notas_obras where id = '$k3[obra]'"),0,"descricao").'</td>';
				echo '<td width="30%">TAXAS E JUROS '.$conta_nome_s11.' </td>';
				echo '<td width="5%" style="text-align:center"> - </td>';
				echo '<td width="10%" style="text-align:center"> 0000 </td>';
				echo '<td width="8%"  style="text-align:center">'.$conta_nome[1].'</td>';
				echo '<td width="10%" style="text-align:center"> - </td>';	
				echo '<td class="money" width="8%" data-value="'.$k3['valor'].'" >';
				echo '<b class="text-danger"> - R$ '.number_format($k3['valor'],2,",",".").'</b>';				
					$total_geral_recebido_taxas += $k3['valor'];	
				echo '</td>';
				echo '<td  width="5%" class="hidden-print" style="text-align:center"> - </td>';
				echo '</tr>';
			}
			
			$total_geral_venc = $total_geral_recebido - $total_geral_pago - $total_geral_recebido_taxas;	
			echo '</tbody>';
			echo '<tfoot style="display: table-row-group; font-size:13px; font-weight:bold; background:#f3f3f3;">';
			echo '<tr>
			<td colspan="5" rowspan="3" style="background:#f3f3f3; border:1px solid #f3f3f3">
					<br/>
					'.$nome_empresa_ex.'<br/><br/>
					*<span style="font-weight:normal !important">Período de '.implode("/",array_reverse(explode("-",$inicial))).' á '.implode("/",array_reverse(explode("-",$final))).'</span><br/>
			</td>
			
			<td colspan="2" align="right" style="background:#f3f3f3; border:1px solid #f3f3f3"><span class="text-success">Total Entradas:</span></td><td align="right" colspan="1" style="background:#f3f3f3; border:1px solid #f3f3f3"><span class="text-success">R$&nbsp;&nbsp;&nbsp;'.number_format($total_geral_recebido,2,",",".").'</span></td><td class="hidden-print" align="right" style="background:#f3f3f3; border:1px solid #f3f3f3"></td></tr>';

			echo '<tr><td colspan="2" align="right" style="background:#f3f3f3; border:1px solid #f3f3f3"><span class="text-danger">Total Saidas:</span></td><td align="right" colspan="1" style="background:#f3f3f3; border:1px solid #f3f3f3"><span class="text-danger">R$&nbsp;&nbsp;&nbsp;'.number_format($total_geral_pago + $total_geral_recebido_taxas,2,",",".").'</span></td><td class="hidden-print" align="right" style="background:#f3f3f3; border:1px solid #f3f3f3"></td></tr>';

			echo '<tr><td colspan="2" align="right" style="background:#f3f3f3; border:1px solid #f3f3f3">';
				
			if($total_geral_venc <= 0){
				echo '<span class="text-danger">Saldo Previsto: <span>';
			}else{
				echo '<span class="text-success">Saldo Previsto: </span>';
			}
			echo '</td><td align="right" colspan="1" style="background:#f3f3f3; border:1px solid #f3f3f3">';
			if($total_geral_venc <= 0){
				echo '<span class="text-danger">R$: '.number_format($total_geral_venc,2,",",".").'</span>';
			}else{
				echo '<span class="text-success">R$: '.number_format($total_geral_venc,2,",",".").'</span>';
			}
			echo '</td><td class="hidden-print" align="right" style="background:#f3f3f3; border:1px solid #f3f3f3"></td></tr>';
			
			echo '</tfoot></table>';
			echo '<div class="container-fluid panel hidden-print" style="padding:10px">';
				$bancos_sql = mysql_query("SELECT * FROM equipes WHERE obra IN($ciu) AND status = '0' AND relatorio = '1' order by nome asc LIMIT 4");
				while($banco = mysql_fetch_array($bancos_sql)){
					$se_conta += 1;
					echo '<div class="col-xs-3" style="border-right:1px solid #CCC">';
						echo '<div class="col-xs-5" style="padding:0px">';
							if($banco['imagem'] == ''){
								echo '<i class="fa fa-image"></i>';
							}else{
								echo '<img src="../imagens/bancos/'.$banco['imagem'].'" alt="'.$banco['nome_exibir'].' class="img-responsive" width="100px"/>';
							}
						echo '</div>';
						echo '<div class="col-xs-7">';
							$valor_total_entradat = mysql_result(mysql_query("SELECT SUM(valor_operacao) as valorg FROM conta_operacoes WHERE (data_operacao BETWEEN '2019-04-01' AND '$todayTotal') AND conta_entrada = '$banco[id]' AND obra IN($oba)"),0,"valorg");
							
							$valor_total_saidat = mysql_result(mysql_query("SELECT SUM(valor_operacao) as valorg FROM conta_operacoes WHERE (data_operacao BETWEEN '2019-04-01' AND '$todayTotal') AND conta_saida = '$banco[id]' AND obra IN($oba)"),0,"valorg");
							
							$valor_total_taxas = mysql_result(mysql_query("SELECT SUM(valor) as valorg FROM conta_taxas WHERE (data_operacao BETWEEN '2019-04-01' AND '$todayTotal') AND conta = '$banco[id]' AND obra IN($oba)"),0,"valorg");
							
							$valor_total_pago = mysql_result(mysql_query("SELECT SUM(notas_nf_venc.valor_pagamento) AS valor_pago FROM notas_nf_venc INNER JOIN notas_nf ON notas_nf_venc.nota = notas_nf.id WHERE notas_nf.tipo_nota IN(0) AND (notas_nf_venc.data_pagamento BETWEEN '2019-04-01' AND '$todayTotal') and notas_nf_venc.conta = '".$banco['id']."' AND notas_nf.obra IN($oba) ORDER BY notas_nf_venc.data ASC"),0,"valor_pago");
							
							$valor_total_recebido = mysql_result(mysql_query("SELECT SUM(notas_nf_venc.valor_pagamento) AS valor_recebido FROM notas_nf_venc INNER JOIN notas_nf ON notas_nf_venc.nota = notas_nf.id WHERE notas_nf.tipo_nota IN(1) AND (notas_nf_venc.data_pagamento BETWEEN '2019-04-01' AND '$todayTotal') and notas_nf_venc.conta = '".$banco['id']."' AND notas_nf.obra IN($oba) ORDER BY notas_nf_venc.data ASC"),0,"valor_recebido");
							$total_saidas_g = $valor_total_saidat + $valor_total_pago + $valor_total_taxas;
							$total_entradas_g = $valor_total_entradat + $valor_total_recebido;
							$valor_total_conta = $total_entradas_g - $total_saidas_g;
							if($valor_total_conta <= 0){
								echo '<span class="text-danger" style="font-family: \'Oswald\', sans-serif; letter-spacing:3px; font-weight: bold; font-size:14px;">';
							}else{
								echo '<span class="text-success">';
							}
							echo 'R$:&nbsp;&nbsp;'. number_format($valor_total_conta,2,",",".");
							echo '</span>';
						echo '</div>';
					echo '</div>';
				}
				switch($se_conta){
					case 1:
						echo '<div class="col-xs-3">&nbsp;</div><div class="col-xs-3">&nbsp;</div><div class="col-xs-3">&nbsp;</div>';
						break;
					case 2:
						echo '<div class="col-xs-3">&nbsp;</div><div class="col-xs-3">&nbsp;</div>';
						break;
					case 3:
						echo '<div class="col-xs-3">&nbsp;</div>';
						break;
					case 4:
						break;
					default:
						break;
				}	
			echo '</div>';
			exit;		
		}
	exit;
}
?>
	<div class="panel panel-default" style="width:100%; border:none;">
		<h4 class="title-box hidden-print"> <i class="fa fa-money" aria-hidden="true"></i> Saldo & Extrato
			<a href="javascript:window.print()" style="letter-spacing:1.5px; padding-left:20px; padding-right:20px; font-size:10px;" class="hidden-xs hidden-print pull-right btn btn-warning btn-xs"> <span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Imprimir</a>
		</h4>
		<div class="panel-body" style="background:#FFF;">	
			<form action="javascript:void(0)" onSubmit="posti(this,'financeiro/relatorio-extrato.php?ac=listar','.resultado');" class="form-inline hidden-print">
				<div class="container-fluid" style="padding:0px">
					<div class="col-xs-6" style="padding:2px">
						<div class="col-xs-4" style="padding:2px">
							<label style="width:100%"><small>Empresa:</small><br/>
								<select name="ci[]" onChange="$('#item-consulta-obra').load('../functions/functions-load.php?atu=equipe2&cidade=' + $(this).val() + '');" class="sel form-control input-sm" required> 
									<option value="">Selecione uma empresa</option>
									<?php
										$cidade = mysql_query("select * from notas_obras_cidade WHERE id IN(0,$cidade_usuario) order by nome asc");
										while($l = mysql_fetch_array($cidade)) {
											echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>';
										}
									?>	
								</select>
							</label>
						</div>
						<div id="item-consulta-obra">
							<div class="col-xs-4" style="padding:2px">
								<label style="width:100%"><small>Filial:</small><br/>
								<select name="ob[]" class="sel" multiple="multiple" required>
									<option value="">Selecione uma empresa</option>
								</select>
								</label>
							</div>
							<div class="col-xs-4" style="padding:2px">
								<label style="width:100%">
								<small>Contas:</small>
								<select name="eq[]" class="sel" multiple="multiple" required>
									<?php
									$encarregados = mysql_query("select * from equipes WHERE obra IN(0,$cidade_usuario) order by nome asc");
									while($x = mysql_fetch_array($encarregados)) {
										echo '<option value="'.$x['id'].'" selected>'.$x['nome'].'</option>';
									}
									?>		
								</select>
								</label>
							</div>

						</div>
					</div>
					<div class="col-xs-2" style="padding:2px">
						<label style="width:100%"><small>Tipo:</small>
							<select name="relatorio" class="form-control input-sm disabled" style="width:100%" required>
								<option value="3">EXTRATO SIMPLES</option>
								<option value="1">RELATORIO DESPESAS</option>
								<option value="2">TESTE</option>
							</select>
						</label>
					</div>
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
								<select name="ti[]" class="sel" multiple="multiple" required>
									<option value="0" selected>NOTA FISCAL - DESPESAS</option>
									<option value="1" selected>LOCAÇÃO</option>
									<option value="2" selected>VENDA</option>
									<option value="3" selected>SERVIÇO</option>
								</select>
							</label>
					</div>
				</div>
				<div class="container-fluid" style="padding:0px">
					<div class="col-xs-4" style="padding:0px">
						<div class="col-xs-6" style="padding:2px">
							<label style="width:100%"><small>De:</small><br/>
								<input type="date" name="inicial" value="<?php echo $inicioMes; ?>" class="form-control input-sm" style="width:100%" required />
							</label>
						</div>
						<div class="col-xs-6" style="padding:2px">
							<label style="width:100%"><small>ate:</small><br/>
								<input type="date" name="final" value="<?php echo $todayTotal; ?>" class="form-control input-sm" style="width:100%" required />
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
			<div class="resultado"></div>
		</div>
	</div>

	<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="height:auto;">
		<div class="modal-dialog" style="width:80%;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" style="color:#C9302C; opacity:1; "  onclick="$('.modal').modal('hide')" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel" style="font-family: \'Oswald\', sans-serif; letter-spacing:5px;">Editar Parcela</h4>
				</div>
				<div class="modal-body">
					Aguarde um momento &nbsp;&nbsp; <img src="../../imagens/loading.gif" alt="Carregando" width="20px"/>
				</div>
			</div>
		</div>
	</div>
