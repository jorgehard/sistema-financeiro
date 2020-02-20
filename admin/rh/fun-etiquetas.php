<?php
	include("../config.php");
	include("../validar_session.php");
	getData();
	getNivel();
	
	$mesnum = $today["mon"];
	if(!isset($pg)){$pg = 1;}
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
<script>
  $(document).ready(function() {
    $("#btnPrint").printPage();
	
	$("#campoAno").mask("9999");
  });
</script>
<style type="text/css">
@media all {
	.etiqueta{
		font-weight:bold;
		text-align:center;
		font-size:13px;
		margin:10px;
		padding:10px;
		width:101.60mm;
		height:33.90mm;
		background:#fcf9f9;
	}
}

@media print{
	.etiqueta{
		margin: 0 auto;
		margin:5px !important;
		margin-right:5px !important;
	}
}
</style>
<?php 
if(@$ac == 'localizar') { 
	foreach($st as $sts) { @$stu .= $sts.','; } $stu = substr($stu,0,-1);
	foreach($ob as $obs) { @$obu .= $obs.','; } $obu = substr($obu,0,-1);
	foreach($funcionario as $fus) { @$fuu .= $fus.','; } $fuu = substr($fuu,0,-1);
	
	$mes = $meses_numero[$mess];
	$quantidade = 14;
	$total_num = mysql_num_rows(mysql_query("select *,equipes.obra as obra_eq, rh_funcionarios.obra as obra_fun from equipes, rh_funcionarios where equipes.id = rh_funcionarios.equipe and rh_funcionarios.situacao in ($stu) and rh_funcionarios.obra in ($obu) and rh_funcionarios.nome LIKE '%$busca%' AND rh_funcionarios.id in ($fuu) ORDER BY rh_funcionarios.nome"));
	$total_paginas = ceil($total_num/14);
	
	for($pg = 1; $pg <= $total_paginas; $pg++){
		$inicio = ($pg * $quantidade) - $quantidade;
		$topo = mysql_query("select *,equipes.obra as obra_eq, rh_funcionarios.obra as obra_fun from equipes, rh_funcionarios where equipes.id = rh_funcionarios.equipe and rh_funcionarios.situacao in ($stu) and rh_funcionarios.obra in ($obu) and rh_funcionarios.nome LIKE '%$busca%' AND rh_funcionarios.id in ($fuu) ORDER BY rh_funcionarios.nome LIMIT $inicio, $quantidade") or die (mysql_error());
		echo '<div class="row" style="page-break-before: always; margin:0 auto;">';
		while ($l = mysql_fetch_array($topo)) { extract($l);
			echo '<div class="col-xs-6" style="margin-bottom:12px;">';
			echo '<center><table class="etiqueta" style="border-radius:10px;">';
				echo '  
					<tr><td>Polêmica Serviços Básicos LTDA</td></tr>
					<tr><td>CNPJ: 61.870.101/0001-08</td></tr>
					<tr><td>Obra: <small>'.mysql_result(mysql_query("select * from notas_obras where id = $obra_fun"),0,"descricao").'</small> Ref. '.$mes.'/'.$ano.'</td></tr>
					<tr><td>Nome: '.$nome.'</td></tr>
					<tr><td>Função: <small>'.mysql_result(mysql_query("select * from rh_funcoes where id = $funcao"),0,"descricao").'</small></td></tr>
					<tr><td>Horario: Seg. a Qui. '.$trabalho_entrada.' as '.$trabalho_saida.' Sex. '.$sexta_entrada.' as '.$sexta_saida.'</td></tr>
					<tr><td>Descanso/Almoço: '.implode("as",explode("-",$trabalho_refeicao)).'</td></tr>';
			echo '</table></center>';
			echo '</div>';
		}
		echo '</div>';
	}
	
	exit;
} 
?>


	<div class="container-fluid hidden-print" style="padding:0px 0px 15px 0px; margin-bottom:20px; border-bottom:1px solid #CCC">
		<img src="../imagens/logo.png" class="img-responsive" width="50px" style="float:left; margin-right:20px"/>
		<h3 style="font-family: 'Oswald', sans-serif; letter-spacing:5px;"> 
			IMPRESSÃO DE <small><b>ETIQUETAS</b></small>
			<a href="javascript:window.print()" style="letter-spacing:8px; padding-left:40px; padding-right:40px;" class="hidden-xs hidden-print pull-right btn btn-warning btn-sm"> <span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Imprimir</a>
		</h3>
	</div>
	<div class="well well-sm hidden-print" style="padding:10px 10px 5px 10px;">
		<form action="javascript:void(0)" onsubmit="post(this,'rh/fun-etiquetas.php?ac=localizar','.retorno')">
			<div class="container-fluid" style="padding:0px">
				<div class="col-xs-2" style="padding:2px">
					<label style="width:100%"><small>Obra:</small><br/>
						<select name="ci[]" onChange="$('#item-consulta-obra').load('../functions/functions-load.php?atu=funcionario_cont&cidade=' + $(this).val() + '');" class="sel" multiple="multiple" required>
							<?php
							$cidade = mysql_query("select * from notas_obras_cidade WHERE id IN(0,$cidade_usuario) order by nome asc");
							while($l = mysql_fetch_array($cidade)) {
								echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>';
							}
							?>	
						</select>
					</label>
				</div>
				<div id="item-consulta-obra" style="padding:0px">
					<div class="col-xs-2" style="padding:2px">
							<label style="width:100%"><small>Contrato:</small><br/>
								<select name="ob[]" class="sel" multiple="multiple">
									<option value="">Selecione uma obra</option>	
								</select>
							</label>
					</div>
					<div class="col-xs-3" style="padding:2px">
						<label style="width:100%"><small>Selecione o funcionário:</small>
							<select name="funcionario[]" class="sel" multiple="multiple" >
								<option value="">Selecione uma obra</option>	
							</select>
						</label>
					</div>
				</div>
				<div class="col-xs-2" style="padding:2px">
					<label style="width:100%"><small>Situação:</small> <br/>
					<select name="st[]" class="sel" multiple="multiple">
						<option value="0"> SEM SITUACAO </option>
						<?php 
								$situacaos = mysql_query("select * from  rh_situacao order by descricao asc"); 
								while($l=mysql_fetch_array($situacaos)) {
									if($l['id']=='6') { 
									echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>'; }
									else { echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>'; } 	
									}  	
						?>	
					</select>
					</label>
				</div>
				<div class="col-xs-1" style="padding:2px">
					<label style="width:100%"><small>Mês:</small>
						<select name="mess" class="form-control input-sm">
						<?php
						$m = 1;
						while($m <= 12){
							if($m == $mesnum){
							echo '<option value="'.$m.'" selected>'.strtoupper($meses_numero[$m]).'</option>';
							}else{
							echo '<option value="'.$m.'">'.strtoupper($meses_numero[$m]).'</option>';
							}$m += 1;
						}
						
						?>
						</select>
					</label>
				</div>
				<div class="col-xs-1" style="padding:2px">
					<label style="width:100%"><small>Ano:</small> 
						<input type="text" id="campoAno" value="<?php echo $today['year'] ?>" name="ano" placeholder="" maxlength="4" class="form-control input-sm" />
					</label>
				</div>
				<div class="col-xs-1" style="padding:2px;">
					<label class="pull-right" style="width:100%"><br/>
						<input type="submit" value="Pesquisar" style="width:100%" class="btn btn-success btn-sm">
					</label>
				</div>
			</div>
		</form>
	</div>

<div class="retorno"></div>