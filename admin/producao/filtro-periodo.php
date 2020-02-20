<?php include("header.php") ?>
<div class="conteudo">

<h1>Filtro</h1>

<form method="post">
      <input type="hidden" name="data" value="<?php echo $data; ?>">
      <table>
             <tr><th>Data Inicial</th><th>Data Final</th></tr>
             <tr>
                 <td><input type="date" size="10" name="inicial" value="<?php echo $inicial ?>" required></td>
                 <td><input type="date" size="10" name="final" value="<?php echo $final ?>" required> <input type="submit" value="Filtrar"></td>
             </tr>
      </table>
</form>

<?php if($_POST) {

      //verifica se há produção nesta data
      $query = mysql_query("select * from servicos_producao");
      if(mysql_num_rows($query) > 0) {
         echo '<h3>Resumo</h3>';
         
         echo '<table border="1" cellpadding="5" width="100%">
                      <tr><th>ITEM</th><th>DESCRICAO</th>';
                      
                      $equipes = mysql_query("select * from equipes order by nome asc");
                      while($l = mysql_fetch_array($equipes)) {
                               echo '<th>'.$l['nome'].'</th>';
                               $id_equipe = $l['id'];
                      }
                      

         echo '<th>TOTAL</th></tr>';
         while($l = mysql_fetch_array($query)) {
         
                  $id_servico = $l['id'];
                  $valor_servico = $l['valor'];
                  
                  echo '<tr>';
                  echo '<td>'.$l['item'].'</td>';
                  echo '<td>'.$l['descricao'].'</td>';
                  
                      $equipes = mysql_query("select * from equipes order by nome asc");
                      while($l = mysql_fetch_array($equipes)) {
                               $id_equipe = $l['id'];
                               
                       $producao = mysql_query("select *, sum(quantidade) as total_quantidade from producao where servico = $id_servico and equipe = $id_equipe");
                       while($l = mysql_fetch_array($producao)) { extract($l);

                               $total_geral = $total_quantidade*$valor_servico;
                               echo '<td>R$ '.number_format($total_geral,"2").'</td>';

                       }
                       


                       }

                  echo '<td>'.mysql_result(mysql_query("select *, sum(quantidade*valor) as total_quantidade from producao, servicos_producao where servicos_producao.id = producao.servico and producao.servico = $id_servico"),0,"total_quantidade").'</td>';
                  echo '</tr>';


         }
         echo '</table>';

      }
?>

<?php } ?>

</div>
</body>
</html>
