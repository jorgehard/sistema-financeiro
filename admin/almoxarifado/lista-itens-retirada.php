<?php


include("../config.php");
include("../validar_session.php");


if(@$action == 'del') { mysql_query("delete from notas_retirada_itens where id = $id"); echo '<script> $(".conteudo").load("almoxarifado/incluir-itens-retirada.php?retirada='.$retirada.'"); </script>';}

    echo '<span class="label label-default">Itens adicionados</span>';
	echo '
          <div style="height:200px; overflow:auto;">';

	echo '<table class="table table-condensed table-striped table-bordered table-color" style="margin-top:10px">';
		echo '<thead><tr class="small">
                        <th>Material / Item:</th>
                        <th>Quantidade:</th>';
						if($editarss_usuario == '1' || $acesso_login == 'master'){
							echo '<th>Excluir:</th>';
						}
             echo '</tr></thead><tbody>';
		
		$sql = mysql_query("select * from notas_retirada_itens where id_retirada = $retirada order by id desc");
        	while($l = mysql_fetch_array($sql)) { 
				extract($l);
				echo '<tr class="small">';
					echo '<td>'.mysql_result(mysql_query("select * from notas_itens where id = $id_item"),0,"descricao").'</td>';
					echo '<td>'.number_format($quantidade,"2").'</td>';
					if($editarss_usuario == '1'  || $acesso_login == 'master'){
						echo '<td>';
							echo '<button onclick=\'$(".ajax").load("almoxarifado/lista-itens-retirada.php?action=del&id='.$id.'&retirada='.$retirada.'")\' class="btn btn-danger btn-xs">
							<span class="glyphicon glyphicon-trash"></span>
							</button>';
						echo '</td>';
					}
				echo '</tr>';

			}

	echo '</tbody>';
	echo '</table>
	</div>';
	
?>
<p><a href="#" onclick="ldy('almoxarido/cadastro-retirada.php','.conteudo')" class="btn btn-warning btn-xs" id="nconsulta" style="display: none;">Nova consulta</a></p>