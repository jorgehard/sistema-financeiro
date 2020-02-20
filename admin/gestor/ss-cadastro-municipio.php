<?php include("../config.php"); ?>	
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
if(@$ac == 'ins') {
	mysql_query("insert into ss_municipio (descricao) 
											 values ('$descricao')");	
	
	
	$last_id = mysql_insert_id();										 
	echo '<p class="text-success">Usuário adicionado com sucesso!</p>';	
	echo '<script>ldy("rh/consulta-usuarios.php",".conteudo")</script>';
} 

else { ?>

<h3>CADASTRO <small> DE MUNICIPIO</small></h3><br>
<form action="javascript:void(0)" onSubmit="post(this,'gestor/ss-cadastro-municipio.php?ac=ins','.retorno'); this.reset()" enctype="multipart/form-data" >
	
	<div class="col-md-9">
		<label>DESCRIÇÃO:<input type="text" name="descricao" value="" class="form-control input-sm up" size="45" required/></label><br>
								
		<input type="submit" class="btn btn-success btn-sm" value="Salvar"/>
	<div class="col-xs-6 col-sm-4">
	
	</div>
	
</form>

<div class="retorno"></div>

<?php } ?>
