<?php 
	include("../config.php");
	include("../validar_session.php");
?>
<style type="text/css">
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
	if($ac=='consulta'){
		$sql = mysql_query("SELECT * FROM equipes_obs WHERE id_equipe = '$id' ORDER BY id DESC");
		echo '<table class="table table-condensed table-striped small" style="margin-top:10px">';
			echo '<tr class="active"><th>Data:</th><th>Descrição:</th></tr>';
		while($l = mysql_fetch_array($sql)) {
			echo '<tr>';
			echo '<td width="20%">'.implode("/",array_reverse(explode("-",$l['data_obs']))).'</td>';
			echo '<td>'.$l['descricao_obs'].'</td>';
			echo '</tr>';
		}
		echo '</table>';
		exit;
	}
	if(@$ac=='update') {
		mysql_query("UPDATE equipes SET nome = '$nome', status = '$status2', obra = '$obra' WHERE id = $id");
		exit;
	}
	if(@$ac=='obs') {
		$insert = mysql_query("INSERT INTO equipes_obs (`descricao_obs`, `data_obs`, `id_equipe`) VALUES ('$descricao_obs','$data_obs', '$id')");
		if($insert){
			echo '<script>ldy("gestor/editar-equipe.php?ac=consulta&id='.$id.'",".resultado-obs")</script>';
		}else{
			echo 'Error! Algo deu errado, tente novamente';
		}
		exit;
	}
?>
<div style="height:100%">
<form action="javascript:void(0)" onSubmit="post(this,'gestor/editar-equipe.php?ac=update&id=<?php echo $id ?>','.ajax'); $('#myModal').modal('hide')">
	<?php
		$sql = mysql_query("select * from equipes WHERE id = $id");
		while($l = mysql_fetch_array($sql)) { extract($l);
			echo '<label for="" style="width:100%">Nome da Conta: 
					<input type="text" class="form-control input-sm" name="nome" value="'.$nome.'" required></label><br/>';
					
			echo "<label style=\"width:100%\" >Empresa: <select name=\"obra\" class=\"form-control input-sm\">";
					$obras = mysql_query("select * from notas_obras_cidade WHERE id IN($cidade_usuario) order by nome asc");
					while($l = mysql_fetch_array($obras)) {
						if($l['id']==$obra) { 
							echo '<option value="'.$l['id'].'" selected>'.$l['nome'].'</option>';
						}else{ 
							echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>'; 
							}
					}
			echo '</select></label> ';

			echo '<label style="width:32%">Status: 
					<select name="status2" class="form-control input-sm">';
					if($status == '1') { 
						echo '<option value="1" selected>Inativo</option>
							  <option value="0" >Ativo</option>'; 
					}else{ 
						echo '<option value="0" selected>Ativo</option>
							  <option value="1" >Inativo</option>'; 
					}
			echo '</select></label> ';

		}
	?>
<p align="center" style="margin-top:20px"><input type="submit" value="Salvar" style="width:250px;" class="btn btn-success btn-sm" /></p>
</form>
<hr/>
<h3><small>Historico Equipe</small></h3>
<form action="javascript:void(0)" onSubmit="post(this,'gestor/editar-equipe.php?ac=obs&id=<?php echo $id ?>','.ajax'); " class="form-inline">
		<label><small>Data:</small><br>
			<input type="date" name="data_obs" class="form-control input-sm" />
		</label>
		<label><small>Descrição:</small><br>
			<input type="text" name="descricao_obs" style="width:320px" class="form-control input-sm" />
		</label>
		<input type="submit" class="btn btn-sm btn-success" />
</form>
<div class="resultado-obs"><script>ldy("gestor/editar-equipe.php?ac=consulta&id=<?php echo $id ?>",".resultado-obs")</script> </div>
</div>
<div class="resultado"></div>
<div class="ajax"></div>