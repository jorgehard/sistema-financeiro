<?php include("../config.php") ?>
<style>
	@media print {
    .footer {page-break-after: always;}
    #none { display:  none;}
</style>


<script>
  $(document).ready(function() {
    $("#btnPrint").printPage();
  });
</script>


<?php if(@$ac=='resultado') {




      $total_m = 0;

      //verifica se há produção nesta data
	  $inicial_en = implode('-',array_reverse(explode("/",$inicial))); $final_en = implode('-',array_reverse(explode("/",$final)));

      echo '<p align="right" id="none"><a href="producao/impressao-resumido-equipes.php?inicial_en='.$inicial_en.'&final_en='.$final_en.'" class="btn btn-warning btn-xs" id="btnPrint">Imprimir</a></p>';
      echo '<div id="toPrint">';


      //frentes
      $frentes = mysql_query("select * from frentes");
      while($l = mysql_fetch_array($frentes)) { $id_frentes = $l['id'];

      $_valortotal = 0;
      $total_m = 0;
      $total_s = 0;

      echo '<h3>'.$l['descricao'].'</h3>';



      //metas
      $metas = mysql_query("select * from metas order by ordem asc");
      while($l = mysql_fetch_array($metas)) { $id_frente = $l['id'];
      $query = mysql_query("select *, SUM(producao.quantidade) as total_quantidade, SUM(producao.valor) as total_valor from producao, equipes where equipes.id = producao.equipe and equipes.categoria = $id_frente and producao.frente = $id_frentes and data between '$inicial_en' and '$final_en' group by equipe order by equipes.nome asc");
      if(mysql_num_rows($query) > 0) {

      $_valor = 0;
	  $_meta_valor = 0;
      $_saldo_total = 0;

         
         echo '<h5>'.$l['descricao'].'</h5>';
         echo '<table class="table table-bordered table-condensed small">
             <tr class="small active">
             <th>EQUIPE</th>
             <th align="center">QTD</th>
             <th align="center">MT</th>
             <th align="center">SALDO</th>
             <th align="center">VALOR</th>
             <th align="center">META</th>
             <th align="center">SALDO</th></tr>';

         while($l = mysql_fetch_array($query)) {extract($l);

         $categoria_equipe = mysql_result(mysql_query("select * from equipes where id = '$equipe'"),0,"categoria");

         $meta_quantidade = mysql_result(mysql_query("select * from metas where id = '$categoria_equipe'"),0,"quantidade");
         $saldo_quantidade = $total_quantidade-$meta_quantidade;

         if($saldo_quantidade < 0) { $saldo_quantidade = '<font color="#FF0000"><b>'.$saldo_quantidade.'</b></font>'; } else { $saldo_quantidade = '<font color="#000">'.$saldo_quantidade.'</font>'; }

         $sep_data = explode("-",$inicial_en);  $mes_atual = $sep_data[2]+1;
         $ultimo_dia = date('d', mktime(0, 0, 0, $mes_atual, 0, $sep_data[0] ));
         
         $meta_valor = mysql_result(mysql_query("select * from metas where id = '$categoria_equipe'"),0,"valor");
         $meta_valor_diario = $meta_valor/$ultimo_dia;
         $meta_atual = date('d')*$meta_valor_diario;
         
         $saldo_valor = $total_valor-$meta_valor;
         
         if($saldo_valor < 0) { $saldo_v = '<font color="#FF0000"><b>R$ '.number_format($saldo_valor,"2",",",".").'</b></font>'; } else { $saldo_v = '<font color="#000">R$ '.number_format($saldo_valor,"2",",",".").'</font>'; }

         echo '<tr class="small">';
              echo '<td width="300px">'.mysql_result(mysql_query("select * from equipes where id = $equipe"),0,"nome").'</td>';
              echo '<td width="40px" align="center">'.$total_quantidade.'</td>';
              echo '<td width="20px" align="center">'.$meta_quantidade.'</td>';
              echo '<td width="20px" align="center">'.$saldo_quantidade.'</td>';
              echo '<td width="80px" align="center">R$ '.number_format($total_valor,"2",",",".").'</td>';
              echo '<td width="80px" align="center">R$ '.number_format($meta_valor,"2",",",".").'</td>';
              echo '<td width="120px" align="center">'.$saldo_v.'</td>';
         echo '</tr>';

         //$_valor = number_format(mysql_result(mysql_query("select *, SUM(valor) as total_valor from producao, equipes where equipes.id = producao.equipe and equipes.categoria = $id_frente and data between '$inicial_en' and '$final_en'"),0,"total_valor"),"2",",",".");

	     $_valor += $total_valor;
         $_meta_valor += $meta_valor;
         $_saldo_total += $saldo_valor;
         /*
         
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

         echo '</table>';
         
         */
         
         
         }
         
         echo '<tr class="small active">
                   <td colspan="4">TOTAL</td>
                   <td align="center">R$ '.@number_format($_valor,"2",",",".").'</td>
                   <td align="center">R$ '.number_format(@$_meta_valor,"2",",",".").'</td>
                   <td align="center">R$ '.number_format(@$_saldo_total,"2",",",".").'</td>
              </tr>';
         echo '</table>';
         
      @$total_m += @$_meta_valor;
      @$total_s += @$_saldo_total;
      @$_valortotal += $_valor;
      }
      


?>

<?php

}


      echo '<table class="table table-condensed"><tr class="small info">';
      echo '<td colspan="4" style="width:390px">TOTAL FRENTE</td>';
      //$_valortotal = number_format(mysql_result(mysql_query("select *, SUM(valor) as total_valor from producao, equipes where equipes.id = producao.equipe and data between '$inicial_en' and '$final_en'"),0,"total_valor"),"2",",",".");
      echo '<td>R$ '.number_format($_valortotal,"2",",",".").'</td>';
      echo '<td>R$ '.number_format($total_m,"2",",",".").'</td>';
      echo '<td>R$ '.number_format($total_s,"2",",",".").'</td>';
      echo '</tr></table>';

      @$tv += $_valortotal;
      @$tm += $total_m;
      @$ts += $total_s;

	  echo '<div class="footer"></div>';
}

      echo '<table class="table table-bordered"><tr class="warning">';
      echo '<td colspan="4" width="390px">TOTAL GERAL</td>';
      //$_valortotal = number_format(mysql_result(mysql_query("select *, SUM(valor) as total_valor from producao, equipes where equipes.id = producao.equipe and data between '$inicial_en' and '$final_en'"),0,"total_valor"),"2",",",".");
      echo '<td>R$ '.number_format($tv,"2",",",".").'</td>';
      echo '<td>R$ '.number_format($tm,"2",",",".").'</td>';
      echo '<td>R$ '.number_format($ts,"2",",",".").'</td>';
      echo '</tr></table></div>';

} else {
?>

<h3 id="none">Filtro</h3>

<form id="none" action="javascript:void(0)" onSubmit="post(this,'producao/filtro-resumido-equipes.php?ac=resultado','.resultado')">
      <input type="hidden" name="data" value="<?php echo $data; ?>">
	  <label for=""><input type="text" size="10" name="inicial" value="<?php echo @$inicial ?>" class="form-control input-sm" onFocus="$(this).mask('99/99/9999')" required></label>
      <label for=""><input type="text" size="10" name="final" value="<?php echo @$final ?>" class="form-control input-sm" onFocus="$(this).mask('99/99/9999')" required></label> 
      <label for=""><input type="submit" class="btn btn-success btn-sm" value="Filtrar"></label>
</form>

<div class="resultado"></div>


<?php } ?>

