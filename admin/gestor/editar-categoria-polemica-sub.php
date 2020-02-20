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
	$query = mysql_query("UPDATE `notas_categorias_sub` SET `descricao`='$descricaoInput', `status`='$statusInput', `id_categoria` = '$categoriaInput' WHERE id = '$id'");
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

<?php 
$sql = mysql_query("select * from notas_categorias_sub where id = '$id_subcategoria'"); 
while($l=mysql_fetch_array($sql)) { extract($l); }
?>
<div class="container-fluid" style="padding:10px">

<div class="ajax"></div>
<form action="javascript:void(0)" onSubmit="post(this,'gestor/editar-categoria-polemica-sub.php?ac=update&id=<?php echo $id_subcategoria ?>','.ajax');" class="formulario-info">

		<div class="col-md-12">
			<div class="col-xs-12">
				<label style="width:100%"><small>Categoria:</small>
					<select name="categoriaInput" style="width:100%" class="form-control input-sm">
						<?php 
							$cidade_controle = mysql_result(mysql_query("select * from notas_categorias WHERE id = '$id_categoria'"),0,"obra");
							$categorias = mysql_query("select * from notas_categorias WHERE obra IN($cidade_controle) and status = '0' order by descricao asc");
							while($lx = mysql_fetch_array($categorias)){
								if($lx['id'] == $id_categoria){
									echo '<option value="'.$lx['id'].'" selected>'.$lx['descricao'].'</option>'; 
								}else{
									echo '<option value="'.$lx['id'].'">'.$lx['descricao'].'</option>'; 
								}
							}
						?>		
					</select>
				</label>
			</div>
			<div class="col-xs-12">
				<label style="width:100%"><small>Descrição:</small><input type="text" name="descricaoInput" value="<?= $descricao ?>" class="form-control input-sm" required/></label><br>
			</div>
			<div class="col-xs-12">
				<label><small>Status:</small>
					<select name="statusInput" style="width:100%" class="form-control input-sm">
						<?php if($status == 0) { ?>
						<option value="0" selected>ATIVO</option>
						<option value="1">INATIVO</option>
						<?php }else{ ?>
						<option value="0">ATIVO</option>
						<option value="1" selected>INATIVO</option>
						<?php } ?>
					</select>
				</label>
			</div>
			<div class="col-xs-12" style="text-align:center;">
				<label style="text-align:center; margin-top:10px">
					<input type="submit" class="btn btn-primary btn-sm"  style="width:50%" value="Salvar"/>
				</label>
			</div>
		</div>
	</form>
</div>

