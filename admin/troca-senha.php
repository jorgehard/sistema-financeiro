<?php include("config.php");
if(@$ac == 'update') {
		$senha_crip = md5($senha);
		$query = mysql_query("UPDATE `usuarios` SET `nome`='$nome',`senha`='$senha_crip' WHERE id = ".$_SESSION['id_usuario_logado']."");

		if($query) { echo '<center><p class="text-success">Informações atualizadas com sucesso!</p></center>'; }
		else { echo '<p class="text-danger">'.mysql_error().'</p>'; }
		
		exit;
		
} 
if(isset($_SESSION['id_usuario_logado'])){
?>
<?php $sql = mysql_query("select * from usuarios where id = ".$_SESSION['id_usuario_logado'].""); while($l=mysql_fetch_array($sql)) { extract($l); ?>
<div style="width:400px; margin:0 auto;">
	<div class="panel panel-default">
	<div class="panel-heading">Dados do Usuário</div>
	<div class="panel-body">
	<form action="javascript:void(0)" onSubmit="post(this,'troca-senha.php?ac=update','.ajax');" class="small">

		<div class="col-md-9">
		<label>NOME:<input type="text" name="nome" value="<?php echo $nome ?>" style="margin-bottom:10px" class="form-control input-sm up" size="45" required/></label><br>
		
		<label>LOGIN DE ACESSO:<input type="text" name="login" value="<?php echo $login ?>" style="margin-bottom:10px" class="form-control input-sm" size="10" disabled></label>
		
		<label>SENHA:<input type="password" name="senha" value="" style="margin-bottom:10px" class="form-control input-sm" size="20" autofocus required/></label>
		
		<!--<label>EMAIL:<input type="text" name="email" value="" style="margin-bottom:10px" class="form-control input-sm up" size="45"/></label><br>-->
		
		<label style="margin-bottom:30px;">ACESSO:
			<span class="btn btn-xs btn-danger disabled"><?php echo strtoupper($acesso)?></span>
		</label><br/>
			<input type="submit" class="btn btn-success btn-sm" style="width:100px" value="SALVAR"/>
		</div>
	</form>
	</div>
	</div>
</div>

<?php } 
}else{
	echo '<div class="col-md-12">
				<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
					<span class="sr-only">Error:</span>
					Sessão Expirada!!! Tente novamente!!
				</div>
			</div>';
	echo '<meta http-equiv="refresh" content="2;URL=http://polemicalitoral.com.br/guaruja/">';	
} ?>

<div class="ajax"></div>

