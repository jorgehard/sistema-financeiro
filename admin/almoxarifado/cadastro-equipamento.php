<?php
include("../config.php");
include("../validar_session.php");
getData();
?>
<script src="../js/combobox-resume.js"></script>

<style>
label{
	width:100%;
}
</style>
<?php 
if(@$ac == 'ins') {
	$placa = strtoupper($placa);
	$marca = strtoupper($marca);
	if(mysql_num_rows(mysql_query("select * from notas_equipamentos WHERE placa = '$placa'")) == 0) {
		$query = mysql_query("INSERT INTO `notas_equipamentos`(`placa`, `marca`, `valor`, `empresa`, `categoria`,`sub_categoria`,`situacao`, `local`, `obra`,`status_2`) VALUES ('$placa','$marca','$valor','$empresa','$categoria','$sub_categoria','$situacao','$local','$obra','1')"); 
		$last_id = mysql_insert_id();
		
		if($query) { 
			echo '<script>ldy("almoxarifado/editar-equipamento.php?id='.$last_id.'",".conteudo")</script>';
		} else { 
			echo '<p class="text-danger">'.mysql_error().'</p>'; 
		}
	}else{
		echo '<div class="alert alert-danger" style="width:60%; padding:20px; margin:0 auto;">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  <strong>Atenção!!!</strong> Uma mesma placa ja está cadastrada no sistema, verifique e tente novamente!!!
			</div>';	
	}
}
?>
<div class="text-center" style="clear: both; margin:10px 0px 20px 0px;">
	<img src="http://polemicalitoral.com.br/guaruja/imagens/logo.png" width="50px"/>
	<h3 style="font-family: 'Oswald', sans-serif; letter-spacing:5px;"> 
		<p>CADASTRAR <small>  EQUIPAMENTO</small></p>
	</h3>
</div>

<div class="resultado"></div>
<form action="javascript:void(0)" onSubmit="post(this,'almoxarifado/cadastro-equipamento.php?ac=ins','.conteudo')" class="formulario-normal">
	<div class="well well-sm hidden-print" style="width:80%; padding:20px; margin:0 auto;">
		<div class="row">
			<div class="col-xs-6 col-sm-4">
				<label><small>Placa:</small> <br><input type="text" name="placa" onFocus="$(this).mask('aaa-9999')" value="<?php echo $placa ?>" style="text-transform:uppercase" class="form-control input-sm" required /></label><br/>
				<label><small>Marca:</small> <br><input type="text" name="marca" value="<?php echo $marca ?>" class="form-control input-sm" style="text-transform:uppercase" required /></label><br/>
				<label><small>Valor:</small> <br><input type="number" name="valor" step="0.01" value="<?php echo $valor ?>" class="form-control input-sm" required /></label><br/>
			</div>
			<div class="col-xs-6 col-sm-4">
				<label><small>Empresa:</small> <br>
					<select name="empresa" class="form-control input-sm combobox" required>
						<option value="" selected disabled>Selecione uma empresa</option>
						<?php 
							$categorias = mysql_query("select * from notas_empresas order by nome asc");
							while($l = mysql_fetch_array($categorias)) {
								if($empresa == $l['id']){
									echo '<option value="'.$l['id'].'" selected>'.$l['nome'].'</option>';
								}else{
									echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>';
								}
							}
						?>			
					</select>
				</label>
				<label> <small>Selecione uma Categoria:</small> </br>
					<select name="categoria" onChange="$('#itens').load('almoxarifado/sub-categoria-eq.php?control=1&categoria=' + $(this).val() + '');" class="form-control input-sm" id="categ" required>
						<?php 
							$categorias = mysql_query("select * from notas_cat_e  where oculto = '0' AND id <> '0' order by descricao asc");
							while($l = mysql_fetch_array($categorias)) {
								echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>'; 
							}
						?>		
					</select>
				</label>
				<label id="itens"><small>Sub-Categoria</small>
					<label>
						<select name="sub_categoria" class="form-control input-sm" required>
							<option selected disabled>Selecione uma categoria</option>
								
						</select>
					</label>
				</label>
			</div>
			<div class="col-xs-6 col-sm-4">
				<label><small>Situação:</small><br/>
					<select name="situacao" class="form-control input-sm" required>
						<?php 
							$categorias = mysql_query("select * from notas_eq_situacao where status = '0' order by descricao asc");
							while($l = mysql_fetch_array($categorias)) {
								if($situacao==$l['id']) { 
									echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>'; 
								} else { 
									echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>'; 
								}
							}
						?>			
					</select>
				</label>
				<label><small>Responsável:</small> <br>
					<select name="local" class="form-control input-sm combobox" required>
					<option value="" selected disabled>Selecione um funcionario</option>	
						<?php 
							$categorias = mysql_query("select * from rh_funcionarios where status = '0' AND situacao NOT IN(1,5) order by nome asc");
							while($l = mysql_fetch_array($categorias)) {
								if($local==$l['id']) { 
									echo '<option value="'.$l['id'].'" selected>'.$l['nome'].'</option>'; 
								} else { 
									echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>'; 
								}
							}
						?>			
					</select>
				</label><br/>
				<label><small>Obra:</small> <br/>
					<select name="obra" class="form-control input-sm" required>
						<option value="" selected disabled>Selecione uma obra</option>
						<?php 
							$obras = mysql_query("select * from  notas_obras where id IN($obra_usuario) AND status = '0' ORDER BY descricao asc"); 
							while($l=mysql_fetch_array($obras)) {
								if($obra==$l['id']) { 
									echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>'; 
								} else { 
									echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>'; 
								} 	
							}  	
						?>		
					</select>
				</label>
			</div>
		</div>
	</div>
	<center><input type="submit" style="width:30%; margin-top:30px;" value="Inserir" class="btn btn-success btn"></center>
</form>