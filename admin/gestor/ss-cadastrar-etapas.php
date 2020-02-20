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
 
if(@$ac == 'insert') {
		
		$query =     mysql_query("INSERT INTO `ss_etapas` (descricao) VALUES ('$descricao')");
					
		if($query) { echo '<div class="alert alert-success" role="alert"><p class="text-success">Informações atualizadas com sucesso!</p></div>'; }
		else { echo '<p class="text-danger">'.mysql_error().'</p>'; }
		
		exit;
		
} 

?>

<div style="clear: both;">
	<h3 style="font-family: 'Oswald', sans-serif;letter-spacing:5px; margin-bottom;10px;"> 
		CADASTRAR <small>ETAPA DA SS</small>
		<a href="#" onclick="ldy('gestor/ss-consulta-etapas.php','.conteudo')" style="letter-spacing:5px; margin-top:10px; margin-right:10px;" class="pull-right hidden-xs hidden-print btn btn-info btn-sm"> <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>&nbsp;Voltar</a>
	</h3>
</div>
<div style="clear: both;">
	<hr></hr>
</div>
<div class="ajax"></div>
<form action="javascript:void(0)" onSubmit="post(this,'gestor/ss-cadastrar-etapas.php?ac=insert&id=<?php echo $id ?>','.ajax');" class="small" enctype="multipart/form-data">
		
	<div class="panel panel-default"><div class="panel-heading"><small>Insira a informação</small></div><div class="panel-body">
		<div class="col-md-9">
		<label>DESCRIÇÃO:<input type="text" name="descricao" class="form-control input-sm up" size="45" required/></label><br>
		<input type="submit" style="width:100px;" value="Salvar" class="btn btn-success btn-sm" />
</table>
