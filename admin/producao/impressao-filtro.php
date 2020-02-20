<?php include("../config.php"); ?>

<style>
* { font-family: Arial; }
table { border-collapse: collapse; }
table tr td, th { font-size: 8px; }
</style>

<?php

      extract($_GET);
     //frentes
      $frentes_e = mysql_query("select * from frentes");
      while($l = mysql_fetch_array($frentes_e)) { $id_frentes = $l['id'];

      echo '<div style="page-break-before: always;"><h3>'.$l['descricao'].'</h3>';

      $equipes = mysql_query("select *, equipes.id as idequipe from equipes, producao where equipes.id = producao.equipe and producao.frente = '$id_frentes' group by equipes.nome");
      while($l = mysql_fetch_array($equipes)) { $id_equipe = $l['idequipe'];

      $total_quantidade = 0;
      $total_valor = 0;

      $query = mysql_query("select *, SUM(quantidade) as total from producao where equipe = '$id_equipe' and frente = '$id_frentes' and data between '$inicial_en' and '$final_en' group by servico");
      if(mysql_num_rows($query) > 0) {

         echo '<table border="1" cellpadding="2" width="100%">
              <tr><th colspan="6" align="left">'.mysql_result(mysql_query("select * from equipes where id = $id_equipe"),0,"nome").'</th></tr>
              <tr><th>ITEM</th><th align="left">DESCRICAO</th><th>UNID</th><th>QTDE</th><th>VALOR UNIT.</th><th>TOTAL</th></tr>';
         while($l = mysql_fetch_array($query)) {extract($l);

                  $valor_unitario = mysql_result(mysql_query("select * from sp where id = $servico"),0,"valor");
                  $total_geral = $total*$valor_unitario;

                  echo '<tr>';
                  echo '<td width="30px" align="center">'.mysql_result(mysql_query("select * from sp where id = $servico"),0,"item").'</td>';
                  echo '<td width="500px">'.mysql_result(mysql_query("select * from sp where id = $servico"),0,"descricao").'</td>';
                  echo '<td width="20px" align="center">UN</td>';
                  echo '<td width="50px" align="center">'.$total.'</td>';
                  echo '<td width="70px" align="center">R$ '.$valor_unitario.'</td>';
                  echo '<td width="70px" align="center">R$ '; echo number_format($total_geral,"2"); echo '</td>';
                  echo '</tr>';

                  @$total_quantidade += $total;
                  @$total_valor += $total_geral;
         }
         echo '<tr><th colspan="6" align="right">Total Valor: R$ '.number_format($total_valor,"2").'</th></tr>';
         echo '</table><br>';
      } }

      echo '</div>';
?>

<?php }  ?>


</div>

