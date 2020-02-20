<?php include("../config.php") ?>
<script>
$(document).ready(function(){
	
$(".up").keyup(function() {
  $(this).val($(this).val().toUpperCase());
});

});
</script>

<?php 
if(@$ac=='inserir1') {
	$query = mysql_query("insert into notas_cat_e(descricao,oculto) values ('$descricao','0')");
	if($query) { 
		echo '<p class="text-success">Categoria adicionado com sucesso!</p>';	
	echo '<script>ldy("gestor/consulta-categoria-eqp.php",".conteudo")</script>';
	
	} else { 
		echo mysql_error(); 
	}
	exit;	
} 
if(@$ac == 'inserir2') {
	$query = mysql_query("insert into notas_cat_sub (descricao,associada) values ('$descricao','$categoria')");	

	//$last_id = mysql_insert_id();										 
	if($query) { 
		echo '<p class="text-success">Categoria adicionado com sucesso!</p>';	
	echo '<script>ldy("gestor/consulta-categoria-eqp.php",".conteudo")</script>';
	
	} else { 
		echo mysql_error(); 
	}
	exit;	
} 
?>
<div class="adiciotes">

<h3 style="font-family: 'Oswald', sans-serif;letter-spacing:6px;">CADASTRO <small> DE CATEGORIAS & SUB-CATEGORIAS</small>
		<a href="#" onclick="ldy('gestor/consulta-categoria-eqp.php','.conteudo')" style="letter-spacing:5px; margin-top:10px; margin-right:10px;" class="hidden-xs hidden-print pull-right btn btn-info btn-sm"> 
			<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>&nbsp;Voltar
		</a>
		</h3><hr/>
			
<div class="col-md-6">
		<h5><small>CATEGORIA </small></h5>
		<form action="javascript:void(0)" onsubmit='post(this,"gestor/cadastro-categoria-equipamentos-geral.php?ac=inserir1",".retorno")' class="form-horizontal">
				<label>DESCRIÇÃO:<input type="text" name="descricao" value="" class="form-control input-sm up" size="45" required/></label><br/>
				<input type="submit" style="width:100px" class="btn btn-success btn-sm" value="Cadastrar"/>
		</form>
	</div>
	<div class="col-md-6">
		<h5><small>SUB-CATEGORIA</small></h5>
		<form action="javascript:void(0)" onsubmit='post(this,"gestor/cadastro-categoria-equipamentos-geral.php?ac=inserir2",".retorno")' class="form-horizontal">
			<div class="col-md-9">
				<label>DESCRIÇÃO:<input type="text" style="width:400px" name="descricao" value="" class="form-control input-sm up" size="45" required/></label>
				<label>ASSOCIADA: <br>
					<select name="categoria" style="width:400px" class="form-control input-sm" required>
					<option value="0"></option>
						<?php 
							$categorias = mysql_query("select * from notas_cat_e WHERE oculto = 0 order by descricao asc");
							while($l = mysql_fetch_array($categorias)) {
								echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>';
							}
						?>			
					</select>
				</label><br/>						
				<input type="submit" style="width:100px;" class="btn btn-success btn-sm" value="Cadastrar"/>
			</div>
		</form>
	</div>
</div>

<div class="retorno"></div>
