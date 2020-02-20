<?php
	require_once("../config.php");
	require_once("../validar_session.php");
	getData();
	getNivel();
?>
<center>
	<h3 style="font-family: 'Oswald', sans-serif;letter-spacing:8px; margin-bottom:20px">
	<?php 
	if($categoria == '1') {
		echo '<a href="#" style="letter-spacing:5px; position:relative; bottom:10px;" onclick="ldy(\'almoxarifado/cadastro-retirada.php\',\'.conteudo\')" class="pull-left btn btn-primary btn-sm"> <span class="glyphicon glyphicon-plus"></span>&nbsp;Adicionar um novo</a>';
	}else if($categoria == '2'){
		echo '<a href="#" style="letter-spacing:5px; position:relative; bottom:10px;" onclick="ldy(\'almoxarifado/cadastro-retirada-sabesp.php\',\'.conteudo\')" class="pull-left btn btn-primary btn-sm"> <span class="glyphicon glyphicon-plus"></span>&nbsp;Adicionar um novo</a>';
	}else if($categoria == '3'){
		echo '<a href="#" style="letter-spacing:5px; position:relative; bottom:10px;" onclick="ldy(\'almoxarifado/cadastro-rm.php\',\'.conteudo\')" class="pull-left btn btn-primary btn-sm"> <span class="glyphicon glyphicon-plus"></span>&nbsp;Adicionar um novo</a>';
	}
	?>
	
		RETIRADA DE MATERIAIS
			<b> 
				<?php 
				if($categoria=='1') { echo '- POLEMICA'; }
				if($categoria == '2') { echo '- SABESP'; } 
				if($categoria == '3') { echo '- RM'; } 
				?>
			</b>
		<a href="javascript:window.print()" style="letter-spacing:5px; position:relative; bottom:10px;" class="hidden-xs hidden-print pull-right btn btn-warning btn-sm"> <span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Imprimir</a>
	</h3>
</center>
<div class="well well-sm hidden-print" id="id_return">
	<center>
		<label class="formulario-info" style="width:30%">Selecione oque deseja: 
			<select class="form-control input-sm" style="margin-top:10px; font-size:14px; height:auto" name="categoria" onchange="ldy('almoxarifado/relatorio-geral-retirada.php?categoria=' + $(this).val(),'.conteudo')" required>
				<option value="" disabled selected>Selecione algo para continuar</option>				
				<option value="1" <?php if($categoria == '1'){ echo 'selected';} ?>>POLEMICA</option>
				<option value="2" <?php if($categoria == '2'){ echo 'selected';} ?>>SABESP</option>
				<option value="3" <?php if($categoria == '3'){ echo 'selected';} ?>>RM</option>
			</select>
		</label>
	</center>
</div>
<?php 

	if($categoria == 1){
		include_once ("consulta-retirada.php");
		exit;
	}else if($categoria == 2){
		include_once ("consulta-retirada-sabesp.php");
		exit;
	}else if($categoria == 3){
		include_once ("consulta-rm.php");
		exit;
	}

?>