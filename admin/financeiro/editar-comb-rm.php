<?php
	include("../config.php");
	include("../validar_session.php");
	include("../../functions/function-print.php");
	getData();
	getNivel();
?>

<script src="../js/combobox-resume.js"></script>

<?php


	if(@$ac=='editar-rm') {
		$sql = mysql_query("UPDATE comb_rm SET `nota`='$nota', `km_inicial`='$km_inicial', `data`='$data', `equipe`='$equipe_fun', `data_ref`='$data_ref_fun' WHERE id = '$id'");
		if($sql) { 
			echo '<script>alert("Informações atualizadas com sucesso!");</script>'; 
		} 
		exit;
	}
	
	if(@$ac=='listar') {
		
		if(@$op=='inserir') {
			$data = implode("-",array_reverse(explode("/",$data)));
			$qtd = str_replace(",",".",$qtd); $vlr = str_replace(",",".",$vlr); 
			mysql_query("insert into comb_rm_itens (cod_rm, cupom, odometro, qtd, vlr, data, obs, funcionario, kmfinal) values ('$cod_rm', '$cupom', '$odometro', '$qtd', '$vlr', '$data', '$obs', '$funcionario', '$kmfinal')");
		
		}
		
		if(@$op=='del') { 
			mysql_query("delete from comb_rm_itens where id = $item"); 
		}
		
		echo '<table class="table table-bordered table-condensed table-striped table-green" style="font-size:11px">';
		echo '<thead><tr><th>Data</TH><th>Cupom</th><th>Qtd</th><th>Valor</th><th>Total</th><th>Odômetro</th><th class="text-center">Obs</th><th class="text-center">Funcionario</th><th class="text-center"><span class="glyphicon glyphicon-edit"></span> </th><th class="text-center"><span class="glyphicon glyphicon-trash"></span> </th></tr></thead><tbody>';
		$sql = mysql_query("select * from comb_rm_itens where cod_rm = '$cod_rm' order by id asc");
		while($l = mysql_fetch_array($sql)) { extract($l);
	
		$total = $qtd*$vlr;
		
		echo '<tr>';
		echo '<td>'.implode("/",array_reverse(explode("-",$data))).'</td>';
		echo '<td>'.$cupom.'</td>';
		echo '<td>'.number_format($qtd,"2").'</td>';
		echo '<td> R$ '.number_format($vlr,"2").'</td>';
		echo '<td>'.number_format($total,"2").'</td>';
		echo '<td>'.$l['kmfinal'].'</td>';
		if($obs==''){	
		echo '<td class="text-center">S/OBS</td>';
		}else{
		echo '<td class="text-center">'.$obs.'</td>';
		}
		echo '<td>'.mysql_result(mysql_query("SELECT * FROM rh_funcionarios WHERE id = ".$l['funcionario'].""),0,"nome").'</td>';
		echo '<td width="3%" class="text-center">';
		echo '<a href="#" onclick=\'$(".modal-body").load("financeiro/editar-nota-cupom.php?id_cupom='.$l['id'].'")\' data-toggle="modal" data-target="#myModal"  class="btn btn-info btn-xs" style="margin:0px; padding:5px;"><span class="glyphicon glyphicon-edit"></span></a>';
		echo '</td>';
		echo '<td width="3%" class="text-center"><a href="#" class="btn btn-danger btn-xs" style="margin:0px; padding:5px;" onclick=\'ldy("financeiro/editar-comb-rm.php?ac=listar&op=del&item='.$id.'&cod_rm='.$cod_rm.'",".ajax")\'><span class="glyphicon glyphicon-trash"></span></a></td>';
		echo '</tr>'; 
		
		}		
		echo '</tbody>';
		echo '</table>';
		
		exit;
	}
?>
<div style="margin-bottom:20px; width:100%">
	<a href="javascript:void(0)" style="font-family: 'Oswald', sans-serif; letter-spacing:5px; padding:5px 25px 5px 25px" onclick="ldy('financeiro/cadastrar-comb.php','.conteudo')" class="btn btn-primary btn-xs pull-right"> <span class="glyphicon glyphicon-plus"></span> Cadastrar Novo</a>
</div>

<h3 style="font-family: 'Oswald', sans-serif; letter-spacing:5px;" ><small> Editar/Adicionar Cupom de Combustivel</small></h3>

<form action="javascript:void(0)" class="formulario-info" onsubmit="post(this,'financeiro/editar-comb-rm.php?ac=editar-rm&id=<?php echo $cod_rm ?>','.resultado')">
<table class="table table-condensed table-bordered table-blue" style="font-size:10px">
	<thead>
		<tr>
			<th>Placa:</th><th>Nota</th><th>KM Inicial:</th><th>Data:</th><th>Equipe:</th><th>Mes:</th><th></th>
		</tr>
	</thead>
	<tbody>
	<tr>
		<?php
		$detalhes_rm = mysql_query("select * from comb_rm where id = $cod_rm");
		while($li = mysql_fetch_array($detalhes_rm)) {
			$obra_func = $li['obra'];
			$placa = mysql_result(mysql_query("select * from notas_equipamentos where id = ".$li['equipamento'].""),0,"placa");
			echo '<td>'.$placa.'</td>';
			echo '<td width="10%"><input type="text" name="nota" value="'.$li['nota'].'" class="form-control"></td>';
			echo '<td width="10%"><input type="text" name="km_inicial" value="'.$li['km_inicial'].'" class="form-control"></td>';
			echo '<td><input type="date" class="form-control input-sm" name="data" value="'.$li['data'].'" required></td>';
			
			$controle_ano = explode("-", $li['data']);
			echo '<td>		<select name="equipe_fun" class="form-control input-sm combobox" required>
			<option value="" disabled selected>SELECIONE UMA EQUIPE</option>';
			$equipe = mysql_query("select * from equipes order by nome asc");
			while($c = mysql_fetch_array($equipe)) {
				if($c['id'] == $li['equipe']){
					echo '<option value="'.$c['id'].'" selected>'.$c['nome'].'</option>';
				}else{
					echo '<option value="'.$c['id'].'">'.$c['nome'].'</option>';
				}
			}		
		echo '</select></td>';
			echo '<td>
			<select name="data_ref_fun" class="form-control input-sm" style="width: 100%" required>
			<option value="" disabled selected>SELECIONE O MÊS REFERENTE ('.$controle_ano[0].')</option>
			<option value="'.$controle_ano[0].'-01-01"'; if($li['data_ref'] == $controle_ano[0].'-01-01') { echo 'selected'; } echo '>JANEIRO</option>';
			echo '<option value="'.$controle_ano[0].'-02-01"'; if($li['data_ref'] == $controle_ano[0].'-02-01') { echo 'selected'; } echo '>FEVEREIRO</option>';
			echo '<option value="'.$controle_ano[0].'-03-01"'; if($li['data_ref'] == $controle_ano[0].'-03-01') { echo 'selected'; } echo '>MARÇO</option>';
			echo '<option value="'.$controle_ano[0].'-04-01"'; if($li['data_ref'] == $controle_ano[0].'-04-01') { echo 'selected'; } echo '>ABRIL</option>';
			echo '<option value="'.$controle_ano[0].'-05-01"'; if($li['data_ref'] == $controle_ano[0].'-05-01') { echo 'selected'; } echo '>MAIO</option>';
			echo '<option value="'.$controle_ano[0].'-06-01"'; if($li['data_ref'] == $controle_ano[0].'-06-01') { echo 'selected'; } echo '>JUNHO</option>';
			echo '<option value="'.$controle_ano[0].'-07-01"'; if($li['data_ref'] == $controle_ano[0].'-07-01') { echo 'selected'; } echo '>JULHO</option>';
			echo '<option value="'.$controle_ano[0].'-08-01"'; if($li['data_ref'] == $controle_ano[0].'-08-01') { echo 'selected'; } echo '>AGOSTO</option>';
			echo '<option value="'.$controle_ano[0].'-09-01"'; if($li['data_ref'] == $controle_ano[0].'-09-01') { echo 'selected'; } echo '>SETEMBRO</option>';
			echo '<option value="'.$controle_ano[0].'-10-01"'; if($li['data_ref'] == $controle_ano[0].'-10-01') { echo 'selected'; } echo '>OUTUBRO</option>';
			echo '<option value="'.$controle_ano[0].'-11-01"'; if($li['data_ref'] == $controle_ano[0].'-11-01') { echo 'selected'; } echo '>NOVEMBRO</option>';
			echo '<option value="'.$controle_ano[0].'-12-01"'; if($li['data_ref'] == $controle_ano[0].'-12-01') { echo 'selected'; } echo '>DEZEMBRO</option>';
		echo '</select>
			</td>';
			echo '<td><input type="submit" value="Salvar" style="width:150px" class="pull-right btn btn-success btn-sm"></td>';
		}
		?>
	</tr>
	</tbody>
</table>
</form>

<h3 style="font-family: 'Oswald', sans-serif; letter-spacing:5px;" ><small> Adicionar Itens ao Cupom</small></h3>
<form action="javascript:void(0)" class="formulario-info" onSubmit="post(this,'financeiro/editar-comb-rm-novo.php?ac=listar&op=inserir&cod_rm=<?php echo $cod_rm ?>','.ajax')">
	<table class="table table-bordered table-condensed table-striped table-blue" style="font-size:10px">
	<thead>
		<tr><th> Data</th><th> Cupom</th><th> Qtd</th><th> Valor</th><th> KM Final</th><th> Obs</th><th> Funcionário</th><th></th></tr>
	</thead>
	<tbody>
	<tr>
		<td style="width:10%"><label style="width:100%"><input type="date" class="form-control input-sm" name="data" required></label></td>
		<td style="width:10%"><label style="width:100%"><input type="text" name="cupom" class="form-control input-sm" /></label></td>
		<td style="width:10%"><label style="width:100%"><input type="number" step="any" style="width:100%; height:30px;" name="qtd" class="form-control input-sm" style="width:80px;" required></label></td>
		<td style="width:10%"><label style="width:100%"><input type="number" step="any"  style="width:100%; height:30px;" name="vlr" class="form-control input-sm" required></label></td>
		<td style="width:15%"><label style="width:100%"><input type="number" style="height:30px;" name="kmfinal" class="form-control" required/></label></td>
		<td style="width:20%"><label style="width:100%"><input type="text" name="obs" class="form-control input-sm" size="50" /></label></td>
		<td style="width:20%">
			<label style="width:100%">
				<select name="funcionario" class="form-control input-sm combobox">
					<option value="0">SEM FUNCIONARIO</option>
					<?php 
						$obra_fu = mysql_result(mysql_query("SELECT cidade FROM notas_obras WHERE id = $obra_func"),0,"cidade");
							
						$obra_cidade = mysql_query("SELECT id FROM notas_obras WHERE cidade = $obra_fu");
							
						while($f = mysql_fetch_array($obra_cidade)){ $obu .= $f['id'].','; }
						$obu = substr($obu,0,-1);
							
						$fun = mysql_query("select * from rh_funcionarios where demissao = '0000-00-00' and categoria = 0 AND (obra in ($obu) OR tipo_emp = '1') order by nome asc");
						while($x = mysql_fetch_array($fun)) {
							echo '<option value="'.$x['id'].'">'.$x['nome'].'</option>';
						}
					
					?>
				</select>
			</label>
		</td>
		<td>
			<label style="width:100%"><input type="submit" value="Adicionar" class="btn btn-success btn-sm" /></label>
		</td>
	</tr>
	</tbody>
	</table>
	
</form>

<script>ldy("financeiro/editar-comb-rm.php?ac=listar&cod_rm=<?php echo $cod_rm ?>",".ajax")</script>

<div class="resultado"></div>
<div class="ajax"></div>

<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Editar Cupom</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
    </div>
  </div>
</div>