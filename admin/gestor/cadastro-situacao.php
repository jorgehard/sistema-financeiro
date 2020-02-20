<?php
include("../config.php"); 
if($categoria == '1'){
	if(@$ac == 'update') {
		$query = mysql_query("INSERT INTO `notas_eq_situacao` (`descricao`,`status`) VALUES ('$descricao', '$status') ");
		if($query) { echo '<p class="text-success">Informações atualizadas com sucesso!</p>'; }
		else { echo '<p class="text-danger">'.mysql_error().'</p>'; }
		exit;
		
	} 
?>
	<form action="javascript:void(0)" onsubmit='post(this,"gestor/cadastro-situacao.php?ac=update&categoria=<?php echo $categoria ?>",".retorno")' class="form-horizontal">
			<label>DESCRIÇÃO:<input type="text" name="descricao" class="form-control input-sm up" size="100" required/></label><br>
			<label for="" style="width:100%">Status:
				<select name="status" class="form-control input-sm" style="width:100%"> 
					<option value="0" selected>ATIVO</option>
					<option value="1">INATIVO</option>
				</select>
			</label><br/>
			<label style="width:100%; margin:0 auto;">
				<center><input type="submit" value="Cadastrar" class="btn btn-success btn-sm" style="width:30%;"/></center>
			</label>
	</form>

<?php }
if($categoria == '2'){
	if(@$ac == 'update') {
		$query = mysql_query("INSERT INTO `ss_situacao` (`descricao`,`status`) VALUES ('$descricao', '$status')");
		if($query) { echo '<p class="text-success">Informações atualizadas com sucesso!</p>'; }
		else { echo '<p class="text-danger">'.mysql_error().'</p>'; }
		exit;
		
	} 
?>
	<form action="javascript:void(0)" onsubmit='post(this,"gestor/cadastro-situacao.php?ac=update&categoria=<?php echo $categoria ?>",".retorno")' class="form-horizontal">
		<label>DESCRIÇÃO:<input type="text" name="descricao" class="form-control input-sm up" size="100" required/></label><br>
			<label for="" style="width:100%">Status:
				<select name="status" class="form-control input-sm" style="width:100%"> 
					<option value="0" selected>ATIVO</option>
					<option value="1">INATIVO</option>
				</select>
			</label><br/>
			<label style="width:100%; margin:0 auto;">
				<center><input type="submit" value="Cadastrar" class="btn btn-success btn-sm" style="width:30%;"/></center>
			</label>

	</form>

<?php }
if($categoria == '3'){
	if(@$ac == 'update') {
		$query = mysql_query("INSERT INTO `rh_situacao` (`descricao`,`status`) VALUES ('$descricao','$status')");
		if($query) { 
			echo '<p class="text-success">Informações atualizadas com sucesso!</p>'; 
		} else { 
			echo '<p class="text-danger">'.mysql_error().'</p>'; 
		}
		exit;
		
	} 
?>
	<form action="javascript:void(0)" onsubmit='post(this,"gestor/cadastro-situacao.php?ac=update&categoria=<?php echo $categoria ?>",".retorno")' class="form-horizontal">
			<label>DESCRIÇÃO:<input type="text" name="descricao" value="<?php echo $descricao; ?>" class="form-control input-sm up" size="100" required/></label><br>
			<label for="" style="width:100%">Status:
				<select name="status" class="form-control input-sm" style="width:100%"> 
					<option value="0" selected>ATIVO</option>
					<option value="1">INATIVO</option>
				</select>
			</label><br/>
			<label style="width:100%; margin:0 auto;">
				<center><input type="submit" value="Cadastrar" class="btn btn-success btn-sm" style="width:30%;"/></center>
			</label>

	</form>
<?php } ?>

<div class="retorno"></div>
