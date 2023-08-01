<!DOCTYPE HTML>
<html>

<head>
    <input type="text" style='display:none;' id="txtNomina" value="<?php echo $_SESSION["nomina"]?>"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" href="lib/sweetalert2.css">

    <!-- JavaScript -->
    <script src="lib/sweetalert2.all.min.js"></script>
    <title>Grammer Queretaro</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="shortcut icon" href="lib/assets/img/iconoarriba.png" />
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
                        <a class="nav-link" href="https://arketipo.mx/Controlling/BonoSalida/VigilanciaValidacion.php">Salidas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="https://arketipo.mx/Controlling/BonoSalida/EntradaVigilancia.php">Entregas</a>
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
        <p>Bonos de salida electrónicos, una opción alternativa<br />
            del bono de salida actual, con el soporte del departamento de <a href="https://html5up.net">Controlling</a>.</p>
    </header>

    <!-- Nav -->
    <nav id="nav">
        <ul>
            <li><a href="https://arketipo.mx/Controlling/BonoSalida/VigilanciaValidacion.php">Salidas</a></li>
            <li><a href="https://arketipo.mx/Controlling/BonoSalida/EntradaVigilancia.php"  class="active">Entregas</a></li>
        </ul>
    </nav>

    <!-- Main -->
    <div id="main">

        <div id='registroConcluido' style='display:none;'>
            <section id="firsts" class="main special">
                <header class="major">
                    <h2 style='color:green;padding-top: 10%;'>Se concluyó la entrega.</h2>
                </header>
                <img style='width: 24%;' src='images/like.png'>
                <p style='padding: 4%;'>Se ha validado correctamente este registro, ya se dio por finalizado el proceso.</p>
                <a style='margin-bottom: 10%;margin-top: -2%;'  onclick='recarge();' class="btn btnGreen">Regresar</a>
            </section>
        </div>

        <div id='registroFallido' style='display:none;'>
            <section id="firsts" class="main special">
                <header class="major">
                    <h2 style='color:red;'>Algo salio mal.</h2>
                </header>
                <img style='width: 24%;' src='images/dislike.png'>
                <p style='padding: 4%;'>Ocurrió un error inesperado con este registro favor de contactar directamente con IT.</p>
                <a style='margin-bottom: 10%;margin-top: -2%;'  onclick='recarge();' class="btn btnRed">Regresar</a>
            </section>
        </div>

        <div id='carga' style='display:none;'></div>

        <!-- First Section -->
        <section id="first" class="main special">
            <header class="major">
                <h2>Bonos de salida en espera de entrega.</h2>
            </header>
            <p>Aquí encontrarás todos los bonos de salida que están pendientes por entregar.</p>

            <div id='cartas'>
            </div>
        </section>
    </div>


</div>
<!-- Footer -->
<footer id="footer">
    <section>
        <h2>Dudas y preguntas.</h2>
        <p>Para dudas, problemas o sugerencias que tengas acerca del proceso del software te puedes comunicar directamente con el departamento de IT o de Controlling.</p>
    </section>
    <section>
    </section>
    <p class="copyright">&copy; Grammer Queretaro. Design: <a href="">Grammer Querétaro</a>.</p>
</footer>

</div>

<!-- Modal -->
<div class="modal fade clearfix"  id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel" style ='color:black'>Bono de Salida</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style ='color:black;padding: 40px;'>
                <div id='carga' style='display:none;'></div>
                <div id='modalCuerpo'>
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
                    <h4 style='color:black'>Imagen de registro.</h4>
                    <center><img id='imgRegistro' class="img-fluid rounded-start" alt="..."></center>
                    <hr>
                    <h4 style='color:black'>Imagen de salida.</h4>
                    <center><img id='imgSalida' class="img-fluid rounded-start" alt="..."></center>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick='reversa();' data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" onclick="llenadoInicial(1)" data-bs-target="#exampleModalToggle2">Confirmar</button>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" onclick="llenadoInicial(2)" data-bs-target="#exampleModalToggle2">Rechazar</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel2" style='color:black'>Confirmación de bono de salida</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <!--<div id='cargaAux' style='display:none;'></div>-->
                <div id='modalCuerpoAux'>
                    <div class="col-12">
                        <h4 style='color:black'>Ingresa tu nombre</h4>
                        <input type='text' style="resize:none; margin-bottom: 15px; margin-top: 15px;border-color: darkgray;color:black;" placeholder="Causa" rows="6" name="causa" id="txtNombreVigilante"
                               required>
                        <h4 id="tituloComentarios" style='color:black'>¿Quieres agregar algun comentario (opcional)?</h4>
                        <textarea style="resize:none; margin-bottom: 15px; margin-top: 15px;border-color: darkgray;color:black;" placeholder="Causa" rows="6" name="causa" id="txtCausaAux"
                                  required></textarea>
                        <h4 style="display: none;color:black;" id="tituloFecha" >Ingresa la nueva fecha de retorno</h4>
                        <input type="datetime-local" id="fechaRetronoRechazo" style="display: none;border-color: darkgray;color:black;">

                        <label style="text-align: center;color: black;">Sube la imagen de la entrega</label>
                        <input type="file" id="files" accept="image/*" onchange="preview_image()">
                        <br><br>
                        <center><img style="display: none;" id="imagenPrevisualizacion" height="250px"></center>

                        <img src="" style="display: none;" id="new">
                        <img src="" style="display: none;" id="old">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id='botonSalir' type="button" class="btn btn-secondary" onclick='reversa();' data-bs-dismiss="modal">Cancelar</button>
                <button id='botonConfirmar' class="btn btn-success" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" onclick='test3();'>Confirmar entrega</button>
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
<script src="js/registro.js"></script>
<script src="assets/js/main.js"></script><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>


<script>

    var idBitacora,imagenRegistro,banderaAuxRechazo,correoSolicitante,nominaSolicitante,nombreSolicitante,descripcion,cantidad,unidadMedida,empresa,nombreExterno,direccion,tipoSalida,fechaRetorno,tipoRetorno,causa,comentarios,tipo,email;

    function llenadoInicial(estatus){
        if (estatus==1){
            banderaAuxRechazo=1;
            document.getElementById("exampleModalToggleLabel2").innerHTML='Confirmación de bono de salida';
            document.getElementById("fechaRetronoRechazo").style.display='none';
            document.getElementById("tituloFecha").style.display='none';
            document.getElementById("tituloComentarios").innerHTML='¿Quieres agregar algun comentario (opcional)?';
            document.getElementById("txtCausaAux").value='';
            document.getElementById("fechaRetronoRechazo").value='';
            document.getElementById("botonConfirmar").innerHTML='Confirmar';
            document.getElementById("botonConfirmar").style.background='green';
        }

        if (estatus==2){
            banderaAuxRechazo=2;
            document.getElementById("exampleModalToggleLabel2").innerHTML='¿Porque estas rechazando este bono de salida?';
            document.getElementById("fechaRetronoRechazo").style.display='block';
            document.getElementById("tituloFecha").style.display='block';
            document.getElementById("tituloComentarios").innerHTML='Ingresa la causa del retorno';
            document.getElementById("botonConfirmar").innerHTML='Rechazar';
            document.getElementById("botonConfirmar").style.background='red';
        }

    }

    function limpiarPantalla(IdBitacora,ImagenRegistro,CorreoSolicitante,NominaSolicitante,NombreSolicitante,Descripcion,Cantidad,UnidadMedida,Empresa,NombreExterno,Direccion,TipoSalida,FechaRetorno,TipoRetorno,Causa,Comentarios,correoSolicitante,tipo) {
        if(tipo=="0"){
            document.getElementById('nav').style.display='none';

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

            document.getElementById('txtNombre').innerHTML="<b style='color:black'>Nombre : </b>"+NombreSolicitante;
            document.getElementById('txtDescripcion').innerHTML="<b style='color:black'>Descripción : </b>"+Descripcion;
            document.getElementById('txtCantidad').innerHTML="<b style='color:black'>Cantidad : </b>"+Cantidad;
            document.getElementById('txtUnidadMedida').innerHTML="<b style='color:black'>U/M : </b>"+UnidadMedida;
            document.getElementById('txtEmpresa').innerHTML="<b style='color:black'>Empresa : </b>"+Empresa;
            document.getElementById('txtDireccion').innerHTML="<b style='color:black'>Dirección de destino : </b>"+Direccion;
            document.getElementById('txtNombreExterno').innerHTML="<b style='color:black'>Nombre del responsable externo : </b>"+NombreExterno;
            document.getElementById('txtTipoMaterial').innerHTML="<b style='color:black'>Tipo de material : </b>"+TipoSalida;
            document.getElementById('txtCausa').innerHTML="<b style='color:black'>Causa de la salida : </b>"+Causa;
            document.getElementById('txtComentarios').innerHTML="<b style='color:black'>Cometarios adicionales : </b>"+Comentarios;
            if(TipoRetorno=='No'){
                document.getElementById('txtFechaRetorno').innerHTML="<b style='color:black'>Fecha de retorno : </b> Material no retorna.";
            }else{
                document.getElementById('txtFechaRetorno').innerHTML="<b style='color:black'>Fecha de retorno : </b>"+FechaRetorno;
            }
            document.getElementById('txtBitacora').innerHTML="<b style='color:black'>Fecha de retorno : </b>"+IdBitacora;
            document.getElementById('imgRegistro').src="dao/fotos/registro/"+ImagenRegistro+".png";
            document.getElementById('imgSalida').src="dao/fotos/salidas/"+ImagenRegistro+".png";
        }
    }

    function recarge() {
        location.reload();
    }

    function reversa(){
        document.getElementById('nav').style.display='block';
    }

    cargaInicial();
    function cargaInicial() {

        $.getJSON('https://arketipo.mx/Controlling/BonoSalida/dao/DaoConsultaDetalleEntregas.php', function (data) {
            for (var i = 0; i < data.data.length; i++) {
                
                const originalValue = data.data[i].Comentarios;
                const newValue = originalValue.replace(/\r|\n/g, '');
                
                const originalValueDescripcion = data.data[i].Descripcion;
                const newValueDescripcion = originalValueDescripcion.replace(/\r|\n/g, '');
                
                
                const originalValueCausa = data.data[i].Causa;
                const newValueCausa = originalValueCausa.replace(/\r|\n/g, '');
                
                $('#cartas').append("<div class='card mb-3' style='max-width: 840px;vertical-align: middle;display: inline-block;text-align: left;'><div class='row g-0'><div class='col-md-4' style='align-self: center;'><center><img src='images/solicitud.png' class='img-fluid rounded-start' alt='...'></center></div><div class='col-md-8'><div class='card-body'><h5 class='card-title'>Solicitante : "+data.data[i].NombreSolicitante+"</h5><ul style='margin: 0 0 0.5em 0 !important;'><li>Folio : "+data.data[i].IdBitacora+"</li><li>Descripcion : "+newValueDescripcion+"</li><li>Tipo de salida : "+data.data[i].TipoSalida+"</li><li>Causa de salida : "+newValueCausa+"</li></ul><button onclick=\"limpiarPantalla('"+data.data[i].IdBitacora+"','"+data.data[i].ImagenRegistro+"','"+data.data[i].CorreoSolicitante+"','"+data.data[i].NominaSolicitante+"','"+data.data[i].NombreSolicitante+"','"+newValueDescripcion+"','"+data.data[i].Cantidad+"','"+data.data[i].UnidadMedida+"','"+data.data[i].Empresa+"','"+data.data[i].NombreExterno+"','"+data.data[i].Direccion+"','"+data.data[i].TipoSalida+"','"+data.data[i].FechaRetorno+"','"+data.data[i].TipoRetorno+"','"+newValueCausa+"','"+newValue+"','"+data.data[i].CorreoSolicitante+"','0')\" style='margin-bottom: 10px;' type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#exampleModal'>Ver detalles</button><p class='card-text'><small class='text-body-secondary'>"+data.data[i].FechaRegistro+"</small></p></div></div></div></div>");
                
                console.log("<div class='card mb-3' style='max-width: 840px;vertical-align: middle;display: inline-block;text-align: left;'><div class='row g-0'><div class='col-md-4' style='align-self: center;'><center><img src='images/solicitud.png' class='img-fluid rounded-start' alt='...'></center></div><div class='col-md-8'><div class='card-body'><h5 class='card-title'>Solicitante : "+data.data[i].NombreSolicitante+"</h5><ul style='margin: 0 0 0.5em 0 !important;'><li>Folio : "+data.data[i].IdBitacora+"</li><li>Descripcion : "+newValueDescripcion+"</li><li>Tipo de salida : Tarimas</li><li>Causa de salida : "+newValueCausa+"</li></ul><button onclick=\"limpiarPantalla('"+data.data[i].IdBitacora+"','"+data.data[i].ImagenRegistro+"','"+data.data[i].CorreoSolicitante+"','"+data.data[i].NominaSolicitante+"','"+data.data[i].NombreSolicitante+"','"+newValueDescripcion+"','"+data.data[i].Cantidad+"','"+data.data[i].UnidadMedida+"','"+data.data[i].Empresa+"','"+data.data[i].NombreExterno+"','"+data.data[i].Direccion+"','"+data.data[i].TipoSalida+"','"+data.data[i].FechaRetorno+"','"+data.data[i].TipoRetorno+"','"+newValueCausa+"','"+newValue+"','"+data.data[i].CorreoSolicitante+"','0')\" style='margin-bottom: 10px;' type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#exampleModal'>Ver detalles</button><p class='card-text'><small class='text-body-secondary'>"+data.data[i].FechaRegistro+"</small></p></div></div></div></div>");
            }
        });
    }


    function enviarCorreoEncargado(estatus) {

        const data = new FormData();
        var nombreAux;
        var nominaAux = document.getElementById('txtNomina').value;
        if(nominaAux=='00001007'){nombreAux='Luis Olvera'}
        if(nominaAux=='00001434'){nombreAux='Martin Rodriguez'}
        if(nominaAux=='00001510'){nombreAux='Mario Centeno'}

        data.append('nomina', nominaSolicitante);
        data.append('email', email);
        data.append('solicitante', nombreSolicitante);
        data.append('descripcion', descripcion);
        data.append('cantidad', cantidad);
        data.append('um', unidadMedida);
        data.append('empresa', empresa);
        data.append('portador', nombreExterno);
        data.append('tipo', tipoSalida);
        data.append('retorno', tipoRetorno);
        data.append('fechaRetorno', fechaRetorno);
        data.append('causa', causa);
        data.append('comentario', comentario);
        data.append('idImagen', imagenRegistro);
        data.append('direccion', direccion);
        data.append('NombreConfirmado', nombreAux);
        data.append('Estatus', estatus);
        data.append('idBitacora', idBitacora);

        if(estatus==1){
            data.append('bandera', 4);
            data.append('retroalimentacion','');
        }else{
            data.append('bandera', 4);
            data.append('retroalimentacion', document.getElementById('txtCausaAux').value);
        }

        fetch('https://arketipo.mx/MailerBonosSalida.php', {
            method: 'POST',
            body: data
        })
            .then(function (response) {
                if (response.ok) {
                    location.href = "SolicitudesSalida.php";
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


</script>

</body>

</html>