<?php
	include("../config.php");
	include("../validar_session.php");
	getData();
	
	if(@$ac=='update') {
		$data = implode("-",array_reverse(explode("/",$data))); 
		$sql = mysql_query("UPDATE `comb_rm_itens` SET `cupom`='$cupom',`qtd`='$qtd',`vlr`='$vlr',
					`data`='$data',`obs`='$obs',`kmfinal`='$kmfinal', `funcionario`='$funcionario' WHERE id = '$id_cupom'");
					
		if($sql) { echo '<p class="text-success">INFORMAÇÕES ATUALIZADAS COM SUCESSO!</p>'; }
		else { echo '<p class="text-danger">'.mysql_error().'</p>'; }
		exit;
	}
?>

        <?php
                $edit_nota = mysql_query("select * from comb_rm_itens where id = $id_cupom");
                while($l = mysql_fetch_array($edit_nota)) { extract($l); }
				$obra_func = mysql_result(mysql_query("SELECT obra FROM comb_rm WHERE id = $cod_rm"),0,"obra");
        ?>

<form action="javascript:void(0)" onSubmit="post(this,'financeiro/editar-nota-cupom.php?ac=update&id_cupom=<?php echo $id_cupom; ?>','.result')" enctype="multipart/form-data">
<table class="table table-condensed">
		<tr><th>CUPOM:</th><td><input type="text" name="cupom" class="form-control input-sm" value="<?php echo $cupom ?>" required></td></tr>
		<tr><th>LITROS:</th><td><input type="number" name="qtd" step="any" class="form-control input-sm" value="<?php echo $qtd ?>" required></td></tr>
		<tr><th>VALOR:</th><td><input type="number" name="vlr" step="any" class="form-control input-sm" value="<?php echo $vlr ?>" required></td></tr>
		
        <tr><th>DATA:</th><td><input type="text" name="data" size="15" maxlength="10" onFocus="$(this).mask('99/99/9999')" class="form-control input-sm" style="width:150px" value="<?php echo implode("/",array_reverse(explode("-",$data))) ?>" required></td></tr>
        <tr><th>OBSERVAÇÕES:</th><td><input type="text" name="obs" size="15" class="form-control input-sm" value="<?php echo $obs ?>" /></td></tr>
		
		<tr>
			<th>FUNCIONARIO:</th>
			<td>
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
								if($x['id'] == $funcionario){
									echo '<option value="'.$x['id'].'" selected>'.$x['nome'].'</option>';
								}else{
									echo '<option value="'.$x['id'].'">'.$x['nome'].'</option>';
								}
							}
						
						?>
					</select>
				</label>
			</td>
		</tr>
        <tr><th>KM FINAL:</th><td><input type="number" name="kmfinal" size="15" class="form-control input-sm" value="<?php echo $kmfinal?>" required></td></tr>

		<tr><th></th><td><input type="submit" value="Salvar" class="btn btn-success btn-sm"> <input type="reset" value="Cancelar" class="btn btn-default btn-sm"></td></tr>


</table>
</form>

<div class="result"></div>

