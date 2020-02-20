<style>
input[type=text], input[type=password], input[type=email], select, option {
    padding: 1px !important;
    height: 20px !important; 
    font-size: 10px !important;
}
</style>

<?php include("../config.php") ?>

<?php
	if(@$ac=='excluir') {
		$sql = mysql_query("delete from func_equipes where id = $id");
		if($sql) {
			echo '<script>$("#frm'.$id.'").fadeOut()</script>';
		}
		else {
			echo '<script>window.alert("'.mysql_error().'")</script>';
		}
		exit;
	}
?>

<?php if(@$ac=='resultado') { ?>

<h3>Lista de funcionários:</h3>

<?php

        if(@$op=='update') { mysql_query("update func_equipes set valor = '$valor', receb = '$receb', enc = '$enc', equipe = '$eqp' where id = $lanc"); }

        $im = explode('/',$data); $mes = $im[0]; $ano = $im[1];
        $data_post = $data;
        $data = implode("-",array_reverse(explode("/",$data))).'-01';

        $sql = mysql_query("select * from func_equipes where data = '$data' and equipe like '$eq' and funcionario like '$fu' and enc like '$en' order by id desc");
        while($l = mysql_fetch_array($sql)) { extract($l);
                echo '<form class="form-inline small" action="javascript:void(0)" onSubmit=\'post(this,"producao/lista-associacao-funcionarios.php?ac=resultado&op=update&fu='.$fu.'&en='.$en.'&eq='.$eq.'&lanc='.$id.'&data='.$data_post.'",".retorno")\' id="frm'.$id.'">';



                echo '-'.$id.' <select name="eqp" class="form-control input-sm" style="width:160px;">';
                        $equipes = mysql_query("select * from equipes where status = 0 and oculto = 1 order by nome asc");
                        while($l = mysql_fetch_array($equipes)) {
                            if($equipe==0) { echo '<option value="0" selected>ENCARREGADO</option>'; }
                            elseif($equipe==$l['id']) { echo '<option value="'.$l['id'].'" selected>'.$l['nome'].'</option>'; }
                            else { echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>'; }
                        }
                echo '</select> ';


                echo '<select name="enc" class="form-control input-sm" style="width:160px;">';
                        $encs = mysql_query("select * from rh_funcionarios where enc = 1 order by nome asc");
                        while($l = mysql_fetch_array($encs)) {
                            if($enc==$l['id']) { echo '<option value="'.$l['id'].'" selected>'.$l['nome'].'</option>'; }
                            else { echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>'; }
                        }
                echo '</select> ';
				
				 echo '<select name="obra" class="form-control input-sm" style="width:160px;">';
                        $obras = mysql_query("select * from notas_obras where id IN(1,3) order by descricao asc");
                        while($l = mysql_fetch_array($obras)) {
                            if($obra==$l['id']) { echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>'; }
                            else { echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>'; }
                        }
                echo '</select> ';


                echo '<input type="text" class="form-control input-sm small" value="'.mysql_result(mysql_query("select * from rh_funcionarios where id = $funcionario"),0,"nome").'" size="30" disabled> ';


             /*   if($equipe==0) {
                $total_valor = 0;
                $servs = mysql_query("select *, sum(valor) as v_t from func_equipes where enc = $funcionario and data = '$data' and equipe <> 0 group by equipe");
                while($li = mysql_fetch_array($servs)) {

                  $equip = $li['equipe'];
                  $q_equipe = @mysql_num_rows(mysql_query("select * from func_equipes where data = '$data' and equipe = '$equip'"));
                  $total_geral = $li['v_t']/$q_equipe;
                  $total_valor += $total_geral;

                  //echo mysql_result(mysql_query("select * from equipes where id = $equip"),0,"nome") . ' - ' . $q_equipe . ' / ' . $li['v_t'] . '<br>';

                }

                  //$total_valor = $total_valor/50;
                }

                else {
                $total_valor = 0;
                $servs = mysql_query("select *, SUM(quantidade) as total_serv from producao where equipe = '$equipe' and MONTH(data) = '$mes' and YEAR(data) = '$ano' group by servico");
                while($li = mysql_fetch_array($servs)) {

                  $serv = $li['servico'];
                  $valor_unitario = @mysql_result(mysql_query("select * from sp where id = $serv"),0,"valor");
                  $total_geral = $li['total_serv']*$valor_unitario;
                  $total_valor += $total_geral;

                }}

                echo '<input type="text" class="form-control input-sm" value="'.number_format($total_valor,"2",",",".").'" size="5" disabled> ';

                $val_receb = $valor;

                echo '<input type="text" name="valor" id="val1" class="form-control input-sm small" value="'.$val_receb.'" size="5"> ';


                if($receb==0) { echo '<input type="radio" name="receb" value="1"> Sim <input type="radio" name="receb" value="0" checked> Não'; }
                else { echo '<input type="radio" name="receb" value="1" checked> Sim <input type="radio" name="receb" value="0"> Não '; }
*/
                if($valor=='0.00') { echo ' <input type="submit" value="Definir" class="btn btn-danger btn-xs">'; }
                else { echo ' <input type="submit" value="Atualizar" class="btn btn-warning btn-xs">'; }
				echo '<a href="#'.$id.'" class="btn btn-primary btn-xs" onclick=\'ldy("producao/lista-associacao-funcionarios.php?ac=excluir&id='.$id.'",".ajax")\'>Excluir</a>';
            echo '</form>';
        }
?>


<?php } else { ?>

<h3>Editar <small>Associação</small></h3>

<form class="form-inline" action="javascript:void(0)" onSubmit="post(this,'producao/lista-associacao-funcionarios.php?ac=resultado','.retorno')">

                <input type="text" class="form-control input-sm" onFocus="$(this).mask('99/9999')" name="data" size="10"/>
                <?php


                echo '<select name="eq" class="form-control input-sm" style="width:200px">';
                        echo '<option value="%">Qualquer</option>';
                        $equipes = mysql_query("select * from equipes where status = 0 and oculto = 1 order by nome asc");
                        while($l = mysql_fetch_array($equipes)) {
                            echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>';
                        }
                echo '</select> ';

                echo '<select name="fu" class="form-control input-sm" style="width:200px">';
                        echo '<option value="%">Qualquer</option>';
                        $funcionarios = mysql_query("select * from rh_funcionarios order by nome asc");
                        while($l = mysql_fetch_array($funcionarios)) {
                            echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>';
                        }
                echo '</select> ';

                echo '<select name="en" class="form-control input-sm" style="width:200px">';
                        echo '<option value="%">Qualquer</option>';
                        $encs = mysql_query("select * from rh_funcionarios where enc = 1 order by nome asc");
                        while($l = mysql_fetch_array($encs)) {
                            echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>';
                        }
                echo '</select> ';
				
				   echo '<select name="obra" class="form-control input-sm" style="width:200px">';
                        echo '<option value="%">Qualquer</option>';
                        $obras = mysql_query("select * from notas_obras where id IN(1,3) order by descricao asc");
                        while($l = mysql_fetch_array($obras)) {
                            echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>';
                        }
                echo '</select> ';


                ?>

                <input type="submit" class="btn btn-success btn-sm" value="Filtrar" />


</form>

<div class="retorno"></div>
<div class="ajax"></div>

<?php } ?>

<script type="text/javascript">
$(function(){
 $("#val1").maskMoney({symbol:'R$ ',showSymbol:false, thousands:'', decimal:'.', symbolStay: true});
 $("#val2").maskMoney({symbol:'R$ ',showSymbol:false, thousands:'', decimal:'.', symbolStay: true});
 })
</script>






