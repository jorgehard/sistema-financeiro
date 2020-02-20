<?php include("../config.php") ?>

<?php 
	if(@$ac=='up') {
		$query = mysql_query("UPDATE `notas_itens` SET `descricao`='$descricao', `categoria`='$categoria' and `oculto`='$oculto' where id = $id") or die (mysql_error());
		if($query) { 
			echo '<span class="text-success">Informações atualizadas com sucesso!</span>'; 
		} else { 
			echo mysql_error(); 
		} 
	
	} else { ?>
	<div class="col-md-5 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<small style="opacity:0.8"><b>Editar Informações de Material</b></small>
			</div>
			<div class="panel-body">
			<?php
			$sql = mysql_query("select * from notas_itens where id = $id");
			while($l = mysql_fetch_array($sql)) { extract($l);
				echo '<form action="almoxarifado/upload-polemica.php?id='.$id.'" enctype="multipart/form-data" method="POST" target="ifrm">';
					echo '<div class="col-md-12">';
						echo '<label>DESCRICAO: <br/><input type="text" name="descricao" value="'.$descricao.'" class="form-control input-sm" size="60" required></label><br/>';
					echo '</div>';
					echo '<div class="col-md-6">';
						echo '<label>CATEGORIA:
							<select class="form-control input-sm" name="categoria">
								<option value="0"></option>';
								$categorias = mysql_query("select * from notas_categorias WHERE status = '0' order by descricao asc"); while($l=mysql_fetch_array($categorias)) {
									if($categoria==$l['id']) { echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>'; }
									else { echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>'; } 	
								} 
						echo '</select></label>';
					echo '</div>';
					echo '<div class="col-md-6">';
						echo '<label>SITUAÇÃO: 
							<select class="form-control input-sm" name="oculto">';
							if($oculto=='1') { 
								echo '<option value="1" selected>Inativo</option>'; 
								echo '<option value="2">Ativo</option>'; 
							}
							else { 
								echo '<option value="1">Inativo</option>'; 
								echo '<option value="2" selected>Ativo</option>'; 
							} 	
						echo '</select></label>';
					echo '</div>';
					echo '<div class="col-md-12">';
						echo '<label><input type="submit" class="btn btn-success btn-sm" value="Atualizar"></label>'; 
					echo '</div>';
				echo '</form>';
			}
?>
			</div>
		</div>
	</div>
	<div class="ajax"></div>
    <iframe name="ifrm" style="display:none"></iframe>
<?php } ?>
