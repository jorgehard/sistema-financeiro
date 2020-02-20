<?php
include("../config.php");
include("../validar_session.php");
getData();
?>

<script type="text/javascript">
$(document).ready(function(){
	$('.sel').multiselect({
      buttonClass: 'btn btn-sm', 
	  numberDisplayed: 1,
	  maxHeight: 200,
	  includeSelectAllOption: true,
	  selectAllText: "Selecionar todos",
	  enableFiltering: true,
	  enableCaseInsensitiveFiltering: true,
	  selectAllValue: 'multiselect-all'
	}); 
});
</script>
<?php 
if($atu=='ac'){
		echo '<label style="width:100%"><small>Contrato:</small><br/>';
			echo "<select name=\"ob[]\"  onChange=\"$('#itens2').load('almoxarifado/relatorio-material-geral.php?atu=ac2&obra_2=' + $(this).val() + '');\" style=\"width:250px;\" class=\"sel\" multiple=\"multiple\">";
				
					$obras = mysql_query("select * from notas_obras where cidade IN($cidade) order by descricao asc");
					while($l = mysql_fetch_array($obras)) {
						echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>';
					}
			echo '</select>
		</label>';
		exit;
	}
	if($ac=='ins') {
		foreach($ob as $obs) { @$obu .= $obs.','; } $obu = substr($obu,0,-1);
		foreach($ci as $cis) { @$cid .= $cis.','; } $cid = substr($cid,0,-1);
		
		$senha_crip = md5($senhaCadastro);
		$count_user = mysql_num_rows(mysql_query("SELECT * FROM usuarios WHERE login = '$loginCadastro' "));
		if($count_user == ''){
			$sql = mysql_query("INSERT INTO usuarios (nome,login,senha,nivel_acesso, acesso_login, obra,cidade,data_cadastro) VALUES ('$nome','$loginCadastro','$senha_crip', '8' , 'USUARIO', '$obu' , '$cid', now() )");	
			if($sql){		 
				echo '<p class="text-success">USUARIO CRIADO COM SUCESSO!</p>';	
				echo '<script>ldy("gestor/consulta-usuarios.php",".conteudo")</script>';
			}else{
				echo '<p class="text-danger">ERROR!!! USUARIO NÃO CADASTRADO, TENTE NOVAMENTE!</p>';	
			}
		}else{
			echo '<p class="text-danger">Este usuario já esta cadastrado, mude o login e tente novamente!!</p>';
		}
		exit;
	} 
?>



<div class="retorno"></div>


	<div style="clear: both; margin-bottom:5px;">
		<h3 style="font-family: 'Oswald', sans-serif;letter-spacing:5px;"> 
			<p>CONSULTA <small> USUÁRIOS CADASTRADOS</small>
			<a href="#" onclick="ldy('gestor/consulta-usuarios.php','.conteudo')" style="margin-left:20px; " class="pull-right btn btn-warning btn-xs"><span class="glyphicon glyphicon-chevron-left"></span> VOLTAR</a>
			</p>
		</h3>
	</div>
	<div style="clear: both;">
		<hr></hr>
	</div>
<div class="panel panel-default">
<div class="panel-heading"><small>CADASTRO DE USUARIOS</small></h5></div>
<form action="javascript:void(0)" onSubmit="post(this,'gestor/cadastro-usuario.php?ac=ins','.retorno'); this.reset()" enctype="multipart/form-data" >
  <div class="panel-body">

	<div class="col-md-6">
		<div class="col-xs-12">
			<label style="width:100%">Nome:<input type="text" name="nome" value="" class="form-control input-sm" size="20" required/></label><br/>
		</div>
		<div class="col-xs-12">
			<label style="width:100%">Login:<input type="text" name="loginCadastro" value="" class="form-control input-sm" size="10" required></label><br/>
		</div>
		<div class="col-xs-12">
			<label style="width:100%">Senha:<input type="password" name="senhaCadastro" value="" class="form-control input-sm" size="20" required></label><br/>
		</div>
		<div class="col-xs-12">
			<label style="width:100%">OBRA:<br/>
				<select name="ci[]" onChange="$('#itens').load('gestor/cadastro-usuario.php?atu=ac&cidade=' + $(this).val() + '');" class="sel" style="width:100%" multiple="multiple" required>
						<?php 
							$obra_consulta = mysql_query("select * from notas_obras_cidade WHERE id <> 0 order by nome asc"); 
							while($l=mysql_fetch_array($obra_consulta)) {
								echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>'; 
							}
						?>	
				</select>
			</label>
		</div>
		<div class="col-xs-12" id="itens">
			<label style="width:100%">CONTRATO:<br/>
				<select name="ob[]" class="sel" style="width:100%" multiple="multiple" required>
						<?php 
							$obra_consulta = mysql_query("select * from notas_obras WHERE id <> 0 AND status = '0' order by descricao asc"); 
							while($l=mysql_fetch_array($obra_consulta)) {
								echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>'; 
							}
						?>	
				</select>
			</label>
		</div>
		<div class="col-xs-12" style="text-align:center">
			<input type="submit" class="btn btn-success btn-sm"  style="width:50%" value="Salvar"/>
		</div>
	</div>

</div>

</form>
