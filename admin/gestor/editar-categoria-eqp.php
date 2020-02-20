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
		
		$query = mysql_query("UPDATE `notas_cat_e` SET `descricao`='$descricao', `oculto`='$status' WHERE id = '$id'");
		if($query) { echo '<p class="text-success">Informações atualizadas com sucesso!</p>'; }
		else { echo '<p class="text-danger">'.mysql_error().'</p>'; }
		
		exit;
		
} 

?>

<form action="javascript:void(0)" onsubmit='post(this,"gestor/editar-categoria-eqp.php?ac=update&id=<?php echo $id ?>",".retorno")' class="form-horizontal">
		<?php
		$sql = mysql_query("select * from notas_cat_e where id = $id"); 
			
		while($l=mysql_fetch_array($sql)) { extract($l); ?>
		<label>DESCRIÇÃO:<input type="text" name="descricao" value="<?php echo $descricao; ?>" class="form-control input-sm up" size="100" required/></label><br>
		<label for="">Status:</label>
			<select name="status" class="form-control">
				<?php 
				if($oculto == '0'){ 
					echo '<option value="0" selected>ATIVO</option>';
					echo '<option value="1">INATIVO</option>';
				}else if($oculto == '1'){
					echo '<option value="0">ATIVO</option>';
					echo '<option value="1" selected>INATIVO</option>';
				}
				?>
			</select><br/>
			<?php } ?>
		<input type="submit" value="SALVAR" class="btn btn-success btn-sm"/>
</form>

<div class="ajax"></div>
<div class="retorno"></div>

