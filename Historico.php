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

	<input type="text" style='display:none;' id="txtNomina" value="<?php echo $_SESSION["nomina"]?>"/>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
		  integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
	<title>Grammer Queretaro</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="assets/css/main.css" />
	<noscript>
		<link rel="stylesheet" href="assets/css/noscript.css" />
	</noscript>
	<link rel="shortcut icon" href="lib/assets/img/iconoarriba.png" />

	<style>

		body {
			background-color: #292929;
		}

		@media only screen and (max-width: 768px) {
			#navegadorMovil {
				display: block !important;
			}
		}


	</style>
</head>

<body class="is-preload">

<nav id="navegadorMovil" class="navbar navbar-dark bg-dark fixed-top" style='background-color: rgb(255 0 0 / 0%) !important;display:none;'>
	<div class="container-fluid">
		<button class="navbar-toggler f-r" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
			<div class="offcanvas-header">
				<h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Menu bono de salida.</h5>
				<button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
			</div>
			<div class="offcanvas-body">
				<ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
					<li class="nav-item">
						<a class="nav-link" aria-current="page" href="https://arketipo.mx/Controlling/BonoSalida/RegistroSalida.php">Inicio</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" href="https://arketipo.mx/Controlling/BonoSalida/Historico.php">Historico</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</nav>

<!-- Wrapper -->
<div id="wrapper">

	<!-- Header -->
	<header id="header" class="alt">
            <span class="logo"><img style="width: 35%;"
									src="images/Grammer_Logo_Original_White_sRGB_screen_transparent.png" alt="" /></span>
		<h1>Bonos de salida</h1>
		<p>Bonos de salida electrónicos, una opción alternativa<br />
			del bono de salida actual, con el soporte del departamento de <a
				href="">Controlling</a>.</p>
	</header>

	<!-- Nav -->
	<nav id="nav">
		<ul>
			<li><a href="https://arketipo.mx/Controlling/BonoSalida/RegistroSalida.php" >Inicio</a></li>
			<li><a href="https://arketipo.mx/Controlling/BonoSalida/Historico.php" class="active">Historico</a></li>
		</ul>
	</nav>

	<!-- Main -->
	<div id="main">

		<div id='carga' style='display:none;'></div>
		<!-- First Section -->
		<section id="first" class="main special">
			<h2 style='margin-top:-35px;'>Busqueda por filtros.</h2>
			<div class="row gtr-uniform">
				<div class="col-3 col-12-xsmall">
					<label for='txtFolio'>Folio</label>
					<input type="text" name="demo-name" id="txtFolio" value="" placeholder="Folio" />
				</div>
				<div class="col-3 col-12-xsmall">
					<label for='txtFechaInicio'>Fecha inicio : </label>
					<input type="date" name="demo-email" id="txtFechaInicio" value="" placeholder="Email" />
				</div>
				<div class="col-3 col-12-xsmall">
					<label for='txtFechaFin'>Fecha fin :</label>
					<input type="date" name="demo-email" id="txtFechaFin" value="" placeholder="Email" />
				</div>
				<div style='display:flex;justify-content: center;' class="col-3 col-12-xsmall">
					<button type="submit" id="btnBuscar" onclick="cargaInicial()" class="btn btn-success">Buscar bono de salida</button>
				</div>
			</div>
			<hr>

			<header class="major">
				<h2 id="tituloConfirmadosPendientes" style="display: none">Bonos de salida confirmados y pendientes en salir.</h2>
			</header>
			<div >
				<div id='cartasConfirmadosPendientes' class="row">

				</div>
			</div>
			
			<header class="major">
				<h2 id="tituloNoConfirmadosPendientes" style="display: none">Bonos de salida pendientes.</h2>
			</header>
			<div >
				<div id='cartasNoConfirmadosPendientes' class="row">

				</div>
			</div>

			<header class="major">
				<h2 id="tituloSalidas" style="display: none">Bonos de salida que se encuentras fuera de planta.</h2>
			</header>

			<div id="cartasFueraPlanta" class="row">

			</div>

			<header class="major">
				<h2 id="tituloRechazadas" style="display: none">Bonos de salida rechazados.</h2>
			</header>
			<div >
				<div id='cartasRechazados' class="row">
				</div>
			</div>

			<header class="major">
				<h2 id="tituloCompletos" style="display: none">Bonos de salida completos.</h2>
			</header>
			<div >
				<div id='cartasCompletos' class="row">
				</div>
			</div>

		</section>
	</div>


</div>
<!-- Footer -->
<footer id="footer">

	<p class="copyright">&copy; Grammer Queretaro. Design: <a href="">Grammer Queretaro</a>.</p>
</footer>

</div>

<!-- Modal -->
<div class="modal fade clearfix" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
	 aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="exampleModalLabel" style='color:black'>Bono de Salida</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body" style='color:black;padding: 40px;'>
				<h4 style='color:black'>Informacion de la solicitud.</h4>
				<ul style='margin: 0 0 0.5em 0 !important;'>
					<li id='txtNombre'><b style='color:black'>Nombre : </b>Hadbet Ayari Altamirano Martinez</li>
					<li id='txtDescripcion'><b style='color:black'>Descripción : </b>HP Firefly</li>
					<li id='txtCantidad'><b style='color:black'>Cantidad : </b>Tarimas</li>
					<li id='txtUnidadMedida'><b style='color:black'>U/M : </b>S</li>
					<li id='txtEmpresa'><b style='color:black'>Empresa : </b>S</li>
					<li id='txtDireccion'><b style='color:black'>Dirección de destino : </b>S</li>
					<li id='txtNombreExterno'><b style='color:black'>Nombre del responsable externo : </b>S</li>
					<li id='txtTipoMaterial'><b style='color:black'>Tipo de material : </b>S</li>
					<li id='txtCausa'><b style='color:black'>Causa de la salida : </b>S</li>
					<li id='txtComentarios'><b style='color:black'>Cometarios adicionales : </b>S</li>
					<li id='txtFechaRetorno'><b style='color:black'>Fecha de retorno : </b>S</li>
					<li style='display:none' id='txtBitacora'><b style='color:black'>Fecha de retorno : </b>S</li>
				</ul>
				<hr>
				<center><img id='imgRegistro' class="img-fluid rounded-start" alt="..."></center>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" onclick='reversa();'
						data-bs-dismiss="modal">Close</button>
				<button type="button" onclick='actualizarEstatus(1);' class="btn btn-success">Confirmar</button>
				<button type="button" class="btn btn-danger" data-bs-toggle="modal"
						data-bs-target="#exampleModalToggle2">Rechazar</button>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
	 tabindex="-1">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="exampleModalToggleLabel2" style='color:black'>Rechazo de bono de
					salida</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="col-12">
					<h4 style='color:black'>¿Por que estas rechazando el bono de salida?</h4>
					<textarea
						style="resize:none; margin-bottom: 15px; margin-top: 15px;border-color: darkgray;color:black;"
						placeholder="Causa" rows="6" name="causa" id="txtCausaAux" required></textarea>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" onclick='reversa();'
						data-bs-dismiss="modal">Cancelar</button>
				<button class="btn btn-danger" data-bs-target="#exampleModalToggle" data-bs-toggle="modal"
						onclick='actualizarEstatus(2);'>Confirmar Rechazo</button>
			</div>
		</div>
	</div>
</div>

<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/jquery.scrollex.min.js"></script>
<script src="assets/js/jquery.scrolly.min.js"></script>
<script src="assets/js/browser.min.js"></script>
<script src="assets/js/breakpoints.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
		crossorigin="anonymous"></script>


<script>

	var idBitacora, imagenRegistro, correoSolicitante, nominaSolicitante, nombreSolicitante, descripcion, cantidad, unidadMedida, empresa, nombreExterno, direccion, tipoSalida, fechaRetorno, tipoRetorno, causa, comentarios, tipo, email;


	function limpiarPantalla(IdBitacora, ImagenRegistro, CorreoSolicitante, NominaSolicitante, NombreSolicitante, Descripcion, Cantidad, UnidadMedida, Empresa, NombreExterno, Direccion, TipoSalida, FechaRetorno, TipoRetorno, Causa, Comentarios, correoSolicitante, tipo) {
		if (tipo == "0") {
			document.getElementById('nav').style.display = 'none';

			idBitacora = IdBitacora;
			imagenRegistro = ImagenRegistro;
			correoSolicitante = CorreoSolicitante;
			nominaSolicitante = NominaSolicitante;
			nombreSolicitante = NombreSolicitante;
			descripcion = Descripcion;
			cantidad = Cantidad;
			unidadMedida = UnidadMedida;
			empresa = Empresa;
			nombreExterno = NombreExterno;
			direccion = Direccion;
			tipoSalida = TipoSalida;
			fechaRetorno = FechaRetorno;
			tipoRetorno = TipoRetorno;
			causa = Causa;
			comentario = Comentarios;
			email = correoSolicitante;

			document.getElementById('txtNombre').innerHTML = "<b style='color:black'>Nombre : </b>" + NombreSolicitante;
			document.getElementById('txtDescripcion').innerHTML = "<b style='color:black'>Descripción : </b>" + Descripcion;
			document.getElementById('txtCantidad').innerHTML = "<b style='color:black'>Cantidad : </b>" + Cantidad;
			document.getElementById('txtUnidadMedida').innerHTML = "<b style='color:black'>U/M : </b>" + UnidadMedida;
			document.getElementById('txtEmpresa').innerHTML = "<b style='color:black'>Empresa : </b>" + Empresa;
			document.getElementById('txtDireccion').innerHTML = "<b style='color:black'>Dirección de destino : </b>" + Direccion;
			document.getElementById('txtNombreExterno').innerHTML = "<b style='color:black'>Nombre del responsable externo : </b>" + NombreExterno;
			document.getElementById('txtTipoMaterial').innerHTML = "<b style='color:black'>Tipo de material : </b>" + TipoSalida;
			document.getElementById('txtCausa').innerHTML = "<b style='color:black'>Causa de la salida : </b>" + Causa;
			document.getElementById('txtComentarios').innerHTML = "<b style='color:black'>Cometarios adicionales : </b>" + Comentarios;
			if (TipoRetorno = 'no') {
				document.getElementById('txtFechaRetorno').innerHTML = "<b style='color:black'>Fecha de retorno : </b> Material no retorna.";
			} else {
				document.getElementById('txtFechaRetorno').innerHTML = "<b style='color:black'>Fecha de retorno : </b>" + FechaRetorno;
			}
			document.getElementById('txtBitacora').innerHTML = "<b style='color:black'>Fecha de retorno : </b>" + IdBitacora;
			document.getElementById('imgRegistro').src = "dao/fotos/registro/" + ImagenRegistro + ".png";
		}
	}

	function reversa() {
		document.getElementById('nav').style.display = 'block';
	}
	
	function capitalizeFirstLetter(string) {
      return string.charAt(0).toUpperCase() + string.slice(1);
    }

	cargaInicial();
	function cargaInicial() {
	    
	    var correoElectronico = "<?php echo $_SESSION["email"]?>";
        var nombreUsuario = correoElectronico.split("@")[0].replace(".", "%20").toLowerCase();;
        nombreUsuario = nombreUsuario.split(" ").map(capitalizeFirstLetter).join("%20");

		var nominaAux,folio,fechaInicio,fechaFin,estatus,a,b,c,d,imagenEntrega;
		nominaAux = document.getElementById('txtNomina').value;

		folio = document.getElementById("txtFolio").value;
		fechaInicio = document.getElementById("txtFechaInicio").value;
		fechaFin = document.getElementById("txtFechaFin").value;

		if (folio==""){folio="n";}
		if (fechaInicio==""){fechaInicio="n";}
		if (fechaFin==""){fechaFin="n";}
		
		var bandera = '0';
		

		console.log('https://arketipo.mx/Controlling/BonoSalida/dao/DaoHistoricoCoordinadores.php?nomina='+nombreUsuario+'&folio='+folio+'&fechaInicio='+fechaInicio+'&fechaFin='+fechaFin);
		
		$.getJSON('https://arketipo.mx/Controlling/BonoSalida/dao/DaoHistoricoOperativo.php?nomina='+nominaAux+'&folio='+folio+'&fechaInicio='+fechaInicio+'&fechaFin='+fechaFin, function (data) {

			document.getElementById("cartasConfirmadosPendientes").innerHTML='';
			document.getElementById("cartasRechazados").innerHTML='';
			document.getElementById("cartasFueraPlanta").innerHTML='';
			document.getElementById("cartasCompletos").innerHTML='';
			document.getElementById("cartasNoConfirmadosPendientes").innerHTML='';

			document.getElementById("tituloCompletos").style.display="none";
			document.getElementById("tituloRechazadas").style.display="none";
			document.getElementById("tituloSalidas").style.display="none";
			document.getElementById("tituloConfirmadosPendientes").style.display="none";
			document.getElementById("tituloNoConfirmadosPendientes").style.display="none";

			a=0;b=0;c=0;d=0;

			for (var i = 0; i < data.data.length; i++) {

				//Bonos de salida confirmados y pendientes por salir
				if (data.data[i].ConfirmacionPlant=="1" || data.data[i].ConfirmacionControlling=="1" || data.data[i].ConfirmacionEhs=="1" || data.data[i].ConfirmacionEncargado=="1"){
					if (data.data[i].ConfirmacionVigilancia == "0"){
						if ( data.data[i].ConfirmacionPlant!="2" && data.data[i].ConfirmacionControlling!="2" && data.data[i].ConfirmacionEhs!="2" && data.data[i].ConfirmacionEncargado!="2" && data.data[i].ConfirmacionVigilancia!="2"){
							a=1;
							if (a>0){document.getElementById("tituloConfirmadosPendientes").style.display='block';}
                            bandera = '2';
							$('#cartasConfirmadosPendientes').append("<div class='col-4 col-12-xsmall' style='text-align: -webkit-center; margin-top:5%; margin-bottom:5%;padding-left: 10px;'>\n" +
								"                    <div class=\"card text-center\" style='border-color: green !important;'>\n" +
								"                        <div class=\"card-header\">\n" +
								"                            Folio: "+data.data[i].IdBitacora+" \n" +
								"                        </div>\n" +
								"                        <div class=\"card-body\">\n" +
								"\n" +
								"                            <h5 class=\"card-title\">Descripcion</h5>\n" +
								"                            <p class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Descripcion+"</p>\n" +
								"\n" +
								"                            <h5 class=\"card-title\">Causa de salida</h5>\n" +
								"                            <p class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Causa+"</p>\n" +
								"\n" +
								"                            <h5 class=\"card-title\">Empresa</h5>\n" +
								"                            <p class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Empresa+"</p>\n" +
								"\n" +
								"                            <h5 class=\"card-title\">Direccion de destino</h5>\n" +
								"                            <p class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Direccion+"</p>\n" +
								"\n" +
								"                            <h5 class=\"card-title\">Cantidad</h5>\n" +
								"                            <p class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Cantidad+"</p>\n" +
								"                           <a style='color:white;' class='btn btn-info' href='https://arketipo.mx/Controlling/BonoSalida/ConsultaBono.html?0eb20346="+data.data[i].ImagenRegistro+"'>Ver detalles</a>\n" +
								"\n" +
								"                        </div>\n" +
								"                        <div class=\"card-footer text-body-secondary\">\n" +
								"                            "+data.data[i].FechaRegistro+"\n" +
								"                        </div>\n" +
								"                    </div>\n" +
								"                </div>");
						}

					}
				}

				//Bonos de salida reechazados
				if (data.data[i].ConfirmacionPlant=="2" || data.data[i].ConfirmacionControlling=="2" || data.data[i].ConfirmacionEhs=="2" || data.data[i].ConfirmacionEncargado=="2" || data.data[i].ConfirmacionVigilancia=="2"){
					b=1;
					if (b>0){document.getElementById("tituloRechazadas").style.display='block';}
                            bandera = '2';
					$('#cartasRechazados').append("<div class='col-4 col-12-xsmall' style='text-align: -webkit-center; margin-top:5%; margin-bottom:5%;padding-left: 10px;'>\n" +
						"                    <div class=\"card text-center\" style='border-color: red !important;'>\n" +
						"                        <div class=\"card-header\">\n" +
						"                            Folio: "+data.data[i].IdBitacora+" \n" +
						"                        </div>\n" +
						"                        <div class=\"card-body\">\n" +
						"\n" +
						"                            <h5 class=\"card-title\">Descripcion</h5>\n" +
						"                            <p class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Descripcion+"</p>\n" +
						"\n" +
						"                            <h5 class=\"card-title\">Causa de salida</h5>\n" +
						"                            <p class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Causa+"</p>\n" +
						"\n" +
						"                            <h5 class=\"card-title\">Empresa</h5>\n" +
						"                            <p class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Empresa+"</p>\n" +
						"\n" +
						"                            <h5 class=\"card-title\">Direccion de destino</h5>\n" +
						"                            <p class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Direccion+"</p>\n" +
						"\n" +
						"                            <h5 class=\"card-title\">Cantidad</h5>\n" +
						"                            <p class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Cantidad+"</p>\n" +
						"\n" +
						"                            <h5 class=\"card-title\">Retroalimentacion de rechazo : </h5>\n" +
						"                            <p style='color: darkred' class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Retroalimentacion+"</p>\n" +
						"                           <a style='color:white;' class='btn btn-info' href='https://arketipo.mx/Controlling/BonoSalida/ConsultaBono.html?0eb20346="+data.data[i].ImagenRegistro+"'>Ver detalles</a>\n" +
						"\n" +
						"                        </div>\n" +
						"                        <div class=\"card-footer text-body-secondary\">\n" +
						"                            "+data.data[i].FechaRegistro+"\n" +
						"                        </div>\n" +
						"                    </div>\n" +
						"                </div>");
				}

				//Bonos de salida que se encuentran fuera de planta
				if (data.data[i].ConfirmacionPlant=="1" && data.data[i].ConfirmacionControlling=="1" && data.data[i].ConfirmacionEhs=="1" && data.data[i].ConfirmacionEncargado=="1" && data.data[i].ConfirmacionVigilancia == "1" && data.data[i].TipoRetorno == "Si" && data.data[i].ImagenEntrega == ""){
					c=1;
					if (c>0){document.getElementById("tituloSalidas").style.display='block';}
                            bandera = '2';
					$('#cartasFueraPlanta').append("<div class='col-4 col-12-xsmall' style='text-align: -webkit-center; margin-top:5%; margin-bottom:5%;padding-left: 10px;'>\n" +
						"                    <div class=\"card text-center\" style='border-color: darkorange !important;'>\n" +
						"                        <div class=\"card-header\">\n" +
						"                            Folio: "+data.data[i].IdBitacora+" \n" +
						"                        </div>\n" +
						"                        <div class=\"card-body\">\n" +
						"\n" +
						"                            <h5 class=\"card-title\">Descripcion</h5>\n" +
						"                            <p class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Descripcion+"</p>\n" +
						"\n" +
						"                            <h5 class=\"card-title\">Causa de salida</h5>\n" +
						"                            <p class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Causa+"</p>\n" +
						"\n" +
						"                            <h5 class=\"card-title\">Empresa</h5>\n" +
						"                            <p class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Empresa+"</p>\n" +
						"\n" +
						"                            <h5 class=\"card-title\">Direccion de destino</h5>\n" +
						"                            <p class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Direccion+"</p>\n" +
						"\n" +
						"                            <h5 class=\"card-title\">Cantidad</h5>\n" +
						"                            <p class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Cantidad+"</p>\n" +
						"                           <a style='color:white;' class='btn btn-info' href='https://arketipo.mx/Controlling/BonoSalida/ConsultaBono.html?0eb20346="+data.data[i].ImagenRegistro+"'>Ver detalles</a>\n" +
						"\n" +
						"                        </div>\n" +
						"                        <div class=\"card-footer text-body-secondary\">\n" +
						"                            "+data.data[i].FechaRegistro+"\n" +
						"                        </div>\n" +
						"                    </div>\n" +
						"                </div>");
				}

				if (data.data[i].TipoRetorno=="No"){
					imagenEntrega="Ocupado";
				}else {
					imagenEntrega=data.data[i].ImagenEntrega;
				}

				//Bonos de salida completos
				if (data.data[i].ConfirmacionPlant=="1" && data.data[i].ConfirmacionControlling=="1" && data.data[i].ConfirmacionEhs=="1" && data.data[i].ConfirmacionEncargado=="1" && data.data[i].ConfirmacionVigilancia=="1" && imagenEntrega!="" ){
					d=1;
					if (d>0){document.getElementById("tituloCompletos").style.display='block';}
                            bandera = '2';
					$('#cartasCompletos').append("<div class='col-4 col-12-xsmall' style='text-align: -webkit-center; margin-top:5%; margin-bottom:5%;padding-left: 10px;'>\n" +
						"                    <div class=\"card text-center\" style='border-color: gray !important;'>\n" +
						"                        <div class=\"card-header\">\n" +
						"                            Folio: "+data.data[i].IdBitacora+" \n" +
						"                        </div>\n" +
						"                        <div class=\"card-body\">\n" +
						"\n" +
						"                            <h5 class=\"card-title\">Descripcion</h5>\n" +
						"                            <p class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Descripcion+"</p>\n" +
						"\n" +
						"                            <h5 class=\"card-title\">Causa de salida</h5>\n" +
						"                            <p class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Causa+"</p>\n" +
						"\n" +
						"                            <h5 class=\"card-title\">Empresa</h5>\n" +
						"                            <p class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Empresa+"</p>\n" +
						"\n" +
						"                            <h5 class=\"card-title\">Direccion de destino</h5>\n" +
						"                            <p class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Direccion+"</p>\n" +
						"\n" +
						"                            <h5 class=\"card-title\">Cantidad</h5>\n" +
						"                            <p class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Cantidad+"</p>\n" +
						"                           <a style='color:white;' class='btn btn-info' href='https://arketipo.mx/Controlling/BonoSalida/ConsultaBono.html?0eb20346="+data.data[i].ImagenRegistro+"'>Ver detalles</a>\n" +
						"\n" +
						"                        </div>\n" +
						"                        <div class=\"card-footer text-body-secondary\">\n" +
						"                            "+data.data[i].FechaRegistro+"\n" +
						"                        </div>\n" +
						"                    </div>\n" +
						"                </div>");
				}
				
				
				//Bonos de salida completos
				if (data.data[i].ConfirmacionPlant=="0" && data.data[i].ConfirmacionControlling=="0" && data.data[i].ConfirmacionEhs=="0" && data.data[i].ConfirmacionEncargado=="0" && data.data[i].ConfirmacionVigilancia=="0" && imagenEntrega=="" ){
					d=1;
					if (d>0){document.getElementById("tituloNoConfirmadosPendientes").style.display='block';}
                            bandera = '2';
					$('#cartasNoConfirmadosPendientes').append("<div class='col-4 col-12-xsmall' style='text-align: -webkit-center; margin-top:5%; margin-bottom:5%;padding-left: 10px;'>\n" +
						"                    <div class=\"card text-center\" style='border-color: gray !important;'>\n" +
						"                        <div class=\"card-header\">\n" +
						"                            Folio: "+data.data[i].IdBitacora+" \n" +
						"                        </div>\n" +
						"                        <div class=\"card-body\">\n" +
						"\n" +
						"                            <h5 class=\"card-title\">Descripcion</h5>\n" +
						"                            <p class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Descripcion+"</p>\n" +
						"\n" +
						"                            <h5 class=\"card-title\">Causa de salida</h5>\n" +
						"                            <p class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Causa+"</p>\n" +
						"\n" +
						"                            <h5 class=\"card-title\">Empresa</h5>\n" +
						"                            <p class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Empresa+"</p>\n" +
						"\n" +
						"                            <h5 class=\"card-title\">Direccion de destino</h5>\n" +
						"                            <p class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Direccion+"</p>\n" +
						"\n" +
						"                            <h5 class=\"card-title\">Cantidad</h5>\n" +
						"                            <p class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Cantidad+"</p>\n" +
						"                           <a style='color:white;' class='btn btn-info' href='https://arketipo.mx/Controlling/BonoSalida/ConsultaBono.html?0eb20346="+data.data[i].ImagenRegistro+"'>Ver detalles</a>\n" +
						"\n" +
						"                        </div>\n" +
						"                        <div class=\"card-footer text-body-secondary\">\n" +
						"                            "+data.data[i].FechaRegistro+"\n" +
						"                        </div>\n" +
						"                    </div>\n" +
						"                </div>");
				}
				


			}
			
			cargaSecundario(bandera);
		});
		
		
	
		
	}
	
	function cargaSecundario(bandera){
	    
	    if(bandera != '2'){
		    $.getJSON('https://arketipo.mx/Controlling/BonoSalida/dao/DaoHistoricoCoordinadores.php?nomina='+nombreUsuario+'&folio='+folio+'&fechaInicio='+fechaInicio+'&fechaFin='+fechaFin, function (data) {

			document.getElementById("cartasConfirmadosPendientes").innerHTML='';
			document.getElementById("cartasRechazados").innerHTML='';
			document.getElementById("cartasFueraPlanta").innerHTML='';
			document.getElementById("cartasCompletos").innerHTML='';
			document.getElementById("cartasNoConfirmadosPendientes").innerHTML='';

			document.getElementById("tituloCompletos").style.display="none";
			document.getElementById("tituloRechazadas").style.display="none";
			document.getElementById("tituloSalidas").style.display="none";
			document.getElementById("tituloConfirmadosPendientes").style.display="none";
			document.getElementById("tituloNoConfirmadosPendientes").style.display="none";

			a=0;b=0;c=0;d=0;

			for (var i = 0; i < data.data.length; i++) {

				//Bonos de salida confirmados y pendientes por salir
				if (data.data[i].ConfirmacionPlant=="1" || data.data[i].ConfirmacionControlling=="1" || data.data[i].ConfirmacionEhs=="1" || data.data[i].ConfirmacionEncargado=="1"){
					if (data.data[i].ConfirmacionVigilancia == "0"){
						if ( data.data[i].ConfirmacionPlant!="2" && data.data[i].ConfirmacionControlling!="2" && data.data[i].ConfirmacionEhs!="2" && data.data[i].ConfirmacionEncargado!="2" && data.data[i].ConfirmacionVigilancia!="2"){
							a=1;
							if (a>0){document.getElementById("tituloConfirmadosPendientes").style.display='block';}

							$('#cartasConfirmadosPendientes').append("<div class='col-4 col-12-xsmall' style='text-align: -webkit-center; margin-top:5%; margin-bottom:5%;padding-left: 10px;'>\n" +
								"                    <div class=\"card text-center\" style='border-color: green !important;'>\n" +
								"                        <div class=\"card-header\">\n" +
								"                            Folio: "+data.data[i].IdBitacora+" \n" +
								"                        </div>\n" +
								"                        <div class=\"card-body\">\n" +
								"\n" +
								"                            <h5 class=\"card-title\">Descripcion</h5>\n" +
								"                            <p class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Descripcion+"</p>\n" +
								"\n" +
								"                            <h5 class=\"card-title\">Causa de salida</h5>\n" +
								"                            <p class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Causa+"</p>\n" +
								"\n" +
								"                            <h5 class=\"card-title\">Empresa</h5>\n" +
								"                            <p class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Empresa+"</p>\n" +
								"\n" +
								"                            <h5 class=\"card-title\">Direccion de destino</h5>\n" +
								"                            <p class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Direccion+"</p>\n" +
								"\n" +
								"                            <h5 class=\"card-title\">Cantidad</h5>\n" +
								"                            <p class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Cantidad+"</p>\n" +
								"                           <a style='color:white;' class='btn btn-info' href='https://arketipo.mx/Controlling/BonoSalida/ConsultaBono.html?0eb20346="+data.data[i].ImagenRegistro+"'>Ver detalles</a>\n" +
								"\n" +
								"                        </div>\n" +
								"                        <div class=\"card-footer text-body-secondary\">\n" +
								"                            "+data.data[i].FechaRegistro+"\n" +
								"                        </div>\n" +
								"                    </div>\n" +
								"                </div>");
						}

					}
				}

				//Bonos de salida reechazados
				if (data.data[i].ConfirmacionPlant=="2" || data.data[i].ConfirmacionControlling=="2" || data.data[i].ConfirmacionEhs=="2" || data.data[i].ConfirmacionEncargado=="2" || data.data[i].ConfirmacionVigilancia=="2"){
					b=1;
					if (b>0){document.getElementById("tituloRechazadas").style.display='block';}
					$('#cartasRechazados').append("<div class='col-4 col-12-xsmall' style='text-align: -webkit-center; margin-top:5%; margin-bottom:5%;padding-left: 10px;'>\n" +
						"                    <div class=\"card text-center\" style='border-color: red !important;'>\n" +
						"                        <div class=\"card-header\">\n" +
						"                            Folio: "+data.data[i].IdBitacora+" \n" +
						"                        </div>\n" +
						"                        <div class=\"card-body\">\n" +
						"\n" +
						"                            <h5 class=\"card-title\">Descripcion</h5>\n" +
						"                            <p class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Descripcion+"</p>\n" +
						"\n" +
						"                            <h5 class=\"card-title\">Causa de salida</h5>\n" +
						"                            <p class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Causa+"</p>\n" +
						"\n" +
						"                            <h5 class=\"card-title\">Empresa</h5>\n" +
						"                            <p class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Empresa+"</p>\n" +
						"\n" +
						"                            <h5 class=\"card-title\">Direccion de destino</h5>\n" +
						"                            <p class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Direccion+"</p>\n" +
						"\n" +
						"                            <h5 class=\"card-title\">Cantidad</h5>\n" +
						"                            <p class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Cantidad+"</p>\n" +
						"\n" +
						"                            <h5 class=\"card-title\">Retroalimentacion de rechazo : </h5>\n" +
						"                            <p style='color: darkred' class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Retroalimentacion+"</p>\n" +
						"                           <a style='color:white;' class='btn btn-info' href='https://arketipo.mx/Controlling/BonoSalida/ConsultaBono.html?0eb20346="+data.data[i].ImagenRegistro+"'>Ver detalles</a>\n" +
						"\n" +
						"                        </div>\n" +
						"                        <div class=\"card-footer text-body-secondary\">\n" +
						"                            "+data.data[i].FechaRegistro+"\n" +
						"                        </div>\n" +
						"                    </div>\n" +
						"                </div>");
				}

				//Bonos de salida que se encuentran fuera de planta
				if (data.data[i].ConfirmacionPlant=="1" && data.data[i].ConfirmacionControlling=="1" && data.data[i].ConfirmacionEhs=="1" && data.data[i].ConfirmacionEncargado=="1" && data.data[i].ConfirmacionVigilancia == "1" && data.data[i].TipoRetorno == "Si" && data.data[i].ImagenEntrega == ""){
					c=1;
					if (c>0){document.getElementById("tituloSalidas").style.display='block';}
					$('#cartasFueraPlanta').append("<div class='col-4 col-12-xsmall' style='text-align: -webkit-center; margin-top:5%; margin-bottom:5%;padding-left: 10px;'>\n" +
						"                    <div class=\"card text-center\" style='border-color: darkorange !important;'>\n" +
						"                        <div class=\"card-header\">\n" +
						"                            Folio: "+data.data[i].IdBitacora+" \n" +
						"                        </div>\n" +
						"                        <div class=\"card-body\">\n" +
						"\n" +
						"                            <h5 class=\"card-title\">Descripcion</h5>\n" +
						"                            <p class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Descripcion+"</p>\n" +
						"\n" +
						"                            <h5 class=\"card-title\">Causa de salida</h5>\n" +
						"                            <p class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Causa+"</p>\n" +
						"\n" +
						"                            <h5 class=\"card-title\">Empresa</h5>\n" +
						"                            <p class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Empresa+"</p>\n" +
						"\n" +
						"                            <h5 class=\"card-title\">Direccion de destino</h5>\n" +
						"                            <p class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Direccion+"</p>\n" +
						"\n" +
						"                            <h5 class=\"card-title\">Cantidad</h5>\n" +
						"                            <p class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Cantidad+"</p>\n" +
						"                           <a style='color:white;' class='btn btn-info' href='https://arketipo.mx/Controlling/BonoSalida/ConsultaBono.html?0eb20346="+data.data[i].ImagenRegistro+"'>Ver detalles</a>\n" +
						"\n" +
						"                        </div>\n" +
						"                        <div class=\"card-footer text-body-secondary\">\n" +
						"                            "+data.data[i].FechaRegistro+"\n" +
						"                        </div>\n" +
						"                    </div>\n" +
						"                </div>");
				}

				if (data.data[i].TipoRetorno=="No"){
					imagenEntrega="Ocupado";
				}else {
					imagenEntrega=data.data[i].ImagenEntrega;
				}

				//Bonos de salida completos
				if (data.data[i].ConfirmacionPlant=="1" && data.data[i].ConfirmacionControlling=="1" && data.data[i].ConfirmacionEhs=="1" && data.data[i].ConfirmacionEncargado=="1" && data.data[i].ConfirmacionVigilancia=="1" && imagenEntrega!="" ){
					d=1;
					if (d>0){document.getElementById("tituloCompletos").style.display='block';}
					$('#cartasCompletos').append("<div class='col-4 col-12-xsmall' style='text-align: -webkit-center; margin-top:5%; margin-bottom:5%;padding-left: 10px;'>\n" +
						"                    <div class=\"card text-center\" style='border-color: gray !important;'>\n" +
						"                        <div class=\"card-header\">\n" +
						"                            Folio: "+data.data[i].IdBitacora+" \n" +
						"                        </div>\n" +
						"                        <div class=\"card-body\">\n" +
						"\n" +
						"                            <h5 class=\"card-title\">Descripcion</h5>\n" +
						"                            <p class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Descripcion+"</p>\n" +
						"\n" +
						"                            <h5 class=\"card-title\">Causa de salida</h5>\n" +
						"                            <p class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Causa+"</p>\n" +
						"\n" +
						"                            <h5 class=\"card-title\">Empresa</h5>\n" +
						"                            <p class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Empresa+"</p>\n" +
						"\n" +
						"                            <h5 class=\"card-title\">Direccion de destino</h5>\n" +
						"                            <p class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Direccion+"</p>\n" +
						"\n" +
						"                            <h5 class=\"card-title\">Cantidad</h5>\n" +
						"                            <p class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Cantidad+"</p>\n" +
						"                           <a style='color:white;' class='btn btn-info' href='https://arketipo.mx/Controlling/BonoSalida/ConsultaBono.html?0eb20346="+data.data[i].ImagenRegistro+"'>Ver detalles</a>\n" +
						"\n" +
						"                        </div>\n" +
						"                        <div class=\"card-footer text-body-secondary\">\n" +
						"                            "+data.data[i].FechaRegistro+"\n" +
						"                        </div>\n" +
						"                    </div>\n" +
						"                </div>");
				}
				
				
				//Bonos de salida completos
				if (data.data[i].ConfirmacionPlant=="0" && data.data[i].ConfirmacionControlling=="0" && data.data[i].ConfirmacionEhs=="0" && data.data[i].ConfirmacionEncargado=="0" && data.data[i].ConfirmacionVigilancia=="0" && imagenEntrega=="" ){
					d=1;
					if (d>0){document.getElementById("tituloNoConfirmadosPendientes").style.display='block';}
					$('#cartasNoConfirmadosPendientes').append("<div class='col-4 col-12-xsmall' style='text-align: -webkit-center; margin-top:5%; margin-bottom:5%;padding-left: 10px;'>\n" +
						"                    <div class=\"card text-center\" style='border-color: gray !important;'>\n" +
						"                        <div class=\"card-header\">\n" +
						"                            Folio: "+data.data[i].IdBitacora+" \n" +
						"                        </div>\n" +
						"                        <div class=\"card-body\">\n" +
						"\n" +
						"                            <h5 class=\"card-title\">Descripcion</h5>\n" +
						"                            <p class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Descripcion+"</p>\n" +
						"\n" +
						"                            <h5 class=\"card-title\">Causa de salida</h5>\n" +
						"                            <p class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Causa+"</p>\n" +
						"\n" +
						"                            <h5 class=\"card-title\">Empresa</h5>\n" +
						"                            <p class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Empresa+"</p>\n" +
						"\n" +
						"                            <h5 class=\"card-title\">Direccion de destino</h5>\n" +
						"                            <p class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Direccion+"</p>\n" +
						"\n" +
						"                            <h5 class=\"card-title\">Cantidad</h5>\n" +
						"                            <p class=\"card-text\" style='margin-bottom: 1%;'>"+data.data[i].Cantidad+"</p>\n" +
						"                           <a style='color:white;' class='btn btn-info' href='https://arketipo.mx/Controlling/BonoSalida/ConsultaBono.html?0eb20346="+data.data[i].ImagenRegistro+"'>Ver detalles</a>\n" +
						"\n" +
						"                        </div>\n" +
						"                        <div class=\"card-footer text-body-secondary\">\n" +
						"                            "+data.data[i].FechaRegistro+"\n" +
						"                        </div>\n" +
						"                    </div>\n" +
						"                </div>");
				}
				


			}
		});
		}
		
	    
	}

</script>

</body>

</html>