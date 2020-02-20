<?php include("../config.php") ?>
<meta http-equiv='Content-Type' content='text/html; utf-8' />
<link rel='stylesheet' type='text/css' href='../../css/bootstrap.css' />



<style>

table tr th, td { font-size: 11px; }

</style>

<table width="100%" class="table table-condensed" align="center" cellpadding="10">
	    <tr>
        	<td><img src="http://polemicalitoral.com.br/guaruja/imagens/logo.png" width="60px"></td>
            <td colspan="4"><h3>Relatório Nota Fiscal</h3></td>
        </tr>

	    <tr class="small"><th>Obra:</th><th>Empresa:</th><th>Nota Fiscal:</th><th>Recebimento:</th><th>Vencimento:</th></tr>

        <?php
        $sql = mysql_query("select * from notas_nf where id = $id");
                while($l = mysql_fetch_array($sql)) { extract($l);

                echo '<tr>';
        	echo '<td>'.mysql_result(mysql_query("select * from notas_obras where id = $obra"),0,"descricao").'</td>';
        	echo '<td>'.mysql_result(mysql_query("select * from notas_empresas where id = $empresa"),0,"nome").'</td>';
                echo '<td>'.$numero.'</td>';
        	echo '<td>'.implode("/",array_reverse(explode("-",$recebimento))).'</td>';
                echo '<td>'.implode("/",array_reverse(explode("-",$vencimento))).'</td>';
        	echo '</tr>';

                }
        ?>

        </table>

        <?php

	    echo '<table width="100%" class="table table-condensed" align="center">';
        echo '<tr class="small"><td colspan="7"><h5>Itens Adicionados: </h5></td></tr>';

		echo '<tr class="small">
                	<th>Cupom:</th>
                        <th>Material / Item:</th>
                        <th>Cat:</th>
                        <th>Obs:</th>
                        <th>Qtd:</th>
                        <th>Saldo:</th>
                        <th>V. Un:</th>
                        <th>Total:</th>
              </tr>';

		$sql = mysql_query("select * from notas_itens_add where nota = $id");
        while($l = mysql_fetch_array($sql)) { extract($l);

            $subtotal = $quantidade*$valor;

            $quantidade_estoque = mysql_result(mysql_query("select *, SUM(quantidade) as total from notas_itens_add where item = $item"),0,"total");
            $quantidade_saida = mysql_result(mysql_query("select *, SUM(quantidade) as total from notas_retirada_itens where id_item = $item"),0,"total");
            $saldo_quantidade = $quantidade_estoque-$quantidade_saida;
            $saldo_quantidade = $saldo_quantidade;

			echo '<tr class="small">';
				echo '<td>'.$cupom.'</td>';
				echo '<td>'.mysql_result(mysql_query("select * from notas_itens where id = $item"),0,"descricao").'</td>';
				echo '<td>'.mysql_result(mysql_query("select * from notas_categorias where id = $categoria"),0,"descricao").'</td>';
				echo '<td>'.$observacoes.'</td>';
				echo '<td>'.number_format($quantidade,"2").'</td>';
                echo '<td>'.number_format($saldo_quantidade,"2").'</td>';
				echo '<td>R$ '.number_format($valor,"2",",",".").'</td>';
                                echo '<td>R$ '.number_format($subtotal,"2",",",".").'</td>';
			echo '</tr>';

                        @$total_quantidade += $quantidade;
                        @$total_valor += $valor;
                        @$total_sub += $subtotal;
		}


        echo '<tr>
        	<th colspan="7" align="right">TOTAL: </th>
                <th>R$ '.number_format($total_sub,"2",",",".").'</th>
             </tr>';
	echo '</table>';



        ?>


</table>



