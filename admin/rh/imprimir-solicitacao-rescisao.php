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
	
	$query1 = mysql_query("INSERT INTO solicitacao_recisao (data_solicitacao, cidade_solicitacao, funcionario, cargo, salario, tipo, motivo, aviso, inicial_horas, final_horas, dias_uteis, telefone, adiantamento, contr_ass, contr_sind, extrato_fgts, data_demissao) VALUES ('$data_solicitacao', '$cidade', '$funcionario', '$cargo', '$salario', '$tipo', '$motivo', '$aviso', '$inicial', '$final', '$dias', '$telefone', '$adiantamento', '$contr_ass', '$contr_sind', '$extrato_fgts', '$data_demissao')");
	
	$query2 = mysql_query("UPDATE `rh_funcionarios` SET `situacao`='16' WHERE id = '$funcionario'");
	
	echo '<div id="alerta" class="row" style="width:100%; text-align:center; margin:10px">
			<span class="text-success hidden-print">Solicitação feita com sucesso, favor imprimir o documento de solicitação!</span></div>';
?>
<script>
$('html, body').animate({ scrollTop: $('#alerta').offset().top }, 'slow');
</script>
<div class="row">
<a href="javascript:window.print()" style="font-family: 'Oswald', sans-serif; letter-spacing:8px;  line-height: 30px; position:relative; bottom:10px; height:40px; width:40%" class="hidden-xs hidden-print pull-right btn btn-warning btn-sm"> <span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Imprimir</a>

<a href="#" onClick="$('.conteudo').load('rh/cadastro-solicitacao.php');" style="font-family: 'Oswald', sans-serif; letter-spacing:8px;  line-height: 30px; position:relative; bottom:10px; height:40px; width:20%" class="hidden-xs hidden-print pull-left btn btn-primary btn-sm"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Nova</a>
</div>
<div class="row">
<table width="100%" border="1">
	<tr>
		<td style="padding:10px; text-align:center" width="10%">
			<img src="http://guaruja.polemicalitoral.com.br/imagens/logo.png" alt="Logo Polemica" width="50px" />
		</td>
		<td style="position:relative; font-size:10px; padding-left:20px;" width="95%">
			<b>POLÊMICA SERVIÇOS BÁSICOS LTDA.</b><br/>
			Rua Euclides Miragaia, 700, Salas 82 e 83 - Centro - CEP 12245-820 <br/>
			São José dos Campos - SP - TELEFAX (12) 3941-8555<br/>
			Inscrição Municipal Nº 66.133/3<br/>
			Inscrição Estadual - 645.412.590.115<br/>
			<p style="position:absolute; top:10px; right:10px; width:100%; font-size:10px; text-align:right"><b>Data Impressão: </b><?php echo implode("/",array_reverse(explode("-",$todayTotal)));?></p>
		</td>
	</tr>
	<tr>
		<td colspan="2" style="padding:20px">
			<p>
				<h3 style="text-align:center;"> SOLICITAÇÃO DE RESCISÃO CONTRATUAL </h3>
			</p>
		</td>
	</tr>
</table>
<table width="100%" border="1">

	<tr>
		<td width="30%" style="padding:8px"><b> Data Solicitação: </b></td>
		<td width="70%" style="padding:8px"><?php echo implode("/",array_reverse(explode("-",$data_solicitacao))); ?></td>
	</tr>

	<tr>
		<td width="30%" style="padding:8px"><b> Funcionário: </b></td>
		<td width="70%" style="padding:8px"><?php echo @mysql_result(mysql_query("SELECT nome FROM rh_funcionarios WHERE id = ".$funcionario.""),0,"nome"); ?></td>
	</tr>

	<tr>
		<td width="30%" style="padding:8px"><b> Cargo: </b></td>
		<td width="70%" style="padding:8px"><?php echo $cargo ?></td>
	</tr>

	<tr>
		<td width="30%" style="padding:8px"><b> Data de Admissão: </b></td>
		<td width="70%" style="padding:8px"><?php echo implode("/",array_reverse(explode("-",$data_admissao))); ?></td>
	</tr>

	<tr>
		<td width="30%" style="padding:8px"><b> Salário:</b></td>
		<td width="70%" style="padding:8px"><?php echo 'R$ '.number_format($salario,2,",","."); ?></td>
	</tr>

	<tr>
		<td width="30%" style="padding:8px"><b> PIS:</b></td>
		<td width="70%" style="padding:8px"><?php echo $pis; ?></td>
	</tr>

	<tr>
		<td width="30%" style="padding:8px"><b> Data de Demissão:</b></td>
		<td width="70%" style="padding:8px"><?php echo implode("/",array_reverse(explode("-",$data_demissao))); ?></td>
	</tr>

	<tr>
		<td width="30%" style="padding:8px"><b> Tipo: </b></td>
		<td width="70%" style="padding:8px"><?php echo $tipo; ?></td>
	</tr>

	<tr>
		<td width="30%" style="padding:8px"><b> Motivo: </b></td>
		<td width="70%" style="padding:8px"><?php echo $motivo; ?></td>
	</tr>

	<tr>
		<td width="30%" style="padding:8px"><b> Aviso: </b></td>
		<td width="70%" style="padding:8px"><?php echo $aviso; ?></td>
	</tr>

	<tr>
		<td width="30%" style="padding:8px"><b> Horas Extras: </b></td>
		<td width="70%" style="padding:8px">
		<?php
			$horas_sum = mysql_result(mysql_query("select SUM(rh_horaextra.falta_hora) as falta_hora from rh_horaextra where (data between '$inicial' and '$final') and funcionario = '$funcionario' and falta IN(1,2)"),0,"falta_hora");
			if($horas_sum == 0 || $horas_sum == ''){
				echo 'S/Horas Extras';
			}else{
				echo $horas_sum;
			}
		?>
		</td>
	</tr>

	<tr>
		<td width="30%" style="padding:8px"><b> Faltas: </b></td>
		<td width="70%" style="padding:8px">
			<?php
			$faltas_sum = mysql_result(mysql_query("select count(id) as total from rh_horaextra where (data between '$inicial' and '$final') and funcionario = '$funcionario' and falta IN(1,2)"),0,"total");
			if($faltas_sum == 0 || $faltas_sum == ''){
				echo 'S/Faltas';
			}else{
				echo $faltas_sum;
			}
			?> 
		</td>
	</tr>

	<tr>
		<td width="30%" style="padding:8px"><b> Tickets: </b></td>
		<td width="70%" style="padding:8px">
			<?php
				$refeicao_d = mysql_result(mysql_query("SELECT vale_refeicao FROM rh_funcionarios WHERE id = ".$funcionario.""),0,"vale_refeicao"); 
				echo 'R$ '.number_format($dias * $refeicao_d,2,",",".");
			?>
		</td>
	</tr>

	<tr>
		<td width="30%" style="padding:8px"><b> Vale Transporte: </b></td>
		<td width="70%" style="padding:8px">
			<?php
				$transporte_v1 = mysql_result(mysql_query("SELECT vale_qtd FROM rh_funcionarios WHERE id = ".$funcionario.""),0,"vale_qtd") * 2;
				$transporte_v2 = mysql_result(mysql_query("SELECT vale_qtd2 FROM rh_funcionarios WHERE id = ".$funcionario.""),0,"vale_qtd2") * 2;
				echo 'R$ '.number_format($dias * ($transporte_v1 + $transporte_v2),2,",",".");
			?>
		</td>
	</tr>

	<tr>
		<td width="30%" style="padding:8px"><b> Telefone: </b></td>
		<td width="70%" style="padding:8px"><?php echo $telefone; ?></td>
	</tr>

	<tr>
		<td width="30%" style="padding:8px"><b> Adiantamento: </b></td>
		<td width="70%" style="padding:8px"><?php echo $adiantamento; ?></td>
	</tr>

	<tr>
		<td width="30%" style="padding:8px"><b> Contribuição Assistencial / Negocial: </b></td>
		<td width="70%" style="padding:8px"><?php echo $contr_ass; ?></td>
	</tr>

	<tr>
		<td width="30%" style="padding:8px"><b> Contribuição Sindical: </b></td>
		<td width="70%" style="padding:8px"><?php echo $contr_sind; ?></td>
	</tr>

	<tr>
		<td width="30%" style="padding:8px"><b> Extrato FGTS</b></td>
		<td width="70%" style="padding:8px"><?php echo $extrato_fgts; ?></td>
	</tr>
</table>
</div>