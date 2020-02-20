<?php include("../validar_session.php"); ?>
<?php include("../config.php") ?>
<script>
	$(document).ready(function(){
		$("table").tablesorter();
	});
</script>
<script type="text/javascript">
$(document).ready(function(){
	$(".decimal").maskMoney({precision:2})
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
	if(@$ac == 'del') { 
		$sql = mysql_query("delete from encarregados where id = '$id'"); 
		
		if($sql) { 
			echo '<center><p class="text-success">Informação deletada com sucesso!!</p></center>'; 
		}
	exit;
	}
	?>
	
<?php if(@$ac == 'localizar') { ?>
		<table class="table table-min table-striped table-condensed table-bordered small">
		<thead>
			<tr>
				<th><center> <span class="glyphicon glyphicon-eject" aria-hidden="true"></span> </center></th>
				<th>Nome</th>
				<th><center> <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> </center></th>
				<th class="hidden-print"><center> <span class="glyphicon glyphicon-flag" aria-hidden="true"></span> </center></th>
				<th class="hidden-print"><center> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> </center></th>
			</tr>
		</thead><tbody>
       <?php
		foreach($st as $stb) { @$stu .= $stb.','; } $stu = substr($stu,0,-1);
		foreach($ob as $obc) { @$obu .= $obc.','; } $obu = substr($obu,0,-1);
		$sql = mysql_query("select * from encarregados where oculto IN($stu) AND obra IN($obu)");
		while($l = mysql_fetch_array($sql)) { extract($l);
		$id = $l['id'];
			echo '<tr id="cupom'.$id.'">';
				echo '<td width="2%">'.$id.'</td>';
				echo '<td width="80%">'.$nome.'</td>';
				if($oculto == '0'){
					echo '<td width="8%" style="text-align:center"><span class="label label-success">ATIVO</span></td>';
				}else{
					echo '<td width="8%" style="text-align:center"><span class="label label-danger">INATIVO</span></td>';
				}
				echo '<td width="3%" class="hidden-print"><center><a href="#" onclick=\'$(".modal-body").load("gestor/editar-encarregados.php?id='.$id.'")\' data-toggle="modal" data-target="#myModal"  class="btn btn-info btn-xs" style="margin:0px; padding:5px;"><span class="glyphicon glyphicon-edit"></span></a></center></td>';
				
				echo '<td width="3%" class="hidden-print"><center><a href="#" onclick=\'$(".modal-body").load("gestor/del/ex-enca.php?&id='.$id.'")\' data-toggle="modal" data-target="#myModal2"  class="btn btn-danger btn-xs" style="margin:0px; padding:5px; font-weight:bold;"><span class="glyphicon glyphicon-trash"></span></a></center></td>';	

			echo '</tr>'; 
		}
		
        ?>
		</tbody>
	</table>
<?php exit; } ?>


<h3 style="font-family: 'Oswald', sans-serif;letter-spacing:6px;">CONSULTA <small>LISTA DE ENCARREGADOS</small>

		<a href="#" onclick="ldy('ss/cadastro-encarregado.php','.conteudo')" style="letter-spacing:5px; margin-top:10px; margin-right:10px;" class="hidden-xs hidden-print pull-right btn btn-info btn-sm"> 
			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Cadastrar
		</a>
		<a href="#" onclick="ldy('gestor/consulta-encarregados.php','.conteudo')" style="letter-spacing:5px; margin-top:10px; margin-right:10px;" class="hidden-xs hidden-print pull-right btn btn-success btn-sm"> 
			<span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>&nbsp;Atualizar
		</a>
</h3><hr/>
	<form action="javascript:void(0)" id="form1" class="hidden-print">
		<div class="well well-sm" style="padding:10px 10px 5px 10px;">
			<label for=""><small>Obra:</small> <br/>
				<select name="ob[]" class="sel" multiple="multiple">
					<?php
						$obras = mysql_query("select * from notas_obras_cidade WHERE id IN($cidade_usuario) order by nome asc");
						while($a = mysql_fetch_array($obras)) {
							echo '<option value="'.$a['id'].'" selected>'.$a['nome'].'</option>';
						}
					?>		
				</select>
			</label>
			<label for=""><small>Nome:</small> <br/>
				<input type="text" name="busca" placeholder="Digite algo para buscar" size="100" class="form-control input-sm">
			</label>
			<label for=""><small>Status:</small> <br/>
				<select name="st[]" class="sel" multiple="multiple">
					<option value="0" selected>ATIVO</option>
					<option value="1" selected>OCULTO</option>
				</select>
			</label>
			<input type="submit" value="Pesquisar" style="width:150px; margin-left:10px;" onClick="post('#form1','gestor/consulta-encarregados.php?ac=localizar','.retorno')" class="btn btn-success btn-sm">
		</div>
	</form>
	<div class="retorno"></div>

<div id="ajax"></div>
<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" onclick="$('.modal').modal('hide')" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Editar</h4>
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
					<h4 class="modal-title" id="myModalLabel">Excluir Equipe</h4>
				</div>
				<div class="modal-body">
					Aguarde um momento &nbsp;&nbsp; <img src="../../imagens/loading.gif" alt="Carregando" width="20px"/>
				</div>
			</div>
		</div>
	</div>
	