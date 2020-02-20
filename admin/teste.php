<?php 
include("config.php"); 
		
//INVESTIMENTO / DESEPESAS
if(@$ac == 'localizar1') { 
	//$sql = mysql_query("SELECT * FROM ss_itens WHERE item LIKE '16%' and obra = '25' AND status = '0'");
	$sql = mysql_query("SELECT * FROM ss_itens WHERE obra = '28' AND status = '0'");
	while($l = mysql_fetch_array($sql)) { extract($l);
		//mysql_query("UPDATE ss_itens SET `frente`='1' WHERE id = $id");
		echo $item.'<br>';
	}
	exit;
}

//MULTIPLICA ITENS
if(@$ac == 'localizar2') { 
	$sql = mysql_query("SELECT * FROM rh_funcionarios where obra = '7'");
	while($l = mysql_fetch_array($sql)) { extract($l);
		//mysql_query("UPDATE rh_funcionarios SET `obra`='25' WHERE id = $id");
		echo $nome.'<br>';
	}
	exit;
}	

//RH FUNCIONARIOS
if(@$ac == 'localizar3') { 
	$sql = mysql_query("SELECT * FROM rh_funcionarios where tipo_emp = '0'");
	while($l = mysql_fetch_array($sql)) { extract($l);
		//mysql_query("UPDATE rh_funcionarios SET `vale_alimentacao` = '174' WHERE id = '$id'");
		echo $nome.'<br>';
	}
	exit;
}	
?>
<form action="javascript:void(0)" onsubmit="post(this,'teste.php?ac=localizar1','.retorno')" class="form-inline">
	<div class="well well-sm" style="padding:10px 10px 5px 10px;">
		<label><input type="text" name="busca" size="80" class="form-control input-sm"></label>
		<input type="submit" style="margin-left:5px; width:100px;" value="Pesquisar" class="btn btn-success btn-sm" />
	</div>
</form>

<div class="retorno"></div>

