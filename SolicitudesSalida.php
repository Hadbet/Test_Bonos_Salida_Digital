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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Grammer Queretaro</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="shortcut icon" href="lib/assets/img/iconoarriba.png" />
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
            del bono de salida actual, con el soporte del departamento de <a href="https://html5up.net">Controlling</a>.</p>
    </header>

    <!-- Nav -->
    <nav id="nav">
        <ul>
            <li><a href="https://arketipo.mx/Controlling/BonoSalida/SolicitudesSalida.php" class="active">Inicio</a></li>
            <li><a href="https://arketipo.mx/Controlling/BonoSalida/HistoricoAdmin.html">Historico</a></li>
        </ul>
    </nav>

    <!-- Main -->
    <div id="main">


        <!-- First Section -->
        <section id="first" class="main special">
            <header class="major">
                <h2>Bonos de salida pendientes por confirmar.</h2>
            </header>
            <p>Aquí encontrarás todos los bonos de salida que tienes pendientes de validar.</p>

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
    <p class="copyright">&copy; Grammer Queretaro. Design: <a href="">Grammer Queretaro</a>.</p>
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
                        <li id='txtNombre'><b style='color:black'>Nombre : </b></li>
                        <li id='txtDescripcion'><b style='color:black'>Descripción : </b></li>
                        <li id='txtCantidad'><b style='color:black'>Cantidad : </b></li>
                        <li id='txtUnidadMedida'><b style='color:black'>U/M : </b></li>
                        <li id='txtEmpresa'><b style='color:black'>Empresa : </b></li>
                        <li id='txtDireccion'><b style='color:black'>Dirección de destino : </b></li>
                        <li id='txtNombreExterno'><b style='color:black'>Nombre del responsable externo : </b></li>
                        <li id='txtTipoMaterial'><b style='color:black'>Tipo de material : </b></li>
                        <li id='txtCausa'><b style='color:black'>Causa de la salida : </b></li>
                        <li id='txtComentarios'><b style='color:black'>Cometarios adicionales : </b></li>
                        <li id='txtFechaRetorno'><b style='color:black'>Fecha de retorno : </b></li>
                        <li style='display:none' id='txtBitacora'><b style='color:black'>Fecha de retorno : </b></li>
                    </ul>
                    <hr>
                    <center><img id='imgRegistro' class="img-fluid rounded-start" alt="..."></center>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick='reversa();' data-bs-dismiss="modal">Close</button>
                <button type="button" id="btnConfirmarAux" onclick='actualizarEstatus(1);' class="btn btn-success">Confirmar</button>
                <button type="button" id="btnRechazarAux" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModalToggle2">Rechazar</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel2" style='color:black'>Rechazo de bono de salida</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div id='cargaAux' style='display:none;'></div>
                <div id='modalCuerpoAux'>
                    <div class="col-12">
                        <h4 style='color:black'>¿Por qué estás rechazando el bono de salida?</h4>
                        <textarea style="resize:none; margin-bottom: 15px; margin-top: 15px;border-color: darkgray;color:black;" placeholder="Causa" rows="6" name="causa" id="txtCausaAux"
                                  required></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick='reversa();' data-bs-dismiss="modal">Cancelar</button>
                <button class="btn btn-danger" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" onclick='actualizarEstatus(2);'>Confirmar Rechazo</button>
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
<script src="assets/js/main.js"></script><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>


<script>



const descripcionConSaltosDeLinea = 'Equipos Viejos.Equipo 1 - Raymond serie 446-18-10733.Equipo 2 - \n Raymond serie 475-18-11620';
const descripcionSinSaltosDeLinea = descripcionConSaltosDeLinea.replace(/\n/g, ' ');
console.log(descripcionSinSaltosDeLinea);

    var idBitacora,imagenRegistro,correoSolicitante,nominaSolicitante,nombreSolicitante,descripcion,cantidad,unidadMedida,empresa,nombreExterno,direccion,tipoSalida,fechaRetorno,tipoRetorno,causa,comentarios,tipo,email;


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
        }
    }

    function reversa(){
        document.getElementById('nav').style.display='block';
    }

    cargaInicial();
    function cargaInicial() {

        var cargaAux,nominaAux;
        nominaAux = document.getElementById('txtNomina').value;
        if(nominaAux=='00001007'){cargaAux='3'}//Plant_Manager
        if(nominaAux=='00001434'){cargaAux='1'}//Controlling
        if(nominaAux=='00001510'){cargaAux='2'}//Seguridad
        
        if(nominaAux=='00001605'){cargaAux='1'}
        if(nominaAux=='00001386'){cargaAux='1'}
        
        if(nominaAux=='00001543'){cargaAux='2'}
        if(nominaAux=='00001542'){cargaAux='2'}

        $.getJSON('https://arketipo.mx/Controlling/BonoSalida/dao/DaoConsultaDetalle.php?tipoEncargado='+cargaAux, function (data) {
            for (var i = 0; i < data.data.length; i++) {
                
                const originalValue = data.data[i].Comentarios;
                const newValue = originalValue.replace(/\n/g, '');
                
                const originalValueDescripcion = data.data[i].Descripcion;
                const newValueDescripcion = originalValueDescripcion.replace(/\n/g, '');
                
                $('#cartas').append("<div class='card mb-3' style='max-width: 840px;vertical-align: middle;display: inline-block;text-align: left;'><div class='row g-0'><div class='col-md-4' style='align-self: center;'><center><img src='images/solicitud.png' class='img-fluid rounded-start' alt='...'></center></div><div class='col-md-8'><div class='card-body'><h5 class='card-title'>Solicitante : "+data.data[i].NombreSolicitante+"</h5><ul style='margin: 0 0 0.5em 0 !important;'><li>Descripcion : "+data.data[i].Descripcion+"</li><li>Tipo de salida : "+data.data[i].TipoSalida+"</li><li>Causa de salida : "+data.data[i].Causa+"</li></ul><button onclick=\"limpiarPantalla('"+data.data[i].IdBitacora+"','"+data.data[i].ImagenRegistro+"','"+data.data[i].CorreoSolicitante+"','"+data.data[i].NominaSolicitante+"','"+data.data[i].NombreSolicitante+"','"+newValueDescripcion+"','"+data.data[i].Cantidad+"','"+data.data[i].UnidadMedida+"','"+data.data[i].Empresa+"','"+data.data[i].NombreExterno+"','"+data.data[i].Direccion+"','"+data.data[i].TipoSalida+"','"+data.data[i].FechaRetorno+"','"+data.data[i].TipoRetorno+"','"+data.data[i].Causa+"','"+newValue+"','"+data.data[i].CorreoSolicitante+"','0')\" style='margin-bottom: 10px;' type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#exampleModal'>Ver detalles</button><p class='card-text'><small class='text-body-secondary'>"+data.data[i].FechaRegistro+"</small></p></div></div></div></div>");
            }
        });
    }

    function actualizarEstatus(estatus){

        document.getElementById('btnConfirmarAux').style.display='none';
        document.getElementById('btnRechazarAux').style.display='none';

        document.getElementById('modalCuerpo').style.display = 'none';
        document.getElementById('carga').style.display = 'block';
        document.getElementById('carga').innerHTML = '<div class="loading"><center><img src="images/carga.gif" height="350px"><br/>Un momento, por favor...</center></div>';

        document.getElementById('modalCuerpoAux').style.display = 'none';
        document.getElementById('cargaAux').style.display = 'block';
        document.getElementById('cargaAux').innerHTML = '<div class="loading"><center><img src="images/carga.gif" height="350px"><br/>Un momento, por favor...</center></div>';

        var banderaAux,nominaAux;
        nominaAux = document.getElementById('txtNomina').value;
        if(nominaAux=='00001007'){banderaAux='4'}
        
        if(nominaAux=='00001434'){banderaAux='2'}
        if(nominaAux=='00001386'){banderaAux='2'}
        if(nominaAux=='00001605'){banderaAux='2'}
        
        if(nominaAux=='00001510'){banderaAux='3'}
        if(nominaAux=='00001543'){banderaAux='3'}
        if(nominaAux=='00001542'){banderaAux='3'}
        
        console.log('https://arketipo.mx/Controlling/BonoSalida/dao/DaoActualizarEstatus.php?bitacora='+idBitacora+'&estatus='+estatus+'&bandera='+banderaAux);
        $.getJSON('https://arketipo.mx/Controlling/BonoSalida/dao/DaoActualizarEstatus.php?bitacora='+idBitacora+'&estatus='+estatus+'&bandera='+banderaAux, function (data) {
            if(data.data[0].estatus == 'bien'){
                enviarCorreoEncargado(estatus);
            }else{
                document.getElementById('btnConfirmarAux').style.display='block';
                document.getElementById('btnRechazarAux').style.display='block';
                alert("algo salio mal");
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
        if(nominaAux=='00001543'){nombreAux='Yulissa Trejo'}
        if(nominaAux=='00001542'){nombreAux='Fernanda Velazquez'}
        if(nominaAux=='00001386'){nombreAux='Pedro Borguez'}
        if(nominaAux=='00001605'){nombreAux='Ariadna Munoz'}

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
                    document.getElementById('btnConfirmarAux').style.display='block';
                    document.getElementById('btnRechazarAux').style.display='block';
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

    function liberar(id,apu,zona,area,problema,fecha){
        console.log(id);
        console.log(apu);
        console.log(zona);
        console.log(area);
        console.log(problema);
        console.log(fecha);
        console.log("confirmacion.php?id="+id+"&apu="+apu+"&zona="+zona+"&area="+area+"&problema="+problema+"&fecha="+fecha);
        window.location="confirmacion.php?id="+id+"&apu="+apu+"&zona="+zona+"&area="+area+"&problema="+problema+"&fecha="+fecha;
    }


</script>

</body>

</html>