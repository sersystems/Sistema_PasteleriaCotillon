<?php 
  session_start();
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
      <?php include('process_create_page_event.php');?>
      <?php include('process_date_full.php');?>
      <div class="row">
        <h4 class="CsSeccionTitulo animated tada">Galer&iacute;a</h4>
      </div>
      <div class="col-12">
        <?php 
          include('process_pagination.php');
          crearPaginacion('eventos', 'index_gallery.php', 10);
        ?>
      </div>
        <?php
          $contador = 0;
          $consultaDB = consultarDB("SELECT * FROM eventos WHERE estado='ACTIVADO' ORDER BY fecha DESC LIMIT ".paginarConsulta(10));
          while ($row = mysqli_fetch_array($consultaDB, MYSQLI_ASSOC)){
            $contador += 1;
            $carruselNombre = "idCarrusel".$contador;
            $carruselItem = "";
            $activo = "active";
            $paginaContador = 0;
            $paginaIndicador = "";
            $paginaCarrusel = "";
            $imagenHTML = array();
            for ($i=1; $i<7; $i++) { 
              $origen = $row["imagen".$i];
              $origenMin = str_replace(".jpg", "_min.jpg", trim($row["imagen".$i]));
              if (!empty($origen)){
                $carruselItem .= 
                '<div class="carousel-item CsPanelImagenPublicacion '.$activo.'">'."\r\n".
                  '<img class="Csimagen" src="'.$origenMin.'" alt="Foto'.$contador.$i.'">'."\r\n".
                '</div>'."\r\n";  
                //Pagina especifica: datos para armar dicha pagina.
                $imagenHTML[$paginaContador] = $row["imagen".$i];
                $paginaIndicador .= 
                '<li data-target="#carouselExampleIndicators" data-slide-to="'.$paginaContador.'" class="'.$activo.'"></li>'."\r\n";
                $paginaCarrusel .=
                '<div class="carousel-item '.$activo.'">'."\r\n".
                  '<img class="CsimagenGrande" src="'.$origen.'" alt="Foto'.$contador.'_'.$row["id"].$i.'">'."\r\n".
                '</div>'."\r\n";
                $activo = ""; 
                $paginaContador += 1;         
              }            
            }
            $archivoPHP = $row['pagina'];
            crearArchivoPHP($archivoPHP, $paginaIndicador, $paginaCarrusel, $imagenHTML, $row["titulo"], $row["subtitulo"], $row["descripcion"], $row["fecha"]); 

            echo
              '<!-- ===========EVENTOS=========== -->
              <form  action="'.$archivoPHP.'" method="post">
                <div class="row CsPanelBlog">
                  <!-- =====CARRUSEL===== -->
                  <div class="col-12 col-md-3 text-center">
                    <div id="'.$carruselNombre.'" class="carousel slide" data-ride="carousel">
                      <div class="carousel-inner">
                        '.$carruselItem .'
                      </div>
                      <a class="carousel-control-prev" href="#'.$carruselNombre.'" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="carousel-control-next" href="#'.$carruselNombre.'" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                      </a>
                    </div>
                  </div>
                  <!-- =======DATOS====== -->
                  <div class="col-12 col-md-9">
                    <h4 class="card-title mt-1 mb-2">'.codificarHTML($row["titulo"]).'</h4>
                    <h5 class="card-subtitle text-muted mt-1 mb-2">'.codificarHTML($row["subtitulo"]).'</h5>
                    <p>'.formatearFechaLarga($row["fecha"]).'</p>
                  </div>
                  <div class="col-12 text-right">
                    <button type="submit" name="btnVerMas" class="btn btn-danger btn-block mt-2 mb-1 CsBoton CsLetraMasChica">Leer m&aacute;s datos sobre el evento</button>
                  </div>
                </div>
              </form>';
          }
          mysqli_free_result($consultaDB);
        ?>
    </section>


    <!--==============================FOOTER=================================-->
    <?php
      include('includes/content_table_promotions.php');
      include('includes/struct_footer.php');
    ?>

  </body>
</html>
