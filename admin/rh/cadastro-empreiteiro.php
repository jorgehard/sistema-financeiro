<?php include("../config.php"); ?>


<?php 
if(@$ac == 'ins') {
	
	//$admissao = implode("-",array_reverse(explode("/",$admissao))); $demissao = implode("-",array_reverse(explode("/",$demissao)));
	if(mysql_num_rows(mysql_query("select * from rh_funcionarios where nome = '$nome' or cpf = '$cpf'")) > 0) {
		echo '<script>window.top.window.alert("Nome ou documento já cadastrado!");</script>';
		exit;
	}
	
	mysql_query("insert into rh_funcionarios (nome,cpf) values ('$nome','$cpf')");	
		
	$last_id = mysql_insert_id();										 
	echo '<p class="text-success">Empreiteiro adicionado com sucesso!</p>';	
	//echo '<script>ldy("rh/editar-funcionario.php?id='.$last_id.'",".conteudo")</script>';
	exit;
} ?>

<h3>Cadastro<small>de empreiteiros</small></h3>

<form action="javascript:void(0)" onSubmit="post(this,'rh/cadastro-empreiteiro.php?ac=ins','.retorno'); this.reset()" enctype="multipart/form-data" >
<div class="well well-sm">
	<label>Nome: <input type="text" name="nome" class="form-control" size="50" required></label>
	<label>Número do CNPJ: <input type="text" name="cpf" class="form-control" size="15" onfocus="$(this).mask('99.999.999/9999-99')" required></label>
	<label>Razão Social: <input type="text" name="rsocial" class="form-control" size="50" required></label>
	<label>Rua: <input type="text" name="endereco" class="form-control" size="50" required></label>
	<label>Bairro: <input type="text" name="bairro" class="form-control" size="30" required></label>
	<label>Cidade: <input type="text" name="cidade" class="form-control" size="50" required></label>
	<label>CEP: <input type="text" name="cpf" class="form-control" size="15" onfocus="$(this).mask('99999-999')" required></label>
	<label>Estado: <input type="text" name="estado" class="form-control" size="3" required></label>


	<label><input type="submit" value="Salvar" class="btn btn-success"></label>
</div>
</form>

<div class="retorno"></div>


<---

CNPJ
INSCRIÇÃO
RAZÃO SOCIAL
ENDEREÇO
CEP
CIDADE
ESTADO 
PAIS
Nome

