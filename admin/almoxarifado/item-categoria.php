<?php include("../config.php") ?>


        <label>Item: <br> <select name="item" style="width:180px;" class="form-control input-sm" id="item">

        		<?php
                	$sql = mysql_query("select * from notas_itens where categoria = $cat order by descricao asc");
                	while($l = mysql_fetch_array($sql)) { extract($l);
        		echo '<option value="'.$id.'">'.$descricao.'</option>';
                	}
        		?>

		</select></label>
