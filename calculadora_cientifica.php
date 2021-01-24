<html>
	<head>

		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta name="apple-mobile-web-app-capable" content="yes" />-->
		<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimal-ui" />
		<meta name="apple-mobile-web-app-status-bar-style" content="yes" />




		<link rel="stylesheet" href="css/estilos_privacidad.css?14012021">
		<link rel="stylesheet" href="icon/css/fontello.css?14012021">
    	<link href="image/logo.ico" rel="icon" type="" />


		<script language="javascript"> 

			<!--

			var state = 'none';

			function showhide(layer_ref,state) {

			if (document.all) { //IS IE 4 or 5 (or 6 beta) 

			eval( "document.all." + layer_ref + ".style.display = state"); 

			} 

			if (document.layers) { //IS NETSCAPE 4 or below 

			document.layers[layer_ref].display = state; 

			} 

			if (document.getElementById &&!document.all) { 

			hza = document.getElementById(layer_ref); 

			hza.style.display = state; 

			} 

			} 

			//--> 
		</script>

		<title>Calculadora Cientifica</title>
		<meta name="description" content="Easy-To-Use Scientific Calculator with Task History" />

		<script language="javascript">

			var broj = "0"
			var tocka = 0
			var eksp = 0
			var eksponent = 3
			var rjesenje = 0
			var zastavica = 0
			var decimala = 0
			var enter = ""
			var ConstOpen = 0
			var ConstWin = ""
			var MenuOpen = 0
			var MenuWin = ""
			var CalcOpen = 0
			var CalcWin = ""
			var MainWin = ""
			var element = ""
			var abc = "";


			function start(){
				enter = document.racunalo.notes.value;
				if (enter.length > 2) {enter = enter.charAt(enter.length-1)}
				document.racunalo.notes.value = "";
				zadatakfocus()
				}


			function remote(stranica){
				ConstOpen = 1;
				if (ConstWin.open) {
					ConstWin.document.konstante.naslov.focus()
				}
				else {
					ConstWin=window.open(stranica, "", "width=300,height=500,scrollbars=yes");
					ConstWin.creator=self
				}
			}


			function Zatvoreno() {
				if (ConstOpen == 1) {ConstWin.ConstOpen = 1; ConstWin.close()}
				if (CalcOpen == 1) {CalcWin.close()}
				if (MenuOpen == 1) {MenuWin.close()}
			}


			function memory(operator) {

				zadatakfocus();

				if (operator == 1) {		// MS 
					document.racunalo.memorija.value = document.racunalo.rezultat.value
				}
				else if (operator == 2)	{	// MR
					var memorija = document.racunalo.memorija.value;
					if (memorija==0 || slovo(memorija.charAt(0))) {memorija = ""};
					document.racunalo.zadatak.value += memorija
				}
				else if (operator == 3) {	// CLS
					if (document.racunalo.zadatak.value == "") {
						document.racunalo.rezultat.value = ""
					}
					else {
						document.racunalo.zadatak.value = ""
					}
				}
				else if (operator == 4) {	// Reset
					document.racunalo.notes.value = "";
					zadatakfocus()
				} 
				else if (operator == 5) {	// <--
					if (!document.racunalo.zadatak.value == ""){
					var strtask = document.racunalo.zadatak.value;
					document.racunalo.zadatak.value = strtask.substring(0, strtask.length - 1);
					}
				}
				
				localStorage.setItem('rememberedtaskhistory', document.racunalo.notes.value);
				
			}


			function display(noviznak) {
				if (noviznak=="")
					{zadatakfocus()}
				else
					{document.racunalo.rezultat.select()}
			}


			function dodajBroj(noviznak) {
			document.racunalo.zadatak.value += noviznak;
				zadatakfocus();

				
				
			}


			function izracunaj(zarez) {
				var pitanje = "";
				var mem = 0;

				if (zarez >= 1) {
					if (document.racunalo.zadatak.value == "") {
						broj = document.racunalo.oldrezultat.value
					}
					else {
				    	broj = document.racunalo.zadatak.value;
						if (ubacirezultat(broj.charAt(0))) {
							broj = document.racunalo.oldrezultat.value + broj
						}
					}
				}
				
				var broj = broj.replace(/\(\-\)/g, '-');

				for (var i=0; i<broj.length; i++) {
					if (lettercheck(broj.charAt(i))) {var kem = 1};
					if (broj.charAt(i) == ",") {pitanje += "."}
					else if (broj.charAt(i) == " ") {}
					else {pitanje += broj.charAt(i)}
				}

				if (operator(broj.charAt(broj.length-1))) {return false};

				if (zarez == 1) {
				var thenewline = '';
				if (document.racunalo.notes.value == ''){
				thenewline = ''; 
				}
				else {
				thenewline = '\n';
				}

					document.racunalo.notes.value += thenewline + pitanje + enter;
					if (kem == 1) {
						var atom = "+" + pitanje;
						pitanje = masa(atom)
					}
					else {
						pitanje = eval("1*" + pitanje)
					}
				}
				else if (zarez > 1) {
					pitanje = eval("1*" + pitanje);
					pitanje = matematika(zarez, pitanje)
				}

				document.racunalo.oldrezultat.value = pitanje;

				zaokruzi(pitanje);

				document.racunalo.notes.scrollTop = document.racunalo.notes.scrollHeight - document.racunalo.notes.clientHeight;
				
				document.racunalo.zadatak.value = "";
			 	zadatakfocus()
				
				localStorage.setItem('rememberedtaskhistory', document.racunalo.notes.value);
			}


			function matematika(zarez, rjesenje) {
			 with (Math)
			  {
			  	var thenewline = '';
				if (document.racunalo.notes.value == ''){
				thenewline = ''; 
				}
				else {
				thenewline = '\n';
				}
				if (zarez == 2) {
					document.racunalo.notes.value += thenewline + rjesenje + "^2" + enter;
					rjesenje = pow(rjesenje, 2)
				}
				else if (zarez == 3) {
					document.racunalo.notes.value += thenewline + rjesenje + "^(1/2)" + enter;
					rjesenje = sqrt(rjesenje)
				}
				else if (zarez == 4) {
					document.racunalo.notes.value += thenewline + rjesenje + "*(-1)" + enter;
					rjesenje = -rjesenje
				}
				else if (zarez == 5) {
					document.racunalo.notes.value += thenewline + "ln(" + rjesenje + ")" + enter;
					rjesenje = log(rjesenje)
				}
				else if (zarez == 6) {
					document.racunalo.notes.value += thenewline + "e^" + rjesenje + enter;
					rjesenje = pow(E, rjesenje)
				}
				else if (zarez == 7) {
					document.racunalo.notes.value += thenewline + "1/" + rjesenje + enter;
					rjesenje = 1/rjesenje
				}
				else if (zarez == 8) {
					document.racunalo.notes.value += thenewline + "log(" + rjesenje + ")" + enter;
					rjesenje = log(rjesenje)/LN10
				}
				else if (zarez == 9) {
					document.racunalo.notes.value += thenewline + "10^" + rjesenje + enter;
					rjesenje = pow(10, rjesenje)
				}
				else if (zarez >= 10 && zarez <= 12) {
					if (zarez == 10) {
						document.racunalo.notes.value += thenewline + "atan(" + rjesenje + ")" + enter;
						rjesenje = atan(rjesenje)
					}
					else if (zarez == 11) {
						document.racunalo.notes.value += thenewline + "acos(" + rjesenje + ")" + enter;
						rjesenje = acos(rjesenje)
					}
					else if (zarez == 12) {
						document.racunalo.notes.value += thenewline + "asin(" + rjesenje + ")" + enter;
						rjesenje = asin(rjesenje)
					}

					if (document.racunalo.stupnjevi[1].checked) {rjesenje = (rjesenje * 180) / PI}
				}
				else if (zarez >= 14 && zarez <= 16) {
					if (document.racunalo.stupnjevi[1].checked)
						{radijani = (rjesenje / 180) * PI}
					else
						{radijani = rjesenje};

					if (zarez == 14) {
						document.racunalo.notes.value += thenewline + "tan(" + rjesenje + ")" + enter;
						rjesenje = tan(radijani)
					}
					else if (zarez == 15) {
						document.racunalo.notes.value += thenewline + "cos(" + rjesenje + ")" + enter;
						rjesenje = cos(radijani)
					}
					else if (zarez == 16) {
						document.racunalo.notes.value += thenewline + "sin(" + rjesenje + ")" + enter;
						rjesenje = sin(radijani)
					}
				}
				else if (zarez == 17) {
					document.racunalo.notes.value += thenewline + rjesenje + "%" + enter;
					rjesenje = rjesenje/100
				}
				else if (zarez == 18) {
					document.racunalo.notes.value += thenewline + rjesenje + "ppm" + enter;
					rjesenje = rjesenje/1000000
				}
				else if (zarez == 20) {
					document.racunalo.notes.value += thenewline + rjesenje + "!" + enter;
					rjesenje = factorial(rjesenje)
				}
				else if (zarez == 21) {
					eksponent = prompt("Please enter exponent", 3);
					document.racunalo.notes.value += thenewline + rjesenje + "^" + eksponent + enter;
					rjesenje = pow(rjesenje, eksponent)
				}
				else if (zarez == 22) {
					eksponent = prompt("Please enter root", 3);
					document.racunalo.notes.value += thenewline + rjesenje + "^(1/" + eksponent + ")" + enter;
					rjesenje = pow(rjesenje, (1/eksponent))
				}
				return rjesenje
			 }
			 
			 localStorage.setItem('rememberedtaskhistory', document.racunalo.notes.value);
			}


			function zaokruzi(ebroj) {

			decimala=parseFloat(document.racunalo.izaZareza.options[document.racunalo.izaZareza.selectedIndex].value);
				var strbroj = ebroj + " ";
				if (strbroj.charAt(0) == ".") {strbroj = "0" + strbroj};
				var intbroj = strbroj.length - 1;
				deczarez(strbroj);

				if (intbroj > 16 && eksp == -1) {
					if (decimala == -1) {decimala = 12};
					strbroj = izazareza(strbroj.substring(0,intbroj)) + " ";
					intbroj = strbroj.length - 1;
					deczarez(strbroj)
				}

				if (decimala >= 0 && decimala != 12) {
					if (tocka > 0) {
						var odgovor = izazareza(strbroj.substring(0,intbroj))
					}
					else {
						ebroj = strbroj.substring(0,intbroj);
						if (decimala > 0) {
							ebroj += ".";
							for (var n = 0; n < decimala; n++) {
								ebroj += "0"
							}
						}
						var odgovor = ebroj
					}
				}
				else {
					decimala = 12;
					var odgovor = izazareza(strbroj)
				}

				if (odgovor.charAt(0) == ".") {odgovor = "0" + odgovor};

				document.racunalo.rezultat.value = odgovor;
				document.racunalo.notes.value += " = " + odgovor + enter;
				
				localStorage.setItem('rememberedtaskhistory', document.racunalo.notes.value);
			}


			function deczarez(novibroj) {
				tocka = 0;
				eksp = 0;

				tocka = novibroj.indexOf(".");
				eksp = novibroj.indexOf("e")
			}


			function izazareza(novibroj) {
			 with (Math) {

				if (eksp == -1) {
					var duzina = tocka;
					if (duzina == -1) {duzina = novibroj.length};
					var desni = "";

					if (duzina > 16) {
						var privremeni = round(novibroj*pow(10, 18)) + " ";
						var novie = privremeni.indexOf("e");
						var lijevi = (privremeni.substring(0,novie));

						lijevi = round(lijevi*pow(10, 15))/pow(10, 15) + " ";
						desni = (privremeni.substring(novie+2,privremeni.length-1));
						desni = "e+" + (desni-18)
					}
					else {
						var lijevi = round(novibroj*pow(10, decimala))/pow(10, decimala) + " "
					}
				}
				else {
					var lijevi = novibroj.substring(0,eksp);
					var desni = novibroj.substring(eksp,novibroj.length);

					lijevi = round(lijevi*pow(10, decimala))/pow(10, decimala) + " "
				}

				lijevi = lijevi.substring(0,lijevi.length - 1);

				if (lijevi.charAt(0) == ".") {lijevi = "0" + lijevi};

				if (decimala < 12) {
					if (lijevi.indexOf(".") == -1 && decimala != 0) {lijevi += "."};
					var nula = (tocka + decimala) - (lijevi.length - 1);
					if (nula > 0 && decimala > 0) {
						for (var n = 0; n < nula; n++) {
							lijevi += "0"
						}
					}
				}

				return (lijevi + " " + desni)
			 }
			}


			function factorial(n) {
				if ((n == 0) || (n == 1)) {
					return 1
				}
				else {
					var odgovor = (n * factorial(n-1));
					return odgovor
				}
			}





			function slovo(znak) {
				var slovo="(ABCDEFGHIKLMNOPRSTUVWXYZ";
				for (var i=0; i<slovo.length; i++)
					if (znak == slovo.charAt(i)) {return true} {return false}
			}

			function lettercheck(znak) {
				var slovo="ABCDEFGHIKLMNOPRSTUVWXYZ";
				for (var i=0; i<slovo.length; i++)
					if (znak == slovo.charAt(i)) {return true} {return false}
			}


			function matoperator(znak) {
				var matoperator="*/+-";
				for (var i=0; i<matoperator.length; i++)
					if (znak == matoperator.charAt(i)) {return true}
					if (znak == "") {return true}
					if (znak == null) {return true}
				return false
			}

			function operator(znak) {
				var matoperator="*/+-";
				for (var i=0; i<matoperator.length; i++)
					if (znak == matoperator.charAt(i)) {return true}
				return false
			}

			function ubacirezultat(znak) {
				var ubacirezultat="*/+-";
				for (var i=0; i<ubacirezultat.length; i++)
					if (znak == ubacirezultat.charAt(i)) {return true}
				return false
			}

			function BrojAtoma(znak)
			{	var atom = "1234567890";
				for (var i=0; i<atom.length; i++)
					if (znak == atom.charAt(i)) {return true} {return false}
			}


			function Slika(adresa) {
				window.opener.location=adresa
			}


			function MenuBotun(adresa) {
				if (MenuWin.open) {
					MenuWin.document.daljinski.elementi.focus()
				}
				else {
					MenuWin = window.open(abc + adresa, "_blank", "width=110,height=270,toolbar=0,directories=0,resizable=1,scrollbars=0"); 
					MenuWin.creator = self;
					MenuOpen = 1
				}
			}


			function CalcBotun(adresa) {
				if (CalcWin.open) {
					CalcWin.document.racunalo.zadatak.focus()
				}
				else {
					CalcWin = window.open(abc + adresa, "_blank", "width=308,height=425,toolbar=0,directories=0,resizable=1,scrollbars=0");
					CalcWin.creator = self;
					CalcOpen = 1
				}
			}
		</script>

		<script type="text/javascript">

		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-20997225-5']);
		  _gaq.push(['_trackPageview']);

		  (function() {
		    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();
		</script>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js" type="text/javascript" charset="utf-8"></script>

		<script type="text/javascript" charset="utf-8"> 
			$( document ).ready( function() {

			if(enyo.platform.firefoxOS) {

			} else if (enyo.platform.androidFirefox){

			} else if (enyo.platform.androidChrome){

			} else if (enyo.platform.android){

			} else {

			            var $body = $('body'); //Cache this for performance

			            var setBodyScale = function() {
			                var scaleSource = $body.width(),
			                    scaleFactor = 0.10,                     
			                    maxScale = 200,
			                    minScale = 80; //Tweak these values to taste

			                var fontSize = scaleSource * scaleFactor; //Multiply the width of the body by the scaling factor:

			                if (fontSize > maxScale) fontSize = maxScale;
			                if (fontSize < minScale) fontSize = minScale; //Enforce the minimum and maximums

			                $('body').css('font-size', fontSize + '%');
			            }

			            $(window).resize(function(){
			                setBodyScale();
			            });

			            //Fire it when the page first loads:
			            setBodyScale();
						
			}
			        });
		</script>
		<script src="enyo.js"></script>

		<script>

			function zadatakfocus(){

			if(enyo.platform.firefoxOS) {

			} else if (enyo.platform.androidFirefox){

			} else if (enyo.platform.androidChrome){

			} else if (enyo.platform.android){

			} else {

			document.racunalo.zadatak.focus();

			}




			}
		</script>						
									
		<style>

			.buttonback {
			height: 100%;
			width: 16%;
			font-family: Verdana; font-weight: bold; fontsize: 100%;

			cursor: pointer; 

			-webkit-user-select: none; 
			-khtml-user-select: none; 
			-moz-user-select: none; 
			-o-user-select: none; 
			user-select: none;

			    background-color: #ccc;

				color: #333;
			}

			.buttoncls {
			height: 100%;
			width: 16%;
			font-family: Verdana; font-weight: bold; fontsize: 100%;

			cursor: pointer; 

			-webkit-user-select: none; 
			-khtml-user-select: none; 
			-moz-user-select: none; 
			-o-user-select: none; 
			user-select: none;

			    background-color: #A60B00;

				color: white;
			}

			.buttonclsblue {
			height: 100%;
			width: 16%;
			font-family: Verdana; font-weight: bold; fontsize: 100%;

			cursor: pointer; 

			-webkit-user-select: none; 
			-khtml-user-select: none; 
			-moz-user-select: none; 
			-o-user-select: none; 
			user-select: none;

			    background-color: #ccc;
				color: #333;
			}

			.buttonstyl {
			height: 11%;
			width: 16%;
			font-family: Verdana; font-weight: bold; fontsize: 100%;

			cursor: pointer; 

			-webkit-user-select: none; 
			-khtml-user-select: none; 
			-moz-user-select: none; 
			-o-user-select: none; 
			user-select: none;

			background-color: #73C3D9; 
			}

			.buttonstylblue {
			height: 11%;
			width: 16%;
			font-family: Verdana; font-weight: bold; fontsize: 100%;
			 
			cursor: pointer; 

			-webkit-user-select: none; 
			-khtml-user-select: none; 
			-moz-user-select: none; 
			-o-user-select: none; 
			user-select: none;

			    background-color: #666;
			}

			.buttonstylnumpad {
			height: 11%;
			font-family: Verdana; font-weight: bold; fontsize: 100%;

			cursor: pointer; 

			-webkit-user-select: none; 
			-khtml-user-select: none; 
			-moz-user-select: none; 
			-o-user-select: none; 
			user-select: none;

			    background-color: #ccc;

				color: #333;
			}

			.buttonstylmempad {
			height: 11%;
			font-family: Verdana; font-weight: bold; fontsize: 100%;
			background: rgb(238, 238, 238);

			cursor: pointer; 

			border: solid 0px #CCCCCC;

			-webkit-user-select: none; 
			-khtml-user-select: none; 
			-moz-user-select: none; 
			-o-user-select: none; 
			user-select: none;

			    background-color: #777;
			}

			.buttonstylothpad {
			height: 11%;
			font-family: Verdana; font-weight: bold; fontsize: 100%;

			cursor: pointer; 

			-webkit-user-select: none; 
			-khtml-user-select: none; 
			-moz-user-select: none; 
			-o-user-select: none; 
			user-select: none;

			    background-color: #bbb;
			}

			.buttonstylentpad {
			height: 11%;
			font-family: Verdana; font-weight: bold; fontsize: 100%;

			cursor: pointer; 

			-webkit-user-select: none; 
			-khtml-user-select: none; 
			-moz-user-select: none; 
			-o-user-select: none; 
			user-select: none;

			    background-color: #22CD00;
			}

			.buttonstylentpadblue {
			height: 11%;
			font-family: Verdana; font-weight: bold; fontsize: 100%;

			cursor: pointer; 

			-webkit-user-select: none; 
			-khtml-user-select: none; 
			-moz-user-select: none; 
			-o-user-select: none; 
			user-select: none;

			    background-color: #bbb;
			}

			.buttonstylhistpad {
			height: 11%;
			font-family: Verdana; font-weight: bold; fontsize: 100%;

			cursor: pointer; 

			-webkit-user-select: none; 
			-khtml-user-select: none; 
			-moz-user-select: none; 
			-o-user-select: none; 
			user-select: none;

			    background-color: #ccc;

				color: #333;
			}

			::-webkit-scrollbar {
			    width: 10px;
				height: 0px;
			}

			::-webkit-scrollbar-track {
			}

			::-webkit-scrollbar-thumb {
			background-color: #999999;

			}
			.selectbox {
			outline: none; 
			border-width: 0px; 
			width: 95%; 
			font-size: 100%; 
			background-color: #FAFAFA;
			}

			.bodywood {

			background: #e8c2a6;
			background-image: url("image/portada.jpg"), url("image/retroceso.png");
			background-repeat: repeat-x, repeat;
			}

			 .normalbody {
			background-color: black;
			}

			 .tablecontent {
			 font-size: 120%; 
			 height: 95%; 
			 width: 95%
			 }

			  .settingsbuttonclass {
			 
			 }
			 
			  .toptd {
			 height: 10%;
			 }
			 
			  .conttd {
			 height: 80%;
			 }

			 
			 @media (max-width: 640px) {
			 

			 .membox {
			 display: none;
			 width: 50%;
			 }
			 
			 
			 .settingsbuttonclass {
			 display: none;
			 }
			 
			 .selectbox {
			 outline: none; 
			 border-width: 0px; 
			 font-size: 100%; 
			 background-color: #FAFAFA;
			 width: 100%;
			 height: 100%;
			 }
			 
			 .toptd {
			 height: 10%;
			 }
			 
			  .conttd {
			 height: 90%;
			 }
			 
			 } 
		</style>
	</head>

	<body class="normalbody" onunload="Zatvoreno()">

<?php include('header.php'); ?>



		<form name="racunalo">

			<input type="hidden" name="oldrezultat" value="">

			<input type="hidden" name="memorija" value="">

			<div style="background-repeat: no-repeat; background-position-x:center; background-position-y:center; font-size: 100%; position: relative; left:0; top:0; width: 100%; height: 100%;">

				<table cellspacing="0" cellpadding="0" border="0" style=" font-size: 100%; height: 100%; width: 100%"><tr><td align="center" style="vertical-align:middle;">

					<table class="tablecontent" cellspacing="1" cellpadding="1" border="1">
					<tr>
						<td class="toptd">
							<table style="font-size: 100%; height: 100%; width: 100%">
								<tr><td>
								<input type="text" name="rezultat" id="rezultat" value="" onfocus="display(document.racunalo.rezultat.value)" style="border: 0px solid black; -moz-background-clip: initial; -moz-background-inline-policy: initial; -moz-background-origin: initial; font-size: 200%; height: 100%; width: 100%; padding-left: 0.7%;">
								</td></tr>
							</table>
						</td>
					</tr>

					<tr>
						<td class="conttd">
							<table cellspacing="0" cellpadding="0" border="0" style="font-size: 100%; height: 100%; width: 100%">
								<tr>
									<td width="50%">
										<table style="font-size: 100%;" height="100%" width="100%">
											<tr style="display: none" > 
												<td style="display: none; height: 0px;" >
												<div style="width:39px"></div>
												</td>
												<td style="display: none; height: 0px;" >
												<div style="width:39px"></div>
												</td>
												<td style="display: none; height: 0px;" >
												<div style="width:39px"></div>
												</td>
												<td style="display: none; height: 0px;" >
												<div style="width:39px"></div>
												</td>
												<td style="display: none; height: 0px;" >
												<div style="width:39px"></div>
												</td>
												<td style="display: none; height: 0px;" >
												<div style="width:39px"></div>
												</td>
											</tr>


											<tr>
											<td align="center" style="height: 11%; border: 1px solid transparent; background-color: #FAFAFA;" colspan="2">
												<select class="selectbox" name="izaZareza" onchange="if (document.racunalo.oldrezultat.value != '') {zaokruzi(document.racunalo.oldrezultat.value)}; zadatakfocus()"><option value="-1" selected="selected">
													decimal</option><option value="0"> 0 </option><option value="1"> 1 </option><option value="2"> 
													2 </option><option value="3"> 3 </option><option value="4"> 4 </option><option value="5"> 
													5 </option><option value="6"> 6 </option><option value="7"> 7 </option><option value="8"> 
													8 </option><option value="9"> 9 </option><option value="10"> 10 </option><option value="11"> 
													11 </option>
												</select>
											</td>

											<td colspan="2" align="center" style="height: 11%;" style="font-size: 100%;">
												<input style="display:none;" type="radio" name="stupnjevi" checked="checked" title="Radians" onclick="zadatakfocus()">

												<a href="javascript:document.racunalo.stupnjevi[0].click()" onmouseover="self.status='Radians'; return true" style="text-decoration:none; display:none;"><font face="Arial" color="white">Radians</font></a>
											</td>


											<td style="display:none;" align="center" style="height: 11%;" style="font-size: 100%;">
												<input type="radio" style="display:none;" name="stupnjevi" title="Degrees" onclick="zadatakfocus()">
												<a href="javascript:document.racunalo.stupnjevi[1].click()" onmouseover="self.status='Degrees'; return true" style="text-decoration:none; display:none;"><font face="Arial" color="white">Deg</font></a>
											</td>

											<td style="height: 11%;" align="center" title="<--" class="buttonback" onclick="zadatakfocus();" onmousedown="memory(5)">
												<--
											</td>

											<td style="height: 11%;" align="center" title="Clear screen" id="buttonclsid" class="buttoncls" onclick="zadatakfocus();" onmousedown="memory(3)">
												Cls
											</td>

											</tr>
											<tr>
												<td style="height: 11%;" colspan="6">   
													<input onfocus="var val=this.value; this.value=''; this.value= val;" type="text" size="17" name="zadatak" value="" onchange="" onkeydown="if (event.keyCode==13) {enter.click()}" style="border: 0px solid #000000; font-size: 150%; height: 100%; width: 100%; padding-left: 1%;">
												</td>
											</tr>

											<tr> 
												<td id="scientific1" align="center" title="Square root" class="buttonstyl" onclick="zadatakfocus();" onmousedown="izracunaj(3)">
												sqrt
												</td>

												<td id="scientific2" align="center" title="Root" class="buttonstyl" onclick="zadatakfocus();" onmousedown="izracunaj(22)">
												root
												</td>

												<td id="scientific3" align="center" title="Natural logarithm" class="buttonstyl" onclick="zadatakfocus();" onmousedown="izracunaj(5)">
												ln
												</td>

												<td id="scientific4" align="center" title="Common logarithm" class="buttonstyl" onclick="zadatakfocus();" onmousedown="izracunaj(8)">
												log
												</td>
												<td id="scientific5" align="center" title="Tangent" class="buttonstyl" onclick="zadatakfocus();" onmousedown="izracunaj(14)">
												tan
												</td>

												<td id="scientific6" align="center" title="Arc tangent" class="buttonstyl" onclick="zadatakfocus();" onmousedown="izracunaj(10)">
												atan
												</td>
											</tr>



											<tr> 
												<td id="scientific7" align="center" title="Square" class="buttonstyl" onclick="zadatakfocus();" onmousedown="izracunaj(2)">
												x^2
												</td>

												<td id="scientific8" align="center" title="Power" class="buttonstyl" onclick="zadatakfocus();" onmousedown="izracunaj(21)">
												x^y
												</td>

												<td id="scientific9" align="center" title="Natural antilogarithm" class="buttonstyl" onclick="zadatakfocus();" onmousedown="izracunaj(6)">
												e^x
												</td>

												<td id="scientific10" align="center" title="Common antilogarithm" class="buttonstyl" onclick="zadatakfocus();" onmousedown="izracunaj(9)">
												10^x
												</td>

												<td id="scientific11" align="center" title="Cosine" class="buttonstyl" onclick="zadatakfocus();" onmousedown="izracunaj(15)">
												cos
												</td>

												<td id="scientific12" align="center" title="Arc cosine" class="buttonstyl" onclick="zadatakfocus();" onmousedown="izracunaj(11)">
												acos
												</td>
											</tr>


											<tr> 
												<td id="scientific13" align="center" title="Change sign" class="buttonstyl" onclick="zadatakfocus();" onmousedown="izracunaj(4)">
												+/-
												</td>
												<td id="scientific14" align="center" class="buttonstyl" onclick="zadatakfocus();" onmousedown="izracunaj(7)">
												1/x
												</td>
												<td id="scientific15" align="center" title="Factorial" class="buttonstyl" onclick="zadatakfocus();" onmousedown="izracunaj(20)">
												x!
												</td>
												<td id="scientific16" align="center" title="Percent" class="buttonstyl" onclick="zadatakfocus();" onmousedown="izracunaj(17)">
												%
												</td>
												<td id="scientific17" align="center" title="Sine" class="buttonstyl" onclick="zadatakfocus();" onmousedown="izracunaj(16)">
												sin
												</td>
												<td id="scientific18" align="center" title="Arc sine" class="buttonstyl" onclick="zadatakfocus();" onmousedown="izracunaj(12)">
												asin
												</td>
											</tr>

											<tr> 
												<td align="center" title="" class="buttonstylnumpad" onclick="zadatakfocus();" onmousedown="dodajBroj(7)">
												7
												</td>

												<td align="center" title="" class="buttonstylnumpad" onclick="zadatakfocus();" onmousedown="dodajBroj(8)">
												8
												</td>

												<td align="center" title="" class="buttonstylnumpad" onclick="zadatakfocus();" onmousedown="dodajBroj(9)">
												9
												</td>

												<td align="center" title="" class="buttonstylnumpad" onclick="zadatakfocus();" onmousedown="dodajBroj('/')">
												/
												</td>

												<td align="center" title="" class="buttonstylothpad" onclick="zadatakfocus();" onmousedown="dodajBroj('e')">
												E
												</td>

												<td align="center" title="" class="buttonstylothpad" onclick="zadatakfocus();" onmousedown="dodajBroj('Pi')">
												Pi
												</td>
											</tr>



											<tr>
												<td align="center" title="" class="buttonstylnumpad" onclick="zadatakfocus();" onmousedown="dodajBroj(4)">
												4
												</td>

												<td align="center" title="" class="buttonstylnumpad" onclick="zadatakfocus();" onmousedown="dodajBroj(5)">
												5
												</td>

												<td align="center" title="" class="buttonstylnumpad" onclick="zadatakfocus();" onmousedown="dodajBroj(6)">
												6
												</td>

												<td align="center" title="" class="buttonstylnumpad" onclick="zadatakfocus();" onmousedown="dodajBroj('*')">
												*
												</td>

												<td align="center" title="" class="buttonstylothpad" onclick="zadatakfocus();" onmousedown="dodajBroj('(')">
												(
												</td>

												<td align="center" title="" class="buttonstylothpad" onclick="zadatakfocus();" onmousedown="dodajBroj(')')">
												)
												</td>
											</tr>



											<tr>
												<td align="center" title="" class="buttonstylnumpad" onclick="zadatakfocus();" onmousedown="dodajBroj(1)">
												1
												</td>

												<td align="center" title="" class="buttonstylnumpad" onclick="zadatakfocus();" onmousedown="dodajBroj(2)">
												2
												</td>

												<td align="center" title="" class="buttonstylnumpad" onclick="zadatakfocus();" onmousedown="dodajBroj(3)">
												3
												</td>

												<td align="center" title="" class="buttonstylnumpad" onclick="zadatakfocus();" onmousedown="dodajBroj('-')">
												-
												</td>

												<td align="center" title="Memory recall" class="buttonstylmempad" onclick="zadatakfocus();" onmousedown="memory(2)">
												MR
												</td>

												<td align="center" title="Memory store" class="buttonstylmempad" onclick="zadatakfocus();" onmousedown="memory(1); return false;">
												MS
												</td>
											</tr>



											<tr>
												<td align="center" title="" class="buttonstylnumpad" onclick="zadatakfocus();" onmousedown="dodajBroj(0)">
												0
												</td>

												<td align="center" title="" class="buttonstylnumpad" onclick="zadatakfocus();" onmousedown="dodajBroj('.')">
												.
												</td>

												<td align="center" title="" class="buttonstylnumpad" onclick="zadatakfocus();" onmousedown="dodajBroj('(-)')">
												(-)
												</td>

												<td align="center" title="" class="buttonstylnumpad" onclick="zadatakfocus();" onmousedown="dodajBroj('+')">
												+
												</td>

												<td align="center" title="" name="enter" class="buttonstylentpad" id="buttonstylentpadid" onclick="zadatakfocus();" onmousedown="izracunaj(1)" colspan="2">

													<input style="display: none;" type="button" value="=" style="">
													=
													<input style="display: none;" type="button" name="enter" onclick="izracunaj(1)" value="=" style="">
												</td>
											</tr>
										</table>
									</td>

									<td class="membox">
										<table style="font-size: 100%;" width="100%" height="100%" border="0">
											<tr> 
												<td colspan="3">
													<textarea onchange="localStorage.setItem('rememberedtaskhistory', document.racunalo.notes.value);" name="notes" style="border: 0px solid black; opacity:0.8; font-size: 150%; height: 100%; width: 100%; padding-left: 1%; padding-top: 1%;">
													</textarea>
												</td>
											</tr>

											<tr> 
												<td align="center" title="Clear Form" class="buttonstylhistpad" onclick="zadatakfocus();" onmousedown="memory(4)">
												Clear
												</td>

												<td align="center" title="Select All" class="buttonstylhistpad" onclick="zadatakfocus(); document.racunalo.notes.select()" onmousedown="document.racunalo.notes.focus(); document.racunalo.notes.select()">
												Select All
												</td>

												<td align="center" title="Reset Form" class="buttonstylhistpad" onclick="zadatakfocus();" onmousedown="document.racunalo.reset();memory(4);">
												Reset
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>

					<tr class="settingsbuttonclass">
						<td height="5%">
							<table style="font-size: 100%; height: 100%; width: 100%">
								<tr>
								<td>&nbsp;<a style="cursor: pointer; text-decoration:none;" onclick="showhide('settings','block');"><img height="35px" width="35px" src="image/logo05.jpg"></img></a></td>

								<td align="right"></td>

								<td width="1px" style="vertical-align: middle;"></td>
								</tr>
								</table>
								</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</div>
		</form>



<?php include('footer.php'); ?>



		<div id="settings" style="display: none; font-size: 100%; position: fixed; left:0; top:0; width: 100%; height: 100%;">
			<table style="font-size: 100%; vertical-align: middle; width: 100%; height: 100%;">
			<tr><td align="center">
			<table style="background-color: #28285b; font-size: 100%;" width="70%" height="50%">
			<tr>
			<td style="font-size: 100%;">
			<table style="font-size: 100%; width: 100%; height: 100%;">

			<tr>
				<td style="font-family: Century Gothic, sans-serif; border-bottom: 0px white solid; font-size: 100%; color: white; font-size: 150%" height="10%">
				<b>&nbsp;Ajustes</b>
				</td>

				<td style="border-bottom: 0px white solid;" align="right">
				<a style="cursor: pointer; text-decoration:none;" onclick="showhide('settings','none');"><img height="30px" width="30px" src="image/imagenX.jpg"></img></a>
				</td>
			</tr>

			<tr>
				<td style="font-size: 100%; color: white; vertical-align: top; font-family: Century Gothic, sans-serif;" height="90%" colspan="2">
					<br><hr>
					<br>
					<form id='halooo' name='halooo'><input onclick="checker()" type="checkbox" name="remember" id="remember" /> Recordar el historial de tareas en el navegador
						<br><hr>
						<br>
						<b>&nbsp;Seleccionar Fondo</b>
							&nbsp; 
							<select style="min-width: 100px; 
										margin-top: 7px; 
										padding-left: 1%; 
										border-width: 0px; 
										width: 30%; 
										font-size: 100%;" name="selectskin" size="1" onchange="skinchange()">
									<option value="Default" selected="selected"> Defecto </option>
									<option value="Gray-Blue"> Gris-Azul </option>
									<option value="Wood"> Escritorio </option>
							</select>
					</form>
				</td>
			</tr>
		</div>
	</body>

	<script> 
			function checker (){

			if(document.halooo.remember.checked == true){

			localStorage.setItem('preferremember', 'yes');

			localStorage.setItem('rememberedtaskhistory', document.racunalo.notes.value);

			}

			if(document.halooo.remember.checked == false){

			localStorage.setItem('preferremember', 'no');

			localStorage.setItem('rememberedtaskhistory', '');

			}
			}


			function skinchange(){

			if (document.halooo.selectskin.value=="Gray-Blue"){

			localStorage.setItem('preferredskin', 'Gray-Blue');

			document.body.className = "normalbody";

			document.getElementById('rezultat').style.background = "#73C3D9 none repeat scroll 0%";
			document.getElementById('buttonclsid').className = "buttonclsblue";

			document.getElementById('scientific1').className = "buttonstylblue";
			document.getElementById('scientific2').className = "buttonstylblue";
			document.getElementById('scientific3').className = "buttonstylblue";
			document.getElementById('scientific4').className = "buttonstylblue";
			document.getElementById('scientific5').className = "buttonstylblue";
			document.getElementById('scientific6').className = "buttonstylblue";
			document.getElementById('scientific7').className = "buttonstylblue";
			document.getElementById('scientific8').className = "buttonstylblue";
			document.getElementById('scientific9').className = "buttonstylblue";
			document.getElementById('scientific10').className = "buttonstylblue";
			document.getElementById('scientific11').className = "buttonstylblue";
			document.getElementById('scientific12').className = "buttonstylblue";
			document.getElementById('scientific13').className = "buttonstylblue";
			document.getElementById('scientific14').className = "buttonstylblue";
			document.getElementById('scientific15').className = "buttonstylblue";
			document.getElementById('scientific16').className = "buttonstylblue";
			document.getElementById('scientific17').className = "buttonstylblue";
			document.getElementById('scientific18').className = "buttonstylblue";
					
			document.getElementById('buttonstylentpadid').className = "buttonstylentpadblue";

			}

			if (document.halooo.selectskin.value=="Default"){

			localStorage.setItem('preferredskin', 'Default');

			document.body.className = "normalbody";

			document.getElementById('rezultat').style.background = "rgb(239, 239, 239) none repeat scroll 0%";
			document.getElementById('buttonclsid').className = "buttoncls";

			document.getElementById('scientific1').className = "buttonstyl";
			document.getElementById('scientific2').className = "buttonstyl";
			document.getElementById('scientific3').className = "buttonstyl";
			document.getElementById('scientific4').className = "buttonstyl";
			document.getElementById('scientific5').className = "buttonstyl";
			document.getElementById('scientific6').className = "buttonstyl";
			document.getElementById('scientific7').className = "buttonstyl";
			document.getElementById('scientific8').className = "buttonstyl";
			document.getElementById('scientific9').className = "buttonstyl";
			document.getElementById('scientific10').className = "buttonstyl";
			document.getElementById('scientific11').className = "buttonstyl";
			document.getElementById('scientific12').className = "buttonstyl";
			document.getElementById('scientific13').className = "buttonstyl";
			document.getElementById('scientific14').className = "buttonstyl";
			document.getElementById('scientific15').className = "buttonstyl";
			document.getElementById('scientific16').className = "buttonstyl";
			document.getElementById('scientific17').className = "buttonstyl";
			document.getElementById('scientific18').className = "buttonstyl";
					
			document.getElementById('buttonstylentpadid').className = "buttonstylentpad";

			}

			if (document.halooo.selectskin.value=="Wood"){

			localStorage.setItem('preferredskin', 'Wood');

			document.body.className = "bodywood";

			document.getElementById('rezultat').style.background = "rgb(239, 239, 239) none repeat scroll 0%";
			document.getElementById('buttonclsid').className = "buttoncls";

			document.getElementById('scientific1').className = "buttonstyl";
			document.getElementById('scientific2').className = "buttonstyl";
			document.getElementById('scientific3').className = "buttonstyl";
			document.getElementById('scientific4').className = "buttonstyl";
			document.getElementById('scientific5').className = "buttonstyl";
			document.getElementById('scientific6').className = "buttonstyl";
			document.getElementById('scientific7').className = "buttonstyl";
			document.getElementById('scientific8').className = "buttonstyl";
			document.getElementById('scientific9').className = "buttonstyl";
			document.getElementById('scientific10').className = "buttonstyl";
			document.getElementById('scientific11').className = "buttonstyl";
			document.getElementById('scientific12').className = "buttonstyl";
			document.getElementById('scientific13').className = "buttonstyl";
			document.getElementById('scientific14').className = "buttonstyl";
			document.getElementById('scientific15').className = "buttonstyl";
			document.getElementById('scientific16').className = "buttonstyl";
			document.getElementById('scientific17').className = "buttonstyl";
			document.getElementById('scientific18').className = "buttonstyl";
					
			document.getElementById('buttonstylentpadid').className = "buttonstylentpad";

			}


			}



			var preferremember = localStorage.getItem("preferremember");

			var rememberedtaskhistory = localStorage.getItem("rememberedtaskhistory");



			if (preferremember=='yes'){

			document.halooo.remember.checked = true;

			document.racunalo.notes.value = rememberedtaskhistory;

			document.racunalo.notes.scrollTop = document.racunalo.notes.scrollHeight - document.racunalo.notes.clientHeight;

			} else {

			document.halooo.remember.checked = false;

			document.racunalo.notes.value = '';

			}


			var preferredskin = localStorage.getItem("preferredskin");
			if (preferredskin=="Gray-Blue"){

			document.halooo.selectskin.value = "Gray-Blue";

			document.body.className = "normalbody";

			document.getElementById('rezultat').style.background = "#73C3D9 none repeat scroll 0%";
			document.getElementById('buttonclsid').className = "buttonclsblue";

			document.getElementById('scientific1').className = "buttonstylblue";
			document.getElementById('scientific2').className = "buttonstylblue";
			document.getElementById('scientific3').className = "buttonstylblue";
			document.getElementById('scientific4').className = "buttonstylblue";
			document.getElementById('scientific5').className = "buttonstylblue";
			document.getElementById('scientific6').className = "buttonstylblue";
			document.getElementById('scientific7').className = "buttonstylblue";
			document.getElementById('scientific8').className = "buttonstylblue";
			document.getElementById('scientific9').className = "buttonstylblue";
			document.getElementById('scientific10').className = "buttonstylblue";
			document.getElementById('scientific11').className = "buttonstylblue";
			document.getElementById('scientific12').className = "buttonstylblue";
			document.getElementById('scientific13').className = "buttonstylblue";
			document.getElementById('scientific14').className = "buttonstylblue";
			document.getElementById('scientific15').className = "buttonstylblue";
			document.getElementById('scientific16').className = "buttonstylblue";
			document.getElementById('scientific17').className = "buttonstylblue";
			document.getElementById('scientific18').className = "buttonstylblue";
					
			document.getElementById('buttonstylentpadid').className = "buttonstylentpadblue";

			}

			if (preferredskin=="Default"){

			document.halooo.selectskin.value = "Default";

			document.body.className = "normalbody";

			document.getElementById('rezultat').style.background = "rgb(239, 239, 239) none repeat scroll 0%";
			document.getElementById('buttonclsid').className = "buttoncls";

			document.getElementById('scientific1').className = "buttonstyl";
			document.getElementById('scientific2').className = "buttonstyl";
			document.getElementById('scientific3').className = "buttonstyl";
			document.getElementById('scientific4').className = "buttonstyl";
			document.getElementById('scientific5').className = "buttonstyl";
			document.getElementById('scientific6').className = "buttonstyl";
			document.getElementById('scientific7').className = "buttonstyl";
			document.getElementById('scientific8').className = "buttonstyl";
			document.getElementById('scientific9').className = "buttonstyl";
			document.getElementById('scientific10').className = "buttonstyl";
			document.getElementById('scientific11').className = "buttonstyl";
			document.getElementById('scientific12').className = "buttonstyl";
			document.getElementById('scientific13').className = "buttonstyl";
			document.getElementById('scientific14').className = "buttonstyl";
			document.getElementById('scientific15').className = "buttonstyl";
			document.getElementById('scientific16').className = "buttonstyl";
			document.getElementById('scientific17').className = "buttonstyl";
			document.getElementById('scientific18').className = "buttonstyl";
					
			document.getElementById('buttonstylentpadid').className = "buttonstylentpad";

			}

			if (preferredskin=="Wood"){

			document.halooo.selectskin.value = "Wood";

			document.body.className = "bodywood";

			document.getElementById('rezultat').style.background = "rgb(239, 239, 239) none repeat scroll 0%";
			document.getElementById('buttonclsid').className = "buttoncls";

			document.getElementById('scientific1').className = "buttonstyl";
			document.getElementById('scientific2').className = "buttonstyl";
			document.getElementById('scientific3').className = "buttonstyl";
			document.getElementById('scientific4').className = "buttonstyl";
			document.getElementById('scientific5').className = "buttonstyl";
			document.getElementById('scientific6').className = "buttonstyl";
			document.getElementById('scientific7').className = "buttonstyl";
			document.getElementById('scientific8').className = "buttonstyl";
			document.getElementById('scientific9').className = "buttonstyl";
			document.getElementById('scientific10').className = "buttonstyl";
			document.getElementById('scientific11').className = "buttonstyl";
			document.getElementById('scientific12').className = "buttonstyl";
			document.getElementById('scientific13').className = "buttonstyl";
			document.getElementById('scientific14').className = "buttonstyl";
			document.getElementById('scientific15').className = "buttonstyl";
			document.getElementById('scientific16').className = "buttonstyl";
			document.getElementById('scientific17').className = "buttonstyl";
			document.getElementById('scientific18').className = "buttonstyl";
					
			document.getElementById('buttonstylentpadid').className = "buttonstylentpad";

			}

			zadatakfocus()
	</script>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="js/script.js"></script>
</html>