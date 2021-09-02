<!DOCTYPE html>

			<html lang="es-AR">

			  <head>
			    <title>Huellas Cotill&oacute;n y Candy Bar</title>
			    <meta charset="UTF-8"/>
			    <meta name="description" content="El mejor servicio para tu evento. Elaboramos tortas, pasteler&iacute;a en general y ambientamos tu cotill&oacute;n con excelentes tem&aacute;ticas. San Juan - Argentina"/>
			    <meta name="keywords" content="Huellas Cotillon, Cotillon, Tortas, Tartas, Dulces, Candy Bar, Pasteleria, Eventos, Fiestas, Rosa Acosta, Marcela Aguirre"/>
			    <meta name="author" content="Sergio Regalado Alessi"/>
			    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    			<link rel="canonical" href="http://huellascotillon.com/promo387005122017.php"/>
			    <link rel="icon" href="img/favicon.png" type="image/x-icon"/>
			    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon"/>

			    <!--Framework & Resource (WEB)-->
			    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Meddon|Norican"/>
			    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css"/>
			    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous"/>
			    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
			    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
			    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

			    <!--Framework & Resource (LOCAL)-->
			    <link rel="stylesheet" href="css/estilo.css"/>
			    <script type="text/javascript" src="js/app.js" charset="UTF-8"></script>
    
			    <!--Meta Etiquetas con propiedades para el contenido de las publicaciones de Facebook-->
			    <meta property="og:url" content="http://www.huellascotillon.com/promo387005122017.php" />
			    <meta property="og:type" content="website" />
			    <meta property="og:title" content="Huellas Cotill&oacute;n & Candy Bar" />
			    <meta property="og:image" content="http://huellascotillon.com/" />
			    <meta property="og:description" content="Promoción 2: Mesa Dulce" />			    
			  </head>
			    
			  <body id="idBody">



	        <?php
			    session_start();
			    require("includes/conexionDB.php");
			?>

			    <!--==============================HEADER=================================-->
			    <header>
			      <?php
			          include("includes/content_header_session.php");
			          include("includes/content_header_menu.php");?>
			    </header>
			  
			    <!--=============================SECTION=================================-->
			    <section class="container">
			      <?php include("process_date_full.php");?>
			      <div class="col-12 CsPanelBlog">
			        <!--===============IMAGEN================-->
			        <div class="offset-1 col-10">
	              <div class="col-12 text-center">
	                <div class="mt-2">
	                  <img class="CsimagenGrande" src="" alt="Promocion14">
	                </div>
	              </div>
			        </div>
			        <!--==============DESCRIPCION=============-->
			        <div class="offset-1 col-10">
			          <div class="col-12">
				        <h4 class="CsSeccionTitulo animated tada">Promoción 2: Mesa Dulce</h4>
			            <p class="text-justify">Torta Golosa x1
Borachito Para Copetin x50

decoraci?n incluida</p>
			            <p class="text-muted mt-1">22 de noviembre de 2017</p>
			            <p class="h2 text-danger mt-3 text-center">Precio $33.00</p>
			          </div>
			          <div class="col-12 text-right">
			            <div class="fb-like" data-href="http://sersytems.com/huellas/promo387005122017.php" data-width="250" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
			          </div>
			        </div>
			        <!--===============SEPARADOR==============-->
			        <div class="offset-1 col-10">
			          <hr class="CsSeparador"> 
			        </div>
			        <div class="offset-md-1 col-md-10">
			          <div class="fb-comments" data-href="http://sersytems.com/huellas/promo387005122017.php" data-mobile="true" data-numposts="5" data-order-by="reverse_time"></div>
			        </div>
			      </div>
			    </section>


			    <!--=============================FACEBOOK===============================-->
			    <div id="fb-root"></div>
			    <script>(function(d, s, id) {
			      var js, fjs = d.getElementsByTagName(s)[0];
			      if (d.getElementById(id)) return;
			      js = d.createElement(s); js.id = id;
			      js.src = "https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.11";
			      fjs.parentNode.insertBefore(js, fjs);
			    }(document, "script", "facebook-jssdk"));
			    </script>

			    <!--==============================FOOTER=================================-->
			    <?php
			      include("includes/content_table_promotions.php");
			      include("includes/struct_footer.php");
			    ?>

			  </body>
			</html>