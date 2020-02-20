<?php 
include("../config.php");
include("../validar_session.php"); 

			if(@$ac=='inserir') {
				$descricao = str_replace("'", "", $descricao); $descricao = str_replace(";", "", $descricao);$descricao = str_replace('"', '', $descricao);
				if(mysql_num_rows(mysql_query("select * from ss_materiais where codigo = '$codigo' OR descricao = '$descricao' ")) > 0) { 
					echo '<span class="text-danger">Material já cadastrado!</span>'; 
					exit; 
				}else{
					$query = mysql_query("insert into ss_materiais (codigo,descricao,unidade) values ('$codigo','$descricao','$unidade')");
					if($query) { 
						$query1 = mysql_query("insert into ss_materiais (codigo,descricao,unidade) values ('$codigo','$descricao','$unidade')", $link2);
						$query2 = mysql_query("insert into ss_materiais (codigo,descricao,unidade) values ('$codigo','$descricao','$unidade')", $link3);
						echo '<span class="alert-success" style="border-radius:5px; padding:10px; margin:10px;">Informações inseridas com sucesso!</span> '; 
					} else { 
						echo mysql_error(); 
					} 
				}
				exit;	
			} 
		?>

<h3 style="font-family: 'Oswald', sans-serif;letter-spacing:5px; margin-bottom;10px;">
	CADASTRO <small>MATERIAL <B>SABESP</B></small>
	<a href="#" onclick="ldy('almoxarifado/consulta-materiais.php','.conteudo')" style="letter-spacing:5px; margin-top:10px; margin-right:10px;" class="hidden-xs hidden-print btn btn-info btn-sm"> <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>&nbsp;Voltar</a>
</h3><hr/>
<div class="panel panel-default"> 
	<div class="panel-heading">Insira as informações</div>
	<div class="panel-body">   
		<form action="javascript:void(0)" onsubmit='post(this,"almoxarifado/cadastro-material.php?ac=inserir",".ajax")' class="form-horizontal">
			<label>Código:<br/><input type="text" name="codigo" class="form-control input-sm" size="10" onfocus="$(this).mask('99999999')" required></label><br/>
			<label>Descricão:<br/><input type="text" name="descricao" class="form-control input-sm" size="40" required></label><br/>
			<label>UN:<br/><input type="text" name="unidade" class="form-control input-sm" size="2" required></label>   <br/>
			<label><input type="submit" style="margin-top:10px; width:150px;" value="Cadastrar" class="btn btn-success btn-sm" /></label> 
		</form>
	</div>
</div>	
<div class="ajax"></div>
        
		
