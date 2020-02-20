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
if(@$ac == 'buscar') { 
	echo '<table width="100%" class="table table-striped table-condensed table-bordered table-color small">';
		echo '<thead>
		<tr class="small"><th>Obra:</th><th>Data:</th><th>Número CI:</th><th>Número RM:</th><th>Valor Total</th><th>Editar</th>
		';
		
		if($editarss_usuario == '1' || $acesso_login == 'MASTER'){
			echo '<th>Excluir</th>';
		}
		echo '</tr>
		</thead>
		<tbody>';

        $inicial = implode("-",array_reverse(explode("/",$inicial)));
        $final = implode("-",array_reverse(explode("/",$final)));
		foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);
		
        $sql = mysql_query("select * from ss_rm where (numero like '%$busca%' OR num_ci LIKE '%$busca%') and (data between '$inicial' and '$final') and obra IN($oba) order by data asc LIMIT 300");
	
        while($l = mysql_fetch_array($sql)) { extract($l);
            echo '<tr class="small" id="rm'.$id.'">';
        	echo '<td>'.@mysql_result(mysql_query("select * from notas_obras where id = $obra"),0,"descricao").'</td>';
            echo '<td>'.implode("/",array_reverse(explode("-",$data))).'</td>';
            echo '<td>'.$num_ci.'</td>';
            echo '<td>'.$numero.'</td>';
            $total = 0;
            $rm_itens = mysql_query("select * from ss_rm_itens where cod_rm = '$id'");
            while($l = mysql_fetch_array($rm_itens)) {
				$vlr_item = $l['qtd']*$l['vlr'];
				$total += $vlr_item;
			}

				echo '<td>R$ '.number_format($total,"2",",",".").'</td>';
				echo '<td width="5%"><center><a href="#" class="btn btn-xs btn-warning" style="padding:5px; font-weight:bold;" onclick=\'$(".retorno").load("almoxarifado/editar-rm.php?cod_rm='.$id.'")\'><span class="glyphicon glyphicon-pencil"></span></a></center></td>'; 	
			
			if($editarss_usuario == '1' || $acesso_login == 'MASTER'){
				echo '<td width="5%" align="center"><a href="#" onclick=\'$(".modal-body").load("almoxarifado/del/excluir-rm.php?&id_retirada='.$id.'")\' data-toggle="modal" data-target="#myModal2"  class="btn btn-danger btn-xs" style="margin:0px; padding:5px; font-weight:bold;"><span class="glyphicon glyphicon-trash"></span></a></td>';
			}
        	echo '</tr>';

        }

       echo '</tbody></table>';
	exit; 
} 
?>
	<div class="well well-sm hidden-print" style="padding:10px 10px 5px 10px;">
		<form action="javascript:void(0)" class="formulario-normal" onSubmit="post(this,'almoxarifado/consulta-rm.php?ac=buscar','.retorno')">
			<div class="container-fluid" style="padding:0px">
				<div class="col-xs-5" style="padding:2px">
					<label><small>Numero RM</small>
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
