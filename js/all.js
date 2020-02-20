$( document ).ajaxStart(function() {
	$('#loading').show();
});
$( document ).ajaxStop(function() {
	$('#loading').hide();
});

function ldy(caminho,div) {
	$("#load").fadeIn();
	$.ajax({url:caminho,success:function(result){
		$(div).html(result);
		$("#load").fadeOut();
	}});
}
function post(form,url,retorno) {
	var dados = jQuery( form ).serialize();
	jQuery.post(url,dados,function(data){
		$(retorno).html(data);
		$("#load").fadeOut();
	})
}
function posti(form,urli,retorno) {
	var dados = jQuery( form ).serialize();
	jQuery.ajax({
		type: "POST",
		url: urli,
		data: dados,
		success: function( data )
		{
			$(retorno).html(data);
		}
	});
	return false;
}