<?php
	session_start();
	require('includes/conexionDB.php');

	$vecDatos = array(
		'idPromocion'=>$_POST['txtID'],
		'titulo'=>addslashes(ucwords(mb_strtolower($_POST['txtTitulo'], 'UTF-8'))),
		'rubro'=>$_POST['cmbRubro'],
		'costo'=>$_POST['txtCosto'],
		'precio'=>$_POST['txtPrecio'],
		'precio_visible'=>$_POST['cmbPrecioVisible'],
		'margen'=>$_POST['txtMargen'],
		'descripcion'=>	addslashes($_POST['txtDescripcion']),
		'imagen1'=>$_POST['txtFotografiaRuta1'],
		'estado'=>$_POST['cmbEstado'],
		'fecha'=>date('Y-m-d', strtotime($_POST['txtFecha'])),
		'creacion'=>date('Y-m-d'));

	$vecFotos = array();
	for ($i=1; $i<2; $i++) { 
		$vecFotos['nombre'.$i] = $_FILES['fileFotografia'.$i]['name'];
		$vecFotos['tipo'.$i] = $_FILES['fileFotografia'.$i]['type'];
		$vecFotos['size'.$i] = $_FILES['fileFotografia'.$i]['size'];
		$vecFotos['tmp'.$i] = $_FILES['fileFotografia'.$i]['tmp_name'];
		$vecFotos['ruta'.$i] = 'img/upload/';
		$vecFotos['destino'.$i] = 'img/upload/'.$_FILES['fileFotografia'.$i]['name'];
	}

	if (!empty($vecDatos['idPromocion'])){
		if ($_POST['txtControladorDeBoton'] == "Eliminar") {
			//1°: Eliminacion de la imagenes asociadas al registro.
			$consultaDB = consultarDB("SELECT * FROM promociones WHERE id=\"".$vecDatos['idPromocion']."\"");
			while ($row = mysqli_fetch_array($consultaDB, MYSQLI_ASSOC)){
               	for ($i=1; $i<2 ; $i++) { 
               		eliminarImagen($vecDatos['imagen'.$i]);
				}
				//2°: Eliminacion del archivo PHP asociada al registro.
				if (is_file($row["pagina"])) {
					unlink($row["pagina"]);
				}
			}
            mysqli_free_result($consultaDB);

			//3°: Eliminacion de un registro existente
			consultarDB("DELETE FROM promociones WHERE id=\"".$vecDatos['idPromocion']."\"");
			header("Location: index_admin_promotion.php?resultadoProceso=El registro se ha eliminado correctamente");
		
		}else{

			//Modificacion de un registro existente
			$rutaDeImagen = array('picture1'=>'');
			for ($i=1; $i<2; $i++) {
				if ($vecFotos['size'.$i]>0 && empty($vecDatos['imagen'.$i])) {
				//Accion: Agregar una imagen en un panel vacio
					$rutaDeImagen['picture'.$i] = subirImagen($vecFotos['size'.$i], $vecFotos['tipo'.$i], $vecFotos['ruta'.$i], $vecFotos['tmp'.$i], $vecFotos['destino'.$i]);
				}elseif ($vecFotos['size'.$i]>0 && !empty($vecDatos['imagen'.$i])) {
				//Accion: Modificar una imagen en un panel ocupado
					eliminarImagen(trim($vecDatos['imagen'.$i]));
					$rutaDeImagen['picture'.$i] = subirImagen($vecFotos['size'.$i], $vecFotos['tipo'.$i], $vecFotos['ruta'.$i], $vecFotos['tmp'.$i], $vecFotos['destino'.$i]);
				}elseif ($vecFotos['size'.$i]<=0 && !empty($vecDatos['imagen'.$i])) {
					if($_POST['txtFotoControlador'.$i] == "BASURA"){
					//Accion: Eliminar una imagen del panel
						eliminarImagen(trim($vecDatos['imagen'.$i]));		
					}else{
					//Accion: Conservar una imagen del panel
						$rutaDeImagen['picture'.$i] = $vecDatos['imagen'.$i];
					}
				}
			}

			consultarDB("UPDATE promociones SET 
			 	titulo=\"".$vecDatos['titulo']."\"
			 	, rubro=\"".$vecDatos['rubro']."\"
			 	, costo=\"".$vecDatos['costo']."\"
			 	, precio=\"".$vecDatos['precio']."\"
			 	, precio_visible=\"".$vecDatos['precio_visible']."\"
			 	, margen=\"".$vecDatos['margen']."\"
			 	, descripcion=\"".$vecDatos['descripcion']."\"
			 	, imagen1=\"".($rutaDeImagen['picture1'])."\" 
			 	, estado=\"".$vecDatos['estado']."\" 
			 	, fecha=\"".$vecDatos['fecha']."\" 
				WHERE id=\"".$vecDatos['idPromocion']."\"");
			header("Location: index_admin_promotion.php?resultadoProceso=El registro se ha modificado correctamente");
		}

	}else{

		//Creacion de un registro nuevo
		$rutaDeImagen1 = subirImagen($vecFotos['size1'], $vecFotos['tipo1'], $vecFotos['ruta1'], $vecFotos['tmp1'], $vecFotos['destino1']);
		$archivoPHP = "promo".rand(1000, 9999).date('dmY').".php";
        $nuevoPHP = fopen($archivoPHP, 'w+');
        fclose($nuevoPHP);
		consultarDB("INSERT INTO promociones (titulo, rubro, costo, precio, precio_visible, margen, descripcion, imagen1, pagina, estado, fecha, creacion)  VALUES 
			(\"".$vecDatos['titulo']."\"
			, \"".$vecDatos['rubro']."\"
			, \"".$vecDatos['costo']."\"
			, \"".$vecDatos['precio']."\"
			, \"".$vecDatos['precio_visible']."\"
			, \"".$vecDatos['margen']."\"
			, \"".$vecDatos['descripcion']."\"
			, \"".((empty($rutaDeImagen1))? "" : $rutaDeImagen1)."\" 
			, \"".$archivoPHP."\"
			, \"".$vecDatos['estado']."\" 
			, \"".$vecDatos['fecha']."\"
			, \"".$vecDatos['creacion']."\")");
		header("Location: index_admin_promotion.php?resultadoProceso=El registro se ha insertado correctamente");
	}

	//==========================FUNCIONES DE IMAGEN==========================
	function subirImagen($tamanio, $tipo, $ruta, $tmp, $destino){
		if ($tamanio > 0) {
			if ($tipo=="image/jpeg") {
				if ($tamanio<=2500000) {
					
					//Paso 1: Abre el directorio de trabajo.
					opendir($ruta);
					
					//Paso 2: Mueve la imagen a la carpeta indicada como destino.
					move_uploaded_file($tmp, $destino);
					
					//Paso 3: Generar un nuevo nombre de archivo.
					$extensionDeArchivo = substr($destino, -4);
					$nombreDeArchivosAleatorio = count(glob("img/upload/{*.jpeg,*.jpg,*.png}",GLOB_BRACE)).rand(100000, 999999);
					$nombreDeArchivo = $ruta."promo".$nombreDeArchivosAleatorio.$extensionDeArchivo;
					

					//Paso 4: Crea una copia estandarizada de la imagen original con nuevo nombre
				    $imgFormato = imagecreatetruecolor(1024, 768);
				    $imgSubida = imagecreatefromjpeg($destino);
				    $y = imagesy($imgSubida);
				    $x = imagesx($imgSubida);
				    if ($x<$y){	//Detecta imagen VERTICAL
					    $a = (100/$y)*($y-768);    	//Calcula el porcentaje para Y en relacion a 768px 
					    $setX = $x-(($x/100)*$a);  	//Calcula el tamaño para X segun el porcentaje de Y
					    $centerX = (1024-$setX)/2;	//Calcula el margen izquierdo para centrar imagen
					    imagecopyresampled($imgFormato, $imgSubida, $centerX, 0, 0, 0, $setX, 768, $x, $y);
					}else{	//Detecta imagen HORIZONTAL
					    imagecopyresampled($imgFormato, $imgSubida, 0, 0, 0, 0, 1024, 768, $x, $y);
					}
					
					//Paso 5: Inserta el logo a la nueva imagen 
					$imgLogo = imagecreatefrompng('img/logo_para_fotos.png');
					$x2 = imagesx($imgLogo);
					$y2 = imagesy($imgLogo);
					imagecopyresampled($imgFormato, $imgLogo, 362, 465, 0, 0, 300, 175, $x2, $y2);
					imagejpeg($imgFormato, $nombreDeArchivo, 75);

					unlink($destino);
					imagedestroy($imgSubida); 
					imagedestroy($imgFormato); 
					imagedestroy($imgLogo);

					//Paso 6: Crea una segunda copia minimizada de la imagen original 
					$imgNuevaNormal = imagecreatefromjpeg($nombreDeArchivo);
					$imgNuevaMinimizada = imagecreatetruecolor(400, 300);
					$x = imagesx($imgNuevaNormal);
					$y = imagesy($imgNuevaNormal);
					imagecopyresampled($imgNuevaMinimizada, $imgNuevaNormal, 0, 0, 0, 0, 400, 300, $x, $y);
					$imgNombre = str_replace(".jpg", "_min.jpg", $nombreDeArchivo);
					imagejpeg($imgNuevaMinimizada, $imgNombre);
					chmod($imgNombre, 0644);

					return $nombreDeArchivo;

				}else{ header("Location: index_admin_promotion.php?resultadoProceso=Error, el archivo no debe superar los 2MB."); }
			}else{ header("Location: index_admin_promotion.php?resultadoProceso=Error, el archivo debe ser de tipo JPG"); }
		}
	}

	function eliminarImagen($imagen){
		if (is_file($imagen)){
			unlink($imagen);
			$imagenMinimizada = str_replace(".jpg", "_min.jpg", $imagen);
			if (is_file($imagenMinimizada)){
				unlink($imagenMinimizada);
			}
		}
	}
?>