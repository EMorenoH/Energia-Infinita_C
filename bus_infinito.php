<?php include('head.php'); ?>

<body>
<?php include('header.php'); ?>


    <div class="calculos">
	    <form action="bus_infinito.php" method="post">
	      <h1>Corto Circuito Por Bus Infinito</h1>
	      <label class="label" for="">Selecciona Metodo de Cálculo: </label>
	      <select class="select" name="sistema" id="">
	        <option value="Por bus infinito">Por Bus Infinio</option>
	        <option value="pu">P.U.</option>
	        <option value="mvas">MVA´s</option>
	      </select>
	        <label for="">Capacidad del Transformador (KVA`S): </label>
	        <input class="input" type="text" name="potencia" value="">
	        <label for="">Voltaje del Secundario (Volts): </label>
	        <input class="input" type="text" name="voltaje" value="">   
          <label for="">Impedancia del Transformador (Z%): </label>
          <input class="input" type="text" name="impedancia" value="">   
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
  if ($sistema == 'Por bus infinito' ) {
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
      <p>Metodo de Calculo: <?php  echo $sistema;?> </p>
      <p>Capacidad del Transformador (KVA´S): <?php  echo $potencia;?> </p>
      <p>Voltaje (Volts): <?php  echo $voltaje;?> </p>
      <p>Icc Simetrica (Ampers): <?php  echo $In;?> </p>
      <p>Icc Asimetrica (Ampers): <?php  echo $proteccion;?> </p>

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