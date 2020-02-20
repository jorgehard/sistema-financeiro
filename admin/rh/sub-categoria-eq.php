<?php include("../config.php") ?>
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
                        if($categoria == 6 || $categoria == 1) { $cat_e = 3; }
                        elseif($categoria == 7) { $cat_e = 1; }
                        else { $cat_e = ''; }

                $cat = $categoria;
	$semarrepedimentos 
                ?>



		<label><select name="sub_categoria" id="itens" style="width:250px;" class="form-control input-sm">

                        <option value="%">SELECIONE UMA SUB-</option>
        		<?php 
					$sub_categorias = mysql_query("select * from equipes where id = '$equipe' order by nome asc");
					while($l = mysql_fetch_array($sub_categorias)) {
						if($sub_categoria==$l['id']) { echo '<option value="'.$l['id'].'" selected>'.$l['nome'].'</option>'; }
						else { echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>'; }
					}
				?>		

		</select></label>


   <!--   <label><select name="item" style="width:80px;" class="form-control input-sm">

        		<?php
                	/*$sql = mysql_query("select * from notas_itens where categoria = $cat order by descricao asc");
                	while($l = mysql_fetch_array($sql)) { extract($l);
        		echo '<option value="'.$id.'">'.$descricao.'</option>';
                	}
        		*/?>

		</select></label> -->
