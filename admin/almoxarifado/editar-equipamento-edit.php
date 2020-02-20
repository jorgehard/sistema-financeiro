<?php include("../config.php") ?>

<script>
$(document).ready(function(){
	
//Deixando o texto em Maiúsculo
$(".up").keyup(function() {
  $(this).val($(this).val().toUpperCase());
});
	
	//$("#tags").blur(function(){
		
	//	var v = $('#tags').val().replace(" ","%");
		
	//	if(v.length > 3) {
	//	$(".autoc").load("ss/cadastro-ss.php?ac=enderecos&busca=" + v); }	
		
	//})	
});
</script>
<?php 

if(@$ac=='inserir-historico') {
	$data = implode("-",array_reverse(explode("/",$data)));
	$sql = mysql_query("insert into notas_historico_equipamentos (id_equipamento,data,historico ) values ('$id','$data','$historico')");
	if($sql) { echo '<script>ldy("almoxarifado/editar-equipamento.php?ac=listar-historico&id='.$id.'",".listar-historico")</script>'; }		
}

if(@$ac=='listar-historico') {
		
		echo '<table class="table table-condensed table-striped table-bordered">';
		echo '<tr><th>Data</th><th>Histórico</th></tr>';
		$sql = mysql_query("select * from notas_historico_equipamentos where id_equipamento = $id"); 
		while($l=mysql_fetch_array($sql)) { extract($l);
			echo '<tr>';
			echo '<td>'.implode("/",array_reverse(explode("-",$data))).'</td>';
			echo '<td>'.$historico.'</td>';
			echo '</tr>';
		}
		echo '</table>';
		exit;
}

if(@$ac == 'up') {
		
		$entrada = implode("-",array_reverse(explode("/",$entrada))); $saida = implode("-",array_reverse(explode("/",$saida)));
		$q = "update notas_equipamentos set obs = '$obs', local = '$local', obra = '$obra', equipe = '$equipe' where id = $id";
		$query = mysql_query($q);
		
		$ip = $_SERVER["REMOTE_ADDR"];
		mysql_query("insert into log (data,user,ip,descricao) values (now(),'$iu','$ip','Exec ".addslashes($q)."')");
		
		if($query) { echo '<p class="text-success">Informações atualizadas</p> <script>$(".retorno").load("almoxarifado/editar-equipamento.php?id='.$id.'")</script>'; }
		else { echo '<p class="text-danger">'.mysql_error().'</p>'; }
		
		exit;

} 

?>

<?php $sql = mysql_query("select * from notas_equipamentos where id = $id"); while($l = mysql_fetch_array($sql)) { extract($l); ?>

	<h4>	Editar <small>As informações do equipamento</small></h4>
		<form action="javascript:void(0)" onSubmit="post(this,'almoxarifado/editar-equipamento.php?ac=up&id=<?php echo $id ?>','.ajax')" enctype="multipart/form-data">
		<div class="well well-sm">		
			<div class="row">
			<div class="col-xs-6 col-sm-4">
	<?php 
	$id_usuario_logado = $_SESSION['id_usuario_logado'];
            		$acesso_login = mysql_result(mysql_query("select * from usuarios where id = $id_usuario_logado"),0,"acesso");
            		if($acesso_login=='almoxarifado' || $acesso_login=='master') {
	?>

			<label>Placa: <br><input type="text" name="placa" value="<?php echo $placa; ?>" class="form-control input-sm"  onfocus="$(this).mask('aaa-9999')" disabled required></label><br/>
			<label>Patrimonio <br><input type="text" name="patrimonio" value="<?php echo $patrimonio; ?>" class="form-control input-sm up" disabled required></label><br/>
			<label>Marca: <br><input type="text" name="marca" value="<?php echo $marca; ?>" class="form-control input-sm up" disabled required></label><br/>
			<label>Modelo: <br><input type="text" name="modelo" value="<?php echo $modelo; ?>" class="form-control input-sm up" disabled required></label><br/>
			<label>Valor: <br><input type="text" name="valor" value="<?php echo $valor; ?>" class="form-control input-sm" disabled required></label><br/>
			<label>Dia Pagamento: <br><input type="text" name="dia_pagamento" value="<?php echo $dia_pagamento; ?>" class="form-control input-sm" disabled required></label><br/>
		<div class="col-xs-6 col-sm-4">
			<label>Ano: <br><input type="text" name="ano" value="<?php echo $ano; ?>" class="form-control input-sm" disabled required></label><br/>
			<label>Chassi / Nº série <br><input type="text" name="chassi" value="<?php echo $chassi; ?>" class="form-control input-sm up" disabled required></label><br/>
			
			<label>Empresa: <br>
				<select name="empresa" class="form-control input-sm" disabled>
					<option value="0"></option>
						<?php 
							$categorias = mysql_query("select * from notas_empresas order by nome asc");
								while($l = mysql_fetch_array($categorias)) {
								if($empresa==$l['id']) { echo '<option value="'.$l['id'].'" selected>'.$l['nome'].'</option>'; }
								else { echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>'; }
								}
						?>			
			</select>
		</label>
		
		<label>Categoria: 
			<select name="categoria" class="form-control input-sm" disabled>
				<?php 
					$categorias = mysql_query("select * from notas_cat_e order by descricao asc");
					while($l = mysql_fetch_array($categorias)) {
						if($categoria==$l['id']) { echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>'; }
						else { echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>'; }
					}
				?>			
			</select>
		</label>
	
		<br>	<label>OBSERVAÇÃO: <br><input type="text" maxlength="300" style="height: 150px;" size="300" name="obs" value="<?php echo $obs; ?>" class="form-control input-sm"></textarea></label><br/>
		</div>
		
		<div class="col-xs-6 col-sm-4">
		<label>Situação: <br>
			<select name="situacao" class="form-control input-sm" disabled>
				<?php 
				          
					$id_usuario_logado = $_SESSION['id_usuario_logado'];
            		$acesso_login = mysql_result(mysql_query("select * from usuarios where id = $id_usuario_logado"),0,"acesso");
            		if($acesso_login=='master' || $acesso_login=='almoxarifado') {
					
					$categorias = mysql_query("select * from notas_eq_situacao where id IN(1,2,3,4,5) order by descricao asc");
					while($l = mysql_fetch_array($categorias)) {
						if($situacao==$l['id']) { echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>'; }
						else { echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>'; }
					}
					
					}
					
					else {
					$categorias = mysql_query("select * from notas_eq_situacao where id IN(1,2,4,5) order by descricao asc");
					while($l = mysql_fetch_array($categorias)) {
						if($situacao==$l['id']) { echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>'; }
						else { echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>'; } } } 
				?>			
			</select>
		</label>
		
		<?php } ?>
		<label>Responsável: <br>
			<select name="local" class="form-control input-sm">
			<option value="0"></option>	
				<?php 
					$categorias = mysql_query("select * from rh_funcionarios where demissao = '0000-00-00' and obra IN(1,3) and categoria = 0 order by nome asc");
					while($l = mysql_fetch_array($categorias)) {
						if($l['id']==$local) { echo '<option value="'.$l['id'].'" selected>'.$l['nome'].'</option>'; }
						else { echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>'; }
					}
				?>			
			</select>
		</label>
		<label>Equipes: <br>
			<select name="equipe" class="form-control input-sm">
			<option value="0"></option>	
				<?php 
					$equipes = mysql_query("select * from equipes where status = 0 and oculto = 1 AND obra IN($cidade_usuario) order by nome asc");
					while($l = mysql_fetch_array($equipes)) {
						if($l['id']==$equipe) { echo '<option value="'.$l['id'].'" selected>'.$l['nome'].'</option>'; }
						else { echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>'; }
					}
				?>			
			</select>
		</label>

		<label>Obra: <br>
			<select name="obra" class="form-control input-sm">
			<option value="0"></option>	
				<?php 
					$obras = mysql_query("select * from notas_obras order by descricao asc");
					while($l = mysql_fetch_array($obras)) {
						if($l['id']==$obra) { echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>'; }
						else { echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>'; }
					}
				?>			
			</select>
		</label>
		<label>STATUS: <select class="form-control input-sm" name="status_2" disabled>
		<option value=""></option>
				<?php 
					$status_dois = mysql_query("select * from status_2 order by descricao asc");
					while($l = mysql_fetch_array($status_dois)) {
						if($l['id']==$status_2) { echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>'; }
						else { echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>'; }
					}
				?>	
	</select></label>	
		
		<label>Tipo de contrato: <br>
			<select name="contrato" class="form-control input-sm" disabled>
			<option value="0"></option>	
				<?php 
					$contratos = mysql_query("select * from rh_contratos order by nome asc");
					while($l = mysql_fetch_array($contratos)) {
						if($l['id']==$contrato) { echo '<option value="'.$l['id'].'" selected>'.$l['nome'].'</option>'; }
						else { echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>'; }
					}
				?>			
			</select>
		</label>
<label>DESCRIÇÃO: 
			<select name="descricao" class="form-control input-sm" disabled>
				<?php 
					$descricaos = mysql_query("select * from notas_cat_e order by descricao asc");
					while($l = mysql_fetch_array($descricaos)) {
						if($descricao==$l['descricao']) { echo '<option value="'.$l['descricao'].'" selected>'.$l['descricao'].'</option>'; }
						else { echo '<option value="'.$l['descricao'].'">'.$l['descricao'].'</option>'; }
					}
				?>			
			</select>
		</label>
		<label>Entrada: <br><input type="text" name="entrada" onfocus="$(this).mask('99/99/9999')" value="<?php echo date("d/m/Y H:i:s"); ?>" class="form-control input-sm" disabled></label><br/>
		<label>Saída: <br><input type="text" name="saida" onfocus="$(this).mask('99/99/9999')" value="<?php echo implode("/",array_reverse(explode("-",$saida))); ?>" class="form-control input-sm" disabled  ></label><br/>
		<input type="submit" value="Atualizar" class="btn btn-success btn-sm">
		<a href="#" class="btn btn-default btn-xs" onclick="window.open('almoxarifado/contratos.php?id=<?php echo $id ?>&contrato=<?php echo $contrato ?>','','width=30, height:30')">Imprimir contrato</a>
		</div>
		</div>
</div>
</form>

<?php } ?>

<div class="ajax"></div>

<div class="historico">
<h4>Inserir <small>histórico de informações</small></h4>
	<form action="javascript:void(0)" onsubmit="post(this,'almoxarifado/editar-equipamento.php?ac=inserir-historico&id=<?php echo $id ?>','.listar-historico')" class="form-inline small">
	<div class="well well-sm">
		<label>Data: <input type="date" name="data" class="form-control input-sm" required></label>	
		<label>Histórico: <textarea cols="40" rows="2" class="form-control input-sm" name="historico" required></textarea></label>	
		<label><input type="submit" class="btn btn-success btn-sm" value="Inserir" /></label>
	</div>
	</form>
	
	<div class="listar-historico">
	<?php
		echo '<table class="table table-condensed table-striped table-bordered">';
		echo '<tr><th>Data</th><th>Histórico</th></tr>';
		$sql = mysql_query("select * from notas_historico_equipamentos where id_equipamento = $id"); 
		while($l=mysql_fetch_array($sql)) { extract($l);
			echo '<tr>';
			echo '<td>'.implode("/",array_reverse(explode("-",$data))).'</td>';
			echo '<td>'.$historico.'</td>';
			echo '</tr>';
		}
		echo '</table>';
	?>	
	</div>
</div>