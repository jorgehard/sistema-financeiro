<?php include("../config.php") ?>
<?php include("../config.php") ?>

<?php if(@$ac=='resultado') {

    $data = implode("-",array_reverse(explode("/",$data))).'-01';

    if(@$op=='ins') {
      mysql_query("insert into func_equipes (obra,equipe,funcionario,data,enc,receb) values ('$obra','$equipe','$funcionario','$data','$enc',1)");
	
	  }

    echo '<table class="table table-bordered table-condensed small">';
    echo '<tr><th></th><th>Funcionário: </th><th>Equipe: </th><th>Encarregado: </th> <th>Obra </td> <th> Excluir </th></tr> <';
            $associados = mysql_query("select * from func_equipes where data = '$data' order by id desc");
            while($l = mysql_fetch_array($associados)) {extract($l);
                echo '<tr>';
                	  echo '<td>'.$id.'</td>';
                      echo '<td>'.@mysql_result(mysql_query("select * from rh_funcionarios where id = $funcionario"),0,"nome").'</td>';
                      echo '<td>'.@mysql_result(mysql_query("select * from equipes where id = $equipe"),0,"nome").'</td>';
                      echo '<td>'.@mysql_result(mysql_query("select * from rh_funcionarios where id = $enc"),0,"nome").'</td>';
					  echo '<td>'.@mysql_result(mysql_query("select * from notas_obras where id = $obra"),0,"descricao").'</td>';
					  echo '<td><a href="#'.$id.'" class="btn btn-primary btn-xs" onclick=\'ldy("producao/lista-associacao-funcionarios.php?ac=excluir&id='.$id.'",".ajax")\'>Excluir</a></td>';
                echo '</tr>';
            }
    echo '</table>';
	
	$busca=mysql_query ("Select funcionario from func_equipes where funcionario=$funcionario'");
								

} else { ?>

<h3>Associar <small>Ligar funcionários a uma equipe</small></h3>

<form class="form-inline" action="javascript:void(0)" onSubmit="post(this,'producao/associar-funcionarios.php?ac=resultado&op=ins','.retorno')">

                <input type="text" class="form-control input-sm" onFocus="$(this).mask('99/9999')" name="data" size="10" onblur="ldy('producao/associar-funcionarios.php?ac=resultado&data='+$(this).val(), '.retorno')"/>
                <?php


                echo '<select name="equipe" class="form-control input-sm" style="width:220px">';
                        echo '<option value="0">ESCOLHA UMA EQUIPE EQUIPE</option>';
                        $equipes = mysql_query("select * from equipes where status = 0 order by nome asc");
                        while($l = mysql_fetch_array($equipes)) {
                            echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>';
                        }
                echo '</select> ';

                echo '<select name="funcionario" class="form-control input-sm" style="width:220px">';
						echo '<option value="0"> ESCOLHA UM FUNCIONÁRIO</option>';
                        $funcionarios = mysql_query("select * from rh_funcionarios where demissao = '0000-00-00' and categoria = 0 order by nome asc");
                        while($l = mysql_fetch_array($funcionarios)) {
                            echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>';
                        }
                echo '</select> ';

                echo '<select name="enc" class="form-control input-sm" style="width:220px">';
						echo '<option value="0"> ESCOLHA O ENCARREGADO</option>';
                        $encs = mysql_query("select * from rh_funcionarios where enc = 1 order by nome asc");
                        while($l = mysql_fetch_array($encs)) {
                            echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>';
                        }
                echo '</select> ';
				
                ?>
<label>Obra/Contrato: <br/><select class="form-control input-sm" name="obra">
	<option value="ESCOLHA A OBRA"></option>
	<?php 
				$obras = mysql_query("select * from  notas_obras order by descricao asc"); while($l=mysql_fetch_array($obras)) {
					if($obra==$l['id']) { echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>'; }
					else { echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>'; } 	
				} ;  	
	?>		
             <br><br>&nbsp;&nbsp;   <input type="submit" class="btn btn-success btn-sm" value="Adicionar" />


</form>

<div class="retorno"> <center>
<div class="jumbotron">
  <h1>Associação de Equipes</h1> 
  <p>Escolha a <b>Equipe</b>, o <b>Funcionário</b> e o <b>Encarregado</b> e clique em <b><i>Adicionar</b></i> </p> 
</div>


<div class="container">
</div>

</center>
</div>

<?php } ?>