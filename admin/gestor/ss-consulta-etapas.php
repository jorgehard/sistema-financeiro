<?php include("../config.php") ?>
<script>
	$(document).ready(function(){
		$(function(){
			$("table").tablesorter();
		});
	});
</script>

<div style="clear: both;">
	<h3 style="font-family: 'Oswald', sans-serif;letter-spacing:5px; margin-bottom;10px;"> 
		<img class="logo-print" src="http://polemicalitoral.com.br/guaruja/imagens/logo.png" style="float:left;" width="60px"/>
		<p>CONSULTA <small>ETAPAS DAS SS</small>		
		<a href="#" onclick="ldy('gestor/ss-cadastrar-etapas.php','.conteudo')" style="letter-spacing:5px; margin-top:10px; margin-right:10px;" class="hidden-xs hidden-print pull-right btn btn-warning btn-sm"> 
			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Cadastrar
		</a>
		<a href="#" onclick="ldy('gestor/ss-consulta-etapas.php','.conteudo')" style="letter-spacing:5px; margin-top:10px; margin-right:10px;" class="hidden-xs hidden-print pull-right btn btn-primary btn-sm"> 
			<span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>&nbsp;Atualizar
		</a>
		
		</p>
	</h3>
</div>
<div style="clear: both;">
	<hr></hr>
</div>
	<table class="table table-striped table-condensed table-bordered small">
		<thead>
		<tr>
			<th width="20px"><span class="glyphicon glyphicon-eject"></span></th>
			<th>Descrição</th>
			<th width="30px"><center>Status</center></th>
			<th width="30px"><center>Pesquisa</center></th>
			<th width="30px">Editar</th>
		</tr>
		</thead>
		<tbody>
        <?php
        
        $i = 1;
        if($tipo==0) { $sql = mysql_query("select * from ss_etapas order by oculto desc"); }
        while($l = mysql_fetch_array($sql)) { extract($l);
		$u = $i++;

				echo '<tr>';
				echo '<td>'.$u.'</td>';
				echo '<td>'.$descricao.'</td>';
				if($oculto == '0'){ 
					echo '<td width="40px"><span class="btn btn-xs small btn-danger" style="font-size:8px; width:45px;">INATIVO</span></td>';
				}else if($oculto == '1'){
					echo '<td width="40px"><span class="btn btn-xs small btn-success" style="font-size:8px; width:45px;">ATIVO</span></td>';
				}
				if($pesquisa == '0'){ 
					echo '<td width="40px"><span class="btn btn-xs small btn-success" style="font-size:8px; width:45px;">ATIVO</span></td>';
				}else if($pesquisa == '1'){
					echo '<td width="40px"><span class="btn btn-xs small btn-danger" style="font-size:8px; width:45px;">INATIVO</span></td>';
				}
				echo '<td width="40px"><a href="#" onclick=\'$(".modal-body").load("gestor/ss-editar-etapas.php?id='.$id.'")\' data-toggle="modal" data-target="#myModal"  class="buttonCel btn btn-xs btn-info" style="margin:0px; padding:5px; font-weight:bold;"><span class="glyphicon glyphicon-pencil"></span></a></td>';
				echo '</tr>';

            }
        ?>
		</tbody>
		</table>

	<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:auto;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" style="color:red;" onclick="$('.modal').modal('hide')" class="close" data-dismiss="modal" aria-hidden="true"><b><span class="glyphicon glyphicon-remove-circle"></span></b></button>
					<h4 class="modal-title" id="myModalLabel" style="font-family: 'Oswald', sans-serif;letter-spacing:5px; margin-bottom;10px;"><small>Editar Etapa</small></h4>
				</div>
				<div class="modal-body">
					Aguarde um momento &nbsp;&nbsp; <img src="../../imagens/loading.gif" alt="Carregando" width="20px"/>
				</div>
			</div>
		</div>
	</div>
