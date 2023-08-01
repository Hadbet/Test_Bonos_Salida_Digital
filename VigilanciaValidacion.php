<!DOCTYPE HTML>
<html>

<head>
    <title>Grammer Queretaro</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="css/buton.css" />
    <link rel="shortcut icon" href="lib/assets/img/iconoarriba.png" />
	<link rel="stylesheet" href="lib/sweetalert2.min.css">
	<script src="lib/sweetalert2.all.min.js"></script>
	<link rel="stylesheet" href="lib/jquery-ui.min.css">
	<script src="lib/jquery-3.6.0.min.js"></script>
	<script src="lib/jquery-ui.min.js"></script>
	
	
    <noscript>
        <link rel="stylesheet" href="assets/css/noscript.css" />
    </noscript>
    <style>
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
                        <a class="nav-link active" aria-current="page" href="https://arketipo.mx/Controlling/BonoSalida/VigilanciaValidacion.php">Salidas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://arketipo.mx/Controlling/BonoSalida/EntradaVigilancia.php">Entregas</a>
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
        <span class="logo"><img style="width: 35%;" src="images/Grammer_Logo_Original_White_sRGB_screen_transparent.png" alt="" /></span>
        <h1>Bonos de salida</h1>
        <p>Bonos de salida electrónicos, una opción alternativa<br/>
            del bono de salida actual, con el soporte del departamento de <a href="https://html5up.net">Controlling</a>.</p>
    </header>

    <!-- Nav -->
    <nav id="nav">
        <ul>
            <li><a href="https://arketipo.mx/Controlling/BonoSalida/VigilanciaValidacion.php" class="active">Salidas</a></li>
            <li><a href="https://arketipo.mx/Controlling/BonoSalida/EntradaVigilancia.php">Entregas</a></li>
        </ul>
    </nav>

    <!-- Main -->
    <div id="main">

        <div id='registroConcluido' style='display:none;'>
            <section id="firsts" class="main special">
                <header class="major">
                    <h2 style='color:green;padding-top: 10%;'>Se concluyó el registro.</h2>
                </header>
                <img style='width: 24%;' src='images/like.png'>
                <p style='padding: 4%;'>Se ha validado la salida de material.</p>
                <a style='margin-bottom: 10%;margin-top: -2%;' id="guardarRegistro" onclick='recarge();' class="btn btnGreen">Regresar</a>
            </section>
        </div>

        <div id='registroFallido' style='display:none;'>
            <section id="firsts" class="main special">
                <header class="major">
                    <h2 style='color:red;'>Algo salió mal.</h2>
                </header>
                <img style='width: 24%;' src='images/dislike.png'>
                <p style='padding: 4%;'>Hay algun error en el registro o sistema favor de comunicarlo con IT</p>
                <a style='margin-bottom: 10%;margin-top: -2%;' onclick='recarge();' class="btn btnRed">Regresar</a>
            </section>
        </div>

        <div id='carga' style='display:none;'></div>

        <!-- First Section -->
        <section id="first" class="main special">
            <h1>Escaneo de Código QR.</h1>
            <video style='width: 100%;' id="preview"></video>
            <!--<div><center><img style="width: 70%;" src="images/logoInicial_2.png"></center></div>-->
            <div class="row">
                <div class="col-12 col-12-small">
                    <div class="col-12 col-12-small">
                        <p style="margin-bottom: 10px !important;">Buscar por folio</p>
                        <input type="number" placeholder="Folio" name="folio" id="txtFolio" />
                    </div>
                </div>
                <div class="col-12" style="margin-top: 1%;padding-left: 10px;padding-right: 10px;">
                    <ul class="actions special">
                        <li><a  onclick="buscarQr('n');" class="btn btnGreen">Buscar</a></li>
                    </ul>
                </div>
            </div>
        </section>

        <section id='bonoSalida' style="margin-left: 8%;margin-right: 8%;display:none">
            <br>
            <header class="major">
                <h2>Bono de salida.</h2>
            </header>
            <h2>Información del bono de salida.</h2>
            <div class="row">
                <div class="col-6 col-12-medium">
                    <h3>Datos Generales</h3>
                    <ul>
                        <li>Nombre del solicitante : <b id='txtNombreSolicitante'></b></li>
                        <li>Descripción : <b id='txtDescripcion'></b></li>
                        <li>Cantidad : <b id='txtCantidad'></b></li>
                        <li>Empresa : <b id='txtEmpresa'></b></li>
                        <li>Fecha de Registro : <b id='txtFechaRegistro'></b></li>
                        <li>Tipo bono : <b id='txtTipoBono'></b></li>
                    </ul>
                </div>
                <div class="col-6 col-12-medium">
                    <ul>
                        <li>Dirección de destino : <b id='txtDireccion'></b></li>
                        <li>Tipo de material : <b id='txtTipoMaterial'></b></li>
                        <li>Causa de la salida : <b id='txtCausa'></b></li>
                        <li>Cometarios adicionales : <b id='txtComentarios'></b></li>
                        <li>Fecha de retorno : <b id='txtFecha'></b></li>
                    </ul>
                </div>
            </div>
            <center><h2>Imagen del activo.</h2>
                <img id='imagenRegistro' style="width: 100%;"></center>
            <div class="row">
                <div class="col-12 col-12-medium">
                    <p style="margin-bottom: 10px !important;">Tu nombre : </p>
                    <input type="text" placeholder="Nombre" name="Vigilante" id="txtNombreVigilante"  required />
                </div>
                <div class="col-6 col-12-medium">
                    <p style="margin-bottom: 10px !important;">Línea Transportista : </p>
                    <input type="text" placeholder="Linea de transporte" name="Transportista" id="txtTransportista"  required />
                </div>
                <div class="col-6 col-12-medium">
                    <p style="margin-bottom: 10px !important;">Placas : </p>
                    <input type="text" placeholder="Placas del transporte" name="Placas" id="txtPlacas" required />
                </div>
                <div class="col-6 col-12-medium">
                    <p style="margin-bottom: 10px !important;">Nombre del operador de transporte : </p>
                    <input type="text" placeholder="Nombre del operador" name="Nombre del portador" id="txtPortador" required />
                </div>
                <div class="col-6 col-12-medium">
                    <p style="margin-bottom: 10px !important;">Correo : </p>
                    <input type="text" placeholder="Correo" name="Nombre del portador" id="txtCorreoTransportista" required />
                </div>
                <p></p>
                <div class="col-12 col-12-medium" style='margin-top: 20px;'>
                    <h2 style="margin-bottom: 10px !important;">Firma : </h2>
                    <canvas id="signature-pad" width="300" height="200" style='border-width: 1px; border-style: solid; border-color: black;'></canvas>
                    <br>
                    <button type="button" onclick="reset()">Resetear</button>
                    <input type="hidden" name="firma" id="firma">
                    <br>
                </div>
                <div class="col-12 col-12-medium" style='margin-top: 20px;'>
                    <label style="text-align: center;color: white;">Sube la imagen de tu articulo</label>
                    <p></p>
                    <input type="file" id="files" accept="image/*" onchange="preview_image()">
                    <br><br>
                    <center><img style="display: none;width: 300px;" id="imagenPrevisualizacion"></center>
                </div>

                <img src="" style="display: none;" id="new">
                <img src="" style="display: none;" id="old">

                <div class="col-12 col-12-mobilep" style='margin-top: 20px;margin-bottom: 20px;text-align: center;'>
                    <a style="color:white;" onclick="test2(1);" class="btn green">Confirmar</a>
                    <a style="color:white;" id='botonRechazo' onclick="retro();" class="btn red">Rechazar</a>
                    <a style="color:white;" id='botonCancelar' onclick="reverse();" class="btn yellow">Escanear Otro</a>
                </div>

            </div>

            <div id='retroalimentacion' class="col-12" style="background: lavenderblush;padding: 10px; display:none;">
                <center><h2>¿Porque rechazas este bono de salida?</h2></center>
                <textarea style="resize:none; margin-bottom: 15px; margin-top: 15px;" placeholder="Causa" rows="6" name="causa" id="txtRetroAux"
                          required></textarea>
                <div style='text-align: center;' id="buttons">
                    <a onclick="test2(2);" class="btn red">Confirmar rechazo</a>
                </div>
            </div>
        </section>

    </div>
</div>
<footer id="footer">
    <section>
    </section>
    <p class="copyright">&copy; Grammer Queretaro. Design: <a href="">Grammer Querétaro</a>.</p>
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
<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
<script>

    function recarge() {
        location.reload();
    }

    function retro() {
        document.getElementById("botonRechazo").style.display = 'none';
        document.getElementById("retroalimentacion").style.display = 'block';
    }

    var bitacora,idImagen;

    var canvas = document.getElementById('signature-pad');
    var ctx = canvas.getContext('2d');

    canvas.addEventListener('touchstart', function(event) {
        event.preventDefault();
        ctx.beginPath();
        ctx.moveTo(event.changedTouches[0].pageX - canvas.offsetLeft, event.changedTouches[0].pageY - canvas.offsetTop);
    });

    canvas.addEventListener('touchmove', function(event) {
        event.preventDefault();
        ctx.lineTo(event.changedTouches[0].pageX - canvas.offsetLeft, event.changedTouches[0].pageY - canvas.offsetTop);
        ctx.stroke();
    });

    function save() {
        var dataURL = canvas.toDataURL();
        document.getElementById('firma').value = dataURL;
    }

    function reset() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
    }


    let scanner = new Instascan.Scanner({ video: document.getElementById('preview'), scanPeriod: 5 });
    function iniciarCamara() {
        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                if (cameras.length >= 1){
                    scanner.start(cameras[1]);
                }else {
                    scanner.start(cameras[3]);
                }

            } else {
                console.error('No se encontró ninguna cámara en el dispositivo.');
            }
            console.log('Cámaras disponibles:');
            for (var i = 0; i < cameras.length; i++) {
                console.log('Cámara ' + (i) + ': ' + cameras[i].name);
            }
        }).catch(function (e) {
            console.error(e);
        });
    }
    scanner.addListener('scan', function (content) {
        Swal.fire(
          'Código escaneado',
          content,
          'success'
        )
        buscarQr(content);
        scanner.stop();
    });
    iniciarCamara();

    function reverse(){
        document.getElementById("bonoSalida").style.display = 'none';
        document.getElementById("first").style.display = 'block';
        iniciarCamara();
    }

    function buscarQr(idQr){

        if (idQr=="n"){
            var folio=document.getElementById("txtFolio").value;
        }

        document.getElementById('carga').innerHTML = '<div class="loading"><center><img src="images/carga.gif" height="350px"><br/>Un momento, por  favor...</center></div>';

        $.getJSON('https://arketipo.mx/Controlling/BonoSalida/dao/DaoConsultarBono.php?id='+idQr+'&folio='+folio, function (data) {


            if (!data || !data.data || data.data.length === 0) {
                alert("La respuesta es nula o no contiene datos");
                iniciarCamara();
            }else{

                email = data.data[0].CorreoSolicitante;
                nomina = data.data[0].NominaSolicitante;
                solicitante = data.data[0].NombreSolicitante;
                descripcion = data.data[0].Descripcion;
                cantidad = data.data[0].Cantidad;
                um = data.data[0].UnidadMedida;
                empresa = data.data[0].Empresa;
                portador = data.data[0].NombreExterno;
                direccion = data.data[0].Direccion;
                tipo = data.data[0].TipoSalida;
                fechaRetorno = data.data[0].FechaRetorno;
                retorno = data.data[0].TipoRetorno;
                causa = data.data[0].Causa;
                comentario = data.data[0].Comentarios;
                idImagen = data.data[0].ImagenRegistro;
                bitacora = data.data[0].IdBitacora;
                tipoBono = data.data[0].TipoBono;

                document.getElementById("txtDescripcion").innerHTML = data.data[0].Descripcion;
                document.getElementById("txtCantidad").innerHTML = data.data[0].Cantidad + " " + data.data[0].UnidadMedida;
                document.getElementById("txtEmpresa").innerHTML = data.data[0].Empresa;
                document.getElementById("txtDireccion").innerHTML = data.data[0].Direccion;
                document.getElementById("txtTipoMaterial").innerHTML = data.data[0].TipoSalida;
                document.getElementById("txtCausa").innerHTML = data.data[0].Causa;
                document.getElementById("txtComentarios").innerHTML = data.data[0].Comentarios;
                document.getElementById("txtFechaRegistro").innerHTML = data.data[0].FechaRegistro;

                if(data.data[0].TipoRetorno=="Si"){
                    document.getElementById("txtFecha").innerHTML = data.data[0].FechaRetorno;
                }else{
                    document.getElementById("txtFecha").innerHTML = "Material no retorna.";
                }

                if(tipoBono=="1"){
                    document.getElementById("txtTipoBono").innerHTML = "Ordinario";
                }else{
                    document.getElementById("txtTipoBono").innerHTML = "Extraordinario";
                }

                document.getElementById("txtNombreSolicitante").innerHTML = data.data[0].NombreSolicitante;
                document.getElementById("imagenRegistro").src = "dao/fotos/registro/"+data.data[0].ImagenRegistro+".png";

                document.getElementById("bonoSalida").style.display = 'block';
                document.getElementById("first").style.display = 'none';
                document.getElementById("carga").style.display = 'none';
            }

        });
    }


</script>

</body>

</html>