<?php include("../config.php") ?>

<link rel="stylesheet" href="../../css/bootstrap.css">
<link rel="stylesheet" href="../../css/theme.css">
<script src="../../js/jquery.js"></script>

<div class="container-fluid">
<h4>Alterar <small>Imagem do funcionário</small></h4>
<form action="?ac=update&id=<?php echo $id ?>" enctype="multipart/form-data" method="POST">
	<label for="">Selecione uma nova imagem: <input type="file" name="imagem" class="form-control input-sm" /></label>
	<input type="submit" value="Alterar imagem" class="btn btn-primary btn-sm"/>		
</form>

<?php
if(@$ac == 'update') {
		
		$imagem_atual = mysql_result(mysql_query("select * from rh_funcionarios where id = $id"),0,"imagem");
		unlink("imagens/$imagem_atual");
		
		$imagem = $_FILES['imagem']['name'];
		$file = date("dmYHis") . trim($imagem);
		$destino = 'imagens/' . $file;
		
		move_uploaded_file($_FILES['imagem']['tmp_name'],$destino);		
		$query =     mysql_query("UPDATE `rh_funcionarios` SET imagem = '$file' WHERE id = '$id'");
					
					
		if($query) { echo '<script>window.close(); $(".retorno").load("rh/editar-funcionario.php?id='.$id.'"); </script><p class="text-success">Informações atualizadas com sucesso!</p>'; }
		else { echo '<p class="text-danger">'.mysql_error().'</p>'; }
		
		
} 

?>
</div>


