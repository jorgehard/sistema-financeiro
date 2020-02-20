<?php
	include("../config.php");
	include("../validar_session.php");
	getData();
	getNivel();
?>
<script>
	$(document).ready(function() {
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
 
if(@$ac == 'update') {
	$query = mysql_query("INSERT INTO `notas_itens` (`descricao`, `codigo`, `categoria`, `status`) VALUES ('$descricao', '$codigo', '$sub_categoria', '0')");
	if($query) { 
		echo '<div class="alert alert-success" role="alert">
				Informações atualizadas com sucesso!
			</div>';
	} else {
		echo '<p class="text-danger">'.mysql_error().'</p>'; 
	}
	exit;
} 
?>
	<div class="container-fluid" style="padding:10px">
		<div class="ajax"></div>
		<div class="col-xs-12">
			<form action="javascript:void(0)" onSubmit="post(this,'almoxarifado/cadastro-polemica.php?ac=update','.ajax');" class="formulario-info">
				<div class="container-fluid">
					<div class="col-xs-12" style="padding:2px">
						<label style="width:100%"><small>Codigo:</small><input type="text" name="codigo" class="form-control input-sm" /></label><br>
					</div>
					<div class="col-xs-12" style="padding:2px">
						<label style="width:100%"><small>Descrição:</small><input type="text" name="descricao" class="form-control input-sm" required /></label><br>
					</div>
					<div class="col-xs-12" style="padding:2px;">
						<label><small>Obra:</small>
							<select name="cidade" style="width:100%" onChange="$('#item-cadastro').load('../functions/functions-load.php?atu=categoria_obra_unique&cidade=' + $(this).val() + '');" class="form-control input-sm" required>
								<option value="">Selecione uma obra</option>
								<?php
									$cidade = mysql_query("select * from notas_obras_cidade WHERE id IN(0,$cidade_usuario) order by nome asc");
									while($l = mysql_fetch_array($cidade)) {
										if($obra == $l['id']){
											echo '<option value="'.$l['id'].'" selected>'.$l['nome'].'</option>';
										}else{
											echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>';
										}
									}
								?>	
							</select>
						</label>
					</div>
					<div id="item-cadastro">
						<div class="col-xs-6" style="padding:2px">
							<label style="width:100%"><small>Categoria:</small>
								<select name="categoria" style="width:100%" class="form-control input-sm" required>
									<option value="">Selecione uma obra</option>
								</select>
							</label><br>
						</div>
						<div class="col-xs-6" style="padding:2px">
							<label style="width:100%"><small>Sub-Categoria:</small>
								<select name="sub_categoria" style="width:100%" class="form-control input-sm" required>
									<option value="">Selecione uma obra</option>
								</select>
							</label><br>
						</div>
					</div>
					<div class="col-xs-12" style="text-align:center; margin-top:20px;">
						<label for="" style="width:100% !important;">
							<input type="submit" value="Cadastrar" style="width:100%; height:40px; margin-top:10px; color:#ccc; border-radius:5px" class="btn btn-primary btn-sm">
						</label>
					</div>
				</div>
			</form>
		</div>
	</div>

