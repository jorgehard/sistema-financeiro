	<?php
		include("../config.php");
		include("../validar_session.php");
		include("../../functions/function-print.php");
		getData();
		getNivel();

	if(@$ac=='inserir') {
		
		if(mysql_num_rows(mysql_query("select * from ss_rm where numero = '$numero' AND obra = '$obra' ")) > 0) {
			echo '<script>window.alert("Nota ja cadastrada!");</script>';
			exit;
		}
		
		$data_p = implode("-",array_reverse(explode("/",$data_p))); echo $data_p;
		mysql_query("insert into ss_rm (data,obra,numero,tipo_re,num_ci) values ('$data_p','$obra','$numero','$tipo_re', '$num_ci')");
		$i_rm = mysql_insert_id();
		echo '<script>ldy("almoxarifado/editar-rm.php?cod_rm='.$i_rm.'",".conteudo")</script>';
	}
?>
<script>
	  $(function () {
		$('input').iCheck({
		  checkboxClass: 'icheckbox_square-blue',
		  radioClass: 'iradio_square-blue',
		  increaseArea: '20%' // optional
		});
	  });
</script>
	
	<div class="container-fluid" style="padding:0px; position:relative; top: -20px">
		<h3 style="font-family: 'Oswald', sans-serif;letter-spacing:5px; text-align:center"> 
			<p>		
				<img src="http://polemicalitoral.com.br/guaruja/imagens/logo.png" style="position:relative; bottom:10px; right:10px" width="40px"/> 
				Cadastro RM &nbsp; | &nbsp;<small> Após o cadastro, incluir os itens</small>
			</p>
		</h3>
	</div>
	
<div class="panel panel-info" style="width:50%; margin:0 auto;">
	<div class="panel-heading">
		<small style="font-family: 'Oswald', sans-serif; font-size:13px">Cadastrar Retirada</small>
	</div>
	<div class="panel-body">		
	<form class="formulario-info" action="javascript:void(0)" onSubmit="post(this,'almoxarifado/cadastro-rm.php?ac=inserir','.resultado')">
		<label style="width:100%"><small>Selecione a Obra:</small>
			<select name="obra" class="form-control input-sm">
				<?php
				$sql = mysql_query("select * from notas_obras WHERE id IN($obra_usuario) order by descricao asc");
				while($l = mysql_fetch_array($sql)) { extract($l);
					echo '<option value="'.$id.'">'.$descricao.'</option>';
				}
				?>		
			</select>
		</label>
		<label><small>Data:</small>
			<input type="date" name="data_p" value="<?php echo $today['year'].'-'.$today['mon'].'-'.$today['mday']; ?>" max="<?php echo $today['year'].'-'.$today['mon'].'-'.$today['mday']; ?>" class="form-control input-sm" size="6" required/>
		</label>
		<label><small>Número do Documento:</small>
			<input type="text" class="form-control input-sm" name="numero" placeholder="__________/____" onfocus="$(this).mask('9999999999/9999');" required>
		</label>
		<label><small>Número do CI:</small>
			<input type="text" class="form-control input-sm" name="num_ci" placeholder="____/____" onfocus="$(this).mask('9999/9999');" required>
		</label>
		<label style="margin-top:15px;">
			<input type="radio" name="tipo_re" value="1" checked> Investimento
			<input type="radio" name="tipo_re" value="2"> Despesas
		</label>
		<label style="text-align:center; width:100%">
			<input type="submit" value="Avançar" style="width:50%; margin-top:10px;" class="btn btn-primary btn-sm">
		</label>
	</form>
</div>
</div>
<div class="resultado"></div>


