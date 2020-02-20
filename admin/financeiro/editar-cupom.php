<?php
	include("../config.php");
	include("../validar_session.php");
	getData();
?>
<?php
	if(@$ac=='update') {
		$sql = mysql_query("UPDATE `notas_itens_add` SET `item` = '$item_insert', `categoria`='$categoria_insert', `quantidade`='$quantidadeInput', `valor`='$valorInput',`desconto`='$descontoInput' WHERE id = '$item_c'");
		if($sql) { 
			echo '<p class="text-success">Informações atualizadas com sucesso!</p>'; 
		} else { 
			echo '<p class="text-danger">'.mysql_error().'</p>'; 
		}
		exit;
	}
	if($atu=='categoria'){
		echo '<label style="width:100%">
			<select name="item_insert" class="form-control input-sm combobox" required>
				<option value="">Selecionar o Item</option>';
					$sql = mysql_query("select * from notas_itens where status = '0' and categoria = '$categoriaID' order by descricao asc");
					while($l = mysql_fetch_array($sql)) { extract($l);
						if($itemInput == $id){
							echo '<option value="'.$id.'" selected>'.$descricao.'</option>';
						}else{
							echo '<option value="'.$id.'">'.$descricao.'</option>';
						}
					}
			echo '</select>
		</label>	';
		
		exit;
	}
?>
        <?php
                $edit_cupom = mysql_query("select * from notas_itens_add where id = '$item'");
                while($l = mysql_fetch_array($edit_cupom)) { extract($l); }
        ?>
<div class="ajax">
<form action="javascript:void(0)" onSubmit="post(this,'financeiro/editar-cupom.php?ac=update&item_c=<?php echo $id ?>','.ajax')" >
<table class="table table-striped table-condensed">
	<tr>
		<th>Sub-Categoria:</th>
		<td>
			<label style="width:100%">
				<select name="categoria_insert" onChange="$('.item-categoria-modal').load('financeiro/editar-cupom.php?atu=categoria&categoriaID=' + $(this).val() + '');" class="form-control input-sm" required>
					<?php
					$cidade_nt = mysql_result(mysql_query("SELECT cidade FROM notas_obras WHERE id = '$obra_nt'"),0,"cidade");
					
					$categoria_controle = mysql_query("select * from notas_categorias WHERE obra in($cidade_nt) AND status = '0' order by descricao asc");
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

        </td>
	</tr>
        <tr><th>Item:</th>
			<td>
				<div class="item-categoria-modal">
					<label style="width:100%">
						<select name="item_insert" class="form-control input-sm combobox" required>
							<option value="">Selecionar o Item</option>
							<?php
								$item_material = mysql_query("select * from notas_itens where status = '0' and categoria = '$categoria' order by descricao asc");
								while($x = mysql_fetch_array($item_material)) {
									if($item == $x['id']){
										echo '<option value="'.$x['id'].'" selected>'.$x['descricao'].'</option>';
									}else{
										echo '<option value="'.$x['id'].'">'.$x['descricao'].'</option>';
									}
								}
							?>
						</select>
					</label>	
				</div>
			</td>
		</tr>
		<tr><th>Desconto:</th>
			<td>
				<label style="width:100%">
					<input type="number" step="0.001" name="descontoInput" placeholder="R$" value="<?= $desconto ?>" class="form-control input-sm" />
				</label>
			</td>
		</tr>	
		<tr><th>Qtd.:</th>
			<td>
				<label style="width:100%">
					<input type="number" step="0.001" name="quantidadeInput" value="<?= $quantidade ?>" class="form-control input-sm" required />
				</label>
			</td>
		</tr>	
		<tr><th>Valor:</th>
			<td>
				<label style="width:100%">
					<input type="number" step="0.001" name="valorInput" value="<?= $valor ?>" placeholder="R$" class="form-control input-sm " required />
				</label>
			</td>
		</tr>	
        <tr><th></th><td><input type="submit" value="Salvar" style="width:150px" class="btn btn-success btn-sm"></td></tr>
</table>


</form>

<div class="retorno"></div>
<div class="ajax"></div>
</div>

