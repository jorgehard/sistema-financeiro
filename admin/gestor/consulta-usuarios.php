<?php
include("../config.php");
include("../validar_session.php");
?>

<script type="text/javascript">
	$(document).ready(function(){
		$(".btnPrint").printPage();
		$("table").tablesorter();
		$(".decimal").maskMoney({precision:2})
		$('.sel').multiselect({
			buttonClass: 'btn btn-sm', 
			numberDisplayed: 1,
			maxHeight: 500,
			includeSelectAllOption: true,
			selectAllText: "Selecionar todos",
			enableFiltering: true,
			enableCaseInsensitiveFiltering: true,
			selectAllValue: 'multiselect-all',
			buttonWidth: 'auto'
		}); 
	});
</script>
	<?php 
		if($ac=='consulta'){ ?>
			<table class="table table-striped table-min table-bordered small">
				<thead>
					<tr>
						<th width="2%">ID</th>
						<th width="70%">Nome</th>
						<th width="10%" style="text-align:center">Obra</th>
						<th width="10%" style="text-align:center">Login</th>
						<th width="10%" style="text-align:center">Acesso</th>
						<th width="3%"><center>SS</center></th>
						<th width="3%"><center><span class="glyphicon glyphicon-eye-open"></span></center></th>
						<th width="3%"><center><span class="glyphicon glyphicon-cog"></span></center></th>
						<th width="3%"><center><span class="glyphicon glyphicon-flag"></span></center></th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach($st as $stb) { @$stu .= $stb.','; } $stu = substr($stu,0,-1);
					foreach($at as $atb) {
						$acesso_find .= "FIND_IN_SET(".$atb.", nivel_acesso) OR ";
					}
					foreach($ob as $obc) { 
						$select_find .= "FIND_IN_SET(".$obc.", cidade) OR ";
					}
					$sql = mysql_query("select * from usuarios where (nome like '%$busca%' OR login like '%$busca%') AND status IN($stu) AND (".$select_find." FIND_IN_SET(0, cidade)) AND (".$acesso_find." FIND_IN_SET(0, nivel_acesso)) order by nome asc");
						while($l = mysql_fetch_array($sql)) { extract($l);
								echo '<tr class="small" id="cupom'.$id.'">';
								echo '<td>'.$id.'</td>';
								echo '<td>'.$nome = strtoupper ($nome).'</td>';
								$cidade = explode(",",$cidade);
								$cidade_nomes = null;
								foreach($cidade as $cic) {
									$cidade_nomes .= "<b>".@mysql_result(mysql_query("SELECT * FROM notas_obras_cidade WHERE id = $cic"),0,"nome")."</b><br/>";
								}
								echo '<td width="20%" style="text-align:center">
											<div onmouseover=$("#teste'.$id.'").addClass("open").removeClass("closed"); onmouseout=$("#teste'.$id.'").addClass("closed").removeClass("open");>
												OBRAS <i class="fa fa-eye" aria-hidden="true"></i>
												<div id="teste'.$id.'" class="closed">'.$cidade_nomes.'</div>
											</div>
										</td>';
								echo '<td style="text-align:center">'.strtoupper ($login).'</td>';
								echo '<td style="text-align:center">'.strtoupper ($acesso_login).'</td>';
								if($editarss == 0){
									echo '<td><span class="label label-danger">NÃO</span></td>';
								}else{
									echo '<td><span class="label label-success">SIM</span></td>';
								}

								if($status == 0){
									echo '<td><span class="label label-success">ATIVO</span></td>';
								}else{
									echo '<td><span class="label label-danger">INATIVO</span></td>';
								}
								echo '<td width="40px"><a href="#" onclick=\'$(".modal-body").load("gestor/editar-usuario.php?id='.$id.'")\' data-toggle="modal" data-target="#myModal"  class="btn btn-success btn-xs" style="margin:0px; font-weight:bold;"><span class="glyphicon glyphicon-pencil"></span></a></td>';
								
								echo '<td width="40px"><a href="#" onclick=\'$(".modal-body").load("gestor/del/ex-user.php?&id='.$id.'")\' data-toggle="modal" data-target="#myModal2"  class="btn btn-danger btn-xs" style="margin:0px; font-weight:bold;"><span class="glyphicon glyphicon-trash"></span></a></td>';
							echo '</tr>';

						}
					?>
				</tbody>
			</table>
		<?php 
			exit;
		} 
		?>
	
	<div style="clear: both; margin-bottom:5px;">
		<h3 style="font-family: 'Oswald', sans-serif;letter-spacing:5px;"> 
			<img src="http://polemicalitoral.com.br/guaruja/imagens/logo.png" style="float:left; margin-bottom:10px;" width="40px"/>
			<p style="position:relative; top:10px; left:10px;">CONSULTA <small> USUÁRIOS CADASTRADOS</small>
			<a href="#" onclick="ldy('gestor/cadastro-usuario.php','.conteudo')" style="margin-left:20px; " class="pull-right btn btn-success btn-xs"><span class="glyphicon glyphicon-pencil"></span> CADASTRAR</a>
			
			<a href="#" onclick="ldy('gestor/consulta-usuarios.php','.conteudo')" style="margin-left:20px;" class="pull-right btn btn-primary btn-xs"><span class="glyphicon glyphicon-refresh"></span> ATUALIZAR PAGINA</a>
			</p>
		</h3>
	</div>
	<div style="clear: both;">
		<hr></hr>
	</div>
	<form action="javascript:void(0)" id="form1" class="hidden-print">
		<div class="well well-sm" style="padding:10px 10px 5px 10px;">
			<label for="">
				<input type="text" name="busca" placeholder="Digite algo para buscar" size="50" class="form-control input-sm">
			</label>
			<label for=""><small>Status:</small> 
				<select name="st[]" class="sel" multiple="multiple">
					<option value="0" selected>ATIVO</option>
					<option value="1" selected>INATIVO</option>
				</select>
			</label>
			<label for=""><small>Obra:</small> 
				<select name="ob[]" class="sel" multiple="multiple">
					<?php
						$obras = mysql_query("select * from notas_obras_cidade order by nome asc");
						while($a = mysql_fetch_array($obras)) {
							echo '<option value="'.$a['id'].'" selected>'.$a['nome'].'</option>';
						}
					?>		
				</select>
			</label>
			<label for="">
					<small>Acesso:</small> 
					<select name="at[]" class="sel" multiple="multiple">
						<?php
							$acesso = mysql_query("select * from acesso_usuario where tipo = '0' order by controle asc");
							while($ace = mysql_fetch_array($acesso)) {
								$controle = "'".$ace['controle']."'";
								echo '<option value="'.$controle.'" selected>'.$ace['descricao'].'</option>';
							}
						?>		
					</select>
				</label>
			<input type="submit" value="Pesquisar" style="width:150px; margin-left:10px;" onClick="post('#form1','gestor/consulta-usuarios.php?ac=consulta','.retorno')" class="btn btn-success btn-sm">
		</div>
	</form>
	<div class="retorno"></div>

	<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" style="width:80%;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" onclick="$('.modal').modal('hide')" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Editar Usuario</h4>
				</div>
				<div class="modal-body">
					Aguarde um momento &nbsp;&nbsp; <img src="../../imagens/loading.gif" alt="Carregando" width="20px"/>
				</div>
			</div>
		</div>
	</div>
	
		<div class="modal" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:auto;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" onclick="$('.modal').modal('hide')" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Excluir Usuario</h4>
				</div>
				<div class="modal-body">
					Aguarde um momento &nbsp;&nbsp; <img src="../../imagens/loading.gif" alt="Carregando" width="20px"/>
				</div>
			</div>
		</div>
	</div>
	