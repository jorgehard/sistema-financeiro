<?php include("../config.php") ?>

<?php $sql = mysql_query("select * from rh_funcionarios where id = $id"); while($l=mysql_fetch_array($sql)) { extract($l); ?>
<?php 		
		if($trabalho_entrada=='') { $trabalho_entrada = '07:00'; } 
		if($trabalho_refeicao=='') { $trabalho_refeicao = '12:00 - 13:00'; } 
		if($trabalho_saida=='') { $trabalho_saida = '17:00'; } 
		if($trabalho_descanso=='') { $trabalho_descanso = 'SAB/DOM'; } 
		if($sexta_entrada=='') { $sexta_entrada = '07:00'; } 
		if($sexta_refeicao=='') { $sexta_refeicao = '12:00 - 13:00'; } 
		if($sexta_saida=='') { $sexta_saida = '16:00'; }
		if($pis_banco=='') { $pis_banco = 'C.E.F'; }
		if($pis_endereco=='') { $pis_endereco = 'AV. Nove de Julho, 194 - SJCAMPOS/SP'; }
		if($pis_numbanco=='') { $pis_numbanco = '104'; }
		if($pis_agencia=='') { $pis_agencia = '1400'; }
		if($banco_depositario=='') { $banco_depositario = 'CAIXA ECONOMICA FEDERAL'; }
		if($optante_fgts=='') { $optante_fgts = 'SIM'; }
		if($forma_pagamento=='') { $forma_pagamento = 'MENSAL'; }
?>

<form action="javascript:void(0)" onSubmit="post(this,'rh/editar-funcionario.php?ac=update&id=<?php echo $id ?>','.ajax');" class="small" enctype="multipart/form-data">
		
		<div class="panel panel-default"><div class="panel-heading">Dados cadastrais</div><div class="panel-body">
		<div class="col-md-3">
			<?php
				if($imagem=='') { echo '<img src="rh/imagens/sem_foto.png" width="200px" class="img-rounded">'; }
				else { echo '<img src="rh/imagens/'.$imagem.'" width="200px" class="img-rounded">'; }			
			?>
			<br/><br/><center><a href="#" class="btn btn-info btn-xs" disabled onclick='window.open("rh/editar-imagem.php?id=<?php echo $id ?>", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=100, left=500, width=400, height=400")'>Alterar imagem</a></center>
		</div>
		
		<div class="col-md-9">
		<label>N° Ordem:<input type="text" name="numero_ordem" value="<?php echo $numero_ordem ?>" class="form-control input-sm" disabled size="5"></label>
		<label>Nome:<input type="text" name="nome" value="<?php echo $nome ?>" class="form-control input-sm" disabled size="40" required/></label>
		<label>N° Matrícula:<input type="text" name="numero_matricula" value="<?php echo $numero_matricula ?>" class="form-control input-sm" disabled size="5"></label>
		
		<label>Pai:<input type="text" name="nome_pai" value="<?php echo $nome_pai ?>" class="form-control input-sm" disabled size="30"></label>
		<label>Nacionalidade:<input type="text" name="nacionalidade_pai" value="<?php echo $nacionalidade_pai ?>" class="form-control input-sm" disabled size="10"></label>
		<label>Mãe:<input type="text" name="nome_mae" value="<?php echo $nome_mae ?>" class="form-control input-sm" disabled size="30"></label>
		<label>Nacionalidade:<input type="text" name="nacionalidade_mae" value="<?php echo $nacionalidade_mae ?>" class="form-control input-sm" disabled size="10"></label>

		<label>Nascimento:<input type="text" name="nascimento" onfocus="$(this).mask('99/99/9999')" value="<?php echo implode("/",array_reverse(explode("-",$nascimento))) ?>" class="form-control input-sm" disabled size="10" required></label>
		<label>Nacionalidade:<input type="text" name="nacionalidade" value="<?php echo $nacionalidade ?>" class="form-control input-sm" disabled size="10"required></label>
		<label>Estado civil:<input type="text" name="estado_civil" value="<?php echo $estado_civil ?>" class="form-control input-sm" disabled size="10"required></label>
		<label>Local nascimento:<input type="text" name="local_nascimento" value="<?php echo $local_nascimento ?>" class="form-control input-sm" disabled size="10"required></label>
		
		<label>Estado:<input type="text" name="estado" value="<?php echo $estado ?>" class="form-control input-sm" disabled size="2"required></label>
		<label>Identidade:<input type="text" name="rg" value="<?php echo $rg ?>" class="form-control input-sm" disabled size="13"required></label>
		<label>C. Profissional:<input type="text" name="carteira_profissional" value="<?php echo $carteira_profissional ?>" class="form-control input-sm" disabled size="10" required></label>
		<label>Série:<input type="text" name="serie" value="<?php echo $serie ?>" class="form-control input-sm" disabled size="8"required></label>
		<label>Reservista:<input type="text" name="carteira_reservista" value="<?php echo $carteira_reservista ?>" class="form-control input-sm" size="13" disabled required></label>
		<label>Categoria:<input type="text" name="carteira_reservista_categoria" value="<?php echo $carteira_reservista_categoria ?>" class="form-control input-sm" disabled size="5"></label>
		<label>CPF:<input type="text" name="cpf" value="<?php echo $cpf ?>" class="form-control input-sm" disabled size="13"required></label>
		<label>Titulo de Eleitor:<input type="text" name="titulo_eleitor" value="<?php echo $titulo_eleitor ?>" class="form-control input-sm" disabled size="14" required></label>
		<label>Carteira de Saúde:<input type="text" name="carteira_saude" value="<?php echo $carteira_saude ?>" class="form-control input-sm" disabled size="5"></label>
		
		<label>Filhos Brasileiros?<input type="text" name="tem_filhos_brasileiros" value="<?php echo $tem_filhos_brasileiros ?>" class="form-control input-sm" disabled size="5" required></label>
		<label>Grau de instrução: <input type="text" name="grau_instrucao" value="<?php echo $grau_instrucao ?>" class="form-control input-sm" disabled size="10"></label>
		<label>Nome do conjuge: <input type="text" name="nome_conjuge" value="<?php echo $nome_conjuge ?>" class="form-control input-sm" disabled size="40"></label>
		<label>Quantos filhos? <input type="text" name="quantidade_filhos" value="<?php echo $quantidade_filhos ?>" class="form-control input-sm" disabled size="3"></label>
		<label>Endereço: <input type="text" name="endereco" value="<?php echo $endereco ?>" class="form-control input-sm" disabled size="60" required></label>
		<label>Cidade onde irá prestar o serviço: <input type="text" name="cidade_servico" value="<?php echo $cidade_servico ?>" class="form-control input-sm" disabled size="10" required></label>&nbsp; &nbsp;&nbsp; &nbsp;
		<label>Telefone Residencial:<input type="text" name="telefone" value="<?php echo $telefone ?>" class="form-control input-sm" disabled size="12" onfocus="$(this).mask('(99)9999-9999')" required></label>&nbsp; &nbsp;&nbsp; &nbsp;
		<label>Celular:				<input type="text" name="celular" value="<?php echo $celular ?>" class="form-control input-sm" disabled size="12" onfocus="$(this).mask('(99)99999-9999')"></label>
		</div></div></div>

		<div class="panel panel-default"><div class="panel-heading">Informações do PIS</div><div class="panel-body">
		<label>Cadastrado em: <input type="text" name="pis_cadastro" onfocus="$(this).mask('99/99/9999')" value="<?php echo implode("/",array_reverse(explode("-",$pis_cadastro))) ?>" class="form-control input-sm" disabled size="10"></label>
		<label>Numero PIS: <input type="text" name="pis_numero" value="<?php echo $pis_numero ?>" class="form-control input-sm" disabled size="15"></label>	
		<label>Banco: <input type="text" name="pis_banco" value="<?php echo $pis_banco ?>" class="form-control input-sm" disabled size="10"></label>	
		<label>Endereço: <input type="text" name="pis_endereco" value="<?php echo $pis_endereco ?>" class="form-control input-sm" disabled size="40"></label>	
		<label>Num. Banco: <input type="text" name="pis_numbanco" value="<?php echo $pis_numbanco ?>" class="form-control input-sm" disabled size="3"></label>	
		<label>Agência: <input type="text" name="pis_agencia" value="<?php echo $pis_agencia ?>" class="form-control input-sm" disabled size="5"></label>			
		<label>É optante? <input type="text" name="optante_fgts" value="<?php echo $optante_fgts ?>" class="form-control input-sm" disabled size="3"></label>			
		<label>Data opção: <input type="text" name="data_opcao_fgts" onfocus="$(this).mask('99/99/9999')" value="<?php echo implode("/",array_reverse(explode("-",$data_opcao_fgts))) ?>" class="form-control input-sm" disabled size="10"></label>			
		<label>Data retratação: <input type="text" name="data_retratacao_fgts" onfocus="$(this).mask('99/99/9999')" value="<?php echo implode("/",array_reverse(explode("-",$data_retratacao_fgts))) ?>" class="form-control input-sm" disabled size="10"></label>			
		<label>Banco depositário: <input type="text" name="banco_depositario" value="<?php echo $banco_depositario ?>" class="form-control input-sm" disabled size="30"></label>	
		</div></div>		

		<div class="panel panel-default"><div class="panel-heading">Informações profissionais</div><div class="panel-body">
		<label>Cargo: <select class="form-control input-sm" disabled name="funcao">
		<option value="0"></option>
	<?php 
				$funcoes = mysql_query("select * from rh_funcoes order by descricao asc"); while($l=mysql_fetch_array($funcoes)) {
					if($funcao==$l['id']) { echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>'; }
					else { echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>'; }  	
				} 
	?>	
	</select></label>
	
	<?php /* <label>Equipe: <select class="form-control input-sm" name="equipe">
	<option value="0"></option>
	<?php 
				$equipes = mysql_query("select * from equipes where situacao IN (0,2) order by nome asc"); while($l=mysql_fetch_array($equipes)) {
					if($equipe==$l['id']) { echo '<option value="'.$l['id'].'" selected>'.$l['nome'].'</option>'; }
					else { echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>'; } 	
				} 
	?>	
	</select></label>
	
	<label>Encarregado: <select class="form-control input-sm" name="encarregado">
	<option value="0"></option>
	<?php 
				$encs = mysql_query("select * from rh_funcionarios where enc = 1 order by nome asc"); while($l=mysql_fetch_array($encs)) {
					if($encarregado==$l['id']) { echo '<option value="'.$l['id'].'" selected>'.$l['nome'].'</option>'; }
					else { echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>'; } 	
				} 
	?>	
	</select></label>
	*/?>
	<label>Líder:  <?php if($lider==0)  { echo '<input type="radio" name="lider" value="1" disabled> Sim <input type="radio" name="lider" value="0" disabled checked> Não '; } else { echo '<input type="radio" name="lider" value="1" checked> Sim <input type="radio" name="lider" value="0"> Não'; } ?></label>
	| <label>Encarregado: <?php if($enc==0) { echo '<input type="radio" name="enc" value="1" disabled> Sim <input type="radio" name="enc" value="0" disabled checked> Não '; } else { echo '<input type="radio" name="enc" value="1" checked> Sim <input type="radio" name="enc" value="0"> Não'; } ?></label>
	| <label>Empreiteiro: <?php if($emp==0) { echo '<input type="radio" name="emp" value="1" disabled> Sim <input type="radio" name="emp" value="0" disabled checked> Não '; } else { echo '<input type="radio" name="emp" value="1" checked> Sim <input type="radio" name="emp" value="0"> Não'; } ?></label>

	
	
	<label>Obra/Contrato: <br/><select class="form-control input-sm" disabled name="obra"  >
	<option value="0"></option>
	<?php 
				$obras = mysql_query("select * from  notas_obras order by descricao asc"); while($l=mysql_fetch_array($obras)) {
					if($obra==$l['id']) { echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>'; }
					else { echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>'; } 	
				} ;  	
	?>		
</br>&nbsp;&nbsp;&nbsp;&nbsp;<br>
 </select></label>
	
	<label>Data de admissão: <input type="text" name="admissao" class="form-control input-sm" disabled onfocus="$(this).mask('99/99/9999')" value="<?php echo implode("/",array_reverse(explode("-",$admissao))) ?>" required></label>
	<label>Data do registro: <input type="text" name="data_registro" class="form-control input-sm" disabled onfocus="$(this).mask('99/99/9999')" value="<?php echo implode("/",array_reverse(explode("-",$data_registro))) ?>" required></label>
	<label>Data de demissão: <input type="text" name="demissao" class="form-control input-sm" disabled onfocus="$(this).mask('99/99/9999')" value="<?php echo implode("/",array_reverse(explode("-",$demissao))) ?>" /></label>
	<label>Comissões: <input type="text" name="comissoes" class="form-control input-sm" disabled size="10" value="<?php echo $comissoes ?>"></label>
	<label>Tarefa: <input type="text" name="tarefa" class="form-control input-sm" disabled size="10" value="<?php echo $tarefa ?>"></label>
	<label>F. Pagamento: <input type="text" name="forma_pagamento" class="form-control input-sm" disabled  size="10" value="<?php echo $forma_pagamento ?>"></label>	
	<label>Vale Transporte? <input type="text" name="vale_transporte" class="form-control input-sm" disabled  size="5" value="<?php echo $vale_transporte ?>"></label>	
	<label>Qtd: <input type="text" name="vale_qtd" class="form-control input-sm" disabled size="5" value="<?php echo $vale_qtd ?>"></label>	
	<label>Empresa: <input type="text" name="vale_empresa" class="form-control input-sm" disabled size="30" value="<?php echo $vale_empresa ?>"></label>		
	<label>CNH: <input type="text" name="cnh" class="form-control input-sm" disabled size="15" value="<?php echo $cnh ?>"></label>		
	<label>Categoria CNH: <input type="text" name="categoria_cnh" class="form-control input-sm" disabled size="5" value="<?php echo $categoria_cnh ?>"></label>		
	</div></div>
	
	<div class="panel panel-default"><div class="panel-heading">Horários</div><div class="panel-body" disabled>
	<label>Entrada: <input type="text" class="form-control input-sm" disabled name="trabalho_entrada" size="10" onfocus="$(this).mask('99:99')" value="<?php echo $trabalho_entrada ?>"></label>
	<label>Refeição: <input type="text" class="form-control input-sm" disabled name="trabalho_refeicao" size="10" onfocus="$(this).mask('99:99 - 99:99')" value="<?php echo $trabalho_refeicao ?>"></label>
	<label>Saída: <input type="text" class="form-control input-sm" disabled name="trabalho_saida" size="10" onfocus="$(this).mask('99:99')" value="<?php echo $trabalho_saida ?>"></label>
	<label>Descanso: <input type="text" class="form-control input-sm" disabled name="trabalho_descanso" size="15" value="<?php echo $trabalho_descanso ?>"></label>
	
	<label>Entrada sexta: <input type="text" class="form-control input-sm" disabled name="sexta_entrada" size="10" onfocus="$(this).mask('99:99')" value="<?php echo $sexta_entrada ?>"></label>
	<label>Refeição: <input type="text" class="form-control input-sm" disabled name="sexta_refeicao" size="10" onfocus="$(this).mask('99:99 - 99:99')" value="<?php echo $sexta_refeicao ?>"></label>
	<label>Saída: <input type="text" class="form-control input-sm" disabled name="sexta_saida" size="10" onfocus="$(this).mask('99:99')" value="<?php echo $sexta_saida ?>"></label>
	</div></div>
	</form>
	
	<div class="panel panel-primary"><div class="panel-heading">Beneficiários</div><div class="panel-body">
	<form class="form-inline" action="javascript:void(0)" onSubmit="post(this,'rh/lista-benef.php?ac=add&funcionario=<?php echo $id ?>','.benef')">
		<label> Nome: <input type="text" class="form-control input-sm" disabled name="nome" size="40"> </label>	
		<label> Parentesco: <input type="text" class="form-control input-sm" disabled name="parentesco" size="10"> </label>	
		<label> Nascimento: <input type="text" class="form-control input-sm" disabled name="nascimento" size="10" onfocus="$(this).mask('99/99/9999')"> </label>	
		
		<script>ldy("rh/lista-benef.php?funcionario=<?php echo $id ?>",".benef");</script>
		<div class="benef"></div>
	</form>
	</div></div>
	


<?php } ?>

</table>

<div class="ajax"></div>

