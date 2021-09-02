<?php

	session_start();
 	require('includes/conexionDB.php');
    require('process_crypt.php');

	$inCaptcha = strtoupper(trim($_POST['txtSesionCaptcha']));
	$inUsuario = encriptar(strtolower($_POST['txtSesionUsuario']));
	$inClave = encriptar(strtolower($_POST['txtSesionClave']));

	if($inCaptcha == strtoupper($_SESSION["captcha"])){
		//Importante: Una vez utilizado el CAPTCHA es reemplazado por un texto largo para evitar un posible reintento
		$_SESSION["captcha"] = md5(rand()*time());

		//Verifica que se los datos introducidos correspondan a algun usuario.
		$consultaDB = consultarDB('SELECT * FROM usuarios WHERE usuario="'.$inUsuario.'" AND clave="'.$inClave.'"');
		if (mysqli_num_rows($consultaDB)==0){
			?><script type="text/javascript"> alert("Usuario y/o password inexistente"); window.location="index.php";</script><?php
		}else{
			$rowConsultaDB = mysqli_fetch_assoc($consultaDB);
			$idUsuario = $rowConsultaDB['id'];

				//Verifica que se ha recibido el valor del Check "Recordarme en este equipo".
				if(isset($_POST['chkSesionRecordar']) && $_POST['chkSesionRecordar']== true){
					//Si se ha tildado el Check "Recordarme en este equipo" y asigna los datos a las cookies.
					mt_srand(time());	//Semilla
					$llaveAleatoria = mt_rand(1000000,9999999); //Genera un numero aleatorio
			    		$updateDB = consultarDB("UPDATE usuarios SET cookie=\"".$llaveAleatoria."\" WHERE id=\"".$idUsuario."\"");
			    		setcookie("id_user", $idUsuario, time() + 90*24*60*60); //Existira por 90 dias
			    		setcookie("llaveLocal", $llaveAleatoria, time() + 90*24*60*60); //Existira por 90 dias
				}else{
					//No se ha tildado el Check "Recordarme en este equipo". Elimina las cookies.
					unset($_COOKIE['id_user']);
					setcookie("id_user", '', time() - 3600);
					unset($_COOKIE['llaveLocal']);
					setcookie("llaveLocal", '', time() - 3600);
				}

			$_SESSION['nombre'] = $rowConsultaDB['nombre'];
			$_SESSION['usuario'] = $inUsuario;
			$_SESSION['clave'] = $inClave;
		    mysqli_free_result($consultaDB);
			header("Location: index.php?");
		}

	}else{
		//Importante: Una vez utilizado el CAPTCHA es reemplazado por un texto largo para evitar un posible reintento
		$_SESSION["captcha"] = md5(rand()*time());
		?><script type="text/javascript"> alert("El captcha ingresado es incorrecto. Por favor reintente nuevamente."); window.location="index.php";</script><?php
	}
?>