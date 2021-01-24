<?php include('head.php'); ?>

<body>
<?php include('header.php'); ?>


    <div class="calculos">
	    <form action="calculos.php" method="post">
	      <h1>Calc. Alimentador en B.T.</h1>
	      <label class="label" for="">Selecciona Sistema: </label>
	      <select class="select" name="sistema" id="">
	        <option value="Monofásico 1F 2H">Monofásico 1F,2H</option>
	        <option value="Monofásico 2F 3H">Monofásico 2F,3H</option>
	        <option value="Trifásico 3F 4H">Trifásico 3F,4H</option>
	      </select>
	        <label for="">Potencia (Watts): </label>
	        <input class="input" type="text" name="potencia" value="">
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
    }elseif (empty('potencia')) {
    echo "<p>Selecciona un Voltaje</p>";
  





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
      <p>Con esta corriente Seleccionar el interruptor correspondiente Ver <a href="tablas.php">TABLA 240-6</a> de la NOM-001-SEDE</p><br>
      <p>Corriente de Conductor: <?php  echo $conductor;?> </p>
      <p>Ver <a href="tablas.php">TABLA 310-15(b)(16)</a> Para Cables En Tuberia</p>
      <p>Ver <a href="tablas.php">TABLA 310-15(b)(17)</a> Para Cables al Aire Libre</p>
      <p>En la NOM-001-SEDE Instalaciones Eléctricas</p>
      <p>Caida de Tension en (%): <?php  echo $caida;?> </p>
      <p>Se considera una longitud maxima de 50mts</p>
    </div>
      <h3 class="calculos">Nota: El autor no se hace responsable del uso que los usuarios puedan hacer de esta calculadora gratuita, por lo que el usuario final serà el unico responsable de la implementacion de los mismos.</h3>



<?php include('footer.php'); ?>


            <a class="appWhatsapp" target="_blanck" href="https://api.whatsapp.com/send?phone=525521705334&text=Hola!&nbsp;me&nbsp;pueden&nbsp;Ayudar?">
            <img src="image/logowhatsapp.png" alt="whatsapp">
            </a>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="js/script.js"></script>  



</body>
</html>