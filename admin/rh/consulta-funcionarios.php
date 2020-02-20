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
		"paging": true,
		"pageLength": 50,
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
<style>
	@media print
	{
		table, tr, thead, tbody, td, th{
			border:1px solid #000 !important;
		}
	}
</style>
<?php 
if(@$ac == 'localizar') { 
?>
		<table id="resultadoTabela" class="table table-condensed table-color" style="font-size:10px">
			<thead>
			<tr>
				<th><span class="glyphicon glyphicon-eject"></span></th>
				<th>NOME</th>
				<th>FUNÇÃO</th>
				<th>EQUIPE</th>
				<th>OBRA</th>
				<th>SITUAÇÃO</th>
				<th style="text-align:center">ADMISSÃO</th>
				<th style="text-align:center">STATUS</th>
				<th style="text-align:center" class="hidden-print"><span class="glyphicon glyphicon-wrench"></span></th>
				<?php
				if($acesso_login == 'MASTER'){
					echo '<th style="text-align:center" class="hidden-print"><span class="glyphicon glyphicon-trash"></span></th>';
				}
				?>
			</tr>
			</thead>
			<tbody>
        <?php
      
		foreach($st as $sts) { @$stu .= $sts.','; } $stu = substr($stu,0,-1);
		foreach($sta as $stas) { @$stau .= $stas.','; } $stau = substr($stau,0,-1);
		foreach($ob as $obs) { @$obu .= $obs.','; } $obu = substr($obu,0,-1);
		if($inicial == '' || $final == ''){ 
			$filtrodata = '';
		}else{
			$filtrodata = "AND admissao BETWEEN '".$inicial."' AND '".$final."'";
		}
		if($final == ''){ $final == '9999-99-99'; }
		
       $i = 1;
       $sql = mysql_query("select * from rh_funcionarios where nome like '%$busca%' and situacao in ($stu) AND obra IN($obu) AND status IN($stau) ".$filtrodata." order by id desc");
       while($l = mysql_fetch_array($sql)) { extract($l);
		$u = $i++;

				echo '<tr id="fun'.$id.'">';
				echo '<td width="15px">'.$u.'</td>';
				echo '<td>'.$nome.'</td>';
				echo '<td>'.@mysql_result(mysql_query("select descricao from rh_funcoes where id = $funcao"),0,"descricao").'</td>';
				echo '<td>'.@mysql_result(mysql_query("select nome from equipes where id = $equipe"),0,"nome").'</td>';
				echo '<td>'.@mysql_result(mysql_query("select descricao from notas_obras where id = $obra"),0,"descricao").'</td>';
				echo '<td>'.@mysql_result(mysql_query("select descricao from rh_situacao where id = $situacao"),0,"descricao").'</td>';
				echo '<td style="text-align:center">'.implode("/",array_reverse(explode("-",$admissao))).'</td>';
				echo '<td style="text-align:center">';
				if($status == '0'){
					echo '<span class="btn btn-success btn-xs" style="font-size:9px; width:80%">ATIVO</span>';
				}else if($status == '1'){
					echo '<a href="#" class="btn btn-danger btn-xs"  style="font-size:10px">PENDENTE</a>';
					echo '<a href="rh/imprimir-analise-contratacao.php?id='.$id.'&motivo_imp='.$motivo_imp.'" target="_blank" style="margin-left:5px" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-print"></span></a>';
				}else if($status == '2'){
					echo '<a href="#" class="btn btn-warning btn-xs"  style="font-size:9px; width:80%">LIBERAR</a>';
				}
				echo '</td>';
				echo '<td class="hidden-print text-center"><a href="#" class="btn btn-xs btn-info" style="margin:0px; padding:0px 5px; font-weight:bold;" onclick=\'ldy("rh/editar-funcionario.php?acesso_login='.$acesso_login.'&id='.$id.'",".retorno")\'><span class="glyphicon glyphicon-pencil"></span></a></td>'; 
				if($acesso_login == 'MASTER'){
					echo '<td class="hidden-print text-center"><a href="#" onclick=\'$(".modal-body").load("rh/del/excluir-funcionario.php?id='.$id.'&login_usuario='.$login_usuario.'")\' data-toggle="modal" data-target="#myModal"  class="btn btn-xs btn-danger" style="margin:0px; padding:0px 5px; font-weight:bold;"><span class="glyphicon glyphicon-trash"></span></a></center></td>';
				}

				echo '</tr>';
		}
		echo '</tbody>
		</table>';
		exit;
	}  
?>
	<div class="container-fluid" style="padding:0px 0px 15px 0px; margin-bottom:20px; border-bottom:1px solid #CCC">
		<img src="../imagens/logo.png" class="img-responsive" width="50px" style="float:left; margin-right:20px"/>
		<h3 style="font-family: 'Oswald', sans-serif; letter-spacing:5px;"> 
			CONSULTA DE <small><b>FUNCIONÁRIOS</b></small>
			<a href="javascript:window.print()" style="letter-spacing:8px; padding-left:40px; padding-right:40px;" class="hidden-xs hidden-print pull-right btn btn-warning btn-sm"> <span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Imprimir</a>
		</h3>
	</div>
	<div class="well well-sm hidden-print" style="padding:10px 10px 5px 10px;">
		<form action="javascript:void(0)" onsubmit="post(this,'rh/consulta-funcionarios.php?ac=localizar','.retorno')">
			<div class="container-fluid" style="padding:0px">
				<div class="col-xs-11" style="padding:0px">
					<div class="col-xs-4" style="padding:2px">
						<label style="width:100%"><small>Nome:</small>
							<input type="text" name="busca" placeholder="Digite algo para a busca" class="form-control input-sm">
						</label>
					</div>
					<div class="col-xs-3" style="padding:2px">
						<div class="col-xs-6" style="padding:2px">
						<label style="width:100%"><small>Admissão:</small><br/>
							<input type="date" name="inicial" class="form-control input-sm"/>
						</label>
						</div>
						<div class="col-xs-6" style="padding:2px">
							<label style="width:100%"><br/>
								<input type="date" name="final" class="form-control input-sm"/>
							</label>
						</div>
					</div>
					<div class="col-xs-5" style="padding:2px">
						<div class="col-xs-4" style="padding:2px">
							<label style="width:100%"><small>Situação:</small><br/> 
								<select name="st[]" class="sel" multiple="multiple">
									<?php 
									$situacaos = mysql_query("select * from  rh_situacao order by ordem asc"); 
									while($l=mysql_fetch_array($situacaos)) {
										if($situacao==$l['id']) { 
											echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>'; 
										} else { 
											echo '<option value="'.$l['id'].'" selected>'.$l[	'descricao'].'</option>'; 
										} 	
									}	
									?>	
								</select>
							</label>
						</div>
						<div class="col-xs-4" style="padding:2px">
							<label style="width:100%"><small>Status:</small><br/> 
								<select name="sta[]" class="sel" multiple="multiple">
									<option value="0" selected>ATIVO</option>
									<option value="1" selected>PENDENTE</option>
									<option value="2" selected>LIBERAR</option>
								</select>
							</label>
						</div>
						<div class="col-xs-4" style="padding:2px">
							<label style="width:100%"><small>Obra:</small><br/> 
							<select name="ob[]" class="sel" multiple="multiple">
									<?php
										$obra_s = mysql_query("SELECT * FROM notas_obras WHERE id IN($obra_usuario) ORDER BY id ASC");
										while($f = mysql_fetch_array($obra_s)) { 
											echo '<option value="'.$f['id'].'" selected>'.$f['descricao'].'</option>';
										}
									?>	
							</select>
						</label>
						</div>
					</div>
				</div>
				<div class="col-xs-1" style="padding:0px;">
					<label class="pull-right" style="width:100%"><br/>
						<input type="submit" value="Pesquisar" style="width:100%" class="btn btn-success btn-sm">
					</label>
				</div>
			</div>
		</form>
	</div>
	<div class="retorno"></div>

<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" style="color:#C9302C; opacity:1; " onclick="$('.modal').modal('hide'); $('.modal-body').empty()" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Excluir Funcionario</h4>
      </div>
      <div class="modal-body">
		Aguarde um momento &nbsp;&nbsp; <img src="../../imagens/loading.gif" alt="Carregando" width="20px"/>
      </div>
    </div>
  </div>
</div>