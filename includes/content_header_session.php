<?php

	require_once('process_crypt.php');

	//Funcion que rellena las cajas de texto del formulario de "Inicio de Sesion"
	function obtenerDatosRecordado(){
		$vectorRecordado = array("","","");
		if(isset($_COOKIE['id_user']) && isset($_COOKIE['llaveLocal'])){
			if($_COOKIE['id_user']!="" || $_COOKIE['llaveLocal']!=""){
				$consultaDB = consultarDB('SELECT * FROM usuarios WHERE id="'.$_COOKIE['id_user'].'" AND cookie="'.$_COOKIE['llaveLocal'].'" AND cookie<>""');
			}
			if(mysqli_num_rows($consultaDB)){
				$rowConsultaDB = mysqli_fetch_array($consultaDB);
				$vectorRecordado[0] = desencriptar($rowConsultaDB['usuario']);
				$vectorRecordado[1] = desencriptar($rowConsultaDB['clave']);
				$vectorRecordado[2] = "checked";
			}
			if($_COOKIE['id_user']!="" || $_COOKIE['llaveLocal']!=""){
		    mysqli_free_result($consultaDB);  
			}
		}
		return $vectorRecordado;
	}


	//Define el boton de Sesion: Si es "Iniciar Sesion" o "Cerrar Sesion"
	if(!isset($_SESSION['usuario'])){
		$varLabelSesion= "Administrador";
		$varFormAction = "";
		$varBotonAction1 = "button";
		$varBotonAction2 = "data-toggle=\"modal\" data-target=\"#pagModalSession\"";
	}else{
		$varLabelSesion= "Hola ".$_SESSION['nombre'];
		$varFormAction = "action=\"process_exit.php\" method=\"post\"";
		$varBotonAction1 = "submit";
		$varBotonAction2 = "";
	}
?>


    <!--===========================HEADER-LOGO===============================-->
		<div id="idPanelSesion">
		  	<!--==================SESSION===================-->
		  	<div class="col-12 col-md-2">
		  		<form class="col-12" <?php echo $varFormAction?>>
			        <label class="d-none d-md-block CsTextoCentradoChico"><?php echo $varLabelSesion?></label>
				   	<button type="<?php echo $varBotonAction1;?>" class="col-8 col-md-12 btn btn-primary btn-sm" <?php echo $varBotonAction2?>>
			   	   		<?php 
				   	   		if(!isset($_SESSION['usuario'])){
				   	   			echo '<span class="d-none d-md-block">Iniciar Sesi&oacute;n</span>';
			   	   				echo '<span class="d-block d-md-none CsLetraMasChica">Iniciar Sesi&oacute;n de Administrador</span>';
			   	   			}else{
			   	   				echo '<span>Cerrar Sesi&oacute;n</span>';
			   	   			}
			   	   		?>
			   	  	</button>
	   	  		</form>
			</div>

 		  	<!--================HEADER-LOGO=================-->
	     	<a href="index.php"><img src="img/logo.png" alt="Logo de P&aacute;gina" class="img-fluid animated flipInX" id="idImagenLogo"></a>
		</div>


      <!--==========================MODAL-SESSION==============================-->
		<div class="modal fade" id="pagModalSession" tabindex="-1" role="dialog" aria-labelledby="pagModalTituloSession" aria-hidden="true">
		  	<div class="modal-dialog" role="document">
		    	<div class="modal-content CsVentanaModalSesion">
			      	<div class="modal-header">
			        	<h5 class="modal-title" id="pagModalTituloSession">Inicio de Sesi&oacute;n</h5>
			        	<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			      	</div>
		      		<div class="modal-body">
								<form action="process_validate.php" method="post">
					        <div class="input-group CsEspaciadorVertical2">
										<span class="input-group-addon"><img src="img/svg/person.svg"></span>
					          <input type="text" class="form-control" name="txtSesionUsuario" placeholder="Escriba su Usuario" minlength="6" value="<?php echo obtenerDatosRecordado()[0];?>" required>
					        </div>
					        <div class="input-group CsEspaciadorVertical2">
					          <span class="input-group-addon"><img src="img/svg/lock.svg"></span>
					        	<input type="password" class="form-control" name="txtSesionClave" placeholder="Escriba su Clave" minlength="3" value="<?php echo obtenerDatosRecordado()[1];?>" required>
					        </div>
					        <div class="input-group CsEspaciadorVertical2">
					          <span class="input-group-addon">
					          	<img src="process_captcha.php" class="img-fluid rounded mr-2">
					          	<a href="#" onclick="location.reload();"><img src="img/svg/refresh.svg"></a>
					          </span>
					        	<input type="text" class="form-control" id="id_txtSesionCaptcha" name="txtSesionCaptcha" minlength="4" required>
            			</div>					         
					        <div class="form-check CsEspaciadorVertical2">
										<label class="form-check-label">
											<input type="checkbox" class="form-check-input" name="chkSesionRecordar" <?php echo obtenerDatosRecordado()[2];?>>Recordarme en este equipo
										</label>
									</div>
				          <div  style="display: block;">
				            <?php
				              if(isset($_GET['resultadoProceso'])){
				                echo '<p class="CsRespuestaEnviaMail animated infinite pulse">'.$_GET["resultadoProceso"].'</p>';
				              }
				            ?>
				          </div>
				      		<div class="modal-footer">
					      		<button type="submit" name="btnEnviar" class="btn btn-primary btn-block">Iniciar Sesi&oacute;n</button>
				      		</div>
		      			</form>
		   				</div>
					</div>
		  	</div>
		</div>