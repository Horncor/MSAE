let jsonResults = [];

$(document).ready(function () {
    prevImputFunc();
});

function bisectionMethod(func, xa, xb, tolerance, maxIterations) {
    let ecuacion = $("#func").val();

    let iteration = 1; // Contador de iteraciones
    let xr = 0; // Punto medio del intervalo actual
    let ea = 100; // Error relativo porcentual aproximado

    while (ea > tolerance && iteration <= maxIterations) {
        xr = (xa + xb) / 2; // Calcular el punto medio del intervalo actual
        const fxa = func(xa); // Evaluar la función en Xa
        const fxr = func(xr); // Evaluar la función en Xr
        const fxa_fxr = fxa * fxr; // Producto de los valores de la función en Xa y Xr
        ea = Math.abs((xr - xa) / xr) * 100; // Calcular el error relativo porcentual aproximado
        const et = Math.abs(1 - xr) * 100; // Calcular Et asumiendo que la raíz es 1.5

        // Mostrar los valores de la iteración actual en la tabla
        jsonResults.push({
            iteration: iteration,
            xa: xa.toFixed(6),
            xb: xb.toFixed(6),
            xr: xr.toFixed(6),
            fxa: fxa.toFixed(6),
            fxr: fxr.toFixed(6),
            fxa_fxr: fxa_fxr.toFixed(6),
            ea: ea.toFixed(6) + "%",
            et: et.toFixed(6) + "%",
        });

        if (fxa_fxr < 0) {
            xb = xr; // Actualizar el límite superior del intervalo
        } else {
            xa = xr; // Actualizar el límite inferior del intervalo
        }

        iteration++; // Incrementar el contador de iteraciones
    }
    renderTable();
}

// Definición de la función que deseas encontrar su raíz
function func(x) {
    let ecuacion = $("#func").val();

    let formularAux = ecuacion
        .replaceAll("X", x)
        .replaceAll("^", "**")
        .replaceAll(",", ".");

    console.log(formularAux);

    return eval(formularAux);
}

// Ejecutar el método de bisección con los valores proporcionados

const validateFunc = () => {
    // Obtener los valores de los campos de entrada
    let ecuacion = $("#func").val();
    let intervaloA = parseFloat($("#valorA").val());
    let intervaloB = parseFloat($("#valorB").val());
    let tolerancia = parseFloat($("#tolerancia").val());

    let exitsError = false;

    if (ecuacion == "") {
        $("#valor1Help")
            .text("Debes completar este campo")
            .removeClass()
            .addClass("form-text text-danger");
        $("#func").removeClass().addClass("form-control is-invalid");
        exitsError = true;
    } else {
        $("#valor1Help")
            .text("Campo valido")
            .removeClass()
            .addClass("form-text text-success");
        $("#func").removeClass().addClass("form-control is-valid");
        exitsError = false;
    }

    if (isNaN(intervaloA)) {
        $("#valor2Help")
            .text("Debes completar este campo")
            .removeClass()
            .addClass("form-text text-danger");
        $("#valorA").removeClass().addClass("form-control is-invalid");
        exitsError = true;
    } else {
        $("#valor2Help")
            .text("Campo valido")
            .removeClass()
            .addClass("form-text text-success");
        $("#valorA").removeClass().addClass("form-control is-valid");
        exitsError = false;
    }

    if (isNaN(intervaloB)) {
        $("#valor3Help")
            .text("Debes completar este campo")
            .removeClass()
            .addClass("form-text text-danger");
        $("#valorB").removeClass().addClass("form-control is-invalid");
        exitsError = true;
    } else {
        $("#valor3Help")
            .text("Campo valido")
            .removeClass()
            .addClass("form-text text-success");
        $("#valorB").removeClass().addClass("form-control is-valid");
        exitsError = false;
    }

    if (isNaN(tolerancia)) {
        $("#valor4Help")
            .text("Debes completar este campo")
            .removeClass()
            .addClass("form-text text-danger");
        $("#tolerancia").removeClass().addClass("form-control is-invalid");
        exitsError = true;
    } else {
        $("#valor4Help")
            .text("Campo valido")
            .removeClass()
            .addClass("form-text text-success");
        $("#tolerancia").removeClass().addClass("form-control is-valid");
        exitsError = false;
    }

    if (exitsError === true) {
        return; // si existen error no pase a la validacion hasta que complete los campos
    }

    try {
        ecuacion = ecuacion
            .replaceAll("X", 0)
            .replaceAll("^", "**")
            .replaceAll(",", ".");
        // Intentar evaluar la función
        eval("var resultado = " + ecuacion);

        // Verificar si el resultado es un número
        if (typeof resultado !== "number") {
            alert("Funcion invalida");
            return false;
        }
        bisectionMethod(func, intervaloA, intervaloB, tolerancia, 100);
    } catch (error) {
        console.log(error);
        alert("Funcion invalida");
        // Capturar errores de sintaxis u otros errores durante la evaluación
        return false;
    }
};

const prevImputFunc = () => {
    // Obtener el elemento de entrada
    var funcInput = document.getElementById("func");

    // Agregar el evento "input" al campo de entrada
    funcInput.addEventListener("input", function (event) {
        // Obtener el valor actual del campo de entrada
        var valor = event.target.value;

        // Aplicar la expresión regular para validar el valor actual
        let patron = /^[X0-9+\-*/^().\s]+$/;

        if (!patron.test(valor)) {
            // Si el valor no cumple con el patrón, eliminar el último carácter ingresado
            $("#valor1Help")
                .text("Caracter no permitido")
                .removeClass()
                .addClass("form-text text-danger");
            $("#func").removeClass().addClass("form-control is-invalid");
            event.target.value = valor.slice(0, -1);
        } else {
            $("#func").removeClass().addClass("form-control is-valid");
            $("#valor1Help")
                .text("Funcion valida")
                .removeClass()
                .addClass("form-text text-success");
        }
    });
};

//    openModal('Probando','Si funciona')
const openModal = (title, content) => {
    $("#myModal").modal("show");
    $("#TitleModal").text(title);
    $("#ModalContent").text(content);
};

const renderTable = () => {
    htmlBody = ``;
    jsonResults.forEach((obj) => {
        htmlBody += `<tr>
                        <td>`+obj.iteration+`</td>
                        <td>`+obj.xa+`</td>
                        <td>`+obj.xb+`</td>
                        <td>`+obj.xr+`</td>
                        <td>`+obj.fxa+`</td>
                        <td>`+obj.fxr+`</td>
                        <td>`+obj.fxa_fxr+`</td>
                        <td>`+obj.ea+`</td>
                        <td>`+obj.et+`</td>
                    </tr>`;
    });

    htmlTable = `<table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Iteracion</th>
                        <th scope="col">Xa</th>
                        <th scope="col">Xb</th>
                        <th scope="col">Xr</th>
                        <th scope="col">F(Xa)</th>
                        <th scope="col">F(Xr)</th>
                        <th scope="col">F(Xa)F(Xr)</th>
                        <th scope="col">Ea(%)</th>
                        <th scope="col">Et(%)</th>
                    </tr>
                    </thead>
                    <tbody>
                    `+ htmlBody +`
                    </tbody>
                </table>`;

    $('#table-result-operation').empty().append(htmlTable)
};
