<?php 

  //Pagina Protegida: Control de sesion de Administrador. 
  session_start();
  if (!isset($_SESSION['usuario'])){
    echo '<script type="text/javascript"> alert("Para acceder a este contenido tiene que estar logueado"); window.location="index.php";</script>';
  }

  include('includes/struct_head.php');
  require('includes/conexionDB.php');
  require_once('process_encodeHTML.php');
?>

    <!--==============================HEADER=================================-->
    <header>
      <?php include('includes/content_header_session.php');?>
      <?php include('includes/content_header_menu.php');?>
    </header> 

    <!--=============================SECTION=================================-->
    <section class="container">
      <?php include('process_date.php');?>
      <div class="row">
        <h4 class="CsSeccionTitulo animated tada">Eventos Realizados</h4>
      </div>
        <!--=============FORM-PRODUCTO=============-->
        <form id="idFormulario" action="process_event.php" method="post" enctype="multipart/form-data" autocomplete="on">
          <div id="id_MensajeAlerta"><?php
              if(isset($_GET['resultadoProceso'])){
                echo '<p class="CsRespuestaProceso animated infinite pulse">'.$_GET["resultadoProceso"].'</p>';
              }
          ?></div>
          <div class="form-group row">
            <div class="col-4 col-md-2 input-group CsEspaciadorVertical1">
              <span class="input-group-addon">Id</span>
              <input type="text" class="form-control text-center" id="id_txtID" name="txtID" readonly>
            </div>
            <div class="col-8 col-md-4 input-group CsEspaciadorVertical1">
              <span class="input-group-addon">Fecha</span>
              <input type="date" class="form-control" id="id_txtFecha" name="txtFecha" 
                value="<?php echo formatearFecha(date("d-m-Y"));?>" required>
            </div>
            <div class="col-12 offset-md-2 col-md-4 input-group">
              <span class="input-group-addon">Estado</span>
              <select id="id_cmbEstado" name="cmbEstado" class="form-control" required>
                <option value="" disabled selected>Seleccione un Estado</option>
                <option value="ACTIVADO">ACTIVADO</option>
                <option value="SUSPENDIDO">SUSPENDIDO</option>
              </select>          
            </div>            
          </div>
          <div class="form-group row">
            <div class="col-12 col-md-6 input-group CsEspaciadorVertical1">
              <span class="input-group-addon">Titulo</span>
              <input type="text" class="form-control" id="id_txtTitulo" name="txtTitulo" placeholder="Escriba el titulo del Evento" maxlength="35" required>
            </div>
            <div class="col-12 col-md-6 input-group">
              <span class="input-group-addon">Subtitulo</span>
              <input type="text" class="form-control" id="id_txtSubTitulo" name="txtSubTitulo" placeholder="Escriba el subtitulo del Evento" maxlength="75" required>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-12 input-group">
              <span class="input-group-addon">Descripci&oacute;n</span>
              <textarea class="form-control" id="id_txtDescripcion" name="txtDescripcion" placeholder="Escriba una descripci&oacute; sobre el Evento" maxlength="1000" rows="4"></textarea>
            </div>
          </div>     
          <div class="form-group row" style="margin-bottom: -0.05%;">
            <?php
            for ($i=1; $i<7; $i++) { 
            echo
            '<!-- =========FOTOGRAFIA'.$i.'========= -->
            <div class="col-12 col-md-4 mb-3">
              <div class="card bg-ligth text-center">
                <div class="card-header CsFotografiaTitulo">
                  <span class="float-center float-center">Fotograf&iacute;a '.$i.'</span>
                  <button type="button" class="btn btn-secondary btn-sm float-right" 
                  onclick=\'deseleccionarImagen("id_panelImagen'.$i.'", "id_fileFotografia'.$i.'", "id_txtFotoControlador'.$i.'");\'>x</button>
                </div>
                <div class="card-title CsFotografiaCuerpo">
                  <img class="CsFotografiaCuerpoImg" src="" alt="Imágen del Evento" id="id_panelImagen'.$i.'" name="panelImagen'.$i.'">
                  <input type="hidden" id="id_txtFotografiaRuta'.$i.'" name="txtFotografiaRuta'.$i.'">
                  <input type="hidden" id="id_txtFotoControlador'.$i.'" name="txtFotoControlador'.$i.'">
                </div>
                <div class="card-footer CsFotografiaFooter">
                  <input type="file" class="col-12 CsFotografiaFooterBoton" id="id_fileFotografia'.$i.'" name="fileFotografia'.$i.'" accept="image/jpeg" onchange=\'seleccionarImagen(this, "id_panelImagen'.$i.'", "id_txtFotoControlador'.$i.'");\'>
                </div>
              </div>
            </div>';
            }
            ?>
          </div>
          <div class="row">
            <input type="hidden" id="id_txtControladorDeBoton" name="txtControladorDeBoton">
            <div class="col-4 CsEspaciadorVertical2">
              <button type="button" id="id_btnEliminar" name="btnEliminar" class="btn btn-danger btn-block CsBoton CsLetraMasChica"
              onmousedown="validarBoton('Eliminar', document.getElementById('id_txtTitulo').value);">Eliminar</button>
            </div>
            <div class="col-4 CsEspaciadorVertical2">
              <button type="button" id="id_btnGrabar" name="btnGrabar" class="btn btn-danger btn-block CsBoton CsLetraMasChica"
              onmousedown="validarBoton('Guardar', document.getElementById('id_txtTitulo').value);">Guardar</button>
            </div>
            <div class="col-4 CsEspaciadorVertical2">
              <button type="reset" name="btnCancelar" class="btn btn-danger btn-block CsBoton CsLetraMasChica" onclick="cancelarEvento();">Cancelar</button>
            </div>
          </div>
        </form>

        <!--===============SEPARADOR==============-->
        <div class="col-12">
          <hr class="CsSeparador"> 
        </div>

        <!--============TABLE-PRODUCTO============-->
        <div class="CsEspaciadorVertical1"> 
          <div class="row">
            <div class="col-12">
              <div class="d-flex">
                <input type="text" id="id_txtBusqueda" class="col-12 CsBusquedaTransparente" placeholder="Buscar Evento" onkeyup="buscarElementoSimple('idListaNombre','SINGULAR')">
              </div>
            </div>
          </div>

          <table id="idTablaResponsive">
            <thead>
              <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col">Evento</th>
                <th scope="col">Sub Titulo</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody >
                <?php 
                  $consultaDB = consultarDB("SELECT * FROM eventos ORDER BY titulo");
                  while ($i = mysqli_fetch_array($consultaDB)){
                    $codigo = $i["id"];
                    echo
                    '<tr>
                      <th class="text-center" id="idListaID'.$codigo.'" onclick="mostrarEvento('.$codigo.');">'.$i["id"].'</th>
                      <td id="idListaNombre'.$codigo.'" onclick="mostrarEvento('.codificarHTML($codigo).');">'.$i["titulo"].'</td>
                      <td id="idListaSubNombre'.$codigo.'" onclick="mostrarEvento('.codificarHTML($codigo).');">'.$i["subtitulo"].'</td>
                      <td id="idListaDescripcion'.$codigo.'" hidden>'.str_replace("\r\n", "<br>", codificarHTML($i["descripcion"])).'</td>
                      <td id="idListaImagen1'.$codigo.'" hidden>'.$i["imagen1"].'</td>
                      <td id="idListaImagen2'.$codigo.'" hidden>'.$i["imagen2"].'</td>
                      <td id="idListaImagen3'.$codigo.'" hidden>'.$i["imagen3"].'</td>
                      <td id="idListaImagen4'.$codigo.'" hidden>'.$i["imagen4"].'</td>
                      <td id="idListaImagen5'.$codigo.'" hidden>'.$i["imagen5"].'</td>
                      <td id="idListaImagen6'.$codigo.'" hidden>'.$i["imagen6"].'</td>
                      <td id="idListaEstado'.$codigo.'" hidden>'.$i["estado"].'</td>
                      <td id="idListaFecha'.$codigo.'" hidden>'.formatearFecha($i["fecha"]).'</td>
                      <td class="text-right" id="idListaBoton'.$codigo.'" onclick="mostrarEvento('.$codigo.');">
                        <img src="img/svg/edit_white.svg" data-toggle="tooltip" data-placement="left" title="Editar Evento">
                      </td>
                    </tr>';
                  }
                  mysqli_free_result($consultaDB);
                ?>
            </tbody>
          </table>
        </div>
    </section>


    <!--==============================FOOTER=================================-->
    <?php
      include('includes/content_table_promotions.php');
      include('includes/struct_footer.php');
    ?>

  </body>
</html>
