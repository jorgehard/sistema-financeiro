<?php include("../config.php");

	if(@$ac=='insert') {
		$sql = mysql_query("INSERT INTO `rh_funcoes` (descricao, salario) values ('$descricao', '$salario')");

		if($sql) { echo '<p class="text-success" style="text-align:center">Informações cadastradas com sucesso!</p>'; }
		else { echo '<p class="text-danger">'.mysql_error().'</p>'; }
		exit;
	}
?>
<div class="container">
	<form action="javascript:void(0)" onSubmit="post(this,'rh/cadastrar-cargos.php?ac=insert','.result')">
		<div class="col-xs-12">
			<label><small>DESCRIÇÃO:</small>
				<input type="text" name="descricao" class="form-control input-sm" style="width:300px" required />
			</label>
		</div>
		<div class="col-xs-12">
			<label><small>SALÁRIO:</small>
				<input type="text" name="salario" class="form-control input-sm" style="width:200px" required />
			</label>
		</div>
		<div class="col-xs-12" style="margin-top:20px">
			<label>
				<input type="submit" value="Cadastrar" style="width:200px" class="pull-right btn btn-success btn-sm">
			</label>
		</div>
	</table>
	</form>
</div>
<div class="result"></div>

