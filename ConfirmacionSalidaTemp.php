<!DOCTYPE HTML>
<html>

<head>
    <title>Grammer Queretaro</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"/>
    <link rel="stylesheet" href="assets/css/main.css"/>
    <link rel="stylesheet" href="css/botones.css"/>
    <link rel="shortcut icon" href="lib/assets/img/iconoarriba.png"/>
    <noscript>
        <link rel="stylesheet" href="assets/css/noscript.css"/>
    </noscript>
    <style>

        body {
            background-color: #292929;
        }

    </style>
</head>

<body class="is-preload">

<!-- Wrapper -->
<div id="wrapper">

    <!-- Header -->
    <header id="header" class="alt">
        <span class="logo"><img style="width: 35%;" src="images/Grammer_Logo_Original_White_sRGB_screen_transparent.png"
                                alt=""/></span>
        <h1>Bonos de salida</h1>
    </header>

    <!-- Main -->
    <div id="main">
        <div id='carga' style='display:none;'></div>

        <div id='registroConcluido' style='display:none;'>
            <section id="firsts" class="main special">
                <header class="major">
                    <h2 style='color:green;padding-top: 10%;'>Se concluyó el registro.</h2>
                </header>
                <img style='width: 24%;' src='images/like.png'>
                <p style='padding: 4%;margin-bottom: 10%;'>Se ha validado correctamente el registro de su empleado, se
                    le notificará mediante correo ¡Gracias!</p>
            </section>
        </div>

        <div id='registroFallido' style='display:none;'>
            <section id="firsts" class="main special">
                <header class="major">
                    <h2 style='color:red;'>Algo salió mal.</h2>
                </header>
                <img style='width: 24%;' src='images/dislike.png'>
                <p style='padding: 4%;margin-bottom: 10%;'>Ah ocurrido un error favor de revisarlo con IT.</p>
            </section>
        </div>

        <div id='InicioSeccion'>
            <!-- First Section -->
            <section id="first" class="main special">
                <header class="major">
                    <h2 style="color: green !important;padding-top: 3%;">Información de registro de bono de salida.</h2>
                </header>
                <h2>Solicitante : <b id='nombreB'></b></h2>
                <p></p>
                <hr>
            </section>
            <br>
            <section id="tablaMulti" style='padding: 5%; margin-top: -8%; display: none'>
                <center><h3>Información General del bono de salida</h3></center>
                <div class="table-wrapper">

                    <div id="tablaMultiData"></div>

                    <table class="alt">
                        <tbody>
                        <tr>
                            <td>Empresa :</td>
                            <td id='empresaM'></td>
                        </tr>
                        <tr>
                            <td>Dirección de destino :</td>
                            <td id='direccionM'></td>
                        </tr>
                        <tr>
                            <td>Causa de la salida :</td>
                            <td id='causaM'></td>
                        </tr>
                        <tr>
                            <td>Cometarios adicionales :</td>
                            <td id='comentarioM'></td>
                        </tr>
                        <tr style='background: papayawhip;'>
                            <td>Fecha de registro :</td>
                            <td id='fechaRegistroM'></td>
                        </tr>
                        <tr>
                            <td>Fecha de salida :</td>
                            <td id='fechaSalidaM'>pendiente de confirmar</td>
                        </tr>
                        <tr>
                            <td>Fecha de Retorno :</td>
                            <td id='fechaRetornoM'></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <center><h2>Archivo de los activo.</h2></center>
                <iframe id="pdfFrame" src="ruta-al-archivo.pdf" width="100%" height="500px">
                    <p>Tu navegador no admite visualización de PDF. Puedes descargar el archivo <a id="downloadPdf"
                            href="ruta-al-archivo.pdf">aquí</a>.</p>
                </iframe>
                <br>
                <!-- Simple Buttons -->
                <div id="buttons">
                    <a onclick="actualizarEstatus(2);" class="btn btnGreen">Confirmar</a>
                    <a id='botonRechazo' onclick="retro();" class="btn btnRed">Rechazar</a>
                </div>

                <div id='retroalimentacion' class="col-12"
                     style="background: lavenderblush;padding: 10px; display:none;">
                    <center><h2>¿Por qué rechazas este bono de salida?</h2></center>
                    <textarea style="resize:none; margin-bottom: 15px; margin-top: 15px;" placeholder="Causa"
                              rows="6"
                              name="causa" id="txtCausa"
                              required></textarea>
                    <div id="buttons">
                        <a onclick="enviarCorreoEncargado(3)" class="btn btnRed">Confirmar rechazo</a>
                    </div>
                </div>

            </section>
            <!-- Table -->
            <section id="tablaIndividual" style='padding: 5%; margin-top: -8%;display: none'>
                <center><h3>Información General del bono de salida</h3></center>
                <div class="table-wrapper">
                    <table class="alt">
                        <tbody>
                        <tr>
                            <td>Descripción :</td>
                            <td id='descripcionB'></td>
                        </tr>
                        <tr>
                            <td>Cantidad :</td>
                            <td id='cantidadB'></td>
                        </tr>
                        <tr>
                            <td>Empresa :</td>
                            <td id='empresaB'></td>
                        </tr>
                        <tr>
                            <td>Dirección de destino :</td>
                            <td id='direccionB'></td>
                        </tr>
                        <tr>
                            <td>Tipo de material :</td>
                            <td id='tipoB'></td>
                        </tr>
                        <tr>
                            <td>Causa de la salida :</td>
                            <td id='causaB'></td>
                        </tr>
                        <tr>
                            <td>Cometarios adicionales :</td>
                            <td id='comentarioB'></td>
                        </tr>
                        <tr style='background: papayawhip;'>
                            <td>Fecha de registro :</td>
                            <td id='fechaRegistroB'></td>
                        </tr>
                        <tr>
                            <td>Fecha de salida :</td>
                            <td id='fechaSalidaB'>pendiente de confirmar</td>
                        </tr>
                        <tr>
                            <td>Fecha de Retorno :</td>
                            <td id='fechaRetornoB'></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <center><h2>Imagen del activo.</h2>
                    <img id='imagenRegistro' style="width: 40%;"></center>
                <!-- Simple Buttons -->
                <div id="buttons">
                    <a onclick="actualizarEstatus(1);" class="btn btnGreen">Confirmar</a>
                    <a id='botonRechazo' onclick="retro();" class="btn btnRed">Rechazar</a>
                </div>

                <div id='retroalimentacion' class="col-12"
                     style="background: lavenderblush;padding: 10px; display:none;">
                    <center><h2>¿Por qué rechazas este bono de salida?</h2></center>
                    <textarea style="resize:none; margin-bottom: 15px; margin-top: 15px;" placeholder="Causa" rows="6"
                              name="causa" id="txtCausa"
                              required></textarea>
                    <div id="buttons">
                        <a onclick="enviarCorreoEncargado(3)" class="btn btnRed">Confirmar rechazo</a>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<!-- Footer -->
<footer id="footer">
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

<script>

    var email, nomina, solicitante, descripcion, cantidad, um, empresa, portador, direccion, tipo, retorno,
        fechaRetorno, causa, comentarios, correoEncargado, idImagen, bitacora;

    var identificador = getParameterByName("013800ce");

    function getParameterByName(name) {
        name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
        var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
            results = regex.exec(location.search);


        var cadena = results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));

        var arrTerminos = cadena.split(',');

        return arrTerminos[0];
    }

    function retro() {
        document.getElementById("botonRechazo").style.display = 'none';
        document.getElementById("retroalimentacion").style.display = 'block';
    }

    if (identificador.startsWith("M")) {
        document.getElementById("tablaIndividual").style.display = 'none';
        document.getElementById("tablaMulti").style.display = 'block';
        $.getJSON('https://arketipo.mx/Test/BonoSalida/dao/DaoConsultarSalida.php?id=' + identificador, function (data) {
            for (var i = 0; i < data.data.length; i++) {


                bitacora = data.data[0].Token;

                const originalValue = data.data[i].Comentarios;
                const newValue = originalValue.replace(/\r|\n/g, '');

                const originalValueDescripcion = data.data[i].Descripcion;
                const newValueDescripcion = originalValueDescripcion.replace(/\r|\n/g, '');

                const originalValueCausa = data.data[i].Causa;
                const newValueCausa = originalValueCausa.replace(/\r|\n/g, '');

                $('#tablaMultiData').append("<table class='alt'><tbody><tr><td>Descripción :</td><td>" + originalValueDescripcion + "</td></tr><tr><td>Cantidad :</td><td>" + data.data[i].Cantidad + " " + data.data[0].UnidadMedida + "</td></tr><tr><td>Tipo de material :</td><td>" + data.data[i].TipoSalida + "</td></tr></tbody></table>");

                document.getElementById("empresaM").innerHTML = data.data[0].Empresa;
                document.getElementById("direccionM").innerHTML = data.data[0].Direccion;
                document.getElementById("causaM").innerHTML = data.data[0].Causa;
                document.getElementById("comentarioM").innerHTML = data.data[0].Comentarios;
                document.getElementById("fechaRegistroM").innerHTML = data.data[0].FechaRegistro;

                if (data.data[0].TipoRetorno == "Si") {
                    document.getElementById("fechaRetornoM").innerHTML = data.data[0].FechaRetorno;
                } else {
                    document.getElementById("fechaRetornoM").innerHTML = "Material no retorna.";
                }
                document.getElementById("nombreB").innerHTML = data.data[0].NombreSolicitante;
                document.getElementById("pdfFrame").src = "dao/PDF/" + data.data[0].PDF + ".pdf";
            }
        });
    } else {
        document.getElementById("tablaIndividual").style.display = 'block';
        document.getElementById("tablaMulti").style.display = 'none';
        $.getJSON('https://arketipo.mx/Test/BonoSalida/dao/DaoConsultarSalida.php?id=' + identificador, function (data) {

            if (data.data[0].ConfirmacionEncargado == '1') {
                document.getElementById("main").innerHTML = '<section id="estatusBonoSalida" class="main special"><header class="major"><img style="width: 20%;" src="images/like.png"></center><h2 style="color: green !important;">Ya has confirmado este bono de salida.</h2></header></section>'
            }
            if (data.data[0].ConfirmacionEncargado == '2') {
                document.getElementById("main").innerHTML = '<section id="estatusBonoSalida" class="main special"><header class="major"><img style="width: 20%;" src="images/dislike.png"></center><h2 style="color: red !important;">Ya has rechazado este bono de salida.</h2></header></section>'
            }
            if (data.data[0].ConfirmacionEncargado == '0') {
                email = data.data[0].CorreoSolicitante;
                nomina = data.data[0].NominaSolicitante;
                solicitante = data.data[0].NombreSolicitante;
                descripcion = data.data[0].Descripcion;
                cantidad = data.data[0].Cantidad;
                um = data.data[0].UnidadMedida;
                empresa = data.data[0].Empresa;
                direccion = data.data[0].Direccion;
                tipo = data.data[0].TipoSalida;
                fechaRetorno = data.data[0].FechaRetorno;
                retorno = data.data[0].TipoRetorno;
                causa = data.data[0].Causa;
                comentario = data.data[0].Comentarios;
                idImagen = data.data[0].ImagenRegistro;
                bitacora = data.data[0].IdBitacora;
                tipoBono = data.data[0].TipoBono;

                document.getElementById("descripcionB").innerHTML = data.data[0].Descripcion;
                document.getElementById("cantidadB").innerHTML = data.data[0].Cantidad + " " + data.data[0].UnidadMedida;
                document.getElementById("empresaB").innerHTML = data.data[0].Empresa;
                document.getElementById("direccionB").innerHTML = data.data[0].Direccion;
                document.getElementById("tipoB").innerHTML = data.data[0].TipoSalida;
                document.getElementById("causaB").innerHTML = data.data[0].Causa;
                document.getElementById("comentarioB").innerHTML = data.data[0].Comentarios;
                document.getElementById("fechaRegistroB").innerHTML = data.data[0].FechaRegistro;

                if (data.data[0].TipoRetorno == "Si") {
                    document.getElementById("fechaRetornoB").innerHTML = data.data[0].FechaRetorno;
                } else {
                    document.getElementById("fechaRetornoB").innerHTML = "Material no retorna.";
                }
                document.getElementById("nombreB").innerHTML = data.data[0].NombreSolicitante;
                document.getElementById("imagenRegistro").src = "dao/fotos/registro/" + data.data[0].ImagenRegistro + ".png";
            }


        });
    }


    function actualizarEstatus(Estatus) {
        var URL;
        document.getElementById('InicioSeccion').style.display = 'none';
        document.getElementById('carga').style.display = 'block';
        document.getElementById('carga').innerHTML = '<div class="loading"><center><img src="images/carga.gif" height="350px"><br/>Un momento, por favor...</center></div>';

        if (Estatus == '2'){
            URL = 'https://arketipo.mx/Controlling/BonoSalida/dao/DaoActualizarEstatus.php?bitacora=' + bitacora + '&estatus=' + Estatus + '&bandera=6';
        }else{
            URL = 'https://arketipo.mx/Controlling/BonoSalida/dao/DaoActualizarEstatus.php?bitacora=' + bitacora + '&estatus=' + Estatus + '&bandera=1';
        }

        $.getJSON(URL, function (data) {
            if (data.data[0].estatus == 'bien') {
                enviarCorreoEncargado(Estatus);
            } else {
                alert("algo salio mal");
            }
        });

    }

    function enviarCorreoEncargado(estatus) {

        if (estatus == 3) {
            document.getElementById('InicioSeccion').style.display = 'none';
            document.getElementById('carga').style.display = 'block';
            document.getElementById('carga').innerHTML = '<div class="loading"><center><img src="images/carga.gif" height="350px"><br/>Un momento, por favor...</center></div>';

            $.getJSON('https://arketipo.mx/Controlling/BonoSalida/dao/DaoActualizarEstatus.php?bitacora=' + bitacora + '&estatus=' + estatus + '&bandera=0&retroalimentacion=' + document.getElementById("txtCausa").value, function (data) {
            });
        }

        const data = new FormData();

        data.append('nomina', nomina);
        data.append('email', email);
        data.append('solicitante', solicitante);
        data.append('descripcion', descripcion);
        data.append('cantidad', cantidad);
        data.append('um', um);
        data.append('empresa', empresa);
        data.append('tipo', tipo);
        data.append('retorno', retorno);
        data.append('fechaRetorno', fechaRetorno);
        data.append('causa', causa);
        data.append('comentario', comentario);
        data.append('idImagen', idImagen);
        data.append('direccion', direccion);
        data.append('tipoBono', tipoBono);
        data.append('idBitacora', bitacora);
        data.append('NombreConfirmado', 'Encargado de area');

        if (estatus == 1) {
            data.append('bandera', 2);
            data.append('retroalimentacion', '');
        } else {
            data.append('bandera', 3);
            data.append('retroalimentacion', document.getElementById("txtCausa").value);
        }

        console.log(data);

        fetch('https://arketipo.mx/MailerBonosSalida.php', {
            method: 'POST',
            body: data
        })
            .then(function (response) {
                if (response.ok) {
                    if (estatus == 1) {
                        if (tipoBono == 1) {
                            document.getElementById('carga').style.display = 'none';
                            document.getElementById('registroConcluido').style.display = 'block';
                        } else {
                            enviarCorreoSolicitante();
                        }
                    } else {
                        document.getElementById('carga').style.display = 'none';
                        document.getElementById('registroConcluido').style.display = 'block';
                    }
                } else {
                    throw "Error en la llamada Ajax";
                }

            })
            .then(function (texto) {
                console.log(texto);
            })
            .catch(function (err) {
                console.log(err);
            });

    }

    function enviarCorreoSolicitante() {

        const data = new FormData();

        data.append('nomina', nomina);
        data.append('email', email);
        data.append('solicitante', solicitante);
        data.append('descripcion', descripcion);
        data.append('cantidad', cantidad);
        data.append('um', um);
        data.append('empresa', empresa);
        data.append('tipo', tipo);
        data.append('retorno', retorno);
        data.append('fechaRetorno', fechaRetorno);
        data.append('causa', causa);
        data.append('comentario', comentario);
        data.append('idImagen', idImagen);
        data.append('direccion', direccion);
        data.append('tipoBono', tipoBono);
        data.append('idBitacora', bitacora);
        data.append('NombreConfirmado', 'Encargado de area');
        data.append('bandera', 5);
        data.append('retroalimentacion', '');

        fetch('https://arketipo.mx/MailerBonosSalida.php', {
            method: 'POST',
            body: data
        })
            .then(function (response) {
                if (response.ok) {
                    document.getElementById('carga').style.display = 'none';
                    document.getElementById('registroConcluido').style.display = 'block';
                } else {
                    document.getElementById('carga').style.display = 'none';
                    document.getElementById('registroFallido').style.display = 'block';
                    throw "Error en la llamada Ajax";
                }

            })
            .then(function (texto) {
                console.log(texto);
            })
            .catch(function (err) {
                console.log(err);
            });

    }

</script>

</body>

</html>