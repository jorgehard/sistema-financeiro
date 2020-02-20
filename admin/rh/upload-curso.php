<?php 
	require_once('../config.php');
	$img = $_FILES['anexo'];
	
	define ("filesplace","uploads_rh");

	if (is_uploaded_file($_FILES['anexo']['tmp_name'])) {
		$maxsize = 8388608;
		if(($_FILES['anexo']['size'] >= $maxsize) || ($_FILES['anexo']["size"] == 0)) {
			echo "<p><script>alert('Permitido somente arquivos menores de 8mb'); window.close();</script></p>";
			exit;
		}
		if ($_FILES['anexo']['type'] != "application/pdf") {
			echo "<p><script>alert('Permitido somente envio de PDF, favor tente novamente'); window.close();</script></p>";
			exit;
		} else {
			$nome_pdf = "funcionario".$funcionario."-".md5(uniqid(time()));
			$result = move_uploaded_file($_FILES['anexo']['tmp_name'], filesplace."/$nome_pdf.pdf");
			if ($result == 1) {
				$sql = mysql_query("insert into rh_historico_cursos (funcionario, data, vencimento, obs, curso, anexo) values ('$funcionario', '$data', '$vencimento', '$obs', '$curso', '$nome_pdf')");
				if($sql) { 
					echo '<h3 class="alert-success" style="margin:0px auto; padding:20px;">Informações alteradas com <strong>sucesso</strong>!!<br/><br/></h3>';
					echo '<script>alert("Historico de curso cadastrado com sucesso!! Atualize a pagina"); window.close();</script>';
				} else { 
					echo '<script>alert("Algo deu errado, favor verificar e tentar novamente"); window.close();</script>';
				} 
			} else {
				echo "<p>Algo aconteceu de errado. </p>";
			}
		}
	}	
?>	