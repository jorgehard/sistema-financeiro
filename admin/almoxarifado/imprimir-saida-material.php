<?php include("../config.php") ?>
<link rel="stylesheet" href="../../css/bootstrap.css" />


<table class="table table-condensed">
        <tr>
            <td><img src="http://www.polemicalitoral.com.br/imagens/logo.png" alt="" width="50px" /></td>
            <td><h3>Retirada de Itens</h3></td>
        </tr>
</table>

<table class="table table-condensed">

        <tr><th>Data:</th><th>Nome:</th></tr>

        <?php

        $retirada = $id;

        $topo = mysql_query("select * from notas_retirada where id = $id");
        while ($l = mysql_fetch_array($topo)) { extract($l);

        echo '<tr>
                <td>'.implode("/",array_reverse(explode("-",$data))).'</td>
                <td>'.mysql_result(mysql_query("select * from rh_funcionarios where id = $funcionario"),0,"nome").'</td>
              </tr>';

        }

        ?>
</table>

<table class="table table-condensed table-bordered">

        <tr class="active"><td colspan="2"><h4>Itens Adicionados</h4></td></tr>
        <tr class="small active"><th>Descrição:</th><th>Quantidade:</th></tr>

        <?php

        $topo = mysql_query("select * from notas_retirada_itens where id_retirada = $retirada");
        while ($l = mysql_fetch_array($topo)) { extract($l);

        echo '<tr class="small">
                <td>'.mysql_result(mysql_query("select * from notas_itens where id = $id_item"),0,"descricao").'</td>
                <td>'.number_format($quantidade,"2").'</td>
              </tr>';

        }

        ?>
</table>

<table class="table table-bordered">
        <tr><td align="center"><br><br> __________________________________________ <br> <?php echo mysql_result(mysql_query("select * from rh_funcionarios where id = $funcionario"),0,"nome"); ?></td></tr>
</table>