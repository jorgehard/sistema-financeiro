<?php include("../config.php");

	if(@$ac=='update') {
		$sql = mysql_query("UPDATE `rh_benef` SET `nome`='$nome_input',`parentesco`='$parentesco_input', `nascimento`='$nascimento_input' WHERE id = '$id'");
					
		if($sql) { 
			echo '<div class="text-center alert alert-success" role="alert">
			  Informações foram atualizadas com sucesso.
			</div>';
			echo '<script>ldy("rh/lista-benef.php?funcionario='.$funcionario.'",".benef");</script>';
		}else { 
			echo '<p class="text-danger">'.mysql_error().'</p>'; 
		}
		exit;
	}
	
	$sql = @mysql_query("select * from rh_benef where id = '$id' order by nome desc");
    while($l = @mysql_fetch_array($sql)) { extract($l); }
?>


<div class="result"></div>

<form action="javascript:void(0)" onSubmit="post(this,'rh/editar-benef.php?ac=update&funcionario=<?php echo $funcionario ?>&id=<?php echo $id; ?>','.result')">
<table class="table table-striped table-condensed" border="0">
        <tr>
			<td width="20%"><b>Nome:</b></td>
			<td><input type="text" name="nome_input" class="form-control input-sm" style="width:100%" value="<?php echo $nome ?>" required></td>
		</tr>
        <tr>
			<td><b>Parentesco:</b></td>
			<td>
				<select name="parentesco_input" class="form-control input-sm">
					<?php 
					if($parentesco == 'FILHO'){ 
						echo '<option value="FILHO" selected>FILHO</option>';
						echo '<option value="FILHA">FILHA</option>';
					}else if($parentesco == 'FILHA'){
						echo '<option value="FILHO">FILHO</option>';
						echo '<option value="FILHA" selected>FILHA</option>';
					}
					?>
				</select>
			</td>
		</tr>
		
		<tr>
			<td><b>Nascimento:</b></td>
			<td>
				<input type="date" name="nascimento_input" class="form-control input-sm" style="width:100%" value="<?php echo $nascimento; ?>" required>
			</td>
		</tr>
		
        <tr><td colspan="2" align="center"><input type="submit" value="Salvar" style="margin-top:20px; width:50%" class="btn btn-success btn-sm"> </td></tr>
</table>
</form>
