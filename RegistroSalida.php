<!DOCTYPE HTML>
<html>

<head>
    <?php
    session_start();

    if ($_SESSION["nomina"] == "" && $_SESSION["nomina"] == null && $_SESSION["email"] == "" && $_SESSION["email"] == null) {
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='1; URL=index.html'>";
        session_destroy();
    } else {
        session_start();
    }
    ?>

    <!-- CSS -->
    <link rel="stylesheet" href="lib/sweetalert2.css">

    <!-- JavaScript -->
    <script src="lib/sweetalert2.all.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="lib/jquery-ui.min.css">

    <!-- JavaScript (requiere jQuery) -->
    <script src="lib/jquery-3.6.0.min.js"></script>
    <script src="lib/jquery-ui.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <input type="text" style='display:none;' id="txtEmail" value="<?php echo $_SESSION["email"] ?>"/>
    <input type="text" style='display:none;' id="txtNomina" value="<?php echo $_SESSION["nomina"] ?>"/>

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
        @media only screen and (max-width: 768px) {
            #navegadorMovil {
                display: block !important;
            }
        }
    </style>
</head>

<body class="is-preload">

<nav id="navegadorMovil" class="navbar navbar-dark bg-dark fixed-top"
     style='background-color: rgb(255 0 0 / 0%) !important;display:none;'>
    <div class="container-fluid">
        <button class="navbar-toggler f-r" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar"
             aria-labelledby="offcanvasDarkNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Menu bono de salida.</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page"
                           href="https://arketipo.mx/Controlling/BonoSalida/RegistroSalida.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                           href="https://arketipo.mx/Controlling/BonoSalida/Historico.php">Historico</a>
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
        <span class="logo"><img style="width: 35%;" src="images/Grammer_Logo_Original_White_sRGB_screen_transparent.png"
                                alt=""/></span>
        <h1>Bonos de salida</h1>
        <p>Bonos de salida electrónicos, una opción alternativa<br/>
            del bono de salida actual, con el soporte del departamento de <a href="#">Controlling</a>.</p>
    </header>

    <!-- Nav -->
    <nav id="nav">
        <ul>
            <li><a href="https://arketipo.mx/Controlling/BonoSalida/RegistroSalida.php" class="active">Inicio</a></li>
            <li><a href="https://arketipo.mx/Controlling/BonoSalida/Historico.php">Historico</a></li>
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
                <p style='padding: 4%;'>Se ha validado correctamente este registro, favor de esperar a la confirmación
                    de su encargado que le llegara mediante correo, en dado caso que no reciba respuesta, checarlo con
                    su encargado y si no recibió ningún correo, ponerse en contacto directo con IT</p>
                <a style='margin-bottom: 10%;margin-top: -2%;' id="guardarRegistro" onclick='recarge();'
                   class="btn btnGreen">Regresar</a>
            </section>
        </div>

        <div id='registroFallido' style='display:none;'>
            <section id="firsts" class="main special">
                <header class="major">
                    <h2 style='color:red;'>Algo salio mal.</h2>
                </header>
                <img style='width: 24%;' src='images/dislike.png'>
                <p style='padding: 4%;'>Ah ocurrido un error favor de revisarlo con IT.</p>
                <a style='margin-bottom: 10%;margin-top: -2%;' id="guardarRegistro" onclick='recarge();'
                   class="btn btnRed">Regresar</a>
            </section>
        </div>

        <div id='carga' style='display:none;'></div>

        <!-- First Section -->
        <section id="first" class="main special">
            <header class="major">
                <h2>Registros de salida.</h2>
            </header>
            <p>Ingresa los datos correspondientes del activo que sacaras de Grammer recuerda ser muy específico con lo
                que ingresas y sobre todo no dejar campos vacíos.</p>
            <p>Recuerda que es importante ingresar a tu gerente en la casilla que dice "correo de tu encargado", puedes
                ingresar un proxy de tu gerente como un coordinador o supervisor, <span style='color:red;'>solo en caso de que no se encuentre presente tu gerente.</span>
            </p>

            <div class="row gtr-uniform">
                <div class="col-12 col-12-small">
                    <input type="checkbox" id="chtMultibono">
                    <label for="chtMultibono">Multibono</label>
                </div>
            </div>

            <form method="post">
                <div class="row">
                    <div class="col-6 col-12-small">
                        <p style="margin-bottom: 10px !important;">Seleccione su área</p>
                        <select style="margin-bottom: 20px" id="sltArea" style="">
                            <option value="" selected>Seleccione el área</option>
                            <option value="Logistica">Logística o Almacén</option>
                            <option value="Calidad">Calidad</option>
                            <option value="Ingenieria">Ingeniería</option>
                            <option value="Mantenimiento">Mantenimiento</option>
                            <option value="IT">IT</option>
                            <option value="Controlling">Controlling o GPS</option>
                            <option value="Recursos Humanos">Recursos Humanos</option>
                            <option value="Seguridad e higiene">Seguridad e higiene</option>
                        </select>
                    </div>

                    <div class="col-6 col-12-small">
                        <p style="margin-bottom: 10px !important;">Nombre solicitante</p>
                        <input type="text" placeholder="Solicitante" name="solicitante" id="txtSolicitante" required/>
                    </div>


                    <div id="fila" style="">
                        <hr>
                        <div class="col-12 col-12-small">
                            <p style="margin-bottom: 10px !important;">Descripción / Modelo / No.Serie</p>
                            <input type="text" placeholder="Descripción" name="Descripcion" id="txtDescripcion"
                            />
                        </div>

                        <div class="col-6 col-12-small" style="float: left; width: 430px;">
                            <p style="margin-bottom: 10px !important; margin-top: 10px;">Cantidad</p>
                            <input type="number" placeholder="Cantidad" name="Cantidad" id="txtCantidad" min="1"
                                   pattern="^[0-9]+"/>
                        </div>

                        <div class="col-6 col-12-small" style="float: right; width: 430px;">
                            <p style="margin-bottom: 10px !important; margin-top: 10px;">U/M</p>
                            <select style="margin-bottom: 20px" placeholder="Unidad de medida" name="um" id="txtUm">
                                <option value="" selected>Seleccione la unidad de medida</option>
                                <option value="Pieza">Piezas</option>
                                <option value="Kilogramos">Kilogramos</option>
                                <option value="Litros">Litros</option>
                                <option value="Libras">Libras</option>
                                <option value="Libras">Centímetros</option>
                                <option value="Metros">Metros</option>
                                <option value="Gramos">Gramos</option>
                                <option value="Onzas">Onzas</option>
                                <option value="Toneladas">Toneladas</option>
                            </select>
                        </div>

                        <div class="col-12 col-12-small">
                            <select id="sltTipo" style="margin-bottom: 15px; margin-top: 30px;">
                                <option value="value1" selected>Seleccione el tipo</option>
                                <option value="E-Baja de activos_CO">Baja de activos</option>
                                <option value="E-Materias primas a otras plantas_L">Materias primas a otras plantas
                                </option>
                                <option value="O-Tarimas_L">Tarimas</option>
                                <option value="O-Cajas vacias retorno Tetla_L">Cajas vacias retorno Tetla</option>
                                <option value="O-Material de empaque de cartón_L">Material de empaque de cartón</option>
                                <option value="O-Totes vacios_L">Totes vacios</option>
                                <option value="O-Tubos_L">Tubos</option>
                                <option value="O-Placa_L">Placa</option>
                                <option value="O-Empaque Gris_L">Empaque Gris</option>
                                <option value="O-Empaque dañado (Grammer)_L">Empaque dañado (Grammer)</option>
                                <option value="O-Limpieza de empaque_L">Limpieza de empaque</option>
                                <option value="O-Modificación o reparación de racks (Cliente)_L">Modificación o
                                    reparación
                                    de racks (Cliente)
                                </option>
                                <option value="O-Residuos_E">Residuos</option>
                                <option value="O-Tanques de respiración_E">Tanques de respiración</option>
                                <option value="O-Extintores_E">Extintores</option>
                                <option value="O-Cambio de EPP/Insumos de limpieza por defecto_E">Cambio de EPP/Insumos
                                    de
                                    limpieza por defecto
                                </option>
                                <option value="O-Equipos a reparación (patines manuales, etc)_E">Equipos a reparación
                                    (patines manuales/jaulas dispensadoras/equipo médico/dispensadores de
                                    agua/dispensadores de sanitizantes)
                                </option>
                                <option value="O-Insumos de seguridad para eventos(Megafono/etc.)_E">Insumos de
                                    seguridad
                                    para eventos(Megafono/botarga/radios/etc.)
                                </option>
                                <option value="O-Equipo de medición y pruebas para calibración_C">Equipo de medición y
                                    pruebas para calibración
                                </option>
                                <option value="O-Equipo de medición y pruebas para reparación_C">Equipo de medición y
                                    pruebas para reparación
                                </option>
                                <option value="O-Muestras para aprobación de clientes / Proveedores_C">Muestras para
                                    aprobación de clientes / Proveedores
                                </option>
                                <option value="O-Muestras para pruebas externas_C">Muestras para pruebas externas
                                </option>
                                <option value="O-Salidas de material (Retrabajo)_C">Salidas de material (Retrabajo)
                                </option>
                                <option value="O-Salidas de material (Retorno a proveedor)_C">Salidas de material
                                    (Retorno a
                                    proveedor)
                                </option>
                                <option value="E-Moldes/herramentales_M">Moldes/herramentales</option>
                                <option value="E-Reparaciones a maquinas, equipos y componentes_M">Reparaciones a
                                    maquinas,
                                    equipos y componentes
                                </option>
                                <option value="O-Salida de refacciones/equipos por garantía_M">Salida de
                                    refacciones/equipos
                                    por garantía
                                </option>
                                <option value="O-Rediseño y/o modificación de herramientas y maquinados._M">Rediseño y/o
                                    modificación de herramientas y maquinados.
                                </option>
                                <option value="O-Equipo/refacción de muestra para fabricación._M">Equipo/refacción de
                                    muestra para fabricación.
                                </option>
                                <option value="O-Tanques vacios para rellenar mezcla soldadura y nitrogeno_M">Tanques
                                    vacios
                                    para rellenar mezcla soldadura y nitrogeno
                                </option>
                                <option
                                    value="E-Residuos de equipo inutilizado (ventiladores, motores, bombas, cilindros neumáticos,etc.)_M">
                                    Residuos de equipo inutilizado (ventiladores, motores, bombas, cilindros
                                    neumáticos,etc.)
                                </option>
                                <option value="O-Componantes de materia prima, muestras, prototipos_I">Componantes de
                                    materia prima, muestras, prototipos
                                </option>
                                <option
                                    value="E-Subprocesos de materia prima dentro de SAP (en fase de lanzamientos)_I">
                                    Subprocesos de materia prima dentro de SAP (en fase de lanzamientos)
                                </option>
                                <option
                                    value="E-Salida de estaciones/ racks / herramentales para actualización y/o reparación_I">
                                    Salida de estaciones/ racks / herramentales para actualización y/o reparación
                                </option>
                                <option value="E-Salida de materia prima/ PT para pruebas con proveedor_I">Salida de
                                    materia
                                    prima/ PT para pruebas con proveedor
                                </option>
                                <option value="O-Producto PT, muestras, prototipos_I">Producto PT, muestras, prototipos
                                </option>
                                <option value="E-Reparacion de equipos computacionales o del área_T">Reparacion de
                                    equipos
                                    computacionales o del área
                                </option>
                                <option value="O-Cartuchos de tonner_T">Cartuchos de tonner</option>
                                <option value="E-Equipos de cómputo para préstamo Tetla_T">Equipos de cómputo para
                                    préstamo
                                    Tetla
                                </option>
                                <option value="O-Sillas para Reparar (comedor)_R">Sillas para Reparar (comedor)</option>
                                <option value="O-Equipo Mayor para reparar (comedor)_R">Equipo Mayor para reparar
                                    (comedor)
                                </option>
                                <option value="O-Hornos de Microondas a reparación (comedor)_R">Hornos de Microondas a
                                    reparación (comedor)
                                </option>
                                <option value="O-Equipo Mayor a desecho (comedor)_R">Equipo Mayor a desecho (comedor)
                                </option>
                            </select>

                            <p id="tipoSalidaP" style="margin-bottom: 10px !important;"></p>

                            <div class="col-12 col-12-small">
                                <select id="sltRetorno" style="margin-bottom: 15px; margin-top: 15px;">
                                    <option value="valueR">¿El material retorna?</option>
                                    <option value="Si">Sí</option>
                                    <option value="No">No</option>
                                </select>
                            </div>

                            <div class="col-6 col-12-small">
                                <p id="fech" name="fech" style="display:none; margin-bottom: 10px !important;">Fecha de
                                    Retorno</p>
                                <input class="form-control input-sm" type="datetime-local" name="fechas"
                                       id="txtFechaRetorno"
                                       style="display:none;"/>
                            </div>

                        </div>
                    </div>
                    <hr>

                    <button id="btnAgregarDiv" style="display: none">Agregar</button>

                    <div class="col-6 col-12-small">
                        <p style="margin-bottom: 10px !important; margin-top: 10px;">Empresa</p>
                        <input type="text" placeholder="Empresa" name="Empresa" id="txtEmpresa"/>
                    </div>

                    <div class="col-6 col-12-small">
                        <p style="margin-bottom: 10px !important; margin-top: 10px;">Dirección del destino</p>
                        <input type="text" placeholder="Dirección destino" name="Direccion" id="txtDireccion"
                        />
                    </div>

                    <div class="col-6 col-12-small">
                        <p style="margin-bottom: 10px !important; margin-top: 10px;">Correo de tu encargado</p>
                        <input type="text" placeholder="Dirección destino" name="Correo" id="txtCorreoEncargado"
                        />
                    </div>

                </div>

                <div class="col-12">
							<textarea style="resize:none; margin-bottom: 15px; margin-top: 15px;" placeholder="Causa"
                                      rows="6" name="causa" id="txtCausa"
                            ></textarea>
                </div>

                <div class="col-12">
							<textarea placeholder="Comentarios" rows="6" style="resize:none" name="Comentarios"
                                      id="txtComentarios"></textarea>
                </div>
                <div class="field" style="margin: 0 auto;">
                    <label style="text-align: center;color: white;">Sube la imagen de tu material</label>
                    <p></p>
                    <input type="file" id="files" accept="image/*" onchange="preview_image()">
                    <br><br>
                    <center><img style="display: none;" id="imagenPrevisualizacion" height="250px"></center>
                </div>

                <img src="" style="display: none;" id="new">
                <img src="" style="display: none;" id="old">
                <div class="col-12" style="margin-top: 8%;">
                    <ul class="actions special">
                        <li><a id="guardarRegistro" onclick="test();" class="btn btnGreen">Confirmar salida</a></li>
                    </ul>
                </div>

    </div>
    </form>
    <!--<div><center><img style="width: 70%;" src="images/logoInicial_2.png"></center></div>-->
    </section>
</div>


</div>
<!-- Footer -->
<footer id="footer">
    <section>
        <h2>Dudas y preguntas.</h2>
        <p>Para dudas, problemas o sugerencias que tengas acerca del proceso del software te puedes comunicar
            directamente con el departamento de IT o de Controlling.</p>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>

<script>

    const checkbox = document.getElementById('chtMultibono');

    checkbox.addEventListener('change', function() {
        if (checkbox.checked) {
            document.getElementById('btnAgregarDiv').style.display = 'block'; // Mostrar el botón cuando el checkbox está marcado
        } else {
            document.getElementById('btnAgregarDiv').style.display = 'none'; // Ocultar el botón cuando el checkbox está desmarcado
        }
    });

    let contador = 0;

    function agregarDiv() {
        // Obtener el div original
        const divOriginal = document.getElementById("fila");

        // Clonar el div original
        const nuevoDiv = divOriginal.cloneNode(true);

        // Generar un ID único para el nuevo div
        const nuevoID = "div" + contador;

        // Actualizar el ID del nuevo div
        nuevoDiv.id = nuevoID;

        // Incrementar el contador para el próximo div
        contador++;

        // Obtener los campos del nuevo div
        const txtDescripcionInput = nuevoDiv.querySelector('#txtDescripcion');
        const txtCantidadInput = nuevoDiv.querySelector('#txtCantidad');
        const txtUmInput = nuevoDiv.querySelector('#txtUm');
        const sltTipoSelect = nuevoDiv.querySelector('#sltTipo');
        const sltRetornoSelect = nuevoDiv.querySelector('#sltRetorno');

        // Actualizar los IDs de los campos del nuevo div
        txtDescripcionInput.id = "txtDescripcion" + contador;
        txtCantidadInput.id = "txtCantidad" + contador;
        txtUmInput.id = "txtUm" + contador;
        sltTipoSelect.id = "sltTipo" + contador;
        sltRetornoSelect.id = "sltRetorno" + contador;

        // Limpiar los valores de los campos del nuevo div
        txtDescripcionInput.value = '';
        txtCantidadInput.value = '';
        txtUmInput.value = '';
        sltTipoSelect.selectedIndex = 0;
        sltRetornoSelect.selectedIndex = 0;

        // Agregar el nuevo div justo después del div original
        divOriginal.parentNode.insertBefore(nuevoDiv, divOriginal.nextSibling);
    }

    const btnAgregar = document.getElementById("btnAgregarDiv");
    btnAgregar.addEventListener("click", function (event) {
        event.preventDefault(); // Evitar el submit del formulario
        agregarDiv(); // Llamar a la función agregarDiv()
    });

    document.getElementById("txtCorreoEncargado").addEventListener("blur", function () {
        var correoEncargado = this.value;

        // Expresión regular para validar el correo con el dominio "@grammer.com"
        var regexCorreo = /^[a-zA-Z0-9._%+-]+@grammer\.com$/;

        if (!regexCorreo.test(correoEncargado)) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa un correo válido con el dominio "@grammer.com".'
            })
            this.value = ""; // Borra el campo
        }
    });


    document.getElementById("sltArea").addEventListener("change", function () {
        const selectedArea = this.value;
        const sltTipo = document.getElementById("sltTipo");

        // Obtener todas las opciones del segundo select
        const opcionesTipo = sltTipo.getElementsByTagName("option");

        // Mostrar solo las opciones que contienen "_I" en su valor si se selecciona "Ingeniería" en el primer select
        if (selectedArea === "Ingenieria") {
            for (let i = 0; i < opcionesTipo.length; i++) {
                const optionValue = opcionesTipo[i].value;
                opcionesTipo[i].style.display = optionValue.endsWith("_I") ? "block" : "none";
            }
        }

        if (selectedArea === "Logistica") {
            for (let i = 0; i < opcionesTipo.length; i++) {
                const optionValue = opcionesTipo[i].value;
                opcionesTipo[i].style.display = optionValue.endsWith("_L") ? "block" : "none";
            }
        }

        if (selectedArea === "Calidad") {
            for (let i = 0; i < opcionesTipo.length; i++) {
                const optionValue = opcionesTipo[i].value;
                opcionesTipo[i].style.display = optionValue.endsWith("_C") ? "block" : "none";
            }
        }

        if (selectedArea === "Mantenimiento") {
            for (let i = 0; i < opcionesTipo.length; i++) {
                const optionValue = opcionesTipo[i].value;
                opcionesTipo[i].style.display = optionValue.endsWith("_M") ? "block" : "none";
            }
        }

        if (selectedArea === "Controlling") {
            for (let i = 0; i < opcionesTipo.length; i++) {
                const optionValue = opcionesTipo[i].value;
                opcionesTipo[i].style.display = optionValue.endsWith("_CO") ? "block" : "none";
            }
        }

        if (selectedArea === "IT") {
            for (let i = 0; i < opcionesTipo.length; i++) {
                const optionValue = opcionesTipo[i].value;
                opcionesTipo[i].style.display = optionValue.endsWith("_T") ? "block" : "none";
            }
        }

        if (selectedArea === "Recursos Humanos") {
            for (let i = 0; i < opcionesTipo.length; i++) {
                const optionValue = opcionesTipo[i].value;
                opcionesTipo[i].style.display = optionValue.endsWith("_R") ? "block" : "none";
            }
        }

        if (selectedArea === "Seguridad e higiene") {
            for (let i = 0; i < opcionesTipo.length; i++) {
                const optionValue = opcionesTipo[i].value;
                opcionesTipo[i].style.display = optionValue.endsWith("_E") ? "block" : "none";
            }
        }

    });


    var selectElement = document.getElementById("sltTipo");
    var categoria = "";
    var tipoBonoAux;

    selectElement.addEventListener("change", function () {
        var selectedValue = selectElement.value;

        if (selectedValue.startsWith("O-")) {
            tipoBonoAux = 1;
            document.getElementById("tipoSalidaP").innerHTML = "Tipo de bono : Ordinario";
        } else if (selectedValue.startsWith("E-")) {
            tipoBonoAux = 2;
            document.getElementById("tipoSalidaP").innerHTML = "Tipo de bono : Extraordinario";
        } else {
            document.getElementById("tipoSalidaP").value = "";
        }

        console.log("Categoría seleccionada: " + categoria);
    });

    function recarge() {
        location.reload();
    }

    document.getElementById("guardarRegistro").addEventListener("click", function (event) {
        event.preventDefault();
    });

    $(document).ready(function () {
        $('#guardar').click(function () {
            enviar();
        });
    });

    const ayuda = document.querySelector("#sltRetorno");
    ayuda.addEventListener('change', (event) => {
        const ntes = event.target.value;

        if (ntes == "Si") {
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

    $.getJSON('https://arketipo.mx/Controlling/BonoSalida/dao/DaoNombre.php?nomina=' + document.getElementById("txtNomina").value, function (data) {
        document.getElementById("txtSolicitante").value = data.data[0].NomUser;
    });


</script>

</body>

</html>