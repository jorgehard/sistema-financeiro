<?php
	include("../config.php");
	include("../validar_session.php");
	include("../../functions/function-print.php");
	getData();
	getNivel();
?>
<style>
	@media print
	{
		table, tr, thead, tbody, td, th{
			border:1px solid #000 !important;
		}
	}
</style>

<script src="../js/combobox-resume.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	//Multi Select
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
	
	// ----------- SORTING MONEY ------------- //
	jQuery.tablesorter.addParser({
		id: "monetaryValue",
		is: function (s) {
			return false;
		}, format: function (s) {
			var n = parseFloat( s.replace('R$','').replace(/,/g,'') );
			return isNaN(n) ? s : n;
		}, type: "numeric"
	});
	// ---------
	$("#resultadoTabela").tablesorter({
		dateFormat : "ddmmyyyy",
		headers: {
			10 : { sorter: "monetaryValue" }
		},
		sortList: [[1,1]]
	});
	$("table").tablesorter({
		dateFormat : "ddmmyyyy"
	});
	//DataTable
	
	$.fn.dataTable.ext.errMode = 'none';
    $('#resultadoTabela').DataTable({
		"paging": false,
		"lengthChange": false,
		"searching": true,
		"ordering": true,
		"info": false,
		"bAutoWidth": false
		
    });
});
</script>

	<script>
	  $(function () {
		$('input').iCheck({
		  checkboxClass: 'icheckbox_square-blue',
		  radioClass: 'iradio_square-blue',
		  increaseArea: '20%' // optional
		});
	  });
	</script>
	
