<?php
	include("../config.php");
	include("../validar_session.php");
	getData();
	getNivel();
?>
<script>
	$(document).ready(function() {
		$('.sel').multiselect({
			buttonClass: 'btn btn-sm', 
			numberDisplayed: 1,
			maxHeight: 500,
			includeSelectAllOption: true,
			selectAllText: "Selecionar todos",
			enableFiltering: true,
			enableCaseInsensitiveFiltering: true,
			selectAllValue: 'multiselect-all',
			buttonWidth: '100%'
		}); 
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
	<?php 	
		if(@$ac == 'localizar') {
			if(!isset($sub) || !isset($est)){
				echo '<div class="alert alert-danger"><strong>Atenção!!!</strong> Selecione todos os campos da consulta!</div>';
				exit;
			}else{
				foreach($sub as $suba) { @$subs .= $suba.','; } $subs = substr($subs,0,-1); //SubCategoria
				foreach($est as $ests) { @$estu .= $ests.','; } $estu = substr($estu,0,-1);
			}
			echo '<div class"container-fluid"><div class"container">';					
			echo '<table id="resultadoTabela" class="table table-striped table-condensed table-color table-bordered">';
			echo '<thead><tr class="small"><th>N</th><th>ID</th><th>Código</th><th>Descrição</th><th>Categoria</th><th>Status</th>';
			if($compras_array == $_SESSION['id_usuario_logado'] || $acesso_login == 'MASTER'){
				echo '<th></th>';
			}
			if($compras_array == $_SESSION['id_usuario_logado'] || $acesso_login == 'MASTER'){
				echo '<th></th>';
			}
			echo '</tr></thead><tbody>';
				
			$sql = mysql_query("select * from notas_itens where descricao LIKE '%$busca%' and categoria IN($subs) and status in($estu) ORDER by descricao asc");
			while($l = mysql_fetch_array($sql)) { extract($l);					
				@$se = 1+@$it3++;
				echo '<tr>';
				echo '<td width="20px" align="center">'.$se.'</td>';
				echo '<td width="30px" align="center">'.$id.'</td>';
				echo '<td>'.$codigo.'</td>';
				echo '<td align="left">'.$descricao.'</td>';
				echo '<td width="200px" align="left">'.@mysql_result(mysql_query("select * from notas_categorias_sub where id = $categoria"),0,"descricao").'</td>';
				echo '<td width="40px" align="center">';
				if($status == '1'){ 
					echo '<span class="btn btn-xs small btn-danger" style="font-size:8px; width:45px;">INATIVO</span>';
				}else if($status == '0'){
					echo '<span class="btn btn-xs small btn-success" style="font-size:8px; width:45px;">ATIVO</span>';
				}
				echo '</td>';
				if($compras_array == $_SESSION['id_usuario_logado'] || $acesso_login == 'MASTER'){
					echo '<td width="40px" align="center"><a href="#" onclick=\'$(".modal-body").load("almoxarifado/editar-material-polemica.php?id='.$id.'")\' data-toggle="modal" data-target="#myModal" style="margin:0px; padding:5px;" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></a></td>';
				}
				if($acesso_login == 'MASTER'){
					echo '<td width="40px" align="center"><a href="#" onclick=\'$(".modal-body").load("almoxarifado/del/excluir-mat-polemica.php?id='.$id.'")\' data-toggle="modal" data-target="#myModal"  class="buttonCel btn btn-xs btn-danger" style="margin:0px; padding:5px; font-weight:bold;"><span class="glyphicon glyphicon-trash"></span></a></td>';
				}
				
				echo '</tr>';	
			}
			echo '</tbody></table>';			
			echo '</div></div>';			
			exit;
		}
	?>
	<div class="container-fluid hidden-print" style="padding:0px 0px 15px 0px; margin-bottom:20px; border-bottom:1px solid #CCC">
		<h3 style="font-family: 'Oswald', sans-serif; letter-spacing:5px;"> 
				CONSULTA DE <small><b>ITEM NOTA</b></small>
			<?php if($compras_array == $_SESSION['id_usuario_logado'] || $acesso_login == 'MASTER'){ ?>
			
			<a href="#" onclick='$(".modal-body").load("almoxarifado/cadastro-polemica.php")' data-toggle="modal" data-target="#myModal" style="letter-spacing:5px; margin-top:10px; margin-right:10px;" class="hidden-xs hidden-print pull-right btn btn-info btn-sm">
				<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;CADASTRAR 
			</a>
			
			<a href="#" onclick="ldy('gestor/consulta-categoria-polemica.php','.conteudo')" style="letter-spacing:5px; margin-top:10px; margin-right:10px;" class="hidden-xs hidden-print pull-right btn btn-success btn-sm"> 
				<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;EDITAR CATEGORIA
			</a>
			<?php } ?>
		</h3>
	</div>
	<div class="well well-sm hidden-print" style="padding:10px 10px 5px 10px;">
		<form action="javascript:void(0)" onsubmit="post(this,'almoxarifado/consulta-materiais-polemica.php?ac=localizar','.retorno')" class="formulario-normal">
			<div class="container-fluid" style="padding:0px">
				<div class="col-xs-3" style="padding:2px">
					<label><small>Buscar:</small>
						<input type="text" name="busca" placeholder="Digite um nome de material EX:(Adaptador)" style="width:100%" class="form-control input-sm">
					</label>
				</div>
				<div class="col-xs-6" style="padding:2px">
					<div class="col-xs-4" style="padding:2px">
						<label style="width:100%"><small>Obra:</small><br/>
							<select name="ci[]" onChange="$('#item-consulta-obra').load('../functions/functions-load.php?atu=equipe3&cidade=' + $(this).val() + '');" class="sel" multiple="multiple" id="categ" required> 
							<?php
								$cidade = mysql_query("select * from notas_obras_cidade WHERE id IN(0,$cidade_usuario) order by nome asc");
								while($l = mysql_fetch_array($cidade)) {
									echo '<option value="'.$l['id'].'" selected>'.$l['nome'].'</option>';
								}
							?>	
							</select>
						</label>
					</div>
					<div id="item-consulta-obra">
						<div class="col-xs-4" style="padding:2px">
							<label style="width:100%"><small>Categoria: </small>
								<select name="et[]" onChange="$('#item-categoria').load('../functions/functions-load.php?atu=categoria_multiple&categoriaID=' + $(this).val() + '');" class="sel" multiple="multiple">
									<?php
									$sql = mysql_query("select * from notas_categorias WHERE obra in($cidade_usuario) AND status = '0' order by descricao asc");
									while($l = mysql_fetch_array($sql)) { extract($l);
										echo '<option value="'.$id.'" selected>'.$descricao.'</option>';
									}
									?>
								</select>
							</label>
						</div>
						<div class="col-xs-4" style="padding:2px">
							<div id="item-categoria">
								<label style="width:100%"><small>Sub-Categoria: </small>
									<select name="sub[]" class="sel" multiple="multiple">
										<?php
										$categoria_controle = mysql_query("select * from notas_categorias WHERE obra in($cidade_usuario) AND status = '0' order by descricao asc");
										while($s = mysql_fetch_array($categoria_controle)){
											$cat_ids .= $s['id'].',';
										}
										$cat_ids = substr($cat_ids,0,-1);
										$sql = mysql_query("select * from notas_categorias_sub WHERE id_categoria IN($cat_ids) and status = '0' order by descricao asc");
										while($l = mysql_fetch_array($sql)) { extract($l);
											echo '<option value="'.$id.'" selected>'.$descricao.'</option>';
										}
										?>
									</select>
								</label>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-2" style="padding:2px">
					<label><small>Status:</small> 
						<select name="est[]" class="sel" multiple="multiple">
							<option value="1" selected> Oculto</option>
							<option value="0" selected> Ativo</option>
						</select>
					</label>
				</div>
				<div class="col-xs-1" style="padding:2px">
					<label><br/>
						<input type="submit" style="margin-left:5px; width:100%" value="Pesquisar" class="btn btn-success btn-sm" />
					</label>
				</div>
			</div>
		</form>
	</div>
	<div class="retorno"></div>
	<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="height:auto;">
		<div class="modal-dialog" style="width:50%;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" style="color:#C9302C; opacity:1; "  onclick="$('.modal').modal('hide')" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Informações</h4>
				</div>
				<div class="modal-body">
					Aguarde um momento &nbsp;&nbsp; <img src="../../imagens/loading.gif" alt="Carregando" width="20px"/>
				</div>
			</div>
		</div>
	</div>