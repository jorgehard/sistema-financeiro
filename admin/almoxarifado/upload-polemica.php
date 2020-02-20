<?php 
	include("../config.php");
	$output_dir = "uploads/";
	if($_FILES["myfile"]["name"]) {
		unlink("uploads/$img");
		$fileName = $_FILES["myfile"]["name"];
		$extensao = strtolower(end(explode(".", $fileName)));
		$fil = md5(date("dmYHis")) . '_' . md5($fileName) . '.' . $extensao;
		move_uploaded_file($_FILES["myfile"]["tmp_name"],$output_dir.$fil);	
		# Caminho da imagem a ser redimensionada: 
		$input_image = $output_dir.$fil;
		// Pega o tamanho original da imagem e armazena em um Array:
		$size = getimagesize( $input_image );
		// Configura a nova largura da imagem:
		$thumb_width = "250";
		// Calcula a altura da nova imagem para manter a proporção na tela: 
		$thumb_height = ( int )(( $thumb_width/$size[0] )*$size[1] );
		// Cria a imagem com as cores reais originais na memória.
		$thumbnail = ImageCreateTrueColor( $thumb_width, $thumb_height );
		// Criará uma nova imagem do arquivo.
		$src_img = ImageCreateFromJPEG( $input_image );
		// Criará a imagem redimensionada:
		ImageCopyResampled( $thumbnail, $src_img, 0, 0, 0, 0, $thumb_width, $thumb_height, $size[0], $size[1] );
		// Informe aqui o novo nome da imagem e a localização:
		ImageJPEG( $thumbnail, $output_dir.$fil);
		// Limpa da memoria a imagem criada temporáriamente: 
		ImageDestroy( $thumbnail ); 
	}
	mysql_query("update notas_itens set descricao = '$descricao',categoria='$categoria',oculto='$oculto' where id = '$id'");
	echo '<script>window.top.window.ldy("almoxarifado/consulta-materiais-polemica.php",".conteudo")</script>';
?>