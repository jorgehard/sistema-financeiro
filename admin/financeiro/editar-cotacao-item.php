<?php
	include("../config.php");
	include("../validar_session.php");
	getData();

	if(@$ac=='update') {
		$sql_insert = mysql_query("UPDATE `cadastro_cotacao_itens` SET `item`='$item', `qtd`='$qtd', `vlr_fornecedor01`='$vlr_fornecedor01', `vlr_fornecedor02`='$vlr_fornecedor02', `vlr_fornecedor03`='$vlr_fornecedor03' WHERE id = '$id_item'");
        if($sql_insert){
            echo '<span class="text-success">Item atualizado com sucesso!!!</span>';
        }else{
            echo 'Algo aconteceu errado!!!';
        }
		exit;
	}
?>
<style>
	#autoco {
		max-height: 200px;
		overflow: auto;
		position: absolute;
		border-top: 3px solid #333;
		border-bottom: 3px solid #333;
		display: none;
		width: auto;
	}
    
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

$(document).ready(function(){
	$('.sel').multiselect({
		buttonClass: 'form-control input-sm', 
		numberDisplayed: 1,
		buttonWidth: '100%',
		enableFiltering: true,
		enableCaseInsensitiveFiltering: true
	}); 
});
</script>
        <?php
		
                $edit_nota = mysql_query("SELECT *, item as num_item FROM cadastro_cotacao_itens WHERE id = '$id_item'");
                while($l = mysql_fetch_array($edit_nota)) { extract($l); }
        ?>
<div class="row">

<div class="col-xs-12 result"></div>
<form action="javascript:void(0)" onSubmit="post(this,'financeiro/editar-cotacao-item.php?ac=update&id_item=<?php echo $id_item; ?>','.result')" enctype="multipart/form-data">
<div class="col-xs-12">
		<label for="" style="width:100%"><small>Material:</small><br/>
			<select name="item" class="form-control input-sm combobox">
				<?php
				if($tipo_cotacao == '1'){
					$sql_itens = mysql_query("select * from notas_itens WHERE oculto = '2' order by descricao asc");
					while($cot = mysql_fetch_array($sql_itens)) {
						if($num_item == $cot['id']){
							echo '<option value="'.$cot['id'].'" selected>'.$cot['descricao'].'</option>';
						}else{
							echo '<option value="'.$cot['id'].'">'.$cot['descricao'].'</option>';
						}
					}
				}else if($tipo_cotacao == '2'){
					$sql_itens = mysql_query("select * from notas_itens WHERE oculto = '2' order by descricao asc");
					while($cot = mysql_fetch_array($sql_itens)) {
						if($num_item == $cot['id']){
							echo '<option value="'.$cot['id'].'" selected>'.$cot['descricao'].'</option>';
						}else{
							echo '<option value="'.$cot['id'].'">'.$cot['descricao'].'</option>';
						}
					}
				}else if($tipo_cotacao == '3'){
					$sql_itens = mysql_query("select * from notas_itens WHERE oculto = '2' order by descricao asc");
					while($cot = mysql_fetch_array($sql_itens)) {
						if($num_item == $cot['id']){
							echo '<option value="'.$cot['id'].'" selected>'.$cot['descricao'].'</option>';
						}else{
							echo '<option value="'.$cot['id'].'">'.$cot['descricao'].'</option>';
						}
					}
				}
				?>
			</select>
		</label>
	</div>
	<div class="col-xs-12">
		<label for="" style="width:100%"><small>Qtd:</small><br/>
			<input type="number" name="qtd" step="0.01" value="<?php echo $qtd ?>" style="width:100%" class="form-control input-sm" required />
		</label>
	</div>
	<div class="col-xs-12">
		<label for="" style="width:100%"><small>Fornecedor 01:</small><br/>
			<input type="number" style="width:100%" name="vlr_fornecedor01" value="<?php echo $vlr_fornecedor01 ?>" step="0.01" class="form-control input-sm" required>
		</label>
	</div>
	<div class="col-xs-12">
		<label for="" style="width:100%"><small>Fornecedor 02:</small><br/>
			<input type="number" style="width:100%" name="vlr_fornecedor02" value="<?php echo $vlr_fornecedor02 ?>" step="0.01" class="form-control input-sm" required>
		</label>
	</div>
	<div class="col-xs-12">
		<label for="" style="width:100%"><small>Fornecedor 03:</small><br/>
			<input type="number" style="width:100%" name="vlr_fornecedor03" value="<?php echo $vlr_fornecedor03 ?>" step="0.01" class="form-control input-sm" required>
		</label>
	</div>
	<div class="col-xs-12">
		<div class="row" style="text-align:center">
			<br/><br/>
		</div>
		<input type="submit" style="width:150px; margin-left:10px" value="Adicionar" class="btn btn-success btn-sm" />
	</div>
</form>
</div>

