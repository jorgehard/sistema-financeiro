<?php include("../config.php");

	if(@$ac=='update') {
		$sql = mysql_query("UPDATE `rh_ferias` SET `dias`='$dias_input',`data`='$data_input', `obs`='$obs_input' WHERE id = '$id'");
					
		if($sql) { 
			echo '<div class="text-center alert alert-success" role="alert">
			  Informações foram atualizadas com sucesso.
			</div>';
			echo '<script>ldy("rh/lista-ferias.php?funcionario='.$funcionario.'",".ferias");</script>';
		}else { 
			echo '<p class="text-danger">'.mysql_error().'</p>'; 
		}
		exit;
	}
	
	$sql = @mysql_query("select * from rh_ferias where id = '$id' ") or die (mysql_error());
	while($l = @mysql_fetch_array($sql)) { extract($l); }
?>


<div class="result"></div>

<form action="javascript:void(0)" onSubmit="post(this,'rh/editar-ferias.php?ac=update&funcionario=<?php echo $funcionario ?>&id=<?php echo $id; ?>','.result')">
<table class="table table-striped table-condensed" border="0">
        <tr>
			<td width="20%"><b>Dias:</b></td>
			<td><input type="number" step="1" name="dias_input" class="form-control input-sm" style="width:100%" value="<?php echo $dias ?>" required></td>
		</tr>
		<tr>
			<td><b>Data:</b></td>
			<td>
				<input type="date" name="data_input" class="form-control input-sm" style="width:100%" value="<?php echo $data; ?>" required>
			</td>
		</tr>
		<tr>
			<td width="20%"><b>Observações:</b></td>
			<td><input type="text" name="obs_input" class="form-control input-sm" style="width:100%" value="<?php echo $obs ?>" required></td>
		</tr>
        <tr><td colspan="2" align="center"><input type="submit" value="Salvar" style="margin-top:20px; width:50%" class="btn btn-success btn-sm"> </td></tr>
</table>
</form>
