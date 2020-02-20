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
						RELATORIO NOTA FISCAL - A PAGAR
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
						<th style="text-align:center">Vencimento</th>
						<th style="text-align:center">Valor</th>
						<th style="text-align:center">Previsão</th>
						<th style="text-align:center">Valor Pago</th>
						<th style="text-align:center">Parcela</th>
						<th style="text-align:center">Editar</th>
					</tr></thead>';
			$nota_sql = mysql_query("SELECT notas_nf_venc.*, notas_nf_venc.id as id_venc, notas_nf_venc.data as data_venc, notas_nf.numero, notas_nf.obra, notas_nf.recebimento, notas_nf.empresa, notas_nf.id as id_nota_c, notas_nf.tipo_nota FROM notas_nf_venc INNER JOIN notas_nf ON notas_nf_venc.nota = notas_nf.id WHERE (notas_nf_venc.data_pagamento BETWEEN '$inicial' and '$final') AND notas_nf.tipo_nota IN(0) AND notas_nf_venc.conta IN(0) AND notas_nf.empresa IN($empa) AND notas_nf.obra IN($oba) ORDER BY notas_nf_venc.data ASC");		
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
				echo '<td class="money" width="8%" data-value="'.$valor.'" ><b>- R$ '.number_format($valor,2,",",".").'</b></td>';
				echo '<td width="10%" data-value="'.$data_pagamento.'" style="text-align:center"><span class="text-info"><b>'.implode("/",array_reverse(explode("-",$data_pagamento))).'</b></span></td>';
				echo '<td class="money" width="8%" data-value="'.$valor_pagamento.'" ><b>- R$ '.number_format($valor_pagamento,2,",",".").'</b></td>';
				echo '<td width="10%" style="text-align:center"><b>'.$parcela.'</b> / '.mysql_num_rows(mysql_query("SELECT * FROM notas_nf_venc WHERE nota = '$id_nota_c'")).'</td>';
				echo '<td  width="5%" style="text-align:center"> <a href="#" onclick=\'$(".modal-body").load("financeiro/editar-vencimento.php?id_venc='.$id_venc.'&cidade_nt='.$cidade_nt.'")\' data-toggle="modal" data-target="#myModal"  class="btn btn-info btn-xs" style="margin:0px; padding:5px; font-size:9px;"><span class="glyphicon glyphicon-edit"></span></a></td>';	
				$total_geral_venc += $valor;				
				$total_geral_previsao += $valor_pagamento;								
							
			}
			echo '<tbody></table>';
			echo '<div class="container-fluid">
				<h1 class="pull-right" style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:right">
					Total Vencimento <small> R$ '.number_format($total_geral_venc,2,",",".").'</small><br/>
					Total Pago <small> R$ '.number_format($total_geral_previsao,2,",",".").'</small>
				</h1>
				
				</div>';			
			exit;		
		}
		// FORNECEDOR
		if($relatorio == 2) {
			foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1); //OBRA
			foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1); //CONTA
			//foreach($et as $ets) { @$eta .= $ets.','; } $eta = substr($eta,0,-1); //CATEGORIA
			//foreach($sub as $suba) { @$subs .= $suba.','; } $subs = substr($subs,0,-1); //SUB-CATEGORIA
			foreach($ci as $cis) { @$ciu .= $cis.','; } $ciu = substr($ciu,0,-1); //CIDADE
			foreach($ti as $tis) { @$tiu .= $tis.','; } $tiu = substr($tiu,0,-1); //Tipo
			foreach($emp as $emps) { @$empa .= $emps.','; } $empa = substr($empa,0,-1); //EMPRESA
			
			topoPrint();
			$ano = explode("-",$final);
			echo '
				<p>
					<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
						RELATORIO NOTA FISCAL - FORNECEDOR
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
				$forn_sql = mysql_query("select * from empresa_cadastro where id IN($empa)");		
				while($c = mysql_fetch_array($forn_sql)) { 
					$eqpcount = @mysql_num_rows(mysql_query("SELECT notas_nf_venc.*, notas_nf_venc.data as data_venc, notas_nf.numero, notas_nf.obra, notas_nf.recebimento, notas_nf.empresa FROM notas_nf_venc INNER JOIN notas_nf ON notas_nf_venc.nota = notas_nf.id WHERE (notas_nf_venc.data BETWEEN '$inicial' and '$final') AND notas_nf.tipo_nota IN($tiu) AND notas_nf.obra IN($oba) and notas_nf_venc.conta IN($equ) AND notas_nf.empresa = '".$c['id']."'"));
					if($eqpcount != 0){
						echo '<tr class="info" style="height:30px"><th colspan="9">Fornecedor: '.$c['razao_social'].'</th></tr>';
						echo '<tr>
								<th>N</th>
								<th>Nota</th>
								<th style="text-align:center">Emissão</th>
								<th>Obra</th>
								<th>Empresa</th>
								<th style="text-align:center">Conta</th>
								<th style="text-align:center">Vencimento</th>
								<th style="text-align:center">Valor</th>
								<th style="text-align:center"><span class="glyphicon glyphicon-edit"></span></th>
							</tr>';
						$nota_sql = mysql_query("SELECT notas_nf_venc.*, notas_nf_venc.data as data_venc, notas_nf.numero, notas_nf.obra, notas_nf.recebimento, notas_nf.empresa FROM notas_nf_venc INNER JOIN notas_nf ON notas_nf_venc.nota = notas_nf.id WHERE (notas_nf_venc.data BETWEEN '$inicial' and '$final') AND notas_nf_venc.conta IN($equ) AND notas_nf.empresa = '".$c['id']."'");
						$se = 0; $se2 = 0;
						while($l = mysql_fetch_array($nota_sql)) { extract($l);	
							$se1 += 1; // TOTAL NOTAS
							$se2 += 1;
							echo '<tr>';	
								echo '<td width="3%">'.$se2.'</td>';
								echo '<td width="10%">'.$numero.'</td>';
								echo '<td width="10%" data-value="'.$recebimento.'" style="text-align:center">'.implode("/",array_reverse(explode("-",$recebimento))).'</td>';
								echo '<td width="8%">'.mysql_result(mysql_query("select * from notas_obras where id = '$obra'"),0,"descricao").'</td>';
								echo '<td width="30%">'.@mysql_result(mysql_query("select * from empresa_cadastro where id = '$empresa'"),0,"razao_social").'</td>';
								echo '<td width="8%"  style="text-align:center">'.@mysql_result(mysql_query("select * from equipes where id = '$conta'"),0,"nome").'</td>';
								echo '<td width="10%" data-value="'.$data_venc.'" style="text-align:center"><span class="text-danger"><b>'.implode("/",array_reverse(explode("-",$data_venc))).'</b></span></td>';
								echo '<td class="money" width="8%" data-value="'.$valor.'" ><div class="currencySymbol">R$</div>'.number_format($valor,2,",",".").'</td>';
								echo '<td  width="5%"> editar </td>';				
								$total_geral_venc += $valor;				
						}		
					}
				}
				echo '</table>';
				echo '<div class="page-header">
				<h1 class="pull-right" style="font-family: \'Oswald\', sans-serif; letter-spacing:5px;">Total Vencimento <small> R$ '.number_format($total_geral_venc,2,",",".").'</small></h1>
				<h1 class="pull-right" style="font-family: \'Oswald\', sans-serif; letter-spacing:5px;">Total Pago <small> R$ '.number_format($total_geral_previsao,2,",",".").'</small></h1>
				</div>';	
				exit;	
		}
		
		// SALDO FIXO
		if($relatorio == 3) {
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
						RELATORIO NOTA FISCAL - SALDO FIXO
					</h3>
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
						
						<th style="text-align:center">Parcela</th>
						<th style="text-align:center">Data Pago</th>
						<th style="text-align:center">Valor Pago</th>
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
				
				echo '<td width="10%" style="text-align:center"><b>'.$parcela.'</b> / '.mysql_num_rows(mysql_query("SELECT * FROM notas_nf_venc WHERE nota = '$id_nota_c'")).'</td>';
				echo '<td width="10%" data-value="'.$data_pagamento.'" style="text-align:center"><span class="text-info"><b>'.implode("/",array_reverse(explode("-",$data_pagamento))).'</b></span></td>';
				echo '<td class="money" width="8%" data-value="'.$valor_pagamento.'" >';
				if($tipo_nota == '0'){
					echo '<b class="text-danger">- R$ '.number_format($valor_pagamento,2,",",".").'</b>';
					$total_geral_pago += $valor_pagamento;	
				}else if($tipo_nota == '1'){
					echo '<b class="text-success">R$ '.number_format($valor_pagamento,2,",",".").'</b>';				
					$total_geral_recebido += $valor_pagamento;		
				}
				echo '</td>';
				echo '<td  width="5%" style="text-align:center"> <a href="#" onclick=\'$(".modal-body").load("financeiro/editar-vencimento.php?id_venc='.$id_venc.'&cidade_nt='.$cidade_nt.'")\' data-toggle="modal" data-target="#myModal"  class="btn btn-info btn-xs" style="margin:0px; padding:5px; font-size:9px;"><span class="glyphicon glyphicon-edit"></span></a></td>';		
			}
			$total_geral_venc = $total_geral_recebido - $total_geral_pago;	
			$nome_empresa_ex = mysql_result(mysql_query(
			"SELECT * FROM notas_obras_cidade WHERE id = '$ciu'"),0,"nome_exibir");
			echo '<tbody>';
			echo '<tfoot style="font-size:13px; font-weight:bold; background:#f3f3f3;">';
			echo '<tr>
			<td colspan="4" rowspan="3" style="background:#f3f3f3; border:1px solid #f3f3f3">
					<br/>
					'.$nome_empresa_ex.'<br/><br/>
					*<span style="font-weight:normal !important">Período de '.implode("/",array_reverse(explode("-",$inicial))).' á '.implode("/",array_reverse(explode("-",$final))).'</span><br/>
					
			</td>
			
			<td colspan="3" align="right" style="background:#f3f3f3; border:1px solid #f3f3f3"><span class="text-success">Total Entradas:</span></td><td align="right" colspan="1" style="background:#f3f3f3; border:1px solid #f3f3f3"><span class="text-success">R$&nbsp;&nbsp;&nbsp;'.number_format($total_geral_recebido,2,",",".").'</span></td><td align="right" style="background:#f3f3f3; border:1px solid #f3f3f3"></td></tr>';

			echo '<tr><td colspan="3" align="right" style="background:#f3f3f3; border:1px solid #f3f3f3"><span class="text-danger">Total Saidas:</span></td><td align="right" colspan="1" style="background:#f3f3f3; border:1px solid #f3f3f3"><span class="text-danger">R$&nbsp;&nbsp;&nbsp;'.number_format($total_geral_pago,2,",",".").'</span></td><td align="right" style="background:#f3f3f3; border:1px solid #f3f3f3"></td></tr>';

			echo '<tr><td colspan="3" align="right" style="background:#f3f3f3; border:1px solid #f3f3f3">';
				
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
			echo '</td><td align="right" style="background:#f3f3f3; border:1px solid #f3f3f3"></td></tr>';
			
			echo '</tfoot></table>';
			echo '<div class="container-fluid panel" style="padding:10px">';
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
							$valor_total_pago = mysql_result(mysql_query("SELECT SUM(notas_nf_venc.valor_pagamento) AS valor_pago FROM notas_nf_venc INNER JOIN notas_nf ON notas_nf_venc.nota = notas_nf.id WHERE notas_nf.tipo_nota IN(0) AND (notas_nf_venc.data_pagamento BETWEEN '2019-04-01' AND '$todayTotal') and notas_nf_venc.conta = '".$banco['id']."' AND notas_nf.obra IN($oba) ORDER BY notas_nf_venc.data ASC"),0,"valor_pago");
							
							$valor_total_recebido = mysql_result(mysql_query("SELECT SUM(notas_nf_venc.valor_pagamento) AS valor_recebido FROM notas_nf_venc INNER JOIN notas_nf ON notas_nf_venc.nota = notas_nf.id WHERE notas_nf.tipo_nota IN(1) AND (notas_nf_venc.data_pagamento BETWEEN '2019-04-01' AND '$todayTotal') and notas_nf_venc.conta = '".$banco['id']."' AND notas_nf.obra IN($oba) ORDER BY notas_nf_venc.data ASC"),0,"valor_recebido");
							$valor_total_conta = $valor_total_recebido - $valor_total_pago;
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
	<div class="container-fluid hidden-print" style="padding:0px 0px 15px 0px; margin-bottom:20px; border-bottom:1px solid #CCC">
		<h3 style="font-family: 'Oswald', sans-serif; letter-spacing:5px;"> 
			RELATÓRIO <small><b>CONTROLE DE GASTOS</b></small>
			<a href="javascript:window.print()" style="letter-spacing:8px; padding-left:40px; padding-right:40px;" class="hidden-xs hidden-print pull-right btn btn-warning btn-sm"> <span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Imprimir</a>
		</h3>
	</div>
	<div class="well well-sm hidden-print" style="padding:10px 10px 5px 10px;">
		<form action="javascript:void(0)" onSubmit="posti(this,'financeiro/relatorio-funcionarios.php?ac=listar','.resultado');" class="form-inline">
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
							<option value="1">A PAGAR</option>
							<option value="3">SALDO SIMPLES</option>
							<option value="2">FORNECEDOR</option>
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
	</div>
<div class="resultado"></div>

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
