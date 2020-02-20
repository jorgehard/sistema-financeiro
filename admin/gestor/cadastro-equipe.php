<?php 
include("../config.php");
include("../validar_session.php"); 
if(@$ac=='inserir') {
	$nome = trim($nome);
	if(mysql_num_rows(mysql_query("select * from equipes where nome = '$nome'")) == 0) {
		$query = mysql_query("insert into equipes (nome,status,obra) values ('$nome','0','$obra')"); 
		if($query){
			echo '<div class="alert alert-success" style="width:60%; padding:20px; margin:0 auto;">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				 	 <strong>Parabéns!</strong> Equipe cadastrada com sucesso!!!
				</div>';	
		}else{
			echo '<div class="alert alert-danger" style="width:60%; padding:20px; margin:0 auto;">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				 	 <strong>Error!</strong> Espere, algo aconteceu de errado, verifique as informações e tente novamente!!!
				</div>';
		}
	} else {
		echo '<div class="alert alert-danger" style="width:60%; padding:20px; margin:0 auto;">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 	 <strong>Duplicada!!</strong> Equipe já cadastrada no sistema!!!
			</div>';
	}
	exit;
}
?>

	<div class="text-center" style="clear: both; margin-top:10px;">
		<h3 style="font-family: 'Oswald', sans-serif; letter-spacing:5px; text-align:center"> 
			<img src="../imagens/litoralrent-logo.png" width="150px"/><br/>
		</h3>
	</div>
	<div class="ajax"></div>
	<div class="well well-sm hidden-print" style="width:60%; padding:20px; margin:0 auto; margin-top:20px; margin-bottom:20px;">
			<form action="javascript:void(0)" onsubmit="post(this,'gestor/cadastro-equipe.php?ac=inserir','.ajax')">
		<?php
			echo '<label for="" style="width:100%">Nome da Conta: <input type="text" class="form-control input-sm" name="nome" value="'.$nome.'"required></label><br/>';
			echo "<label style=\"width:100%\" >Empresa: 
					<select name=\"obra\" class=\"form-control input-sm\" required>";
						echo '<option value="">SELECIONE UMA OBRA</option>';
					$obras = mysql_query("select * from notas_obras_cidade WHERE id IN($cidade_usuario) order by nome asc");
					while($l = mysql_fetch_array($obras)) {
						echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>';
					}
			echo '</select></label> ';
			
	?>
				<label>
					<input type="submit" class="btn btn-success" style="width:200px; margin-top:5px;" value="Cadastrar">
				</label>
			</form>
	</div>	