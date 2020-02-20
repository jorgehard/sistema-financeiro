<h3>Filtro</h3>

<?php if(@$ac=='resultado') {

	  $categoria_equipes = mysql_query("select * from equipes");
	  while($l = mysql_fetch_array($categoria_equipes)) { 

	  $id_equipe = $l['id'];
      echo '<h3>'.$categorias.'</h3>';


      //verifica se há produção nesta data
	  $inicial_en = implode('-',array_reverse(explode("/",$inicial))); $final_en = implode('-',array_reverse(explode("/",$final)));
      $query = mysql_query("select *, SUM(quantidade) as total from producao where equipe = '$id_equipe' and data between '$inicial_en' and '$final_en' group by servico");
      if(mysql_num_rows($query) > 0) {
         
         
         echo '<table border="1" cellpadding="5" width="100%">
                      <tr><th>EQUIPE</th><th>QTDE</th><th>VALOR UNIT.</th><th>TOTAL</th></tr>';
         while($l = mysql_fetch_array($query)) {extract($l);
         
                  $valor_unitario = @mysql_result(mysql_query("select * from servicos_producao where id = $servico"),0,"valor");
                  $total_geral = $total*$valor_unitario;
         
                  echo '<tr>';
                  echo '<td>'.@mysql_result(mysql_query("select * from equipes where id = $equipe"),0,"nome").'</td>';
                  echo '<td>'.$total.'</td>';
                  echo '<td>R$ '.$valor_unitario.'</td>';
                  echo '<td>R$ '; echo number_format($total_geral,"2"); echo '</td>';
                  echo '</tr>';

                  @$total_quantidade += $total;
                  @$total_valor += $total_geral;
         }
         echo '</table>';
         
      }
	  
	  }
	  echo '<h3 align="right">Total quantidade: '.number_format($total_quantidade,"2").' | Total Valor: R$ '.number_format($total_valor,"2").'</h3>';
?>

<?php } else { ?>

<form id="form1" action="javascript:void(0)" onSubmit="post('#form1','producao/filtro-equipes.php?ac=resultado','.resultado')">
      <table>
             <tr><th>Data Inicial</th><th>Data Final</th></tr>
             <tr>
             	 <td><input type="text" size="10" name="inicial" required></td>
                 <td><input type="text" size="10" name="final" required> <input type="submit" value="Filtrar"></td>
             </tr>
      </table>
</form>

<?php } ?>
