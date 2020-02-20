<?php include("../validar_session.php"); ?>
<?php include("../config.php") ?>


<?php 
if(@$ac == 'localizar') { ?>
		<h4><small>CONSULTE E EDITE TODAS AS SUB-ETAPAS</small></h4><hr>
		<table class="table table-striped table-condensed table-bordered small">
		<thead></thead>
		<tr><th></th>
			<th>DESCRIÇÃO</th>
			<th>ETAPA-ASSOCIADA</th>
		</tr>
		</thead><tbody>
        <?php
        
        $i = 1;
        if($tipo==0) { $sql = mysql_query("select * from ss_sub_etapas where associada in (54,55,56,57,58,40,59,60) order by descricao asc"); }
        while($l = mysql_fetch_array($sql)) { extract($l);
		$u = $i++;

				echo '<tr>';
				echo '<td>'.$u.'</td>';
				echo '<td>'.$descricao.'</td>';
				echo '<td>'.@mysql_result(mysql_query("select * from ss_etapas where id = $associada"),0,"descricao").'</td>';
				echo '<center><td><a href="#" onclick=\'ldy("gestor/ss-editar-subetapas.php?id='.$id.'",".retorno")\'><span class="glyphicon glyphicon-pencil"></span></a></td></center>';
				echo '</tr>';

            }
        ?>
		</tbody></table>

<?php } else { ?>


<h3>CONSULTAR OU EDITAR <small>TODAS AS SUB-ETAPAS DAS SS</small></h3> <hr/>

<form action="javascript:void(0)" onsubmit="post(this,'gestor/ss-consulta-subetapas.php?ac=localizar','.retorno')">

	<label><input type="text" name="busca" placeholder="DIGITE ALGO PARA A BUSCA" size="50" class="form-control input-sm"></label>	
                <input type="submit" value="Pesquisar" class="btn btn-success btn-sm">
                <input type="reset" value="Cancelar" class="btn btn-default btn-sm"></td></tr>

</form>

<div class="retorno"></div>

<?php } ?>
