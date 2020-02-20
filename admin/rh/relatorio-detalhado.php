<style>
	@media print {
		#cinza { background-color: #CCC; }
		table { font-size: 9px; }	
	}
	
</style>

<?php
include("../config.php"); 

	if(@$ac=='associar') {
		
		
		if(@$ac=='editar-assoc') {
			
		echo '<form action="javascript:void(0)" onSubmit=\'post(this,"rh/relatorio-detalhado.php?ac=associar&op=inserir",".modal-body")\' class="form-horizontal">';		
		echo '<label>Equipe E: <select name="equipe" class="form-control input-sm">'; 
					$e = mysql_query("select * from equipes where status = 0 order by nome asc");
					while($l=mysql_fetch_array($e)) { echo '<option value="'.$l["id"].'">'.$l['nome'].'</option>'; } 
		echo '</select></label>';		
		echo '<label>Encarregado: <select name="enc" class="form-control input-sm">'; 
					$en = mysql_query("select * from rh_funcionarios where enc = 1");
					while($l=mysql_fetch_array($en)) { echo '<option value="'.$l["id"].'">'.$l['nome'].'</option>'; } 
		echo '</select></label><br/>';
		echo '<label><input type="submit" value="Salvar" class="btn btn-success" /></label>';	
		echo '</form>';
		
		exit;
			
		}
		
		//POP UPS associar 
		
		if(@$op=='inserir') { 
			$insert = mysql_query("insert into func_equipes (equipe,funcionario,data,enc) values ('$equipe','$funcionario','$data','$enc')");
			if($insert) { echo '<script>$("#af").modal("hide"); $("#botao'.$funcionario.'").html("<button class=\'btn btn-success btn-xs\'>Associado</button>")</script>'; } }
		
		echo '<form action="javascript:void(0)" onSubmit=\'post(this,"rh/relatorio-detalhado.php?ac=associar&op=inserir",".modal-body")\' class="form-horizontal">';
		
		echo '<input type="hidden" value="'.$funcionario.'" name="funcionario" /><input type="hidden" value="'.$data.'" name="data" />';
		echo '<label>Equipe: <select name="equipe" class="form-control input-sm">'; 
					$e = mysql_query("select * from equipes where status = 0 and oculto = 1 order by nome asc");
					while($l=mysql_fetch_array($e)) { echo '<option value="'.$l["id"].'">'.$l['nome'].'</option>'; } 
		echo '</select></label>';		
		echo '<label>Encarregado: <select name="enc" class="form-control input-sm">'; 
					$en = mysql_query("select * from rh_funcionarios where enc = 1");
					while($l=mysql_fetch_array($en)) { echo '<option value="'.$l["id"].'">'.$l['nome'].'</option>'; } 
		echo '</select></label><br/>';
	
	// Botao do Pop ups associar 
	echo '<label><input type="submit" value="Salvar" class="btn btn-success" /></label>';	
		echo '</form>';
		
		exit;
	}

if(@$ac=='resultado') {

	$inicial = '01/'.$inicial; 
    echo '<h3>Relação de Funcionários</h3>';
	
	$cats = mysql_query("select *, func_equipes.enc as id_enc from rh_funcionarios, func_equipes, equipes where rh_funcionarios.enc = 1 and func_equipes.enc = rh_funcionarios.id and func_equipes.equipe = equipes.id group by func_equipes.enc order by equipes.nome asc");
    while($l = mysql_fetch_array($cats)) { $id = $l['id_enc']; 
	
	$item = @$it3+1;
	echo '<table width="100%" class="table table-condensed table-bordered table-hover small">';
	echo '<tr class="small">
						<th></th>
                        <th>Funcionário: </th>
						<th>Obra: </th>
						<th>Admissssão: </th>';
    echo '</tr>';
	
		
	
		$sql2 = mysql_query("select *, nome as nome_func, equipe as equipe_func from rh_funcionarios where encarregado = $id and enc = 1 order by enc desc");
        while($l = mysql_fetch_array($sql2)) { 
		
		$nome_equipe = @mysql_result(mysql_query("select * from equipes where id = ".$l['equipe_func'].""),0,"nome"); 
		$id_funcionario = @mysql_result(mysql_query("select * from rh_funcionarios where id = ".$l['id'].""),0,"id"); 
		$emp = @mysql_result(mysql_query("select * from rh_funcionarios where id = ".$l['id'].""),0,"emp"); 
		
		if($emp==0) { $it = $item++; } else { $it = $item-1; }			
				if($l['enc']==1) { echo '<tr class="small success">'; } else { echo '<tr class="small">'; }
				echo '<td>'.$it.'</td>';
				//echo '<td></td>';
				echo '<td>'.$l['nome_func'].'</td>';
			//	echo '<td></td>';
					
					$categs = mysql_query("SELECT * FROM `notas_cat_e` order by descricao asc");
					while($l = mysql_fetch_array($categs)) { 
					/*	echo '<td>';
							$itens_func = mysql_query("SELECT * FROM `notas_equipamentos` WHERE local = $id_funcionario and categoria = ".$l['id']."");
							while($l = mysql_fetch_array($itens_func)) {
								echo ''.$l['placa'].' '.$l['descricao'].'<br/>';
							}	*/	
						echo '</td>';
					}
				
				echo '</tr>'; 
				
		} 
		
	$it2 = $it+1;
	$inicial = @implode("-",array_reverse(explode("/",$inicial))); $final = @implode("-",array_reverse(explode("/",$final)));
	$sql = mysql_query("select *, equipes.categoria as id_meta from func_equipes, equipes, metas where equipes.categoria = metas.id and func_equipes.equipe = equipes.id and func_equipes.data = '$inicial' and func_equipes.enc = $id and func_equipes.funcionario <> $id_funcionario group by equipes.categoria order by metas.descricao asc");
    while($l = mysql_fetch_array($sql)) { $id_meta = $l['id_meta']; 
    
     $nome_meta = @mysql_result(mysql_query("select * from metas where id = $id_meta"),0,"descricao");

		echo '<tr class="info small"><td colspan="3">'.$nome_meta.'</td></tr>';
		
		$sql3 = mysql_query("select *, func_equipes.equipe as equipe_func, func_equipes.funcionario as id_func, equipes.id as id_e from func_equipes, equipes where func_equipes.equipe = equipes.id and func_equipes.data = '$inicial' and func_equipes.enc = $id and 
							 equipes.categoria = $id_meta group by equipes.id order by equipes.nome asc");
							 
        while($l = mysql_fetch_array($sql3)) { $id_e = @$l['id_e'];
		
		
		//relaciona funcionarios da equipe
		$order_equip = 1;
		$sql4 = mysql_query("select *, func_equipes.equipe as equipe_func, func_equipes.funcionario as id_func, func_equipes.id as id_f from func_equipes, 
							 equipes, rh_funcionarios where func_equipes.equipe = equipes.id and rh_funcionarios.id = func_equipes.funcionario and func_equipes.data = '$inicial' and func_equipes.enc = $id and 
							 equipes.id = $id_e order by rh_funcionarios.lider desc, rh_funcionarios.nome asc");
							 
        while($l = mysql_fetch_array($sql4)) {
        	
		$nome_equipe = @mysql_result(mysql_query("select * from equipes where id = ".$l['equipe_func'].""),0,"nome"); 
		$nome_funcionario = @mysql_result(mysql_query("select * from rh_funcionarios where id = ".$l['id_func'].""),0,"nome"); 
		$obra = @mysql_result(mysql_query("select * from rh_funcionarios where id = ".$l['id_func'].""),0,"obra"); 
		$obrasem = @mysql_result(mysql_query("select * from notas_obras where id = $obra"),0,"obra");

		$id_funcionario = @mysql_result(mysql_query("select * from rh_funcionarios where id = ".$l['id_func'].""),0,"id"); 
		$emp = @mysql_result(mysql_query("select * from rh_funcionarios where id = ".$l['id_func'].""),0,"emp"); 
		$id_f = $l['id_f'];
		
		if($emp==0) { $it3 = $it2++; } else { $it3 = $it2-1; }		
		$oe = $order_equip++;
			
				if(mysql_result(mysql_query("select * from rh_funcionarios where id = $id_funcionario"),0,"lider")==1) { echo '<tr class="small active">'; } else { echo '<tr class="small">'; }
				echo '<td><center>'.$it3.'</center></td>';
				//echo '<td>'.substr($nome_equipe,0,6).''.str_pad($oe, 2, "0", STR_PAD_LEFT).'</td>';
				echo '<td nowrap="nowrap" width="400px"><a href="#" onclick=\'$("#editar-assoc").modal("show"); $(".modal-body").load("rh/relatorio-detalhado.php?ac=editar-assoc&id='.$id.'")\'>
					  <span class="glyphicon glyphicon-edit"></span></a> '.$nome_funcionario.'</td>';
				 echo '<td>';

					if($obrasem < 2) { echo '<center><span class="label label-success">GUARUJÁ</center></span>'; }
						else { echo '<center><span class="label label-danger">BERTIOGA</center></span>'; } 
					echo '</td>';
				echo '<td>'.implode("/",array_reverse(explode("-",$l['admissao']))).'</td>';
				
					$categs = mysql_query("SELECT * FROM `notas_cat_e` order by descricao asc");
					while($l = mysql_fetch_array($categs)) {
						
						
						
						// Quadradinhos amais --'
						// echo '<td>';
					/*	$itens_func = mysql_query("SELECT * FROM `notas_equipamentos` WHERE local = $id_funcionario and categoria = ".$l['id']." and situacao <> 3");
						if(mysql_num_rows($itens_func) > 0) {
						echo '<div class="dropdown">
  									<a data-toggle="dropdown" href="#">'.mysql_num_rows($itens_func).' <span class="caret"></span></a>
  									<ul class="dropdown-menu" role="menu">';
  										
							while($l = mysql_fetch_array($itens_func)) {
								
								//echo '<li><a href="#">Action</a>';
								echo '<li><a href="#" data-toggle="popover" title="Info" data-content="'.$l['marca'].' - '.$l['descricao'].'" onmouseover=\'$(this).popover("show")\' onmouseout=\'$(this).popover("hide")\'>'.$l['placa'].'</a></li>';
							}		
						echo '</ul></div>'; } */
						
						echo '</td>';	
					}
				
				echo '</tr>';
				
		}
		

		
		}
		

	}
	
	

			
			echo '<br><tr><td colspan="3" class="primary">Funcionários não associdados</td></tr>';
			$sem_equipe = mysql_query("select * from rh_funcionarios where demissao = '0000-00-00' and admissao <> '0000-00-00' and categoria = '0' and enc = '0' order by nome asc");
			while($l = mysql_fetch_array($sem_equipe)) { extract($l);
			if(mysql_num_rows(mysql_query("select * from func_equipes where funcionario = '$id' and data = '$inicial'"))==0) { 
			@$se = 1+@$it3++;
			
					echo '<tr class="small">';
					echo '<td>'.$se.'</td>';
					//echo '<td></td>';
					echo '<td>'.$nome.'</td>';
					echo '<td>';
					$obrasem3 = @mysql_result(mysql_query("select * from notas_obras where id = $obra"),0,"cidade");

					if($obrasem3 < 2) { echo '<center><span class="label label-success">GUARUJÁ</center></span>'; }
						else { echo '<center><span class="label label-danger">BERTIOGA</center></span>'; } 
					echo '</td>';
					echo '<td>'.implode("/",array_reverse(explode("-",$admissao))).'</td>';
					echo '<td id="botao'.$id.'"><a href="javascript:void(0)" onclick=\'$("#af").modal("show");$(".modal-body").load("rh/relatorio-detalhado.php?ac=associar&funcionario='.$id.'&data='.$inicial.'")\'><span class="glyphicon glyphicon-plus"></span></a></td>';
					echo '</tr>'; 
					
			}
		}
	
	
	echo '</table>';
}  

else { ?>
	
	<form action="javascript:void(0)" onSubmit="post(this,'rh/relatorio-detalhado.php?ac=resultado','.retorno')">
		<label for="">Mês referente: <input type="text" class="form-control input-sm" onfocus="$(this).mask('99/9999')" name="inicial" /></label>
		<label for=""><input type="submit" class="btn btn-success btn-sm" value="Filtrar" /></label>	
	</form>
	
	<div class="retorno"></div>
	
<?php }	?>

<script>
$(document).ready(function() {
	$('.popover').popover({
  		trigger: 'focus'
	})
})
</script>

<div class="modal fade" id="af">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Associar funcionário</h4>
      </div>
      <div class="modal-body">
        <p>One fine body&hellip;</p>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="editar-assoc">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Editar associação</h4>
      </div>
      <div class="modal-body">
        <p>One fine body&hellip;</p>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

