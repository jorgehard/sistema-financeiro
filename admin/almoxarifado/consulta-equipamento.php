<?php 
	include("../config.php");
	include("../validar_session.php");
?>
<style>
@media only screen and (max-width: 992px),(min-device-width: 992px) and (max-device-width: 1024px)  {
	table, thead, tbody, th, td, tr { 
		display: block; 
	}
	thead tr { 
		position: absolute;
		top: -9999px;
		left: -9999px;
	}
	
	tr { border: 1px solid #f3f3f3; }
	
	td { 
		border: none;
		border-bottom: 2px solid #eee; 
		position: relative;
		padding-left: 40% !important; 
	}
	
	td:before { 
		position: absolute;
		top: 6px;
		left: 6px;
		width: 45%; 
		margin-right: 10px; 
		white-space: nowrap;
	}
	
	td:nth-of-type(1):before { content: "Placa"; }
	td:nth-of-type(2):before { content: "Patrimônio"; }
	td:nth-of-type(3):before { content: "Valor"; }
	td:nth-of-type(4):before { content: "Empresa"; }
	td:nth-of-type(5):before { content: "Situação"; }
	td:nth-of-type(6):before { content: "Responsável"; }
	td:nth-of-type(7):before { content: "Equipe"; }
	td:nth-of-type(8):before { content: "Categoria"; }
	td:nth-of-type(9):before { content: "Sub-Categ"; }
	td:nth-of-type(10):before { content: "Status"; }
	td:nth-of-type(11):before { content: "Editar"; }
	td:nth-of-type(12):before { content: "Deletar"; }
	
	.buttonCel{
		width:100%;
	}
}
</style>
<script>
	$("input[type=text]").focus()
</script>
<script>
	$(document).ready(function(){
		$(function(){
			$("#myTable").tablesorter();
		});
	});
</script>
<script>
	$(document).ready(function() {
		$(".btnPrint").printPage();
	});
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$(".decimal").maskMoney({precision:2})
		$('.sel').multiselect({
			buttonClass: 'btn btn-sm', 
			numberDisplayed: 1,
			maxHeight: 500,
			includeSelectAllOption: true,
			selectAllText: "Selecionar todos",
			enableFiltering: true,
			enableCaseInsensitiveFiltering: true,
			selectAllValue: 'multiselect-all',
			buttonWidth: 'auto'
		}); 	
	});
</script> 
<?php 	
if(@$ac == 'del') { 
	$query = mysql_query("DELETE FROM notas_equipamentos WHERE id = '$id'"); 
	if($query) { 
		echo '	
			<center>
				<div class="alert alert-success">
					<strong>Atenção!</strong> Informações alteradas com sucesso.
				</div>
			</center>
		';	
	}else{ 
		echo '<p class="text-danger">'.mysql_error().'</p>'; 
	}
	exit;
}
if(@$ac == 'localizar') { 
?>
	<table width="100%" class="table table-striped table-bordered table-condensed small" id="myTable">
		<thead>
			<tr class="small">
				<th>Placa</th>
				<th>Patrimônio</th>
				<th>Valor</th>
				<th>Empresa</th>
				<th>Situacão</th>
				<th>Responsável</th>
				<th>Equipe</th>
				<th>Categoria</th>
				<th>Sub-Categ</th>
				<th>Status</th>
				<th colspan="2"></th>
			</tr>
		</thead>
		<tbody>
		<?php
			foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1);
			
			$sql = mysql_query("SELECT * FROM notas_equipamentos WHERE notas_equipamentos.status_2 IN($equ) AND notas_equipamentos.placa LIKE '%$busca%'");
			
			while($l = mysql_fetch_array($sql)) { extract($l);
				echo '<tr class="small">';
				echo '<td>'.$placa.'</td>';
				echo '<td>'.$patrimonio.'</td>';
				echo '<td>'.$valor.'</td>';
				echo '<td>'.@mysql_result(mysql_query("select * from notas_empresas where id = $empresa"),0,"nome").'</td>';
				echo '<td>'.@mysql_result(mysql_query("select * from notas_eq_situacao where id = $situacao"),0,"descricao").'</td>';
				echo '<td>'.@mysql_result(mysql_query("select * from rh_funcionarios where id = $local"),0,"nome").'</td>';
				echo '<td>'.@mysql_result(mysql_query("select * from equipes where id = $equipe"),0,"nome").'</td>';
				echo '<td>'.@mysql_result(mysql_query("select * from notas_cat_e where id = $categoria"),0,"descricao").'</td>';
				echo '<td>'.$tipo.'</td>';
				echo '<td><center>';
				if($status_2 == '1'){ 
					echo '<span class="btn btn-xs small btn-success" style="font-size:8px; width:45px;">';
				}else{
					echo '<span class="btn btn-xs small btn-danger" style="font-size:8px; width:45px;">';
				}
				echo ''.@mysql_result(mysql_query("select * from status_2 where id = $status_2"),0,"descricao").'</span></center></td>';

						 echo '<td><a href="#" style="font-weight:bold;" onclick=\'$(".retorno").load("almoxarifado/editar-equipamento.php?id='.$id.'&iu='.$iu.'")\' class="buttonCel btn btn-xs btn-warning" style="font-size:12px;"><span class="glyphicon glyphicon-pencil"></span></a></td>';
		
						echo '<td><a href="#" onclick=\'$(".modal-body").load("almoxarifado/del/excluir-equipam.php?id='.$id.'")\' data-toggle="modal" data-target="#myModal"  class="buttonCel btn btn-xs btn-danger" style="margin:0px; padding:5px; font-weight:bold;"><span class="glyphicon glyphicon-trash"></span></a></td>';
				echo '</tr>';

			}
		?>
		</tbody>
	</table> <?php } else { ?>

	<h3 style="font-family: 'Oswald', sans-serif;letter-spacing:5px; margin-bottom;10px;">CONSULTA & EDIÇÃO <small>DE EQUIPAMENTOS CADASTRADOS</small>
		<a href="#" onClick="$('.conteudo').load('almoxarifado/cadastro-equipamento.php')" style="width:auto; padding:5px;" class="btn btn-primary btn-xs pull-right"><span class="pull-left glyphicon glyphicon-plus"></span> Cadastrar Novo </a>
		
	</h3><hr/>

	<form action="javascript:void(0)" onSubmit="post(this,'almoxarifado/consulta-equipamento.php?ac=localizar','.retorno')">
		<div class="well well-sm" style="padding:10px 10px 5px 10px;">
			<label>
				<input type="text" name="busca" style="font-weight:200" placeholder="Digite a placa do equipamento desejado (ex: ABC 1234)" size="100" class="form-control input-sm">
			</label>
				
			<label for="">Situação:
				<select name="eq[]" class="sel" multiple="multiple" required>
					<?php
						$equipe = mysql_query("select * from status_2 ORDER BY descricao");
						while($l = mysql_fetch_array($equipe)) {
							extract($l);
							echo '<option value="'.$id.'" selected>'.$descricao.'</option>';
						}
					?>
				</select>
			</label>
			<input type="submit" style="margin-left:5px; width:100px; font-weight:bold" value="Buscar" class="btn btn-success btn-sm" />
		</div>
	</form>
	
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
<?php } ?>