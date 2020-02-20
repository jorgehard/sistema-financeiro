<?php include("../config.php") ?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
</head>
<script>
$(document).ready(function(){
	
//Deixando o texto em Maiúsculo
$(".up").keyup(function() {
  $(this).val($(this).val().toUpperCase());
});

});
</script>
<?php
 
if(@$ac == 'update') {
		
		$query = mysql_query("UPDATE `notas_cat_sub` SET `descricao`='$descricao',`associada`='$associada' WHERE id = '$id'");
		if($query) { echo '<p class="text-success">Informações atualizadas com sucesso!</p>'; }
		else { echo '<p class="text-danger">'.mysql_error().'</p>'; }
		
		exit;
		
} 

?>

<form action="javascript:void(0)" onsubmit='post(this,"gestor/editar-categoria-sub-eqp.php?ac=update&id=<?php echo $id ?>",".retorno")' class="form-horizontal">
		
	<div>INFORMAÇÕES DA CATEGORIA</div>
		<?php
		$sql = mysql_query("select * from notas_cat_sub where id = $id"); 
			while($l=mysql_fetch_array($sql)) { extract($l); ?>
			
			<label>DESCRIÇÃO:<input type="text" name="descricao" value="<?php echo $descricao; ?>" class="form-control input-sm up" size="45" required/></label><br>
			  <label>ASSOCIADA
			  <select name="associada" style="width:250px;" class="form-control input-sm">
					<?php 
					$categorias = mysql_query("select * from notas_cat_e WHERE oculto = '0' order by descricao asc");
					while($l = mysql_fetch_array($categorias)) {
						if($l['id']==$associada){
							echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>';
						 } else { 
							echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>'; 
						}
					}
				?>		

        	    </select></label>
			<?php } ?>
		<input type="submit" value="SALVAR" class="btn btn-success btn-sm"/>
</form>

<div class="ajax"></div>
<div class="retorno"></div>

