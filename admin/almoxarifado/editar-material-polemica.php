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
	if(@$ac=='update') {
		$descricao = str_replace("'", "", $descricao); $descricao = str_replace(";", "", $descricao);$descricao = str_replace('"', '', $descricao);
		
		$query = mysql_query("update notas_itens set codigo = '$codigoInput', descricao = '$descricaoInput', categoria='$sub_categoria' where id = '$id'") or die (mysql_error());
		
		if($query) { 
			echo '<div class="alert alert-success" role="alert">		Informações atualizadas com sucesso!</div>';
		} else { 
			echo mysql_error(); 
		} 
		exit;
	}
	$sql = mysql_query("select descricao, codigo, categoria from notas_itens where id = '$id'");
	while($l = mysql_fetch_array($sql)) { extract($l); }
?>
	<div class="container-fluid" style="padding:10px">
		<div class="ajax"></div>
		<div class="col-xs-12">
			<form action="javascript:void(0)" onSubmit="post(this,'almoxarifado/editar-material-polemica.php?ac=update&id=<?= $id ?>','.ajax');" class="formulario-info">
				<div class="container-fluid">
					<div class="col-xs-12" style="padding:2px">
						<label style="width:100%"><small>Codigo:</small><input type="text" value="<?= $codigo ?>" name="codigoInput" class="form-control input-sm" /></label><br>
					</div>
					<div class="col-xs-12" style="padding:2px">
						<label style="width:100%"><small>Descrição:</small><input type="text" value="<?= $descricao ?>" name="descricaoInput" class="form-control input-sm" required /></label><br>
					</div>
					<div class="col-xs-12" style="padding:2px;">
						<label><small>Obra:</small>
							<select name="cidade" style="width:100%" onChange="$('#item-cadastro').load('../functions/functions-load.php?atu=categoria_obra_unique&cidade=' + $(this).val() + '');" class="form-control input-sm" required>
								<option value="">Selecione uma obra</option>
								<?php
									$cidade_obra = mysql_result(mysql_query("SELECT (SELECT obra FROM notas_categorias WHERE notas_categorias.id = id_categoria) as obra FROM notas_categorias_sub"),0,"obra");
									$cidade = mysql_query("select * from notas_obras_cidade WHERE id IN(0,$cidade_usuario) order by nome asc");
									while($l = mysql_fetch_array($cidade)) {
										if($cidade_obra == $l['id']){
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
								<select name="categoria" onChange="$('#item-cadastro-categoria').load('../functions/functions-load.php?atu=categoria_unique&categoriaID=' + $(this).val() + '');" class="form-control input-sm" required>
									<option value="" selected disabled>Selecione uma categoria</option>
									<?php
										$categoria_select = mysql_result(mysql_query("SELECT id_categoria FROM notas_categorias_sub WHERE id = '$categoria'"),0,"id_categoria");
										$sqlbb = mysql_query("select * from notas_categorias WHERE obra in($cidade_usuario) AND status = '0' order by descricao asc");
										while($b = mysql_fetch_array($sqlbb)) {
											if($categoria_select == $b['id']){
												echo '<option value="'.$b['id'].'" selected>'.$b['descricao'].'</option>';
											}else{
												echo '<option value="'.$b['id'].'">'.$b['descricao'].'</option>';
											}
										}			
									?>
								</select>
							</label>
						</div>
						<div class="col-xs-6" style="padding:2px">
							<div id="item-cadastro-categoria">
								<label style="width:100%"><small>Sub-Categoria:</small>
									<select name="sub_categoria"  class="form-control input-sm" required>
										<option value="" disabled>Selecione uma sub-categoria</option>
										<?php
											$categoria_controle = mysql_query("select * from notas_categorias WHERE obra in($cidade_usuario) AND status = '0' order by descricao asc");
											while($s = mysql_fetch_array($categoria_controle)){
												$cat_ids .= $s['id'].',';
											}
											$cat_ids = substr($cat_ids,0,-1);
											$sql = mysql_query("select * from notas_categorias_sub WHERE id_categoria IN($cat_ids) and status = '0' order by descricao asc");
											while($l = mysql_fetch_array($sql)) { extract($l);
												if($categoria == $id){
													echo '<option value="'.$id.'" selected>'.$descricao.'</option>';
												}else{
													echo '<option value="'.$id.'">'.$descricao.'</option>';
												}
											}
										?>
									</select>
								</label>
							</div>
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

