<?php
include("../config.php");
include("../validar_session.php");
getData();
?>
<script>
	$(document).ready(function(){
		$(function(){
			$("table").tablesorter();
		});
	});
</script>

<?php
	if(@$ac=='localizar') {
		echo '<table class="table table-min table-bordered table-striped" id="table">
			  <thead>
			  <tr>
				<th>Id</th>	
				<th>Descricão</th>	
				<th>Valor</th>	
				<th>Qtd SS</th>	
				<th>Meta</th>
				<th class="hidden-print"></th>
			  </tr>
			  </thead>
			  <tbody>';
		$sql = mysql_query("select * from metas where descricao like '%$busca%'");
		while($l=mysql_fetch_array($sql)) { extract($l);
			echo '<tr>';
			echo '<td width="30px">'.$id.'</td>';
			echo '<td>'.$descricao.'</td>';
			echo '<td width="60px" style="text-align:center">'.$quantidade.'</td>';
			echo '<td width="60px" style="text-align:center">'.$ss.'</td>';
			echo '<td width="60px" style="text-align:center">'.$valor.'</td>';
			echo '<td class="hidden-print" width="60px" style="text-align:center"><a href="#" class="btn btn-info btn-xs" style="padding:0px 5px 0px 5px; font-weight:bold;" onclick=\'ldy("gestor/editar-meta.php?id='.$id.'",".retorno")\'><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Editar</a></td>';
			echo '</tr>';
		}
		echo '</tbody></table>';
		exit;
	}
?>
<div style="clear: both;">
	<h3 style="font-family: 'Oswald', sans-serif;letter-spacing:5px; margin-bottom;10px;"> 
		<img class="logo-print" src="../imagens/logo.png" style="float:left;" width="60px"/>
		<p>CONSULTA <small>DE METAS DAS EQUIPES</small></p>
	</h3>
</div>
<div style="clear: both;">
	<hr></hr>
</div>
<div class="hidden-print panel panel-default" >
	<div class="panel-heading" style="padding:10px 10px 5px 10px;">
	<a a href="javascript:window.print()" style="letter-spacing:5px; margin-right:10px;" class="hidden-xs hidden-print pull-right btn btn-warning btn-sm"> <span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Imprimir</a>
		<form action="javascript:void(0)" id="form1" onSubmit="post(this,'gestor/consulta-meta.php?ac=localizar','.retorno')" style="margin:0px; padding:0px;">
			<label>
				<input style="width:500px; font-weight:200;" type="text" placeholder="Procurar equipe" name="busca" class="form-control" />
			</label>
			<label>
				<input type="submit" style="margin-left:5px; width:100px; font-weight:bold" value="Buscar" class="btn btn-success btn-sm" />
			</label>
		</form>
	</div>
</div>

<div class="retorno"></div>
