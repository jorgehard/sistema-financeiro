<?php 
	require_once("../config.php");
	require_once("../validar_session.php");
	getData();
	getNivel();
?>
<script src="../js/combobox-resume.js"></script>

<?php
	if(@$atu=='ac'){
		echo '<label for="" style="width:100%"><small>Filial:</small> 
				<select name="obraInput" class="form-control input-sm" style="width:100%" required>';
				$obras = mysql_query("select * from notas_obras where cidade IN($cidade) and id in($obra_usuario) AND id <> '0' AND status = '0' order by descricao asc");
				while($l = mysql_fetch_array($obras)) {
					echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>';
				}
			echo '</select>
		</label>';
		exit;
	}
	if(@$ac=='update') {
		if(mysql_num_rows(mysql_query("SELECT * FROM notas_nf WHERE numero = '$numeroInput' AND empresa = '$empresaInput' AND tipo_nota = '$tipo_notaInput' AND id <> '$id_nota'")) > 0){ 
			echo '<script>window.alert("Esta nota de numero '.$numeroInput.' ja esta cadastrada nesta empresa, tente novamente utilizando outro numero!")</script>'; 
			exit; 
		}else{
			$sql = mysql_query("UPDATE `notas_nf` SET `obra`='$obraInput',`empresa`='$empresaInput', `tipo_nota`='$tipo_notaInput', `recebimento`='$recebimentoInput', `observacoes`='$obsInput', `numero` = '$numeroInput' WHERE id = '$id_nota'");	
			if($sql) { 
				echo '
						<div class="alert alert-success" id="alert1">
							<strong>Sucesso!!!</strong> Nota fiscal foi salva.
						</div>';
			} else { 
				echo '<p class="text-danger">'.mysql_error().'</p>'; 
			}
		}
		exit;
	}
?>

<?php
	$edit_nota = mysql_query("select * from notas_nf where id = $id_nota");
	while($l = mysql_fetch_array($edit_nota)) { extract($l); }
				
	$cidade_nt = mysql_result(mysql_query("SELECT cidade FROM notas_obras WHERE id = '$obra'"),0,"cidade");
?>

<div class="result"></div>
<div class="container" style="width:100%">
	<form action="javascript:void(0)" class="formulario-info" onSubmit="post(this,'financeiro/editar-nota.php?ac=update&id_nota=<?php echo $id_nota; ?>','.result')" enctype="multipart/form-data">
		<label for="" style="width:100%"><small>Empresa:</small><br/>
			<select name="cidade" onChange="$('.itens-obra22').load('financeiro/editar-nota.php?atu=ac&cidade=' + $(this).val() + '');" style="width:100%" class="form-control input-sm" required> 
				<option value="" disabled selected>Selecione uma obra</option>
				<?php
				$cidade = @mysql_query("select * from notas_obras_cidade WHERE id IN($cidade_usuario) AND id <> '0' order by nome asc");
				while($l = @mysql_fetch_array($cidade)) {
					if($l['id'] == $cidade_nt){
						echo '<option value="'.$l['id'].'" selected>'.$l['nome'].'</option>';
					}else{
						echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>';	
					}
				}
				?>	
			</select>
		</label>
		<label class="itens-obra22" style="width:100%">
			<label for="" style="width:100%"><small>Filial:</small> 
				<select name="obraInput" class="form-control input-sm" style="width:100%" required>
					<option value="" selected>Selecione uma Obra </option>
					<?php 
					$obras = mysql_query("select * from notas_obras where cidade IN($cidade_nt) and id in($obra_usuario) AND id <> '0' AND status = '0' order by descricao asc");
					while($l = mysql_fetch_array($obras)) {
						if($l['id'] == $obra){
							echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>';
						}else{
							echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>';
						}
					}
					?>
				</select>
			</label>
		</label>
		<div class="fornecedorAtu">
			<label class="formulario-normal" for="" style="width:100%"><small>Fornecedor:</small>
				<select name="empresaInput" class="form-control input-sm combobox" required>
					<?php
					$sqla = @mysql_query("select * from empresa_cadastro WHERE id <> '0' AND status = '0' order by razao_social asc");
					while($a = @mysql_fetch_array($sqla)) { 
						if($a['id'] == $empresa){
							echo '<option value="'.$a['id'].'" selected>'.$a['cnpj'].' - '.$a['razao_social'].'</option>';
						}else{
							echo '<option value="'.$a['id'].'">'.$a['cnpj'].' - '.$a['razao_social'].'</option>';
						}
					}
					?>
				</select>
			</label>
        </div>
        <label for="" style="width:100%"><small>Tipo Nota:</small>
			<select name="tipo_notaInput" class="form-control input-sm" style="width:100%;" required>
				<option value="0" <?= ($tipo_nota == '0' ? 'selected' : '') ?>>NOTA FISCAL - DESPESAS</option>
				<option value="1" <?= ($tipo_nota == '1' ? 'selected' : '') ?>>FATURA DE LOCAÇÃO</option>
				<option value="2" <?= ($tipo_nota == '2' ? 'selected' : '') ?>>VENDA</option>
				<option value="3" <?= ($tipo_nota == '3' ? 'selected' : '') ?>>SERVIÇO</option>
			</select>
		</label>
        <label for="" style="width:100%"><small>Recebimento:</small>
			<input type="date" name="recebimentoInput" class="form-control input-sm" value="<?= $recebimento; ?>" min="2013-01-01" max="<?php echo $todayTotal ?>" required />
		</label>
		<label for="" style="width:100%"><small>Nº Nota Fiscal:</small>
			<input type="text" name="numeroInput" size="15" class="form-control input-sm" value="<?php echo $numero ?>" />
		</label>
        <label for="" style="width:100%"><small>Obs:</small>
			<textarea cols="40" name="obsInput" class="form-control input-sm"><?php echo $observacoes ?></textarea>
		</label>
		<div class="col-xs-12" style="text-align:center">
			<label for="" style="width:40% !important;">
				<input type="submit" value="Salvar" style="width:100%; color:#f3f3f3; height:40px; margin-top:10px; border-radius:5px" class="btn btn-success btn-sm">
			</label>
		</div>
	</form>
</div>

