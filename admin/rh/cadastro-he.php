<?php include("../config.php"); ?>

<script type="text/javascript">
$(document).ready(function(){
	$(".decimal").maskMoney({precision:2})

});
</script>

<?php 



if(@$ac == 'inserir') {
	
	
	$hora_extra = str_replace(",",".",$hora_extra);

	foreach ($ids as $key => $id){
		mysql_query("update rh_horaextra set hora_extra = '$hora_extra[$key]' where id = '$ids[$key]'");
	}

	echo '<span class="glyphicon glyphicon-floppy-saved"></span> Salvo';
	exit;
}

if(@$ac == 'listar') {
	
	$q = explode("/",$data);
	
	$mes = $q[0]; 
	$ano = $q[1]; 
	$ultimo_dia = date("t", mktime(0,0,0,$mes,'01',$ano));
	
	for($i=1; $i<=$ultimo_dia; $i++) { $dt = $ano.'-'.$mes.'-'.str_pad($i,2,"0",STR_PAD_LEFT); if(mysql_num_rows(mysql_query("select * from rh_horaextra where data = '$dt' and funcionario = '$funcionario'"))==0) { mysql_query("insert into rh_horaextra (funcionario,data) values ('$funcionario','$dt')"); } }
	
	echo '<form action="javascript:void(0)" onSubmit=\'post(this,"rh/cadastro-he.php?ac=inserir&funcionario='.$funcionario.'",".ajax")\'>';
	$sql = mysql_query("select * from rh_horaextra where funcionario = '$funcionario' and MONTH(data) = '$mes' and YEAR(data) = '$ano' order by data asc");
	while($l = mysql_fetch_array($sql)) { extract($l);
		
		echo '<div class="col-xs-6 col-sm-3">';
		echo '<span class="label label-default"><input type="hidden" name="ids[]" value="'.$id.'" />'.implode("/",array_reverse(explode("-",$data))).'</span>';
		echo '<label><label for=""><input type="text" class="form-control input-sm decimal" size="5" value="'.$hora_extra.'" name="hora_extra[]"></label></span>';
		echo '</div>';
		
	}
	echo '<input type="submit" value="Salvar" class="btn btn-success btn-sm" />';
	echo '</form><span class="ajax"></span>';
		
	exit;	
} 

?>

<h3>Cadastro <small>Hora extra</small></h3><hr/>
<form action="javascript:void(0)" onSubmit="post(this,'rh/cadastro-he.php?ac=listar','.retorno');" enctype="multipart/form-data" >
	
	<label>Selecione o funcionário: <select name="funcionario" class="form-control input-sm">
	<option></option>
			<?php
				$funcs = mysql_query("select * from rh_funcionarios where categoria <> '1' and demissao = '0000-00-00' order by nome asc");
				while($l = mysql_fetch_array($funcs)) { extract($l);
					echo '<option value="'.$id.'">'.$nome.'</option>';
				}
			?>
	</select></label>
	<label for="">Mes referente:<input type="text" name="data" onfocus="$(this).mask('99/9999')" size="10" class="form-control input-sm" /></label>
	<input type="submit" class="btn btn-success btn-sm" value="Adicionar" />
	
</form>

<div class="retorno"></div>

