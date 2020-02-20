<?php
	include("../config.php");
	include("../validar_session.php");
	include("../../functions/function-print.php");
	getData();
	getNivel();
?>
<style>
	@media print
	{
		table, tr, thead, tbody, td, th{
			border:1px solid #000 !important;
		}
	}
</style>
<div class="hidden-print" style="clear:both;">
	<h3 style="font-family: 'Oswald', sans-serif;letter-spacing:5px; margin-bottom;10px;"> 
		<p style="padding-bottom:20px;">
			<a href="javascript:window.print()" style="margin-left:20px" class="pull-right btn btn-warning btn-sm">&nbsp;<span class="glyphicon glyphicon-print"></span></a>
			
			<a href="#" onclick="$('.modal-body').load('rh/cadastrar-cargos.php')" data-toggle="modal" data-target="#myModal2" style="margin-left:20px" class="pull-left btn btn-success btn-sm"><span class="glyphicon glyphicon-plus"></span> NOVO CARGO</a>
		
			<a href="#" onclick="ldy('rh/consulta-cargos.php','.conteudo')" style="margin-left:20px" class="pull-right btn btn-primary btn-sm"><span class="glyphicon glyphicon-refresh"></span> ATUALIZAR PAGINA</a>
		</p>

	</h3>
</div>
<?php
		topoPrint();
		$ano = explode("-",$final);
			echo '
				<p>
					<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
						RELATORIO DE CARGOS - FUNCIONÁRIOS
					</h3>
					<p style="text-align:center;  font-size:14px;"><small>Data: '.implode("/",array_reverse(explode("-",$todayTotal))).'</small></p>
				</p>
			';
		echo '<table id="resultadoTabela" class="table table-condensed table-bordered table-green" style="font-size:11px">
				  <thead>
					  <tr>
						<th><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span></th>	
						<th>Descricão</th>
						<th style="text-align:center">Salário</th>
						<th class="hidden-print" style="text-align:center">Status</th>
						<th class="hidden-print"></th>
						<th class="hidden-print"></th>
					  </tr>
				  </thead>
			  <tbody>';
		$sql = mysql_query("select * from rh_funcoes");
		while($l=mysql_fetch_array($sql)) { extract($l);
			echo '<tr id="car'.$id.'">';
			echo '<td width="30px">'.$id.'</td>';
			echo '<td>'.$descricao.'</td>';
			echo '<td style="text-align:center"> R$ '.number_format($salario,2,",",".").'</td>';
			echo '<td class="hidden-print" style="text-align:center">';
			if($status == '0'){
							echo '<span class="btn btn-xs small btn-success" style="font-size:8px">ATIVO</span>';
						}else{
							echo '<span class="btn btn-xs small btn-danger" style="font-size:8px">INATIVO</span>';
						}
			echo '</td>';
			if($acesso_login == 'MASTER'){
				echo '<td width="40px" class="hidden-print">
				<a href="#" onclick=\'$(".modal-body").load("rh/editar-cargos.php?&id='.$id.'")\' data-toggle="modal" data-target="#myModal2"  class="btn btn-info btn-xs" style="margin:0px; padding:5px; font-weight:bold;"><span class="glyphicon glyphicon-pencil"></span></a></td>';	
			}
			if($acesso_login == 'MASTER'){
				echo '<td width="40px" class="hidden-print">
				<a href="#" onclick=\'$(".modal-body").load("rh/del/excluir-cargo.php?&id='.$id.'")\' data-toggle="modal" data-target="#myModal2"  class="btn btn-danger btn-xs" style="margin:0px; padding:5px; font-weight:bold;"><span class="glyphicon glyphicon-trash"></span></a></td>';
			}
			echo '</tr>';
		}
		echo '</tbody></table>';
?>

<div class="retorno"></div>

	<div class="modal" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:auto;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" onclick="$('.modal').modal('hide')" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Controle de Cargos</h4>
				</div>
				<div class="modal-body">
					Aguarde um momento &nbsp;&nbsp; <img src="../../imagens/loading.gif" alt="Carregando" width="20px"/>
				</div>
			</div>
		</div>
	</div>