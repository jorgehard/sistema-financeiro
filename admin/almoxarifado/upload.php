<?php 
	require_once('../config.php');

	$img = $_FILES['myfile'];
	
	if($img['name']==''){  
		$descricao = str_replace("'", "", $descricao); $descricao = str_replace(";", "", $descricao);$descricao = str_replace('"', '', $descricao);
		$query = mysql_query("UPDATE ss_materiais SET descricao = '$descricao',codigo='$codigo',valor='$valor',status='$status', maximo='$maximo', tipo='0' where id = '$id'");
		if($query) { 
			echo '<h3 class="alert-success" style="margin:0px auto; padding:20px;">Informações alteradas com <strong>sucesso</strong>!!<br/><br/> Atualize a pagina</h3>';
			echo '<script>alert("Alterada com Sucesso!!"); window.close();</script>';
		} else { 
			echo '<script>alert("Codigo ja cadastrado no sistema, favor verificar a lista de materiais"); window.close();</script>';
		} 
		exit;
	}else{
		$filename = $img['tmp_name'];
		$client_id="98451855b52ba23";
		$handle = fopen($filename, "r");
		$data = fread($handle, filesize($filename));
		$pvars   = array('image' => base64_encode($data));
		$timeout = 50;
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
		curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
		$out = curl_exec($curl);
		curl_close ($curl);
		$pms = json_decode($out,true);
		$url=$pms['data']['link'];
		if($url!=""){
			$descricao = str_replace("'", "", $descricao); $descricao = str_replace(";", "", $descricao);$descricao = str_replace('"', '', $descricao);
			$query = mysql_query("update ss_materiais set imagem = '$url', descricao = '$descricao',codigo='$codigo',valor='$valor',status='$status', maximo='$maximo', tipo='1' where id = '$id'");
			if($query) { 
				echo '<h3 class="alert-success" style="margin:0px auto; padding:20px;">Informações alteradas com <strong>sucesso</strong>!!<br/><br/> Atualize a pagina</h3>';
				echo '<script>alert("Alterada com Sucesso!!"); window.close();</script>';
			} else { 
				echo '<script>alert("Codigo ja cadastrado no sistema, favor verificar a lista de materiais"); window.close();</script>';
			} 
			echo '<h3 class="alert-success" style="margin:0px auto; padding:20px;">Foto enviada!! Atualize a pagina</h3>';
			echo '<img src="'.$url.'" />';
			exit;
		}else{
			if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $img["type"])){
				$error[1] = "Isso não é uma imagem.";
			} 
			if (count($error) == 0) {
				preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $img["name"], $ext);
				
				$nome_imagem = "material".$codigo."-".md5(uniqid(time())) . "." . $ext[1];
				$destino_imagem = "uploads_sabesp/" . $nome_imagem;
				//
				list($width, $height) = getimagesize($img['tmp_name']);
				$newwidth = 600;
				$newheight = (int)(($height/$width) * $newwidth);
				
				$info = getimagesize($img['tmp_name']);
				$thumb = imagecreatetruecolor($newwidth, $newheight);
				
				if ($info['mime'] == 'image/jpeg') {
					$source = imagecreatefromjpeg($img['tmp_name']);
				}else if ($info['mime'] == 'image/gif') {
					$source = imagecreatefromgif($img['tmp_name']);
				}else if ($info['mime'] == 'image/png') {
					$source = imagecreatefrompng($img['tmp_name']);
				}else{
					exit;
				}
				imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
				imagejpeg( $thumb, $destino_imagem , 50 ); 
				$descricao = str_replace("'", "", $descricao); $descricao = str_replace(";", "", $descricao);$descricao = str_replace('"', '', $descricao);
				$sql = mysql_query("update ss_materiais set imagem = '$nome_imagem', descricao = '$descricao',codigo='$codigo',valor='$valor',status='$status', maximo='$maximo', tipo='2' where id = '$id'");
				if($sql) { 
					echo '<h3 class="alert-success" style="margin:0px auto; padding:20px;">Informações alteradas com <strong>sucesso</strong>!!<br/><br/> Atualize a pagina</h3>';
					echo '<script>alert("Alterada com Sucesso!!"); window.close();</script>';
				} else { 
					echo '<script>alert("Codigo ja cadastrado no sistema, favor verificar a lista de materiais"); window.close();</script>';
				} 
				exit;
			}
			if (count($error) != 0) {
				foreach ($error as $erro) {
					echo $erro . "<br />";
				}
			}
			echo "<h2>Ouve algum problema!! Tente novamente</h2>";
			echo $pms['data']['error'];  
		} 
	}
?>	