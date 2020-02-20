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
	if(@$ac == 'localizar') { 
		echo '
		<table id="resultadoTabela" class="table table-condensed table-striped table-color">
			<thead>
				<tr class="small">
					<th>Id</th>
					<th>Documento:</th>
					<th>Nome:</th>
					<th>Tipo: </th>
					<th>Status: </th>
					<th style="text-align:center"><span class="glyphicon glyphicon-print"><span></th>
					<th style="text-align:center"><span class="glyphicon glyphicon-cog"><span></th>
					<th style="text-align:center"><span class="glyphicon glyphicon-flag"><span></th>
				</tr>
			</thead>
			<tbody>';

		foreach($ti as $tis) { @$tiu .= $tis.','; } $tiu = substr($tiu,0,-1);
		
        $sql = mysql_query("SELECT * FROM empresa_cadastro WHERE id <> '0' AND (razao_social LIKE '%$busca%' OR cnpj LIKE '%$busca%') AND tipo in ($tiu) ORDER BY id DESC");
		while($l = mysql_fetch_array($sql)) { extract($l);
			echo '<tr class="small" id="empresa'.$id.'">';
			echo '<td>'.$id.'</td>';
			echo '<td>'.$cnpj.'</td>';
			echo '<td>'.$razao_social.'</td>';
			echo '<td style="text-align:center">'.($tipo == 0 ? 'JURIDICA' : 'FISICA' ).'</td>';
			echo '<td style="text-align:center">';
			if($status == '0'){
				echo '<span class="label label-success">ATIVO</span>';
			}else{
				echo '<span class="label label-danger">INATIVO</span>';
			}
			echo '</td>';
			
			echo '<td style="text-align:center"><a href="financeiro/imprimir-ficha-empresa.php?id='.$id.'" target="_blank" style="margin:0px; padding:2px 5px; font-weight:bold;" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-print"></span></a></td>';
			
			echo '<td style="text-align:center"><a href="#" onclick=\'ldy("financeiro/editar-empresa.php?id='.$id.'",".retorno")\' style="margin:0px; padding:2px 5px; font-weight:bold;" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-pencil"></span></a></td>';
			
			echo '<td width="40px" class="hidden-print"><center><a href="#" onclick=\'$(".modal-body").load("financeiro/del/excluir-empresa.php?id='.$id.'&login_usuario='.$login_usuario.'")\' data-toggle="modal" data-target="#myModal"  class="btn btn-xs btn-danger" style="margin:0px; padding:2px 5px; font-weight:bold;"><span class="glyphicon glyphicon-trash"></span></a></center></td>';
			}
	echo '</tbody> </table>';
	exit;
} 
?>
	<div class="panel panel-default" style="width:100%;">
		<h4 class="title-box"> <i class="fa fa-users" aria-hidden="true"></i> Consulta | Fornecedores cadastrados
			<a href="#" onclick="ldy('financeiro/consulta-empresa.php','.conteudo')" class="pull-right button-top-box"><i class="fa fa-repeat"></i></a>
			<a href="#" onclick="ldy('financeiro/consulta-empresa.php','.conteudo')" class="pull-right button-top-box"><i class="fa fa-print"></i></a>
			<!--<a href="javascript:window.print()" style="letter-spacing:8px; padding-left:40px; padding-right:40px;" class="hidden-xs hidden-print pull-right btn btn-warning btn-sm"> <span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Imprimir</a>-->
		</h4>
		<div class="panel-body " style="background:#FFF;">	
			<form action="javascript:void(0)" onsubmit="post(this,'financeiro/consulta-empresa.php?ac=localizar','.retorno')" >
				<div class="container-fluid" style="padding:0px">
					<div class="col-xs-6" style="padding:2px">
						<label style="width:100%"><small>Buscar:</small><br/>
							<input type="text" name="busca" placeholder="Busque pelo nome das empresas ou CNPJ / CPF" class="form-control input-sm">
						</label>
					</div>
					<div class="col-xs-2" style="padding:2px">
						<label style="width:100%"><small>Tipo Empresa: </small>
							<select name="ti[]" class="sel" multiple="multiple" required>
								<option value="1" selected>FISICA</option>
								<option value="0" selected>JURIDICA</option>
							</select>
						</label>
					</div>
					<div class="col-xs-2" style="padding:2px;">
						<label class="pull-right" style="width:100%"><br/>
							<input type="submit" value="Pesquisar" style="width:100%" class="btn btn-success btn-sm">
						</label>
					</div>
				</div>
			</form>
			<div class="retorno" style="margin-top:20px; border-top:1px solid #CCC"></div>
		</div>
	</div>
	<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="height:auto;">
		<div class="modal-dialog" style="width:80%;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" style="color:#C9302C; opacity:1; "  onclick="$('.modal').modal('hide')" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel" style="font-family: 'Oswald', sans-serif; letter-spacing:3px;">Lançamento de Notas Fiscais | <small>Informações</small></h4>
				</div>
				<div class="modal-body body-empresa">
					Aguarde um momento &nbsp;&nbsp; <img src="../../imagens/loading.gif" alt="Carregando" width="20px"/>
				</div>
			</div>
		</div>
	</div>
