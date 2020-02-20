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
	$query = mysql_query("INSERT INTO `notas_categorias` (`descricao`, `obra`, `status`) VALUES ('$descricao', '$cidade', '0')");
		if($query) { 
			echo '<div class="alert alert-success" role="alert">
					Informações atualizadas com sucesso!
					</div>';
		} else {
			echo '<p class="text-danger">'.mysql_error().'</p>'; 
		}
		exit;
} 
if(@$ac == 'update2') {
	$query = mysql_query("INSERT INTO `notas_categorias_sub` (`descricao`, `id_categoria`, `status`) VALUES ('$descricao', '$categoria', '0')");
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
		<div class="col-xs-6">
			<h5><small>CATEGORIA:</small></h5>
			<form action="javascript:void(0)" onSubmit="post(this,'gestor/cadastrar-categoria-polemica.php?ac=update&id=<?php echo $id ?>','.ajax');" class="formulario-success">
				<div class="col-md-12">
					<div class="col-xs-12" style="padding:0px; text-align:left; margin-bottom:20px;">
						<label><small>Obra:</small>
							<select name="cidade" style="width:100%" class="form-control input-sm" required>
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
					<div class="col-xs-12" style="padding:0px; text-align:left; margin-bottom:20px;">
						<label style="width:100%"><small>Descrição:</small><input type="text" name="descricao" class="form-control input-sm up" required/></label><br>
					</div>
					<div class="col-xs-12" style="padding:0px; text-align:center">
						<label>
							<input type="submit" class="btn btn-success btn-sm"  style="width:100%" value="Salvar"/>
						</label>
					</div>
				</div>
			</form>
		</div>
		<div class="col-xs-6" style="border-left:1px solid #D3E5C1">
			<h5><small>SUB-CATEGORIA:</small></h5>
			<form action="javascript:void(0)" onSubmit="post(this,'gestor/cadastrar-categoria-polemica.php?ac=update2&id=<?php echo $id ?>','.ajax');" class="formulario-success">
				<div class="col-md-12">
					<div class="col-xs-12" style="padding:0px; text-align:left; margin-bottom:20px;">
						<label><small>Obra:</small>
							<select name="cidade" style="width:100%" onChange="$('#item-cadastro').load('../functions/functions-load.php?atu=categoriaCad&cidade=' + $(this).val() + '');" class="form-control input-sm" required>
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
						<div class="col-xs-12" style="padding:0px; text-align:left; margin-bottom:20px;">
							<label style="width:100%"><small>Categoria:</small>
								<select name="categoria" style="width:100%" class="form-control input-sm" required>
									<option value="">Selecione uma obra</option>
								</select>
							</label><br>
						</div>
					</div>
					<div class="col-xs-12" style="padding:0px; text-align:left; margin-bottom:20px;">
						<label style="width:100%"><small>Descrição:</small><input type="text" name="descricao" class="form-control input-sm up" required/></label><br>
					</div>
					<div class="col-xs-12" style="padding:0px; text-align:center">
						<label>
							<input type="submit" class="btn btn-success btn-sm"  style="width:100%" value="Salvar"/>
						</label>
					</div>
				</div>
			</form>
		</div>
	</div>

