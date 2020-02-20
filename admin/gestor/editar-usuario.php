<?php 
	include("../config.php"); 
	include("../validar_session.php"); 
?>

<script type="text/javascript">
$(document).ready(function(){
	$('.sel').multiselect({
      buttonClass: 'form-control input-sm', 
	  numberDisplayed: 1,
	  buttonWidth: '100%',
	  maxHeight: 200,
	  includeSelectAllOption: true,
	  selectAllText: "Selecionar todos",
	  enableFiltering: true,
	  enableCaseInsensitiveFiltering: true,
	  selectAllValue: 'multiselect-all'
	});
});
</script>
<style>
.nivel_acesso_class input[type="checkbox"] {
    display:none;
}
.nivel_acesso_class input[type="checkbox"] + label {
    color:#333;
	margin:10px;
}
.nivel_acesso_class input[type="checkbox"] + label span {
    display:inline-block;
    width:29px;
    height:19px;
    margin:-2px 10px 0 0;
    vertical-align:middle;
    background:#f3f3f3;
	border:1px solid #ccc;
    cursor:pointer;
}

.nivel_acesso_class input[type="checkbox"]:checked + label span {
    background:#5CB85C;
	border:1px solid #ccc;
}
</style>
<?php
if($atu=='ac'){
	echo '<label style="width:100%">CONTRATO:<br/>
			<select name="ob[]" class="sel" style="width:100%" multiple="multiple" required>';
				$obra_consulta = mysql_query("select * from notas_obras WHERE cidade IN($obra_2) AND id <> 0 order by descricao asc"); 
				while($l=mysql_fetch_array($obra_consulta)) {
					echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>'; 
				}
	echo '</select></label>';
	exit;
}
if(@$ac == 'update') {
	foreach($ob as $obs) { @$obu .= $obs.','; } $obu = substr($obu,0,-1);
	foreach($ci as $cis) { @$ciu .= $cis.','; } $ciu = substr($ciu,0,-1);
	//Variavel controle para nivel de acesso
	foreach($nivel_acesso2 as $niv2) { @$nivel_acesso3 .= $niv2.','; } $nivel_acesso3 = substr($nivel_acesso3,0,-1);
	//
	$query = mysql_query("UPDATE `usuarios` SET `nome`='$nome',`login`='$login', `status`='$status22', `obra` = '$obu', `cidade` = '$ciu', `editarss` = '$editarss', `nivel_acesso` = '$nivel_acesso3', `acesso_login` = '$acesso_usuario', `mte` = '$mte_input', `tipo_login` = '$tipo_login_input' WHERE id = '$id'");
	if($query) {
		echo '<p class="text-success">Informações atualizadas com sucesso!</p>'; 
	} else { 
		echo '<p class="text-danger">'.mysql_error().'</p>'; 
	}
	exit;	
} 

?>

<?php $sql = mysql_query("select * from usuarios where id = '$id'"); while($l=mysql_fetch_array($sql)) { extract($l); ?>

	<div class="panel panel-default" style="border:none">
	<div class="panel-body">
<form action="javascript:void(0)" onSubmit="post(this,'gestor/editar-usuario.php?ac=update&id=<?php echo $id ?>','.ajax');" class="small">

		<div class="col-md-12">
			<div class="col-xs-12">
				<label style="width:100%">NOME:<input type="text" name="nome" value="<?php echo $nome ?>" class="form-control input-sm up" size="45" required/></label><br>
			</div>
			<div class="col-xs-6">
				<label style="width:100%">LOGIN DE ACESSO:<input type="text" name="login" value="<?php echo $login ?>" class="form-control input-sm" size="10"></label>
			</div>
			<div class="col-xs-6">
				<label style="width:100%">STATUS:
					<select name="status22" class="form-control input-sm">
						<?php if($status == '0') { ?>
						<option value="0" selected>ATIVO</option>
						<option value="1">INATIVO</option>
						<?php }else{ ?>
						<option value="0">ATIVO</option>
						<option value="1" selected>INATIVO</option>
						<?php } ?>
					</select>
				</label>
			</div>
			<div class="col-xs-6">
				<label style="width:100%">EDITAR SS / ALMO:
					<select name="editarss" class="form-control input-sm">
						<?php if($editarss == 0) { ?>
						<option value="0" selected>NÃO</option>
						<option value="1">SIM</option>
						<?php }else{ ?>
						<option value="0">NÃO</option>
						<option value="1" selected>SIM</option>
						<?php } ?>
					</select>
				</label>
			</div>
			<div class="col-xs-6">
				<label style="width:100%">OBRA:<br/>
					<select name="ci[]" onChange="$('#itens').load('gestor/editar-usuario.php?atu=ac&obra_2=' + $(this).val() + '');" class="sel" style="width:100%" multiple="multiple" required>
						<?php 
							$obra_consulta = mysql_query("select * from notas_obras_cidade WHERE id IN($cidade) AND id <> 0 order by nome asc"); 
							while($l=mysql_fetch_array($obra_consulta)) {
								echo '<option value="'.$l['id'].'" selected>'.$l['nome'].'</option>'; 
							}
								
							$obra_consulta = mysql_query("select * from notas_obras_cidade WHERE id NOT IN($cidade) AND id <> 0 order by nome asc"); 
							while($l=mysql_fetch_array($obra_consulta)) {
								echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>'; 
							}
						?>	
					</select>
				</label>
			</div>
			<div class="col-xs-6 nivel_acesso_class">
				<?php								
				echo '<br/>Selecionar: <br/>';
				$acesso_usuario = mysql_query("select * from acesso_usuario WHERE tipo = '0' and controle NOT IN($nivel_acesso) order by controle asc"); 
				while($l=mysql_fetch_array($acesso_usuario)) {
					echo '	<input type="checkbox" id="nivel'.$l['controle'].'" name="nivel_acesso2[]" value="'.$l['controle'].'" />
							<label for="nivel'.$l['controle'].'"><span></span>'.$l['descricao'].'</label>';
				}
				echo '<br/>Selecionados: <br/>';
				$acesso_usuario = mysql_query("select * from acesso_usuario WHERE tipo = '0' and controle IN($nivel_acesso) order by controle asc"); 
				while($l=mysql_fetch_array($acesso_usuario)) {
					echo '	<input type="checkbox" id="nivel'.$l['controle'].'" name="nivel_acesso2[]" value="'.$l['controle'].'" checked />
							<label for="nivel'.$l['controle'].'"><span></span>'.$l['descricao'].'</label>';
				}
				?>
				
			</div>
			<div class="col-xs-6">
				<label style="width:100%" id="itens">
					<label style="width:100%">CONTRATO:<br/>
						<select name="ob[]" class="sel" style="width:100%" multiple="multiple" required>
							<?php 
								$obra_consulta = mysql_query("select * from notas_obras WHERE id IN($obra) AND cidade IN($cidade) AND id <> 0 order by descricao asc"); 
								while($l=mysql_fetch_array($obra_consulta)) {
									echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>'; 
								}
								
								$obra_consulta = mysql_query("select * from notas_obras WHERE id NOT IN($obra) and cidade IN($cidade) AND id <> 0 order by descricao asc"); 
								while($l=mysql_fetch_array($obra_consulta)) {
									echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>'; 
								}
							?>	
						</select>
					</label>
				</label>
				<label style="width:100%">TIPO:
					<select name="acesso_usuario" class="form-control input-sm" required>
						<option value="">Selecione um tipo</option>
						<?php
						$acesso = mysql_query("select * from acesso_usuario WHERE tipo = '1' order by controle asc"); 
						while($l=mysql_fetch_array($acesso)) {
							if($acesso_login == $l['descricao']){
								echo '<option value="'.$l['descricao'].'" selected>'.$l['descricao'].'</option>';
							}else{
								echo '<option value="'.$l['descricao'].'">'.$l['descricao'].'</option>';
							}
						}
						?>
					</select>
				</label>
				<label style="width:100%">S.E.S - SÃO VICENTE:
					<select name="tipo_login_input" class="form-control input-sm">
						<?php if($tipo_login == '0') { ?>
						<option value="0" selected>NÃO</option>
						<option value="1">SIM</option>
						<?php }else if($tipo_login == '1'){ ?>
						<option value="0">NÃO</option>
						<option value="1" selected>SIM</option>
						<?php } ?>
					</select>
				</label>
				<label style="width:100%">MTE - Tec. Segurança:
					<input type="text" name="mte_input" value="<?= $mte ?>" class="form-control input-sm" />
						
				</label>
			</div>
			<div class="col-xs-12" style="text-align:center">
				<input type="submit" class="btn btn-success btn-sm"  style="width:50%" value="Salvar"/>
			</div>
		</div>
	</form>
	</div>
	</div>
<?php } ?>
</table>
<div class="ajax"></div>
