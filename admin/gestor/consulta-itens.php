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
	$("table").tablesorter();
	$(".btnPrint").printPage();
	$(function(){ $("#myTable").tablesorter(); });
	$(".decimal").maskMoney({precision:2});
	$('.sel').multiselect({
      buttonClass: 'btn btn-sm',
	  numberDisplayed: 1,
	  maxHeight: 200,
	  includeSelectAllOption: true,
	  selectAllText: "Selecionar todos",
	  enableFiltering: true,
	  enableCaseInsensitiveFiltering: true,
	  selectAllValue: 'multiselect-all'
	}); 

});
</script>

<?php 
if(@$ac == 'localizar') {
	
		foreach($st as $stb) { @$stu .= $stb.','; } $stu = substr($stu,0,-1);
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
		echo '
		<p>
			<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
				RELATÓRIO DE ITENS
			</h3>
			<p style="text-align:center;  font-size:14px;"><small>Data: '.implode("/",array_reverse(explode("-",$todayTotal))).'</small></p>
		</p>
		<p style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">';
		$obra_controle = mysql_query("SELECT * FROM notas_obras WHERE id = $obra");
		while($c = mysql_fetch_array($obra_controle)){	echo $c['descricao'].' <small class="hidden-print">id:'.$c['id'].'</small><br/>'; }
		echo '
		</p>
		<hr/>
		';
		echo '<table class="table table-striped table-condensed">';{
				echo '<thead>';
				echo '<tr class="small">
						<th><center><span class="glyphicon glyphicon-eject"></span></center></th>
						<th>Item</th>
						<th>Descrição</th>
						<th>NPreço</th>
						<th>Quantidade</th>
						<th>UN</th>
						<th>Preço</th>
						<th>Total</th>
						<th class="hidden-print"><center><span class="glyphicon glyphicon-eye-open"></span></center></th>
						<th class="hidden-print"><center><span class="glyphicon glyphicon-cog"></span></center></th>';
				echo '</tr>';
				echo '</thead>';
			$eqpquery = mysql_query("SELECT * FROM ss_itens WHERE obra = '$obra' and status IN($stu) ORDER BY item ASC");
			while($b = mysql_fetch_array($eqpquery)){ extract($b);
				$se += 1;
				echo '<tr class="small">';
				echo '<td width="3%">'.$se.'</td>';
				echo '<td width="3%">'.$item.'</td>';
				echo '<td width="40%">'.$descricao.'</td>';
				echo '<td width="3%">'.$npreco.'</td>';
				echo '<td width="3%">'.$quantidade.'</td>';
				echo '<td width="3%">'.$unidade.'</td>';
				echo '<td width="3%">'.number_format($preco,2,",",".").'</td>';
				$total = $quantidade * $preco;
				echo '<td width="3%">'.number_format($total,2,",",".").'</td>';
				echo '<td width="3%" class="hidden-print">';
				if($status == 0) { 
					echo '<center><span class="label label-success">ATIVO</center></span>'; 
				} else { 
					echo '<center><span class="label label-danger">INATIVO</center></span>'; 
				} 
				
				echo '</td>';
				echo '<td width="3%" class="hidden-print"><center>';
				echo '<a href="#" onclick=\'$("#myModal").modal("show"); ldy("gestor/editar-itens.php?id='.$id.'",".modal-body")\' class="btn btn-info btn-xs"><span class="glyphicon glyphicon-pencil"></span> </a> ';
				echo '</center></td>';
				echo '</tr>';
				
				$total_valores += $total;
			}
		}
		echo '<h2 class="hidden-print">Total <small>R$ '.number_format($total_valores,"2",",",".").'</small></h2>';
    	echo '</tbody>';
    	echo '</table>';
		echo '<h2>Total  <small>R$ '.number_format($total_valores,"2",",",".").'</small></h2>';
		exit;
}	
?>
	<h3 style="font-family: 'Oswald', sans-serif;letter-spacing:6px;" class="hidden-print">CONSULTA <small>ITENS CADASTRADOS</small>
		<a href="javascript:window.print()" style="letter-spacing:5px; margin-top:10px; margin-right:10px;" class="hidden-xs hidden-print pull-right btn btn-warning btn-sm"> <span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Imprimir
		</a>
	</h3><hr/>
<div class="hidden-print">
	<form class="form-horizontal" action="javascript:void(0)" onSubmit="post(this,'gestor/consulta-itens.php?ac=localizar','.resultado')">
		<div class="well well-sm" style="padding:10px 10px 5px 10px;">
			<label for=""><small>Obra:</small> 
				<select name="obra" style="width:250px;" class="form-control input-sm" required> 
					<?php
						$obras = mysql_query("select * from notas_obras WHERE id IN($obra_usuario) order by descricao asc");
						while($a = mysql_fetch_array($obras)) {
							echo '<option value="'.$a['id'].'">'.$a['descricao'].'</option>';
						}
					?>		
				</select>
			</label>
			<label>
				<select name="st[]" class="sel" multiple="multiple">
					<option value="0" selected>ATIVO</option>
					<option value="1" selected>INATIVO</option>
				</select>
			</label>
			<input type="submit" value="Pesquisar" style="width:150px; margin-left:10px;" class="btn btn-success btn-sm">
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
