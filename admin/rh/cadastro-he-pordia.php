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
<?php 
if(@$ac == 'inserir') {
	$hora_extra = str_replace(",",".",$hora_extra);

	foreach ($ids as $key => $id){
		if($hora_extra[$key] >= '6.50'){ $beneficio[$key] = '1'; } else { $beneficio[$key] = '0'; }
		mysql_query("update rh_horaextra set hora_extra = '$hora_extra[$key]', porcentagem = '$porcentagem[$key]', beneficio = '$beneficio[$key]', falta = '$falta[$key]', obs = '$obsinfo[$key]', dsr = '$dsr[$key]', falta_hora = '$falta_hora[$key]' where id = '$ids[$key]'");
	}
	echo '<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-floppy-saved"></span> Informações salvas com sucesso!</div>';
	exit;
}

if(@$ac=='resultado') {
	$data = implode("-",array_reverse(explode("/",$data)));
	foreach($funcionario as $funcs) {
		if(mysql_num_rows(mysql_query("select * from rh_horaextra where funcionario = '$funcs' and data = '$data'")) == 0) { 
			if(date('w',strtotime($data)) == 0) { 
				$porcentagem = '100'; 
			} else { 
				$porcentagem = '50'; 
			}
			mysql_query("insert into rh_horaextra (data,porcentagem,beneficio,funcionario) values ('$data','$porcentagem','0','$funcs')");
		}
		@$func .= $funcs. ',';
	}
	
	$func = substr($func,0,-1);
	echo '<form action="javascript:void(0)" onSubmit=\'post(this,"rh/cadastro-he-pordia.php?ac=inserir",".ajax")\'>';
	
	echo '<table class="table table-condensed table-striped table-color" style="font-size:11px">';
	echo'<thead><tr>
	<th class="text-center"><small>Data</small></th>
	<th class="text-center"><small>Funcionário</small></th>
	<th class="text-center"><small>H/E</small></th>
	<th class="text-center"><small>%</small></th>
	<th class="text-center"><small>Falta</small></th>
	<th class="text-center"><small>DSR</small></th>
	<th class="text-center"><small>Hora Falta</small></th>
	<th class="text-center"><small>Benefício</small></th>
	<th class="text-center"><small>Obs</small></th>
	</tr></thead><tbody>';
	$sql = mysql_query("select *, rh_horaextra.obs as obsinfo, rh_horaextra.id as id_hr from rh_horaextra, rh_funcionarios where rh_funcionarios.id = rh_horaextra.funcionario and rh_horaextra.funcionario IN ($func) and rh_horaextra.data = '$data' order by rh_funcionarios.nome asc");
	while($l = mysql_fetch_array($sql)) { extract($l);
		
		echo '<input type="hidden" name="ids[]" value="'.$id_hr.'">';
		echo '<tr>';
		echo '<td class="text-center">'.implode("/",array_reverse(explode("-",$data))).'</td>';
		echo '<td>'.mysql_result(mysql_query("select * from rh_funcionarios where id = $funcionario"),0,"nome").'</td>';
		echo '<td width="6%"><input type="number" step="0.01" class="form-control input-sm" name="hora_extra[]" value="'.$hora_extra.'" required /></td>';
		echo '<td width="10%">
		<select name="porcentagem[]" class="form-control input-sm"> 
			<option value="">Selecione uma opção</option>';
			if($porcentagem==50) { 
				echo '<option value="50" selected> 50% </option> <option value="100"> 100% </option>'; 
			} else { 
				echo '<option value="50"> 50% </option> <option value="100" selected> 100% </option>'; 
			}
		echo '</select></td>';
		echo '<td width="10%">
		<select name="falta[]" class="form-control input-sm" required> 
			<option value="">Selecione uma opção</option>';
			if($falta == 0) { 
				echo '
					<option value="0" selected>HORA</option>
					<option value="1">FALTA</option>
					<option value="2">ATESTADO</option>'; 
			} elseif($falta==1) { 
				echo '
				<option value="0">HORA</option>
				<option value="1" selected>FALTA</option>
				<option value="2">ATESTADO</option>';
			} else { 
				echo '
				<option value="0">HORA</option>
				<option value="1">FALTA</option>
				<option value="2" selected>ATESTADO</option>
				'; 
			}
						 
		echo '</select></td>';
		echo '<td width="6%"><input type="number" step="1" class="form-control input-sm" name="dsr[]" value="'.$dsr.'" /></td>';
		echo '<td width="6%"><input type="text" onfocus="$(this).mask(\'9.99\')" class="form-control input-sm" name="falta_hora[]" value="'.$falta_hora.'" required /></td>';
		echo '<td width="10%"><select name="beneficiso" class="form-control input-sm" disabled>';
			if($beneficio == 0) { 
				echo '<option value="0" selected>NÃO</option>'; 
			}else if($beneficio == 1){
				echo '<option value="1" selected>SIM</option>'; 
			}			
						 
		echo '</select></td>';
		echo '<td width="20%"><input type="text" class="form-control input-sm" name="obsinfo[]" value="'.$obsinfo.'" /></td>';
		echo '</tr>';
	}
	echo '</tbody>';
	echo '</table>';
	
	echo '<div style="text-align:center;"><input type="submit" value="Salvar" class="btn btn-success btn-sm" style="width:40%; margin-top:20px; height:40px"/></div></form>';
		
	exit;	
} 


?>

<div class="container-fluid" style="padding:0px 0px 15px 0px; margin-bottom:20px; border-bottom:1px solid #CCC">
		<img src="../imagens/logo.png" class="img-responsive" width="50px" style="float:left; margin-right:20px"/>
		<h3 style="font-family: 'Oswald', sans-serif; letter-spacing:5px;"> 
			CADASTRO DE <small><b>HORA EXTRA</b></small>
		</h3>
</div>
	<div class="well well-sm hidden-print" style="padding:10px 10px 5px 10px;">
		<form action="javascript:void(0)" onSubmit="posti(this,'rh/cadastro-he-pordia.php?ac=resultado','.ajax');" class="form-inline">
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
					<div class="col-xs-2" style="padding:2px">
						<label style="width:100%"><small>Selecione o funcionário:</small>
							<select name="funcionario[]" class="sel" multiple="multiple" >
								<option value="">Selecione uma obra</option>	
							</select>
						</label>
					</div>
				</div>
				<div class="col-xs-2" style="padding:2px">
					<label style="width:100%"><small>Escolha uma data:</small>
						<input type="date" name="data" class="form-control input-sm" style="width:100%" required/>
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
	
	<div class="ajax"></div>
	<div class="retorno"></div>