	<?php
		include("../config.php");
		include("../validar_session.php");
		include("../../functions/function-print.php");
		getData();
		getNivel();
	?>
	<script src="../js/combobox-resume.js"></script>

	<div class="container-fluid" style="padding:0px; position:relative; top: -20px">
		<h3 style="font-family: 'Oswald', sans-serif;letter-spacing:5px; text-align:center"> 
			<p>		
				<img src="http://polemicalitoral.com.br/guaruja/imagens/logo.png" style="position:relative; bottom:10px;" width="40px"/> 
				Retirada SABESP &nbsp; | &nbsp;<small> Após o cadastro, incluir os itens</small>
			</p>
		</h3>
	</div>
	<?php 
	if(@$ac == 'ins') {
		$sqlc = mysql_query("INSERT INTO ss_retirada_sabesp (obra, equipe, funcionario, data) values ('$obra', '$equipe', '$funcionario', '$data')"); $i_retirada = mysql_insert_id();
		if($sqlc) { 
			echo '<script> $(".conteudo").load("almoxarifado/editar-retirada-sabesp.php?retirada='.$i_retirada.'"); </script>'; 
		}else{
			echo mysql_error(); 
		}	
		exit;
	} 
	?>
	<div class="ajax"></div>
	<div class="panel panel-info" style="width:60%; margin:0 auto;">
		<div class="panel-heading">
			<small style="font-family: 'Oswald', sans-serif; font-size:13px">
				Cadastrar Retirada
			</small>
		</div>
		<div class="panel-body">		
			<form action="javascript:void(0)" onSubmit="post(this,'almoxarifado/cadastro-retirada-sabesp.php?ac=ins','.ajax')" class="formulario-info">
			<label style="width:100%">Obra:
				<select name="obra" style="width:100%" class="form-control input-sm">
					<option value="" selected disabled>Selecione uma Obra</option>
					<?php
						$sql = mysql_query("select * from notas_obras where id in($obra_usuario)");
						while($l = mysql_fetch_array($sql)) { extract($l);
							echo '<option value="'.$id.'">'.$descricao.'</option>';
						}
					?>				
				</select>
			</label><br/>
			<label id="itens" style="width:100%">
				<label style="width:100%">Equipe:<br/>
					<select name="equipe" class="form-control input-sm combobox" required>
						<option value="" selected> </option>
						<?php
							$sql = mysql_query("select * from equipes where status = 0 and oculto = 1 AND obra IN($cidade_usuario) order by nome asc");
							while($l = mysql_fetch_array($sql)) { extract($l);
								echo '<option value="'.$id.'">'.$nome.'</option>';
							}
						?>				
					</select>
				</label><br/>
				<label style="width:100%" id="funcionarios">Funcionario:<br/>
					<select name="funcionario" class="form-control input-sm combobox" required>
						<option value="" selected> </option>
						<?php
							$sql = mysql_query("select * from rh_funcionarios where demissao = '0000-00-00' and categoria = 0 AND (obra in ($obra_usuario) OR tipo_emp = '1') order by nome asc");
							while($l = mysql_fetch_array($sql)) { extract($l);
								echo '<option value="'.$id.'">'.$nome.'</option>';
							}
						?>
					</select>
				</label><br/>
			</label>
	<label style="width:100%">Data:
		<input type="date" name="data" min="2015-09-16"  style="width:100%" value="<?php echo $todayTotal ?>" class="form-control input-sm" size="6" required/>
	</label>
	<br/>
	<label style="text-align:center; width:100%">
		<input type="submit" value="Avançar" style="width:50%; margin-top:10px;" class="btn btn-primary btn-sm">
	</label>
	
	
</form>
</div>
</div>


