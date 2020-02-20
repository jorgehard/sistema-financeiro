<?php 
	include("../config.php");
	include("../validar_session.php");
	getData();
	getNivel();
?>
<script src="../js/combobox-resume.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$(".btnPrint").printPage();
});
</script>
<style>
/* .formulario-info .ui-button{ display:none; } */
</style>
<?php
	$sql = mysql_query("select empresa, numero, recebimento, obra as obra_nt, tipo_nota from notas_nf where id = '$id'");
	while($l = mysql_fetch_array($sql)) { extract($l); }
	$cidade_nt = mysql_result(mysql_query("SELECT cidade FROM notas_obras WHERE id = '$obra_nt'"),0,"cidade");
?>
<div>
	<h4>
		<p>	
			<a href="#" style="width:100px; margin-right:10px" onclick="ldy('financeiro/cadastro-nota.php','.conteudo')" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span> <br/>Cadastrar Nota</a>

			
			<?php if($controle_nota == '1'){ ?>
				<a href="#" style="width:100px; margin-right:10px" onclick="ldy('financeiro/itens-nota.php?id=<?= $id ?>','.conteudo')" class="btn btn-info btn-sm pull-right"><span class="glyphicon glyphicon-refresh"></span> <br/>Atualizar</a>
			<?php }else{ ?>
				<a href="#" style="width:100px; margin-right:10px" onclick="ldy('financeiro/itens-nota.php?id=<?= $id ?>','.retorno')" class="btn btn-info btn-sm pull-right"><span class="glyphicon glyphicon-refresh"></span> <br/>Atualizar</a>
			<?php } ?>

			<a href="javascript:void(0)" style="width:100px; margin-right:10px" onclick="$('.modal-body').load('financeiro/cadastro-vencimento.php?nota=<?php echo $id ?>&cidade_nt=<?= $cidade_nt ?>')" class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-usd"></span> <br/>Vencimentos</a>
			
			<a href="financeiro/fatura/fatura.php?id_nota=<?= $id ?>" target="_blank" style="width:100px; margin-right:10px" class="btn btn-warning btn-sm pull-right"><span class="glyphicon glyphicon-print"></span> <br/>Imprimir</a>
		</p>
	</h4>
	<table class="table table-condensed small" style="margin:0px;">
	<tr class="active">
		<td style="border:none; padding:0px;">
			<ul class="nav nav-tabs" role="tablist">
				<li class="active"><a href="#home" style="color:#333; padding:15px;" role="tab" data-toggle="tab">Informações</a></li>
				<li><a href="#messages" style="color:#333; padding:15px;" role="tab" data-toggle="tab" onclick="$('#messages').load('financeiro/anexar-documentos.php?id_nota=<?php echo $id ?>')">Anexos & Documentos</a></li>
			</ul>
		</td>
	</tr>
	</table>
	<!-- Tab panes -->
	<div class="tab-content">
		<!-- Principal, dados da SS -->
		<div class="tab-pane active" id="home">
			<?php 
			if($tipo_nota == '1'){
				include ('itens-nota-locacao.php');
			}else{
				include ('itens-nota-normal.php');
			}
			?>
		</div>
		<div class="tab-pane" id="messages"> </div>
	</div>
</div> <!-- fim div retorno -->

	<div class="modal" id="myModalEditar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="height:auto;">
		<div class="modal-dialog" style="width:50%;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" style="color:#C9302C; opacity:1; "  onclick="$('.modal').modal('hide')" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Informações</h4>
				</div>
				<div class="modal-body">
					Aguarde um momento &nbsp;&nbsp; <img src="../../imagens/loading.gif" alt="Carregando" width="20px"/>
				</div>
			</div>
		</div>
	</div>

			<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="height:auto;">
				<div class="modal-dialog" style="width:95%;">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" style="color:#C9302C; opacity:1; "  onclick="$('.modal').modal('hide')" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="myModalLabel" style="font-family: \'Oswald\', sans-serif; letter-spacing:5px;">Controle de Parcelas - Vencimento</h4>
						</div>
						<div class="modal-body">
							Aguarde um momento &nbsp;&nbsp; <img src="../../imagens/loading.gif" alt="Carregando" width="20px"/>
						</div>
					</div>
				</div>
			</div>
	