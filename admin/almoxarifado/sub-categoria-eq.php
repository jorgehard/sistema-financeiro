<?php include("../config.php");
	include("../validar_session.php");?>
<script type="text/javascript">
$(document).ready(function(){
	$(".decimal").maskMoney({precision:2})
	$('.sel').multiselect({
      buttonClass: 'btn btn-sm', 
	  numberDisplayed: 1,
	  maxHeight: 200,
	  includeSelectAllOption: true,
	  selectAllText: "Selecionar todos",
	  enableFiltering: true,
	  enableCaseInsensitiveFiltering: true,
	  selectAllValue: 'multiselect-all'
	}); 

});
</script>
		<?php 
		if($control=='1'){
			echo '<label><small>Sub-Categoria</small><select name="sub_categoria" class="form-control input-sm">';
			$sub_categorias = mysql_query("select * from notas_cat_sub where associada in($categoria) order by descricao asc");
			while($l = mysql_fetch_array($sub_categorias)) {
				if($sub_categoria==$l['id']) { echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>'; }
				else { echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>'; }
			}
			echo '</select></label>';
		}else{
			echo '<label>Sub-Categoria:	<select name="sbca[]" id="itens" class="sel" style="width:250px;" multiple="multiple" class="form-control input-sm">';
					$sub_categorias = mysql_query("select * from notas_cat_sub where associada in($categoria) order by descricao asc");
					while($l = mysql_fetch_array($sub_categorias)) {
						if($sub_categoria==$l['id']) { echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>'; }
						else { echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>'; }
					}
			echo '</select></label>';
		}