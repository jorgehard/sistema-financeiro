<?php
	require_once("../config.php");
	require_once("../validar_session.php");
	getNivel();
	getData();
?>
<script type="text/javascript">
$(document).ready(function(){
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
	if(@$ac == 'transf'){
		$sql = mysql_query("update notas_retirada set tipo = '4' where id = $id_retirada");
		if($sql) { 
			echo 'Transferido';
		}else{ 
			echo '<script>window.alert("'.mysql_error().'");</script>'; 
		}
		exit;
	}
	if(@$ac == 'localizar') { 
		echo '<table width="100%" class="table table-striped table-condensed table-color small">';
		echo '
			<tr class="small">
				<th>Número:</th>
				<th>Funcionário / Equipe:</th>
				<th>Obra:</th>
				<th>Data:</th>
				<th>Data Ref:</th>';
				echo '<th>Retiradas:</th>';
				if( $editarss_usuario == '1'  || $acesso_login == 'MASTER'){
					echo '<th> </th>';
				}
		echo '</tr>';

		$inicial = implode("-",array_reverse(explode("/",$inicial))); 
		$final = implode("-",array_reverse(explode("/",$final)));
		
		foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);
		
        $sql = mysql_query("select notas_retirada.*, notas_retirada.id as id_retirada, notas_retirada.tipo as tipo_retirada FROM notas_retirada  INNER JOIN rh_funcionarios ON rh_funcionarios.id = notas_retirada.funcionario WHERE notas_retirada.obra IN($oba) AND rh_funcionarios.nome LIKE '%$busca%' and (notas_retirada.data between '$inicial' and '$final') ORDER BY notas_retirada.id DESC");
           while($l = mysql_fetch_array($sql)) { extract($l);
				echo '<tr class="small" id="sabesp'.$id_retirada.'">';
                echo '<td width="40px">'.$id_retirada.'</td>';
        		echo '<td>'.@mysql_result(mysql_query("select * from rh_funcionarios where id = $funcionario"),0,"nome").'</td>';
				echo '<td width="200px">'.@mysql_result(mysql_query("select descricao from notas_obras where id = $obra"),0,"descricao").'</td>';
        		echo '<td width="100px" align="center">'.implode("/",array_reverse(explode("-",$data))).'</td>';
				echo '<td width="100px" align="center">'.implode("/",array_reverse(explode("-",$data_ref))).'</td>';
				echo '<td width="40px" align="center"><a href="#" onclick=\'$(".retorno").load("almoxarifado/incluir-itens-retirada.php?voltar=1&retirada='.$id_retirada.'")\' class="btn btn-success btn-xs"><span class="glyphicon glyphicon-plus"></span> Editar / Adicionar </a></td>';
				if($editarss_usuario == '1'  || $acesso_login == 'MASTER'){
					echo '<td width="40px" align="center"><a href="#" onclick=\'$(".modal-body").load("almoxarifado/del/excluir-retirada.php?&id_retirada='.$id_retirada.'")\' data-toggle="modal" data-target="#myModal2"  class="btn btn-danger btn-xs" style="margin:0px; padding:5px; font-weight:bold;"><span class="glyphicon glyphicon-trash"></span></a></td>';
				}
				echo '</tr>';
			}
			echo '</table>';
			exit;
		}

?>
	<div class="well well-sm hidden-print" style="padding:10px 10px 5px 10px; margin-top:-20px">
		<form action="javascript:void(0)" onSubmit="posti(this,'almoxarifado/consulta-retirada.php?ac=localizar','.retorno');" class="formulario-normal">
			<div class="container-fluid" style="padding:0px">
				<div class="col-xs-5" style="padding:2px">
					<label><small>Buscar:</small>
						<input type="text" name="busca" placeholder="Digite algo para buscar" class="form-control input-sm">
					</label>
				</div>
				<div class="col-xs-2" style="padding:2px">
					<label> <small>Obra:</small>
						<select name="ob[]" class="sel" multiple="multiple">
							<?php
								$sql = mysql_query("select * from notas_obras where id in($obra_usuario)");
								while($l = mysql_fetch_array($sql)) { extract($l);
									echo '<option value="'.$id.'" selected>'.$descricao.'</option>';
								}
							?>				
						</select>
					</label>
				</div>
				<div class="col-xs-4" style="padding:0px">
					<div class="col-xs-6" style="padding:2px">
						<label style="width:100%"><small>Periodo:</small><br/>
							<input type="date" name="inicial" value="<?php echo $inicioMes; ?>" class="form-control input-sm" style="width:100%" />
						</label>
					</div>
					<div class="col-xs-6" style="padding:2px">
						<label style="width:100%"><small>até:</small><br/>
							<input type="date" name="final" value="<?php echo $todayTotal; ?>" class="form-control input-sm" style="width:100%" />
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

	<div class="modal" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:auto;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" onclick="$('.modal').modal('hide')" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Excluir Equipe</h4>
				</div>
				<div class="modal-body">
					Aguarde um momento &nbsp;&nbsp; <img src="../../imagens/loading.gif" alt="Carregando" width="20px"/>
				</div>
			</div>
		</div>
	</div>