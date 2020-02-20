<?php include("../config.php"); ?>	
<script>
$(document).ready(function(){
$(".up").keyup(function() {
  $(this).val($(this).val().toUpperCase());
});
});
</script>

<?php 
if(@$ac == 'ins') {
	mysql_query("insert into usuarios_rec (funcionario,mensagem,status) 
											 values ('$funcionario','$mensagem','$status')");	
	
	
	$last_id = mysql_insert_id();										 
	echo '<p class="text-success">Mensagem enviada com sucesso!</p>';	
	echo '<script>ldy("rh/consulta-usuarios.php",".conteudo")</script>';
} 

else { ?>

<h3>ENVIAR MENSAGEM <small> PARA ALGUM FUNCIONARIO</small></h3><br>
<form action="javascript:void(0)" onSubmit="post(this,'gestor/cadastro-mensagem.php?ac=ins','.retorno'); this.reset()" enctype="multipart/form-data" >
	
	<div class="col-md-9">
		<label>Mensagem: <br><input type="text" maxlength="300" style="height: 150px;" size="300" name="mensagem" value="<?php echo $mensagem; ?>" class="form-control input-sm"></textarea></label><br/>
		<label for="">PARA QUAL FUNCIONARIO DESEJA ENVIAR: <br/><select name="funcionario" class="form-control input-sm">
						<?php
						$funcs = mysql_query("select * from usuarios order by nome asc");
						while($l = mysql_fetch_array($funcs)) {
							if($funcionario==$l['id']) { echo '<option value="'.$l['id'].'" selected>'.$l['nome'].'</option>'; }
							else { echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>'; }
						}
						?>
			</select></label>
			<label for="">
				<select name="status" class="form-control input-sm" style="width: 120px">
					<option value="1">NORMAL</option>
					<option value="2">IMPORTANTE</option>
					<option value="3">URGENTE</option>
					
				</select>
				</label>	
		<input type="submit" class="btn btn-success btn-sm" value="Salvar"/>
	<div class="col-xs-6 col-sm-4">
	
	</div>
	
</form>

<div class="retorno"></div>

<?php } ?>
