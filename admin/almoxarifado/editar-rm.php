<?php
	require_once("../config.php");
	require_once("../validar_session.php");
	getNivel();
	getData();
?>
<style>
	#autoco {
		max-height: 200px;
		overflow: auto;
		position: absolute;
		border-top: 3px solid #333;
		border-bottom: 3px solid #333;
		background:#FFF;
		display: none;
		width: auto;
	}
</style>

<?php
	if(@$ac=='busca-material') {
		$busca = str_replace("-","%",$busca);
		echo '<ul class="list-group">';
		$sql = mysql_query("select * from ss_materiais where status = 0 and descricao like _utf8 '%$busca%' OR codigo like '%$busca%' COLLATE utf8_unicode_ci");
		while($l = mysql_fetch_array($sql)) { extract($l);
  			echo '<li class="list-group-item small">
  						<a href="javascript:void(0)" onclick=\'$("#busca").val("'.trim($descricao).'"); $("#item").val("'.$id.'"); $("#autoco").hide()\'>'.$codigo.' - '.addslashes($descricao).'</a>
  				 </li>';			
		}
		echo '</ul>';
		exit;
	}

	if(@$ac=='editar-rm') {
		$data = implode("-",array_reverse(explode("/", $data)));
		$sql = mysql_query("update ss_rm set obra = '$obra', numero = '$numero', data = '$data', num_ci = '$num_ci' where id = '$id'");
		if($sql) { echo '<script>alert("Informações atualizadas com sucesso!");</script>'; } exit;
	}
	
	if(@$ac=='listar') {
		if(@$op=='inserir') {
		
			$qtd = str_replace(",",".",$qtd); $vlr = str_replace(",",".",$vlr); 
			mysql_query("insert into ss_rm_itens (cod_rm,item,qtd,vlr) values ('$cod_rm','$item','$qtd','$vlr')");
		}
		
		if(@$op=='del') { mysql_query("delete from ss_rm_itens where id = $item"); }
		
		echo '<table class="table table-bordered table-condensed table-striped table-green small">';
		echo '<thead><tr>
			<th>Código</th>
			<th>Descricao</th>
			<th>Qtd</th>
			<th>Valor</th>
			<th>Total</th>';
			if($editarss_usuario == '1' || $acesso_login == 'MASTER'){
				echo '<th></th>';
			}
		echo '</tr></thead>';
		$sql = mysql_query("select * from ss_rm_itens where cod_rm = '$cod_rm' order by id asc");
		while($l = mysql_fetch_array($sql)) { extract($l);
	
		$total = $qtd*$vlr;
		
		echo '<tr>';
		echo '<td>'.@mysql_result(mysql_query("select * from ss_materiais where id = $item"),0,"codigo").'</td>';
		echo '<td>'.@mysql_result(mysql_query("select * from ss_materiais where id = $item"),0,"descricao").'</td>';
		echo '<td>'.number_format($qtd,"2").'</td>';
		echo '<td>'.number_format($vlr,"2").'</td>';
		echo '<td>'.number_format($total,"2").'</td>';
		if($editarss_usuario == '1' || $acesso_login == 'MASTER'){
			echo '<td><a href="#" onclick=\'ldy("almoxarifado/editar-rm.php?ac=listar&op=del&item='.$id.'&cod_rm='.$cod_rm.'",".resultado")\' class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a></td>';
		}
		echo '</tr>'; 
		
		}		

		echo '</table>';
		
		exit;
	}
?>
<h4 style="font-family: 'Oswald', sans-serif;letter-spacing:5px;"><small>Adicionar itens a solicitação de retirada <a href="javascript:void(0)" onclick="ldy('almoxarifado/cadastro-rm.php','.conteudo')" class="btn btn-info btn-sm pull-right">Inserir nova</a></small></h3> <br>

<span class="label label-info">Editar Informações</span>
<form action="javascript:void(0)" onsubmit="post(this,'almoxarifado/editar-rm.php?ac=editar-rm&id=<?php echo $cod_rm ?>','.ajax')" class="formulario-info">
<table class="table table-condensed table-bordered table-blue">
	<thead><tr><th><small>Obra:</small></th><th><small>Data:</small></th><th><small>Numero:</small></th><th><small>CI:</small></th><th></th></tr></thead>
	<tr>
		<?php
		$detalhes_rm = mysql_query("select * from ss_rm where id = $cod_rm");
		while($li = mysql_fetch_array($detalhes_rm)) { $obra = $li['obra'];
			echo '<td><select name="obra" class="form-control">';
				$sql = mysql_query("select * from notas_obras where id in($obra_usuario) order by descricao asc");
				while($l = mysql_fetch_array($sql)) { 
					if($l['id']==$obra) { echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>'; }
					else { echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>'; }
				}
			echo '</select></td>';
			echo '<td><input type="text" name="data" value="'.implode("/",array_reverse(explode("-", $li['data']))).'" class="form-control" onfocus=\'$(this).mask("99/99/9999")\'></td>';
			echo '<td><input type="text" name="numero" value="'.$li['numero'].'" class="form-control" onfocus=\'$(this).mask("9999999999/9999")\'></td>';echo '<td><input type="text" name="num_ci" value="'.$li['num_ci'].'" class="form-control" onfocus=\'$(this).mask("9999/9999")\'></td>';
			echo '<td style="text-align:center"><input type="submit" value="Salvar" class="btn btn-primary btn-sm" style="width:200px"></td>';
		}
		?>
	</tr>
</table>
</form>

<script>
	$(document).ready(function() {
		$("#busca").keyup(function() {
			var vlr_campo = $(this).val();
			vlr = vlr_campo.replace(/\s/g,"-");
			
			if(vlr_campo.length > 3) {
			$('#autoco').show(); 
			$('#autoco').load('almoxarifado/editar-rm.php?ac=busca-material&busca=' + vlr); }
			
			if(vlr_campo.length < 3) {
			$('#autoco').hide(); 	
			$('#item').val(''); 	
			}
		})
	});
</script>
<span class="label label-success">Adicionar Itens</span> 
<form action="javascript:void(0)" class="formulario-success" onSubmit="post(this,'almoxarifado/editar-rm.php?ac=listar&op=inserir&cod_rm=<?php echo $cod_rm ?>','.resultado')" >
<table class="table table-condensed table-bordered table-green">
	<thead>
		<tr>
			<th><small>Material:</small></th>
			<th><small>Quantidade:</small></th>
			<th><small>Valor UN:</small></th>
			<th></th>
		</tr>
	</thead>
	<tr>
		<td style="width:50%">
			<label for="" style="width:100%">
				<input type="text" class="form-control input-sm" id="busca" size="50" required>
				<input type="text" name="item" id="item" style="display: none" required>
				<div id="autoco"></div>
			</label>
		</td>
		<td>
			<label for="" style="width:100%"><input type="number" step="0.01" name="qtd" class="form-control input-sm" required/></label>
		</td>
		<td>
			<label for="" style="width:100%"><input type="number" step="0.01" name="vlr" class="form-control input-sm" required/></label>
		</td>
		<td style="text-align:center">
			<input type="submit" value="Adicionar" class="btn btn-success btn-sm" style="width:100%;">
		</td>
	</tr>
</table>
</form>

<script>ldy("almoxarifado/editar-rm.php?ac=listar&cod_rm=<?php echo $cod_rm ?>",".resultado")</script>

<div class="resultado"></div>
<div class="ajax"></div>