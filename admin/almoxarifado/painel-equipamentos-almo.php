<?php
	include("../config.php");
	include("../validar_session.php");
	include("../../functions/function-print.php");
	getData();
	getNivel();
?>

<script type="text/javascript">
$(document).ready(function(){
	// ----------- SORTING MONEY ------------- //
	jQuery.tablesorter.addParser({
		id: "monetaryValue",
		is: function (s) {
			return false;
		}, format: function (s) {
			var n = parseFloat( s.replace('R$','').replace(/,/g,'') );
			return isNaN(n) ? s : n;
		}, type: "numeric"
	});
	// ---------
	$("#resultadoTabela").tablesorter({
		dateFormat : "ddmmyyyy",
		headers: {
			10 : { sorter: "monetaryValue" }
		},
		sortList: [[1,1]]
	});
	$("table").tablesorter({
		dateFormat : "ddmmyyyy"
	});
	//DataTable
	
	$.fn.dataTable.ext.errMode = 'none';
    $('#resultadoTabela').DataTable({
		"paging": true,
		"pageLength": 50,
		"lengthChange": false,
		"searching": true,
		"ordering": true,
		"info": false,
		"bAutoWidth": false
		
    });
	
	//Multi Select
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
});
</script>
<?php
if($mesSelect == 1){
	echo $mes;
	exit;
}
?>

<script type="text/javascript">
$(document).ready(function(){
	$("table").tablesorter();
});
</script>
<style>
	@media print
	{
		table, tr, thead, tbody, td, th{
			border:1px solid #000 !important;
		}
	}
</style>
<?php
if($data_form=='2'){
	if($situacao == '9' || $situacao == '10'){
?>
				<div class="col-xs-8" style="padding:0px">
					<div class="col-xs-6" style="padding:2px">
						<label style="width:100%"><small>Periodo:</small><br/>
							<input type="date" name="inicial" value="<?php echo $inicioMes; ?>" class="form-control input-sm" style="width:100%" />
						</label>
					</div>
					<div class="col-xs-6" style="padding:2px">
						<label style="width:100%"><small>até:</small><br/>
							<input type="date" name="final" value="<?php echo $todayTotal; ?>" class="form-control input-sm" style="width:100%" />
						</label>
					</div>
				</div>
				<div class="col-xs-4" style="padding:2px">
					<label style="width:100%"><small>Situação (RH):</small>
						<select name="sirh[]" class="sel" multiple="multiple">
						<?php
							$stsrh = mysql_query("select * from rh_situacao order by descricao asc");
							while($l = mysql_fetch_array($stsrh)) { extract($l);
								echo '<option value="'.$id.'" selected>'.$descricao.'</option>';
							}
						?>
						</select>
					</label>
				</div>
<?php	
}else if($situacao == '8'){
?>
					<div class="col-xs-3" style="padding:2px">
						<label style="width:100%"><small>Periodo:</small><br/>
							<input type="date" name="inicial" value="<?php echo $inicioMes; ?>" class="form-control input-sm" style="width:100%" />
						</label>
					</div>
					<div class="col-xs-3" style="padding:2px">
						<label style="width:100%"><small></small><br/>
							<input type="date" name="final" value="<?php echo $todayTotal; ?>" class="form-control input-sm" style="width:100%" />
						</label>
					</div>
					<div class="col-xs-3" style="padding:2px">
						<label style="width:100%"><small>Emissão:</small><br/>
							<input type="date" name="emissao" class="form-control input-sm" style="width:100%" />
						</label>
					</div>
					<div class="col-xs-3" style="padding:2px">
						<label style="width:100%"><small>Vencimento:</small><br/>
							<input type="date" name="vencimento" class="form-control input-sm" style="width:100%" />
						</label>
					</div>
<?php
}
exit; 
}
	if($ac=='lerobs'){
		echo mysql_result(mysql_query("select obs from notas_equipamentos where id = $id_correto"),0,"obs");
		exit;
	}
	if(@$ac=='salvar-painel') {
		$sql = mysql_query("update notas_equipamentos set pago = '0' where id = '$id'");
		if($sql) { 
			echo '<a href="#" title="Painel 1" class="btn btn-danger btn-xs hidden-print" style="width:100%;"  onClick=\'ldy("almoxarifado/painel-equipamentos-almo.php?ac=salvar-painel2&id='.$id.'","#val'.$id.'")\'> <b><i class="fa fa-pinterest-p" aria-hidden="true"></i></b> </a>';
			
			echo '<span class="hidden-xs hidden-md hidden-lg visible-print"> DEVIDO </span>';
			
			echo "<script> $('html, body').animate({ scrollTop: $('#val".$id."').offset().top -200}, 'fast'); </script>";
		}else{ 
			echo '<script>window.alert("'.mysql_error().'");</script>';
		}
		exit;
	}
	if(@$ac=='salvar-painel2') {
		$sql = mysql_query("UPDATE notas_equipamentos SET pago = '1' WHERE id = '$id'");
		if($sql) { 
			echo '<a href="#" title="Painel 0" class="btn btn-success btn-xs hidden-print" style="width:100%; padding:0px 3px 0px 3px"  onclick=\'ldy("almoxarifado/painel-equipamentos-almo.php?ac=salvar-painel&id='.$id.'","#val'.$id.'")\'><b><i class="fa fa-pinterest-p" aria-hidden="true"></i></b></a>';
			
			echo '<span class="hidden-xs hidden-md hidden-lg visible-print"> PAGO </span>';
			echo "<script> $('html, body').animate({ scrollTop: $('#val".$id."').offset().top -200}, 'fast'); </script>";
		}else{ 
			echo '<script>window.alert("'.mysql_error().'");</script>';
		}
		exit;
	}
	
	if(@$ac=='listar') {	
		//DETALHADO
		if($relatorio==5) {
			foreach($eq as $eqs)  { @$equ .= $eqs.',';   } $equ  = substr($equ,0,-1);
			foreach($sbca as $sbcas)  { @$sbcat .= $sbcas.',';   } $sbcat  = substr($sbcat,0,-1);
			foreach($si as $sis)  { @$sia .= $sis.',';   } $sia  = substr($sia,0,-1);
			foreach($cat as $cats){ @$cata .= $cats.','; } $cata = substr($cata,0,-1);
			foreach($ob as $obs)  { @$oba .= $obs.',';   } $oba  = substr($oba,0,-1);
			foreach($to as $tos)  { @$toa .= $tos.',';   } $toa  = substr($toa,0,-1);
			topoPrint();
			echo '
			<p>
				<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
					RELATÓRIO DE EQUIPAMENTOS - DETALHADO
				</h3>
				<p style="text-align:center;  font-size:14px;"><small>'.$data_view.'</small></p>
			</p>
			<p style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">';
				$obra_controle = mysql_query("SELECT * FROM notas_obras WHERE id IN($oba)");
				while($c = mysql_fetch_array($obra_controle)){
					echo $c['descricao'].'<br/>';
				}
				echo '</p>';
			
			$sql = mysql_query("SELECT * FROM notas_equipamentos WHERE notas_equipamentos.situacao in($sia) AND notas_equipamentos.categoria in($cata) AND notas_equipamentos.equipe IN($equ) AND notas_equipamentos.sub_categoria IN($sbcat) AND notas_equipamentos.obra IN($oba) AND status_2 IN($toa) ORDER BY notas_equipamentos.categoria ASC ") or die (mysql_error());
				
			while($l = mysql_fetch_array($sql)) { 
				extract($l); $dt = $l['emissao'];
				@$se = 1+@$it3++;			
				$soma_qtd_t = 0; $soma_qtd_p = 0;
				$emissao = implode("-",array_reverse(explode("/",$emissao))); 	
				$sql_total2 = $sql;
				$totals += intval($valor);
				
				echo '<table class="table table-striped table-condensed table-color small">';
				echo '
				<thead>
					<tr>
						<th style="text-align:center"><small>Placa:&nbsp;</small> '.$placa.'</th>
						<th style="text-align:center">'.@mysql_result(mysql_query("select * from notas_empresas where id = $empresa"),0,"nome").'</th>
						
						<th style="text-align:center"><small>Categoria: &nbsp;</small> '.@mysql_result(mysql_query("select * from notas_cat_e where id = $categoria"),0,"descricao").'</th>
						
						<th style="text-align:center"><small>Sub-Categoria: &nbsp; </small>'.@mysql_result(mysql_query("select * from notas_cat_sub where id = $sub_categoria"),0,"descricao").'</th>
						
					</tr>
				</thead><tbody>';
				echo '
					<tr>
						<td width="15%"><small><b>Marca:</b></small> '.$marca.'</td>
						<td width="35%"><small><b>Patrimonio:</b></small> '.$patrimonio.'</td>
						<td width="20%"><small><b>Obra:</b></small> '.@mysql_result(mysql_query("select * from notas_obras where id = $obra"),0,"descricao").'</td>
						<td width="20%"><small><b>Equipe:</b></small> '.@mysql_result(mysql_query("select * from equipes where id = $equipe"),0,"nome").'</td>
						
					</tr>';
				echo '
					<tr>
						<td><small><b>Desconto: </b></small>'.$desconto.'</td>
						<td><small><b>Valor: </b></small>'.$valor.'</td>
						<td><small><b>Situação: </b></small>'.@mysql_result(mysql_query("select descricao from notas_eq_situacao where id = '$situacao'"),0,"descricao").'</td>
						<td><small><b>Responsável: </b></small>'.@mysql_result(mysql_query("select * from rh_funcionarios where id = $local"),0,"nome").'</td>
					</tr>';
				echo '
					<tr>
						<td><small><b>Dia Pagamento: </b></small>'.$dia_pagamento.'</td>
						<td><small><b>Contrato: </b></small>'.$patrimonio2.'</td>
						<td><small><b>Status: </b></small>'.@mysql_result(mysql_query("select descricao from status_2 where id = '$status_2'"),0,"descricao").'</td>
						<td><small><b>Entrada: </b></small>'.implode("/",array_reverse(explode("-",$entrada))).' - <small><b>Saida: </b></small>'.implode("/",array_reverse(explode("-",$saida))).'</td>
					</tr>';
				echo '
					<tr>
						<td><small><b>Chassi / Nº série: </b></small>'.$chassi.'</td>
						<td><small><b>Ano: </b></small>'.$ano.'</td>
						<td colspan="2" style="text-align:center"><small>'.@mysql_result(mysql_query("select * from rh_contratos order by nome asc"),0,"nome").'</small></td>
					</tr>';
				@$soma_qtd_t += $qtd_t; 
				echo '</tbody></table><hr></hr>';
			}
			
			echo '
				<h3 class="pull-right">
					<tr>
						<td><span style="font-family: \'Oswald\', sans-serif; letter-spacing:5px;"><small>Total de Equipamentos: <b>'.mysql_num_rows($sql).'</b></small><br/>Total R$: <b>'.number_format($totals,"2",",",".").'</b></span></td>
					</tr>
				</h3>';
			exit;
		}
		//SIMPLES
		if($relatorio==6) {
			foreach($eq as $eqs)  { @$equ .= $eqs.',';   } $equ  = substr($equ,0,-1);
			foreach($sbca as $sbcas)  { @$sbcat .= $sbcas.',';   } $sbcat  = substr($sbcat,0,-1);
			foreach($si as $sis)  { @$sia .= $sis.',';   } $sia  = substr($sia,0,-1);
			foreach($cat as $cats){ @$cata .= $cats.','; } $cata = substr($cata,0,-1);
			foreach($ob as $obs)  { @$oba .= $obs.',';   } $oba  = substr($oba,0,-1);
			foreach($to as $tos)  { @$toa .= $tos.',';   } $toa  = substr($toa,0,-1);
			topoPrint();
			echo '
			<p>
				<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
					RELATÓRIO DE EQUIPAMENTOS - SIMPLES
				</h3>
				<p style="text-align:center;  font-size:14px;"><small>'.implode("/",array_reverse(explode("-",$todayTotal))).'</small></p>
			</p>
			<p style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">';
				$obra_controle = mysql_query("SELECT * FROM notas_obras WHERE id IN($oba)");
				while($c = mysql_fetch_array($obra_controle)){
					echo $c['descricao'].'<br/>';
				}
				echo '</p>';
		
			echo '<table id="resultadoTabela" class="table table-striped table-condensed table-color small" style="font-size:11px">';
			echo '<thead>
					<tr>
						<th><span class="glyphicon glyphicon-eject"></span></th>
						<th style="text-align:center">Placa</th>
						<th style="text-align:center">Patrimonio</th>
						<th>Empresa</th>
						<th>Categoria</th>
						<th>Sub-Categoria</th>
						<th>Ano</th>
						<th>Obra</th>
						<th>Equipe:</th>
						<th style="text-align:center">Situação</th>
						<th style="text-align:center">Valor</th>
						<th style="text-align:center" class="hidden-print">Editar</th>';
			if($acesso_login == 'MASTER'){
				echo '<th style="text-align:center" class="hidden-print"><span class="glyphicon glyphicon-trash"></span></th>';
			}
			echo '</tr></thead><tbody>';
			
			$sql = mysql_query("SELECT * FROM notas_equipamentos WHERE notas_equipamentos.situacao in($sia) AND notas_equipamentos.categoria in($cata) AND notas_equipamentos.equipe IN($equ) AND notas_equipamentos.sub_categoria IN($sbcat) AND notas_equipamentos.obra IN($oba) AND status_2 IN($toa) ORDER BY notas_equipamentos.categoria ASC ") or die (mysql_error());
				
			while($l = mysql_fetch_array($sql)) { 
				extract($l); 
				$se += 1;			
				$soma_qtd_t = 0; 
				$soma_qtd_p = 0;
				$totals += $valor;
				echo '<tr>';
				echo '<td>'.$se.'</td>';
				echo '<td style="text-align:center" width="5%">'.$placa.'</td>';
				echo '<td style="text-align:center" width="5%">'.$patrimonio.'</td>';
				
				$fornecedor_nome = @mysql_result(mysql_query("select * from notas_empresas where id = $empresa"),0,"nome");
				
				if( strlen($fornecedor_nome) >= 20 ) {
					$fornecedor_nome = substr($fornecedor_nome, 0, 20).'...<span class="glyphicon glyphicon-eye-open"></span>';
				}else{
					$fornecedor_nome = $fornecedor_nome.'...<span class="glyphicon glyphicon-eye-open"></span>';
				}
				echo '<td><a href="#" onclick=\'$(".modal-body").load("financeiro/view-empresa.php?id='.$empresa.'")\' data-toggle="modal" data-target="#myModal3"  style="margin:0px; font-weight:bold; font-size:10px;">'.$fornecedor_nome.'</a></td>';
				
				echo '<td>'.@mysql_result(mysql_query("select * from notas_cat_e where id = $categoria"),0,"descricao").'</td>';
				echo '<td>'.@mysql_result(mysql_query("select * from notas_cat_sub where id = $sub_categoria"),0,"descricao").'</td>';
				echo '<td>'.$ano.'</td>';
				echo '<td>'.@mysql_result(mysql_query("select * from notas_obras where id = $obra"),0,"nome_exibir").'</td>';
				echo '<td>'.@mysql_result(mysql_query("select * from equipes where id = $equipe"),0,"nome").'</td>';
				echo '<td style="text-align:center">'.@mysql_result(mysql_query("select descricao from notas_eq_situacao where id = '$situacao'"),0,"descricao").'</td>';
				echo '<td style="text-align:center">R$ '.number_format($valor,"2",".",",").'</td>';
				
				if($acesso_login == 'MASTER' || $acesso_login == 'MODERADOR' || $acesso_login == 'EQUIPAMENTO'){
					echo '<td style="text-align:center" class="hidden-print"><a href="#" onclick=\'$(".resultado").load("almoxarifado/editar-equipamento-master.php?id='.$id.'")\' class="btn btn-xs btn-warning small"><small><span class="glyphicon glyphicon-pencil"></span> <b>Editar</b></small></a></td>';
				}else if($acesso_login == 'EQUIPAMENTO_AUX'){
					echo '<td style="text-align:center" class="hidden-print"><a href="#" onclick=\'$(".resultado").load("almoxarifado/editar-equipamento.php?id='.$id.'")\' class="btn btn-xs btn-warning small"><small><span class="glyphicon glyphicon-pencil"></span> <b>Editar</b></small></a></td>';
				}else if($acesso_login == 'EQUIPAMENTO_SJ'){
					echo '<td style="text-align:center" class="hidden-print"><a href="#" onclick=\'$(".resultado").load("almoxarifado/editar-equipamento-sj.php?id='.$id.'")\' class="btn btn-xs btn-info small"><small><span class="glyphicon glyphicon-pencil"></span> <b>Editar</b></small></a></td>';
				}else{
					echo '<td style="text-align:center" class="hidden-print"><a href="#" onclick=\'$(".resultado").load("almoxarifado/editar-equipamento-almox.php?id='.$id.'")\' class="btn btn-xs btn-info small"><small><span class="glyphicon glyphicon-pencil"></span> <b>Editar</b></small></a></td>';
				}				
				if($acesso_login == 'MASTER'){
					echo '<td style="text-align:center" class="hidden-print"><a href="#" onclick=\'$(".modal-body").load("almoxarifado/del/excluir-equipam.php?id='.$id.'")\' data-toggle="modal" data-target="#myModal"  class="buttonCel btn btn-xs btn-danger" style="margin:0px; padding:5px; font-weight:bold;"><span class="glyphicon glyphicon-trash"></span></a></td>';
				}
				echo '</tr>';	
				@$soma_qtd_t += $qtd_t;
			}
			echo '</tbody></table><hr></hr>';	
			echo '
				<h3 class="pull-right">
					<tr>
						<td><span style="font-family: \'Oswald\', sans-serif; letter-spacing:5px;"><small>Total de Equipamentos: <b>'.mysql_num_rows($sql).'</b></small><br/>Total R$: <b>'.number_format($totals,"2",",",".").'</b></span></td>
					</tr>
				</h3>';
			exit;
		}
		//RECIBO EQUIPAMENTO
		if($relatorio==8) {
			foreach($eq as $eqs)  { @$equ .= $eqs.',';   } $equ  = substr($equ,0,-1);
			foreach($sbca as $sbcas)  { @$sbcat .= $sbcas.',';   } $sbcat  = substr($sbcat,0,-1);
			foreach($si as $sis)  { @$sia .= $sis.',';   } $sia  = substr($sia,0,-1);
			foreach($cat as $cats){ @$cata .= $cats.','; } $cata = substr($cata,0,-1);
			foreach($ob as $obs)  { @$oba .= $obs.',';   } $oba  = substr($oba,0,-1);
			foreach($to as $tos)  { @$toa .= $tos.',';   } $toa  = substr($toa,0,-1);
			$sql = mysql_query("SELECT *, id as id_equipamento FROM notas_equipamentos WHERE notas_equipamentos.situacao in($sia) AND notas_equipamentos.categoria in($cata) AND notas_equipamentos.equipe IN($equ) AND notas_equipamentos.sub_categoria IN($sbcat) AND notas_equipamentos.obra IN($oba) AND status_2 IN($toa) ORDER BY notas_equipamentos.categoria ASC ") or die (mysql_error());
			echo '<table width="100%" class="table table-min table-striped table-condensed small" style="font-size:10px">';  
			while($l = mysql_fetch_array($sql)) { 
				$numpage += 1;
				extract($l); 
					echo '<table width="100%" style="border:1px solid #000; margin-bottom:5px;">';
				echo '<tr>
				<td style="padding:10px; text-align:center" width="10%"><img src="http://guaruja.polemicalitoral.com.br/imagens/logo.png" alt="Logo Polemica" width="50px" /></td>';
				echo '<td style="padding:10px">
					<div class="col-xs-8">
						<b><small>LOCADOR:</small> '.@mysql_result(mysql_query("select * from notas_empresas where id = '$empresa'"),0,"nome").'</b><br/>';
						if((@mysql_result(mysql_query("select * from notas_empresas where id = '$empresa'"),0,"tipo")) == '1'){
							$cnpj = @mysql_result(mysql_query("select * from notas_empresas where id = '$empresa'"),0,"cpf");
						}else{
							$cnpj = @mysql_result(mysql_query("select * from notas_empresas where id = '$empresa'"),0,"cnpj");
						}
						echo '<b><small>CNPJ / CPF:</small> '.$cnpj.'</b><br/>
					</div>
					<div class="col-xs-3" style="text-align:right">
					<b class="text-danger hidden-print">'.$numpage.'</b>
					</div>
					</td>';
				echo '</tr></table>';
				
				echo '<table width="100%" style="border:1px solid #000;">';
				echo '
				<tr>
					<td style="font-size:10px; padding:10px">
						<div class="col-xs-6">
							<b>
								Empresa: POLÊMICA SERVIÇOS BÁSICOS LTDA <br/>
								CNPJ:61.870.101/0001-08<br/>
								Endereço: Rua Euclides Miragaia, 700, Salas 82 e 83 - Centro<br/>
								Municipio: SÃO JOSE DOS CAMPOS &nbsp;&nbsp; - &nbsp;&nbsp; UF: SP
							</b>
						</div>
						<div class="col-xs-6">
							<b>
								<br/>
								Inscrição Estadual: 645.412.590.115<br/>
								CEP: 12245-820
							</b>
						</div>
					</td>
				</tr>';	
				echo '
				<tr style="border:1px solid #000;">
					<td style="font-size:14px; padding:20px 10px">
						<div class="col-xs-9">
								Vimos pela presente, levar ao seu conhecimento o lançamento do valor abaixo discriminado.
								<br/><br/>
								<b>Referente:</b> LOCAÇÃO DE EQUIPAMENTOS
						</div>
						<div class="col-xs-3">
							<b>Emissão:</b> '.implode("/",array_reverse(explode("-",$emissao))).'
								<br/><br/>
							<b>Vencimento:</b> '.implode("/",array_reverse(explode("-",$vencimento))).'
						</div>
					</td>
				</tr>';
				echo '
				<tr class="active" style="border:1px solid #000; font-size:13px;">
					<td style="text-align:center; padding:5px;"><b>DESCRIMINAÇÃO DA LOCAÇÃO</b></td>
				</tr>';
				echo '
				<tr class="active" style="border:1px solid #000; font-size:13px;">
					<td style="padding:10px;">
						<div class="col-xs-12">
							Locação de equipamentos sem utilização de mão de obra/operador<br/><br/>
							<p style="margin:0px">
								<b>Locação:</b> '.$marca.' - <b>Placa:</b> '.$placa.' &nbsp; &nbsp; &nbsp; &nbsp; <b>Categoria:</b> '.mysql_result(mysql_query("select * from notas_cat_e where id = '$categoria'"),0,"descricao").'&nbsp; / &nbsp; <b>Sub-Categoria:</b> '.mysql_result(mysql_query("select * from notas_cat_sub where id = '$sub_categoria'"),0,"descricao").'
								
								
								
								<span class="pull-right"><b>Valor: </b> R$ '.number_format($valor,2,",",".").'</span>

								<div class="col-xs-1" style="padding:0px"><b>Descontar:</b></div>
								<div class="col-xs-11" style="padding:0px">';
								$desconto_equipamento = mysql_query("SELECT numero, empresa, item, SUM(quantidade * (valor - desconto)) as total, parcela, dataxml FROM notas_nf INNER JOIN notas_itens_add ON notas_nf.id = notas_itens_add.nota WHERE categoria = '20' AND item = '$id_equipamento' GROUP BY notas_itens_add.id ORDER BY dataxml");
								$total_descontos = 0;
								while($de = mysql_fetch_array($desconto_equipamento)){
									$parcela = (int)($de['parcela']);
									if($parcela == 0){ 
										$parcela = 1; 
									}
									$data_inicio = $de['dataxml'];
									$data_termino = new DateTime($data_inicio);
									$data_termino->add(new DateInterval('P'.($parcela-1).'M'));
									$data_termino = $data_termino->format('Y-m-d');
									
									$data_inicio2 = explode("-", $data_inicio);
									$data_termino2 = explode("-", $data_termino);
									
									$data_inicio2 = $data_inicio2[0]."-".$data_inicio2[1]."-01";
									$data_termino2 = $data_termino2[0]."-".$data_termino2[1]."-31";
									
									if($inicial >= $data_inicio2 && $final <= $data_termino2){
									echo '<div class="col-xs-12" style="padding:0px 0px 10px 0px">';
										echo '<div class="col-xs-6" style="padding:5px">Empresa: '.mysql_result(mysql_query("SELECT nome FROM notas_empresas WHERE id = '".$de['empresa']."'"),0,"nome").' <b>NF</b>('.$de['numero'].')<br/> <small><b>Valor Total:</b>  R$ '.number_format($de['total'],2,",",".").'&nbsp;&nbsp; / &nbsp;&nbsp;<b>Parcelas:</b> '.$parcela.'x &nbsp;&nbsp; <b>Data Ref.:</b> '.implode("/",array_reverse(explode("-",$de['dataxml']))).'</small> </div>';
										$total_valor = $de['total'] / $parcela;
										echo '<div class="col-xs-6 text-danger" style="padding:0px; text-align:right"> R$ -'.number_format($total_valor,2,",",".").'</div>';
									echo '</div>';
									$total_descontos += $total_valor; 
									}							 
									
								}
								echo '<br/>';
								$desconto_equipamento2 = mysql_query("SELECT * FROM notas_equipamentos_descontos WHERE equipamento = '$id_equipamento' AND (data_ref BETWEEN '$inicial' AND '$final')");
								$total_valor_de_g = 0;
								$total_valor_de_res = 0;
								while($do = mysql_fetch_array($desconto_equipamento2)){
									echo '<div class="col-xs-12" style="padding:0px 0px 10px 0px">';
										echo '<div class="col-xs-6" style="padding:5px">Observações: '.$do['obs'].' <br/> <small><b>Valor Total:</b>  R$ '.number_format($do['valor'],2,",",".").'&nbsp;&nbsp; / &nbsp;&nbsp;<b>Data Ref.:</b> '.implode("/",array_reverse(explode("-",$do['data_ref']))).'</small> </div>';
										$total_valor_de = $do['valor'];
										if($do['tipo'] == '0'){
											$total_valor_de_g += $do['valor'];
											echo '<div class="col-xs-6 text-danger" style="padding:0px; text-align:right"> R$ -'.number_format($total_valor_de,2,",",".").'</div>';
										}else if($do['tipo'] == '1'){
											$total_valor_de_res += $do['valor'];
											echo '<div class="col-xs-6 text-success" style="padding:0px; text-align:right"> R$ '.number_format($total_valor_de,2,",",".").'</div>';
										}
									echo '</div>';
								}
								echo '</div>
								<br/><br/><br/>
							</p>
							<div class="row"></div>
							<b>Medição:</b> &nbsp;&nbsp;&nbsp; Periodo: '.implode("/",array_reverse(explode("-",$inicial))).'  a '.implode("/",array_reverse(explode("-",$final))).'<br/>
							<b>Pagamento:</b> BANCO '.@mysql_result(mysql_query("select * from notas_empresas where id = '$empresa'"),0,"banco").' / AG: '.@mysql_result(mysql_query("select * from notas_empresas where id = '$empresa'"),0,"ag").' - CC: '.@mysql_result(mysql_query("select * from notas_empresas where id = '$empresa'"),0,"cc").'<br/>
							<b>Favorecido: </b>'.@mysql_result(mysql_query("select * from notas_empresas where id = '$empresa'"),0,"favorecido").' - '.@mysql_result(mysql_query("select * from notas_empresas where id = '$empresa'"),0,"cnpj_favorecido").'<br/><br/>';
							
							$total_medicao = $valor + $total_valor_de_res - $total_descontos - $total_valor_de_g;
						echo '</div>
					</td>
				</tr>';
				echo '
				<tr class="active" style="border:1px solid #000; font-size:14px;">
					<td style="text-align:right; padding:10px 30px 10px 10px;">
						<b>Valor Total da Fatura:</b> R$ '.number_format($total_medicao,2,",",".").'
					</td>
				</tr>';
				echo '
				<tr style="border:1px solid #000; font-size:13px;">
					<td style="text-align:right; padding:50px 15px 15px 15px">
					
					____________________________________________________________<br/>
					'.@mysql_result(mysql_query("select * from notas_empresas where id = '$empresa'"),0,"nome").'<br/>
					'.$cnpj.'
					</td>
				</tr>';
				echo '
				<tr class="active" style="border:1px solid #000; font-size:12px;">
					<td style="text-align:center; padding:10px 30px 10px 10px;">
						<b>
							" Operação não sujeita a emissão de Nota Fiscal de Serviços
							Vetada a cobrança de ISS conforme Lei Complementar 116 de 31/07/2003"
						</b>
					</td>
				</tr>';
				echo '</table>';
				echo '<div class="row" style="page-break-before: always;" ></div>';
			}
			echo '</table>';
			exit;
		}
		//Fechamento
		if($relatorio==4) {
			foreach($eq as $eqs)  { @$equ .= $eqs.',';   } $equ  = substr($equ,0,-1);
			foreach($sbca as $sbcas)  { @$sbcat .= $sbcas.',';   } $sbcat  = substr($sbcat,0,-1);
			foreach($si as $sis)  { @$sia .= $sis.',';   } $sia  = substr($sia,0,-1);
			foreach($cat as $cats){ @$cata .= $cats.','; } $cata = substr($cata,0,-1);
			foreach($ob as $obs)  { @$oba .= $obs.',';   } $oba  = substr($oba,0,-1);
			foreach($to as $tos)  { @$toa .= $tos.',';   } $toa  = substr($toa,0,-1);
			foreach($pg as $pgs)  { @$pga .= $pgs.',';   } $pga  = substr($pga,0,-1);
			topoPrint();
			echo '
			<p>
				<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
					RELATÓRIO DE EQUIPAMENTOS - SIMPLES
				</h3>
				<p style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center; "><small>'.$data_view.'</small></p>
				
				<h5 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center; "><small> REFERENTE AO MÊS: <b id="mesImp">'.$mes.' </b></small></h5>
				
				<div class="row hidden-print"><center>
					<select class="form-control input-sm" name="mesSelect" onChange="ldy(\'almoxarifado/painel-equipamentos-almo.php?mesSelect=1&mes=\' + $(this).val(),\'#mesImp\')" style="width:10%">	
						<option value="" disabled>SELECIONE O MÊS REFERENTE</option>
						<option value="JANEIRO">JANEIRO</option>
						<option value="FEVEREIRO">FEVEREIRO</option>
						<option value="MARÇO">MARÇO</option>
						<option value="ABRIL">ABRIL</option>
						<option value="MAIO">MAIO</option>
						<option value="JUNHO">JUNHO</option>
						<option value="JULHO">JULHO</option>
						<option value="AGOSTO">AGOSTO</option>
						<option value="SETEMBRO">SETEMBRO</option>
						<option value="OUTUBRO">OUTUBRO</option>
						<option value="NOVEMBRO">NOVEMBRO</option>
						<option value="DEZEMBRO">DEZEMBRO</option>
					</select>
					</center>
				</div>
			</p>
			<p style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center; opacity:0.8">';
				$obra_controle = mysql_query("SELECT * FROM notas_obras WHERE id IN($oba)");
				while($c = mysql_fetch_array($obra_controle)){
					echo $c['descricao'].'<br/>';
				}
				echo '</p>';
			$desc = mysql_query("select * from notas_eq_situacao WHERE id IN($sia) order by descricao asc");
			while($z = mysql_fetch_array($desc)) {
				echo '<table width="100%" class="table table-condensed table-color" style="font-size:10px">';
				echo '<thead>
						<tr>
						<th colspan="11">'.$z['descricao'].'</th>
						</tr>
						<tr><th><span class="glyphicon glyphicon-eject"></span></th><th style="text-align:center">Placa</th><th style="text-align:center">Contrato</th><th style="text-align:center">Patrimônio</th><th>Empresa</th><th>Sub-Categoria</th><th>Obra</th><th style="text-align:center">Situação</th><th style="text-align:center">Status</th><th style="text-align:center">Valor</th><th style="text-align:center">Pagamento</th></tr>
					</thead>
					<tbody>';
				$sql = mysql_query("SELECT * FROM notas_equipamentos WHERE notas_equipamentos.situacao = '".$z['id']."' AND notas_equipamentos.categoria in($cata) AND notas_equipamentos.equipe IN($equ) AND notas_equipamentos.sub_categoria IN($sbcat) AND notas_equipamentos.pago IN($pga) AND notas_equipamentos.obra IN($oba) AND status_2 IN($toa) ORDER BY notas_equipamentos.categoria ASC ") or die (mysql_error());
					
				while($l = mysql_fetch_array($sql)) {  extract($l);
					$total_equipamento += 1;
					$se += 1;			
					$sql_total2 = $sql;
					$totals += intval($valor);
					echo '<tr>';
					echo '<td>'.$se.'</td>';
					echo '<td style="text-align:center" width="auto">'.$placa.'</td>';
					echo '<td style="text-align:center" width="auto">'.$patrimonio2.'</td>';
					echo '<td style="text-align:center">'.$patrimonio.'</td>';
					echo '<td>'.@mysql_result(mysql_query("select * from notas_empresas where id = $empresa"),0,"nome").'</td>';
					echo '<td>'.@mysql_result(mysql_query("select * from notas_cat_sub where id = $sub_categoria"),0,"descricao").'</td>';
					echo '<td>'.@mysql_result(mysql_query("select * from notas_obras where id = $obra"),0,"descricao").'</td>';
					echo '<td style="text-align:center">'.@mysql_result(mysql_query("select descricao from notas_eq_situacao where id = '$situacao'"),0,"descricao").'</td>';
					echo '<td style="text-align:center">'.@mysql_result(mysql_query("select descricao from status_2 where id = '$status_2'"),0,"descricao").'</td>';
					echo '<td style="text-align:center">'.$valor.'</td>';
					if($pago == 1){
						
						$pago_qtd += intval($valor);
						echo '<td id="val'.$id.'" style="width:2%" align="center">
						
							<a href="#" title="Painel 0" class="btn btn-success btn-xs hidden-print" style="width:100%; padding:0px 3px 0px 3px"  onclick=\'ldy("almoxarifado/painel-equipamentos-almo.php?ac=salvar-painel&id='.$id.'","#val'.$id.'")\'><b><i class="fa fa-pinterest-p" aria-hidden="true"></i></b></a>
							
							<span class="hidden-xs hidden-md hidden-lg visible-print"> PAGO </span>
						
						</td>';
					}else if($pago == 0){
						echo '<td id="val'.$id.'" style="width:2%"  align="center">
						
						
							<a href="#" title="Painel 1" class="btn btn-danger btn-xs hidden-print" style="width:100%;"  onClick=\'ldy("almoxarifado/painel-equipamentos-almo.php?ac=salvar-painel2&id='.$id.'","#val'.$id.'")\'> <b><i class="fa fa-pinterest-p" aria-hidden="true"></i></b> </a>
							
							<span class="hidden-xs hidden-md hidden-lg visible-print"> DEVIDO </span>
							</td>';
						$devido_qtd += intval($valor);
					}					
					echo '</tr>';
					@$soma_qtd_t += $qtd_t; 
				}
				echo '</tbody></table><hr></hr>';	
			}
			echo '
				<h3 class="pull-left">
					<tr>
						<td>
							<p>
								<span style="font-family: \'Oswald\', sans-serif; letter-spacing:5px;">PAGO: R$: <b>'.number_format($pago_qtd,"2",",",".").'</b><br/>
								
								DEVIDO: R$: <b>'.number_format($devido_qtd,"2",",",".").'</b></span>
							</p>
						</td>
					</tr>
				</h3>
				<h3 class="pull-right">
					<tr>
						<td>
							<p>
								<span style="font-family: \'Oswald\', sans-serif; letter-spacing:5px;"><small>Total de Equipamentos: <b>'.$total_equipamento.'</b></small><br/>
								
								Total R$: <b>'.number_format($totals,"2",",",".").'</b></span>
							</p>
						</td>
					</tr>
				</h3>';
			exit;
		}
		//MEMORIA DE CALCULO
		if($relatorio==7){
						
			foreach($eq as $eqs)  { @$equ .= $eqs.',';   } $equ  = substr($equ,0,-1);
			foreach($sbca as $sbcas)  { @$sbcat .= $sbcas.',';   } $sbcat  = substr($sbcat,0,-1);
			foreach($si as $sis)  { @$sia .= $sis.',';   } $sia  = substr($sia,0,-1);
			foreach($cat as $cats){ @$cata .= $cats.','; } $cata = substr($cata,0,-1);
			foreach($ob as $obs)  { @$oba .= $obs.',';   } $oba  = substr($oba,0,-1);
			foreach($to as $tos)  { @$toa .= $tos.',';   } $toa  = substr($toa,0,-1);
			topoPrint();
			echo '
			<p>
				<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
					RELATÓRIO DE EQUIPAMENTOS - MEMORIA DE CALCULO
				</h3>
				<p style="text-align:center;  font-size:14px;"><small>'.implode("/",array_reverse(explode("-",$todayTotal))).'</small></p>
			</p>
			<p style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">';
				$obra_controle = mysql_query("SELECT * FROM notas_obras WHERE id IN($oba)");
				while($c = mysql_fetch_array($obra_controle)){
					echo $c['descricao'].'<br/>';
				}
				echo '</p>';

			echo '<table width="100%" class="table table-condensed table-color">';
			echo '
				<thead>
					<tr>
						<th style="text-align:center"><span class="glyphicon glyphicon-eject"></span></th>
						<th>CATEGORIA</th>
						<th>SUB-CATEGORIA</th>
						<th style="text-align:center">QTD</th>
						<th style="text-align:center">VALOR</th>
					</tr>
				</thead>
				<tbody>';
			$sql = mysql_query("SELECT notas_cat_e.id as id_categoria, notas_cat_sub.descricao as desc_sub, notas_cat_e.descricao as desc_e, notas_cat_sub.id as id_sub, 
						
			(SELECT SUM(valor) FROM notas_equipamentos WHERE notas_equipamentos.sub_categoria = id_sub AND obra IN($oba) AND notas_equipamentos.status_2 IN($toa) AND notas_equipamentos.situacao in($sia) AND equipe IN($equ) AND notas_equipamentos.categoria = id_categoria GROUP BY sub_categoria) as valor_total,
						
			(SELECT COUNT(*) FROM notas_equipamentos WHERE notas_equipamentos.sub_categoria = id_sub AND obra IN($oba) AND equipe IN($equ) AND notas_equipamentos.status_2 IN($toa) AND notas_equipamentos.situacao in($sia) AND notas_equipamentos.categoria = id_categoria GROUP BY sub_categoria) as qtd_veiculos 
						
			FROM notas_cat_e INNER JOIN notas_cat_sub ON notas_cat_e.id = notas_cat_sub.associada WHERE notas_cat_e.oculto = 0 AND notas_cat_e.id IN($cata) AND notas_cat_sub.id IN($sbcat) ");
						
			while($l = mysql_fetch_array($sql)){
				$se += 1;
				if($l['valor_total'] != ''){
					echo '<tr>';
					echo '<td style="text-align:center">'.$se.'</td>';
					echo '<td>'.$l['desc_e'].'</td>';
					echo '<td>'.$l['desc_sub'].'</td>';
					echo '<td style="text-align:center">'.$l['qtd_veiculos'].'</td>';
					echo '<td style="text-align:center">'.number_format($l['valor_total'],2,".",",").'</td>';
					echo '</tr>';
				}
				$total_qtd += $l['qtd_veiculos'];
				$total_geral += $l['valor_total'];
			}
			echo '</tbody> </table>';
			echo '<hr/>';
			echo '
				<h3 class="pull-right">
					<tr>
						<td><span style="font-family: \'Oswald\', sans-serif; letter-spacing:5px;"><small>Total de Equipamentos: <b>'.$total_qtd.'</b></small><br/>Total R$: <b>'.number_format($total_geral,"2",",",".").'</b></span></td>
					</tr>
				</h3>';
			exit;
		}
		//veiculo equipamentoo
		if($relatorio==9) {
			foreach($eq as $eqs)  { @$equ .= $eqs.',';   } $equ  = substr($equ,0,-1);
			foreach($sbca as $sbcas)  { @$sbcat .= $sbcas.',';   } $sbcat  = substr($sbcat,0,-1);
			foreach($sirh as $sirhs)  { @$sirht .= $sirhs.',';   } $sirht  = substr($sirht,0,-1);
			foreach($si as $sis)  { @$sia .= $sis.',';   } $sia  = substr($sia,0,-1);
			foreach($cat as $cats){ @$cata .= $cats.','; } $cata = substr($cata,0,-1);
			foreach($ob as $obs)  { @$oba .= $obs.',';   } $oba  = substr($oba,0,-1);
			foreach($to as $tos)  { @$toa .= $tos.',';   } $toa  = substr($toa,0,-1);
			topoPrint();
			echo '
			<p>
				<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
					RELATÓRIO DETALHADO DE EQUIPES 
				</h3
			</p>
			<p style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">';
			$obra_controle = mysql_query("SELECT * FROM notas_obras WHERE id IN($oba)");
			while($c = mysql_fetch_array($obra_controle)){	echo $c['descricao'].'<br/>'; }
			echo '
			</p>
			<hr/>
			';
			echo '<table class="table table-striped table-condensed small" style="font-size:15px; background:#FFF">';
			echo '<thead>';
					echo '<tr class="small info">';
					echo '<th>Nº</th>
							<th> FUNCIONARIO</small></th>
							<th>
								<div class="col-xs-6" style="padding:0px">CATEGORIA / SUB-CATEGORIA</div> <div class="col-xs-6" style="padding:0px">VEICULO / PLACA</div>
							</th>
							<th class="hidden-print"></th>
						</tr>';
					$sql = mysql_query("SELECT *, id as id_2 FROM rh_funcionarios WHERE situacao IN($sirht) AND (obra IN($oba) OR tipo_emp = '1') ORDER BY nome ASC");
					while($c = mysql_fetch_array($sql)) {
						$obra_fun = $c['obra'];
						$id_func = $c['id_2'];
						if(mysql_num_rows(mysql_query("SELECT id as id_equip, marca, placa, obs FROM notas_equipamentos WHERE local = '$id_func' and status_2 IN($toa) AND categoria IN($cata) AND sub_categoria IN($sbcat) AND situacao IN($sia) ORDER BY id DESC")) == 0){
							echo '<tr class="hidden">';
						}else{
							
							$se2 += 1;
							echo '<tr>';
						}
						echo '<td width="3%" style="vertical-align:middle; border:1px solid #000;">'.$se2.'</td>';
						echo '<td width="30%" style="vertical-align:middle; border:1px solid #000;">'.$c['nome'].'</td>';
						echo '<td width="60%" style="padding:0px; border:1px solid #000;">';
						$marca_placa = mysql_query("SELECT id as id_equip, marca, placa, obs, categoria, sub_categoria FROM notas_equipamentos WHERE local = '$id_func' and status_2 IN($toa) AND categoria IN($cata) AND sub_categoria IN($sbcat) AND situacao IN($sia) ORDER BY id DESC");
						while($k = mysql_fetch_array($marca_placa)){
							if($k['marca'] == '' && $k['placa'] == ''){
								echo '';
							}else{
								echo '<div class="col-xs-12" style="border-bottom:1px solid #000; padding:8px">
								<div class="col-xs-6" style="padding:0px;">
									<span>'.mysql_result(mysql_query("select * from notas_cat_e where id = '".$k['categoria']."'"),0,"descricao").' / '.mysql_result(mysql_query("select * from notas_cat_sub where id = '".$k['sub_categoria']."'"),0,"descricao").'</span>
								</div>
								<div style="padding:0px;" class="col-xs-6">
									<span>'.$k['marca'].' ('.$k['placa'].')</span>
								</div>';
								echo '</div>';
							}
						}
						echo '</td>';
						if($acesso_login == 'MASTER'){
							echo '<td width="3%" class="hidden-print"  style="vertical-align:middle; border:1px solid #000;"><a href="#" style="margin:0px 10px 0px 10px; font-size:12px; " class="btn btn-xs btn-primary"onclick=\'ldy("rh/editar-funcionario.php?acesso_login='.$acesso_login.'&id='.$id_func.'",".resultado")\'><span class="glyphicon glyphicon-pencil"></span></a></td>';
						}					
						echo '</tr>'; 
						$total_geral += $salario;

					}
			echo '</tbody>';
			echo '</table>';
		exit;
		}
		//ADM VEICULO / 2
		if($relatorio==10) {
		foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);
		foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1);
		foreach($si as $sis) { @$siu .= $sis.','; } $siu = substr($siu,0,-1);
		foreach($sirh as $sirhs)  { @$sirht .= $sirhs.',';   } $sirht  = substr($sirht,0,-1);
		foreach($ci as $cis) { @$ciu .= $cis.','; } $ciu = substr($ciu,0,-1);
		foreach($enc as $encs) { @$enca .= $encs.','; } $enca = substr($enca,0,-1);
		topoPrint();
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
		echo '<table class="table table-striped table-condensed table-color small" style="font-size:10px">';
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
						<th> FUNÇÃO</th>
						<th> SITUAÇÃO</th>
						<th> OBSERVAÇÃO FUNCIONARIO</th>
						<th> VEICULO / PLACA</th>
						<th class="hidden-print"></th>
					</tr>';
				$sql = mysql_query("SELECT *, id as id_2, funcao as cargo_func, (SELECT lider_geral FROM equipes WHERE lider_geral = id_2 GROUP BY lider_geral) as lider_geral, (SELECT salario FROM rh_funcoes WHERE rh_funcoes.id = cargo_func) as salario FROM rh_funcionarios WHERE situacao IN($sirht) AND equipe = ".$b['id']." AND (obra IN($oba) OR tipo_emp = '1') AND (rh_funcionarios.admissao between '$inicial' and '$final') ORDER BY lider_geral DESC");
				
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
					echo '<td width="20%">'.mysql_result(mysql_query("SELECT * FROM rh_funcoes WHERE id = ".$c['funcao'].""),0,"descricao").'</td>';	
					echo '<td width="5%">'.$situacao[1].'</td>';
					echo '<td width="20%">'.$c['adm_obs'].'</td>';
					echo '<td width="15%">';
					$marca_placa = mysql_query("SELECT id as id_equip, marca, placa, obs FROM notas_equipamentos WHERE categoria IN(7,30,31,37,38) and local = '$id_func' and status_2 = '1' ORDER BY id DESC LIMIT 10");
					while($k = mysql_fetch_array($marca_placa)){
						if($k['marca'] == '' && $k['placa'] == ''){
							echo '';
						}else{
							if($acesso_login == 'MASTER' || $acesso_login == 'MODERADOR'){
								echo '<i class="fa fa-tag" aria-hidden="true"></i><a href="#" style="margin:0px 10px 0px 10px; font-size:9px;" onclick=\'ldy("almoxarifado/editar-equipamento-master.php?id='.$k['id_equip'].'",".resultado")\'><span style="margin:5px">'.$k['marca'].' ('.$k['placa'].')</span></a>&nbsp; - &nbsp; <b>Obs.: </b><small>'.$k['obs'].'</small><br/>';
							}else if($acesso_login == 'EQUIPAMENTO_AUX'){ //TIRAR LIDERALMO
								echo '<i class="fa fa-tag" aria-hidden="true"></i><a href="#" style="margin:0px 10px 0px 10px; font-size:9px;" onclick=\'ldy("almoxarifado/editar-equipamento.php?id='.$k['id_equip'].'",".resultado")\'><span style="margin:5px">'.$k['marca'].' ('.$k['placa'].')</span></a>&nbsp; - &nbsp; <b>Obs.: </b><small>'.$k['obs'].'</small><br/>';
							}else if($acesso_login == 'EQUIPAMENTO_SJ'){
								echo '<i class="fa fa-tag" aria-hidden="true"></i><a href="#" style="margin:0px 10px 0px 10px; font-size:9px;" onclick=\'ldy("almoxarifado/editar-equipamento-sj.php?id='.$k['id_equip'].'",".resultado")\'><span style="margin:5px">'.$k['marca'].' ('.$k['placa'].')</span></a>&nbsp; - &nbsp; <b>Obs.: </b><small>'.$k['obs'].'</small><br/>';
							}else if($acesso_login == 'EQUIPAMENTO_ALMOX'){
								echo '<i class="fa fa-tag" aria-hidden="true"></i><a href="#" style="margin:0px 10px 0px 10px; font-size:9px;" onclick=\'ldy("almoxarifado/editar-equipamento-almox.php?id='.$k['id_equip'].'",".resultado")\'><span style="margin:5px">'.$k['marca'].' ('.$k['placa'].')</span></a>&nbsp; - &nbsp; <b>Obs.: </b><small>'.$k['obs'].'</small><br/>';
							}else{
								echo '<i class="fa fa-tag" aria-hidden="true"></i><span style="margin:5px">'.$k['marca'].' ('.$k['placa'].')</span>&nbsp; - &nbsp; <b>Obs.: </b><small>'.$k['obs'].'</small><br/>';
							}							
						}
					}
					echo '</td>';
					if($gestor_array == $_SESSION['id_usuario_logado'] || $rh_array == $_SESSION['id_usuario_logado']){
						echo '<td width="3%" class="hidden-print"><a href="#" style="margin:0px 10px 0px 10px; font-size:8px" class="btn btn-xs btn-primary"onclick=\'ldy("rh/editar-funcionario.php?id='.$id_func.'",".resultado")\'><span class="glyphicon glyphicon-pencil"></span></a></td>';
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
	}
?>
	<div class="container-fluid hidden-print" style="padding:0px 0px 15px 0px; margin-bottom:20px; border-bottom:1px solid #CCC">
		<img src="../imagens/logo.png" class="img-responsive" width="50px" style="float:left; margin-right:20px"/>
		<h3 style="font-family: 'Oswald', sans-serif; letter-spacing:5px;"> 
			RELATÓRIO DE <small><b>EQUIPAMENTOS</b></small>
			<a href="javascript:window.print()" style="letter-spacing:8px; padding-left:40px; padding-right:40px;" class="hidden-xs hidden-print pull-right btn btn-warning btn-sm"> <span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Imprimir</a>
		</h3>
	</div>
	<div class="well well-sm hidden-print" style="padding:10px 10px 5px 10px;">
		<form action="javascript:void(0)" onSubmit="posti(this,'almoxarifado/painel-equipamentos-almo.php?ac=listar','.resultado');"  class="form-inline formulario-normal">
			<div class="container-fluid" style="padding:0px">
				<div class="col-xs-8" style="padding:0px">
					<div class="col-xs-2" style="padding:2px">
						<label><small>Obra:</small><br/>
							<select name="ci[]" onChange="$('#item-consulta-obra').load('../functions/functions-load.php?atu=equipe&cidade=' + $(this).val() + '');" class="sel" multiple="multiple" required> 
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
								<label><small>Contrato:</small><br/>
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
								<label><small>Encarregados:</small>
									<select name="enc[]" class="sel" multiple="multiple">
									<?php
										$encarregados = mysql_query("select * from encarregados WHERE obra IN(0,$cidade_usuario) order by nome asc");
										while($z = mysql_fetch_array($encarregados)) {
											echo '<option value="'.$z['id'].'" selected>'.$z['nome'].'</option>';
										}
									?>		
									</select>
								</label>
							</div>
							<div class="col-xs-3" style="padding:2px">
								<label>
									<small>Status:</small>
									<select name="st[]" OnChange="$('#item-status').load('../functions/functions-load.php?atu=status1&status3=' + $(this).val() + '');" class="sel" multiple="multiple">
										<option value="0" selected>ATIVA</option>
										<option value="1" selected>INATIVA</option>
									</select>
								</label>
							</div>
							<div class="col-xs-3" style="padding:2px">
								<div id="item-status">
									<label>
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
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-2" style="padding:2px">
					<label><small>Categoria:</small>
						<select name="cat[]" onChange="$('#itens_categoria').load('../functions/functions-load.php?atu=categoria&categoria=' + $(this).val() + '');" class="sel" multiple="multiple"> 
								<?php 
									$categorias = mysql_query("select * from notas_cat_e where oculto = '0' order by descricao asc");
									while($l = mysql_fetch_array($categorias)) {
										echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>'; 
									}
								?>		
						</select>
					</label>
				</div>
				<div class="col-xs-2" style="padding:2px">
					<div id="itens_categoria">
						<label><small>Sub-Categoria:</small><br/>
							<select name="sbca[]" style="width:100%" class="sel" multiple="multiple">
								<?php 
									$sub_categorias = mysql_query("select * from notas_cat_sub order by descricao asc");
									while($l = mysql_fetch_array($sub_categorias)) {
										echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>'; 
									}
								?>		
							</select>
						</label>
					</div>
				</div>
				<div class="col-xs-6" style="padding:2px">
					<div class="col-xs-3" style="padding:2px">
						<label><small>Tipo:</small>
							<select name="relatorio" onChange="$('#situacao_datas').load('almoxarifado/painel-equipamentos-almo.php?data_form=2&situacao=' + $(this).val() + '');" style="width:100%" class="form-control input-sm">
								<option value="" disabled>Selecione o tipo de relatório desejado</option>
								<option value="6">SIMPLES</option>
								<option value="5">DETALHADO</option>
								<option value="4">FECHAMENTO</option>
								<option value="7">MEMORIA DE CALCULO</option>
								<option value="8">RECIBO EQUIPAMENTO</option>
								<option value="10">ADM VEICULOS</option>
								<option value="9">VEICULOS FUNCIONARIOS</option>
							</select>
						</label>
					</div>
					<div class="col-xs-3" style="padding:2px">
						<label><small>Situação: </small>
							<select name="si[]" class="sel" multiple="multiple">
								<option value="0" selected>SEM SITUAÇÃO</option>
								<?php
									$desc = mysql_query("select * from notas_eq_situacao order by descricao asc");
									while($l = mysql_fetch_array($desc)) { extract($l);
										echo '<option value="'.$id.'" selected>'.$descricao.'</option>';
									}
								?>
							</select>
						</label>
					</div>
					<div class="col-xs-3" style="padding:2px">
						<label><small>Status: </small>
							<select name="to[]" class="sel" multiple="multiple">
								<?php
									$status_dois = mysql_query("select * from status_2 ORDER BY descricao");
									while($l = mysql_fetch_array($status_dois)) { extract($l);
										echo '<option value="'.$id.'" selected>'.$descricao.'</option>';
									}		
								?>		
							</select>
						</label>
					</div>
					<div class="col-xs-3" style="padding:2px">
						<label>
							<small>Pago: </small>
							<select name="pg[]" class="sel" multiple="multiple">
								<option value="0" selected>DEVIDO</option>
								<option value="1" selected>PAGO</option>
							</select>
						</label>
					</div>
				</div>
				<div class="col-xs-6" style="padding:0px">
					<div id="situacao_datas"> </div>
				</div>
				<div class="col-xs-2" style="padding:2px;">
					<label class="pull-right" style="width:100%"><br/>
						<input type="submit" value="Pesquisar" style="width:100%" class="btn btn-success btn-sm">
					</label>
				</div>	
			</div>
		</form>
	</div>	

<p><a href="#" onclick="ldy('almoxarido/painel-equipamentos-almo.php','.conteudo')" class="btn btn-warning btn-xs" id="nconsulta" style="display: none;">Nova consulta</a></p></div>

<div class="resultado"></div>
	<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:auto;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Tem certeza disso?</h4>
				</div>
				<div class="modal-body">
					Aguarde um momento &nbsp;&nbsp; <img src="../../imagens/loading.gif" alt="Carregando" width="20px"/>
				</div>
			</div>
		</div>
	</div>
	<div class="modal" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:auto;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" onclick="$('.modal').modal('hide')" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Observações</h4>
				</div>
				<div class="modal-body">
					Aguarde um momento &nbsp;&nbsp; <img src="../../imagens/loading.gif" alt="Carregando" width="20px"/>
				</div>
			</div>
		</div>
	</div>
		<div class="modal" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="height:auto;">
		<div class="modal-dialog" style="width:80%;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" onclick="$('.modal').modal('hide')" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Visualizar empresa</h4>
				</div>
				<div class="modal-body">
					Aguarde um momento &nbsp;&nbsp; <img src="../../imagens/loading.gif" alt="Carregando" width="20px"/>
				</div>
			</div>
		</div>
	</div>