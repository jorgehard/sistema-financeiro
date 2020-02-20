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
	mysql_query("insert into ss_etapas (descricao,oculto) 
											 values ('$descricao','1')");	
	
	
	$last_id = mysql_insert_id();										 
	echo '<p class="text-success">ETAPA ADICIONA COM SUCESSO!!!</p>';	
} 

else { ?>

<h3>CADASTRO <small> DE SUB-ETAPAS</small></h3><br>
<form action="javascript:void(0)" onSubmit="post(this,'gestor/ss-subetapas.php?ac=ins','.retorno'); this.reset()" enctype="multipart/form-data" >
	
	<div class="col-md-9">
		<label>DESCRIÇÃO:<input type="text" name="descricao" value="" class="form-control input-sm up" size="45" required/></label>				
		<input type="submit" class="btn btn-success btn-sm" value="Salvar"/>	
</form>

<div class="retorno"></div>

<?php } ?>
