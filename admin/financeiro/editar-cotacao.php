<?php
	require_once("../config.php");
	require_once("../validar_session.php");
	getNivel();
	getData();
?>

<script src="../js/combobox-resume.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	//Multi Select
	$('.sel').multiselect({
		buttonClass: 'btn btn-sm', 
		numberDisplayed: 1,
		maxHeight: 500,
		includeSelectAllOption: true,
		selectAllText: "Selecionar todos",
		enableFiltering: true,
		enableCaseInsensitiveFiltering: true,
		selectAllValue: 'multiselect-all',
		buttonWidth: '100%'
	}); 
});
</script>
<?php
	if(@$ac=='inserir') { 
		$sql_insert = mysql_query("insert into cadastro_cotacao_itens (id_cotacao, item, qtd, vlr_fornecedor01, vlr_fornecedor02, vlr_fornecedor03) values ('$id','$item','$qtd','$vlr_fornecedor01','$vlr_fornecedor02', '$vlr_fornecedor03')");
        if($sql_insert){
			echo '<div class="alert alert-success" role="alert">Item adicionado com sucesso!!!</div>';
        }else{
            echo 'Algo aconteceu errado!!!';
        }
	}
    
    if(@$ac=='del') {
        mysql_query("delete from cadastro_cotacao_itens where id = '$id_item'");
    }

	if($ac=='listar') {		
		echo '<table class="table table-bordered table-condensed table-blue">';
		echo '<thead><tr class="small"><th colspan="3"></th><th style="text-align:center" colspan="2">Fornecedor 01</th><th style="text-align:center" colspan="2">Fornecedor 02</th><th style="text-align:center" colspan="2">Fornecedor 03</th><th></th>';
		if($editarss_usuario == '1' || $acesso_login == 'MASTER'){
			echo '<th></th>';
		}
		echo '</tr></thead>';
		echo '<tr class="small"><th>N</th><th>Item</th><th style="text-align:center">Qtd</th><th style="text-align:center">Vlr Un.</th><th style="text-align:center">Total</th><th style="text-align:center">Vlr Un.</th><th style="text-align:center">Total</th><th style="text-align:center">Vlr Un.</th><th style="text-align:center">Total</th>';
		echo '<th>Editar</th>';
		if($editarss_usuario == '1' || $acesso_login == 'MASTER'){
			
			echo '<th>Excluir</th>';
		}
		echo '</tr>';				
		$sql_cotacao = mysql_query("SELECT * FROM cadastro_cotacao_itens WHERE id_cotacao = '$id_cotacao'");
		while($lx = mysql_fetch_array($sql_cotacao)) {
			$se += 1;
			echo '<tr>';
			echo '<td>'.$se.'</td>';
			if($tipo_cotacao == '1'){
				echo '<td>'.@mysql_result(mysql_query("select * from notas_itens where id = '".$lx['item']."'"),0,"descricao").'</td>';
			}else if($tipo_cotacao == '2'){
				echo '<td>'.@mysql_result(mysql_query("select * from notas_itens where id = '".$lx['item']."'"),0,"descricao").'</td>';
			}else if($tipo_cotacao == '3'){
				echo '<td>'.@mysql_result(mysql_query("select * from notas_itens where id = '".$lx['item']."'"),0,"descricao").'</td>';
			}
			$total_fornecedor01 += $lx['vlr_fornecedor01']*$lx['qtd'];
			$total_fornecedor02 += $lx['vlr_fornecedor02']*$lx['qtd'];
			$total_fornecedor03 += $lx['vlr_fornecedor03']*$lx['qtd'];
			$total_qtd += $lx['qtd'];
			echo '<td align="center">'.$lx['qtd'].'</td>';
			echo '<td align="center">R$ '.number_format($lx['vlr_fornecedor01'],"2",",",".").'</td>';
			echo '<td align="center">R$ '.number_format($lx['vlr_fornecedor01']*$lx['qtd'],"2",",",".").'</td>';
			echo '<td align="center">R$ '.number_format($lx['vlr_fornecedor02'],"2",",",".").'</td>';
			echo '<td align="center">R$ '.number_format($lx['vlr_fornecedor02']*$lx['qtd'],"2",",",".").'</td>';
			echo '<td align="center">R$ '.number_format($lx['vlr_fornecedor03'],"2",",",".").'</td>';
			echo '<td align="center">R$ '.number_format($lx['vlr_fornecedor03']*$lx['qtd'],"2",",",".").'</td>';
			echo '<td align="center" width="40px"><a href="#" onclick=\'$(".modal-body").load("financeiro/editar-cotacao-item.php?id_item='.$lx['id'].'&id='.$id_cotacao.'&tipo_cotacao='.$tipo_cotacao.'")\' data-toggle="modal" data-target="#myModal"  class="btn btn-primary btn-xs" style="margin:0px; padding:0px 5px;"><span class="glyphicon glyphicon-edit"></span></a></td>';
			if($editarss_usuario == '1' || $acesso_login == 'MASTER'){
				echo '<td align="center" width="40px"><a href="#" onclick=\'ldy("financeiro/editar-cotacao.php?ac=del&id_item='.$lx['id'].'&id='.$id_cotacao.'&tipo_cotacao='.$tipo_cotacao.'",".resultado")\' style="margin:0px; padding:0px 5px;" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a></td>';
			}
			echo '</tr>'; 
		}		
			echo '<tr>';
			echo '<td colspan="2"></td>';
			echo '<td style="text-align:center">'.$total_qtd.'</td>';
			echo '<td style="text-align:center" colspan="2">R$ '.number_format($total_fornecedor01,"2",",",".").'</td>';
			echo '<td style="text-align:center" colspan="2">R$ '.number_format($total_fornecedor02,"2",",",".").'</td>';
			echo '<td style="text-align:center" colspan="2">R$ '.number_format($total_fornecedor03,"2",",",".").'</td>';
			echo '<td></td>';
			echo '<td></td>';
			echo '</tr>';
		echo '</table>';
		exit;
	}
?>
	<a style="font-family: 'Oswald', sans-serif; margin:0px 10px; padding:5px; letter-spacing:5px;" href="financeiro/imprimir-cotacao.php?id=<?php echo $id ?>" target="_blank" class="btn btn-warning btn-sm pull-right">Imprimir <span class="glyphicon glyphicon-print"></span></a>
    
	<a style="font-family: 'Oswald', sans-serif;letter-spacing:5px;" href="#" onclick="$('.conteudo').load('financeiro/cadastro-cotacao.php')" class="btn btn-primary btn-sm pull-right" style="margin:0px; padding:5px;">Cadastrar Nova <span class="glyphicon glyphicon-plus"></span></a>	
		
<div class="container-fluid" style="padding:0px 0px 15px 0px; margin-bottom:20px; border-bottom:1px solid #CCC"><h4 style="font-family: 'Oswald', sans-serif;letter-spacing:4px;"><small>Cadastro de Cotação</small></h4></div>
<?php
$sql_cotacao = mysql_query("SELECT * FROM cadastro_cotacao WHERE id = '$id'");
while($gh = mysql_fetch_array($sql_cotacao)){
	$tipo_cotacao = $gh['tipo_cotacao'];
    echo '<table class="table table-striped table-green small">';
    echo '<thead><tr> <th>Data:</th> <th>Cidade:</th>  <th>Solicitante:</th></tr></thead>';
    echo '<td>'.implode("/", array_reverse( explode("-", $gh['data_cotacao']))).'</td>';
    echo '<td>'.mysql_result(mysql_query("SELECT * FROM notas_obras_cidade WHERE id = '".$gh['cidade']."'"),0,"nome").'</td>';
    echo '<td>'.$gh['solicitante'].'</td>';
    echo '</tr>';
	echo '</table>';
	echo '<br/>';
	echo '<table class="table table-bordered table-green small">';
	echo '<thead><tr>';
	echo '<th></th>';
	echo '<th>Empresa</th>';
	echo '<th>Forma Pagamento</th>';
	echo '<th>Data Prazo</th>';
	echo '</tr></thead>';
	echo '<tr>';
	echo '<td><b>Fornecedor 1:</b></td>';
	echo '<td>'.mysql_result(mysql_query("SELECT * FROM notas_empresas WHERE id = '".$gh['fornecedor01']."'"),0,"nome").'</td>';

    echo '<td>'.$gh['forma_pagamento01'].'</td>';
    echo '<td>'.implode("/", array_reverse( explode("-", $gh['prazo01']))).'</td>';
	echo '</tr>';
	
	echo '<tr>';
	echo '<td><b>Fornecedor 2:</b></td>';
	echo '<td>'.mysql_result(mysql_query("SELECT * FROM notas_empresas WHERE id = '".$gh['fornecedor02']."'"),0,"nome").'</td>';
    echo '<td>'.$gh['forma_pagamento02'].'</td>';
    echo '<td>'.implode("/", array_reverse( explode("-", $gh['prazo02']))).'</td>';
	echo '</tr>';
	
	echo '<tr>';
	echo '<td><b>Fornecedor 3:</b></td>';
	echo '<td>'.mysql_result(mysql_query("SELECT * FROM notas_empresas WHERE id = '".$gh['fornecedor03']."'"),0,"nome").'</td>';
    echo '<td>'.$gh['forma_pagamento03'].'</td>';
    echo '<td>'.implode("/", array_reverse( explode("-", $gh['prazo03']))).'</td>';
	echo '</tr>';
    echo '</table>';
}
?>

<div class="container-fluid hidden-print" style="padding:0px 0px 15px 0px; margin-bottom:20px; border-bottom:1px solid #CCC"><h4 style="font-family: 'Oswald', sans-serif;letter-spacing:4px;"><small>Cadastro Fornecedor </small></h4></div>
<div class="container-fluid alert alert-info" style="padding:5px 5px 0px 5px">
<form action="javascript:void(0)" onSubmit="post(this,'financeiro/editar-cotacao.php?ac=inserir&id=<?php echo $id ?>&tipo_cotacao=<?php echo $tipo_cotacao ?>','.resultado');" class="formulario-info">
	<div class="col-xs-3" style="padding:2px">
		<div class="row" style="text-align:center">
			<br/>
		</div>
		<label for="" style="width:100%"><small>Selecione o item desejado:</small><br/>
			<select name="item" class="form-control input-sm combobox">
				<?php
				if($tipo_cotacao == '1'){
					$sql_itens = mysql_query("select * from notas_itens WHERE oculto = '2' order by descricao asc");
					while($cot = mysql_fetch_array($sql_itens)) {
						echo '<option value="'.$cot['id'].'">'.$cot['descricao'].'</option>';
					}
				}else if($tipo_cotacao == '2'){
					$sql_itens = mysql_query("select * from notas_itens WHERE oculto = '2' order by descricao asc");
					while($cot = mysql_fetch_array($sql_itens)) {
						echo '<option value="'.$cot['id'].'">'.$cot['descricao'].'</option>';
					}
				}else if($tipo_cotacao == '3'){
					$sql_itens = mysql_query("select * from notas_itens WHERE oculto = '2' order by descricao asc");
					while($cot = mysql_fetch_array($sql_itens)) {
						echo '<option value="'.$cot['id'].'">'.$cot['descricao'].'</option>';
					}
				}
				?>
			</select>
		</label>
	</div>
	<div class="col-xs-1" style="text-align:center; padding:2px">
		<div class="row" style="text-align:center">
			<br/>
		</div>
		<label for=""><small>Quantidade:</small><br/>
			<input type="number" name="qtd" step="0.01" style="width:100%" class="form-control input-sm" required />
		</label>
	</div>
	<div class="col-xs-6">
		<div class="row" style="text-align:center">
			<b>Valores referente aos fornecedores (R$)</b>
		</div>
		<div class="col-xs-4" style="padding:2px">
			<label for=""><small>Fornecedor 01:</small><br/>
				<input type="number" name="vlr_fornecedor01" step="0.01" class="form-control input-sm" required>
			</label>
		</div>
		<div class="col-xs-4" style="padding:2px">
			<label for=""><small>Fornecedor 02:</small><br/>
				<input type="number" name="vlr_fornecedor02" step="0.01" class="form-control input-sm" required>
			</label>
		</div>
		<div class="col-xs-4" style="padding:2px">
			<label for=""><small>Fornecedor 03:</small><br/>
				<input type="number" name="vlr_fornecedor03" step="0.01" class="form-control input-sm" required>
			</label>
		</div>
	</div>
	<div class="col-xs-2">
		<div class="row" style="text-align:center">
			<br/><br/>
		</div>
		<input type="submit" style="width:150px; margin-left:10px" value="Adicionar" class="btn btn-primary btn-sm" />
	</div>
</form>
</div>	

<script>ldy("financeiro/editar-cotacao.php?ac=listar&id_cotacao=<?php echo $id ?>&tipo_cotacao=<?php echo $tipo_cotacao ?>",".resultado")</script>

<div class="resultado" style="min-height:400px"></div>

<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
			<button type="button" class="close" style="color:#C9302C; opacity:1; " onclick="$('.modal').modal('hide'); $('.modal-body').empty()" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h3 class="modal-title" id="myModalLabel" style="font-family: 'Oswald', sans-serif;letter-spacing:5px;"> <strong><small>Editar Cotação!!!</small></strong></h3>
      </div>
      <div class="modal-body">
        ...
      </div>
    </div>
  </div>
</div>