<?php
	
  	session_start();
	$inCaptcha = strtoupper(trim($_POST['txtSesionCaptcha']));
	
	if($inCaptcha == strtoupper($_SESSION["captcha"])){
		//Importante: Una vez utilizado el CAPTCHA es reemplazado por un texto largo para evitar un posible reintento
		$_SESSION["captcha"] = md5(rand()*time());

		$infCorreo = array(
			'nombre'=>addslashes(ucwords(mb_strtolower($_POST['txtNombre'], 'UTF-8'))),
			'apellido'=>addslashes(ucwords(mb_strtolower($_POST['txtApellido'], 'UTF-8'))),
			'remitente'=>$_POST['txtRemitente'],
			'destinatario'=>'morci.aguirre2017@gmail.com',
			'telefono'=>$_POST['txtTelefono'],
			'asunto'=>$_POST['txtAsunto'],
			'mensaje'=>addslashes($_POST["txtMensaje"]));	
		
		foreach ($infCorreo as $i => $value) {
			if(empty($infCorreo[$i])){
				echo "!Atenci&oacute;n! Falta completar el campo ".$i." en el formulario";
				die();
			}
		}
		
		$cabecera = "MIME-Version: 1.0\r\n";
		$cabecera .= "Content-Type: text/html; charset=utf-8\r\n";
		$cabecera .= "To: Marcela Edith Aguirre <morci.aguirre2017@gmail.com>\r\n";
		$cabecera .= "From: ".$infCorreo['nombre']." ".$infCorreo['apellido']." <".$infCorreo['remitente'].">\r\n";
		
		$msj = "Mi Tel&eacute;fono es ".$infCorreo['telefono'].". \r\n".$infCorreo['mensaje'];

			if(mail($infCorreo['destinatario'], $infCorreo['asunto'], $msj, $cabecera)){
				header("Location: index_contact.php?resultadoProceso=Su consulta se ha enviado correctamente. Gracias por contactarnos.");
			}else{
				header("Location: index_contact.php?resultadoProceso=Mensaje No se ha enviado");
			}
	}else{
		//Importante: Una vez utilizado el CAPTCHA es reemplazado por un texto largo para evitar un posible reintento
		$_SESSION["captcha"] = md5(rand()*time());
		header("Location: index_contact.php?resultadoProceso=El captcha que ha ingresado es incorrecto. Reintente nuevamente. Gracias.");
	}
?>