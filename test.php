<!DOCTYPE HTML>
<html>

<head>
    <?php
    session_start();

	if ($_SESSION["nomina"] == "" && $_SESSION["nomina"]== null && $_SESSION["email"]== "" && $_SESSION["email"]== null) {
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='1; URL=index.html'>";
		session_destroy();
	}else{
	    session_start();
	}
	?>
	
	<input type="text" style='display:none;' id="txtEmail" value="<?php echo $_SESSION["email"]?>"/>
	<input type="text" style='display:none;' id="txtNomina" value="<?php echo $_SESSION["nomina"]?>"/>
	
	<title>Grammer Queretaro</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="assets/css/main.css" />
	<link rel="stylesheet" href="css/botones.css" />
	<noscript>
		<link rel="stylesheet" href="assets/css/noscript.css" />
	</noscript>
</head>

<body class="is-preload">

	<!-- Wrapper -->
	<div id="wrapper">

		<!-- Header -->
		<header id="header" class="alt">
			<span class="logo"><img style="width: 35%;" src="images/Grammer_Logo_Original_White_sRGB_screen_transparent.png" alt="" /></span>
			<h1>Bonos de salida</h1>
			<p>Bonos de salida electrónicos, una opción alternativa<br />
				del bono de salida actual, con el soporte del departamento de <a href="#">Controlling</a>.</p>
		</header>

		<!-- Nav -->
		<nav id="nav">
			<ul>
				<li><a href="#intro" class="active">Inicio</a></li>
				<li><a href="https://arketipo.mx/Vigilancia/Login_v1/index.html">Solicitudes</a></li>
				<li><a href="#">Dudas o preguntas</a></li>
			</ul>
		</nav>

		<!-- Main -->
		<div id="main">

            <div id='registroConcluido' id='carga' style='display:none;'></div>
			<!-- First Section -->
			<div id='registroConcluido' style='display:none;'>
    			<section id="first" class="main special">
    				<header class="major">
    					<h2 style='color:green;padding-top: 10%;'>Se concluyo el registro.</h2>
    				</header>
    				<img style='width: 24%;' src='images/like.png'>
    				<p style='padding: 4%;'>Se ha validado correctamente este registro favor de esperar a la confirmacion de su encargado que le llegara mediante correo en dado caso que no resiva respuesta checarlo con su encarga y si no recibio ningun correo su encarga ponerse en contacto directo con IT</p>
    				<a style='margin-bottom: 10%;margin-top: -2%;' id="guardarRegistro" onclick="test();" class="btn btnGreen">Regresar</a>
    			</section>
			</div>
			
			<div id='registroFallido' style='display:none;'>
    			<section id="first" class="main special">
    				<header class="major">
    					<h2 style='color:red;'>Algo salio mal.</h2>
    				</header>
    				<img style='width: 24%;' src='images/dislike.png'>
    				<p style='padding: 4%;'>Se ha validado correctamente este registro favor de esperar a la confirmacion de su encargado que le llegara mediante correo en dado caso que no resiva respuesta checarlo con su encarga y si no recibio ningun correo su encarga ponerse en contacto directo con IT</p>
    				<a style='margin-bottom: 10%;margin-top: -2%;' id="guardarRegistro" onclick="test();" class="btn btnRed">Regresar</a>
    			</section>
			</div>
        </div>
			

		</div>
		<!-- Footer -->
		<footer id="footer">
			<section>
				<h2>Dudas y preguntas.</h2>
				<p>Para dudas, problemas o sugerencias que tengas acerca del proceso del software te puedes comunicar directamente con el departamento de IT o de Controlling.</p>
			</section>
			<p class="copyright">&copy; Grammer Queretaro. Design: <a href="">Grammer Queretaro</a>.</p>
		</footer>

	</div>

	<!-- Scripts -->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/jquery.scrollex.min.js"></script>
	<script src="assets/js/jquery.scrolly.min.js"></script>
	<script src="assets/js/browser.min.js"></script>
	<script src="assets/js/breakpoints.min.js"></script>
	<script src="assets/js/util.js"></script>
	<script src="assets/js/main.js"></script>
	<script src="js/registro.js"></script>

	<script>
	
					
	
	    document.getElementById("guardarRegistro").addEventListener("click", function(event){
		    event.preventDefault();
		});
	
		$(document).ready(function(){
			$('#guardar').click(function(){
				enviar();
			});
		});
		
		const ayuda = document.querySelector("#sltRetorno");
		ayuda.addEventListener('change', (event) => {
			const ntes = event.target.value;

			if (ntes == "Sí") {
				$('#txtFechaRetorno').css('display', 'block');
				$('#fech').css('display', 'block');
				
			} else if (ntes == "No") {
				$('#txtFechaRetorno').css('display', 'none');
				$('#fech').css('display', 'none');
			} else {
				$('#txtFechaRetorno').css('display', 'none');
				$('#fech').css('display', 'none');
			}

		});
		
		
	</script>

</body>

</html>