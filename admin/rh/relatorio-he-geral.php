<?php
include("../config.php");
include("../validar_session.php");

date_default_timezone_set('America/Sao_Paulo');
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
		  maxHeight: 200,
		  includeSelectAllOption: true,
		  selectAllText: "SELECIONAR TODOS",
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
if(@$ac=='resultado') {
if($relatorio==1) {
	foreach($ob as $obs) { @$obu .= $obs.','; } $obu = substr($obu,0,-1);
	foreach($st as $sts) { @$sta .= $sts.','; } $sta = substr($sta,0,-1);
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
						RELATÓRIO DE HORAS EXTRAS - DETALHADO
					</h3>
					<p style="text-align:center;  font-size:14px;"><small>Período: '.implode("/",array_reverse(explode("-",$inicial))).' á '.implode("/",array_reverse(explode("-",$final))).'</small></p>
				</p>
				<p style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
					';
					$obra_controle = mysql_query("SELECT * FROM notas_obras WHERE id IN($obu)");
					while($c = mysql_fetch_array($obra_controle)){
						echo $c['descricao'].'<br/>';
					}
					echo '
				</p>
				<hr/>
			';
	echo '<table class="table table-striped table-condensed small">';
	$inicial = implode("-",array_reverse(explode("/",$inicial))); 
	$final = implode("-",array_reverse(explode("/",$final)));

	//lista as datas 
	echo '<tr class="small"><th></th><th>NOME</th>';
	$listar_datas = mysql_query("select * from rh_horaextra where (data between '$inicial' and '$final') group by data order by data asc");
	while($l = mysql_fetch_array($listar_datas)) { 
		echo '<th style="text-align:center">'.substr(implode("/",array_reverse(explode("-",$l['data']))),0,5).'</th>';
		
	}
	echo '<th width="3%">Faltas</th>';
	echo '<th width="3%">Atestado</th>';
	echo '</tr>';
	
		//lista os funcionarios	 
		$i = 1;
		$listar_funcionarios = @mysql_query("select *, rh_horaextra.funcionario as func from rh_horaextra INNER JOIN rh_funcionarios ON rh_funcionarios.id = rh_horaextra.funcionario WHERE (rh_horaextra.data between '$inicial' and '$final') and rh_funcionarios.obra in($obu) and rh_funcionarios.demissao = '0000-00-00' and rh_funcionarios.admissao <> '0000-00-00' and rh_funcionarios.situacao in($sta) group by funcionario order by rh_funcionarios.nome asc");
		while($l = mysql_fetch_array($listar_funcionarios)) { extract($l);
		
			echo '<tr class="small">';	
			echo '<td>'.$i++.'</td>';
			echo '<td>'.$nome.'</td>';
			

			$faltas = mysql_result(mysql_query("select *, sum(falta) as faltas from rh_horaextra where (data between '$inicial' and '$final') and funcionario = '$func' and falta = '1'"),0,"faltas");
			
			$atestado= mysql_result(mysql_query("select *, sum(falta) as faltas from rh_horaextra where data between '$inicial' and '$final' and funcionario = '$func' and falta = '2'"),0,"faltas");
			
			$listar_datas = mysql_query("select * from rh_horaextra where (data between '$inicial' and '$final') group by data order by data asc");
		
			while($l = mysql_fetch_array($listar_datas)) { 

				$hr = @mysql_result(mysql_query("select * from rh_horaextra where data = '".$l['data']."' and funcionario = '$func'"),0,"hora_extra");
				$faltas2 = mysql_result(mysql_query("select *, sum(falta) as faltas from rh_horaextra where data = '".$l['data']."' and funcionario = '$func' and falta = '1'"),0,"faltas");
				$atestado2 = mysql_result(mysql_query("select *, sum(falta) as faltas from rh_horaextra where data = '".$l['data']."' and funcionario = '$func' and falta = '2'"),0,"faltas");
				if($hr=='') { 
					$hr = '0.00'; 
				}
				if($faltas2 != ''){
					$class_faltas = 'btn-danger';
					$hr = '<small style="font-size:8px;">FALTA</small>'; 
				}else if ($atestado2 != ''){
					$class_faltas = 'btn-primary';
					$hr = '<small style="font-size:8px;">ATESTADO</small>'; 
				}else{
					$class_faltas = '';
				}
				echo '<th class="'.$class_faltas.'" style="text-align:center">'.$hr.'</th>';
			}	
			echo '<th style="text-align:center">'.($faltas == 0 ? '0' : $faltas).'</th>';
			echo '<th style="text-align:center">'.($atestado/2).'</th>'; //PROVISORIO / MELHOR FORMA COM ---- MYSQL_NUM_ROWS
			echo '</tr>';	
		}
		
	echo '</table>';	
	exit;
}
if($relatorio==2){
	foreach($ob as $obs) { @$obu .= $obs.','; } $obu = substr($obu,0,-1);
	foreach($st as $sts) { @$sta .= $sts.','; } $sta = substr($sta,0,-1);
	//INICIAL
	$mes_inicial = date('m', strtotime($inicial)); $ano_inicial = date('Y', strtotime($inicial));
	$ultimo_dia_inicial = date("t", mktime(0,0,0,$mes_inicial,'01',$ano_inicial));
	$fim_inicial = $ano_inicial.'-'.$mes_inicial.'-'.$ultimo_dia_inicial;
	//FINAL
	$mes_final = date('m', strtotime($final)); $ano_final = date('Y', strtotime($final));
	$ultimo_dia_final = date("t", mktime(0,0,0,$mes_final,'01',$ano_final));
	$inicio_final = $ano_final.'-'.$mes_final.'-01';

	echo '<table class="hidden-xs hidden-lg hidden-md visible-print" width="100%" style="margin-bottom:40px;">';
			echo '<tr>
				<td style="padding:10px; text-align:center" width="10%"><img src="http://guaruja.polemicalitoral.com.br/imagens/logo.png" alt="Logo Polemica" width="50px" /></td>
				<td style="font-size:11px; padding-left:20px;" width="95%">
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
						RELATÓRIO DE HORAS EXTRAS - RESUMIDO
					</h3>
					<p style="text-align:center;  font-size:14px;"><small>Período: '.implode("/",array_reverse(explode("-",$inicial))).' á '.implode("/",array_reverse(explode("-",$final))).'</small></p>
				</p>
				<p style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center; padding-bottom:10px;">
					';
					$obra_controle = mysql_query("SELECT * FROM notas_obras WHERE id IN($obu)");
					while($c = mysql_fetch_array($obra_controle)){
						echo $c['descricao'].'<br/>';
					}
					echo '
				</p>
			';

	echo '<table class="table table-striped small">';
	switch ($mes_inicial) {
        case "01":    $mes_nome_i = "Janeiro";     break;
        case "02":    $mes_nome_i = "Fevereiro";   break;
        case "03":    $mes_nome_i = "Março";       break;
        case "04":    $mes_nome_i = "Abril";       break;
        case "05":    $mes_nome_i = "Maio";        break;
        case "06":    $mes_nome_i = "Junho";       break;
        case "07":    $mes_nome_i = "Julho";       break;
        case "08":    $mes_nome_i = "Agosto";      break;
        case "09":    $mes_nome_i = "Setembro";    break;
        case "10":    $mes_nome_i = "Outubro";     break;
        case "11":    $mes_nome_i = "Novembro";    break;
        case "12":    $mes_nome_i = "Dezembro";    break; 
	}
	switch ($mes_final) {
        case "01":    $mes_nome_f = "Janeiro";     break;
        case "02":    $mes_nome_f = "Fevereiro";   break;
        case "03":    $mes_nome_f = "Março";       break;
        case "04":    $mes_nome_f = "Abril";       break;
        case "05":    $mes_nome_f = "Maio";        break;
        case "06":    $mes_nome_f = "Junho";       break;
        case "07":    $mes_nome_f = "Julho";       break;
        case "08":    $mes_nome_f = "Agosto";      break;
        case "09":    $mes_nome_f = "Setembro";    break;
        case "10":    $mes_nome_f = "Outubro";     break;
        case "11":    $mes_nome_f = "Novembro";    break;
        case "12":    $mes_nome_f = "Dezembro";    break; 
	}
	//lista as datas 
	echo '<thead>';
		echo '<tr>
			<th style="text-align: center;"><span class="glyphicon glyphicon-eject"></span></th>
			<th style="text-align: center;">Nome</th>
			<th style="text-align: center;">Faltas Horas</th>
			<th style="text-align: center;">Faltas Dias</th>
			<th style="text-align: center;">DSR</th>
			<th style="text-align: center;">FINAL <br/>'.$mes_nome_i.'<br/> 50%</th>
			<th style="text-align: center;">INICIO <br/>'.$mes_nome_f.'<br/> 50%</th>
			<th style="text-align: center;">FINAL <br/>'.$mes_nome_i.'<br/> 100%</th>
			<th style="text-align: center;">INICIO <br/>'.$mes_nome_f.'<br/> 100%</th>
			<th style="text-align: center;">TOTAL <br/>'.substr($mes_nome_f,0,3).' / '.substr($mes_nome_i,0,3).'<br/> 50%</th>
			<th style="text-align: center;">TOTAL <br/>'.substr($mes_nome_f,0,3).' / '.substr($mes_nome_i,0,3).'<br/> 100%</th>
			<th style="text-align: center;">PAGAMENTO OU DESCONTOS</th>
		</tr>';
	echo '</thead><tbody>';
		//lista os funcionarios	 
		
		$listar_funcionarios = mysql_query("SELECT rh_funcionarios.nome, rh_horaextra.funcionario as id_func, rh_horaextra.data, SUM(rh_horaextra.dsr) as dsrTotal, SUM(rh_horaextra.falta_hora) as falta_hora_total FROM rh_horaextra INNER JOIN rh_funcionarios ON rh_horaextra.funcionario = rh_funcionarios.id WHERE (rh_horaextra.data between '$inicial' and '$final') and rh_funcionarios.obra in($obu) and rh_funcionarios.demissao = '0000-00-00' and rh_funcionarios.admissao <> '0000-00-00' and rh_funcionarios.situacao in($sta) GROUP BY rh_horaextra.funcionario ORDER BY rh_funcionarios.nome asc");
	
		while($l = mysql_fetch_array($listar_funcionarios)) { extract($l);
			
			// TOTAL 50%
			$final_50 = @mysql_result(mysql_query("SELECT SUM(rh_horaextra.hora_extra) as total_horaExtra FROM rh_horaextra INNER JOIN rh_funcionarios ON rh_horaextra.funcionario = rh_funcionarios.id WHERE rh_horaextra.funcionario = $id_func and (rh_horaextra.data between '$inicial' and '$fim_inicial') AND porcentagem = '50' AND rh_funcionarios.obra in($obu) and rh_funcionarios.demissao = '0000-00-00' and rh_funcionarios.admissao <> '0000-00-00' and rh_funcionarios.situacao in($sta) group by rh_horaextra.funcionario "),0,"total_horaExtra");

			$inicio_50 = @mysql_result(mysql_query("SELECT SUM(rh_horaextra.hora_extra) as total_horaExtra FROM rh_horaextra INNER JOIN rh_funcionarios ON rh_horaextra.funcionario = rh_funcionarios.id WHERE rh_horaextra.funcionario = $id_func and (rh_horaextra.data between '$inicio_final' and '$final') and porcentagem = '50' and rh_funcionarios.obra in($obu) and rh_funcionarios.demissao = '0000-00-00' and rh_funcionarios.admissao <> '0000-00-00' and rh_funcionarios.situacao in($sta) group by rh_horaextra.funcionario "),0,"total_horaExtra");
			
			// TOTAL 100%
			$final_100 = @mysql_result(mysql_query("SELECT SUM(rh_horaextra.hora_extra) as total_horaExtra FROM rh_horaextra INNER JOIN rh_funcionarios ON rh_horaextra.funcionario = rh_funcionarios.id WHERE rh_horaextra.funcionario = $id_func and (rh_horaextra.data between '$inicial' and '$fim_inicial') AND porcentagem = '100' AND rh_funcionarios.obra in($obu) and rh_funcionarios.demissao = '0000-00-00' and rh_funcionarios.admissao <> '0000-00-00' and rh_funcionarios.situacao in($sta) group by rh_horaextra.funcionario "),0,"total_horaExtra");

			$inicio_100 = @mysql_result(mysql_query("SELECT SUM(rh_horaextra.hora_extra) as total_horaExtra FROM rh_horaextra INNER JOIN rh_funcionarios ON rh_horaextra.funcionario = rh_funcionarios.id WHERE rh_horaextra.funcionario = $id_func and (rh_horaextra.data between '$inicio_final' and '$final') and porcentagem = '100' and rh_funcionarios.obra in($obu) and rh_funcionarios.demissao = '0000-00-00' and rh_funcionarios.admissao <> '0000-00-00' and rh_funcionarios.situacao in($sta) group by rh_horaextra.funcionario "),0,"total_horaExtra");
			
			// FALTAS
			
			$faltaTotal = @mysql_result(mysql_query("SELECT SUM(rh_horaextra.falta) as total_falta FROM rh_horaextra INNER JOIN rh_funcionarios ON rh_horaextra.funcionario = rh_funcionarios.id WHERE rh_horaextra.funcionario = $id_func and (rh_horaextra.data between '$inicial' and '$final') and falta = '1' and rh_funcionarios.obra IN($obu) and rh_funcionarios.demissao = '0000-00-00' and rh_funcionarios.admissao <> '0000-00-00' and rh_funcionarios.situacao in($sta) group by rh_horaextra.funcionario"),0,"total_falta");
			
			$obsInfo = @mysql_result(mysql_query("SELECT obs FROM rh_horaextra WHERE funcionario = '$id_func' and obs <> '' AND (rh_horaextra.data between '$inicial' and '$final') ORDER BY data DESC"),0,"obs");
			
			//TOTAL SOMA DOS MESES
			$total_50 = $final_50 + $inicio_50;
			$total_100 = $inicio_100 + $final_100;
			$ct += 1;
			echo '<tr class="small">';	
			echo '<td style="width:3%">'.$ct.'</td>';
			echo '<td>'.$nome.'</td>';
			echo '<td class="text-center">'.($falta_hora_total == '' ? '0' : $falta_hora_total).'</td>';
			echo '<td class="text-center">'.($faltaTotal == '' ? '0' : $faltaTotal).'</td>';
			echo '<td class="text-center">'.($dsrTotal == '' ? '0' : $dsrTotal).'</td>';
			echo '<td class="text-center">'.($final_50 == '' ? '0' : $final_50).'</td>';
			echo '<td class="text-center">'.($inicio_50 == '' ? '0' : $inicio_50).'</td>';
			echo '<td class="text-center">'.($final_100 == '' ? '0' : $final_100).'</td>';
			echo '<td class="text-center">'.($inicio_100 == '' ? '0' : $inicio_100).'</td>';
			echo '<td class="text-center">'.($total_50 == '' ? '0' : $total_50).'</td>';
			echo '<td class="text-center">'.($total_100 == '' ? '0' : $total_100).'</td>';
			echo '<td class="text-center">'.$obsInfo.'</td>';
			echo '</tr>';	

			
			$total_horas_g += $falta_hora_total;
			$total_faltas_g += $faltaTotal;
			$total_final_50_g += $final_50;
			$total_inicio_50_g += $inicio_50;
			$total_final_100_g += $final_100;
			$total_inicio_100_g += $inicio_100;
			$total_50_g += $total_50;
			$total_100_g += $total_100;
			$totalDsr_g += $dsrTotal;
		}
	echo '</tbody>';
		echo '<tr style="font-weight:bold; font-size:13px; text-align:center">';
			echo '<td colspan="2">TOTAL</td>';
			echo '<td>'.$total_horas_g.'</td>';
			echo '<td>'.$total_faltas_g.'</td>';
			echo '<td>'.$totalDsr_g.'</td>';
			echo '<td>'.$total_final_50_g.'</td>';
			echo '<td>'.$total_inicio_50_g.'</td>';
			echo '<td>'.$total_final_100_g.'</td>';
			echo '<td>'.$total_inicio_100_g.'</td>';
			echo '<td>'.$total_50_g.'</td>';
			echo '<td>'.$total_100_g.'</td>';
			echo '<td> </td>';
			
		echo '</tr>';
	echo '</table>';
	exit;

}
}

?>
<div class="hidden-print" style="clear: both;">
	<h3 style="font-family: 'Oswald', sans-serif;letter-spacing:5px;"> 
		<p>RELATORIO <small>HORAS EXTRAS</small></p>
	</h3>
	<a href="javascript:window.print()" style="letter-spacing:5px; position:relative; bottom:10px;" class="hidden-xs hidden-print pull-right btn btn-warning btn-sm"> <span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Imprimir</a>
</div>
<div class="hidden-print" style="clear: both;">
	<hr></hr>
</div>
	<div class="well well-sm hidden-print" style="padding:10px 10px 5px 10px;">
	<form action="javascript:void(0)" onSubmit="post(this,'rh/relatorio-he-geral.php?ac=resultado','.retorno')">
		<label for=""><small>Tipo:</small><br/>
					<select class="form-control input-sm" name="relatorio" required>
						<option value="" selected disabled>Selecione uma opção</option>
						<option value="1" <?php if($controle == 1){ echo 'selected';} ?>>DETALHADA</option>
						<option value="2" <?php if($controle == 2){ echo 'selected';} ?>>RESUMIDA</option>
					</select>
		</select>
		</label>
		<label for=""><small>Periodo:</small> 
			<input type="date" name="inicial" value="<?php echo $inicioMes;?>" class="detalhada form-control input-sm" size="10" placeholder="Inicial" required/>
		</label>
				<label for="">
					<input type="date" name="final" value="<?php echo $todayTotal; ?>" class="detalhada form-control input-sm" size="10" placeholder="Final" size="8" required/>
				</label>
		<label for=""><small>Situação:</small><br/><select name="st[]" class="sel" multiple="multiple">
			<option value="0"> SEM SITUACAO </option>
		<?php
			$situacao = mysql_query("select * from rh_situacao order by descricao asc");
			while($l = mysql_fetch_array($situacao)) { extract($l);
				echo '<option value="'.$id.'" selected>'.$descricao.'</option>';
			}
		?>		
		</select>
		</label>
		<label for=""><small>Obra:</small><br/><select name="ob[]" class="sel" multiple="multiple">
			<?php
				$obras = mysql_query("select * from  notas_obras WHERE id IN($obra_usuario) order by descricao asc"); 
							while($l = mysql_fetch_array($obras)) { extract($l);
								echo '<option value="'.$id.'" selected>'.$descricao.'</option>';
							}
			?>		
		</select>
		</label>
		<label for=""><input type="submit" style="width:150px; margin-left:5px;" class="btn btn-success btn-sm" value="Filtrar" /></label>	
	</form>
	</div>
	<div class="retorno"></div>
	