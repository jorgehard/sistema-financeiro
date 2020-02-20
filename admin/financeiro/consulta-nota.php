<?php
	include("../config.php");
	include("../validar_session.php");
	include("../../functions/function-print.php");
	getData();
	getNivel();
?>
<script type="text/javascript">
$(document).ready(function(){
	$("table").tablesorter({
		dateFormat : "ddmmyyyy",
		textExtraction: function(node){ 
			var cell_value = $(node).text();
			var sort_value = $(node).data('value');
			return (sort_value != undefined) ? sort_value : cell_value;
		}
	});
	$.fn.dataTable.ext.errMode = 'none';
    $('#resultadoTabela').DataTable({
		"paging": false,
		"lengthChange": false,
		"searching": false,
		"ordering": true,
		"info": false,
		"bAutoWidth": false
    });
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
	if(@$ac == 'medi'){
		$update = mysql_query("UPDATE `notas_nf` SET `medicao`='$medicao' WHERE id = '$id_nota'");
	}
	if(@$ac == 'localizar') { 
		echo '<table id="resultadoTabela" class="table table-color table-condensed">
		<thead>
			<tr class="small" style="font-size:11px">
				<th style="text-align:center">Nota:</th>
				<th style="text-align:center">Valor:</th>
				<th style="text-align:center">Filial:</th>
				<th>Empresa:</th>
				<th style="text-align:center">Obs.:</th>
				<th style="text-align:center">Parc.:</th>
				<th style="text-align:center">Emissão:</th>
				<th class="hidden-print" style="text-align:center">Editar</th>
				<th class="hidden-print" style="text-align:center">Menu</th>';
				if($acesso_login == 'MASTER'){
					echo '<th style="text-align:center">Excluir</th>';
				}
			echo '</tr>
		</thead><tbody>';
		
		foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);
		foreach($ti as $tis) { @$tip .= $tis.','; } $tip = substr($tip,0,-1);

		$i = 1;
		$sql = mysql_query("select *,notas_nf.id as id_nota, notas_nf.obra as obra_nota from notas_nf, empresa_cadastro where empresa_cadastro.id = notas_nf.empresa and notas_nf.obra IN ($oba) and (notas_nf.recebimento between '$inicial' and '$final') AND notas_nf.tipo_nota IN($tip) and (empresa_cadastro.razao_social like '%$busca%' OR notas_nf.numero like '%$busca%' OR notas_nf.observacoes like '%$busca%') order by notas_nf.recebimento") or die (mysql_error());
		while($l = mysql_fetch_array($sql)) { extract($l);
			$u = $i++;
			echo '<tr class="small" id="cupom'.$id_nota.'">';
			echo '<td width="50px" style="text-align:center">'.$numero.'</td>';
			$v_t = 0;
        	$i_add = mysql_query("SELECT * FROM notas_itens_add WHERE nota = $id_nota");
			while($l = mysql_fetch_array($i_add)) { 
            	$descontovalor = $l['valor'] - $l['desconto'];
				$subtotal = $l['quantidade'] * $descontovalor;
				$v_t += number_format($subtotal,"2",",","");
            }
			echo '<td width="75px" data-value="'.$v_t.'" style="text-align:center">R$&nbsp;'.number_format($v_t,"2",",",".").'</td>';
			
			echo '<td width="160px" style="text-align:center">'.mysql_result(mysql_query("select * from notas_obras where id = $obra_nota"),0,"descricao").'</td>';
			$fornecedor_nome = @mysql_result(mysql_query("SELECT * FROM empresa_cadastro WHERE id = '$empresa'"),0,"razao_social");
				
			if( strlen($fornecedor_nome) >= 50 ) {
				$fornecedor_nome = substr($fornecedor_nome, 0, 50).'...<span class="glyphicon glyphicon-eye-open"></span>';
			}else{
				$fornecedor_nome = $fornecedor_nome.'...<span class="glyphicon glyphicon-eye-open"></span>';
			}
			
			echo '<td><a href="#" onclick=\'$(".modal-body").load("financeiro/view-empresa.php?id='.$empresa.'")\' data-toggle="modal" data-target="#myModal4"  class="btn btn-xs" style="margin:0px; padding:0px; font-size:10px; font-weight:bold;">'.$fornecedor_nome.'</a></td>';
			echo '<td style="text-align:center">'.$observacoes.'</td>';
			echo '<td width="5px" style="text-align:center">'.mysql_num_rows(mysql_query("SELECT * FROM notas_nf_venc WHERE nota = '$id_nota'")).'x</td>';
			echo '<td style="text-align:center">'.implode("/",array_reverse(explode("-",$recebimento))).'</td>';
			echo '<td width="30px" class="hidden-print" style="text-align:center">';
				echo '<a href="#" onclick=\'$(".modal-body").load("financeiro/editar-nota.php?id_nota='.$id_nota.'")\' data-toggle="modal" data-target="#editarNota"  class="btn btn-xs btn-primary" style="margin:0px; padding:5px; font-weight:bold;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
			echo '</td>';
			echo '<td width="30px" class="hidden-print" style="text-align:center">';
				echo '<a href="#" onclick=\'$(".retorno").load("financeiro/itens-nota.php?id='.$id_nota.'")\' class="btn btn-info btn-xs" style="margin:0px; padding:5px;"><i class="fa fa-eye" aria-hidden="true"></i></a>';
			echo '</td>';
			if($acesso_login == 'MASTER'){
				echo '<td width="40px" class="hidden-print" style="text-align:center"><a href="#" onclick=\'$(".modal-body").load("financeiro/del/excluir-nota.php?id_retirada='.$id_nota.'")\' data-toggle="modal" data-target="#myModal2"  class="btn btn-xs btn-danger" style="margin:0px; padding:5px; font-weight:bold;"><span class="glyphicon glyphicon-trash"></span></a></td>';
			}
			echo '</tr>';
		}
		echo '</tbody></table>';
	exit;
} 
?>
	<div class="panel panel-default" style="width:100%;">
		<h4 class="title-box"> <i class="fa fa-money" aria-hidden="true"></i> Consulta | Notas Fiscais
			<!--<a href="javascript:window.print()" style="letter-spacing:8px; padding-left:40px; padding-right:40px;" class="hidden-xs hidden-print pull-right btn btn-warning btn-sm"> <span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Imprimir</a>-->
		</h4>
		<div class="panel-body " style="background:#FFF;">	
			<form action="javascript:void(0)" onsubmit="post(this,'financeiro/consulta-nota.php?ac=localizar','.retorno')" >
				<div class="container-fluid" style="padding:0px">
					<div class="col-xs-4" style="padding:0px">
						<div class="col-xs-4" style="padding:2px">
							<label style="width:100%"><small>Obra:</small><br/>
								<select name="ci[]" onChange="$('#item-consulta-obra').load('../functions/functions-load.php?atu=ac&cidade=' + $(this).val() + '');" style="width:250px;" class="sel" multiple="multiple" id="categ" required> 
								<?php
									$cidade = @mysql_query("select * from notas_obras_cidade WHERE id IN(0,$cidade_usuario) order by nome asc");
									while($l = @mysql_fetch_array($cidade)) {
										echo '<option value="'.$l['id'].'" selected>'.$l['nome'].'</option>';
									}
								?>	
								</select>
							</label>
						</div>
						<div class="col-xs-4" style="padding:2px">
							<label id="item-consulta-obra" style="width:100%">
								<label style="width:100%"><small>Contrato:</small><br/>
									<select name="ob[]" class="sel" multiple="multiple">
										<?php
											$obras = @mysql_query("select * from notas_obras where id IN(0,$obra_usuario) order by descricao asc");
											while($l = @mysql_fetch_array($obras)) {
												echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>';
											}
										?>		
									</select>
								</label>
							</label>
						</div>
						<div class="col-xs-4" style="padding:2px">
							<label style="width:100%"><small>Tipo:</small><br/>
								<select name="ti[]" class="sel" multiple="multiple" required> 
									<option value="0" selected>NOTA FISCAL - DESPESAS</option>
									<option value="1" selected>FATURA DE LOCAÇÃO</option>
									<option value="2" selected>VENDA</option>
								</select>
							</label>
					</div>
					</div>
					
					<div class="col-xs-4" style="padding:2px">
						<label style="width:100%"><small>Buscar:</small><br/>
							<input type="text" name="busca" placeholder="Busque por empresas, numero NF ou observações" size="40" class="form-control input-sm">
						</label>
					</div>
					<div class="col-xs-3" style="padding:0px">
						<div class="col-xs-6" style="padding:2px">
							<label style="width:100%"><small>Data NF:</small><br/>
								<input type="date" name="inicial" value="<?php echo $inicioMes; ?>" class="form-control input-sm"/>
							</label>
						</div>
						<div class="col-xs-6" style="padding:2px">
							<label style="width:100%"><br/>
								<input type="date" name="final" value="<?php echo $todayTotal ?>" class="form-control input-sm"/>
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
			<div class="retorno" style="margin-top:20px; border-top:1px solid #CCC"></div>
		</div>
	</div>
	<div class="modal" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:auto;">
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
	
	<div class="modal" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="height:auto;">
		<div class="modal-dialog" style="width:80%;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" style="color:#C9302C; opacity:1; "  onclick="$('.modal').modal('hide')" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Visualizar empresa</h4>
				</div>
				<div class="modal-body">
					Aguarde um momento &nbsp;&nbsp; <img src="../../imagens/loading.gif" alt="Carregando" width="20px"/>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal" id="editarNota" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="height:auto;">
		<div class="modal-dialog" style="width:50%;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" style="color:#C9302C; opacity:1; "  onclick="$('.modal').modal('hide')" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Editar informações da nota</h4>
				</div>
				<div class="modal-body">
					Aguarde um momento &nbsp;&nbsp; <img src="../../imagens/loading.gif" alt="Carregando" width="20px"/>
				</div>
			</div>
		</div>
	</div>
