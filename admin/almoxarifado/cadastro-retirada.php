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
				Retirada Polêmica &nbsp; | &nbsp;<small> Após o cadastro, incluir os itens</small>
			</p>
		</h3>
	</div>

<?php 
if(@$ac == 'ins') {
	$data = implode("-",array_reverse(explode("/",$data)));
	mysql_query("insert into notas_retirada (obra,funcionario,equipe,data,data_ref,tipo) values ('$obra','$funcionario','$equipe','$data','$data_ref','1')");
	$retirada = mysql_insert_id();
	echo '<script> $(".conteudo").load("almoxarifado/incluir-itens-retirada.php?retirada='.$retirada.'"); </script>';	
} 

else { ?>
<div class="panel panel-info" style="width:60%; margin:0 auto;">
	<div class="panel-heading"><small style="font-family: 'Oswald', sans-serif; font-size:13px">Cadastrar Retirada</small></div>
	<div class="panel-body">		
		<form action="javascript:void(0)" id="form1" onSubmit="post('#form1','almoxarifado/cadastro-retirada.php?ac=ins','.conteudo')" enctype="multipart/form-data" class="formulario-info">
			<label><small>Obra:</small>
				<select name="obra" class="form-control input-sm" onChange="$('#itens-obra').load('financeiro/cadastrar-comb.php?ac=puxar1&cidade=' + $(this).val() + '');" required>
					<option value="" disabled selected>Selecione uma obra</option>
					<?php
					$obras = mysql_query("select * from notas_obras_cidade WHERE id IN($cidade_usuario) order by nome asc");
					while($l = mysql_fetch_array($obras)) {
						echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>';
					}
					?>		
				</select>
			</label><br>
			<label id="itens-obra" style="width:100%">	
				<label style="width:100%"><small>Contrato:</small>
					<select name="obra" class="form-control input-sm" required>
						<option value="" disabled selected>Selecione um contrato</option>	
					</select>
				</label><br>
			</label>
			<label id="itens-equipe" style="width:100%">
				<label style="width:100%"><small>Equipe:</small>
					<select name="equipe" class="form-control input-sm" required disabled>
						<option value="" selected>Selecione uma obra</option>
					</select>
				</label>
			</label>
			<label style="width:100%" id="funcionarios"><small>Funcionario:</small> <br/>
				<select name="funcionario"class="form-control input-sm combobox" required>
					<option value="" disabled selected>Selecione um funcionario</option>
					<?php
						$sql = mysql_query("select * from rh_funcionarios where demissao = '0000-00-00' and id <> 0 and (obra in($obra_usuario) OR tipo_emp = '1') order by nome asc");
						while($l = mysql_fetch_array($sql)) { extract($l);
							echo '<option value="'.$id.'">'.$nome.'</option>';
						}
					?>
				</select>
			</label><br/>
			<label><small>Data:</small>
				<input type="date" name="data" style="width:100%" value="<?php echo $todayTotal; ?>" max="<?php echo $todayTotal; ?>" class="form-control input-sm" required/>
			</label><br/>
			<label><small>Data Ref:</small>
				<input type="date" name="data_ref" style="width:100%" value="<?php echo $todayTotal; ?>" max="<?php echo $todayTotal; ?>" class="form-control input-sm" required/>
			</label><br/>
			<label style="text-align:center;">
				<input type="submit" value="Avançar" style="width:50%; margin-top:10px;" class="btn btn-primary btn-sm">
			</label>
		</form>
	</div>
</div>
<div class="retorno"></div>

<?php } ?>
