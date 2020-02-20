<?php
	include("../config.php");
	include("../validar_session.php");
	getData();
	getNivel();
?>
	<div class="alert alert-info" style="width:80%; margin:0 auto">
		<div class="container-fluid" style="padding:0px">
			<div class="col-xs-4" style="padding:2px">
				<?php
				$sql = mysql_query("select * from ss_materiais where id = $id");
				while($l = mysql_fetch_array($sql)) { extract($l); }
					if($tipo == '0') { 
						echo '<img src="http://i.imgur.com/UVXTKq9.jpg" alt="" width="100%" class="img-thumbnail img-responsive">'; 
					}else if($tipo == '1'){
						echo '<img src="'.$imagem.'" alt="" width="100%" class="img-thumbnail img-responsive">'; 
					}else if($tipo == '2'){
						echo '<img src="uploads_sabesp/'.$imagem.'" alt="" width="100%" class="img-thumbnail img-responsive">'; 
					}
				?>
			</div>
			<div class="col-xs-8">		
				<h4 style="font-family:Oswald, sans-serif; letter-spacing:5px; font-size:22px;"><small>Editar informações do material</small></h4>
				<form action="almoxarifado/upload.php?id='.$id.'" target="_blank" enctype="multipart/form-data" method="post" class="formulario-info" style="margin-top:20px">
					<label>Imagem:
						<input type="file" name="myfile" class="form-control input-sm">
					</label>
					<label>Descrição:
						<input type="text" name="descricao" value="<?php echo $descricao; ?>" class="form-control input-sm" required>
					</label>
					<label>Código: 
						<input type="text" name="codigo" value="<?php echo $codigo; ?>" class="form-control input-sm" onfocus="$(this).mask('99999999')" required>
					</label>
					<label>Maximo:
						<input type="number" name="maximo" value="<?php echo $maximo; ?>" class="form-control input-sm" required>
					</label>
					<label>Status:
						<select name="status" class="form-control input-sm">
							<?php if($status == '1'){
								echo '<option value="1" selected>INATIVO</option>';
								echo '<option value="0" >ATIVO</option>';
							}else{
								echo '<option value="0" selected>ATIVO</option>';
								echo '<option value="1" >INATIVO</option>';
							}
							?>
						</select>
					</label>
					<label style="margin-top:10px;">
						<input type="submit" style="width:100%" class="btn btn-primary btn-sm" value="Atualizar">
					</label>
				</form>
			</div>
		</div>
        <div class="ajax"></div>
        <iframe name="ifrm" style="display:none"></iframe>
         
		
