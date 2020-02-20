<?php
include("../config.php"); 
if($categoria == '1'){
	if(@$ac == 'update') {
		$query = mysql_query("UPDATE `notas_eq_situacao` SET `descricao`='$descricao', `status`='$status' WHERE id = '$id'");
		if($query) { echo '<p class="text-success">Informações atualizadas com sucesso!</p>'; }
		else { echo '<p class="text-danger">'.mysql_error().'</p>'; }
		exit;
		
	} 
?>
	<form action="javascript:void(0)" onsubmit='post(this,"gestor/editar-situacao.php?ac=update&id=<?php echo $id ?>&categoria=<?php echo $categoria ?>",".retorno")' class="form-horizontal">
			<?php
			$sit1 = mysql_query("SELECT * FROM notas_eq_situacao WHERE id = '$id'"); 
				
			while($a1 = mysql_fetch_array($sit1)){ extract($a1); ?>
			<label>DESCRIÇÃO:<input type="text" name="descricao" value="<?php echo $descricao; ?>" class="form-control input-sm up" size="100" required/></label><br>
			<label for="">Status:
				<select name="status" class="form-control">
					<?php 
					if($status == '0'){ 
						echo '<option value="0" selected>ATIVO</option>';
						echo '<option value="1">INATIVO</option>';
					}else if($status == '1'){
						echo '<option value="0">ATIVO</option>';
						echo '<option value="1" selected>INATIVO</option>';
					}
					?>
				</select></label><br/>
				<?php } ?>
			<input type="submit" value="Salvar" class="btn btn-success btn-sm"/>
	</form>

<?php }
if($categoria == '2'){
	if(@$ac == 'update') {
		$query = mysql_query("UPDATE `ss_situacao` SET `descricao`='$descricao', `status`='$status' WHERE id = '$id'");
		if($query) { echo '<p class="text-success">Informações atualizadas com sucesso!</p>'; }
		else { echo '<p class="text-danger">'.mysql_error().'</p>'; }
		exit;
		
	} 
?>
	<form action="javascript:void(0)" onsubmit='post(this,"gestor/editar-situacao.php?ac=update&id=<?php echo $id ?>&categoria=<?php echo $categoria ?>",".retorno")' class="form-horizontal">
			<?php
			$sit1 = mysql_query("SELECT * FROM ss_situacao WHERE id = '$id'"); 
				
			while($a1 = mysql_fetch_array($sit1)){ extract($a1); ?>
			<label>DESCRIÇÃO:<input type="text" name="descricao" value="<?php echo $descricao; ?>" class="form-control input-sm up" size="100" required/></label><br>
			<label for="">Status:
				<select name="status" class="form-control">
					<?php 
					if($status == '0'){ 
						echo '<option value="0" selected>ATIVO</option>';
						echo '<option value="1">INATIVO</option>';
					}else if($status == '1'){
						echo '<option value="0">ATIVO</option>';
						echo '<option value="1" selected>INATIVO</option>';
					}
					?>
				</select></label><br/>
				<?php } ?>
			<input type="submit" value="Salvar" class="btn btn-success btn-sm"/>
	</form>

<?php }
if($categoria == '3'){
	if(@$ac == 'update') {
		$query = mysql_query("UPDATE `rh_situacao` SET `descricao`='$descricao', `status`='$status', `editar`='$editar' WHERE id = '$id'");
		if($query) { echo '<p class="text-success">Informações atualizadas com sucesso!</p>'; }
		else { echo '<p class="text-danger">'.mysql_error().'</p>'; }
		exit;
		
	} 
?>
	<form action="javascript:void(0)" onsubmit='post(this,"gestor/editar-situacao.php?ac=update&id=<?php echo $id ?>&categoria=<?php echo $categoria ?>",".retorno")' class="form-horizontal">
			<?php
			$sit1 = mysql_query("SELECT * FROM rh_situacao WHERE id = '$id'"); 
				
			while($a1 = mysql_fetch_array($sit1)){ extract($a1); ?>
			<label>DESCRIÇÃO:<input type="text" name="descricao" value="<?php echo $descricao; ?>" class="form-control input-sm up" size="100" required/></label><br>
			<label for="">Status:
				<select name="status" class="form-control">
					<?php 
					if($status == '0'){ 
						echo '<option value="0" selected>ATIVO</option>';
						echo '<option value="1">INATIVO</option>';
					}else if($status == '1'){
						echo '<option value="0">ATIVO</option>';
						echo '<option value="1" selected>INATIVO</option>';
					}
					?>
				</select>
			</label><br/>
			<label for="">Editar:
				<select name="editar" class="form-control">
					<?php 
					if($editar == '0'){ 
						echo '<option value="0" selected>SIM</option>';
						echo '<option value="1">NÃO</option>';
					}else if($editar == '1'){
						echo '<option value="0">SIM</option>';
						echo '<option value="1" selected>NÃO</option>';
					}
					?>
				</select>
			</label><br/>
				<?php } ?>
			<input type="submit" value="Salvar" class="btn btn-success btn-sm"/>
	</form>
<?php } ?>
 
<div class="retorno"></div>
