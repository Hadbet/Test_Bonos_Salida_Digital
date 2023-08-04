const $seleccionArchivos = document.querySelector("#files"),
    $imagenPrevisualizacion = document.querySelector("#imagenPrevisualizacion");

// Escuchar cuando cambie
$seleccionArchivos.addEventListener("change", () => {
    // Los archivos seleccionados, pueden ser muchos o uno
    document.getElementById("imagenPrevisualizacion").style.display = "block";
    const archivos = $seleccionArchivos.files;
    // Si no hay archivos salimos de la función y quitamos la imagen
    if (!archivos || !archivos.length) {
        $imagenPrevisualizacion.src = "";
        return;
    }
    // Ahora tomamos el primer archivo, el cual vamos a previsualizar
    const primerArchivo = archivos[0];
    // Lo convertimos a un objeto de tipo objectURL
    const objectURL = URL.createObjectURL(primerArchivo);
    // Y a la fuente de la imagen le ponemos el objectURL
    $imagenPrevisualizacion.src = objectURL;
});

async function reduce_image_file_size(base64Str, MAX_WIDTH = 800, MAX_HEIGHT = 800) {
    let resized_base64 = await new Promise((resolve) => {
        let img = new Image()
        img.src = base64Str
        img.onload = () => {
            let canvas = document.createElement('canvas')
            let width = img.width
            let height = img.height

            if (width > height) {
                if (width > MAX_WIDTH) {
                    height *= MAX_WIDTH / width
                    width = MAX_WIDTH
                }
            } else {
                if (height > MAX_HEIGHT) {
                    width *= MAX_HEIGHT / height
                    height = MAX_HEIGHT
                }
            }
            canvas.width = width
            canvas.height = height
            let ctx = canvas.getContext('2d')
            ctx.drawImage(img, 0, 0, width, height)
            resolve(canvas.toDataURL()) // this will return base64 image results after resize
        }
    });
    return resized_base64;
}


async function image_to_base64(file) {
    let result_base64 = await new Promise((resolve) => {
        let fileReader = new FileReader();
        fileReader.onload = (e) => resolve(fileReader.result);
        fileReader.onerror = (error) => {
            console.log(error)
            alert('An Error occurred please try again, File might be corrupt');
        };
        fileReader.readAsDataURL(file);
    });
    return result_base64;
}

async function process_image(file, min_image_size = 300) {
    const res = await image_to_base64(file);
    if (res) {
        const old_size = calc_image_size(res);
        if (old_size > min_image_size) {
            const resized = await reduce_image_file_size(res);
            const new_size = calc_image_size(resized)
            return resized;
        } else {
            return res;
        }

    } else {
        console.log('return err')
        return null;
    }
}


/*- NOTE: USE THIS JUST TO GET PROCESSED RESULTS -*/
async function preview_image() {
    const file = document.querySelector("#files");
    const image = await process_image(file.files[0]);
}

/*- NOTE: USE THIS TO PREVIEW IMAGE IN HTML -*/
async function preview_image() {
    const file = document.querySelector("#files");
    const res = await image_to_base64(file.files[0])
    if (res) {
        document.getElementById("old").src = res;

        const olds = calc_image_size(res)
        console.log('Old ize => ', olds, 'KB')

        const resized = await reduce_image_file_size(res);
        const news = calc_image_size(resized)
        console.log('new size => ', news, 'KB')
        document.getElementById("new").src = resized;
    } else {
        console.log('return err')
    }
}

function getBase64Image(img) {
    var canvas = document.createElement("canvas");
    canvas.width = img.width;
    canvas.height = img.height;
    var ctx = canvas.getContext("2d");
    ctx.drawImage(img, 0, 0);
    var dataURL = canvas.toDataURL();
    enviar(dataURL);
}


function calc_image_size(image) {
    let y = 1;
    if (image.endsWith('==')) {
        y = 2
    }
    const x_size = (image.length * (3 / 4)) - y
    return Math.round(x_size / 1024)
}


function test() {
    getBase64Image(document.getElementById("new"));
}

function getBase64Image2(img, estatus) {
    var canvas = document.createElement("canvas");
    canvas.width = img.width;
    canvas.height = img.height;
    var ctx = canvas.getContext("2d");
    ctx.drawImage(img, 0, 0);
    var dataURL = canvas.toDataURL();
    enviarVigilante(dataURL, estatus);
}

function test2(estatus) {
    getBase64Image2(document.getElementById("new"), estatus);
}

function getBase64Image3(img, estatus) {
    var canvas = document.createElement("canvas");
    canvas.width = img.width;
    canvas.height = img.height;
    var ctx = canvas.getContext("2d");
    ctx.drawImage(img, 0, 0);
    var dataURL = canvas.toDataURL();
    enviarEntrega(dataURL);
}

function test3() {
    getBase64Image3(document.getElementById("new"));
}


function enviar(foto) {

    if (banderaTipo == '1' && foto == '2') {

        var descripcion = [];
        var cantidad = [];
        var unidadMedida = [];
        var tipoBono = [];
        var tipoBonoAuxMulti;

        contador=contador+1;

        for (var i = 0; i < contador; i++) {

            if (i==0){

                descripcion.push(document.getElementById('txtDescripcion').value);
                cantidad.push(document.getElementById('txtCantidad').value);
                unidadMedida.push(document.getElementById('txtUm').value);
                tipoBono.push(document.getElementById('sltTipo').value);

                if (document.getElementById('sltTipo').value.startsWith("E-")){
                    tipoBonoAuxMulti = 2;
                }

            }else{

                descripcion.push(document.getElementById('txtDescripcion'+i).value.trim);
                cantidad.push(document.getElementById('txtCantidad'+i).value.trim());
                unidadMedida.push(document.getElementById('txtUm'+i).value.trim());
                tipoBono.push(document.getElementById('sltTipo'+i).value.trim());

                if (document.getElementById('sltTipo'+i).value.startsWith("E-")){
                    tipoBonoAuxMulti = 2;
                }

            }

        }

        console.log(descripcion);
        console.log(cantidad);
        console.log(unidadMedida);
        console.log(tipoBono);
        console.log(tipoBonoAuxMulti);

    } else {
/*
        var email = document.getElementById('txtEmail');
        var nomina = document.getElementById('txtNomina');
        var solicitante = document.getElementById('txtSolicitante');
        var descripcion = document.getElementById('txtDescripcion');
        var cantidad = document.getElementById('txtCantidad');
        var um = document.getElementById('txtUm');
        var empresa = document.getElementById('txtEmpresa');
        var direccion = document.getElementById('txtDireccion');
        var tipo = document.getElementById('sltTipo');
        //var tipoBono = document.getElementById('sltTipoBono');
        var area = document.getElementById('sltArea');
        var retorno = document.getElementById('sltRetorno');
        var fechaRetorno = document.getElementById('txtFechaRetorno');
        var causa = document.getElementById('txtCausa');
        var comentarios = document.getElementById('txtComentarios');
        var correoEncargado = document.getElementById('txtCorreoEncargado');
        var categoria = "";
        const correo = correoEncargado.value;
        const partes = correo.split("@");
        const nombreCompleto = partes[0].replace(/\b(\w)/g, function (match, primeraLetra) {
            return primeraLetra.toUpperCase();
        }).replace(".", " ");


        if (correoEncargado.value.indexOf("@grammer.com") !== -1) {
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...', showConfirmButton: false, input: 'none',
                text: 'El correo ingresado del encargado es incorrecto no pertenece al dominio de grammer "@grammer.com"'
            })
            correoEncargado = '';
        }


        if (retorno.value == "No") {
            fechaRetorno = "0";
        } else {
            fechaRetorno = fechaRetorno.value;
        }

        if (comentarios.value == "") {
            comentarios.value == "Ninguno";
        }

        const min = 1;
        const max = 1000000;
        const randomNum = Math.floor(Math.random() * (max - min + 1) + min);

        if (email.value != "") {
            if (nomina.value != "") {
                if (solicitante.value != "") {
                    if (descripcion.value != "") {
                        if (cantidad.value != "") {
                            if (um.value != "") {
                                if (empresa.value != "") {
                                    if (direccion.value != "") {
                                        if (tipoBonoAux != "") {
                                            if (retorno.value != "") {
                                                if (causa.value != "") {
                                                    if (comentarios.value != "") {
                                                        if (area.value != "") {
                                                            if (tipo.value != "") {
                                                                if (foto != "data:,") {
                                                                    var idImagen = nomina.value.toString() + solicitante.value.toString().substring(0, 2) + descripcion.value.toString().substring(0, 2) + cantidad.value + um.value + empresa.value.toString().substring(0, 2) + direccion.value.toString().substring(0, 2) + causa.value.toString().substring(0, 2) + comentarios.value.toString().substring(0, 2) + randomNum;

                                                                    document.getElementById('first').style.display = 'none';
                                                                    document.getElementById('carga').style.display = 'block';
                                                                    document.getElementById('carga').innerHTML = '<div class="loading"><center><img src="images/carga.gif" height="350px"><br/>Un momento, por favor...</center></div>';

                                                                    const data = new FormData();

                                                                    data.append('email', email.value.trim());
                                                                    data.append('nomina', nomina.value.trim());
                                                                    data.append('solicitante', solicitante.value);
                                                                    data.append('descripcion', descripcion.value.replace(/["'\\\/]/g, ''));
                                                                    data.append('cantidad', cantidad.value);
                                                                    data.append('um', um.value);
                                                                    data.append('imagenRegistro', idImagen.replace(/["'\\\/]/g, ''));
                                                                    data.append('empresa', empresa.value.replace(/["'\\\/]/g, ''));
                                                                    data.append('direccion', direccion.value.replace(/["'\\\/]/g, ''));
                                                                    data.append('tipo', tipo.value);
                                                                    data.append('retorno', retorno.value);
                                                                    data.append('fechaRetorno', fechaRetorno);
                                                                    data.append('causa', causa.value.replace(/["'\\\/\n]/g, ''));
                                                                    data.append('comentarios', comentarios.value.replace(/["'\\\/\n]/g, ''));
                                                                    data.append('bandera', 1);
                                                                    data.append('tipoBono', tipoBonoAux);
                                                                    data.append('area', area.value);
                                                                    data.append('imagen', foto);
                                                                    data.append('correoEncargado', nombreCompleto);

                                                                    //console.log("DaoRegistro.php/?email="+email.value+"&nomina="+nomina.value+"&solicitante="+solicitante.value+"&descripcion="+descripcion.value+"&cantidad="+cantidad.value+"&um="+um.value+"&imagenRegistro="+idImagen+"&empresa="+empresa.value+"&direccion="+direccion.value+"&tipo="+tipo.value+"&retorno="+retorno.value+"&fechaRetorno="+fechaRetorno.value+"&causa="+causa.value+"&comentarios="+comentarios.value+"&bandera=1"+"&tipoBono="+tipoBono.value+"&area="+area.value+"&correoEncargado="+correoEncargado.value);


                                                                    fetch('dao/DaoRegistro.php', {
                                                                        method: 'POST',
                                                                        body: data
                                                                    })
                                                                        .then(function (response) {
                                                                            if (response.ok) {
                                                                                enviarCorreo(email.value, nomina.value, solicitante.value, descripcion.value, cantidad.value, um.value, empresa.value, tipo.value, retorno.value, fechaRetorno.value, causa.value, comentarios.value, idImagen, direccion.value, correoEncargado.value, area.value, tipoBonoAux);
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
                                                                } else {
                                                                    Swal.fire({
                                                                        icon: 'error',
                                                                        title: 'Oops...',
                                                                        showConfirmButton: false,
                                                                        input: 'none',
                                                                        text: 'Falta ingresar fotografía'
                                                                    })
                                                                }
                                                            } else {
                                                                Swal.fire({
                                                                    icon: 'error',
                                                                    title: 'Oops...',
                                                                    showConfirmButton: false,
                                                                    input: 'none',
                                                                    text: 'Seleccione el tipo de bono'
                                                                })
                                                            }
                                                        } else {
                                                            Swal.fire({
                                                                icon: 'error',
                                                                title: 'Oops...',
                                                                showConfirmButton: false,
                                                                input: 'none',
                                                                text: 'Seleccione el área'
                                                            })
                                                        }
                                                    } else {
                                                        Swal.fire({
                                                            icon: 'error',
                                                            title: 'Oops...', showConfirmButton: false, input: 'none',
                                                            text: 'Ingrese los comentarios'
                                                        })
                                                    }
                                                } else {
                                                    Swal.fire({
                                                        icon: 'error',
                                                        title: 'Oops...', showConfirmButton: false, input: 'none',
                                                        text: 'Ingrese la causa'
                                                    })
                                                }
                                            } else {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Oops...', showConfirmButton: false, input: 'none',
                                                    text: 'Ingrese el tipo de retorno'
                                                })
                                            }
                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Oops...', showConfirmButton: false, input: 'none',
                                                text: 'Ingrese el tipo'
                                            })
                                        }
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Oops...', showConfirmButton: false, input: 'none',
                                            text: 'Ingrese la dirección'
                                        })
                                    }
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...', showConfirmButton: false, input: 'none',
                                        text: 'Ingrese la empresa'
                                    })
                                }
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...', showConfirmButton: false, input: 'none',
                                    text: 'Ingrese la unidad de medida'
                                })
                            }
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...', showConfirmButton: false, input: 'none',
                                text: 'Ingrese la cantidad'
                            })
                        }
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...', showConfirmButton: false, input: 'none',
                            text: 'Ingrese la descripción'
                        })
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...', showConfirmButton: false, input: 'none',
                        text: 'Ingrese el solicitante'
                    })
                }
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...', showConfirmButton: false, input: 'none',
                    text: 'Ingrese la nómina'
                })
            }
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...', showConfirmButton: false, input: 'none',
                text: 'Falta ingresar el nombre de la persona de emergencia'
            })
        }
*/
    }

}

function enviarVigilante(img, estatus) {

    var dataURL = canvas.toDataURL();
    var transportista = document.getElementById('txtTransportista');
    var placas = document.getElementById('txtPlacas');
    var portador = document.getElementById('txtPortador');
    var nombreVigilante = document.getElementById('txtNombreVigilante');
    var firma = document.getElementById('firma');
    var retroalimentacion = document.getElementById('txtRetroAux');
    var correoTransportista = document.getElementById('txtCorreoTransportista');

    if (estatus == 1) {
        if (transportista.value != "") {
            if (placas.value != "") {
                if (portador.value != "") {
                    if (img != "data:,") {
                        if (dataURL != "data:image/png;base64,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") {
                            document.getElementById('bonoSalida').style.display = 'none';
                            document.getElementById('carga').style.display = 'block';
                            document.getElementById('carga').innerHTML = '<div class="loading"><center><img src="images/carga.gif" height="350px"><br/>Un momento, por favor...</center></div>';

                            const data = new FormData();

                            data.append('transportista', transportista.value);
                            data.append('placas', placas.value);
                            data.append('portador', portador.value);
                            data.append('firma', dataURL);
                            data.append('estatus', estatus);
                            data.append('bitacora', bitacora);
                            data.append('idImagenSalida', idImagen);
                            data.append('imagenSalida', img);
                            data.append('nombreVigilante', nombreVigilante.value);

                            fetch('dao/DaoRegistroVigilante.php', {
                                method: 'POST',
                                body: data
                            })
                                .then(function (response) {
                                    if (response.ok) {
                                        enviarCorreoSalida(estatus, "", nombreVigilante.value, transportista.value, placas.value, portador.value, correoTransportista.value);
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
                        } else {
                            alert("Falta ingresar firma")
                        }
                    } else {
                        alert("Falta ingresar la imagen")
                    }
                } else {
                    alert("Ingrese el portador");
                }
            } else {
                alert("Ingrese las placas");
            }
        } else {
            alert("Ingrese el transportista");
        }
    } else {

        document.getElementById('bonoSalida').style.display = 'none';
        document.getElementById('carga').style.display = 'block';
        document.getElementById('carga').innerHTML = '<div class="loading"><center><img src="images/carga.gif" height="350px"><br/>Un momento, por favor...</center></div>';

        const data = new FormData();

        data.append('estatus', estatus);
        data.append('bitacora', bitacora);
        data.append('nombreVigilante', nombreVigilante.value);
        data.append('retroalimentacion', retroalimentacion.value.replace(/["'\\\/]/g, ''));


        fetch('dao/DaoRegistroVigilante.php', {
            method: 'POST',
            body: data
        })
            .then(function (response) {
                if (response.ok) {
                    enviarCorreoSalida(estatus, retroalimentacion.value, nombreVigilante.value, "", "", "");
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


}

function enviarCorreoSalida(estatus, retroalimentacion, nombreVigilante, lineaTransportista, placas, nombreOperador, correoTransportista) {

    const data = new FormData();

    data.append('email', email);
    data.append('nomina', nomina);
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
    data.append('idBitacora', bitacora);
    data.append('Estatus', estatus);
    data.append('bandera', 7);
    data.append('correoTransportista', correoTransportista);

    data.append('NombreVigilante', nombreVigilante);
    data.append('LineaTransportista', lineaTransportista);
    data.append('placas', placas);
    data.append('nombreTransportista', nombreOperador);

    if (estatus == 2) {
        data.append('retroalimentacion', retroalimentacion.value.replace(/["'\\\/]/g, ''));
    }

    fetch('https://arketipo.mx/MailerBonosSalida.php', {
        method: 'POST',
        body: data
    })
        .then(function (response) {
            if (response.ok) {
                enviarCorreoSalidaEncargados(estatus, retroalimentacion, nombreVigilante, lineaTransportista, placas, nombreOperador)
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

function enviarCorreoSalidaEncargados(estatus, retroalimentacion, nombreVigilante, lineaTransportista, placas, nombreOperador) {

    const data = new FormData();

    data.append('email', email);
    data.append('nomina', nomina);
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
    data.append('idBitacora', bitacora);
    data.append('Estatus', estatus);
    data.append('bandera', 8);
    data.append('NombreVigilante', nombreVigilante);

    data.append('LineaTransportista', lineaTransportista);
    data.append('placas', placas);
    data.append('nombreTransportista', nombreOperador);

    if (estatus == 2) {
        data.append('retroalimentacion', retroalimentacion.value.replace(/["'\\\/]/g, ''));
    }

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

function enviarEntrega(img) {

    var nombreVigilante = document.getElementById('txtNombreVigilante');
    var causa = document.getElementById('txtCausaAux');

    if (img != "data:,") {

    } else {
        Swal.fire({
            icon: 'info',
            title: 'Se enviara la actualización sin la imagen', showConfirmButton: false, input: 'none',
            text: 'No es importante ingresarla si solamente se va porporner la fecha'
        });
        var EstatusImagen = '2';
    }

    if (nombreVigilante.value != "") {

        document.getElementById('first').style.display = 'none';
        document.getElementById('carga').style.display = 'block';
        document.getElementById('carga').innerHTML = '<div class="loading"><center><img src="images/carga.gif" height="350px"><br/>Un momento, por favor...</center></div>';

        document.getElementById('botonSalir').style.display = 'none';
        document.getElementById('botonConfirmar').style.display = 'none';

        const data = new FormData();

        data.append('idImagenEntrada', imagenRegistro.replace(/["'\\\/]/g, ''));
        data.append('imagenEntrada', img);
        data.append('nombreVigilante', nombreVigilante.value);
        data.append('idBitacora', idBitacora);
        data.append('bandera', banderaAuxRechazo);
        data.append('causa', causa.value);
        data.append('estatusImagen', EstatusImagen);

        if (banderaAuxRechazo == 2) {
            data.append('fechaRetorno', document.getElementById("fechaRetronoRechazo").value);
        }


        fetch('dao/DaoRegistroEntrega.php', {
            method: 'POST',
            body: data
        })
            .then(function (response) {
                if (response.ok) {
                    enviarCorreoEntrega(causa.value);
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
    } else {
        alert("Falta ingresar su nombre");
    }
}

function enviarCorreoEntrega(causa) {

    const data = new FormData();

    data.append('email', email);
    data.append('nomina', nominaSolicitante);
    data.append('solicitante', nombreSolicitante);
    data.append('descripcion', descripcion);
    data.append('cantidad', cantidad);
    data.append('um', unidadMedida);
    data.append('empresa', empresa);
    data.append('tipo', tipoSalida);
    data.append('retorno', tipoRetorno);
    data.append('causa', causa);
    data.append('comentario', comentario);
    data.append('idImagen', imagenRegistro);
    data.append('direccion', direccion);
    data.append('idBitacora', idBitacora);

    if (banderaAuxRechazo == 1) {
        data.append('bandera', 6);
        data.append('fechaRetorno', fechaRetorno);
    } else {
        data.append('bandera', 10);
        data.append('fechaRetorno', document.getElementById("fechaRetronoRechazo").value);
    }

    fetch('https://arketipo.mx/MailerBonosSalida.php', {
        method: 'POST',
        body: data
    })
        .then(function (response) {
            if (response.ok) {
                document.getElementById('carga').style.display = 'none';
                document.getElementById('registroConcluido').style.display = 'block';
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


function enviarCorreo(email, nomina, solicitante, descripcion, cantidad, um, empresa, tipo, retorno, fechaRetorno, causa, comentario, idImagen, direccion, correo, area, tipoBono) {

    const data = new FormData();

    data.append('email', email.trim());
    data.append('nomina', nomina.trim());
    data.append('solicitante', solicitante);
    data.append('descripcion', descripcion.replace(/["'\\\/]/g, ''));
    data.append('cantidad', cantidad);
    data.append('um', um);
    data.append('empresa', empresa.replace(/["'\\\/]/g, ''));
    data.append('tipo', tipo);
    data.append('retorno', retorno);
    data.append('fechaRetorno', fechaRetorno);
    data.append('causa', causa.replace(/["'\\\/]/g, ''));
    data.append('comentario', comentario.replace(/["'\\\/]/g, ''));
    data.append('idImagen', idImagen.replace(/["'\\\/]/g, ''));
    data.append('direccion', direccion.replace(/["'\\\/]/g, ''));
    data.append('bandera', 1);
    data.append('correoEncargado', correo);
    data.append('tipoBono', tipoBono);

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
            }

        })
        .then(function (texto) {
            console.log(texto);
        })
        .catch(function (err) {
            console.log(err);
        });

}