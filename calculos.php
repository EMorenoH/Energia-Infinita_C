<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Calculadora Eléctrica</title>
    
    <link rel="stylesheet" href="css/estilos_privacidad.css">
    <link rel="stylesheet" href="icon/css/fontello.css">
    <link rel="stylesheet" href="css/menu_calculadora.css">
   	<link rel="stylesheet" href="css/estilos_calculos.css">

    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
</head>
<body>
    <header>
        <div class="container-header">
            <div class="logo-title">
                <img src="image/logo05.jpg" alt="">
                <h4>Energy Infinitus</h4>
            </div>
            <label class="icon-menu"></label>
        </div>

        <div class="container-menu">
	        <div class="redes-close">
	            <font class="close">X</font>
	        </div>
	        <ul>
	            <li><a href="index.html">Portada</a></li>
	            <li><a href="inicio.html">Inicio</a></li>
	            <li><a href="nosotros.html">Nosotros</a></li>
	            <li><a href="Unidades de Negocio.html">Unidades de Negocio</a></li>
	            <li><a href="led_UVC.html">lamparas Led UV</a></li>
	            <li><a href="calculadora_cientifica.html">Calculadora Cientifica</a></li>
	            <li><a href="#">Noticias</a></li>
	            <li><a href="ayuda.html">Ayuda</a></li>
	            <li><a href="contacto.html">Contacto</a></li>
	            <li><a href="testimoniales.html">Testimoniales</a></li>
	            <li><a href="aviso_privacidad.html">Aviso de Privacidad</a></li>
	            <li><a href="aviso_privacidad.html">Aviso Legal</a></li>
	            <li><a href="aviso_privacidad.html">Terminos y Condiciones de Uso</a></li>
	        </ul>
        </div>
    </header>

    <div class="calculos">
	    <form action="https://github.com/EMorenoH/Energia-Infinita_C/blob/gh-pages/calculos.php" method="post">
	      <h1>Calc. Alimentador en B.T.</h1>
	      <label class="label" for="">Selecciona Sistema: </label>
	      <select class="select" name="sistema" id="">
	        <option value="Monofásico 1F 2H">Monofásico 1F,2H</option>
	        <option value="Monofásico 2F 3H">Monofásico 2F,3H</option>
	        <option value="Trifásico 3F 4H">Trifásico 3F,4H</option>
	      </select>
	        <label for="">Potencia (Watts): </label>
	        <input class="input" type="text" name="potencia" value="<?php ?>">
	        <label for="">Voltaje (Volts): </label>
	        <input class="input" type="text" name="voltaje" value="">     
	      <input type="submit" value="Calcular">
	    </form>
    </div>


<?php
  if(isset($_POST['Calcular'])) {
    $sistema = $_POST['sistema'];
    $potencia = $_POST['potencia'];
    $voltaje = $_POST['voltaje'];
  }


  $sistema = $_POST['sistema'];
  $potencia = $_POST['potencia'];
  $voltaje = $_POST['voltaje'];

  //Calculo de la Corriente Nominal In.
  if ($sistema == 'Monofásico 1F 2H' ) {
    $In = ($potencia / ($voltaje * 0.9) ) ;

  } elseif ($sistema == 'Monofásico 2F 3H') {
    $In = ($potencia / (2 * $voltaje * 0.9) ) ;
  }
  else {

    $In = ($potencia / (1.732050807568877 * $voltaje * 0.9) ) ;
  }

  $proteccion = $In * 1.25;
  $conductor = ($proteccion / (0.8 * 1.0) );

  
  //Calculo de la Caida de Tension
  if ($sistema == 'Monofásico 1F 2H' ) {
    $caida = ($potencia / ($voltaje * 0.9) ) ;

  } elseif ($sistema == 'Monofásico 2F 3H') {
    $caida = ($potencia / (2 * $voltaje * 0.9) ) ;
  }
  else {

    $caida = (((1.732050807568877 * $In * 0.050 * ((2.56 * 0.9) + (0.213 * 0.9))) / $voltaje) * 100 ) ;
  }
 ?>

    <div class="calculos">
      <h1>Resultados:</h1>
      <p>Sistema: <?php  echo $sistema;?> </p>
      <p>Potencia (Watts): <?php  echo $potencia;?> </p>
      <p>Voltaje (Volts): <?php  echo $voltaje;?> </p>
      <p>Corriente In (Ampers): <?php  echo $In;?> </p>
      <p>Corriente de Proteccion: <?php  echo $proteccion;?> </p>
      <p>Con esta corriente Seleccionar el interruptor correspondiente Ver <a href="tablas.html">TABLA 240-6</a> de la NOM-001-SEDE</p><br>
      <p>Corriente de Conductor: <?php  echo $conductor;?> </p>
      <p>Ver <a href="tablas.html">TABLA 310-15(b)(16)</a> Para Cables En Tuberia</p>
      <p>Ver <a href="tablas.html">TABLA 310-15(b)(17)</a> Para Cables al Aire Libre</p>
      <p>En la NOM-001-SEDE Instalaciones Eléctricas</p>
      <p>Caida de Tension en (%): <?php  echo $caida;?> </p>
      <p>Se considera una longitud maxima de 50mts</p>
    </div>
      <h3 class="calculos">Nota: El autor no se hace responsable del uso que los usuarios puedan hacer de esta calculadora gratuita, por lo que el usuario final serà el unico responsable de la implementacion de los mismos.</h3>



    <footer>
       
       <div class="container-footer-all">
        
            <div class="container-body">

                <div class="colum1">
                    <h1>Mas informacion de la compañia</h1>

                    <p>Empresa dedicada al desarrollo de ingeniería y construcción</p>

                </div>

                <div class="colum2">

                    <h1>Redes Sociales</h1>

                    <div class="row">
                        <img src="icon/facebook.png">
                        <label><a href="https://www.facebook.com/jlp.energiainfinita.1">Siguenos en Facebook</a></label>
                    </div>
                    <div class="row">
                        <img src="icon/twitter.png">
                        <label>Siguenos en Twitter</label>
                    </div>
                    <div class="row">
                        <img src="icon/in.png">
                        <label>Siguenos en Linkedin</label>
                    </div>


                </div>

                <div class="colum3">

                    <h1>Informacion Contacto:</h1>

                    <div class="row2">
                        <img src="icon/oficina.png">
                        <label>Via Adolfo Lopez Mateos No. 38, 
                        Col. Valle de Santa Monica, 
                        Tlalnepantla de Baz
                        Edo. Mex.
                        C.P. 54057</label>
                    </div>

                    <div class="row2">
                        <img src="icon/phone.png">
                        <label>+52 (55) 53.61.27.52</label>
                    </div>

                    <div class="row2 ">
                        <img src="icon/contact.png">
                         <label><a href="mailto:ventas@jlpinfinita.com.mx">ventas@jlpinfinita.com.mx</a></label>


                    </div>

                </div>

            </div>
        
        </div>
        
        <div class="container-footer">
                <div class="footer">
                    <div class="copyright">
                        © 2020 Todos los Derechos Reservados | <a href="inicio.html">Energy Infinitus</a>
                    </div>

                    <div class="information">
                        <a href="inicio.html">Informacion Compañia</a> | <a href="aviso_privacidad.html">Aviso Legal</a> | <a href="aviso_privacidad.html">Terminos y Condiciones de Uso</a>
                    </div>
                </div>
        </div>     
    </footer>

            <a class="appWhatsapp" target="_blanck" href="https://api.whatsapp.com/send?phone=525521705334&text=Hola!&nbsp;me&nbsp;pueden&nbsp;Ayudar?">
            <img src="image/logowhatsapp.png" alt="whatsapp">
            </a>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="js/script.js"></script>  



</body>
</html>
