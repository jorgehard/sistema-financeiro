<?php
include("../config.php");
date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_MONETARY,"pt_BR", "ptb");
$today = getdate(); 

	if($today['mon'] < 10) { 
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
	$inicioMes = $today['year'].'-'.$today['mon'].'-01';
?>
<style type="text/css">
.ui-helper-hidden-accessible { display:none; }
.ui-autocomplete-input { padding: 1px; border-radius:4px; background: #FFF; width:90%; height:30px; -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,0.075); margin-bottom: -3px; } 
ul.ui-autocomplete { border: 1px solid #CCC; background: #FFF; width: 600px; padding: 5px; height: 150px; overflow: auto; z-index: 999999; }
li.ui-menu-item { list-style: none; cursor: pointer; font-size: 12px; border-bottom: 1px solid #CCC; } 
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
</style>
<script>
(function($){$.widget("custom.combobox",{_create:function(){this.wrapper=$("<span>").addClass("custom-combobox").insertAfter(this.element);this.element.hide();this._createAutocomplete();this._createShowAllButton()},_createAutocomplete:function(){var selected=this.element.children(":selected"),value=selected.val()?selected.text():"";this.input=$("<input>").appendTo(this.wrapper).val(value).attr("title","").addClass("custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left").autocomplete({delay:0,
minLength:0,source:$.proxy(this,"_source")}).tooltip({tooltipClass:"ui-state-highlight"});this._on(this.input,{autocompleteselect:function(event,ui){ui.item.option.selected=true;this._trigger("select",event,{item:ui.item.option})},autocompletechange:"_removeIfInvalid"})},_createShowAllButton:function(){var input=this.input,wasOpen=false;$("<a>").attr("tabIndex",-1).attr("title","Mostrar todos os itens").tooltip().appendTo(this.wrapper).button({icons:{primary:"ui-icon-triangle-1-s"},text:false}).removeClass("ui-corner-all").addClass("custom-combobox-toggle ui-corner-right").mousedown(function(){wasOpen=
input.autocomplete("widget").is(":visible")}).click(function(){input.focus();if(wasOpen)return;input.autocomplete("search","")})},_source:function(request,response){var matcher=new RegExp($.ui.autocomplete.escapeRegex(request.term),"i");response(this.element.children("option").map(function(){var text=$(this).text();if(this.value&&(!request.term||matcher.test(text)))return{label:text,value:text,option:this}}))},_removeIfInvalid:function(event,ui){if(ui.item)return;var value=this.input.val(),valueLowerCase=
value.toLowerCase(),valid=false;this.element.children("option").each(function(){if($(this).text().toLowerCase()===valueLowerCase){this.selected=valid=true;return false}});if(valid)return;this.input.val("").attr("title",value+" didn't match any item").tooltip("open");this.element.val("");this._delay(function(){this.input.tooltip("close").attr("title","")},2500);this.input.autocomplete("instance").term=""},_destroy:function(){this.wrapper.remove();this.element.show()}})})(jQuery);$(function(){$(".combobox").combobox()});
</script>
<h3 style="font-family: 'Oswald', sans-serif; letter-spacing:5px; text-align:center"> 
Retirada Polêmica &nbsp; | &nbsp;<small> Após o cadastro, incluir os itens</small>
<a href="#" onclick="ldy('almoxarifado/cadastro-transferencia.php','.conteudo')" style="letter-spacing:5px; margin-top:10px; margin-right:10px;" class="hidden-xs hidden-print btn btn-info btn-sm"> <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>&nbsp;Transferencia</a>
</h3><hr/>

<?php 
if(@$ac == 'ins') {
	$data = implode("-",array_reverse(explode("/",$data)));
	if($obra == '2' || $obra == '4'){
		mysql_query("insert into notas_retirada (obra,funcionario,equipe,data,tipo) values ('$obra','$funcionario','$equipe','$data','3')");
		$retirada = mysql_insert_id();
	}else{
		mysql_query("insert into notas_retirada (obra,funcionario,equipe,data,tipo) values ('$obra','$funcionario','$equipe','$data','1')");
		$retirada = mysql_insert_id();
	}
	
	echo '<script> $(".conteudo").load("almoxarifado/incluir-itens-retirada.php?retirada='.$retirada.'"); </script>';	
} 

else { ?>
<div class="panel panel-default" style="width:50%; margin:0 auto;">
	<div class="panel-heading"><small style="font-family: 'Oswald', sans-serif; font-size:13px">Cadastrar Retirada</small></div>
	<div class="panel-body">		
		<form action="javascript:void(0)" id="form1" onSubmit="post('#form1','almoxarifado/cadastro-retirada.php?ac=ins','.conteudo')" enctype="multipart/form-data">
			<label style="width:100%">Obra:
				<select name="obra" style="width:90%" class="form-control input-sm">
					<?php
						$sql = mysql_query("select * from notas_obras where id in(1,2,3,4)");
						while($l = mysql_fetch_array($sql)) { extract($l);
							echo '<option value="'.$id.'">'.$descricao.'</option>';
						}
					?>				
				</select>
			</label><br/>
			<label style="width:100%">Equipe: <br/>
				<select name="equipe" class="form-control input-sm combobox" required>
					<option value="" selected>Selecione uma Equipe</option>
					<option value="0" >SEM EQUIPE (TRANSFERENCIA)</option>
					<?php
						$sql = mysql_query("select * from equipes where status = 0 and oculto = 1 order by nome asc");
						while($l = mysql_fetch_array($sql)) { extract($l);
							echo '<option value="'.$id.'">'.$nome.'</option>';
						}
					?>				
				</select>
			</label><br/>
			<label style="width:100%" id="funcionarios">Funcionario: <br/>
				<select name="funcionario"class="form-control input-sm combobox" required>
					<option value="">Selecione um funcionario</option>
					<option value="0" >SEM FUNCIONARIO (TRANSFERENCIA)</option>
					<?php
						$sql = mysql_query("select * from rh_funcionarios where demissao = '0000-00-00' and categoria = 0 and id <> 0 order by nome asc");
						while($l = mysql_fetch_array($sql)) { extract($l);
							echo '<option value="'.$id.'">'.$nome.'</option>';
						}
					?>
				</select>
			</label><br/>
			<label style="width:100%">Data:
				<input type="date" name="data" style="width:90%" value="<?php echo $todayTotal; ?>" max="<?php echo $todayTotal; ?>" class="form-control input-sm" size="6" required/>
			</label><br/>
			<label style="width:100%">Tipo:
				<input type="radio" name="tipo_ret" class="form-control input-sm"/>
				<input type="radio" name="tipo_ret" class="form-control input-sm"/>
			</label>
			<label style="text-align:center; width:100%">
				<input type="submit" value="Avançar" style="width:50%; margin-top:10px;" class="btn btn-success btn-sm">
			</label>
		</form>
	</div>
</div>
<div class="retorno"></div>

<?php } ?>
