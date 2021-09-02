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
        <h4 class="CsSeccionTitulo animated tada">Nosotros</h4>
      </div>
      <div id="idPanelAbout" class="row animated fadeInUp">
        <div class="col-12">
          <h5>Valores</h5>
          <p>Somos una Empresa seria, responsable y dedicada. Trabajamos con respeto, amabilidad y un buen servicio para nuestros consumidores que son lo m&aacute;s importante y para que con toda nuestra dedicaci&oacute;n podamos llegar a cada uno de tus seres queridos y ser parte de sus momentos m&aacute;s especiales.</p>          
        </div>
        <div class="col-12">
          <img src="img/separator_article.png" alt="Separador de Art&iacute;culos" class="CsSeparadoArticulo">
        </div>
        <div class="col-12">
          <h5>Visi&oacute;n</h5>
          <p>Ser la mejor opci&oacute;n en productos para tu evento. Establecer a “Huellas” como una empresa a la vanguardia en la elaboraci&oacute;n y comercializaci&oacute;n de productos de reposter&iacute;a y cotill&oacute;n artesanal, distingui&eacute;ndose por su variedad en sabores, colores y la mejor calidad de materia prima al mejor precio, con un equipo humano competente y capaz, aprovechando las oportunidades para crecer ordenadamente e impulsar el bienestar de quienes participamos con “Huellas” y nuestro entorno.</p>          
        </div>
        <div class="col-12">
          <img src="img/separator_article.png" alt="Separador de Art&iacute;culos" class="CsSeparadoArticulo">
        </div>
        <div class="col-12">
          <h5>Misi&oacute;n</h5>
          <p>Ser una empresa comprometida, innovadora y creativa. Satisfaciendo las exigencias del mercado consumidor y elaborando una gran variedad de productos artesanales de alta calidad y tem&aacute;ticas originales a trav&eacute;s de nuestra gama de estilos y colores</p>          
        </div>
      </div>        
     </section>


    <!--==============================FOOTER=================================-->
    <?php include('includes/struct_footer.php');?>

  </body>
</html>