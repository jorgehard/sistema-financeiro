<?php 
include("../validar_session.php"); 
include("../config.php"); 
?>
<script>
$(document).ready(function(){
$(function(){
$("table").tablesorter();
});
});
</script>

<h3 style="font-family: 'Oswald', sans-serif;letter-spacing:6px;">CONSULTA <small> CATEGORIAS & SUB-CATEGORIAS</small>

		<a href="#" onclick="ldy('gestor/cadastro-categoria-equipamentos-geral.php','.conteudo')" style="letter-spacing:5px; margin-top:10px; margin-right:10px;" class="hidden-xs hidden-print pull-right btn btn-info btn-sm"> 
			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Cadastrar
		</a>
</h3><hr/>
<div class="adiciotes">
		<div class="col-md-6">
		<h4><small>LISTA DE CATEGORIA</small></h4>
		<table class="table table-striped table-condensed table-bordered small" id="table">
			<thead>
			<tr>
				<th> <span class="glyphicon glyphicon-eject" aria-hidden="true"></span> </th>
				<th>Nome</th>
				<th><center> <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> </center></th>
				<th><center> <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> </center></th>
				<th><center> <span class="glyphicon glyphicon-flag" aria-hidden="true"></span> </center></th>
				
			</tr>
			</thead>
		<tbody>
        <?php
		$se = 0;
		$sql = mysql_query("select *,notas_cat_sub.descricao AS cat_descricao, notas_cat_sub.id AS cat_id FROM notas_cat_sub, notas_cat_e WHERE notas_cat_e.id = notas_cat_sub.ass AND notas_cat_e.id <> '0' order by descricao asc");
		$sql = mysql_query("select * from notas_cat_e order by descricao asc");
        while($l = mysql_fetch_array($sql)) { extract($l);
		$se += 1;
		echo '<tr class="small" id="cupom'.$id.'">';
				echo '<td width="3%">'.$se.'</td>';
				echo '<td>'.$descricao.'</td>';
				echo '<td width="10%"><center>';
				if($oculto == '0'){
					echo '<span class="btn btn-xs small btn-success" style="font-size:8px">ATIVO</span>';
				}else{
					echo '<span class="btn btn-xs small btn-danger" style="font-size:8px">INATIVO</span>';
				}
				echo '</center></td>';
				echo '<td style="text-align:center" width="6%"><a href="#" onclick=\'$(".modal-body").load("gestor/editar-categoria-eqp.php?id='.$id.'")\' data-toggle="modal" data-target="#myModal"  class="btn btn-info btn-xs" style="margin:0px; padding:5px;"><span class="glyphicon glyphicon-edit"></span></a></td>';
				
				echo '<td width="40px"><a href="#" onclick=\'$(".modal-body").load("gestor/del/ex-cat-e.php?&id='.$id.'")\' data-toggle="modal" data-target="#myModal2"  class="btn btn-danger btn-xs" style="margin:0px; padding:5px; font-weight:bold;"><span class="glyphicon glyphicon-trash"></span></a></td>';

		echo '</tr>'; 
		}

        ?>
		</tbody></table></div>
		
		<div class="col-md-6">
		<h4><small>LISTA DE SUB-CATEGORIA</small></h4>
		<table class="table table-striped table-condensed table-bordered small" id="table">
		<thead>
			<tr>
				<th> <span class="glyphicon glyphicon-eject" aria-hidden="true"></span> </th>
				<th>Nome</th>
				<th><center> <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> </center></th>
				<th><center> <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> </center></th>
				<th><center> <span class="glyphicon glyphicon-flag" aria-hidden="true"></span> </center></th>
			</tr>
		</thead>
		<tbody>
        <?php
		$se = 0;
       $sql = mysql_query("select notas_cat_sub.id, notas_cat_sub.descricao, notas_cat_sub.associada, notas_cat_e.oculto
FROM notas_cat_sub, notas_cat_e
 WHERE notas_cat_e.id = notas_cat_sub.associada AND notas_cat_sub.associada <> '0' order by descricao asc");
        while($l = mysql_fetch_array($sql)) { extract($l);
		$se += 1;

				echo '<tr class="small" id="cupom'.$id.'">';
				echo '<td width="3%">'.$se.'</td>';
				echo '<td>'.$descricao.'</td>';
				echo '<td width="10%"><center>';
				if($oculto == '0'){
					echo '<span class="btn btn-xs small btn-success" style="font-size:8px">ATIVO</span>';
				}else{
					echo '<span class="btn btn-xs small btn-danger" style="font-size:8px">INATIVO</span>';
				}
				echo '</center></td>';
				echo '<td style="text-align:center" width="6%"><a href="#" onClick=\'$(".modal-body").load("gestor/editar-categoria-sub-eqp.php?id='.$id.'")\' data-toggle="modal" data-target="#myModal"  class="btn btn-info btn-xs" style="margin:0px; padding:5px;"><span class="glyphicon glyphicon-edit"></span></a></td>';
				
				echo '<td width="40px"><a href="#" onclick=\'$(".modal-body").load("gestor/del/ex-cat-sub.php?&id='.$id.'")\' data-toggle="modal" data-target="#myModal2"  class="btn btn-danger btn-xs" style="margin:0px; padding:5px; font-weight:bold;"><span class="glyphicon glyphicon-trash"></span></a></td>';
		echo '</tr>'; }

        ?>
		</tbody></table></div>
</div>


<!-- Modal de edição -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" onclick="$('#myModal').modal('hide')"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">EDITAR INFORMACAO DA CATEGORIA</h4>
      </div>
      
      <div class="modal-body">
	  ...
	  </div>
  
    </div>
  </div>
</div>

	<div class="modal" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:auto;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" onclick="$('.modal').modal('hide')" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Excluir Equipamento</h4>
				</div>
				<div class="modal-body">
					Aguarde um momento &nbsp;&nbsp; <img src="../../imagens/loading.gif" alt="Carregando" width="20px"/>
				</div>
			</div>
		</div>
	</div>