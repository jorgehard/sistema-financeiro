<?php
	include("../config.php");
	include("../validar_session.php");
	getData();
	getNivel();

	if(@$ac=='listar') {
		echo '<table class="table table-condensed table-bordered table-blue small">';
		echo '<thead><tr><th>Descricao</th><th style="text-align:center">Qtd</th><th style="text-align:center">Vlr UN</th></tr></thead>';
		$sql = mysql_query("SELECT * FROM pedido_compras_itens WHERE id_pedido = '$pedido' ORDER BY id DESC");
		echo '<tbody>';
		while($s = mysql_fetch_array($sql)){
			$id = $s['id'];
			echo '<tr id="itemval'.$id.'">';
				echo '<td>'.mysql_result(mysql_query("SELECT * FROM notas_itens WHERE id = $s[material]"),0,"descricao").'</td>';
				echo '<td>'.number_format($s['qtd'],2,",",".").'</td>';
				echo '<td>'.number_format($s['vlr'],2,",",".").'</td>';
			echo '</tr>';
			
		}
		echo '</tbody></table>';
		exit;
	}
?>
<h4 style="font-family: 'Oswald', sans-serif;letter-spacing:5px;">
	<small>Informações de compra</small>
	<?php
		if($stu != '1'){
			echo '<a href="#" onclick=\'$(".modal").modal("hide"); $(".conteudo").load("almoxarifado/cadastro-compras.php")\' style="width:auto; padding:5px;" class="btn btn-primary btn-xs pull-right"><span class="pull-left glyphicon glyphicon-plus"></span> Adicionar Nova </a>';
		}
	?>
</h4>
	<table class="table table-condensed table-bordered table-blue small">
		<thead>
			<tr>
				<th>Obra:</th>
				<th>Data:</th>
				<th>Equipe:</th>
				<th>Fornecedor</th>
			</tr>
		</thead>
		<tbody>
			<tr>
			<?php
			$detalhes = mysql_query("select * from pedido_compras where id = $pedido");
			while($l = mysql_fetch_array($detalhes)) { 
				echo '<td>'.mysql_result(mysql_query("select * from notas_obras where id = ".$l['obra'].""),0,"descricao").'</td>';
				echo '<td>'.implode("/",array_reverse(explode("-", $l['data']))).'</td>';
				echo '<td>'.mysql_result(mysql_query("select * from equipes where id = ".$l['equipe'].""),0,"nome").'</td>';
				echo '<td>'.mysql_result(mysql_query("select * from notas_empresas where id = ".$l['fornecedor'].""),0,"nome").'</td>';
			}
			?>
			</tr>
		</tbody>
	</table>

<script>ldy("almoxarifado/visu-cadastro-compras.php?ac=listar&pedido=<?php echo $pedido ?>",".resultado22")</script>

<div class="resultado22"></div>