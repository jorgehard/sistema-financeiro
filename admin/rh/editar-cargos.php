<?php include("../config.php");

	if(@$ac=='update') {
		$sql = mysql_query("UPDATE `rh_funcoes` SET `descricao`='$descricao',`salario`='$salario', `status`='$status' WHERE id = '$id'");
					
		if($sql) { 
			echo '<p class="text-success">INFORMAÇÕES ATUALIZADAS COM SUCESSO!</p>'; 
		}else { 
			echo '<p class="text-danger">'.mysql_error().'</p>'; 
		}
		exit;
	}
	
	$edit_nota = mysql_query("select * from rh_funcoes where id = $id");
    while($l = mysql_fetch_array($edit_nota)) { extract($l); }
?>

<form action="javascript:void(0)" onSubmit="post(this,'rh/editar-cargos.php?ac=update&id=<?php echo $id; ?>','.result')">
<table class="table table-condensed">
        <tr><th>DESCRIÇÃO:</th><td><input type="text" name="descricao" class="form-control input-sm" style="width:100%" value="<?php echo $descricao ?>" required></td></tr>
        <tr><th>SALÁRIO:</th><td><input type="text" name="salario" class="form-control input-sm" style="width:100%" value="<?php echo $salario; ?>" required></td></tr>
        <tr><th>STATUS:</th><td>
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
		</td></tr>
        <tr><th></th><td><input type="submit" value="Salvar" style="width:200px" class="btn btn-success btn-sm"> </td></tr>
</table>
</form>

<div class="result"></div>

