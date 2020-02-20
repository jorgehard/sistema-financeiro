<?php
	include("../config.php");
	include("../validar_session.php");
	getData();
	getNivel();
?>
<style>
	@media print
	{
		table, tr, thead, tbody, td, th{
			border:1px solid rgba(23, 23, 23, 0.6) !important;
		}
	}
</style>
<script type="text/javascript">
$(document).ready(function(){
	$("table").tablesorter({
		dateFormat : "ddmmyyyy"
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
	$(".decimal").maskMoney({precision:2});
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
	if(@$ac=='salvar-nota'){
		$sql = mysql_query("update pedido_compras set `nota_assoc` = '$nota_assoc' where id = '$id'"); 
		if($sql) { 
			echo '<script>window.alert("Nota inserida com sucesso '.$nota_assoc.'");</script>'; 
		} else { 
			echo '<script>window.alert("'.mysql_error().'");</script>'; 
		}
		exit; 
	}
	if(@$ac=='salvar-pedido'){
		if($prm == '2'){
			$sql2 = mysql_query("update pedido_compras set pedido = '2', data_finalizado = '$todayTotal' where id = $id");
			if($sql2) { 
				echo '<span class="btn btn-danger btn-xs" style="font-size:10px;">FINALIZADO</a>';
			}else{ 
				echo '<script>window.alert("'.mysql_error().'");</script>'; 
			}
		}
		exit;
	}
	if(@$ac=='salvar-tipo'){
		if($prm == '3'){
			$sql2 = mysql_query("update pedido_compras set tipo_pedido = '3' where id = '$id'");
			if($sql2) { 
				echo '<a href="#" class="btn btn-success btn-xs"  style="font-size:10px; font-weight:bold">COTADO</a>';
			}else{ 
				echo '<script>window.alert("'.mysql_error().'");</script>'; 
			}
		}
		exit;
	}
	if(@$ac == 'localizar') { 
		foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);
		foreach($pe as $pes) { @$pea .= $pes.','; } $pea = substr($pea,0,-1);
		foreach($tped as $tpes) { @$tpea .= $tpes.','; } $tpea = substr($tpea,0,-1);
		echo '<table class="hidden-xs hidden-lg hidden-md visible-print" width="100%" style="margin-bottom:20px">';
			echo '<tr>
				<td style="padding:10px; text-align:center" width="10%"><img src="http://guaruja.polemicalitoral.com.br/imagens/logo.png" alt="Logo Polemica" width="50px" /></td>
				<td style="font-size:10px; padding-left:20px;" width="95%">
					<p class="pull-right" style="text-align: right; padding:10px 20px 10px 10px;">
						<b>POLÊMICA SERVIÇOS BÁSICOS LTDA.</b><br/>
						Rua Euclides Miragaia, 700, Salas 82 e 83 - Centro - CEP 12245-820 <br/>
						São José dos Campos - SP - TELEFAX (12) 3941-8555<br/>
						Inscrição Municipal Nº 66.133/3<br/>
						Inscrição Estadual - 645.412.590.115<br/>
					</p>
				</td>
			</tr>';
			echo '<tr> </tr>';
		
			echo '</table>';
			$ano = explode("-",$final);
			echo '
				<p>
					<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
						RELATORIO PEDIDOS DE COMPRA
					</h3>
					<p style="text-align:center;  font-size:14px;"><small>Período: '.implode("/",array_reverse(explode("-",$inicial))).' á '.implode("/",array_reverse(explode("-",$final))).'</small></p>
				</p>
				<hr/>
			';		
		echo '<table id="resultadoTabela" class="table table-condensed table-bordered table-color" style="font-size:12px">';
		echo '<thead><tr class="small"><th>Nº:</th><th>Empresa:</th><th>Obra:</th><th>Encarregado:</th><th>Equipe:</th><th>Funcionario (Retirou):</th><th >Liberado</th><th>Pedido:</th><th>Tipo</th><th>Status:</th><th style="text-align:center">Nota Fiscal:</th><th style="text-align:center"><span class="glyphicon glyphicon-eye-open"></span></th>';
		echo '</tr></thead><tbody>';
		
        $sql = mysql_query("SELECT pedido_compras.* FROM pedido_compras LEFT JOIN notas_empresas ON pedido_compras.fornecedor = notas_empresas.id WHERE notas_empresas.nome LIKE '%$busca%' AND pedido_compras.obra IN($oba) AND (pedido_compras.data BETWEEN '$inicial' and '$final') AND pedido IN($pea) AND tipo_pedido IN($tpea) ORDER BY pedido_compras.id DESC");
		
		while($l = mysql_fetch_array($sql)) { extract($l);
			echo '<tr id="val'.$id.'">';
				echo '<td>'.$id.'</td>';
				$fornecedor_nome = @mysql_result(mysql_query("SELECT * FROM notas_empresas WHERE id = '$fornecedor'"),0,"nome");
				
				if( strlen($fornecedor_nome) >= 20 ) {
					$fornecedor_nome = substr($fornecedor_nome, 0, 20).'...<span class="glyphicon glyphicon-eye-open"></span>';
				}else{
					$fornecedor_nome = $fornecedor_nome.'...<span class="glyphicon glyphicon-eye-open"></span>';
				}
				echo '<td><a href="#" onclick=\'$(".modal-body").load("financeiro/view-empresa.php?id='.$fornecedor.'")\' data-toggle="modal" data-target="#myModal3"  class="btn btn-xs" style="margin:0px; padding:5px; font-weight:bold;">'.$fornecedor_nome.'</a></td>';
				echo '<td>'.mysql_result(mysql_query("SELECT * FROM notas_obras WHERE id = '$obra'"),0,"nome_exibir").'</td>';
				
				$encarregado_nome = mysql_result(mysql_query("SELECT * FROM encarregados WHERE id = '$encarregado'"),0,"nome");
				if( strlen($encarregado_nome) >= 30 ) {
					$encarregado_nome = substr($encarregado_nome, 0, 30).'...';
				}
				
				echo '<td>'.$encarregado_nome.'</td>';
				echo '<td>'.mysql_result(mysql_query("SELECT * FROM equipes WHERE id = '$equipe'"),0,"nome").'</td>';
				echo '<td>'.mysql_result(mysql_query("SELECT * FROM rh_funcionarios WHERE id = '$funcionario'"),0,"nome").'</td>';
				
				echo '<td>';
				if($pedido == '0'){
					echo '<span> - </span>';
				}else if($pedido == '1'){
					echo implode("/",array_reverse(explode("-", $data_liberado)));
				}else if($pedido == '2'){
					echo implode("/",array_reverse(explode("-", $data_finalizado)));
				}
				echo '</td>';
				echo '<td>'.implode("/",array_reverse(explode("-", $data))).'</td>';
				echo '<td style="text-align:center" id="pedidotd'.$id.'">';
				if($tipo_pedido == '0'){
					echo '<a href="#" class="btn btn-success btn-xs" style="font-size:10px; background-color:#6c4baf; border:none; font-weight:bold">PEDIDO</a>';
				}else if($tipo_pedido == '1'){
					echo '<a href="#" class="btn btn-success btn-xs"  onclick=\'ldy("financeiro/consulta-compras.php?ac=salvar-tipo&prm=3&id='.$id.'","#pedidotd'.$id.'")\' style="font-size:10px; font-weight:bold">COTAÇÃO</a>';

				}else if($tipo_pedido == '3'){
					echo '<a href="#" class="btn btn-success btn-xs"  style="font-size:10px; font-weight:bold">COTADO</a>';
				}
				echo '</td>';
				echo '<td style="text-align:center" id="atublock'.$id.'">';
				if($pedido == '0'){
					if($tipo_pedido == '0' || $tipo_pedido == '3'){
						echo '<a href="#" class="btn btn-warning btn-xs" style="font-size:10px; font-weight:bold">PENDENTE</a>';
					}else{
						echo '<a href="#" class="btn btn-warning btn-xs" style="font-size:10px; font-weight:bold" disabled>EM ANALISE</a>';
					}
				}else if($pedido == '1'){
					echo '<a href="#" class="btn btn-success btn-xs" onclick=\'ldy("financeiro/consulta-compras.php?ac=salvar-pedido&prm=2&id='.$id.'","#atublock'.$id.'")\' style="font-size:10px; font-weight:bold">LIBERADO</a>';
				}else if($pedido == '2'){
					echo '<span class="btn btn-danger btn-xs" style="font-size:10px; font-weight:bold">FINALIZADO</span>';
				}
				echo '</td>';
				echo '<td width="10%" align="center" id="nota'.$id.'">';
					if($pedido == '2'){
						echo '<div class="col-xs-12" style="padding:0px;">';
							echo '<div class="col-xs-8" style="padding:0px;">';
									echo '<input type="number" style="text-align:center; width:90%" step="1" id="valor'.$id.'" value="'.$nota_assoc.'" class="form-control input-sm">';
							echo '</div>';
							echo '<div class="col-xs-4" style="padding:0px">';
									echo '<button class="btn btn-sm btn-success" onclick=\'ldy("financeiro/consulta-compras.php?ac=salvar-nota&id='.$id.'&nota_assoc=" + $("#valor'.$id.'").val(),".ajax")\'>
										<span class="glyphicon glyphicon-floppy-disk"></span>
									</button>';
							echo '</div>';
						echo '</div>';	
					}else{
						echo 'S/ Nota';
					}					
				echo '</td>';
				echo '<td style="width:4%; text-align:center"><a href="#" onclick=\'$(".retorno").load("almoxarifado/visu-cadastro-compras.php?pedido='.$id.'&stu=1")\' class="btn btn-xs btn-primary" style="margin:0px; padding:5px; font-weight:bold;" ><span class="glyphicon glyphicon-eye-open"></span></a></td>';
				
			echo '</tr>';

		}
		echo '</tbody></table>';
		exit;
	}
?>
	<div class="container-fluid" style="padding:0px 0px 15px 0px; margin-bottom:20px; border-bottom:1px solid #CCC">
		<img src="../imagens/logo.png" class="img-responsive" width="50px" style="float:left; margin-right:20px"/>
		<h3 style="font-family: 'Oswald', sans-serif; letter-spacing:5px;"> 
			RELATORIO DE <small><b>CONTROLE DE COMPRAS</b></small>
			<a href="javascript:window.print()" style="letter-spacing:8px; padding-left:40px; padding-right:40px;" class="hidden-xs hidden-print pull-right btn btn-warning btn-sm"> <span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Imprimir</a>
		</h3>
	</div>
	<div class="well well-sm hidden-print" style="padding:10px 10px 5px 10px;">
		<form action="javascript:void(0)" class="form-inline" onSubmit="post(this,'financeiro/consulta-compras.php?ac=localizar','.retorno');" class="hidden-print">
			<div class="container-fluid" style="padding:0px">
				<div class="col-xs-3" style="padding:0px">
					<div class="col-xs-6" style="padding:2px">
						<label style="width:100%"><small>Obra:</small><br/>
							<select name="ci[]" onChange="$('#item-consulta-obra').load('../functions/functions-load.php?atu=ac&cidade=' + $(this).val() + '');" style="width:250px;" class="sel" multiple="multiple" id="categ" required> 
							<?php
								$cidade = mysql_query("select * from notas_obras_cidade WHERE id IN(0,$cidade_usuario) order by nome asc");
								while($l = mysql_fetch_array($cidade)) {
									echo '<option value="'.$l['id'].'" selected>'.$l['nome'].'</option>';
								}
							?>	
							</select>
						</label>
					</div>
					<div class="col-xs-6" style="padding:2px">
						<label id="item-consulta-obra" style="width:100%">
							<label style="width:100%"><small>Contrato:</small><br/>
								<select name="ob[]" class="sel" multiple="multiple">
									<?php
										$obras = mysql_query("select * from notas_obras where id IN(0,$obra_usuario) order by descricao asc");
										while($l = mysql_fetch_array($obras)) {
											echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>';
										}
									?>		
								</select>
							</label>
						</label>
					</div>
				</div>
				<div class="col-xs-5" style="padding:0px">
					<div class="col-xs-6" style="padding:2px">
						<label style="width:100%"><small><b>Buscar: </b></small><br/>
							<input type="text" name="busca" placeholder="Digite algo para buscar" class="form-control input-sm" style="width:100%">
						</label>
					</div>
					<div class="col-xs-6" style="padding:0px">
						<div class="col-xs-6" style="padding:2px">
							<label style="width:100%"><small>De:</small><br/>
								<input type="date" name="inicial" value="<?php echo $inicioMes; ?>" class="form-control input-sm" style="width:100%"/>
							</label>
						</div>
						<div class="col-xs-6" style="padding:2px">
							<label style="width:100%"><small>ate:</small><br/>
								<input type="date" name="final" value="<?php echo $todayTotal ?>" class="form-control input-sm" style="width:100%"/>
							</label>
						</div>
					</div>
				</div>
				<div class="col-xs-3" style="padding:0px">
					<div class="col-xs-6" style="padding:2px">
						<label style="width:100%"> <small><b>Tipo: </b></small>
							<select name="tped[]" class="sel" multiple="multiple">
								<option value="0" selected>PEDIDO</option>
								<option value="1,3" selected>COTAÇÃO</option>
							</select>
						</label>
					</div>
					<div class="col-xs-6" style="padding:2px">
						<label style="width:100%"> <small><b>Status: </b></small>
							<select name="pe[]" class="sel" multiple="multiple">
								<option value="0" selected>PENDENTE</option>
								<option value="1" selected>LIBERADO</option>
								<option value="2" selected>FECHADO</option>
							</select>
						</label>
					</div>
				</div>
				<div class="col-xs-1" style="padding:2px;">
					<label class="pull-right" style="width:100%"><br/>
						<input type="submit" value="Pesquisar" style="width:100%" class="btn btn-success btn-sm">
					</label>
				</div>
			</div>
		</form>
	</div>

	<div class="retorno"></div>
	<div class="modal" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="height:auto;">
		<div class="modal-dialog" style="width:80%;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" onclick="$('.modal').modal('hide')" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Visualizar empresa</h4>
				</div>
				<div class="modal-body">
					Aguarde um momento &nbsp;&nbsp; <img src="../../imagens/loading.gif" alt="Carregando" width="20px"/>
				</div>
			</div>
		</div>
	</div>
	<div class="modal" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:auto;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" onclick="$('.modal').modal('hide')" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Excluir</h4>
				</div>
				<div class="modal-body">
					Aguarde um momento &nbsp;&nbsp; <img src="../../imagens/loading.gif" alt="Carregando" width="20px"/>
				</div>
			</div>
		</div>
	</div>