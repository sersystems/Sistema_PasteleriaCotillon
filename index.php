<?php 
    session_start();
    include('includes/struct_head.php');
    require('includes/conexionDB.php');
    require_once('process_encodeHTML.php');
?>

    <!--==============================HEADER=================================-->
    <!--==============================HEADER=================================-->
    <header>
      <?php 
        include('includes/content_header_session.php');
        include('includes/content_header_menu.php');
        include('includes/content_banner.php');
      ?>
    </header> 

  <div class="container-fluid">
    <div class="row pt-3 pr-3 pb-3">
      <!--==============================ASIDE==================================-->
      <aside class="col-md-4 d-none d-md-block">
        <div id="idPanelHomeAside">
          <br>Noticias<br>
          <ul>
            <?php
              $consultaDB = consultarDB("SELECT * FROM articulos ORDER BY fecha DESC");
              while ($row = mysqli_fetch_array($consultaDB, MYSQLI_ASSOC)){
                echo
                '<li><a href="#idArticulo'.$row["id"].'" class="text-white">'.$row["titulo"].'</a></li>';
              }
              mysqli_free_result($consultaDB);
            ?>
            <li><a href="#idArticuloVideo" class="text-white">Video de Producci&oacute;n</a></li>
          </ul>
          <div class="col-12"><span><a href="#idPanelHomeQuestion" class="text-white">Preguntas Frecuentes</a></span></div>
          <div class="col-12"><span><a href="index_politics.php" class="text-white">Pol&iacute;tica De Privacidad</a></span></div>
          <div class="col-12"><hr class="CsSeparador mr-2"></div>
          <div class="col-12 text-center"><span>Recomend&aacute;nos en las redes sociales</span></div>
          <div class="col-12">
            <div class="row justify-content-center">
              <!-- =========Facebook========== -->
              <div>
                <div class="fb-like" data-href="http://huellascotillon.com/" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
              </div>          
              <!-- ==========WhatsApp========= -->
              <div id="idCompartirWhatsapp" class="ml-1 d-sm-block d-md-none">
                <a href="whatsapp://send?text=http://huellascotillon.com/'.$archivo.'" data-action="share/whatsapp/share"><img src="img/svg/whatsapp_white.svg">Compartir</a>
              </div>
              <!-- ==========twitter========== -->
              <div class="ml-1 mt-1">
                <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-show-count="true">Tweet</a>
              </div>          
              <!-- ==========Google+========== -->
              <div class="ml-1 mt-1">
                <div class="g-plus" data-action="share" data-annotation="bubble" data-href="http://huellascotillon.com/"></div>
              </div>
            </div>
          </div>
        </div>   
      </aside>

      <!--=============================SECTION=================================-->
      <section id="idPanelHomeSection" class="col-12 col-md-8">
        <?php include('process_date_full.php');?>
        <!--===============VIDEO===============-->
        <article id="idArticuloVideo" class="row m-3">
          <div class="col-12 col-md-7">
            <h5>Video de Producci&oacute;n</h5>
            <span class="text-muted mt-1"><?php echo formatearFechaLarga("12/05/2017");?></span>
            <p class="text-justify">Amamos ser parte de cada detalle en un rinconcito de tu celebraci&oacute;n y dejar nuestras huellas! Gracias.<br>
              Rosa &amp; Marcela
            </p>    
          </div> 
          <div class="col-12 col-md-5">
            <video id="idVideoHome" controls poster="img/video_poster.jpg" width="100%">
              <source src="video/video_facebook1.mp4" type="video/mp4">
              Su reproductor no soporta este formato de video.            
            </video>
          </div>     
        </article> 
        <?php
          $consultaDB = consultarDB("SELECT * FROM articulos ORDER BY fecha DESC");
          while ($row = mysqli_fetch_array($consultaDB, MYSQLI_ASSOC)){
            echo
            '<!--============SEPARADOR============-->
            <div class="col-12">
              <hr class="CsSeparador"> 
            </div>
            <!--=============ARTICULO=============-->
            <article id="idArticulo'.$row["id"].'" class="row m-3">
              <div class="col-12 col-md-7">
                <h5>'.codificarHTML($row["titulo"]).'</h5>
                <span class="text-muted mt-1">'.formatearFechaLarga($row["fecha"]).'</span>
                <p class="text-justify">'.codificarHTML($row["descripcion"]).'</p>    
              </div> 
              <div class="col-12 col-md-5">
                <figure>
                  <img src="'.$row["imagen1"].'" alt="'.codificarHTML($row["titulo"]).'" width="100%">
                </figure>
              </div>     
            </article>'; 
          }
          mysqli_free_result($consultaDB);
        ?>
      </section>
    </div>
  </div>

  <div class="col-12">
    <div id="idPanelHomeQuestion">
      <h3 class="text-center pt-3 h3">Preguntas Frecuentes</h3>
      <ol class="pl-5 pr-5 pb-3">
      <?php
        $consultaDB = consultarDB("SELECT * FROM preguntas");
        while ($row = mysqli_fetch_array($consultaDB, MYSQLI_ASSOC)){
          echo
          '<li class="text-justify"><b>'.codificarHTML($row["pregunta"]).'</b><br><p class="text-justify">'.codificarHTML($row["repuesta"]).'</p></li>';
        }
        mysqli_free_result($consultaDB);
      ?>
      </ol>
    </div>
  </div>


    <!--==============================FOOTER=================================-->
    <?php
      include('includes/content_table_promotions.php');
      include('includes/struct_footer.php');
    ?>

  </body>
</html>