<?php
	session_start();
	
	//Define una llave aleatorio
	$llave = strtoupper(substr(md5(rand()*time()),0,4));
	$llave = str_replace("O","B", $llave);
	$llave = str_replace("0","C", $llave);
	$llave = str_replace("I","1", $llave);
	$llave = str_replace("L","1", $llave);
	$_SESSION['captcha'] = $llave;
	
	//Dibuja un fondo de color aleatorio
	$imagen = imagecreatetruecolor(100,30) or die('Error. No se puedo crear la imagen del CAPTCHA');
	$colorDeFondo = imagecolorallocate($imagen, rand(164,192), rand(164,192), rand(164,192));
	imagefill($imagen, 0, 0, $colorDeFondo);

	//Dibuja algunas lineas de color y ubicación aleatoria
	for($i=0; $i<15; $i++){
		$colorDeLinea = imagecolorallocate($imagen, rand(92,128), rand(92,128), rand(92,128));
		imageline($imagen, rand(0,100), rand(0,30), rand(0,100), rand(0,30), $colorDeLinea);
	}

	//Dibuja un texto de color y posición aleatoria
	$fuente1 = 'font/Ranchers-Regular.ttf';
	$fuente2 = 'font/BerkshireSwash-Regular.ttf';
	for($i=0; $i<strlen($llave); $i++){
		$colorDeTexto = imagecolorallocate($imagen, rand(64,92), rand(64,92), rand(64,92));
		if(file_exists($fuente1) && file_exists($fuente2)){
			$x=4+$i*23+rand(0,6);
			$y=rand(18,28);
			imagettftext($imagen, 18, rand(-25,25), $x, $y, $colorDeTexto, (($i>2)? $fuente1 : $fuente2), $llave[$i]);
		}else{
			$x=4+$i*24+rand(0,6);
			$y=rand(1,18);
			imagestring($imagen, 18, $x, $y, $llave[$i], $colorDeTexto);
		}
	}

	//Aplicar un efecto borroso
	//$efecto = array(array(1.0, 2.0, 1.0), array(2.0, 4.0, 2.0), array(1.0, 2.0, 1.0));
	//imageconvolution($imagen, $efecto, 15, 30);


	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Cache-Control: private",false); 
	header('Content-type: image/png');
	imagepng($imagen);
	imagedestroy($imagen);
?>