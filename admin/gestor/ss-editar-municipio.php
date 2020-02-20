<?php include("../config.php") ?>
<script>
$(document).ready(function(){
	
//Deixando o texto em Maiúsculo
$(".up").keyup(function() {
  $(this).val($(this).val().toUpperCase());
});
	
	//$("#tags").blur(function(){
		
	//	var v = $('#tags').val().replace(" ","%");
		
	//	if(v.length > 3) {
	//	$(".autoc").load("ss/cadastro-ss.php?ac=enderecos&busca=" + v); }	
		
	//})	
});
</script>
<?php
 
if(@$ac == 'update') {
		
		$query =     mysql_query("UPDATE `ss_municipio` SET `descricao`='$descricao' WHERE id = '$id'");
					
					
		if($query) { echo '<p class="text-success">Informações atualizadas com sucesso!</p>'; }
		else { echo '<p class="text-danger">'.mysql_error().'</p>'; }
		
		exit;
		
} 

?>

<?php $sql = mysql_query("select * from ss_municipio where id = $id"); while($l=mysql_fetch_array($sql)) { extract($l); ?>


<form action="javascript:void(0)" onSubmit="post(this,'gestor/ss-editar-municipio.php?ac=update&id=<?php echo $id ?>','.ajax');" class="small" enctype="multipart/form-data">
		
	<div class="panel panel-default"><div class="panel-heading">INFORMAÇÕES DOS MUNICIPIOS SS</div><div class="panel-body">
	
		
		<div class="col-md-9">
		<label>DESCRIÇÃO:<input type="text" name="descricao" value="<?php echo $descricao ?>" class="form-control input-sm up" size="45" required/></label><br>
		<input type="submit" value="SALVAR" class="btn btn-success btn-sm">

<?php } ?>

</table>

<div class="ajax"></div>

