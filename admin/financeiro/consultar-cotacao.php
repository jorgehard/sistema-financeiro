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
    foreach($ci as $cis) { @$ciu .= $cis.','; } $ciu = substr($ciu,0,-1);
	echo'
		<table class="table table-bordered table-condensed table-color">
		<thead><tr class="small">
        <th style="text-align:center">Nº: </th>
        <th style="text-align:center">Cidade: </th>
        <th style="text-align:center">Solicitante: </th>
        <th style="text-align:center">Data:</th>
        <th style="text-align:center">Prazo:</th>
        <th style="text-align:center">Tipo:</th>
        <th style="text-align:center">Editar:</th>'; 
		echo '</tr></thead><tbody>';
	$sql = mysql_query("select * from cadastro_cotacao WHERE cidade IN($ciu) AND (data_cotacao BETWEEN '$inicial' and '$final') order by id desc");
    while($l = mysql_fetch_array($sql)) { extract($l);

                echo '<tr id="linha'.$id.'">';
                echo '<td style="text-align:center; width:5%">'.$id.'</td>';
                echo '<td style="text-align:center; width:15%">'.mysql_result(mysql_query("SELECT * FROM notas_obras_cidade WHERE id = $cidade"),0,"nome").'</td>';
                echo '<td style="text-align:center; width:15%">'.$solicitante.'</td>';
                echo '<td style="text-align:center; width:10%">'.date("d/m/Y", strtotime($data_cotacao)).'</td>';
                echo '<td style="text-align:center; width:20%">'.$prazo.'</td>';
				if($tipo_cotacao == '1'){
					echo '<td style="width:20%; text-align:center">COMPRA</td>';
				}else if($tipo_cotacao == '2'){
					echo '<td style="width:20%; text-align:center">PRESTAÇÃO DE SERVIÇO</td>';
                }else if($tipo_cotacao == '3'){
                    echo '<td style="width:20%; text-align:center">LOCAÇÃO</td>';
				}
                echo '<td style="width:3%; text-align:center">';
                echo '<a href="#" onclick=\'ldy("financeiro/editar-cotacao.php?id='.$id.'",".retorno2")\' class="btn btn-xs btn-info"><span class="glyphicon glyphicon-edit"></span></a>';
                echo '</td>';
				if($acesso_login=='master'){
					echo '<td style="width:3%; text-align:center">';
						echo '<a href="#" onclick=\'$(".modal-body").load("financeiro/del/excluir-numerario.php?id='.$id.'")\' data-toggle="modal" data-target="#myModal"  class="btn btn-xs btn-danger" style="margin:0px; padding:5px; font-weight:bold;"><span class="glyphicon glyphicon-trash"></span></a>';
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
<div class="container-fluid hidden-print" style="padding:0px 0px 15px 0px; margin-bottom:20px; border-bottom:1px solid #CCC">
		<img src="../imagens/logo.png" class="img-responsive" width="50px" style="float:left; margin-right:20px"/>
		<h3 style="font-family: 'Oswald', sans-serif; letter-spacing:5px;"> 
			CONSULTA DE <small><b>COTAÇÕES</b></small>
			<a href="javascript:window.print()" style="letter-spacing:8px; padding-left:40px; padding-right:40px;" class="hidden-xs hidden-print pull-right btn btn-warning btn-sm"> <span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Imprimir</a>
		</h3>
	</div>
	<div class="well well-sm hidden-print" style="padding:10px 10px 5px 10px;">
		<form action="javascript:void(0)" onsubmit="post(this,'financeiro/consultar-cotacao.php?ac=resultado','.retorno2')" class="formulario-normal">
			<div class="container-fluid" style="padding:0px">
				<div class="col-xs-2" style="padding:2px">
					<label style="width:100%"><small>Obra:</small><br/>
						<select name="ci[]" onChange="$('#item-consulta-obra').load('../functions/functions-load.php?atu=equipe&cidade=' + $(this).val() + '');" style="width:250px;" class="sel" multiple="multiple" id="categ" required> 
							<?php
								$cidade = mysql_query("select * from notas_obras_cidade WHERE id IN(0,$cidade_usuario) order by nome asc");
								while($l = mysql_fetch_array($cidade)) {
									echo '<option value="'.$l['id'].'" selected>'.$l['nome'].'</option>';
								}
							?>	
						</select>
					</label>
				</div>
				<div class="col-xs-3" style="padding:0px">
					<div class="col-xs-6" style="padding:2px">
						<label style="width:100%"><small>Periodo:</small><br/>
							<input type="date" name="inicial" value="<?php echo $inicioMes; ?>" max="<?php echo $todayTotal ?>" class="form-control input-sm" style="width:100%" />
						</label>
					</div>
					<div class="col-xs-6" style="padding:2px">
						<label style="width:100%"><small></small><br/>
							<input type="date" name="final" value="<?php echo $todayTotal; ?>" max="<?php echo $todayTotal ?>" class="form-control input-sm" style="width:100%" />
						</label>
					</div>
				</div>
				<div class="col-xs-2" style="padding:2px">
					<label><br/>
						<input type="submit" value="Pesquisar" style="width:100%" class="btn btn-success btn-sm">
					</label>
				</div>
			</div>
		</form>
	</div>
	<div class="retorno2"></div>
