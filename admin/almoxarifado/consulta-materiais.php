<?php
	include("../config.php");
	include("../validar_session.php");
	include("../../functions/function-print.php");
	getData();
	getNivel();
?>
<script>
	$(document).ready(function() {
		$(".btnPrint").printPage();
		$.fn.dataTable.ext.errMode = 'none';
		$('#resultadoTabela').DataTable({
			"paging": false,
			"lengthChange": false,
			"searching": true,
			"ordering": true,
			"info": false,
			"bAutoWidth": false
			
		});
	});
</script>

<?php  if(@$ac == 'localizar') { ?>
	<table id="resultadoTabela" class="table table-striped table-condensed table-color table-bordered">
		<thead>
			<tr>
				<th style="text-align:center"><small>ID</small></th>
				<th style="text-align:center"><small>CODIGO</small></th>
				<th><small>DESCRIÇÃO</small></th>
				<th style="text-align:center"><span class="glyphicon glyphicon-eye-open"></span></th>
				<th style="text-align:center"><span class="glyphicon glyphicon-picture"></span></th>
				<?php if($editarss_usuario == '1'  || $acesso_login == 'MASTER'){ ?>
				<th style="text-align:center" class="hidden-print"><center><span class="glyphicon glyphicon-cog"></span></th>
				<?php } ?>
				<?php if($acesso_login == 'MASTER'){ ?>
				<th style="text-align:center" class="hidden-print"><center><span class="glyphicon glyphicon-flag"></span></th>
				<?php } ?>
			</tr>
		</thead>
		<tbody>
        <?php
			$sql = mysql_query("select * from ss_materiais where descricao like _utf8 '%$busca%' or codigo like '%$busca%' COLLATE utf8_unicode_ci order by id asc");
			while($l = mysql_fetch_array($sql)) { 
				extract($l);

				echo '<tr class="small">';
				echo '<td style="text-align:center; vertical-align:middle;">'.$id.'</td>';
				echo '<td style="text-align:center; vertical-align:middle;">'.$codigo.'</td>';
				echo '<td style="vertical-align:middle;">'.$descricao.'</td>';
				echo '<td width="40px" style="text-align:center; vertical-align:middle;">';
					if($l['status'] == '1') { 
						echo '<span class="btn btn-xs small btn-danger" style="font-size:8px; width:45px;">INATIVO</span>'; 
					} else { 
						echo '<span class="btn btn-xs small btn-success" style="font-size:8px; width:45px;">ATIVO</span>';
					} 
				echo '</td>';
				echo '<td style="text-align:center; vertical-align:middle;">';
					if($tipo == '0') { 
						echo '<img src="http://i.imgur.com/UVXTKq9.jpg" alt="" width="130px" class="img-thumbnail img-responsive">'; 
					}else if($tipo == '1'){
						echo '<img src="'.$imagem.'" alt="" width="130px" class="img-thumbnail img-responsive">'; 
					}else if($tipo == '2'){
						echo '<img src="uploads_sabesp/'.$imagem.'" alt="" width="130px" class="img-thumbnail img-responsive">'; 
					}
				echo '</td>';
				if($editarss_usuario == '1'  || $acesso_login == 'MASTER'){
					echo '<td width="40px" class="hidden-print" style="text-align:center; vertical-align:middle"><a href="#" onclick=\'ldy("almoxarifado/editar-material.php?id='.$id.'",".retorno")\' class="btn btn-primary btn-xs" style="text-align:center; vertical-align:middle;  height:60px; padding-top:20px;"><span class="glyphicon glyphicon-pencil"></span> Editar</a></td>';
				}
				if($acesso_login == 'MASTER'){
					echo '<td width="40px" class="hidden-print" style="text-align:center; vertical-align:middle"><a href="#" onclick=\'$(".modal-body").load("almoxarifado/del/excluir-mat-sabesp.php?id='.$id.'")\' data-toggle="modal" data-target="#myModal"  class="buttonCel btn btn-xs btn-danger" style="text-align:center; vertical-align:middle;  height:60px; padding-top:20px;"><span class="glyphicon glyphicon-trash"></span> Excluir</a></center></td>';
				}
				
				echo '</tr>';
            }
        ?>
		</tbody></table>

<?php exit; } ?>

<div class="container-fluid hidden-print" style="padding:0px 0px 15px 0px; margin-bottom:20px; border-bottom:1px solid #CCC">
		<img src="../imagens/logo.png" class="img-responsive" width="50px" style="float:left; margin-right:20px"/>
		<h3 style="font-family: 'Oswald', sans-serif; letter-spacing:5px;"> 
			CONSULTA DE <small><b>MATERIAIS SABESP</b></small>
			<a href="#" onclick="ldy('almoxarifado/cadastro-material.php','.conteudo')" style="letter-spacing:5px; padding-left:40px; padding-right:40px; margin:0px 10px" class="hidden-xs hidden-print pull-right btn btn-info btn-sm"> 
			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Cadastrar</a>
			
			<a href="javascript:window.print()" style="letter-spacing:5px; padding-left:40px; padding-right:40px;" class="hidden-xs hidden-print pull-right btn btn-warning btn-sm"> <span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Imprimir</a>
			
		</h3>
	</div>
	<div class="well well-sm hidden-print" style="padding:10px 10px 5px 10px;">
		<form action="javascript:void(0)" class="formulario-normal" onsubmit="post(this,'almoxarifado/consulta-materiais.php?ac=localizar','.retorno')">
			<div class="container-fluid" style="padding:0px">
				<div class="col-xs-6" style="padding:2px">
					<label><input type="text" name="busca" placeholder="Digite o nome do material desejado EX:(Tubo PVC)" size="80" class="form-control input-sm"></label>
				</div>
				<div class="col-xs-2" style="padding:2px">
					<label>
						<input type="submit" style="width:100%;" value="Pesquisar" class="btn btn-success btn-sm" />
					</label>
				</div>
			</div>
		</form>
	</div>
	
	<div class="retorno"></div>

	<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:auto;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Tem certeza disso?</h4>
				</div>
				<div class="modal-body">
					Aguarde um momento &nbsp;&nbsp; <img src="../../imagens/loading.gif" alt="Carregando" width="20px"/>
				</div>
			</div>
		</div>
	</div>
