<?php include("../config.php") ?>


<?php 
if(@$ac == 'localizar') { ?>
<div id="noprint">

		<h4>Resultado da Busca <small> para encargos</small></h4><hr>
		<table class="table table-striped table-condensed table-bordered small">
		<thead></thead>
		<tr><th></th>
			<th>Nome</th>
			<th>Data pesquisada</th>
			<th>Constular</th>	
			<th>Editar</th>
			<th></th>
		</tr>
		</thead><tbody>
        <?php
      
        $i = 1;
        $sql = mysql_query("select * from rh_encargos where med like '%$busca%' and enc like '%$enc%' and  (data between '$inicial' and '$final')");
        while($l = mysql_fetch_array($sql)) { extract($l);
		$u = $i++;

				echo '<tr>';
				echo '<td>'.$u.'</td>';
				echo '<td>'.@mysql_result(mysql_query("select * from rh_funcionarios where id = $funcionario"),0,"nome").'</td>';
				echo '<td>'.$l['data'].'</td>';
				echo '<td nowrap="nowrap">';
            		$id_usuario_logado = $_SESSION['id_usuario_logado'];
            		$acesso_login = mysql_result(mysql_query("select * from usuarios where id = $id_usuario_logado"),0,"acesso");
            		if($acesso_login=='master') { 
            		echo '<a href="#" onclick=\'ldy("rh/relatorio-encargos.php?id='.$id.'",".retorno")\'><span class="glyphicon glyphicon-search"></span></a></td>';  }       		
					echo'<td><a href="#" onclick=\'ldy("rh/editar-encargos.php?id='.$id.'",".retorno")\'><span class="glyphicon glyphicon-pencil"></span></a></td>';            		
				echo '</tr>';
}
            
        ?>
		</tbody></table>

<?php } else { ?>


<h3>Consulta <small>de Encargos de Funcionários</small></h3> <hr/>

<form action="javascript:void(0)" onsubmit="post(this,'rh/consulta-encargos.php?ac=localizar','.retorno')">

	<label><input type="text" name="busca" placeholder="Digite algo para a busca" size="5" class="form-control input-sm"></label>
	<label for=""><input type="date" name="inicial" class="form-control input-sm" size="10" placeholder="Inicial" /></label>
	<label for=""><input type="date" name="final" class="form-control input-sm" size="10" placeholder="Final" size="8" /></label>
				
                <input type="submit" value="Pesquisar" class="btn btn-success btn-sm">
                <input type="reset" value="Cancelar" class="btn btn-default btn-sm"></td></tr>

</form>

<div class="retorno"></div>
<div class="resultado" id="print"></div>

<?php } ?>
