<?php include("../config.php") ?>
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
		
		$query =     mysql_query("UPDATE `ss_etapas` SET `descricao`='$descricao', `oculto`='$oculto', `pesquisa`='$pesquisa' WHERE id = '$id'");
					
					
		if($query) { echo '<div class="alert alert-success" role="alert"><p class="text-success">Informações atualizadas com sucesso!</p></div>'; }
		else { echo '<p class="text-danger">'.mysql_error().'</p>'; }
		
		exit;
		
} 

?>

<?php $sql = mysql_query("select * from ss_etapas where id = $id"); while($l=mysql_fetch_array($sql)) { extract($l); ?>
<div class="ajax"></div>
<form action="javascript:void(0)" onSubmit="post(this,'gestor/ss-editar-etapas.php?ac=update&id=<?php echo $id ?>','.ajax');" class="small" enctype="multipart/form-data">
		
	<div class="panel-body">

		<label style="width:100%">DESCRIÇÃO:<input type="text" name="descricao" value="<?php echo $descricao ?>" class="form-control input-sm up" style="width:100%" required/></label><br/><br/>
		<label  style="width:100%">STATUS:<br/>
		<select name="oculto" class="form-group input-sm" style="width:100%">
			<?php if($oculto == '0'){
				echo '<option value="0" selected>INATIVO</option>';
				echo '<option value="1">ATIVO</option>';
			}else{
				echo '<option value="1" selected>ATIVO</option>';
				echo '<option value="0" >INATIVO</option>';
			}
			?>
		</select>
		</label><br/>
		<label style="width:100%">PESQUISA:<br/>
		<select name="pesquisa" class="form-group input-sm" style="width:100%">
			<?php if($pesquisa == '0'){
				echo '<option value="0" selected>ATIVO</option>';
				echo '<option value="1">INATIVO</option>';
			}else{
				echo '<option value="0">ATIVO</option>';
				echo '<option value="1" selected>INATIVO</option>';
			}
			?>
		</select>
		</label><br/>
		<input type="submit" style="width:100px;" value="Salvar" class="btn btn-success btn-sm" />
	</div>
<?php } ?>

</table>
