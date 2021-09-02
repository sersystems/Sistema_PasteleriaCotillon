<?php
    session_start();
    include('includes/struct_head.php');
    require('includes/conexionDB.php');
?>

    <!--==============================HEADER=================================-->
    <header>
      <?php
          include('includes/content_header_session.php');
          include('includes/content_header_menu.php');?>
    </header>
  
    <!--=============================SECTION=================================-->
    <section class="container">
      <div class="row">
        <h4 class="CsSeccionTitulo animated tada">Cont&aacute;ctenos</h4>
      </div>
      <form action="process_mail.php" method="post" autocomplete="on">
          <div id="id_MensajeAlerta"><?php
              if(isset($_GET['resultadoProceso'])){
                echo '<p class="CsRespuestaProceso animated infinite pulse">'.$_GET["resultadoProceso"].'</p>';
              }
          ?></div>
          <div class="form-group row">
            <div class="col-12 col-md-6 input-group CsEspaciadorVertical1">
              <span class="input-group-addon"><img src="img/svg/person.svg"></span>
              <input type="text" class="form-control" name="txtNombre" placeholder="Escriba su Nombre" maxlength="25" required>
            </div>
            <div class="col-12 col-md-6 input-group">
              <span class="input-group-addon"><img src="img/svg/person_outline.svg"></span>
              <input type="text" class="form-control" name="txtApellido" placeholder="Escriba su Apellido" maxlength="25" required>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-12 col-md-8 input-group CsEspaciadorVertical1">
              <span class="input-group-addon"><img src="img/svg/email.svg"></span>
              <input type="email" class="form-control" name="txtRemitente" placeholder="Escriba su E-mail" maxlength="75" required>
            </div>
            <div class="col-12 col-md-4 input-group">
              <span class="input-group-addon"><img src="img/svg/phone.svg"></span>
              <input type="phone" class="form-control" name="txtTelefono" placeholder="Escriba su Tel&eacute;fono" maxlength="15" required>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-12 input-group">
              <span class="input-group-addon"><img src="img/svg/comment.svg"></span>
              <input type="text" class="form-control" name="txtAsunto" placeholder="Escriba su Asunto" maxlength="75" required>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-12 input-group">
              <span class="input-group-addon"><img src="img/svg/edit.svg"></span>
              <textarea class="form-control" name="txtMensaje" placeholder="Escriba su Consulta" rows="3" required></textarea>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-12 input-group">
              <span class="input-group-addon">
                <img src="process_captcha.php" class="img-fluid rounded mr-2">
                <a href="#" onclick="location.reload();"><img src="img/svg/refresh.svg"></a>
              </span>
              <input type="text" class="form-control" name="txtSesionCaptcha" minlength="4" required>
            </div>
          </div> 
          <div class="row">
            <div class="col-12 CsEspaciadorVertical2">
              <button type="submit" name="btnEnviar" class="btn btn-danger btn-block CsBoton">Enviar Consulta</button>
            </div>
          </div>
        </form>
        
        <!--===============SEPARADOR==============-->
        <div class="col-12">
          <hr class="CsSeparador"> 
        </div>

        <div class="row CsPanelContacto">
          <div class="col-12 col-lg-8">
            <div class="card CsPanelContactoCard CsEspaciadorVertical1">
              <div class="card-body">
                <h4 class="card-title CsPanelContactoCardTitulo">Huellas Cotill&oacute;n y Candy Bar</h4>
                <address>
                  <div>
                    <p>Domicilio: Loteo Fullana, Casa 9, Rawson - San Juan - Argentina.</p>
                    <p><span><img src="img/icon_whatsapp.png" alt="whatsapp" class="CsIconoSocial"/> Tel&eacute;fono: 264-5113176 / 264-5109377</span></p>
                    <p><a href="https://www.facebook.com/huellascotillon">
                      <img src="img/icon_facebook.png" alt="Facebook" class="CsIconoSocial"/> Encontranos en Facebook</a></p>
                  </div>
                </address>
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-4">
            <div class="card CsPanelContactoCard">
              <div class="card-body text-center">
                <iframe src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d1699.2899918720495!2d-68.5332351419704!3d-31.590563910594096!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x96813fe6de041247%3A0x2ea1bc279ed9a828!2sUnnamed+Road%2C+Villa+Krause%2C+San+Juan!3m2!1d-31.590566199999998!2d-68.5321408!5e0!3m2!1ses!2sar!4v1511150782236" style="border:0" allowfullscreen class="col-12 card"></iframe>
              </div>
            </div>
          </div>
        </div>
    </section>


    <!--==============================FOOTER=================================-->
    <?php include('includes/struct_footer.php');?>

  </body>
</html>
