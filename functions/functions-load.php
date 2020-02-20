<?php
	include("../admin/config.php");
	include("../admin/validar_session.php");
	getData();
	getNivel();
?>
<script>
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
</script>
<?php
	if($atu == 'item_categoria'){
?>	
	<label style="width:100%">
		<select name="item" class="form-control input-sm combobox" required>
			<option value="">Selecionar o Item</option>
			<?php
				$sql = mysql_query("select * from notas_itens where status = '0' and categoria = '$categoria' order by descricao asc");
				while($l = mysql_fetch_array($sql)) { extract($l);
					if($itemInput == $id){
						echo '<option value="'.$id.'" selected>'.$descricao.'</option>';
					}else{
						echo '<option value="'.$id.'">'.$descricao.'</option>';
					}
				}
			?>
		</select>
	</label>	
		
<?php
		exit;
	}
	//Contrato - Multiple
	if($atu=='categoria_notaFiscal'){ 
?>
						<div class="col-xs-6" style="padding:2px">
							<label style="width:100%">
								<select name="categoria" onChange="$('#itens').load('financeiro/item-categoria.php?categoria=' + $(this).val() + '');" class="form-control input-sm" id="categ" required>
								<option value="" disabled selected>Selecione uma categoria</option>
								<?php
									$sql = mysql_query("select * from notas_categorias_sub WHERE id_categoria IN($categorias) and status = '0' order by descricao asc");
									while($l = mysql_fetch_array($sql)) {
										echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>';
									}
								?>
							</select>
							</label>
						</div>
						<div class="col-xs-6" style="padding:2px">
							<div id="itens">
								<label style="width:100%">
									<select name="item" class="form-control input-sm combobox" disabled>
										<option>Selecione uma categoria antes</option>
									</select>
								</label>
							</div>
						</div>					
<?php
	exit;
	}
	//Contrato - Multiple
	if($atu=='categoria_unique'){ 
?>
	<label style="width:100%"><small>Sub-Categoria: </small>
		<select name="sub_categoria"  class="form-control input-sm" required>
			<option value="" selected disabled>Selecione uma sub-categoria</option>
			<?php
				$sql = mysql_query("select * from notas_categorias_sub WHERE id_categoria = '$categoriaID' and status = '0' order by descricao asc");
				while($l = mysql_fetch_array($sql)) { extract($l);
					echo '<option value="'.$id.'">'.$descricao.'</option>';
				}
			?>
		</select>
	</label>
<?php
	exit;
	}
	//Contrato - Multiple
	if($atu=='categoria_multiple'){ 
?>
	<label style="width:100%"><small>Sub-Categoria: </small>
		<select name="sub[]" class="sel" multiple="multiple" required>
			<option value="" selected disabled>Selecione uma sub-categoria</option>
			<?php
				$sql = mysql_query("select * from notas_categorias_sub WHERE id_categoria IN($categoriaID) and status = '0' order by descricao asc");
				while($l = mysql_fetch_array($sql)) { extract($l);
					echo '<option value="'.$id.'" selected>'.$descricao.'</option>';
				}
			?>
		</select>
	</label>
<?php
	exit;
	}
	if($atu=='categoria_obra_unique'){ 
?>
	<div class="col-xs-6" style="padding:2px">
		<label style="width:100%"><small>Categoria:</small>
			<select name="categoria" onChange="$('#item-cadastro-categoria').load('../functions/functions-load.php?atu=categoria_unique&categoriaID=' + $(this).val() + '');" class="form-control input-sm" required>
				<option value="" selected disabled>Selecione uma categoria</option>
				<?php
					$sql = mysql_query("select * from notas_categorias WHERE obra in($cidade) AND status = '0' order by descricao asc");
					while($l = mysql_fetch_array($sql)) { extract($l);
						echo '<option value="'.$id.'">'.$descricao.'</option>';
					}			
				?>
			</select>
		</label>
	</div>
	<div class="col-xs-6" style="padding:2px">
		<div id="item-cadastro-categoria">
			<label style="width:100%"><small>Sub-Categoria: </small>
				<select name="sub_categoria"  class="form-control input-sm" required>
					<option value="" selected disabled>Selecione uma sub-categoria</option>
					<?php
						$categoria_controle = mysql_query("select * from notas_categorias WHERE obra in($cidade) AND status = '0' order by descricao asc");
						while($s = mysql_fetch_array($categoria_controle)){
							$cat_ids .= $s['id'].',';
						}
						$cat_ids = substr($cat_ids,0,-1);
						$sql = mysql_query("select * from notas_categorias_sub WHERE id_categoria IN($cat_ids) and status = '0' order by descricao asc");
						while($l = mysql_fetch_array($sql)) { extract($l);
							echo '<option value="'.$id.'">'.$descricao.'</option>';
						}
					?>
				</select>
			</label>
		</div>
	</div>
<?php
	exit;
	}
	if($atu=='categoriaCad'){ ?>
		<div class="col-xs-12" style="padding:0px; text-align:left; margin-bottom:20px;">
			<label style="width:100%"><small>Categoria (Associada):</small>
			<select name="categoria" style="width:100%" class="form-control input-sm" required>
				<option value="">Selecione uma categoria</option>
				<?php 
					$categorias = mysql_query("select * from notas_categorias WHERE obra in($cidade) AND status = '0' order by descricao asc");
					while($l = mysql_fetch_array($categorias)){
						echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>'; 
					}
				?>		
			</select>
		</div>
		<?php
		exit;
	}
	//Contrato - Multiple
	if($atu=='ac'){
		echo '<label style="width:100%"><small>Filial:</small>';
			echo "<select name=\"ob[]\" class=\"sel\" multiple=\"multiple\">";
				$obras = mysql_query("select * from notas_obras where cidade IN($cidade) and id in($obra_usuario) order by descricao asc");
				while($l = mysql_fetch_array($obras)) {
					echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>';
				}
			echo '</select>
		</label>';
		exit;
	}
	//Equipe + Contrato - Multiple
	if($atu=='equipe'){
		echo '<div class="col-xs-4" style="padding:2px">
				<label style="width:100%"><small>Filial:</small><br/>';
				echo '<select name="ob[]" style="width:100%" class="sel" multiple="multiple">';
					$obras = mysql_query("select * from notas_obras where cidade IN(0,$cidade) and id in(0,$obra_usuario) order by descricao asc");
					while($l = mysql_fetch_array($obras)) {
						echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>';
					}
				echo '</select>
				</label>
			  </div>
			<div class="col-xs-4" style="padding:2px">
				<label style="width:100%"><small>Contas:</small>
					<select name="eq[]" style="width:100%" class="sel" multiple="multiple">';
						$equipe = mysql_query("select * from equipes WHERE obra IN(0,$cidade) order by nome asc");
						while($x = mysql_fetch_array($equipe)) {
							echo '<option value="'.$x['id'].'" selected>'.$x['nome'].'</option>';
						}	
					echo '</select>
				</label>
			</div>';
		exit;
	}
	
	if($atu=='equipe2'){
		?>
						<div class="col-xs-4" style="padding:2px">
							<label style="width:100%"><small>Filial:</small><br/>
							<select name="ob[]" class="sel" multiple="multiple">
								<?php
								$obras = mysql_query("select * from notas_obras where cidade IN(0,$cidade) and id in(0,$obra_usuario) order by descricao asc");
								while($l = mysql_fetch_array($obras)) {
									echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>';
								}
								?>		
							</select>
							</label>
						</div>
						<div class="col-xs-4" style="padding:2px">
							<label style="width:100%">
							<small>Contas:</small>
							<select name="eq[]" class="sel" multiple="multiple">
								<?php
								$encarregados = mysql_query("select * from equipes WHERE obra IN(0,$cidade) order by nome asc");
								while($x = mysql_fetch_array($encarregados)) {
									echo '<option value="'.$x['id'].'" selected>'.$x['nome'].'</option>';
								}
								?>		
							</select>
							</label>
						</div>
		<?php
		exit;
	}
	if($atu=='equipe3'){
		?>
						<div class="col-xs-4" style="padding:2px">
							<label style="width:100%"><small>Categoria: </small>
								<select name="et[]" onChange="$('#item-categoria').load('../functions/functions-load.php?atu=categoria_multiple&categoriaID=' + $(this).val() + '');" class="sel" multiple="multiple">
									<?php
									$sql = mysql_query("select * from notas_categorias WHERE obra in(0,$cidade) AND status = '0' order by descricao asc");
									while($l = mysql_fetch_array($sql)) { extract($l);
										echo '<option value="'.$id.'" selected>'.$descricao.'</option>';
									}
									?>
								</select>
							</label>
						</div>
						<div class="col-xs-4" style="padding:2px">
							<div id="item-categoria">
								<label style="width:100%"><small>Sub-Categoria: </small>
									<select name="sub[]" class="sel" multiple="multiple">
										<?php
										$categoria_controle = mysql_query("select * from notas_categorias WHERE obra in($cidade) AND status = '0' order by descricao asc");
										while($s = mysql_fetch_array($categoria_controle)){
											$cat_ids .= $s['id'].',';
										}
										$cat_ids = substr($cat_ids,0,-1);
										$sql = mysql_query("select * from notas_categorias_sub WHERE id_categoria IN($cat_ids) and status = '0' order by descricao asc");
										while($l = mysql_fetch_array($sql)) { extract($l);
											echo '<option value="'.$id.'" selected>'.$descricao.'</option>';
										}
										?>
									</select>
								</label>
							</div>
						</div>
		<?php
		exit;
	}
	if($atu=='categoria12'){
		?>
						<div class="col-xs-3" style="padding:2px">
							<label style="width:100%"><small>Filial:</small><br/>
							<select name="ob[]" class="sel" multiple="multiple">
								<?php
								$obras = mysql_query("select * from notas_obras where cidade IN(0,$cidade) and id in(0,$obra_usuario) order by descricao asc");
								while($l = mysql_fetch_array($obras)) {
									echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>';
								}
								?>		
							</select>
							</label>
						</div>
						<div class="col-xs-3" style="padding:2px">
							<label style="width:100%">
							<small>Contas:</small>
							<select name="eq[]" class="sel" multiple="multiple">
								<?php
								$encarregados = mysql_query("select * from equipes WHERE obra IN(0,$cidade) order by nome asc");
								while($x = mysql_fetch_array($encarregados)) {
									echo '<option value="'.$x['id'].'" selected>'.$x['nome'].'</option>';
								}
								?>		
							</select>
							</label>
						</div>
						<div class="col-xs-3" style="padding:2px">
							<label style="width:100%"><small>Categoria: </small>
								<select name="et[]" onChange="$('#item-categoria').load('../functions/functions-load.php?atu=categoria_multiple&categoriaID=' + $(this).val() + '');" class="sel" multiple="multiple">
									<?php
									$sql = mysql_query("select * from notas_categorias WHERE obra in(0,$cidade) AND status = '0' order by descricao asc");
									while($l = mysql_fetch_array($sql)) { extract($l);
										echo '<option value="'.$id.'" selected>'.$descricao.'</option>';
									}
									?>
								</select>
							</label>
						</div>
						<div class="col-xs-3" style="padding:2px">
							<div id="item-categoria">
								<label style="width:100%"><small>Sub-Categoria: </small>
									<select name="sub[]" class="sel" multiple="multiple">
										<?php
										$categoria_controle = mysql_query("select * from notas_categorias WHERE obra in($cidade) AND status = '0' order by descricao asc");
										while($s = mysql_fetch_array($categoria_controle)){
											$cat_ids .= $s['id'].',';
										}
										$cat_ids = substr($cat_ids,0,-1);
										$sql = mysql_query("select * from notas_categorias_sub WHERE id_categoria IN($cat_ids) and status = '0' order by descricao asc");
										while($l = mysql_fetch_array($sql)) { extract($l);
											echo '<option value="'.$id.'" selected>'.$descricao.'</option>';
										}
										?>
									</select>
								</label>
							</div>
						</div>
		<?php
		exit;
	}
?>
