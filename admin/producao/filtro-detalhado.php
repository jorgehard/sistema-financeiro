<?php include("header.php") ?>
<div class="conteudo">

<h1>Filtro</h1>

<form method="post">
      <input type="hidden" name="data" value="<?php echo $data; ?>">
      <table>
             <tr><th>Equipe</th><th>Data Inicial</th><th>Data Final</th></tr>
             <tr>
                 <td><select size="1" name="equipe">
                 <option value=""></option>
                 <?php
                      $equipes = mysql_query("select * from equipes order by nome asc");
                      while($l = mysql_fetch_array($equipes)) { extract($l);
                               echo '<option value="'.$id.'">'.$nome.'</option>';
                      }
                 ?>
                 </select></td>
                 <td><input type="text" size="10" name="inicial" value="<?php echo @$inicial ?>" class="campoData" required></td>
                 <td><input type="text" size="10" name="final" value="<?php echo @$final ?>" class="campoData" required> <input type="submit" value="Filtrar"></td>
             </tr>
      </table>
</form>

<?php if($_POST) {

      //verifica se há produção nesta data
	  $inicial_en = implode('-',array_reverse(explode("/",$inicial))); $final_en = implode('-',array_reverse(explode("/",$final)));
      $query = mysql_query("select *, SUM(quantidade) as total from producao where data between '$inicial_en' and '$final_en' and equipe like '%$equipe%' group by servico");
      if(mysql_num_rows($query) > 0) {
         echo '<h3>Resumo</h3>';
         
         echo '<table border="1" cellpadding="5">
         <tr><td>NOME DA EQUIPE: </td><td>'.mysql_result(mysql_query("select * from equipes where id = $equipe"),0,"nome").'</td></tr>
         <tr><td>PERIDO: </td><td>De '.$inicial.' à '.$final.'</td></tr>
         </table><BR><BR>';
         
         echo '<table border="1" cellpadding="5" width="100%">
                      <tr><th>ITEM</th><th>DESCRICAO</th><th>UNID</th><th>QTDE</th><th>VALOR UNIT.</th><th>TOTAL</th></tr>';
         while($l = mysql_fetch_array($query)) {extract($l);
         
                  $valor_unitario = mysql_result(mysql_query("select * from sp where id = $servico"),0,"valor");
                  $total_geral = $total*$valor_unitario;
         
                  echo '<tr>';
                  echo '<td>'.mysql_result(mysql_query("select * from sp where id = $servico"),0,"item").'</td>';
                  echo '<td>'.mysql_result(mysql_query("select * from sp where id = $servico"),0,"descricao").'</td>';
                  echo '<td>UN</td>';
                  echo '<td>'.$total.'</td>';
                  echo '<td>R$ '.$valor_unitario.'</td>';
                  echo '<td>R$ '; echo number_format($total_geral,"2"); echo '</td>';
                  echo '</tr>';

                  @$total_quantidade += $total;
                  @$total_valor += $total_geral;
         }
         echo '</table>';
         echo '<h3 align="right">Total quantidade: '.number_format($total_quantidade,"2").' | Total Valor: R$ '.number_format($total_valor,"2").'</h3>';
      }
?>

<?php } ?>

</div>
<?php include('footer.php') ?>
