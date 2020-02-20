<?php
	include("../config.php");
	include("../validar_session.php");
	getData();
	getNivel();
?>
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
});
</script>
<style>
	@media print
	{
		table, tr, thead, tbody, td, th{
			border:1px solid rgba(23, 23, 23, 0.6) !important;
		}
	}
	tr.refeicao td { 
		padding:10px 0px 10px 0px !important;
	}
</style>
<?php
if(@$ac=='resultado') {
	
	if($tipo==2) {
		foreach($st as $sts) { @$sta .= $sts.','; } $sta = substr($sta,0,-1);
		foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);
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
						DECLARAÇÃO DE RECEBIMENTO DE VALE REFEIÇÃO
					</h3>
					<p style="text-align:center;  font-size:14px;"><small>Período: '.implode("/",array_reverse(explode("-",$inicial))).' á '.implode("/",array_reverse(explode("-",$final))).'</small></p>
				</p>
				<p style="text-align:center">
					Declaramos que recebemos individualmente os valores abaixo relacionados referente ao Vale Refeição a ser utilizado no mês de<br/>
					<b>'.$mes_p.' de '.$ano[0].'</b>
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
			

		echo '<table class="table table-striped table-condensed small">';
		echo '	<tr>
					<th style="text-align:center">Qtde.</th>
					<th>Nome</th>
					<th style="text-align:center">Dias Uteis</th>
					<th style="text-align:center">Valor Diario</th>
					<th style="text-align:center">Total</th>
					<th style="text-align:center">Assinatura</th>
				</tr>';
		
		$sql = mysql_query("select * from rh_funcionarios where demissao = '0000-00-00' and categoria = '0' and situacao in($sta) AND obra IN($oba) order by nome asc");

		while($l = mysql_fetch_array($sql)) { extract($l);
			$i += 1;
			$dias_adicionais = mysql_result(mysql_query("select *, count(id) as total from rh_horaextra where (data between '$inicial' and '$final') and funcionario = '$id' and porcentagem <> 0 and hora_extra <> '0.00' and beneficio = 1"),0,"total");
		
			$faltas = mysql_result(mysql_query("select *, count(id) as total from rh_horaextra where (data between '$inicial' and '$final') and funcionario = '$id' and falta IN(1,2)"),0,"total");
		
			$dias_uteis = ($du+$dias_adicionais)-$faltas;

			$total = $dias_uteis*$vale_refeicao;
		
			echo '<tr class="small refeicao">';
			echo '<td style="text-align:center">'.$i.'</td>';	
			echo '<td>&nbsp;&nbsp;'.$nome.'</td>';	
			echo '<td style="text-align:center">'.$dias_uteis.'</td>';	
			echo '<td style="text-align:center">R$ '.number_format($vale_refeicao,"2",",",".").'</td>';	
			echo '<td style="text-align:center">R$ '.number_format($total,"2",",",".").'</td>';	
			echo '<td width="400px"></td>';	
			$dias_uteis_g += $dias_uteis;
			$total_g += $total;
			echo '</tr>';	
		}
		echo '<tr>';
			echo '<td colspan="2" style="text-align:center"><b>Total:</b></td>';
			echo '<td style="text-align:center"><b>'.$dias_uteis_g.'</b></td>';
			echo '<td style="text-align:center" colspan="2"><b>R$ '.number_format($total_g,"2",",",".").'</b></td>';
			echo '<td></td>';
		
		echo '</tr>';
		echo '</table>';
		exit;
	}	
	if($tipo==3) {
		foreach($st as $sts) { @$sta .= $sts.','; } $sta = substr($sta,0,-1);
		foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);
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
						DECLARAÇÃO DE RECEBIMENTO DE VALE ALIMENTAÇÃO
					</h3>
					<p style="text-align:center;  font-size:14px;"><small>Período: '.implode("/",array_reverse(explode("-",$inicial))).' á '.implode("/",array_reverse(explode("-",$final))).'</small></p>
				</p>
				<p style="text-align:center">
					Declaramos que recebemos individualmente os valores abaixo relacionados referente ao Vale Alimentação a ser utilizado no mês de<br/>
					<b>'.$mes_p.' de '.$ano[0].'</b>
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
		echo '<table class="table table-striped table-condensed small">';
		echo '<tr class="small">
				<th style="text-align:center">Qtde.</th>
				<th>Nome</th>
				<th style="text-align:center">Valor Total</th>
				<th style="text-align:center">Assinatura</th>';
		echo '</tr>';
		$sql = mysql_query("select * from rh_funcionarios where situacao in($sta) AND obra IN($oba) order by nome asc");

		while($l = mysql_fetch_array($sql)) { extract($l);
			$i += 1;
			
			$dias_adicionais = mysql_result(mysql_query("select *, count(id) as total from rh_horaextra where (data between '$inicial' and '$final') and funcionario = '$id' and porcentagem <> 0 and hora_extra <> '0.00' and beneficio = 1"),0,"total");
		
			$faltas = mysql_result(mysql_query("select *, count(id) as total from rh_horaextra where (data between '$inicial' and '$final') and funcionario = '$id' and falta IN(1)"),0,"total");
		
			$dias_uteis = ($du+$dias_adicionais)-$faltas;
			$du_controle = $du - 3;
				echo '<tr>';
				echo '<td style="text-align:center">'.$i.'</td>';	
				echo '<td>'.$nome.'</td>';	
				if($dias_uteis >= $du_controle){
					echo '<td style="text-align:center">R$ '.number_format($vale_alimentacao,"2",",",".").'</td>';	
					$total_g += $vale_alimentacao;
				}else{
					echo '<td style="text-align:center"> - </td>';	
				}
				echo '<td width="400px"></td>';	
				echo '</tr>';
		}
		echo '<tr>';
			echo '<td colspan="2" style="text-align:center"><b>Total:</b></td>';
			echo '<td style="text-align:center"><b>R$ '.number_format($total_g,"2",",",".").'</b></td>';
			echo '<td></td>';
		
		echo '</tr>';
		echo '</table>';
		exit;
	}
}

?>

	<div class="container-fluid hidden-print" style="padding:0px 0px 15px 0px; margin-bottom:20px; border-bottom:1px solid #CCC">
		<img src="../imagens/logo.png" class="img-responsive" width="50px" style="float:left; margin-right:20px"/>
		<h3 style="font-family: 'Oswald', sans-serif; letter-spacing:5px;"> 
			RELATÓRIO DE<small><b> BENEFICIOS</b></small>
			<a href="javascript:window.print()" style="letter-spacing:8px; padding-left:40px; padding-right:40px;" class="hidden-xs hidden-print pull-right btn btn-warning btn-sm"> <span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Imprimir</a>
		</h3>
	</div>
	<div class="well well-sm hidden-print" style="padding:10px 10px 5px 10px;">
		<form action="javascript:void(0)" onSubmit="post(this,'rh/relatorio-beneficio.php?ac=resultado','.retorno')">
				<label for=""><small>De:</small> 
					<input type="date" name="inicial" value="<?php echo $inicioMes ?>" class="form-control input-sm"  required/>
				</label>
				<label for=""><small>Até:</small> 
					<input type="date" name="final" value="<?php echo $todayTotal ?>" class="form-control input-sm" required/>
				</label>
				<label style="margin-top:10px"><small>Obra:</small>
		<select name="ci[]" onChange="$('#itens').load('rh/relatorio-funcionarios.php?atu=ac&su=1&cidade=' + $(this).val() + '');" style="width:250px;" class="form-control input-sm" required> 
			<option value="">Selecione uma obra</option>
			<?php
				$cidade = mysql_query("select * from notas_obras_cidade WHERE id IN($cidade_usuario) order by nome asc");
				while($l = mysql_fetch_array($cidade)) {
					echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>';
				}
			?>	
		</select>
	</label>
	<label id="itens">
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
	</label>
		<label for=""><small>Situação:</small><br/>
					<select name="st[]" class="sel" multiple="multiple">
						<?php
							$situacao = mysql_query("select * from rh_situacao where status = '0' order by descricao asc");
							while($l = mysql_fetch_array($situacao)) { extract($l);
								echo '<option value="'.$id.'" selected>'.$descricao.'</option>';
							}
						?>		
					</select>
				</label>
				<label for=""><small>Mês:</small><br/>
					<select name="mes_p" class="form-control input-sm">
						<option value="Janeiro">Janeiro</option>
						<option value="Fevereiro">Fevereiro</option>
						<option value="Março">Março</option>
						<option value="Abril">Abril</option>
						<option value="Maio">Maio</option>
						<option value="Junho">Junho</option>
						<option value="Julho">Julho</option>
						<option value="Agosto">Agosto</option>
						<option value="Setembro">Setembro</option>
						<option value="Outubro">Outubro</option>
						<option value="Novembro">Novembro</option>
						<option value="Dezembro">Dezembro</option>
					</select>
				</label>
				<label style="width:5%"><small>Dias Úteis: </small>
					<input type="text" name="du" class="form-control input-sm" placeholder="Ex:20" required />
				</label>
				
				<label><small>Tipo: </small>
					<select name="tipo" class="form-control input-sm">
						<!--<option value="1"> Transporte </option>-->
						<option value="2"> Refeição </option>
						<option value="3"> Alimentação </option>
					</select>
				</label>
				<label>
					<input type="submit" class="btn btn-success btn-sm" value="Filtrar" style="width:200px; margin-left:5px" />
				</label>	
			</form>
		</div>
	</div>
	<div class="retorno"></div>