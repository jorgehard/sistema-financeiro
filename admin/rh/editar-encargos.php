<?php include("../config.php") ?>
<?php
 
if(@$ac == 'update') {
		
		$query =     mysql_query("UPDATE `rh_encargos` SET `funcionario`='$func',`data`='$data', `sliquido`='$sliquido', `producao`='$producao', `va`='$va',`vr`='$vr',`vt`='$vt',`med`='$med',`enc`='$enc',`obra`='$obra' WHERE id = '$id'");
					
					
		if($query) { echo '<p class="text-success">Informações atualizadas com sucesso!</p>'; }
		else { echo '<p class="text-danger">'.mysql_error().'</p>'; }
		
		exit;
		
} 

?>

<?php $sql = mysql_query("select * from rh_encargos where id = $id"); while($l=mysql_fetch_array($sql)) { extract($l);
		$encargo = (70 / 100) * $sliquido; 
 ?>


<form action="javascript:void(0)" onSubmit="post(this,'rh/editar-encargos.php?ac=update&id=<?php echo $id ?>','.ajax');" class="small" enctype="multipart/form-data">
			<div class="panel panel-default"><div class="panel-heading">Dados do usuário</div><div class="panel-body">


	<div class="col-xs-6 col-sm-4">
	<p>Funcionário: <br/><?php echo mysql_result(mysql_query("select * from rh_funcionarios where id = $funcionario"),0,"nome") ?>
<p>Encarregado: <br/><select class="form-control input-sm" name="enc">
	<option value="0"></option>
	<?php 
				$funcs = mysql_query("select * from rh_funcionarios where enc = 1 and demissao = '0000-00-00' order by nome asc"); while($l=mysql_fetch_array($funcs)) {
					if($func==$l['id']) { echo '<option value="'.$l['id'].'" selected>'.$l['nome'].'</option>'; }
					else { echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>'; }  	
				}
				
	?>	
</option></select>
<p>Obra: <br/><select class="form-control input-sm" name="obra">
	<option value="0"></option>
	<?php 
				$funcs = mysql_query("select * from notas_obras order by descricao asc"); while($l=mysql_fetch_array($funcs)) {
					if($func==$l['id']) { echo '<option value="'.$l['id'].'" selected>'.$l['nome'].'</option>'; }
					else { echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>'; }  	
				}
				
	?>	
</option></select>
	<label>MEDIÇÃO:<input type="text" name="med" value="<?php echo $med ?>" class="form-control input-sm" size="5"></label> 	
	<br><p>Data: <br/><input type="text" name="data" class="form-control input-sm" onfocus="$(this).mask('99/99/9999')" value="<?php echo $data ?>" required></p>
	</div>
	<div class="col-xs-6 col-sm-4">
	<label>Salário Líquido:<input type="text" name="sliquido" value="<?php echo number_format($sliquido,"2",",","."); ?>" class="form-control input-sm" size="5"></label> 
	<label>Encargo:<input type="text" name="encargos" value="<?php echo number_format($encargo,"2",",",".") ?>" class="form-control input-sm" size="5"></label>
	<label>Produção:<input type="text" name="producao" value="<?php echo number_format($producao,"2",",",".") ?>" class="form-control input-sm" size="5"></label>
	<label>Vale Alimentação:<input type="text" name="va" value="<?php echo number_format($va,"2",",",".") ?>" class="form-control input-sm" size="5"></label>
	<label>Vale Refeição:<input type="text" name="vr" value="<?php echo number_format($vr,"2",",",".") ?>" class="form-control input-sm" size="5"></label>
	<label>Vale Transporte:<input type="text" name="vt" value="<?php echo number_format($vt,"2",",",".") ?>" class="form-control input-sm" size="5"></label>
	<input type="submit" class="btn btn-success btn-sm" value="Salvar"/>

	</div>
	
	<div class="col-xs-6 col-sm-4">
	
	</div>


<?php } ?>

</table>

<div class="ajax"></div>
