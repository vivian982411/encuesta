function administrador() {
    window.location = "login_admin.php";
}

function verificaAdmin() {
    var f = document.querySelector("#form-login-admin");
    $.ajax({
            url: 'php/proceso.php',
            type: 'POST',
            dataType: 'html',
            data: {
                opc: 'admin',
                acc: 'login',
                usuario: f.usuario.value,
                password: f.password.value
            },
        })
        .done(function(info) {
            console.log(info);
            if (info == "ok") {
                window.location = "principal_admin.php";
            } else {
                Swal.fire({
                    title: 'Error al iniciar sesion',
                    text: 'El usuario no existe o la contraseña es erronea',
                    icon: 'error',
                });
            }
        })
        .fail(function() {
            Swal.fire({
                title: 'Error al conectar con el servidor',
                text: 'Revise su conexion o intente mas tarde',
                icon: 'error',
            });
        })
        .always(function() {
            console.log("complete");
        });

}

function cerrarAdmi() {
    var datos = new FormData();
    $.ajax({
            url: 'php/proceso.php',
            type: 'POST',
            dataType: 'html',
            data: {
                opc: 'admin',
                acc: 'logout',
            },
        })
        .done(function() {
            window.location = "login_admin.php";
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });

}

function verificaLog() {
    var f = document.querySelector("#form-login");
    $.ajax({
            url: 'php/proceso.php',
            type: 'POST',
            dataType: 'html',
            data: {
                opc: 'alumno',
                acc: 'login',
                nocontrol: f.nocontrol.value
            },
        })
        .done(function(info) {
            console.log(info);
            if (info == "ok") {
                Swal.fire({
                    title: 'Bienvenido',
                    text: 'Ingreso correctamente',
                    icon: 'success',
                });
                window.location = "principal.php";
            } else if (info == "verificado") {
                Swal.fire({
                    title: 'Gracias',
                    text: 'Tu ya has contestado la encuesta',
                    icon: 'success',
                });
            } else if (info == "error") {
                Swal.fire({
                    title: 'Error al iniciar sesion',
                    text: 'El numero de control no existe',
                    icon: 'error',
                });
            }
        })
        .fail(function() {
            Swal.fire({
                title: 'Error al conectar con el servidor',
                text: 'Revise su conexion o intenet mas tarde',
                icon: 'error',
            });
        })
        .always(function() {
            console.log("complete");
        });

}

function cerrar() {
    var datos = new FormData();
    $.ajax({
            url: 'php/proceso.php',
            type: 'POST',
            dataType: 'html',
            data: {
                opc: 'alumno',
                acc: 'logout',
            },
        })
        .done(function() {
            window.location = "index.php";
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });

}

function mostrarVista(vista, subvista, id) {
    var datos = new FormData();
    var sol = new XMLHttpRequest();
    datos.append('opc', vista);
    datos.append('acc', subvista);
    if (id !== undefined) {
        datos.append('id', id);
    }
    sol.addEventListener("load", function(e) {
        document.getElementById("contenido").innerHTML = e.target.responseText;
    }, true);
    sol.open("POST", "php/vistas.php", false);
    sol.send(datos);
}

function mostrarVistaAlumnos(vista, subvista) {
    $.ajax({
            url: 'php/vistas.php',
            type: 'POST',
            dataType: 'html',
            data: {
                opc: vista,
                acc: subvista
            },
        })
        .done(function(info) {
            var datos = info.split("|||");
            document.getElementById("contenido").innerHTML = "";
            document.getElementById("contenido").innerHTML = datos[0];
            google.charts.load("current", { packages: ["corechart"] });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ["Encuetas", "Alumnos"],
                    ["Porcentaje Contestado", parseInt(datos[1])],
                    ["Porcentaje No Contestado", parseInt(datos[2])],
                ]);

                var options = {
                    pieHole: 0.4,
                };

                var chart = new google.visualization.PieChart(document.getElementById("grafico"));
                chart.draw(data, options);
            }
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });

}

function mostrarVistaDepartamento(id, nombredep, dep) {
    var titulo = dep;
    $.ajax({
            url: 'php/proceso.php',
            type: 'POST',
            dataType: 'html',
            data: {
                opc: 'departamentos',
                acc: nombredep,
                id: id
            },
        })
        .done(function(info) {

            document.getElementById("contenedor-departamento").innerHTML = "";
            var respuestas = info.split("---");
            var filas = respuestas[0].split(";");
            var tit = document.createElement("label");
            tit.setAttribute("class", "h1 text-dark");
            tit.innerHTML = titulo;
            var btn1 = document.createElement("input");
            btn1.setAttribute("type", "button")
            btn1.setAttribute("class", "btn btn-success");
            btn1.setAttribute("value", "Nueva Pregunta");
            btn1.setAttribute("onclick", "javascript:nuevaPregunta('" + id + "','" + nombredep + "','" + titulo + "');");
            var tabla = document.createElement("table");
            tabla.setAttribute("class", "table table-striped my-2");
            var encabezado = document.createElement("tr");
            encabezado.setAttribute("class", "bg-dark text-white h6")
            var colp = document.createElement("td");
            colp.innerHTML = "Pregunta";
            var cola = document.createElement("td");
            cola.innerHTML = "Acciones";
            var colt = document.createElement("td");
            colt.innerHTML = "Terrible";
            var colm = document.createElement("td");
            colm.innerHTML = "Mala";
            var colr = document.createElement("td");
            colr.innerHTML = "Regular";
            var colb = document.createElement("td");
            colb.innerHTML = "Buena";
            var cole = document.createElement("td");
            cole.innerHTML = "Excelente";
            encabezado.appendChild(colp);
            encabezado.appendChild(cola);
            encabezado.appendChild(colt);
            encabezado.appendChild(colm);
            encabezado.appendChild(colr);
            encabezado.appendChild(colb);
            encabezado.appendChild(cole);
            tabla.appendChild(encabezado);
            var tbody = document.createElement("tbody");

            for (var i = 0; i < filas.length - 1; i++) {
                var datos = filas[i].split("|");
                var fila = document.createElement("tr");
                var col1 = document.createElement("td");
                var texto = document.createElement("input");
                texto.setAttribute("type", "text");
                texto.setAttribute("class", "form-control");
                texto.setAttribute("id", "p" + datos[0]);
                texto.setAttribute("disabled", "true");
                texto.setAttribute("value", datos[1]);
                texto.setAttribute("onkeypress", "javascript:guardarPregunta(event,'" + datos[0] + "','" + id + "');");
                col1.appendChild(texto);
                var col2 = document.createElement("td");
                var btnmodificar = document.createElement("input");
                btnmodificar.setAttribute("type", "button");
                btnmodificar.setAttribute("class", "btn btn-warning");
                btnmodificar.setAttribute("value", "Modificar");
                btnmodificar.setAttribute("id", "btnm" + datos[0]);
                btnmodificar.setAttribute("onclick", "javascript:modificarPregunta('" + datos[0] + "');");
                col2.appendChild(btnmodificar);
                var col3 = document.createElement("td");
                col3.setAttribute("class", "text-center");
                var ct = document.createElement("label");
                ct.setAttribute("class", "h4");
                ct.innerHTML = datos[2];
                col3.appendChild(ct);
                var col4 = document.createElement("td");
                col4.setAttribute("class", "text-center");
                var cm = document.createElement("label");
                cm.setAttribute("class", "h4");
                cm.innerHTML = datos[3];
                col4.appendChild(cm);
                var col5 = document.createElement("td");
                col5.setAttribute("class", "text-center");
                var cr = document.createElement("label");
                cr.setAttribute("class", "h4");
                cr.innerHTML = datos[4];
                col5.appendChild(cr);
                var col6 = document.createElement("td");
                col6.setAttribute("class", "text-center");
                var cb = document.createElement("label");
                cb.setAttribute("class", "h4");
                cb.innerHTML = datos[5];
                col6.appendChild(cb);
                var col7 = document.createElement("td");
                col7.setAttribute("class", "text-center");
                var ce = document.createElement("label");
                ce.setAttribute("class", "h4");
                ce.innerHTML = datos[6];
                col7.appendChild(ce);
                fila.appendChild(col1);
                fila.appendChild(col2);
                fila.appendChild(col3);
                fila.appendChild(col4);
                fila.appendChild(col5);
                fila.appendChild(col6);
                fila.appendChild(col7);
                tbody.appendChild(fila);
            }
            tabla.appendChild(tbody);
            var br = document.createElement("br");
            var br1 = document.createElement("br");
            document.getElementById("contenedor-departamento").appendChild(tit);
            document.getElementById("contenedor-departamento").appendChild(br);
            document.getElementById("contenedor-departamento").appendChild(btn1);
            document.getElementById("contenedor-departamento").appendChild(tabla);
            var div = document.createElement("div");
            div.setAttribute("class", "text-primary");
            var btn2 = document.createElement("input");
            btn2.setAttribute("type", "button");
            btn2.setAttribute("onclick", "generarPDF(" + id + ")");
            btn2.setAttribute("class", "btn btn-info");
            btn2.setAttribute("style", "float:rigth");
            btn2.setAttribute("value", "Exportar a pdf");
            var h1comentarios = document.createElement("h1");
            h1comentarios.innerHTML = "Comentarios";

            div.appendChild(h1comentarios);
            div.appendChild(br);
            div.appendChild(br);
            div.appendChild(btn2);


            var tabla2 = document.createElement("table");
            tabla2.setAttribute("class", "table table-striped my-2");
            var encabezado2 = document.createElement("tr");
            encabezado2.setAttribute("class", "bg-dark text-white h6")
            var col1 = document.createElement("td");
            col1.innerHTML = "Id";
            var col2 = document.createElement("td");
            col2.innerHTML = "Comentario";
            encabezado2.appendChild(col1);
            encabezado2.appendChild(col2);
            tabla2.appendChild(encabezado2);
            var tbody2 = document.createElement("tbody");

            var comentario = respuestas[1].split(";");
            for (var i = 0; i < comentario.length - 1; i++) {
                var datos = comentario[i].split("|");
                var fila2 = document.createElement("tr");
                var col21 = document.createElement("td");
                col21.innerHTML = datos[0];
                var col22 = document.createElement("td");
                col22.innerHTML = datos[3];
                fila2.appendChild(col21);
                fila2.appendChild(col22);
                tbody2.appendChild(fila2);
            }
            tabla2.appendChild(tbody2);
            div.appendChild(tabla2);
            document.getElementById("contenedor-departamento").appendChild(div);

        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
}

function nuevoDepartamento() {
    var nombre = document.getElementById("nombre_departamento").value;
    var preguntas = "";
    for (var i = 1; i <= 9; i++) {
        if (document.getElementById("pregunta" + i).value == "" || document.getElementById("pregunta" + i).value == null || document.getElementById("pregunta" + i).value == undefined) {
            preguntas = preguntas;
        } else {
            preguntas += "" + document.getElementById("pregunta" + i).value + "|";
        }
    }
    $.ajax({
            url: 'php/proceso.php',
            type: 'POST',
            dataType: 'html',
            data: {
                opc: 'departamentos',
                acc: 'nuevoDepartamento',
                nombredep: nombre,
                preguntas: preguntas
            },
        })
        .done(function(info) {
            if (info == "ok") {
                Swal.fire({
                    title: '',
                    text: 'El departamento se creó correctamente',
                    icon: 'success',
                });
                mostrarVista('admin', 'departamentos');
            }
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });

}

function nuevaPregunta(id, nombredep, dep) {
    $.ajax({
            url: 'php/vistas.php',
            type: 'POST',
            dataType: 'html',
            data: {
                opc: 'admin',
                acc: 'nuevaPregunta',
                id: id,
                nombredep: nombredep,
                dep: dep
            },
        })
        .done(function(info) {
            document.getElementById("contenedor-departamento").innerHTML = info;
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });

}

function guardarNuevaPregunta(id, nombredep, dep) {
    var pregunta = document.getElementById("nueva_pregunta").value;
    $.ajax({
            url: 'php/proceso.php',
            type: 'POST',
            dataType: 'html',
            data: {
                opc: 'departamentos',
                acc: 'nuevaPregunta',
                iddep: id,
                pregunta: pregunta
            },
        })
        .done(function(info) {
            if (info == "ok") {
                Swal.fire({
                    title: '',
                    text: 'La pregunta se guardo correctamente',
                    icon: 'success',
                });
                mostrarVistaDepartamento(id, nombredep, dep);
            } else {
                Swal.fire({
                    title: '',
                    text: 'Ocurrio un error, intente de nuevo',
                    icon: 'error',
                });
            }
        })
        .fail(function() {
            Swal.fire({
                title: '',
                text: 'Error al conectar con el servidor',
                icon: 'error',
            });
        })
        .always(function() {
            console.log("complete");
        });

}

function guardarPregunta(e, id, dep) {
    if (e.keyCode === 13 && !e.shiftKey) {
        $.ajax({
                url: 'php/proceso.php',
                type: 'POST',
                dataType: 'html',
                data: {
                    opc: 'departamentos',
                    acc: 'guardarPregunta',
                    id: id,
                    pregunta: document.getElementById("p" + id).value
                },
            })
            .done(function(info) {
                if (info = "ok") {
                    mostrarVistaDepartamento(dep, "mostrardepartamento");
                }
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
    }
}

function generarPDF(id) {
    console.log("GenerarPDF de:" + id);
    window.open("php/tcpdf.php?id=" + id)
}

function modificarPregunta(id) {
    var texto = document.getElementById("p" + id).value;
    var btnm = document.getElementById("btnm" + id);
    btnm.setAttribute("class", "btn btn-success");
    btnm.setAttribute("value", "Cancelar");
    btnm.setAttribute("onclick", "javascript:cancelarPregunta('" + id + "','" + texto + "');");
    document.getElementById("p" + id).disabled = false;
}

function cancelarPregunta(id, texto) {
    var txt = document.getElementById("p" + id);
    txt.value = texto;
    var btnm = document.getElementById("btnm" + id);
    btnm.setAttribute("class", "btn btn-warning");
    btnm.setAttribute("value", "Modificar");
    btnm.setAttribute("onclick", "javascript:modificarPregunta('" + id + "');");
    document.getElementById("p" + id).disabled = true;
}

function validarEncuesta(id, max) {
    id++;
    if (id == (max + 1)) {
        var np = parseInt($("#numpre").val());
        var cad = "";
        for (var i = 1; i <= np; i++) {
            var rs = document.getElementsByName("pregunta" + i);
            var cantidadr = rs.length;
            for (var j = 0; j < cantidadr; j++) {
                if (rs[j].checked == true) {
                    cad += "" + rs[j].value + "|";
                }
            }
        }
        var respuestas = cad.split("|");
        if (np == respuestas.length - 1) {
            guardarEncuesta();
        } else {
            Swal.fire({
                title: 'Error',
                text: 'Complete el cuestionario',
                icon: 'error',
            });
        }
    } else {
        var np = parseInt($("#numpre").val());
        var cad = "";
        for (var i = 1; i <= np; i++) {
            var rs = document.getElementsByName("pregunta" + i);
            var cantidadr = rs.length;
            for (var j = 0; j < cantidadr; j++) {
                if (rs[j].checked == true) {
                    cad += "" + rs[j].value + "|";
                }
            }
        }
        var respuestas = cad.split("|");
        if (np == respuestas.length - 1) {
            crearEncuesta(id);
        } else {
            Swal.fire({
                title: 'Error',
                text: 'Complete el cuestionario',
                icon: 'error',
            });
        }
    }
}

function crearEncuesta(id) {
    var valorInputPreguntas = $("#preguntas").val();
    console.log("Este es el valor de preguntas: " + valorInputPreguntas);
    var dep = "";
    var dep1 = "";
    var iddep = id;
    $.ajax({
            url: 'php/proceso.php',
            type: 'POST',
            dataType: 'html',
            data: {
                opc: 'encuesta',
                acc: 'buscarDepartamento',
                idDep: id
            },
        })
        .done(function(e) {
            console.log(e);
            var info = e.split("---");
            var deptos = info[0].split("|");
            var arrayPreguntas = info[1].split(";");
            console.log("Deptos" + deptos);
            console.log("Preg" + arrayPreguntas);
            var boton = document.createElement("a");
            boton.setAttribute("href", "#body");
            boton.setAttribute("class", "btn btn-primary m-5");
            boton.innerHTML = "Siguiente";
            boton.setAttribute("onclick", "validarEncuesta(" + (id + "," + deptos[2]) + ");");
            var respuestas = document.createElement("input");
            respuestas.setAttribute("type", "hidden");
            respuestas.setAttribute("id", "respuestas");
            var comentarios = document.createElement("input");
            comentarios.setAttribute("type", "hidden");
            comentarios.setAttribute("id", "comentarios");
            if (id == 1) {
                var boton = document.createElement("a");
                boton.setAttribute("href", "#body");
                boton.setAttribute("class", "btn btn-primary m-5");
                boton.innerHTML = "Siguiente";
                boton.setAttribute("onclick", "validarEncuesta(" + (id + "," + deptos[2]) + ");");
                var respuestas = document.createElement("input");
                respuestas.setAttribute("type", "hidden");
                respuestas.setAttribute("id", "respuestas");
                var comentarios = document.createElement("input");
                comentarios.setAttribute("type", "hidden");
                comentarios.setAttribute("id", "comentarios");
                var preguntas = document.createElement("input");
                preguntas.setAttribute("type", "hidden");
                preguntas.setAttribute("id", "preguntas");

            } else if (id != deptos[2]) {
                var boton = document.createElement("a");
                boton.setAttribute("href", "#body");
                boton.setAttribute("class", "btn btn-primary m-5");
                boton.innerHTML = "Siguiente";
                boton.setAttribute("onclick", "validarEncuesta(" + (id + "," + deptos[2]) + ");");
                var respuestas = document.createElement("input");
                respuestas.setAttribute("type", "hidden");
                respuestas.setAttribute("id", "respuestas");
                var np = parseInt($("#numpre").val());
                var cad = "";
                for (var i = 1; i <= np; i++) {
                    var rs = document.getElementsByName("pregunta" + i);
                    var cantidadr = rs.length;
                    for (var j = 0; j < cantidadr; j++) {
                        if (rs[j].checked == true) {
                            cad += "" + rs[j].value + "|";
                        }
                    }
                }
                cad += ";";
                respuestas.setAttribute("value", "" + $("#respuestas").val() + "" + cad);
                var comentarios = document.createElement("input");
                comentarios.setAttribute("type", "hidden");
                comentarios.setAttribute("id", "comentarios");
                comentarios.setAttribute("value", $("#comentarios").val() + "" + $("#comentario").val() + ";");
                var preguntas = document.createElement("input");
                preguntas.setAttribute("type", "hidden");
                preguntas.setAttribute("id", "preguntas");
                preguntas.setAttribute("value", valorInputPreguntas + ";");
            } else {
                var boton = document.createElement("a");
                boton.setAttribute("href", "#body");
                boton.setAttribute("class", "btn btn-success m-5");
                boton.innerHTML = "Finalizar";
                boton.setAttribute("onclick", "validarEncuesta(" + (id + "," + deptos[2]) + ");");
                var respuestas = document.createElement("input");
                respuestas.setAttribute("type", "hidden");
                respuestas.setAttribute("id", "respuestas");
                var np = parseInt($("#numpre").val());
                var cad = "";
                for (var i = 1; i <= np; i++) {
                    var rs = document.getElementsByName("pregunta" + i);
                    var cantidadr = rs.length;
                    for (var j = 0; j < cantidadr; j++) {
                        if (rs[j].checked == true) {
                            cad += "" + rs[j].value + "|";
                        }
                    }
                }
                cad += ";";
                respuestas.setAttribute("value", "" + $("#respuestas").val() + "" + cad);
                var comentarios = document.createElement("input");
                comentarios.setAttribute("type", "hidden");
                comentarios.setAttribute("id", "comentarios");
                comentarios.setAttribute("value", $("#comentarios").val() + "" + $("#comentario").val() + ";");
                var preguntas = document.createElement("input");
                preguntas.setAttribute("type", "hidden");
                preguntas.setAttribute("id", "preguntas");
                preguntas.setAttribute("value", valorInputPreguntas + ";");
            }
            document.getElementById("contenido").innerHTML = "";

            var p = arrayPreguntas;
            cad = "";
            for (var i = 0; i < p.length - 1; i++) {
                console.log(p[i]);
                cad += "" + p[i].split("|")[0] + "|";
            }
            cad += ";";
            preguntas.setAttribute("value", "" + valorInputPreguntas + "" + cad);
            var numpre = document.createElement("input");
            numpre.setAttribute("type", "hidden");
            numpre.setAttribute("id", "numpre");
            numpre.setAttribute("value", p.length - 1);
            var fila = document.createElement("div");
            fila.setAttribute("class", "row animated bounceInRight");
            var col1 = document.createElement("div");
            col1.setAttribute("class", "col-md-2");
            var col2 = document.createElement("div");
            col2.setAttribute("class", "col-md-10");
            var num = document.createElement("div");
            num.setAttribute("class", "card bg-success mt-5");
            var title1 = document.createElement("label");
            title1.setAttribute("class", "display-4 text-white mx-3");
            title1.innerHTML = iddep + "/" + deptos[2];
            var titulo = document.createElement("div");
            titulo.setAttribute("class", "card bg-success mt-5");
            var title = document.createElement("label");
            title.setAttribute("class", "display-4 text-white mx-3");
            title.innerHTML = deptos[1].toUpperCase();
            titulo.appendChild(title);
            num.appendChild(title1);
            col2.appendChild(titulo);
            col1.appendChild(num);
            fila.appendChild(col1);
            fila.appendChild(col2);
            var form = document.createElement("form");
            form.setAttribute("id", "form-encuesta");
            form.setAttribute("class", "animated bounceInLeft");
            for (var i = 0; i < p.length - 1; i++) {
                var card = document.createElement("div");
                card.setAttribute("class", "card m-5");
                card.setAttribute("style", "background:#F7F6F6");
                var pregunta = document.createElement("label");
                pregunta.setAttribute("class", "h3 text-dark p-3");
                var cad = p[i].split("|");
                pregunta.innerHTML = cad[1];
                var row = document.createElement("div");
                row.setAttribute("class", "row");
                var div1 = document.createElement("div");
                div1.setAttribute("class", "col-md-8");
                var radios = document.createElement("div");
                radios.setAttribute("class", "col-md-4")
                radios.setAttribute("id", "radios");
                var r1 = document.createElement("input");
                r1.setAttribute("type", "radio");
                r1.setAttribute("id", "pregunta" + (i + 1) + "radio1");
                r1.setAttribute("name", "pregunta" + (i + 1));
                r1.setAttribute("value", "5");
                r1.setAttribute("style", "display:none");
                r1.required = true;
                var t1 = document.createElement("label");
                t1.setAttribute("class", "display-4");
                t1.setAttribute("id", "star");
                t1.setAttribute("for", "pregunta" + (i + 1) + "radio1");
                t1.setAttribute("aling", "rigth");
                t1.innerHTML = "★";
                var r2 = document.createElement("input");
                r2.setAttribute("type", "radio");
                r2.setAttribute("id", "pregunta" + (i + 1) + "radio2");
                r2.setAttribute("name", "pregunta" + (i + 1));
                r2.setAttribute("value", "4");
                r2.setAttribute("style", "display:none");
                var t2 = document.createElement("label");
                t2.setAttribute("class", "display-4");
                t2.setAttribute("id", "star");
                t2.setAttribute("for", "pregunta" + (i + 1) + "radio2");
                t2.innerHTML = "★";
                var r3 = document.createElement("input");
                r3.setAttribute("type", "radio");
                r3.setAttribute("id", "pregunta" + (i + 1) + "radio3");
                r3.setAttribute("name", "pregunta" + (i + 1));
                r3.setAttribute("value", "3");
                r3.setAttribute("style", "display:none");
                var t3 = document.createElement("label");
                t3.setAttribute("class", "display-4");
                t3.setAttribute("id", "star");
                t3.setAttribute("for", "pregunta" + (i + 1) + "radio3");
                t3.innerHTML = "★";
                var r4 = document.createElement("input");
                r4.setAttribute("type", "radio");
                r4.setAttribute("id", "pregunta" + (i + 1) + "radio4");
                r4.setAttribute("name", "pregunta" + (i + 1));
                r4.setAttribute("value", "2");
                r4.setAttribute("style", "display:none");
                var t4 = document.createElement("label");
                t4.setAttribute("class", "display-4");
                t4.setAttribute("id", "star");
                t4.setAttribute("for", "pregunta" + (i + 1) + "radio4");
                t4.innerHTML = "★";
                var r5 = document.createElement("input");
                r5.setAttribute("type", "radio");
                r5.setAttribute("id", "pregunta" + (i + 1) + "radio5");
                r5.setAttribute("name", "pregunta" + (i + 1));
                r5.setAttribute("value", "1");
                r5.setAttribute("style", "display:none");
                var t5 = document.createElement("label");
                t5.setAttribute("class", "display-4");
                t5.setAttribute("id", "star");
                t5.setAttribute("for", "pregunta" + (i + 1) + "radio5");
                t5.innerHTML = "★";
                radios.appendChild(r1);
                radios.appendChild(t1);
                radios.appendChild(r2);
                radios.appendChild(t2);
                radios.appendChild(r3);
                radios.appendChild(t3);
                radios.appendChild(r4);
                radios.appendChild(t4);
                radios.appendChild(r5);
                radios.appendChild(t5);
                row.appendChild(div1);
                row.appendChild(radios);
                card.appendChild(pregunta);
                card.appendChild(row);
                form.appendChild(card);
            }
            var comentario = document.createElement("div");
            comentario.setAttribute("class", "card m-5 p-2");
            var com = document.createElement("label");
            com.setAttribute("class", "display-4 text-dark m-2");
            com.innerHTML = "Comentario"
            var texto = document.createElement("input");
            texto.setAttribute("type", "textarea");
            texto.setAttribute("id", "comentario");
            texto.setAttribute("class", "form-control");
            comentario.appendChild(com);
            comentario.appendChild(texto);
            form.appendChild(comentario);
            form.appendChild(respuestas);
            form.appendChild(comentarios);
            form.appendChild(preguntas);
            form.appendChild(numpre);
            form.appendChild(boton);
            document.getElementById("contenido").appendChild(fila);
            document.getElementById("contenido").appendChild(form);
            document.getElementById("body").setAttribute("style", "");

        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });

}

function guardarEncuesta() {
    var np = parseInt($("#numpre").val());
    var cad = "";
    for (var i = 1; i <= np; i++) {
        var rs = document.getElementsByName("pregunta" + i);
        var cantidadr = rs.length;
        for (var j = 0; j < cantidadr; j++) {
            if (rs[j].checked == true) {
                cad += "" + rs[j].value + "|";
            }
        }
    }
    cad += ";";
    var respuestas = $("#respuestas").val() + "" + cad;
    var comentarios = $("#comentarios").val() + "" + $("#comentario").val() + ";"
    var preguntas = $("#preguntas").val() + "" + cad;
    $.ajax({
            url: 'php/proceso.php',
            type: 'POST',
            dataType: 'HTML',
            data: {
                opc: 'encuesta',
                acc: 'guardar',
                preguntas: preguntas,
                respuestas: respuestas,
                comentarios: comentarios

            },
        })
        .done(function(info) {
            if (info == "error") {
                Swal.fire({
                    title: 'Ocurrio un error al guardarla encuesta',
                    text: 'Cierre su sesion, compruebe su conexion y vuelva a intentar, si vuelve a obtener el mismo error varias veces contacte al administrador',
                    icon: 'error',
                });
            } else {
                //console.log(info);
                document.getElementById("body").setAttribute("style", "background-image: url('img/petirrojos.png');background-size:400px;background-position:center;background-repeat: no-repeat;");
                document.getElementById("contenido").innerHTML = "";
                document.getElementById("contenido").innerHTML = info;
            }
        })
        .fail(function(info) {

        })
        .always(function() {
            console.log("complete");
        });

}

function showDepartamentos() {
    $.ajax({
            url: 'php/proceso.php',
            type: 'POST',
            dataType: 'html',
            data: {
                opc: 'departamentos',
                acc: 'showdepartamentosreporte'
            },
        })
        .done(function(info) {
            document.getElementById("containerDepartamentos").innerHTML = "";
            var departamentos = info.split(";");
            for (var i = 0; i < departamentos.length - 1; i++) {
                var departamento = departamentos[i].split("|");
                var div1 = document.createElement("div");
                div1.setAttribute("class", "btn btn-info m-1 animated bounceInDown");
                div1.setAttribute("style", "width:125px; height:60px;");
                div1.setAttribute("onclick", "generarXLS('" + departamento[0] + "','" + departamento[1] + "');")
                div1.innerHTML = "" + departamento[1];
                document.getElementById("containerDepartamentos").appendChild(div1);
            }
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
}

function generarXLS(id, nombredep) {
    var nombre = nombredep;
    $.ajax({
            url: 'php/proceso.php',
            type: 'POST',
            dataType: 'html',
            data: {
                opc: 'departamentos',
                acc: 'generarXLS',
                dep: id,
                nombredep: nombre
            },
        })
        .done(function(e) {
            console.log(e);
            Swal.fire({
                title: 'Generado',
                text: 'El Reporte se generó correctamente',
                icon: 'success',
            });
            window.location = "php/download.php?id=" + nombre;

        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
}
function reiniciarSistema(){
    Swal.fire({
                title: 'Advertencia',
                text: 'No utilice esta opción a menos que ya se halla concluido con la encuesta y respaldado sus datos',
                icon: 'warning',
            });
}