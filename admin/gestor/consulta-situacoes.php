<?php
	include("../config.php");
	include("../validar_session.php");
	getData();
	getNivel();
?>
	<style>
	tr:hover td {background:#fcec88; font-weight:bold;}
	</style>
			<script type="text/javascript">
			$(document).ready(function(){
				$("table").tablesorter();
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
			<div class="container-fluid " style="padding:0px 0px 15px 0px; margin-bottom:20px; border-bottom:1px solid #CCC">
				<img src="../imagens/logo.png" class="img-responsive" width="50px" style="float:left; margin-right:20px"/>
				<h3 style="font-family: 'Oswald', sans-serif; letter-spacing:5px;"> 
					CONSULTA <small><b>SITUAÇÕES</b></small>
					<a href="javascript:window.print()" style="letter-spacing:8px; padding-left:40px; padding-right:40px;" class="hidden-xs hidden-print pull-right btn btn-warning btn-sm"> <span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Imprimir</a>
				</h3>
			</div>
			<div class="well well-sm hidden-print">
				<center>
					<label>Selecione oque deseja: 
						<select class="form-control input-sm" style="margin-top:10px;" name="categoria" onchange="ldy('gestor/consulta-situacoes.php?categoria=' + $(this).val(),'.conteudo')">			
							<option value="0" disabled selected>Selecione</option>				
							<option value="1" <?php if($categoria == '1'){ echo 'selected';} ?>>SITUAÇÃO EQUIPAMENTOS</option>
							<option value="2" <?php if($categoria == '2'){ echo 'selected';} ?>>SITUAÇÃO SS</option>
							<option value="3" <?php if($categoria == '3'){ echo 'selected';} ?>>SITUAÇÃO FUNCIONARIO</option>
						</select>
					</label>
				</center>
			</div>
			
			<?php if(isset($categoria) <> '0') {
				//EQUIPAMENTO
				if($categoria == '1'){
					
					$sql1 = mysql_query("SELECT * FROM notas_eq_situacao ORDER BY descricao");

					echo '<a href="#" onclick=\'$(".modal-body").load("gestor/cadastro-situacao.php?categoria='.$categoria.'")\' data-toggle="modal" data-target="#myModal1" class="btn pull-right btn-warning btn-xs" style="margin:0px 0px 10px 0px; padding:5px;"><span class="glyphicon glyphicon-plus"></span> Adicionar Nova</a>';

					echo '<a href="#" onclick="ldy(\'gestor/consulta-situacoes.php?categoria='.$categoria.'\',\'.conteudo\')" class="btn pull-right btn-info btn-xs" style="margin:0px 10px 10px 0px; padding:5px;"><span class="glyphicon glyphicon glyphicon-refresh"></span> Atualizar</a>';

					echo '<table class="table table-min table-striped table-bordered">';
					echo '<thead><tr> <th>ID</th> <th>DESCRICÃO</th> <th>STATUS</th> <th></th> </tr></thead><tbody>';
					while($a = mysql_fetch_array($sql1)){
						extract($a);
						echo '<tr>';
						echo '<td width="40px">'.$id.'</td>';
						echo '<td>'.strtoupper($descricao).'</td>';
						echo '<td width="100px"><center>';
						if($status == '0'){
							echo '<span class="btn btn-xs small btn-success" style="font-size:8px">ATIVO</span>';
						}else{
							echo '<span class="btn btn-xs small btn-danger" style="font-size:8px">INATIVO</span>';
						}
						
						
						
						echo '</center></td>';
						echo '<td width="50px" style="text-align:center"><a href="#" onclick=\'$(".modal-body").load("gestor/editar-situacao.php?id='.$id.'&categoria='.$categoria.'")\' data-toggle="modal" data-target="#myModal1"  class="btn btn-info btn-xs" style="margin:0px; padding:5px;"><span class="glyphicon glyphicon-edit"></span></a></td>';
						echo '</tr>';
					}
					echo '</tbody></table>';
					
				}
				//SITUAÇÃO SS
				if($categoria == '2'){
					$sql1 = mysql_query("SELECT * FROM ss_situacao ORDER BY descricao");

					echo '<a href="#" onclick=\'$(".modal-body").load("gestor/cadastro-situacao.php?categoria='.$categoria.'")\' data-toggle="modal" data-target="#myModal1" class="btn pull-right btn-warning btn-xs" style="margin:0px 0px 10px 0px; padding:5px;"><span class="glyphicon glyphicon-plus"></span> Adicionar Nova</a>';

					echo '<a href="#" onclick="ldy(\'gestor/consulta-situacoes.php?categoria='.$categoria.'\',\'.conteudo\')" class="btn pull-right btn-info btn-xs" style="margin:0px 10px 10px 0px; padding:5px;"><span class="glyphicon glyphicon glyphicon-refresh"></span> Atualizar</a>';

					echo '<table class="table table-min table-striped table-bordered">';
					echo '<thead><tr> <th>ID</th> <th>SITUAÇÃO</th> <th>DESCRICÃO</th> <th>STATUS</th> <th></th> </tr></thead><tbody>';
					while($a = mysql_fetch_array($sql1)){
						extract($a);
						echo '<tr>';
						echo '<td width="40px">'.$id.'</td>';
						echo '<td width="40px">'.$situacao.'</td>';
						echo '<td>'.$descricao.'</td>';
						echo '<td width="100px"><center>';
						if($status == '0'){
							echo '<span class="btn btn-xs small btn-success" style="font-size:8px">ATIVO</span>';
						}else{
							echo '<span class="btn btn-xs small btn-danger" style="font-size:8px">INATIVO</span>';
						}
						echo '</center></td>';
						echo '<td width="50px" style="text-align:center"><a href="#" onclick=\'$(".modal-body").load("gestor/editar-situacao.php?id='.$id.'&categoria='.$categoria.'")\' data-toggle="modal" data-target="#myModal1"  class="btn btn-info btn-xs" style="margin:0px; padding:5px;"><span class="glyphicon glyphicon-edit"></span></a></td>';
						echo '</tr>';
					}
					echo '</tbody></table>';
					
				}
				//FUNCIONARIO
				if($categoria == '3'){
					$sql1 = mysql_query("SELECT * FROM rh_situacao ORDER BY ordem");

					echo '<a href="#" onclick=\'$(".modal-body").load("gestor/cadastro-situacao.php?categoria='.$categoria.'")\' data-toggle="modal" data-target="#myModal1" class="btn pull-right btn-warning btn-xs hidden-print" style="margin:0px 0px 10px 0px; padding:5px;"><span class="glyphicon glyphicon-plus"></span> Adicionar Nova</a>';

					echo '<a href="#" onclick="ldy(\'gestor/consulta-situacoes.php?categoria='.$categoria.'\',\'.conteudo\')" class="btn pull-right btn-info btn-xs hidden-print" style="margin:0px 10px 10px 0px; padding:5px;"><span class="glyphicon glyphicon glyphicon-refresh"></span> Atualizar</a>';

					echo '<table class="table table-color table-striped table-bordered">';
					echo '<thead>
							<tr> 
								<th style="text-align:center"><span class="glyphicon glyphicon-eject"></span></th> 
								<th>Descrição</th> 
								<th style="text-align:center">Status</th> 
								<th style="text-align:center">Editar</th> 
								<th style="text-align:center"><span class="glyphicon glyphicon-edit"></span></th> 
							</tr>
							</thead>
							<tbody id="sortable1">';
					while($a = mysql_fetch_array($sql1)){
						extract($a);
						echo '<tr id="'.$id.'" class="sort-class">';
						echo '<td width="50px" style="text-align:center">'.$ordem.'</td>';
						echo '<td>'.$descricao.'</td>';
						echo '<td width="100px"><center>';
						if($status == '0'){
							echo '<span style="width:100%" class="btn btn-xs small btn-success" style="font-size:8px">ATIVO</span>';
						}else{
							echo '<span style="width:100%" class="btn btn-xs small btn-danger" style="font-size:8px">INATIVO</span>';
						}
						echo '</center></td>';
						echo '<td width="100px"><center>';
						if($editar == '0'){
							echo '<spa style="width:100%" class="btn btn-xs small btn-success" style="font-size:8px">SIM</span>';
						}else{
							echo '<span style="width:100%" class="btn btn-xs small btn-danger" style="font-size:8px">NÃO</span>';
						}
						echo '</center></td>';
						echo '<td width="50px" style="text-align:center"><a href="#" onclick=\'$(".modal-body").load("gestor/editar-situacao.php?id='.$id.'&categoria='.$categoria.'")\' data-toggle="modal" data-target="#myModal1"  class="btn btn-info btn-xs" style="margin:0px; padding:5px;"><span class="glyphicon glyphicon-edit"></span></a></td>';
						echo '</tr>';
					}
					echo '</tbody></table>';
					
				}
				
			?>
			<script>
			$("#sortable1").sortable({
				update: function(){
					var lista = $('#sortable1').sortable("toArray"); 
					$.post("gestor/ordenasituacao.php",{lista:lista}, function(){
						alert('Ordem alterada com sucesso!!');
					});
				}
			});
			</script>
			
		<?php } ?>
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" onclick="$('.modal').modal('hide')" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Painel Situações</h4>
      </div>
      
      <div class="modal-body">
	  ...
	  </div>
  
    </div>
  </div>
</div>
