<?php 
	include("../config.php");
	if($categoria == 6 || $categoria == 1) { 
		$cat_e = 3; 
	} elseif($categoria == 7) { 
		$cat_e = 1; 
	} else { 
		$cat_e = ''; 
	}
	$cat = $categoria;
?>
	<label style="width:100%">
		<select name="sub_categoria" style="width:100%"  class="form-control input-sm">
		<?php 
			$sub_categorias = mysql_query("select * from notas_cat_sub where associada = $categoria order by descricao asc");
			while($l = mysql_fetch_array($sub_categorias)) {
				if($sub_categoria==$l['id']) { 
					echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>';
				} else {
					echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>'; 
				}
			}
		?>		
		</select>
	</label>