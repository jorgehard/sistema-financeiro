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
	});
</script>
<?php
if($ac == 'localizar'){
?>
<div class="col-md-12">
		<h4><small>LISTA DE CATEGORIA</small></h4>
		<table class="table table-condensed" style="background:#FFF">
			<thead>
			<tr>
				<th width="10%"></th>
				<th colspan="2"></th>
				<th><center> <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> </center></th>
				<th><center> <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> </center></th>
				
			</tr>
			</thead>
		<tbody>
        <?php
		foreach($et as $ets) { $eta .= $ets.','; } $eta = substr($eta,0,-1);
		foreach($sub as $subs) { $suba .= $subs.','; } $suba = substr($suba,0,-1);
		$sql = mysql_query("SELECT * FROM notas_categorias WHERE id IN($eta) ORDER BY descricao ASC");
		$se = 0;
		while($l = mysql_fetch_array($sql)) { extract($l);
			$se += 1;
			echo '<tr class="info" style="font-weight:bold" id="cupom'.$id.'">';
				echo '<td class="text-primary" >'.$se.'</td>';
				echo '<td class="text-primary" width="20%">'.$descricao.'</td>';
				echo '<td class="text-primary" style="text-align:right">'.mysql_result(mysql_query("SELECT * FROM notas_obras_cidade WHERE id = '$obra'"),0,"nome").'</td>';
				echo '<td width="10%"><center>';
				if($status == '0'){
					echo '<span class="btn btn-xs small btn-success" style="font-size:8px">ATIVO</span>';
				}else{
					echo '<span class="btn btn-xs small btn-danger" style="font-size:8px">INATIVO</span>';
				}
				echo '</center>
				</td>';
				echo '<td width="40px"><a href="#" onclick=\'$(".modal-body").load("gestor/editar-categoria-polemica.php?id='.$id.'")\' data-toggle="modal" data-target="#myModal"  class="btn btn-success btn-sm" style="margin:0px; padding:6px; font-weight:bold;"><span class="glyphicon glyphicon-pencil"></span></a></td>';
			echo '</tr>';
			$sql2 = mysql_query("SELECT * FROM notas_categorias_sub WHERE id IN($suba) AND id_categoria = '$id' ORDER BY descricao ASC");
			$se2 = 0;
			while($c = mysql_fetch_array($sql2)) {
				$se2 += 1;
				echo '<tr style="font-weight:bold; background:#fffde0" id="cupom'.$c['id'].'">';
				echo '<td style="padding-left:20px">'.$se.'.'.$se2.'</td>';
				echo '<td colspan="2">'.$c['descricao'].'</td>';
				echo '<td width="10%"><center>';
				if($c['status'] == '0'){
					echo '<span class="btn btn-xs small btn-success" style="font-size:8px">ATIVO</span>';
				}else{
					echo '<span class="btn btn-xs small btn-danger" style="font-size:8px">INATIVO</span>';
				}
				echo '</center></td>';
								
				echo '<td width="40px"><a href="#" onclick=\'$(".modal-body").load("gestor/editar-categoria-polemica-sub.php?id_categoria='.$id.'&id_subcategoria='.$c['id'].'")\' data-toggle="modal" data-target="#myModal"  class="btn btn-primary btn-xs" style="margin:0px; padding:3px 3px; font-weight:bold; font-size:10px;"><span class="glyphicon glyphicon-pencil"></span></a></td>';
				echo '</tr>'; 
				
				if($expItem == '1'){
					$item = mysql_query("SELECT * FROM notas_itens WHERE categoria = '".$c['id']."' ORDER BY descricao ASC");
					$se3 = 0;
					while($i = mysql_fetch_array($item)){
						$se3 += 1;
						echo '<tr class="small" id="cupomx'.$i['id'].'">';
						echo '<td style="padding-left:40px">'.$se.'.'.$se2.'.'.$se3.'</td>';
						echo '<td colspan="2">'.$i['descricao'].'</td>';
						echo '<td width="10%"><center>';
						if($c['status'] == '0'){
							echo '<span class="btn btn-xs small btn-success" style="font-size:8px">ATIVO</span>';
						}else{
							echo '<span class="btn btn-xs small btn-danger" style="font-size:8px">INATIVO</span>';
						}
						echo '</center></td>';
										
						echo '<td width="40px"></td>';
						echo '</tr>'; 
					}
				}
			}

			
		}

        ?>
		</tbody>
		</table>
	</div>
<? exit; } ?>
	<div class="container-fluid hidden-print" style="padding:0px 0px 15px 0px; margin-bottom:20px; border-bottom:1px solid #CCC">
		<h3 style="font-family: 'Oswald', sans-serif; letter-spacing:5px;"> 
			CONSULTA <small> CATEGORIAS MATERIAL</small>
			
			<a href="#" onclick='$(".modal-body").load("gestor/cadastrar-categoria-polemica.php")' data-toggle="modal" data-target="#myModal" style="margin-left:20px; " class="pull-right btn btn-success btn-sm"><span class="glyphicon glyphicon-pencil"></span> CADASTRAR</a>
			
			<a href="#" onclick="ldy('gestor/consulta-categoria-polemica.php','.conteudo')" style="margin-left:20px;" class="pull-right btn btn-primary btn-sm"><span class="glyphicon glyphicon-refresh"></span> ATUALIZAR PAGINA</a>
			
			<a href="#" onclick="ldy('almoxarifado/consulta-materiais-polemica.php','.conteudo')" style="margin-left:20px;" class="pull-right btn btn-info btn-sm"><span class="glyphicon glyphicon-chevron-left"></span> VOLTAR</a>
		</h3>
	</div>
	<div class="container-fluid">
		<div class="well well-sm hidden-print" >
			<form action="javascript:void(0)" onsubmit="post(this,'gestor/consulta-categoria-polemica.php?ac=localizar','.retorno')" >	
				<div class="container-fluid">
				<div class="col-xs-12" style="padding:2px">
					<div class="col-xs-2" style="padding:2px">
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
					<div class="col-xs-1" style="padding:2px">
						<label style="width:100%"><small>Itens: </small>
							<select name="expItem" class="sel">
								<option value="1">SIM</option>
								<option value="0">NAO</option>
							</select>
						</label>
					</div>
					<div class="col-xs-8" style="padding:0px">
						<div id="item-consulta-obra">
							<div class="col-xs-4" style="padding:2px">
								<label style="width:100%"><small>Categoria: </small>
									<select name="et[]" onChange="$('#item-categoria').load('../functions/functions-load.php?atu=categoria_multiple&categoriaID=' + $(this).val() + '');" class="sel" multiple="multiple">
										<?php
										$sql = mysql_query("select * from notas_categorias WHERE obra in(0,$cidade_usuario) AND status = '0' order by descricao asc");
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
						<div class="col-xs-3" style="padding:2px">
							<label style="width:100%"><br/>
								<input type="submit" style="width:100%" value="Pesquisar" class="btn btn-success btn-sm" />
							</label>
						</div>
					</div>
					
				</div>
				</div>
			</form>
		</div>
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