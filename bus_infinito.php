<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cálculo de Corto Circuito por Bus Infinito</title>
    
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
	    <form action="bus_infinito.php" method="post">
	      <h1>Corto Circuito Por Bus Infinito</h1>
	      <label class="label" for="">Selecciona Metodo de Cálculo: </label>
	      <select class="select" name="sistema" id="">
	        <option value="bus infinito">Por Bus Infinio</option>
	        <option value="pu">P.U.</option>
	        <option value="mvas">MVA´s</option>
	      </select>
	        <label for="">Capacidad del Transformador (KVA`S): </label>
	        <input class="input" type="text" name="potencia" required="">
	        <label for="">Voltaje del Secundario (Volts): </label>
	        <input class="input" type="text" name="voltaje" required="">   
          <label for="">Impedancia del Transformador (Z%): </label>
          <input class="input" type="text" name="impedancia" required="">   
	        <input type="submit" value="Calcular">
	    </form>
    </div>


<?php 

  if(isset($_POST['Calcular'])) {
    $sistema = $_POST['sistema'];
    $potencia = $_POST['potencia'];
    $voltaje = $_POST['voltaje'];
    $impedancia = $_POST['impedancia'];
  }


  $sistema = $_POST['sistema'];
  $potencia = $_POST['potencia'];
  $voltaje = $_POST['voltaje'];
  $impedancia = $_POST['impedancia'];

  //Calculo de la Corriente de Corto Circuito (Icc).
  if ($sistema == 'bus infinito' ) {
    $In = $potencia / (1.732050807568877 * ($voltaje / 1000)  * ($impedancia / 100) )  ;

  } elseif ($sistema == 'P.U.') {
    $In = ($potencia / (2 * $voltaje * 0.9) ) ;
  }
  else {

    $In = ($potencia / (1.732050807568877 * $voltaje * 0.9) ) ;
  }

  $proteccion = $In * 1.1;
  $conductor = ($proteccion / (0.8 * 1.0) );

  
 
 ?>

    <div class="calculos">
      <h1>Resultados:</h1>
      <p>Modo de Calculo: <?php  echo $sistema;?> </p>
      <p>Capacidad del Transformador (KVA´S): <?php  echo $potencia;?> </p>
      <p>Voltaje (Volts): <?php  echo $voltaje;?> </p>
      <p>Icc Simetrica (Ampers): <?php  echo $In;?> </p>
      <p>Icc Asimetrica (Ampers): <?php  echo $proteccion;?> </p>

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