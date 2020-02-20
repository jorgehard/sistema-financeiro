<?php include("../config.php"); ?>


<?php 
if(@$ac == 'ins') {
	$data = implode("-",array_reverse(explode("/",$data)));
	mysql_query("insert into rh_encargos (funcionario,data,sliquido,producao,va,vr,vt,med,enc,obra) 
											 values ('$func','$data','$sliquido','$producao','$va','$vr','$vt','$med','$enc','$obra')");
										
	echo '<p class="text-success">Encargo adicionado com sucesso!</p>';	
} 

else { ?>

<h3>Cadastro <small>de Encargos</small></h3><br>
<form action="javascript:void(0)" onSubmit="post(this,'rh/cadastro-encargos.php?ac=ins','.retorno'); this.reset()" enctype="multipart/form-data" >
	
	<div class="col-xs-6 col-sm-4">
	<p>Funcionário: <br/><select class="form-control input-sm" name="func">
	<option value="0"></option>
	<?php 
				$funcs = mysql_query("select * from rh_funcionarios where categoria = 0 and demissao = '0000-00-00' order by nome asc"); while($l=mysql_fetch_array($funcs)) {
					if($func==$l['id']) { echo '<option value="'.$l['id'].'" selected>'.$l['nome'].'</option>'; }
					else { echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>'; }  	
				}
				
	?>	
</option></select>
<p>Encarregado: <br/><select class="form-control input-sm" name="enc">
	<option value="0"></option>
	<?php 
				$encs = mysql_query("select * from rh_funcionarios where enc = 1 and demissao = '0000-00-00' order by nome asc"); while($l=mysql_fetch_array($encs)) {
					if($enc==$l['id']) { echo '<option value="'.$l['id'].'" selected>'.$l['nome'].'</option>'; }
					else { echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>'; }  	
				}
				
	?>	
</option></select>
<p>Obra: <br/><select class="form-control input-sm" name="obra">
	<option value="0"></option>
	<?php 
				$obras = mysql_query("select * from notas_obras order by descricao asc"); while($l=mysql_fetch_array($obras)) {
					if($obra==$l['id']) { echo '<option value="'.$l['id'].'" selected>'.$l['nome'].'</option>'; }
					else { echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>'; }  	
				}
				
	?>	
</option></select>
	<label>MEDIÇÃO:<input type="text" name="med" value="<?php echo $med ?>" class="form-control input-sm" size="5"></label> 

	<br><p>Data: <br/><input type="text" name="data" class="form-control input-sm" onfocus="$(this).mask('99/99/9999')" required></p>
	</div>
	<div class="col-xs-6 col-sm-4">
	<label>Salário Líquido:<input type="text" name="sliquido" value="<?php echo $sliquido ?>" class="form-control input-sm" size="5"></label> 
	<label>Produção:<input type="text" name="producao" value="<?php echo $producao ?>" class="form-control input-sm" size="5"></label>
	<label>Vale Alimentação:<input type="text" name="va" value="<?php echo $va ?>" class="form-control input-sm" size="5"></label>
	<label>Vale Refeição:<input type="text" name="vr" value="<?php echo $vr ?>" class="form-control input-sm" size="5"></label>
	<label>Vale Transporte:<input type="text" name="vt" value="<?php echo $vt ?>" class="form-control input-sm" size="5"></label>
	<input type="submit" class="btn btn-success btn-sm" value="Salvar"/>

	</div>
	
	<div class="col-xs-6 col-sm-4">
	
	</div>
	
</form>

<div class="retorno"></div>

<?php } ?>
