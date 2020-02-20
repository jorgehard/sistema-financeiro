<?php include("../config.php") ?>
<?php
 
if(@$ac == 'update') {
		
		$query =     mysql_query("UPDATE `ss_sub_etapas` SET `descricao`='$descricao',`associada`='$etapa' WHERE id = '$id'");
					
					
		if($query) { echo '<p class="text-success">Informações atualizadas com sucesso!</p>'; }
		else { echo '<p class="text-danger">'.mysql_error().'</p>'; }
		
		exit;
		
} 

?>

<?php $sql = mysql_query("select * from ss_sub_etapas where id = $id"); while($l=mysql_fetch_array($sql)) { extract($l); ?>


<form action="javascript:void(0)" onSubmit="post(this,'gestor/ss-editar-subetapas.php?ac=update&id=<?php echo $id ?>','.ajax');" class="small" enctype="multipart/form-data">
		
	<div class="panel panel-default"><div class="panel-heading">INFORMAÇÕES DAS SUB-ETAPAS</div><div class="panel-body">
	
		
		<div class="col-md-9">
		<label>DESCRIÇÃO:<input type="text" name="nome" value="<?php echo $descricao ?>" class="form-control input-sm up" size="45" required/></label><br>
		<label>ETAPA ASSOCIADA:<input type="text" name="login" value="<?php echo $associada ?>" class="form-control input-sm" size="10"></label>
		
<?php } ?>

</table>

<div class="ajax"></div>

