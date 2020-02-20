<?php 
	include("../config.php"); 
	include("../validar_session.php"); 
	date_default_timezone_set('America/Sao_Paulo');
	$today = getdate(); 
	if($today['mday'] < 10) { 
		$today['mon'] = '0'.$today['mon'];
	} else { 
		$today['mon'] = $today['mon'];
	} 
	if($today['mday'] < 10){ 
		$today['mday'] = '0'.$today['mday']; 
	}else{ 
		$today['mday'] = $today['mday']; 
	}  
	$todayTotal = $today['year'].'-'.$today['mon'].'-'.$today['mday'];
?>
<script>
	$(document).ready(function(){
		$(".up").keyup(function() {
			$(this).val($(this).val().toUpperCase());
		});
	});
</script>
<style>
@media only screen and (max-width: 760px), (min-device-width: 768px) and (max-device-width: 1024px)  {
	td:nth-of-type(1):before { content: "Data"; }
	td:nth-of-type(2):before { content: "Histórico"; }
}
.ui-helper-hidden-accessible { display:none; }
.ui-autocomplete-input { 
	padding: 1px; 
	border-radius:4px; 
	background: #FFF; 
	width:80%; 
	height:30px; 
	-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
	margin-bottom: -3px;
} 
ul.ui-autocomplete { 
	border: 1px solid #CCC; 
	background: #FFF; 
	width: 600px; 
	padding: 5px; 
	height: 150px; 
	overflow: auto; 
	z-index: 999999; 
}
li.ui-menu-item { 
	list-style: none; 
	cursor: pointer; 
	font-size: 12px;
	border-bottom: 1px solid #CCC; 
} 
.ui-button{
	background:#d3d3d3;
	height:25px;
	margin-left:5px;
	border-radius:4px;
	position: relative;
	bottom:2px;
}

.ui-button:before {
    content: "\f0c9";
    font-family: FontAwesome;
    font-style: normal;
    font-weight: normal;
    text-decoration: inherit;

    color: #333;
    padding:5px 0px 5px 5px;
    position: absolute;
    top: 0px;
    left: 2.5px;
}
	.ajax-upload-dragdrop {
		width: 400px !important;
	}

	#autoco {
	height: auto;
	max-height: 200px;
	overflow: auto;
	position: absolute;
	border-top: 3px solid #333;
	border-bottom: 3px solid #333;
	display: none;
	width: auto;
	}
</style>
<script>
(function($){$.widget("custom.combobox",{_create:function(){this.wrapper=$("<span>").addClass("custom-combobox").insertAfter(this.element);this.element.hide();this._createAutocomplete();this._createShowAllButton()},_createAutocomplete:function(){var selected=this.element.children(":selected"),value=selected.val()?selected.text():"";this.input=$("<input>").appendTo(this.wrapper).val(value).attr("title","").addClass("custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left").autocomplete({delay:0,
minLength:0,source:$.proxy(this,"_source")}).tooltip({tooltipClass:"ui-state-highlight"});this._on(this.input,{autocompleteselect:function(event,ui){ui.item.option.selected=true;this._trigger("select",event,{item:ui.item.option})},autocompletechange:"_removeIfInvalid"})},_createShowAllButton:function(){var input=this.input,wasOpen=false;$("<a>").attr("tabIndex",-1).attr("title","Mostrar todos os itens").tooltip().appendTo(this.wrapper).button({icons:{primary:"ui-icon-triangle-1-s"},text:false}).removeClass("ui-corner-all").addClass("custom-combobox-toggle ui-corner-right").mousedown(function(){wasOpen=
input.autocomplete("widget").is(":visible")}).click(function(){input.focus();if(wasOpen)return;input.autocomplete("search","")})},_source:function(request,response){var matcher=new RegExp($.ui.autocomplete.escapeRegex(request.term),"i");response(this.element.children("option").map(function(){var text=$(this).text();if(this.value&&(!request.term||matcher.test(text)))return{label:text,value:text,option:this}}))},_removeIfInvalid:function(event,ui){if(ui.item)return;var value=this.input.val(),valueLowerCase=
value.toLowerCase(),valid=false;this.element.children("option").each(function(){if($(this).text().toLowerCase()===valueLowerCase){this.selected=valid=true;return false}});if(valid)return;this.input.val("").attr("title",value+" didn't match any item").tooltip("open");this.element.val("");this._delay(function(){this.input.tooltip("close").attr("title","")},2500);this.input.autocomplete("instance").term=""},_destroy:function(){this.wrapper.remove();this.element.show()}})})(jQuery);$(function(){$(".combobox").combobox()});
</script>
<?php 
// KM combustivel
if(@$ac=='inserir-km') {
	$sql = mysql_query("INSERT INTO notas_historico_km (`data`,`km`,`id_equipamento`, `descricao`, `data2`, `km2`) VALUES ('$data','$km','$id', '$historico', '$data2', '$km2')");
	if($sql) { 
		echo '<script>ldy("almoxarifado/editar-equipamento-master.php?ac=listar-km&id='.$id.'",".listar-historico")</script>'; 
	}		
}
if(@$ac=='inserir-desconto') {
	$sql = mysql_query("INSERT INTO notas_equipamentos_descontos (`obs`,`valor`,`data_ref`, `tipo`, `equipamento`) VALUES ('$obs','$valor','$data', '$tipo', '$id')");
	if($sql) { 
		echo '<script>ldy("almoxarifado/editar-equipamento-master.php?ac=listarDesconto&id='.$id.'",".listar-desconto")</script>'; 
	}else{
		echo 'Algo aconteceu de errado , atualize a pagina e tente novamente!!';
	}	
	exit;
}
if(@$ac=='listarDesconto') {
	echo '<table class="table table-condensed table-striped table-bordered">';
	echo '<tr><th>Descrição</th><th>Valor</th><th>Data</th><th>Tipo</th><th style="text-align:center"><span class="glyphicon glyphicon-trash"></span> </th></tr>';
	$sqlH = mysql_query("SELECT * FROM notas_equipamentos_descontos WHERE equipamento = '$id'"); 
	while($h=mysql_fetch_array($sqlH)) {
		echo '<tr>';
		echo '<td width="40%">'.$h['obs'].'</td>';
		echo '<td width="15%">'.$h['valor'].'</td>';
		echo '<td width="15%">'.implode("/",array_reverse(explode("-",$h['data_ref']))).'</td>';
		if($h['tipo'] == '1'){
			echo '<td width="15%">RESSARCIMENTO</td>';
		}else{
			echo '<td width="15%">DESCONTO</td>';
		}
		echo '<td width="15%" style="text-align:center"><a href="#" onclick=\'$(".listar-desconto").load("almoxarifado/editar-equipamento.php?ac=deletarDesconto&id_equipamento='.$id.'&id='.$h['id'].'")\' class="btn btn-xs btn-danger" style="margin:0px; padding:5px; font-weight:bold;"><span class="glyphicon glyphicon-trash"></span></a></td>';
		echo '</tr>';
	}
	echo '</table>';
	exit;
}
if(@$ac=='listar-km') {
		echo '<table class="table table-condensed table-striped table-bordered">';
		echo '<tr><td style="background:#FFF; border-top:1px solid #FFF; border-left:1px solid #FFF"></td><td colspan="2"><b><center>Atual</center></b></td><td colspan="2"><b><center>Proxima</center></b></td></tr>';
		echo '<tr><th><small>Descrição</small></th><th><small>Data</small></th><th><small>KM</small></th><th><small>Data</small></th><th><small>KM</small></th></tr>';
		$sql = mysql_query("SELECT * FROM notas_historico_km WHERE id_equipamento = $id"); 
		while($l=mysql_fetch_array($sql)) { 
			extract($l);
			echo '<tr>';
				echo '<td width="40%">'.$descricao.'</td>';
				echo '<td width="15%">'.implode("/",array_reverse(explode("-",$data))).'</td>';
				echo '<td width="15%">'.$km.'</td>';
				echo '<td width="15%">'.implode("/",array_reverse(explode("-",$data2))).'</td>';
				echo '<td width="15%">'.$km2.'</td>';
			echo '</tr>';
		}
		echo '</table>';
		exit;
}
if(@$ac == 'up') {
	$id_usuario_logado = $_SESSION['id_usuario_logado']; 
	$ip = $_SERVER['REMOTE_ADDR'];		

	$q = mysql_query("UPDATE notas_equipamentos SET local = '$local', equipe = '$equipe', obs = '$obs', user_edit = '$id_usuario_logado', data_edit = now() WHERE id = $id");
	$ip = $_SERVER["REMOTE_ADDR"];
	if($query) { 
		echo '<p class="text-success">Informações atualizadas</p> <script>$(".retorno").load("almoxarifado/editar-equipamento-master.php?id='.$id.'")</script>'; 
	}else { 
		echo '<p class="text-danger">'.mysql_error().'</p>'; 
	}
	exit;
} 

?>
	<?php $sql = mysql_query("SELECT * FROM notas_equipamentos WHERE id = '$id'"); while($l = mysql_fetch_array($sql)) { extract($l);
	$equipe_e = $l['equipe'];?>
	<div class="ajax"></div>
	
	<div class="col-sm-12" style="margin-bottom:12px">
		<button type="button" class="btn btn-info small" >
		
			<h6>Ultima atualização: <b><?php $control_date = explode(" ",$data_edit); echo implode("/",array_reverse(explode("-",$control_date[0])))." ".$control_date[1] ?></h6></b>
		</button>
	</div>
	<div class="col-sm-12">
		<form action="javascript:void(0)" onSubmit="post(this,'almoxarifado/editar-equipamento-almox.php?ac=up&id=<?php echo $id ?>','.ajax')" enctype="multipart/form-data">
			<div class="panel panel-default">
			<div class="panel-heading"><h5><small>Informações do Equipamento</small></h5></div>
				<div class="panel-body" style="width:100%">	
					<div class="col-xs-12 col-sm-4">
						<div class="col-xs-6">
							<label style="width:100%">Placa: <br/> <input type="text" name="placa" value="<?php echo $placa; ?>" class="form-control input-sm"  onfocus="$(this).mask('aaa-9999')" disabled /></label>
						</div>
						<div class="col-xs-6">
							<label style="width:100%">Patrimonio: <br/><input type="text" name="patrimonio" value="<?php echo $patrimonio; ?>" class="form-control input-sm up"  required ></label>
						</div>
						<div class="col-xs-6">
							<label style="width:100%">Marca: </br><input type="text" name="marca" value="<?php echo $marca; ?>" class="form-control input-sm up" required disabled ></label>
						</div>
						<div class="col-xs-6">
							<label style="width:100%">Contrato: <br><input type="text" name="patrimonio2" value="<?php echo $patrimonio2; ?>" class="form-control input-sm" disabled ></label>
						</div>
						<div class="col-xs-6">
							<label style="width:100%">Valor: <br><input type="number" step="0.1" name="valor" value="<?php echo $valor; ?>" class="form-control input-sm"  required disabled ></label>
						</div>
						<div class="col-xs-6">
							<label style="width:100%">Dia Pagamento: <br><input type="text" name="dia_pagamento" value="<?php echo $dia_pagamento; ?>" class="form-control input-sm"  required disabled ></label>
						</div>
						<div class="col-xs-6">
							<label style="width:100%">Justificativa: <br><input type="text" name="justificativa" value="<?php echo $justificativa; ?>" class="form-control input-sm"  disabled /></label>
						</div>
						
						<div class="col-xs-6">
							<label style="width:100%">Desconto: <br><input type="number" name="desconto" value="<?php echo $desconto; ?>" step="0.01" class="form-control input-sm"  disabled /></label>
						</div>
						<div class="col-xs-6">
							<label style="width:100%">Ano: <br><input type="text" name="ano" value="<?php echo $ano; ?>" class="form-control input-sm"  required disabled ></label>
						</div>
						<div class="col-xs-6">
							<label style="width:100%">Chassi / Nº série: <br><input style="width:100%;"type="text" name="chassi" value="<?php echo $chassi; ?>" class="form-control input-sm up"  required disabled ></label>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4">
						<div class="col-xs-12">
							<label>Empresa: <br>
								<select name="empresa" class="form-control input-sm" disabled >
									<option value="0"></option>
									<?php 
										$categorias = mysql_query("select * from notas_empresas WHERE status = 0 order by nome asc");
										while($l = mysql_fetch_array($categorias)) {
											if($empresa==$l['id']) { 
												echo '<option value="'.$l['id'].'" selected>'.$l['nome'].'</option>'; 
											} else { 
												echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>'; 
											}
										}
									?>			
								</select>
							</label>
						</div>
						<div class="col-xs-12">
							<label for "" style="width:100%"> Categoria & Sub-Categoria: 
								<select name="categoria" onChange="$('#itens2').load('almoxarifado/sub-cat-eq.php?categoria=' + $(this).val() + '');" style="width:100%" class="form-control input-sm" id="categ" disabled >
									<option value="0">SELECIONE UMA CATEGORIA</option>
									<?php 
										$categorias = mysql_query("select * from notas_cat_e where oculto = '0' order by descricao asc");
										while($l = mysql_fetch_array($categorias)) {
											if($categoria==$l['id']) {
												echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>'; 
											} else { 
												echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>'; 
											}
										}
									?>		
								</select>
							</label>
						</div>
						<div class="col-xs-12">
							<label id="itens2" style="width:100%">
								<label style="width:100%">
									<select name="sub_categoria" style="width:100%" class="form-control input-sm" disabled >
										<option>SELECIONE UMA SUB-CATEGORIA PRIMEIRO!</option>
										<?php 
											$sub_categorias = mysql_query("select * from notas_cat_sub where associada = $categoria order by descricao asc");
											while($l = mysql_fetch_array($sub_categorias)) {
												if($sub_categoria==$l['id']) { 
													echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>'; 
												} else { 
													echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>'; 
												}
											}
										?>		

									</select>
								</label>
							</label>
						</div>
						<div class="col-xs-12">
							<label>Observações: <br><input type="text" maxlength="300" style="height: 100px;" size="300" name="obs" value="<?php echo $obs; ?>" class="form-control input-sm"></textarea></label>
						</div>
					</div>
		
					<div class="col-xs-12 col-sm-4">
						<div class="col-xs-6">
							<label style="width:100%">Situação: <br>
								<select name="situacao" class="form-control input-sm" disabled >
									<?php 
										$situacoes = mysql_query("select * from notas_eq_situacao where status = '0' order by descricao asc");
										while($l = mysql_fetch_array($situacoes)) {
											if($situacao==$l['id']) { echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>'; }
											else { echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>'; }
										}
									?>			
								</select>
							</label>
						</div>
						<div class="col-xs-6">
							<label>Obra:
								<select name="obra_opcao" class="form-control dropdown input-sm" disabled >
									<?php
										$obras = mysql_query("select * from notas_obras WHERE status = '0' and id IN($obra_usuario) ORDER BY descricao");
										while($l = mysql_fetch_array($obras)) { 
											if($l['id']==$obra) { echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>'; }
											else { echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>'; }
										}
									?>		
								</select>
							</label>
						</div>
						<div class="col-xs-12">
							<label style="width:100%">Responsável: <br>
								<select name="local" class="form-control input-sm combobox" required>
									<option value="0">00._SEM RESPONSAVEL</option>	
									<?php 
										$categorias = mysql_query("select * from rh_funcionarios where demissao = '0000-00-00' and obra IN($obra_usuario) order by nome asc");
										while($l = mysql_fetch_array($categorias)) {
											if($l['id']==$local) { echo '<option value="'.$l['id'].'" selected>'.$l['nome'].'</option>'; }
											else { echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>'; }
										}
									?>			
								</select>
							</label>
						</div>
						<div class="col-xs-12">
							<label style="width:100%">Equipe: <br>
								<select name="equipe" class="form-control input-sm combobox">
									<option value="0">00._SEM EQUIPE</option>	
									<?php 
										$equipes = mysql_query("select * from equipes where id <> 0 and status = 0 and oculto = 1 and obra IN($cidade_usuario) order by nome asc");
										while($l = mysql_fetch_array($equipes)) {
											if($l['id']==$equipe_e) { echo '<option value="'.$l['id'].'" selected>'.$l['nome'].'</option>'; }
											else { echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>'; }
										}
									?>			
								</select>
							</label>
						</div>
						<div class="col-xs-6">
							<label style="width:100%">Status: 
								<select class="form-control input-sm" name="status_2" disabled>
									<option value=""></option>
									<?php 
										$status_dois = mysql_query("select * from status_2 order by descricao asc");
										while($l = mysql_fetch_array($status_dois)) {
											if($l['id']==$status_2) { echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>'; }
											else { echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>'; }
										}
									?>	
								</select>
							</label>	
						</div>
						<div class="col-xs-6">
							<label style="width:100%">Tipo de contrato: <br>
								<select name="contrato" class="form-control input-sm" disabled >
									<option value="0"></option>	
									<?php 
										$contratos = mysql_query("select * from rh_contratos order by nome asc");
										while($l = mysql_fetch_array($contratos)) {
											if($l['id']==$contrato) { echo '<option value="'.$l['id'].'" selected>'.$l['nome'].'</option>'; }
											else { echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>'; }
										}
									?>			
								</select>
							</label>
						</div>
						<div class="col-xs-6">
							<label style="width:100%">Entrada: <br><input type="date" name="entrada" value="<?php echo $entrada ?>" class="form-control input-sm" disabled ></label>
						</div>
						<div class="col-xs-6">
							<label style="width:100%">Saída: <br><input type="date" name="saida" value="<?php echo $saida ?>" class="form-control input-sm" disabled ></label><br/>
						</div>
						<?php } ?>
						<div class="pull-right" style="margin-top:40px;">
							<input type="submit" style="width:250px; margin-top:10px" value="Atualizar" class="btn btn-success btn-sm">
						</div>
					</div>
				</div>
			</div>
		</form>
		<!-- DESCONTOS -->
		<div class="panel panel-default">
			<div class="panel-heading"><h5><small> Historico de Descontos</small></h5></div>
			<div class="desconto" style="padding:15px;">
				<form action="javascript:void(0)" onsubmit="post(this,'almoxarifado/editar-equipamento-almox.php?ac=inserir-desconto&id=<?php echo $id;?>','.listar-desconto')" class="form-inline small">
						<table class="table table-responsive table-bordered table-condensed table-striped" style="background:#FFF">
						<tr><th>Descrição</th><th>Valor</th><th>Data</th><th>Tipo</th><th></th></tr>
						<tr>
							<td width="50%">
								<label style="width:100%" ><input type="text" maxlength="250" style="width:100%; margin-top:5px;" class="form-control input-sm" name="obs" required></label>
							</td>
							<td width="10%">
								<label>
									<input type="number" step="0.01"  name="valor" placeholder="R$" style="width:100%" class="form-control input-sm" required>
								</label>
							</td>
							<td width="10%">
								<label>
									<input type="date" name="data" style="width:100%" value="<?php echo $todayTotal?>" max="<?php echo $todayTotal?>" class="form-control input-sm" required>
								</label>
							</td>
							<td width="10%">
								<label>
									<select name="tipo" class="form-control input-sm">
										<option value="0">DESCONTO</option>
										<option value="1">RESSARCIMENTO</option>
									</select>
								</label>
							</td>
							<td width="10%">
								<label style="width:85%;" ><input type="submit" style="width:100%; margin:0px 10px 0px 10px" class="btn btn-success btn-sm" value="Inserir" /></label>
							</td>
						</tr>
						</table>
				</form>
				<div class="listar-desconto">
					<?php
					echo '<table class="table table-condensed table-striped table-bordered">';
					echo '<tr><th>Descrição</th><th>Valor</th><th>Data</th><th>Tipo</th><th style="text-align:center"><span class="glyphicon glyphicon-trash"></span> </th></tr>';
						$sqlH = mysql_query("SELECT * FROM notas_equipamentos_descontos WHERE equipamento = '$id'"); 
						while($h=mysql_fetch_array($sqlH)) {
							echo '<tr>';
							echo '<td width="40%">'.$h['obs'].'</td>';
							echo '<td width="15%">'.$h['valor'].'</td>';
							echo '<td width="15%">'.implode("/",array_reverse(explode("-",$h['data_ref']))).'</td>';
							if($h['tipo'] == '1'){
								echo '<td width="15%">RESSARCIMENTO</td>';
							}else{
								echo '<td width="15%">DESCONTO</td>';
							}
							echo '<td width="15%" style="text-align:center"><a href="#" onclick=\'$(".listar-desconto").load("almoxarifado/editar-equipamento.php?ac=deletarDesconto&id_equipamento='.$id.'&id='.$h['id'].'")\' class="btn btn-xs btn-danger" style="margin:0px; padding:5px; font-weight:bold;"><span class="glyphicon glyphicon-trash"></span></a></td>';
							echo '</tr>';
						}
						echo '</table>';
					?>	
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading"><h5><small>Incluir foto ao equipamento</small></h5></div>
			<center>
				<div class="panel-body" style="width:100%">
					<?php 
						if($imagem <> '') { echo '<td><img src="almoxarifado/uploads/'.$imagem.'" alt="" class="img-thumbnail"></td>'; }
							echo '<form action="almoxarifado/upload_eq.php?id='.$id.'&img='.$imagem.'" enctype="multipart/form-data" method="POST" target="ifrm">';
							echo '<label>Imagem: <br/><input type="file" style="width:100%" name="myfile" class="form-control input-sm"></label><br/>';
							echo '<label><input type="submit" style="width:100px" class="btn btn-info btn-sm" value="Enviar"></label>'; 	
							echo '</form>';
					?>
				</div>
			</center>
		</div>
		<iframe name="ifrm" style="display:none"></iframe>
		<div class="panel panel-default">
			<div class="panel-heading"><h5>Inserir <small> Historico de informações</small></h5></div>
			<div class="historico" style="padding:15px;">
				<form action="javascript:void(0)" onsubmit="post(this,'almoxarifado/editar-equipamento-almox.php?ac=inserir-km&id=<?php echo $id;?>','.listar-historico')" class="form-inline small">
						<table class="table table-responsive table-bordered table-condensed table-striped" style="background:#FFF">
						<tr><th>Descricao</th><th colspan="2">Atual</th><th colspan="2">Proxima</th><th></th></tr>
						<tr>
							<td width="50%">
								<label style="width:100%" ><input type="text" maxlength="200" style="width:100%; height:40px; margin-top:5px;" class="form-control input-sm" name="historico" required></label>
							</td>
							<td width="10%">
								<label>Data: <input type="date" name="data" style="width:100%" value="<?php echo $todayTotal?>" max="<?php echo $todayTotal?>" class="form-control input-sm" required></label>
							</td>
							<td width="10%">
								<label>KM: <input type="number" step="0.01"  name="km" style="width:100%" class="form-control input-sm" required></label>
							</td>
							<td width="10%">
								<label>Data: <input type="date" name="data2" style="width:100%" value="<?php echo $todayTotal?>" class="form-control input-sm"></label>
							</td>
							<td width="10%">
								<label>KM: <input type="number" step="0.01" name="km2" style="width:100%" class="form-control input-sm"></label>
							</td>
							<td width="10%">
								<label style="width:85%;" ><input type="submit" style="width:100%; margin:0px 10px 0px 10px" class="btn btn-success btn-sm" value="Inserir" /></label>
							</td>
						</tr>
						</table>
				</form>
				<div class="listar-historico">
				<?php
				echo '<table class="table table-condensed table-striped table-bordered">';
				echo '<tr><td style="background:#FFF; border-top:1px solid #FFF; border-left:1px solid #FFF"></td><td colspan="2"><b><center>Atual</center></b></td><td colspan="2"><b><center>Proxima</center></b></td></tr>';
				echo '<tr><th><small>Descrição</small></th><th><small>Data</small></th><th><small>KM</small></th><th><small>Data</small></th><th><small>KM</small></th></tr>';
					$sqlH = mysql_query("SELECT * FROM notas_historico_km WHERE id_equipamento = '$id'"); 
					while($h=mysql_fetch_array($sqlH)) {
						echo '<tr>';
							echo '<td width="40%">'.$h['descricao'].'</td>';
							echo '<td width="15%">'.implode("/",array_reverse(explode("-",$h['data']))).'</td>';
							echo '<td width="15%">'.$h['km'].'</td>';
							echo '<td width="15%">'.implode("/",array_reverse(explode("-",$h['data2']))).'</td>';
							echo '<td width="15%">'.$h['km2'].'</td>';
						echo '</tr>';
					}
					echo '</table>';
				?>	
				</div>
			</div>
		</div>
	</div>