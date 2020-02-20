<?php
include("../config.php");
include("../validar_session.php");
getData();
getNivel();
?>
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
if($ac == 'resultado'){
	foreach($ob as $obs) { @$obu .= $obs.','; } $obu = substr($obu,0,-1);
	echo '<table id="resultadoTabela" class="table table-condensed table-bordered table-color" style="font-size:12px">
		<thead>
			<tr class="small">
				<th style="text-align:center">Código: </th>
				<th style="text-align:center">Num: </th>
				<th style="text-align:center">Data: </th>
				<th style="text-align:center">Obra:</th>
				<th style="text-align:center">Observações:</th>
				<th style="text-align:center">Editar:</th>';
				if($acesso_login == 'MASTER'){ 
					echo '<th style="text-align:center">Excluir:</th>'; 
				} 
	echo '</tr></thead><tbody>';
	$sql = mysql_query("select * from notas_numerario WHERE obra IN($obu) AND numero LIKE '%$busca%' AND (data BETWEEN '$inicial' and '$final') order by id desc");
    while($l = mysql_fetch_array($sql)) { extract($l);

                echo '<tr id="linha'.$id.'">';
                echo '<td style="text-align:center; width:5%">'.$id.'</td>';
                echo '<td style="text-align:center; width:5%">'.$numero.'</td>';
                echo '<td style="text-align:center; width:10%">'.date("d/m/Y", strtotime($data)).'</td>';
                echo '<td style="text-align:center; width:20%">'.mysql_result(mysql_query("SELECT * FROM notas_obras WHERE id = $obra"),0,"descricao").'</td>';
				if($obs == ''){
					echo '<td style="width:20%; text-align:center"> S/OBS </td>';
				}else{
					echo '<td style="width:20%; text-align:center">'.$obs.'</td>';
				}
                echo '<td style="width:3%; text-align:center">';
                echo '<a href="#" onclick=\'ldy("financeiro/protocolo.php?id='.$id.'",".retorno2")\' class="btn btn-xs btn-info" style="margin:0px; padding:0px 5px; font-weight:bold;"><span class="glyphicon glyphicon-edit"></span></a>';
                echo '</td>';
				if($acesso_login=='MASTER'){
					echo '<td style="width:3%; text-align:center">';
						echo '<a href="#" onclick=\'$(".modal-body").load("financeiro/del/excluir-numerario.php?id='.$id.'")\' data-toggle="modal" data-target="#myModal"  class="btn btn-xs btn-danger" style="margin:0px; padding:0px 5px; font-weight:bold;"><span class="glyphicon glyphicon-trash"></span></a>';
					echo '</td>';
				}
                echo '</tr>';
    }
	echo '
	</tbody></table>
	';
	exit;
}
?>
	<div class="container-fluid" style="padding:0px 0px 15px 0px; margin-bottom:20px; border-bottom:1px solid #CCC">
		<img src="../imagens/logo.png" class="img-responsive" width="50px" style="float:left; margin-right:20px"/>
		<h3 style="font-family: 'Oswald', sans-serif; letter-spacing:5px;"> 
			CONSULTA <small><b>LISTA DE NÚMERARIOS</b></small>
			<a href="javascript:window.print()" style="letter-spacing:8px; padding-left:40px; padding-right:40px;" class="hidden-xs hidden-print pull-right btn btn-warning btn-sm"> <span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Imprimir</a>
		</h3>
	</div>
	<div class="well well-sm hidden-print" style="padding:10px 10px 5px 10px;">
		<form action="javascript:void(0)" onsubmit="post(this,'financeiro/listar-numerario.php?ac=resultado','.retorno2')" class="form-inline">
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
				<div class="col-xs-3" style="padding:0px">
					<div class="col-xs-6" style="padding:2px">
						<label style="width:100%"><small>De:</small><br/>
							<input type="date" name="inicial" style="width:100%" value="<?php echo $inicioMes; ?>" class="form-control input-sm"/>
						</label>
					</div>
					<div class="col-xs-6" style="padding:2px">
						<label style="width:100%"><small>ate:</small><br/>
							<input type="date" name="final" style="width:100%" value="<?php echo $todayTotal ?>" class="form-control input-sm"/>
						</label>
					</div>
				</div>
				<div class="col-xs-2" style="padding:2px;">
					<label style="width:100%"><small>Numero:</small>
						<input type="text" name="busca" style="width:100%" placeholder="Ex: 924" class="form-control input-sm">
					</label>
				</div>
				<div class="col-xs-2" style="padding:2px;">
					<label class="pull-right" style="width:100%"><br/>
						<input type="submit" value="Pesquisar" style="width:100%" class="btn btn-success btn-sm">
					</label>
				</div>
	</div>
</form>
</div>
<div class="retorno2"></div>

<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Excluir Funcionario</h4>
      </div>
      <div class="modal-body">
		Aguarde um momento &nbsp;&nbsp; <img src="../../imagens/loading.gif" alt="Carregando" width="20px"/>
      </div>
    </div>
  </div>
</div>
