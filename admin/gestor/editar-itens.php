<?php 
	include("../config.php");
	include("../validar_session.php");
	
	if(@$ac=='update') {
		$query = mysql_query("UPDATE ss_itens SET item = '$item', descricao = '$descricao', npreco = '$npreco', quantidade = '$quantidade', preco = '$preco', total = '$total' WHERE id = $id");
		if($query){ 
			echo '<span class="text-success">Informações alteradas com sucesso!!!</span>';
		}
		exit;
	}
?>
<div style="height:100%">
<form action="javascript:void(0)" onSubmit="post(this,'gestor/editar-itens.php?ac=update&id=<?php echo $id ?>','.ajax'); $('#myModal').modal('hide')">
	<?php
		$sql = mysql_query("select * from ss_itens WHERE id = $id");
		while($l = mysql_fetch_array($sql)) { extract($l);
			echo '<label for="" style="width:100%">Item: 
					<input type="text" class="form-control input-sm" name="item" value="'.$item.'" required>
				</label><br/>';
			echo '<label for="" style="width:100%">Descrição: 
					<input type="text" class="form-control input-sm" name="descricao" value="'.$descricao.'" required>
				</label><br/>';
			echo '<label for="" style="width:100%">NPreço: 
					<input type="text" class="form-control input-sm" name="npreco" value="'.$npreco.'" required>
				</label><br/>';
			echo '<label for="" style="width:100%">Quantidade: 
					<input type="number" class="form-control input-sm" name="quantidade" value="'.$quantidade.'" required>
				</label><br/>';
			echo '<label for="" style="width:100%">Preço: 
					<input type="number" step="0.001" class="form-control input-sm" name="preco" value="'.$preco.'" required>
				</label><br/>';
			echo '<label for="" style="width:100%">Total: 
					<input type="number" step="0.001" class="form-control input-sm" name="total" value="'.$total.'" required>
				</label><br/>';
			echo '<label style="width:32%">Status: <select name="status" class="form-control input-sm">';
					if($status==1) { 
						echo '<option value="1" selected>INATIVO</option>
							  <option value="0">ATIVO</option>'; 
					}else{ 
						echo '<option value="0" selected>ATIVO</option>
							  <option value="1">INATIVO</option>'; 
					}
			echo '</select></label> ';
		}
	?>
		<p align="center" style="margin-top:20px"><input type="submit" value="Salvar" style="width:250px;" class="btn btn-success btn-sm" /></p>
</form>

</div>
<div class="resultado"></div>
<div class="ajax"></div>