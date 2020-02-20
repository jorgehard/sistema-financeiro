<?php include("../config.php"); include("../validar_session.php"); ?>
<script type="text/javascript">
$(document).ready(function(){
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
	if(@$ac=='update') {
		$sql = mysql_query("UPDATE `encarregados` SET `nome`='$nome',`oculto`='$oculto', `obra`='$oba' WHERE id = '$id'");	
		if($sql) {
			echo '<p class="text-success">INFORMAÇÕES ATUALIZADAS COM SUCESSO!</p>'; 
		} else { 
			echo '<p class="text-danger">'.mysql_error().'</p>'; 
		}
		exit;
	}
?>

        <?php
                $edit_nota = mysql_query("select * from encarregados where id = $id");
                while($l = mysql_fetch_array($edit_nota)) { extract($l); }
        ?>

<form action="javascript:void(0)" onSubmit="post(this,'gestor/editar-encarregados.php?ac=update&id=<?php echo $id; ?>','.result')" enctype="multipart/form-data">
<table class="table table-condensed">

        <tr><th>Nome:</th><td>
			<input type="text" name="nome" size="15" class="form-control input-sm" value="<?php echo $nome ?>" required>
		</td></tr>
        <tr><th>CNPJ:</th><td>
			<input type="text" name="medicao" size="15" class="form-control input-sm" value="<?php echo $cnpj ?>">
		</td></tr>
        	<tr><th>OCULTO:</th><td>
        <select name="oculto" class="form-control input-sm" style="width:250px">

			<?php
					$sql = mysql_query("select oculto from encarregados WHERE id='$id'");
					while($l = mysql_fetch_array($sql)) { 
					extract($l);
						if($oculto == 0) {
							echo '<option value="0" selected>ATIVO</option>'; 
							echo '<option value="1">OCULTO</option>';
						}else{ 
							echo '<option value="1" selected>OCULTO</option>';
							echo '<option value="0">ATIVO</option>';
						}

				}
			?>

        </select>
        </td></tr>
        	<tr><th>OBRA:</th><td>
					<select name="oba" class="form-control input-sm" style="width:100%" required>
						<?php 
							$obra_consulta = mysql_query("select * from notas_obras_cidade WHERE id IN($cidade_usuario)"); 
							while($l=mysql_fetch_array($obra_consulta)) {
								if($l['id'] == $obra){
									echo '<option value="'.$l['id'].'" selected>'.$l['nome'].'</option>'; 
								}else{
									echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>'; 
								}
							}
						?>	
					</select>
        </td></tr>

        <tr><th></th><td><input type="submit" value="Salvar" class="btn btn-success btn-sm"> </td></tr>


</table>
</form>

<div class="result"></div>


