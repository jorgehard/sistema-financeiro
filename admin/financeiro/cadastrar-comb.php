<?php
	include("../config.php");
	include("../validar_session.php");
	include("../../functions/function-print.php");
	getData();
	getNivel();
?>
<style type="text/css">
@media print {
	table, tr, thead, tbody, td, th{
		border:1px solid rgba(23, 23, 23, 0.6) !important;
	}
}
</style>
<script src="../js/combobox-resume.js"></script>
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
	
	if($ac == 'puxar1'){
		echo '<label style="width:100%"><small>Contrato:</small>
			<select name="obra" class="form-control input-sm" onChange="$(\'#itens-equipe\').load(\'financeiro/cadastrar-comb.php?ac=puxar2&cidade='.$cidade.'&obra_controle=\' + $(this).val() + \'\');" required>
				<option value="" disabled selected>SELECIONE UM CONTRATO</option>';
				
				$obras = mysql_query("select * from notas_obras WHERE cidade IN($cidade) and status = '0' order by id asc");
				while($l = mysql_fetch_array($obras)) {
					echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>';
				}
						
			echo '</select>
		</label>';
		exit;
	}
	if($ac == 'puxar2'){
		echo '<label style="width:100%"><small>Equipe:</small><br/>
			<select name="equipe" class="form-control input-sm combobox" required>
				<option value="" disabled selected>SELECIONE UMA EQUIPE</option>';
				
				$equipe = mysql_query("select * from equipes WHERE obra IN($cidade) AND status = '0' order by nome asc");
				while($c = mysql_fetch_array($equipe)) {
					echo '<option value="'.$c['id'].'">'.$c['nome'].'</option>';
				}
						
			echo '</select>
		</label>';
		exit;
	}
	if(@$ac=='inserir') {
		mysql_query("insert into comb_rm (`nota`,`equipamento`,`data`, `data_ref`, `obra`, `equipe`, `tipo`) values ('$nota','$equipamento', '$data', '$data_ref', '$obra', '$equipe', '2')"); 
		$i_rm = mysql_insert_id();
		echo '<script>ldy("financeiro/editar-comb-rm.php?cod_rm='.$i_rm.'",".conteudo")</script>';
	}
?>
<table width="100%" class="table-responsive nav-pills2 hidden-print">
	<tr>
		<td><a href="#" onclick="ldy('financeiro/cadastrar-comb.php','.conteudo')"><li class="activeb"><span class="glyphicon glyphicon-star"></span> 
		CADASTRAR PLACA</li></a></td>
		<td><a href="#" onclick="ldy('financeiro/consultar-comb.php','.conteudo')"><li><small><span class="glyphicon glyphicon-search"></span></small> 
		CONSULTAR CUPOM</li></a></td>
		<td><a href="#" onclick="ldy('financeiro/relatorio-comb.php','.conteudo')"><li><span class="glyphicon glyphicon-th-list"></span> 
		EMITIR RELATORIO</li></a></td>
	</tr>
</table>
<div class="container-fluid" style="padding:0px 0px 15px 0px; margin-top:20px">
	<h3 style="font-family: 'Oswald', sans-serif;letter-spacing:5px; text-align:center"> 
		<p>		<img src="http://polemicalitoral.com.br/guaruja/imagens/logo.png" style="position:relative; bottom:10px;" width="50px"/> <small>CADASTRO DE <B>CUPOM DE ABASTECIMENTO</B></small></p>
	</h3>
</div>
<div class="well well-sm hidden-print" style="width:40%; padding:20px; margin:0 auto;">
<form class="form-horizontal" action="javascript:void(0)" onSubmit="post(this,'financeiro/cadastrar-comb.php?ac=inserir','.resultado')" >
	
	<label style="width:100%"><small>Nota Fiscal:</small></br>
		<input type="text" name="nota" class="form-control input-sm" style="width:100%" required/>
	</label></br>
	<label style="width:100%"><small>Obra:</small>
		<select name="obra" class="form-control input-sm" onChange="$('#itens-obra').load('financeiro/cadastrar-comb.php?ac=puxar1&cidade=' + $(this).val() + '');" required>
			<option value="" disabled selected>Selecione uma obra</option>
			<?php
			$obras = mysql_query("select * from notas_obras_cidade WHERE id IN($cidade_usuario) order by nome asc");
			while($l = mysql_fetch_array($obras)) {
				echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>';
			}
			?>		
		</select>
	</label><br>
	<label id="itens-obra" style="width:100%">	
		<label style="width:100%"><small>Contrato:</small>
			<select name="obra" class="form-control input-sm" required>
				<option value="" disabled selected>Selecione um contrato</option>	
			</select>
		</label><br>
	</label>
	<label class="formulario-normal" id="itens-equipe" style="width:100%">
		<label style="width:100%"><small>Equipe:</small>
			<select name="equipe" class="form-control input-sm" required disabled>
				<option value="" selected>Selecione uma obra</option>
			</select>
		</label>
	</label>
		<label class="formulario-normal" style="width:100%"><small>Equipamento:</small><br/>
			<?php
			echo '<select name="equipamento" class="form-control input-sm combobox" required>';
			echo '<option value="" selected></option>';
					$obras = mysql_query("select * from notas_equipamentos WHERE obra IN($obra_usuario)");
					while($l = mysql_fetch_array($obras)) {
						echo '<option value="'.$l['id'].'">'.$l['placa'].' - '.mysql_result(mysql_query("select * from notas_cat_e where id =".$l['categoria'].""),0,"descricao").' - '.mysql_result(mysql_query("select * from equipes where id =".$l['equipe'].""),0,"nome").'</option>'; 
					}			
				echo '</select>';
			?>
		</label>
	<label for="" style="width:100%"><small>Data:</small><input type="date" value="<?php echo $todayTotal; ?>" class="form-control input-sm" name="data" required></label>
	
	<label for="" style="width:100%"><small>Ref:</small>
		<select name="data_ref" class="form-control input-sm" style="width: 100%" required>
			<option value="" disabled selected>SELECIONE O MÊS REFERENTE</option>
			<option value="<?php echo $today['year']."-01-01";?>">JANEIRO</option>
			<option value="<?php echo $today['year']."-02-01";?>">FEVEREIRO</option>
			<option value="<?php echo $today['year']."-03-01";?>">MARÇO</option>
			<option value="<?php echo $today['year']."-04-01";?>">ABRIL</option>
			<option value="<?php echo $today['year']."-05-01";?>">MAIO</option>
			<option value="<?php echo $today['year']."-06-01";?>">JUNHO</option>
			<option value="<?php echo $today['year']."-07-01";?>">JULHO</option>
			<option value="<?php echo $today['year']."-08-01";?>">AGOSTO</option>
			<option value="<?php echo $today['year']."-09-01";?>">SETEMBRO</option>
			<option value="<?php echo $today['year']."-10-01";?>">OUTUBRO</option>
			<option value="<?php echo $today['year']."-11-01";?>">NOVEMBRO</option>
			<option value="<?php echo $today['year']."-12-01";?>">DEZEMBRO</option>
		</select>
	</label>

	<center><label style="width:50%;"><input type="submit" style="width:100%; margin-top:10px;" value="Criar"  class="btn btn-success btn-sm" /></label></center>
	
</form>
</div>
<div class="resultado"></div>