<?php
include("../config.php");
include("../validar_session.php");
date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_MONETARY,"pt_BR", "ptb");
$today = getdate(); 
$data = date("d/m/Y", mktime(gmdate("d"), gmdate("m"), gmdate("Y")));
$hora = $today['hours'].':'.$today['minutes'].':'.$today['seconds'].'';

	if($today['mon'] < 10){ 
		$today['mon'] = '0'.$today['mon'];
	} else { 
		$today['mon'] = $today['mon'];
	} 
	if($today['mday'] < 10){ 
		$today['mday'] = '0'.$today['mday']; 
	}else{ 
		$today['mday'] = $today['mday']; 
	}  
	$todayTotal	= 	$today['year'].'-'.$today['mon'].'-'.$today['mday'];
	$inicioMes	= 	$today['year'].'-'.$today['mon'].'-01';
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
	//SIMPLES
	if($relatorio == '1'){
		foreach($st as $stb) { @$stu .= $stb.','; } $stu = substr($stu,0,-1);
		foreach($ob as $obc) { @$obu .= $obc.','; } $obu = substr($obu,0,-1);
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
		echo '</table>';
		$ano = explode("-",$final);
		echo '<div class="panel" style="padding:20px">
		<p>
			<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
				RELATÓRIO DE CONTAS
			</h3>
			<p style="text-align:center;  font-size:14px;"><small>Data: '.implode("/",array_reverse(explode("-",$todayTotal))).'</small></p>
		</p>
		<p style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">';
		$obra_controle = mysql_query("SELECT * FROM notas_obras_cidade WHERE id IN($obu)");
		while($c = mysql_fetch_array($obra_controle)){	echo $c['nome'].'<br/>'; }
		echo '
		</p>
		<hr/>
		';
		echo '<table class="table table-striped table-condensed">';
				echo '<thead>';
				echo '<tr class="small">
						<th><center><span class="glyphicon glyphicon-eject"></span></center></th>
						<th>Logo</th>
						<th>Nome</th>
						<th>Obra</th>
						<th>Relatorio</th>
						<th class="hidden-print"><center><span class="glyphicon glyphicon-eye-open"></span></center></th>
						<th class="hidden-print"><center><span class="glyphicon glyphicon-cog"></span></center></th>
						<th class="hidden-print"><center><span class="glyphicon glyphicon-flag"></span></center></th>';
				echo '</tr>';
				echo '</thead>';
			$eqpquery = mysql_query("SELECT * FROM equipes WHERE status IN($stu) AND obra IN($obu) AND nome LIKE '%$busca%' ORDER BY nome ASC");
			while($b = mysql_fetch_array($eqpquery)){ extract($b);
				$se += 1;
				echo '<tr class="small" id="cupom'.$id.'">';
				echo '<td style="text-align:center">'.$se.'</td>';
				echo '<td width="10%" style="text-align:center; font-size:15px">';
					if($imagem == ''){
						echo '<i class="fa fa-image"></i>';
					}else{
						echo '<img src="../imagens/bancos/'.$imagem.'" alt="'.$imagem.'" class="img-responsive" width="100px" />';
					}
				echo '</td>';
				echo '<td>'.$nome.'</td>';
				echo '<td width="10%">'.@mysql_result(mysql_query("select * from notas_obras_cidade where id = $obra"),0,"nome").'</td>';
				echo '<td width="3%" class="hidden-print">';
				if($relatorio == 0) { 
					echo '-';
				} else { 
					echo '<center><span class="label label-success">SIM</center></span>'; 
				} 
				echo '</td>';
				echo '<td width="3%" class="hidden-print">';
				if($status == 0) { 
					echo '<center><span class="label label-success">ATIVO</center></span>'; 
				} else { 
					echo '<center><span class="label label-danger">INATIVO</center></span>'; 
				} 
				echo '</td>';
				echo '<td class="hidden-print"><center>';
				echo '<a href="#" onclick=\'$("#myModal").modal("show"); ldy("gestor/editar-equipe.php?id='.$id.'",".modal-body")\' class="btn btn-info btn-xs"><span class="glyphicon glyphicon-pencil"></span> </a> ';
				echo '</center></td>';
				
				echo '<td class="hidden-print"><center>';
				echo '<a href="#" onclick=\'$(".modal-body").load("gestor/del/ex-equipe.php?&id='.$id.'")\' data-toggle="modal" data-target="#myModal2"  class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></a></td>';
				echo '</tr>';
			}
    	echo '</tbody>';
    	echo '</table></div>';
		exit;
	}
}	
?>

<div class="container-fluid" style="padding:0px; margin-bottom:10px; padding-bottom:10px; border-bottom:1px solid #CCC">
	<h3 style="font-family: 'Oswald', sans-serif;letter-spacing:6px;" class="hidden-print">CONSULTA <small>CONTAS CADASTRADAS</small>
		<a href="javascript:window.print()" style="letter-spacing:5px; margin-top:10px; margin-right:10px;" class="hidden-xs hidden-print pull-right btn btn-warning btn-sm"> <span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Imprimir</a>
		<a href="#" onclick="ldy('gestor/cadastro-equipe.php','.conteudo')" style="letter-spacing:5px; margin-top:10px; margin-right:10px;" class="hidden-xs hidden-print pull-right btn btn-info btn-sm"> 
			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Cadastrar
		</a>
	</h3>
</div>
<div class="container-fluid" style="padding:0px;">
	<form action="javascript:void(0)" id="form1" class="form-inline">
		<div class="container-fluid well well-sm" style="padding:10px 10px 5px 10px;">
			<div class="col-xs-2" style="padding:2px;">
				<label style="width:100%"><small>Empresa:</small> 
					<select name="ob[]" onChange="$('#itens2').load('gestor/consulta-equipes.php?atu=ac&cidade=' + $(this).val() + '');" style="width:250px;" class="sel" multiple="multiple" id="categ" required> 
						<?php
							$obras = mysql_query("select * from notas_obras_cidade WHERE id IN(0,$cidade_usuario) order by nome asc");
							while($a = mysql_fetch_array($obras)) {
								echo '<option value="'.$a['id'].'" selected>'.$a['nome'].'</option>';
							}
						?>		
					</select>
				</label>
			</div>
			<div class="col-xs-2" style="padding:2px;">
				<label style="width:100%"><small>Status:</small> 
					<select name="st[]" class="sel" multiple="multiple">
						<option value="0" selected>ATIVO</option>
						<option value="1" selected>INATIVO</option>
					</select>
				</label>
			</div>
			<div class="col-xs-2" style="padding:2px;">
				<label style="width:100%"><small>Tipo:</small>
					<select name="relatorio" class="form-control input-sm disabled" style="width: 100%">
						<option value="1">SIMPLES</option>
					</select>
				</label>
			</div>
			<div class="col-xs-2" style="padding:2px;">
				<label style="width:100%"><br/>
					<input type="submit" value="Pesquisar" style="width:100%; margin-left:10px;" onClick="post('#form1','gestor/consulta-equipes.php?ac=localizar&iu=<?php echo $iu ?>','.retorno')" class="btn btn-success btn-sm">
				</label>
			</div>
		</div>
	</form>
</div>
<div class="retorno"></div>
<div class="resultado"></div>

<!-- Modal de edição -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" onclick="$('#myModal').modal('hide')"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<h4 class="modal-title" id="myModalLabel">Editar Informações das Equipes</h4>
		  </div>
		  
		  <div class="modal-body"></div>
	  
		</div>
	  </div>
	</div>
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
